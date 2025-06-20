<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Import;
use App\Models\ChemicalImport;
use Illuminate\Support\Facades\Log;
use App\Models\Company;

class ImportController extends Controller
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
                    ->orWhere('registration_no', 'like', "%$search%")
                    ->orWhere('trade_name', 'like', "%$search%");
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
        $import->update([
            'company_id'          => $request->company_id,
            'registration_no'     => $request->registration_no,
            'expiry_date'         => $request->expiry_date,
            'chemical_name_th'    => $request->chemical_name_th,
            'chemical_name_en'    => $request->chemical_name_en,
            'formula'             => $request->formula,
            'trade_name'          => $request->trade_name,
            'manufacturer'        => $request->manufacturer,
            'supplier'            => $request->supplier,
            'license_no'          => $request->license_no,
            'import_quantity'     => $request->import_quantity,
            'remaining_quantity'  => $request->remaining_quantity,
            'second_expiry_date'  => $request->second_expiry_date,
            'packaging'           => $request->packaging,
            'note'                => $request->note,
        ]);

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
}
