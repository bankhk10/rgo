<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ChemicalImportsImport; // อย่าลืม import Import Class ที่สร้างไว้
use App\Models\ChemicalImport;
use App\Models\Company;


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
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('chemical_name_th', 'like', "%$search%")
                    ->orWhere('chemical_name_en', 'like', "%$search%")
                    ->orWhere('registration_no', 'like', "%$search%");
                // ->orWhere('trade_name', 'like', "%$search%");
            });
        }

        $imports = $query->latest()->paginate(10)->withQueryString();

        return view('import.index', compact('imports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all(); // ดึงรายชื่อบริษัททั้งหมด
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
        //
        ChemicalImport::create($request->all());
        return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จ');
        // return redirect()->route('import.index')->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว');
        // return redirect()->route('import.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
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
