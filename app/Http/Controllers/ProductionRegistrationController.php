<?php

namespace App\Http\Controllers;

use App\Models\ProductionRegistration; // Added automatically by --model flag
use App\Models\ChemicalImport; // Added automatically by --model flag
use Illuminate\Http\Request;

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
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('chemical_name_th', 'like', "%$search%")
                    ->orWhere('chemical_name_en', 'like', "%$search%")
                    ->orWhere('production_license_number', 'like', "%$search%")
                    ->orWhereHas('company', function ($q2) use ($search) {
                        $q2->where('full_name', 'like', "%$search%");
                    });
            });
        }

        if ($request->filled('expiry_date_from') && $request->filled('expiry_date_to')) {
            $query->whereBetween('registration_expiry_date', [
                $request->input('expiry_date_from'),
                $request->input('expiry_date_to'),
            ]);
        }

        $imports = $query->latest()->paginate(10)->withQueryString();

        $total = ProductionRegistration::count();
        $expiredCount = ProductionRegistration::where('status_date', 'expired')
            ->count();
        $soonCount = ProductionRegistration::where('status_date', 'soon_expired')
            ->count();

        // return view('production_registrations.index', compact('registrations'));


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
        return view('production_registrations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'registration_number' => 'nullable|string|max:255',
            'expired_license_date' => 'nullable|date',
            'chemical_name_th' => 'nullable|string|max:255',
            'chemical_name_en' => 'nullable|string|max:255',
            'composition' => 'nullable|string',
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
            'packaging_size_details' => 'nullable|string|max:255',
            'registration_number_pass' => 'nullable|string|max:255',
            'registration_expiry_date' => 'nullable|date',
            'expired_at' => 'nullable|date',
            'status_date' => 'nullable|string|max:255',
            'remarks' => 'nullable|string',
            'new_or_old' => 'boolean',
            'step' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'is_deleted' => 'boolean',
            'image' => 'nullable|string|max:255', // Or 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' if uploading files
            'document' => 'nullable|string|max:255', // Or 'nullable|file|mimes:pdf,doc,docx|max:10240' for documents
            'progress' => 'nullable|numeric',
            'sub_progress' => 'nullable|numeric',
            'created_by' => 'nullable|string|max:255',
            'updated_by' => 'nullable|string|max:255',
            // Add more validation rules as needed
        ]);

        // Create the new production registration
        $registration = ProductionRegistration::create($validatedData);

        return redirect()->route('production_registrations.index')
            ->with('success', 'Production registration created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductionRegistration $productionRegistration)
    {
        // The $productionRegistration instance is automatically resolved by Route Model Binding
        return view('production_registrations.show', compact('productionRegistration'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductionRegistration $productionRegistration)
    {
        return view('production_registrations.edit', compact('productionRegistration'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductionRegistration $productionRegistration)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'registration_number' => 'nullable|string|max:255',
            'expired_license_date' => 'nullable|date',
            'chemical_name_th' => 'nullable|string|max:255',
            'chemical_name_en' => 'nullable|string|max:255',
            'composition' => 'nullable|string',
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
            'packaging_size_details' => 'nullable|string|max:255',
            'registration_number_pass' => 'nullable|string|max:255',
            'registration_expiry_date' => 'nullable|date',
            'expired_at' => 'nullable|date',
            'status_date' => 'nullable|string|max:255',
            'remarks' => 'nullable|string',
            'new_or_old' => 'boolean',
            'step' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'is_deleted' => 'boolean',
            'image' => 'nullable|string|max:255',
            'document' => 'nullable|string|max:255',
            'progress' => 'nullable|numeric',
            'sub_progress' => 'nullable|numeric',
            'created_by' => 'nullable|string|max:255',
            'updated_by' => 'nullable|string|max:255',
            // Add more validation rules as needed
        ]);

        // Update the production registration
        $productionRegistration->update($validatedData);

        return redirect()->route('production_registrations.index')
            ->with('success', 'Production registration updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductionRegistration $productionRegistration)
    {
        // Soft delete the registration
        $productionRegistration->delete();

        return redirect()->route('production_registrations.index')
            ->with('success', 'Production registration deleted successfully.');
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
