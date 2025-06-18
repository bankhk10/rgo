<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class NewRegisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        // กำหนดค่าต่างๆ
        $expiredCount = 2; // ตัวอย่างจำนวนหมดอายุ
        $activeCount = 5; // ตัวอย่างจำนวนที่ขึ้นทะเบียนเสร็จแล้ว

        // ข้อมูลทะเบียนที่ใกล้หมดอายุ (หรืออยู่ระหว่างดำเนินการ)
        $nearExpiryDrugs = collect([
            (object) [
                'name' => 'พาราเซตามอล',
                'registration_number' => '000001',
                'expiry_date' => Carbon::now()->addDays(10),
                'progress' => 10,
            ],
            (object) [
                'name' => 'ไอบูโพรเฟน',
                'registration_number' => '000002',
                'expiry_date' => Carbon::now()->addDays(20),
                'progress' => 20,
            ],
            (object) [
                'name' => 'อะม็อกซิลลิน',
                'registration_number' => '000003',
                'expiry_date' => Carbon::now()->addDays(5),
                'progress' => 30,
            ],
            (object) [
                'name' => 'โอเมพราโซล ',
                'registration_number' => '000004',
                'expiry_date' => Carbon::now()->addDays(10),
                'progress' => 40,
            ],
            (object) [
                'name' => 'ลอราทาดีน',
                'registration_number' => '000005',
                'expiry_date' => Carbon::now()->addDays(20),
                'progress' => 50,
            ],
            (object) [
                'name' => 'ซิมวาสแตติน ',
                'registration_number' => '000006',
                'expiry_date' => Carbon::now()->addDays(5),
                'progress' => 60,
            ],
            (object) [
                'name' => 'เมทฟอร์มิน',
                'registration_number' => '000007',
                'expiry_date' => Carbon::now()->addDays(10),
                'progress' => 70,
            ],
            (object) [
                'name' => 'ซาลบูทามอล',
                'registration_number' => '000008',
                'expiry_date' => Carbon::now()->addDays(10),
                'progress' => 80,
            ],
            (object) [
                'name' => 'ยาราตาร',
                'registration_number' => '000009',
                'expiry_date' => Carbon::now()->addDays(10),
                'progress' => 90,
            ],
            (object) [
                'name' => 'ไดอะซีแพม',
                'registration_number' => '000010',
                'expiry_date' => Carbon::now()->addDays(10),
                'progress' => 100,
            ],
        ]);

        $nearExpiryCount = $nearExpiryDrugs->count();

        // การทำ Pagination ด้วยมือสำหรับ Collection
        $perPage = 5;
        $currentPage = $request->get('page', 1);
        $paginatedNearExpiryDrugs = new LengthAwarePaginator(
            $nearExpiryDrugs->forPage($currentPage, $perPage),
            $nearExpiryDrugs->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url()],
        );

        return view('product.new.index', compact('expiredCount', 'nearExpiryCount', 'activeCount', 'paginatedNearExpiryDrugs'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($registrationNumber)
    {
        // สมมติว่าข้อมูลยาของคุณเก็บอยู่ในฐานข้อมูล
        // ในที่นี้เราจะใช้ข้อมูลตัวอย่างที่คุณให้มา
        $allDrugs = collect([
            (object) [
                'name' => 'ยาเม็ดวิตามินรวม',
                'registration_number' => '123456',
                'expiry_date' => Carbon::now()->addDays(10),
                'progress' => 10,
                'description' => 'วิตามินรวมสำหรับบำรุงร่างกาย',
            ],
            (object) [
                'name' => 'น้ำมันตับปลาชนิดแคปซูล',
                'registration_number' => '654321',
                'expiry_date' => Carbon::now()->addDays(20),
                'progress' => 50,
                'description' => 'น้ำมันตับปลาบำรุงสมองและสายตา',
            ],
            (object) [
                'name' => 'ยาแก้ปวดพาราเซตามอล',
                'registration_number' => '987654',
                'expiry_date' => Carbon::now()->addDays(5),
                'progress' => 20,
                'description' => 'ยาบรรเทาอาการปวดและลดไข้',
            ],
            (object) [
                'name' => 'พาราเซตามอล',
                'registration_number' => '000001',
                'expiry_date' => Carbon::now()->addDays(10),
                'progress' => 10,
            ],
            (object) [
                'name' => 'ไอบูโพรเฟน',
                'registration_number' => '000002',
                'expiry_date' => Carbon::now()->addDays(20),
                'progress' => 20,
            ],
            (object) [
                'name' => 'อะม็อกซิลลิน',
                'registration_number' => '000003',
                'expiry_date' => Carbon::now()->addDays(5),
                'progress' => 30,
            ],
            (object) [
                'name' => 'โอเมพราโซล ',
                'registration_number' => '000004',
                'expiry_date' => Carbon::now()->addDays(10),
                'progress' => 40,
            ],
            (object) [
                'name' => 'ลอราทาดีน',
                'registration_number' => '000005',
                'expiry_date' => Carbon::now()->addDays(20),
                'progress' => 50,
            ],
            (object) [
                'name' => 'ซิมวาสแตติน ',
                'registration_number' => '000006',
                'expiry_date' => Carbon::now()->addDays(5),
                'progress' => 60,
            ],
            (object) [
                'name' => 'เมทฟอร์มิน',
                'registration_number' => '000007',
                'expiry_date' => Carbon::now()->addDays(10),
                'progress' => 70,
            ],
            (object) [
                'name' => 'ซาลบูทามอล',
                'registration_number' => '000008',
                'expiry_date' => Carbon::now()->addDays(10),
                'progress' => 80,
            ],
            (object) [
                'name' => 'ยาราตาร',
                'registration_number' => '000009',
                'expiry_date' => Carbon::now()->addDays(10),
                'progress' => 90,
            ],
            (object) [
                'name' => 'ไดอะซีแพม',
                'registration_number' => '000010',
                'expiry_date' => Carbon::now()->addDays(10),
                'progress' => 100,
            ],
        ]);

        $drug = $allDrugs->firstWhere('registration_number', $registrationNumber);

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
