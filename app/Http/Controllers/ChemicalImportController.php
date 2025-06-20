<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ChemicalImportsImport; // อย่าลืม import Import Class ที่สร้างไว้

class ChemicalImportController extends Controller
{
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
