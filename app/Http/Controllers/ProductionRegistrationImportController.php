<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ProductionRegistrationImport;
use Maatwebsite\Excel\Facades\Excel;

class ProductionRegistrationImportController extends Controller
{
    public function showForm()
    {
        return view('production_registrations_import.production_registration');
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls',
        ]);

        Excel::import(new ProductionRegistrationImport, $request->file('excel_file'));

        return back()->with('success', 'นำเข้าข้อมูลสำเร็จ');
    }
}
