<?php

namespace App\Http\Controllers;

use App\Models\ProductionRegistration; // Added automatically by --model flag
use App\Models\ChemicalImport; // Added automatically by --model flag
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Log;
use Carbon\Carbon;


class ProductionRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {

        $query = ProductionRegistration::query();
        $query->with('company');

        if ($request->filled('search')) {
            // Normalize: remove whitespace and lowercase the search term for flexible matching
            $rawSearch = (string) $request->input('search');
            $normalized = mb_strtolower(preg_replace('/\s+/', '', $rawSearch));
            $like = '%' . $normalized . '%';

            $query->where(function ($q) use ($like) {
                $q->whereRaw("REPLACE(LOWER(chemical_name_th), ' ', '') LIKE ?", [$like])
                    ->orWhereRaw("REPLACE(LOWER(chemical_name_en), ' ', '') LIKE ?", [$like])
                    ->orWhereRaw("REPLACE(LOWER(registration_number), ' ', '') LIKE ?", [$like])
                    ->orWhereHas('company', function ($q2) use ($like) {
                        $q2->whereRaw("REPLACE(LOWER(full_name), ' ', '') LIKE ?", [$like]);
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
        }



        $imports = $query->latest()->paginate(10)->withQueryString();
        $total = ProductionRegistration::count();
        $expiredCount = ProductionRegistration::whereDate('expired_license_date', '<', Carbon::now())->count();
        $soonCount = ProductionRegistration::whereDate('expired_license_date', '>=', Carbon::now())
            ->whereDate('expired_license_date', '<=', Carbon::now()->addMonths(6))
            ->count();

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

        return view('production_registrations.index', [
            'imports' => $imports,
            'total' => $total,
            'expiredCount' => $expiredCount,
            'soonCount' => $soonCount,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        return view('production_registrations.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
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
                'possession_form_expiry' => 'nullable|string',
                'packaging_size_details' => 'nullable|string|max:1000',
                'registration_number_pass' => 'nullable|string|max:255',
                'registration_expiry_date' => 'nullable|date',
                'expired_at' => 'nullable|string',
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

            ProductionRegistration::create($dataToSave);
            return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จ');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'เกิดข้อผิดพลาดในการบันทึกข้อมูล: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductionRegistration $productionRegistration)
    {
        // The $productionRegistration instance is automatically resolved by Route Model Binding
        $product = $productionRegistration;
        $companies = Company::all();
        return view('production_registrations.show', compact('product', 'companies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductionRegistration $productionRegistration)
    {
        $companies = Company::all();
        // ถ้าต้องการใช้ชื่อ $import ใน Blade ก็ map เพิ่ม
        $import = $productionRegistration;
        return view('production_registrations.edit', compact('import', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductionRegistration $import)
    {

        // dd( $request->all());
        try {
            $request->merge([
                'expired_license_date'  => $this->convertDate($request->input('expired_license_date')),
                'registration_expiry_date'  => $this->convertDate($request->input('registration_expiry_date')),
                'production_license_expiry' => $this->convertDate($request->input('production_license_expiry')),
                // 'possession_form_expiry'    => $this->convertDate($request->input('possession_form_expiry')),
                'application_received_date' => $this->convertDate($request->input('application_received_date')),
                // 'expired_at'                => $this->convertDate($request->input('expired_at')),
                'date_submit_request'       => $this->convertDate($request->input('date_submit_request')),
                'date_request_phase_3'      => $this->convertDate($request->input('date_request_phase_3')),
            ]);

            // 1. Validation ข้อมูลจากฟอร์ม
            $validatedData = $request->validate([
                'company_id' => 'nullable|exists:companies,id',
                'registration_number' => 'nullable|string|max:255',
                'expired_license_date' => 'nullable|date',
                'chemical_name_th' => 'nullable|string|max:255',
                'chemical_name_en' => 'nullable|string|max:255',
                'composition' => 'nullable|string|max:1000',
                'manufacturer' => 'nullable|string|max:1000',
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
                'production_license_expiry' => 'nullable',
                'production_license_quantity' => 'nullable|string|max:255',
                'possession_form_wo2' => 'nullable|string|max:255',
                'possession_form_expiry' => 'nullable|string',
                'packaging_size_details' => 'nullable|string|max:1000',
                'registration_number_pass' => 'nullable|string|max:255',
                'registration_expiry_date' => 'nullable|date',
                'expired_at' => 'nullable|string',
                'status_date' => 'nullable|string|max:255',
                'remarks' => 'nullable|string|max:1000',
                'image' => 'nullable|image|max:2048', // optional: 'image' if you want to allow changing image
                'document' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // optional: 'file' if you want to allow changing document
                'progress' => 'nullable|numeric|min:0|max:100',
                'sub_progress' => 'nullable|numeric|min:0|max:100',
                // หมายเหตุ: สำหรับฟิลด์ที่ไม่จำเป็นต้องเปลี่ยนผ่านฟอร์ม (เช่น created_by, is_deleted) ไม่ต้องใส่ใน validation rules
            ]);

            // 2. Map ข้อมูลและกำหนดค่าเพิ่มเติม (คล้ายกับ Store แต่ไม่มี created_by)
            $dataToUpdate = $validatedData;
            // กำหนดค่าสำหรับ Checkbox หรือค่า default
            $dataToUpdate['new_or_old'] = $request->has('new_or_old') ? true : false;
            $dataToUpdate['is_active'] = $request->has('is_active') ? true : false;
            // กำหนด updated_by โดยใช้ ID ของผู้ใช้งานที่ล็อกอินอยู่
            if (Auth::check()) {
                $dataToUpdate['updated_by'] = Auth::id(); // หรือ Auth::user()->name หากต้องการชื่อ
            } else {
                $dataToUpdate['updated_by'] = null;
            }

            // ถ้ามีการอัปโหลดไฟล์ใหม่ ให้ลบไฟล์เก่าก่อน (ถ้ามี)
            if ($request->hasFile('image')) {
                // ลบรูปเก่า (ถ้ามีและไม่ใช่ default image)
                if ($import->image && \Storage::disk('public')->exists($import->image)) {
                    \Storage::disk('public')->delete($import->image);
                }
                $imagePath = $request->file('image')->store('production_images', 'public');
                $dataToUpdate['image'] = $imagePath;
            }

            if ($request->hasFile('document')) {
                // ลบเอกสารเก่า (ถ้ามี)
                if ($import->document && \Storage::disk('public')->exists($import->document)) {
                    \Storage::disk('public')->delete($import->document);
                }
                $documentPath = $request->file('document')->store('production_documents', 'public');
                $dataToUpdate['document'] = $documentPath;
            }

            // 3. อัปเดต Record ในฐานข้อมูล
            $import->update($dataToUpdate);

            // 4. ส่งกลับ Response หรือ Redirect ไปยังหน้าอื่น
            // return redirect()->route('production-registrations.index')->with('success', 'แก้ไขข้อมูลการขึ้นทะเบียนผลิตเรียบร้อยแล้ว!');
            return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จ');
        } catch (\Exception $e) {
            \Log::error("Error update product: " . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all(), // ข้อมูลฟอร์มที่ส่งมา
            ]);

            return redirect()->back()->with('error', 'เกิดข้อผิดพลาดในการแก้ไขข้อมูล: ' . $e->getMessage())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = ProductionRegistration::findOrFail($id); // เปลี่ยน YourProductModel เป็นชื่อ Model ของคุณ
        $product->delete();

        return redirect()->route('createproduct.index')->with('success', 'ลบข้อมูลทะเบียนผลิตเรียบร้อยแล้ว');
    }

    public function showImportForm()
    {
        return view('chemical_imports.import_product'); // ต้องสร้าง view นี้ใน resources/views/chemical_imports/import.blade.php
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048', // กำหนดให้ไฟล์ต้องเป็น Excel และมีขนาดไม่เกิน 2MB
        ]);

        try {
            Excel::import(new ChemicalImportsImport(), $request->file('file'));
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

    private function convertDate($value)
    {
        if (!$value) return null;
        if (preg_match('#^\d{2}/\d{2}/\d{4}$#', $value)) {
            [$dd, $mm, $yyyy] = explode('/', $value);
            if ((int)$yyyy > 2400) $yyyy -= 543;
            return sprintf('%04d-%02d-%02d', $yyyy, $mm, $dd);
        }
        return $value; // ปล่อยผ่านถ้าเป็น yyyy-mm-dd อยู่แล้ว
    }
}
