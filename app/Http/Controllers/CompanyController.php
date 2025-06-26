<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // ใช้โมเดล User เพื่อดึงข้อมูลผู้ใช้
use App\Models\Company; // หากต้องการใช้โมเดล Company เพื่อดึง

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::latest()->paginate(10);
        return view('company.index', ['companies' => $companies]);
        // return view('company.index', compact('companies')); // แสดงหน้ารายการบริษัท
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // แสดงฟอร์มสำหรับเพิ่มบริษัทใหม่
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'full_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'tax_id' => 'nullable|string|max:20',
        ]);

        Company::create($validated);

        return redirect()->route('company.index')->with('success', 'บริษัทใหม่ถูกเพิ่มเรียบร้อยแล้ว');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'tax_id' => 'nullable|string|max:50',
        ]);

        $company->update($request->only('full_name','name', 'address', 'email', 'phone', 'tax_id'));

        return redirect()->route('company.index')->with('success', 'อัปเดตข้อมูลบริษัทเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('company.index')->with('success', 'ลบบริษัทเรียบร้อยแล้ว');
    }
}
