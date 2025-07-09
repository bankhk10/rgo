<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ChemicalImportsImport; // อย่าลืม import Import Class ที่สร้างไว้
use App\Models\ChemicalImport;
use App\Models\Company;
use Carbon\Carbon;


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
            $query->whereBetween('expiry_date', [
                $request->input('expiry_date_from'),
                $request->input('expiry_date_to'),
            ]);
        }

        // **เพิ่มส่วนนี้: การกรองตาม status_filter**
        if ($request->filled('status_filter')) {
            $statusFilter = $request->input('status_filter');
            $now = Carbon::now();

            if ($statusFilter === 'expired') {
                $query->whereDate('expiry_date', '<', $now);
            } elseif ($statusFilter === 'soon_expired') {
                $query->whereDate('expiry_date', '>=', $now)
                    ->whereDate('expiry_date', '<=', $now->copy()->addMonths(6));
            }
            // ถ้า status_filter ไม่ใช่ 'expired' หรือ 'soon_expired' (เช่น ถ้ามีค่าอื่นที่ไม่รู้จัก หรือไม่มีค่า)
            // ก็จะไม่เพิ่มเงื่อนไขการกรองนี้ ทำให้แสดงทั้งหมด (หรือตามเงื่อนไข search/date อื่นๆ)
        }

        $imports = $query->latest()->paginate(10)->withQueryString();

        // คำนวณค่าสถานะใหม่โดยใช้ Carbon เพื่อให้แม่นยำตามเวลาปัจจุบัน
        $total = ChemicalImport::count();
        $expiredCount = ChemicalImport::whereDate('expiry_date', '<', Carbon::now())->count();
        $soonCount = ChemicalImport::whereDate('expiry_date', '>=', Carbon::now())
            ->whereDate('expiry_date', '<=', Carbon::now()->addMonths(6))
            ->count();

        // สำคัญ: สำหรับแต่ละรายการใน $imports เราจะกำหนดค่า status ให้ถูกต้องก่อนส่งไปยัง Blade view
        foreach ($imports as $import) {
            $expiryDate = Carbon::parse($import->expiry_date);
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

        $validatedData = $request->validate([
            'company_id' => 'required', // This line makes it required
            // Add other validation rules for your form fields
        ], [
            'company_id.required' => 'กรุณาเลือกบริษัทนำเข้า', // Custom error message
        ]);

        ChemicalImport::create($request->all());
        return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ChemicalImport $import)
    {
        return view('import.show', compact('import'));
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
