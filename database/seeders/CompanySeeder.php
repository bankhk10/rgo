<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
                'name' => 'CS',
                'full_name' => 'บริษัท คร็อพ ซายน์ จำกัด',
                'address' => ' 22 ICG Building ถ.พระรามที่ 6 แขวงพญาไท เขตพญาไท กรุงเทพมหานคร 10400',
                'email' => 'cs.cropsciences@gmail.com',
                'phone' => '02-618-4522',
                'tax_id' => '0105542089762',
                'type' => 2, // ผู้จำหน่าย
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
        ]);
    }
}
