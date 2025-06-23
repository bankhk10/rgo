<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Product; // Assuming you have a Product model
use Illuminate\Support\Facades\Log; // For logging purposes

class NewRegisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        // Start with a base query for 'new_or_old' products
        $query = Product::where('new_or_old', true);

        // Handle search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('registration_number', 'like', '%' . $search . '%');
            });
        }

        // Count for summary cards - these should NOT be affected by the search query
        $totalNewRegistrations = Product::where('new_or_old', true)->count();
        $pendingCount = Product::where('progress', '<', 100)
            ->where('new_or_old', true)
            ->count();
        $approvedCount = Product::where('progress', 100)
            ->where('new_or_old', true)
            ->count();

        // Paginate the results using the $query that now includes search conditions
        // Remove the additional ->where('status', 'pending') or ->where('progress', '<', 100)
        // unless you specifically want to filter the main table by that status by default.
        // Based on your original template, the table should show all new registrations,
        // and the status is indicated by the progress bar.
        $paginatedProducts = $query->orderBy('created_at', 'desc')->paginate(5);

        return view('product.new.index', [
            'totalNewRegistrations' => $totalNewRegistrations,
            'pendingCount' => $pendingCount,
            'approvedCount' => $approvedCount,
            'paginatedProducts' => $paginatedProducts,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.new.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $newRegis = new Product();
    //     $newRegis->name = $request->hazardous_name_th;
    //     $newRegis->registration_number = $request->registration_number;
    //     $newRegis->registration_date = $request->expiry_date; // This seems incorrect, should be a dedicated date field
    //     $newRegis->expiry_date = $request->expiry_date;
    //     $newRegis->progress = $request->company; // This seems incorrect, should be a progress value
    //     $newRegis->new_or_old = true; // Make sure new registrations are marked as 'true'
    //     $newRegis->save();

    //     return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จ');
    // }


    public function store(Request $request)
    {

        // 1. ตรวจสอบข้อมูล (Validation) - สำคัญมาก!
        $validatedData = $request->validate([
            'chemical_imports_id' => 'nullable|string|max:255',
            'trade_name' => 'nullable|string|max:255',
            'manufacturer_origin' => 'nullable|string|max:255',
            'importer_name' => 'nullable|string|max:255',
            'distributor_name' => 'nullable|string|max:255',
            'purpose_and_type_of_use' => 'nullable|string|max:255',
            'packaging_type' => 'nullable|string|max:255',
            'notes' => 'nullable|string', // text field ใช้ string ได้

            // ฟิลด์จากตาราง product ที่มีอยู่แล้ว
            'name' => 'nullable|string|max:255', // ถ้าฟอร์มมีช่องนี้
            'registration_number' => 'nullable|string|max:255|unique:product,registration_number', // ต้องไม่ซ้ำ
            'registration_date' => 'nullable|date',
            'expiry_date' => 'nullable|date',
            'company' => 'nullable|string|max:255', // ถ้าฟอร์มมีช่องนี้

            // ฟิลด์ 'progress' ไม่มีในฟอร์มปัจจุบัน แต่มีใน migration ถ้าต้องการ set ค่า default
            // ฟิลด์ 'status', 'is_active', 'is_deleted', 'new_or_old' มักจะตั้งค่า default ใน migration หรือใน code
            // 'image', 'document', 'remarks' หากมีช่อง input
            // 'created_by' หากคุณจะบันทึกผู้สร้างเอง
        ]);

        // 2. เตรียมข้อมูลสำหรับบันทึก (ถ้าจำเป็น)
        // Laravel จะจัดการ `created_at` และ `updated_at` โดยอัตโนมัติ
        // หากมีฟิลด์ 'progress' ที่ไม่ได้อยู่ในฟอร์ม แต่ต้องการตั้งค่าเริ่มต้น
        $validatedData['progress'] = $request->input('progress', 0); // ใช้ค่าจากฟอร์ม หรือ default เป็น 10

        // หากต้องการบันทึกผู้ใช้งานปัจจุบัน
        // $validatedData['created_by'] = auth()->id(); // หรือ auth()->user()->name;

        // 3. บันทึกข้อมูลลงในฐานข้อมูล

        try {
            Log::info("trying to create a new product with data: ");
            Product::create($validatedData);

            // 4. ส่งกลับพร้อมข้อความ Success
            return redirect()->route('newregis.index')->with('success', 'บันทึกข้อมูลสำเร็จแล้ว!');
        } catch (\Exception $e) {
            // 5. จัดการข้อผิดพลาด
            Log::error("Error creating product: " . $e->getMessage());
            return redirect()->back()->withInput()->withErrors(['error' => 'เกิดข้อผิดพลาดในการบันทึกข้อมูล: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) // Changed from $registrationNumber to $id for consistency with route model binding
    {
        $drug = Product::where('id', $id)->first();
        if (!$drug) {
            abort(404, 'ไม่พบข้อมูลยา');
        }

        return view('product.new.show', compact('drug'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
