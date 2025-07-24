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
                'full_name' => 'บริษัท บีเฟค อินเตอร์ จำกัด',
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
            ['name' => '-', 'full_name' => 'ครอป อะกริเทค บจก.', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'คิว แม็กซ์ อะโกรเทค บจก.', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'เคโมฟายล์ บจก.', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'เคยู 35 เคมีเกษตร บจก.', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'ซาธิวา (ไทย) บจก.', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'ซีอีโอ อะกริเทค บจก.', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'โซตัส อินเตอร์เนชั่นแนล บจก.', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'ดอกเตอร์เกษตร บจก.', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'ที.พี ฟาร์มเมอร์ บจก.', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'ไท อโกรซายน์ 6162 บจก.', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'บี เค อะโกร บจก.', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'ฟาร์มอะโกร หจก.', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'ฟิวเจอร์อโกรเคมีคอล บจก.', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'โฟโต้กรีน เคมีคอล บจก.', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'เมืองทองการเกษตร บจก.', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'ยูนิไลฟ์ อินเตอร์เนชั่นแนล บจก.', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'รังสิพรรณ อินเตอร์เทรด บจก.', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'รีชฮันเตอร์ บจก.', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'วี ไอ วี อินเตอร์เคม บจก.', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'สหภัณฑ์ส่งเสริมการเกษตร บจก.', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'สิงห์เจ้าพระยา บจก.', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'เฮลตี้ แคร์ บจก.', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'ธันย์สตาร์ 2557 บจก.', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'ฟรีมาร์เก็ต อโกร บจก.', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'มิตรสมบูรณ์ บจก.', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'ไทยเบสท์โฮลดิ้ง บจก.', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'นายเกษตร บจก.', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '-', 'full_name' => 'บีแฟค อินเตอร์ บจก.', 'address' => null, 'email' => null, 'phone' => null, 'tax_id' => null, 'type' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
