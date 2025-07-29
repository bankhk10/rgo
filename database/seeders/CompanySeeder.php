<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ปิด foreign key constraints ชั่วคราว (ถ้ามี)
        Schema::disableForeignKeyConstraints();

        // ล้างข้อมูลทั้งหมด และ reset auto increment
        DB::table('companies')->truncate();

        // เปิด foreign key constraints กลับ
        Schema::enableForeignKeyConstraints();

        DB::table('companies')->insert([
            [
                'name' => 'IC',
                'full_name' => 'บริษัท อินเตอร์ คร็อพ จำกัด',
                'address' => ' 22 ICG Building ถ.พระรามที่ 6 แขวงพญาไท เขตพญาไท กรุงเทพมหานคร 10400',
                'email' => 'info@intercrop.co.th',
                'phone' => '0-2271-1001',
                'tax_id' => '0105531048113',
                'type' => 1, // ผู้ผลิต
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'AI',
                'full_name' => 'บริษัท แอ็กโฟรีแพ็กซ์อินดัสตรีส์ จำกัด',
                'address' => '828 หมู่ 4 นิคมอุตสาหกรรมบางปู ซ.13B ตำบล แพรกษา อำเภอเมืองสมุทรปราการ สมุทรปราการ 10280',
                'email' => 'xxxxx@xxxxx.com',
                'phone' => '02-709-3525',
                'tax_id' => '0115537008016',
                'type' => 1, // ผู้นำเข้า
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'UP',
                'full_name' => 'บริษัท ยูนิพรีมา จำกัด',
                'address' => '831 หมู่ 4 นิคมอุตสาหกรรมบางปู ซ.13B ตำบล แพรกษา อำเภอเมืองสมุทรปราการ สมุทรปราการ 10280',
                'email' => 'xxxxx@xxxxx.com',
                'phone' => '02-709-6841',
                'tax_id' => '0105547144354',
                'type' => 1, // ผู้จำหน่าย
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'AM',
                'full_name' => 'บริษัท เอแม็กซ์ อินเตอร์ จำกัด',
                'address' => ' 22 ICG Building ถ.พระรามที่ 6 แขวงพญาไท เขตพญาไท กรุงเทพมหานคร 10400',
                'email' => 'xxxxx@xxxxx.com',
                'phone' => '0',
                'tax_id' => '0105554109810',
                'type' => 2, // ผู้จำหน่าย
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'BF',
                'full_name' => 'บริษัท บีแฟค อินเตอร์ จำกัด',
                'address' => ' 22 ICG Building ถ.พระรามที่ 6 แขวงพญาไท เขตพญาไท กรุงเทพมหานคร 10400',
                'email' => 'xxxxx@xxxxx.com',
                'phone' => '0',
                'tax_id' => '0105554109879 ',
                'type' => 2, // ผู้จำหน่าย
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'CP',
                'full_name' => 'บริษัท ซีเพช อินเตอร์ จำกัด',
                'address' => ' 22 ICG Building ถ.พระรามที่ 6 แขวงพญาไท เขตพญาไท กรุงเทพมหานคร 10400',
                'email' => 'xxxxx@xxxxx.com',
                'phone' => '0',
                'tax_id' => '0105554109828',
                'type' => 2, // ผู้จำหน่าย
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'CS',
                'full_name' => 'บริษัท คร็อพ ซายน์ จำกัด',
                'address' => ' 22 ICG Building ถ.พระรามที่ 6 แขวงพญาไท เขตพญาไท กรุงเทพมหานคร 10400',
                'email' => 'cs.cropsciences@gmail.com',
                'phone' => '02-618-4522',
                'tax_id' => '0105542089762',
                'type' => 3, // ผู้จำหน่าย
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            ['name' => '-', 'full_name' => 'บริษัท ครอป อะกริเทค จำกัด', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'บริษัท คิว แม็กซ์ อะโกรเทค จำกัด', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'บริษัท เคโมฟายล์ จำกัด', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'บริษัท เคยู 35 เคมีเกษตร จำกัด', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'บริษัท ซาธิวา (ไทย) จำกัด', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'บริษัท ซีอีโอ อะกริเทค จำกัด', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'บริษัท โซตัส อินเตอร์เนชั่นแนล จำกัด', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'บริษัท ดอกเตอร์เกษตร จำกัด', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'บริษัท ที.พี ฟาร์มเมอร์ จำกัด', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'บริษัท ไท อโกรซายน์ 6162 จำกัด', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'บริษัท บี เค อะโกร จำกัด', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'บริษัท ฟาร์มอะโกร หจก.', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'บริษัท ฟิวเจอร์อโกรเคมีคอล จำกัด', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'บริษัท โฟโต้กรีน เคมีคอล จำกัด', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'บริษัท เมืองทองการเกษตร จำกัด', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'บริษัท ยูนิไลฟ์ อินเตอร์เนชั่นแนล จำกัด', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'บริษัท รังสิพรรณ อินเตอร์เทรด จำกัด', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'บริษัท รีชฮันเตอร์ จำกัด', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'บริษัท วี ไอ วี อินเตอร์เคม จำกัด', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'บริษัท สหภัณฑ์ส่งเสริมการเกษตร จำกัด', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'บริษัท สิงห์เจ้าพระยา จำกัด', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'บริษัท เฮลตี้ แคร์ จำกัด', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'บริษัท ธันย์สตาร์ 2557 จำกัด', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'บริษัท ฟรีมาร์เก็ต อโกร จำกัด', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'บริษัท มิตรสมบูรณ์ จำกัด', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'บริษัท ไทยเบสท์โฮลดิ้ง จำกัด', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'บริษัท นายเกษตร จำกัด', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'บริษัท เอสทีม อินเตอร์เทรด จำกัด', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
