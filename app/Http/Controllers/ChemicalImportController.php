<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ChemicalImportsImport; // อย่าลืม import Import Class ที่สร้างไว้
use App\Models\ChemicalImport;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Log;


class ChemicalImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = ChemicalImport::query();
        $query->with('company');

        // ส่วนของการค้นหา (search) ยังคงเดิม
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('chemical_name_th', 'like', "%$search%")
                    ->orWhere('chemical_name_en', 'like', "%$search%")
                    ->orWhere('registration_no', 'like', "%$search%")
                    ->orWhereHas('company', function ($q2) use ($search) {
                        $q2->where('full_name', 'like', "%$search%");
                    });
            });
        }

        // ส่วนของการกรองตามช่วงวันหมดอายุ (expiry_date_from/to) ยังคงเดิม
        if ($request->filled('expiry_date_from') && $request->filled('expiry_date_to')) {
            $query->whereBetween('expired_license_date', [
                $request->input('expiry_date_from'),
                $request->input('expiry_date_to'),
            ]);
        }

        // **เพิ่มส่วนนี้: การกรองตาม status_filter**
        if ($request->filled('status_filter')) {
            $statusFilter = $request->input('status_filter');
            $now = Carbon::now();

            if ($statusFilter === 'expired') {
                $query->whereDate('expired_license_date', '<', $now);
            } elseif ($statusFilter === 'soon_expired') {
                $query->whereDate('expired_license_date', '>=', $now)
                    ->whereDate('expired_license_date', '<=', $now->copy()->addMonths(6));
            }
            // ถ้า status_filter ไม่ใช่ 'expired' หรือ 'soon_expired' (เช่น ถ้ามีค่าอื่นที่ไม่รู้จัก หรือไม่มีค่า)
            // ก็จะไม่เพิ่มเงื่อนไขการกรองนี้ ทำให้แสดงทั้งหมด (หรือตามเงื่อนไข search/date อื่นๆ)
        }

        $imports = $query->latest()->paginate(10)->withQueryString();

        // คำนวณค่าสถานะใหม่โดยใช้ Carbon เพื่อให้แม่นยำตามเวลาปัจจุบัน
        $total = ChemicalImport::count();
        $expiredCount = ChemicalImport::whereDate('expired_license_date', '<', Carbon::now())->count();
        $soonCount = ChemicalImport::whereDate('expired_license_date', '>=', Carbon::now())
            ->whereDate('expired_license_date', '<=', Carbon::now()->addMonths(6))
            ->count();

        // สำคัญ: สำหรับแต่ละรายการใน $imports เราจะกำหนดค่า status ให้ถูกต้องก่อนส่งไปยัง Blade view
        foreach ($imports as $import) {
            $expiryDate = Carbon::parse($import->expired_license_date);
            $now = Carbon::now();

            if ($expiryDate->isPast()) {
                $import->status = 'หมดอายุ';
            } elseif ($expiryDate->diffInMonths($now) <= 6) {
                $import->status = 'ใกล้หมดอายุ';
            } else {
                $import->status = 'ใช้งานอยู่';
            }
        }

        return view('import.index', [
            'imports' => $imports,
            'total' => $total,
            'expiredCount' => $expiredCount,
            'soonCount' => $soonCount,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        return view('import.create', compact('companies'));
        // return view('import.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        try {
            // 1. Validation ข้อมูลจากฟอร์ม
            $validatedData = $request->validate([
                'company_id' => 'nullable|exists:companies,id', // ตรวจสอบว่า company_id มีอยู่ในตาราง companies
                'registration_number' => 'nullable|string|max:255',
                'expired_license_date' => 'nullable|date',
                'chemical_name_th' => 'nullable|string|max:255',
                'chemical_name_en' => 'nullable|string|max:255',
                'composition' => 'nullable|string|max:1000',
                'manufacturer' => 'nullable|string|max:255',
                'registrant' => 'nullable|string|max:255',
                'registration_type' => 'nullable|string|max:255',
                'importer' => 'nullable|string|max:255',
                'distributor' => 'nullable|string|max:255',
                'trade_name' => 'nullable|string|max:255',
                'trade_name_at' => 'nullable|string|max:255',
                'type_production_registration' => 'nullable|string|max:255',
                'usage_production_registration' => 'nullable|string|max:255',
                'group_of_substances' => 'nullable|string|max:255',
                'plant' => 'nullable|string|max:255',
                'pests' => 'nullable|string|max:255',
                'production_license_number' => 'nullable|string|max:255',
                'production_license_expiry' => 'nullable|date',
                'production_license_quantity' => 'nullable|string|max:255',
                'possession_form_wo2' => 'nullable|string|max:255',
                'possession_form_expiry' => 'nullable|date',
                'packaging_size_details' => 'nullable|string|max:1000',
                'registration_number_pass' => 'nullable|string|max:255',
                'registration_expiry_date' => 'nullable|date',
                'expired_at' => 'nullable|date',
                'status_date' => 'nullable|string|max:255',
                'remarks' => 'nullable|string|max:1000',
                'image' => 'nullable|image|max:2048', // ตัวอย่าง: อนุญาตเฉพาะไฟล์ภาพ ขนาดไม่เกิน 2MB
                'document' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // ตัวอย่าง: อนุญาตเฉพาะ PDF, DOC, DOCX ขนาดไม่เกิน 5MB
                'progress' => 'nullable|numeric|min:0|max:100',
                'sub_progress' => 'nullable|numeric|min:0|max:100',

            ]);

            // 2. Map ข้อมูลและกำหนดค่าเริ่มต้น/เพิ่มเติม
            $dataToSave = $validatedData; // เริ่มต้นด้วยข้อมูลที่ผ่านการ Validation

            // กำหนดค่าเริ่มต้นสำหรับฟิลด์ที่ไม่ได้มาจากฟอร์มโดยตรงหรือต้องการค่า default
            $dataToSave['new_or_old'] = $request->has('new_or_old') ? true : false; // สมมติว่าเป็น checkbox
            $dataToSave['step'] = $request->input('step', 'initial'); // ใช้ค่าจากฟอร์ม ถ้าไม่มี ให้ 'initial'
            $dataToSave['status'] = $request->input('status', 'pending'); // ใช้ค่าจากฟอร์ม ถ้าไม่มี ให้ 'pending'
            $dataToSave['is_active'] = $request->has('is_active') ? true : false; // สมมติว่าเป็น checkbox
            $dataToSave['is_deleted'] = false; // ควรตั้งเป็น false เสมอเมื่อสร้างใหม่

            // กำหนด created_by โดยใช้ ID ของผู้ใช้งานที่ล็อกอินอยู่
            if (Auth::check()) {
                $dataToSave['created_by'] = Auth::id(); // หรือ Auth::user()->name หากต้องการชื่อ
            } else {
                $dataToSave['created_by'] = null; // หรือกำหนดเป็นค่าอื่นหากผู้ใช้ไม่ได้ล็อกอิน
            }

            // การจัดการไฟล์ (Image และ Document)
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('production_images', 'public'); // เก็บใน storage/app/public/production_images
                $dataToSave['image'] = $imagePath;
            }

            if ($request->hasFile('document')) {
                $documentPath = $request->file('document')->store('production_documents', 'public'); // เก็บใน storage/app/public/production_documents
                $dataToSave['document'] = $documentPath;
            }

            // 3. สร้าง Record ใหม่ในฐานข้อมูล
            ChemicalImport::create($dataToSave);

            // 4. ส่งกลับ Response หรือ Redirect ไปยังหน้าอื่น
            // return redirect()->route('createproduct.index')->with('success', 'บันทึกข้อมูลการขึ้นทะเบียนผลิตเรียบร้อยแล้ว!');
            return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จ');
        } catch (ValidationException $e) {
            // หากเกิดข้อผิดพลาดในการ Validation
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // หากเกิดข้อผิดพลาดอื่นๆ
            return redirect()
                ->back()
                ->with('error', 'เกิดข้อผิดพลาดในการบันทึกข้อมูล: ' . $e->getMessage())
                ->withInput();
        }

        // ChemicalImport::create($request->all());
        // return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ChemicalImport $import)
    {

        $product = $import;
        $companies = Company::all();
        return view('import.show', compact('product', 'companies'));
        // return view('import.show', compact('import'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ChemicalImport $import)
    {
        $companies = Company::all();
        return view('import.edit', compact('import', 'companies'));
        // return view('import.edit', compact('import'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChemicalImport $import)
    {
        // Validate input
        $validated = $request->validate([
            'company_id'          => 'required|exists:companies,id',
            'registration_no'     => 'nullable|string|max:255',
            'expiry_date'         => 'nullable|date',
            'second_expiry_date'  => 'nullable|date',
            'chemical_name_th'    => 'nullable|string|max:255',
            'chemical_name_en'    => 'nullable|string|max:255',
            'formula'             => 'nullable|string|max:255',
            'trade_name'          => 'nullable|string|max:255',
            'manufacturer'        => 'nullable|string|max:255',
            'supplier'            => 'nullable|string|max:255',
            'license_no'          => 'nullable|string|max:255',
            'import_quantity'     => 'nullable|numeric|min:0',
            'remaining_quantity'  => 'nullable|numeric|min:0',
            'packaging'           => 'nullable|string',
            'remarks'                => 'nullable|string',
            'store_company_1'     => 'nullable|string|different:store_company_2',
            'store_company_2'     => 'nullable|string|different:store_company_1',
        ]);

        $import->update($validated);

        return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChemicalImport $import)
    {

        $import->delete();
        return redirect()->back()->withSuccess('Deleted !!!');
    }

    /**
     * แสดงหน้าฟอร์มอัปโหลดไฟล์ Excel.
     *
     * @return \Illuminate\View\View
     */
    public function showImportForm()
    {
        return view('chemical_imports.import'); // ต้องสร้าง view นี้ใน resources/views/chemical_imports/import.blade.php
    }

    /**
     * จัดการการนำเข้าข้อมูลจากไฟล์ Excel.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048', // กำหนดให้ไฟล์ต้องเป็น Excel และมีขนาดไม่เกิน 2MB
        ]);

        try {
            Excel::import(new ChemicalImportsImport, $request->file('file'));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            $errorMessages = [];
            foreach ($failures as $failure) {
                $errorMessages[] = 'Row ' . $failure->row() . ': ' . implode(', ', $failure->errors()) . ' (' . $failure->attribute() . ' = ' . $failure->values()[$failure->attribute()] . ')';
            }

            return back()->with('import_errors', $errorMessages);
        } catch (\Exception $e) {
            return back()->with('error', 'เกิดข้อผิดพลาดในการนำเข้าข้อมูล: ' . $e->getMessage());
        }


        return back()->with('success', 'นำเข้าข้อมูลวัตถุอันตรายเรียบร้อยแล้ว!');
    }
}
