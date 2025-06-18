<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Product; // Assuming you have a Product model

class NewRegisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {

        // นับจำนวนผลิตภัณฑ์ที่ 'new_or_old' เป็น true (ขึ้นทะเบียนใหม่ทั้งหมด)
        $totalNewRegistrations = Product::where('new_or_old', true)->count();

        // นับจำนวนผลิตภัณฑ์ที่ 'status' เป็น 'pending' (อยู่ระหว่างดำเนินการ)
        $pendingCount = Product::where('progress', '<', 100) // progress ไม่ถึง 100% (ซึ่งน่าจะครอบคลุม 'pending' ด้วย)
            ->where('new_or_old', true)
            ->count();

        // นับจำนวนผลิตภัณฑ์ที่ 'status' เป็น 'approved' (ขึ้นทะเบียนใหม่เสร็จแล้ว)
        $approvedCount = Product::where('progress', 100)
            ->where('new_or_old', true) // เฉพาะที่เป็นการขึ้นทะเบียนใหม่
            ->count();
        // progress ไม่ถึง 100% (ซึ่งน่าจะครอบคลุม 'pending' ด้วย)
        $paginatedProducts = Product::where('new_or_old', true)
            ->where('status', 'pending')
            // แสดงทุกสถานะที่ progress ไม่ถึง 100% ก็ใช้แบบนี้
            // ->where('progress', '<', 100)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

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
    public function store(Request $request)
    {
        $newRegis = new Product();
        $newRegis->name = $request->hazardous_name_th;
        $newRegis->registration_number = $request->registration_number;
        $newRegis->registration_date = $request->expiry_date;
        $newRegis->expiry_date = $request->expiry_date;
        $newRegis->progress = $request->company;
        $newRegis->save();

        return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($registrationNumber)
    {
        $drug = Product::where('id', $registrationNumber)->first();
        if (!$drug) {
            // หากไม่พบยา ให้ Redirect กลับหรือแสดงหน้า 404
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
