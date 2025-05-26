<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Import;

class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $imports = Import::latest()->paginate(10);
        return view('import.index', compact('imports')); // ส่งข้อมูลไปยัง View ชื่อ 'imports.index'
        // return view('import.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('import.create');
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
        Import::create($request->all());
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
    public function show(Import $import)
    {
        return view('import.show', compact('import'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Import $import)
    {
        return view('import.edit', compact('import'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Import $import)
    {
        $request->validate([
            // 'company' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'registration_number' => 'nullable|string|max:255',
            'expiry_date' => 'nullable|date',
            'hazardous_name_th' => 'nullable|string|max:255',
            'hazardous_name_en' => 'nullable|string|max:255',
            'percentage_formula' => 'nullable|string|max:255',
            'trade_name' => 'nullable|string|max:255',
            'manufacturer_source' => 'nullable|string|max:255',
            'supplier' => 'nullable|string|max:255',
            'license_number' => 'nullable|string|max:255',
            'import_quantity' => 'nullable|integer',
            'remaining_quantity' => 'nullable|integer',
            'shelf_life' => 'nullable|date',
            'package_size' => 'nullable|string|max:255',
            'note' => 'nullable|string',
        ]);

        $import->update($request->all());

        return redirect()->route('import.index')->with('success', 'แก้ไขข้อมูลทะเบียนนำเข้าสำเร็จ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Import $import)
    {
        $import->delete();

        return redirect()->route('import.index')->with('success', 'ลบข้อมูลทะเบียนนำเข้าสำเร็จ');
    }
}
