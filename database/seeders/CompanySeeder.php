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
                'address' => '123 ถนนสุขุมวิท, แขวงคลองเตย, เขตคลองเตย, กรุงเทพมหานคร 10110',
                'email' => 'info@example.com',
                'phone' => '02-123-4567',
                'tax_id' => '0105555000001',
                'type' => 1, // ผู้ผลิต
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'AI',
                'full_name' => 'บริษัท แอ็กโฟรีแพ็กซ์อินดัสตรีส์ จำกัด',
                'address' => '456 ถนนสีลม, แขวงสีลม, เขตบางรัก, กรุงเทพมหานคร 10500',
                'email' => 'contact@importer.com',
                'phone' => '02-789-0123',
                'tax_id' => '0105555000002',
                'type' => 2, // ผู้นำเข้า
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'UP',
                'full_name' => 'บริษัท ยูนิพรีมา จำกัด',
                'address' => '789 ถนนพหลโยธิน, แขวงจตุจักร, เขตจตุจักร, กรุงเทพมหานคร 10900',
                'email' => 'sales@abcshop.com',
                'phone' => '02-345-6789',
                'tax_id' => '0105555000003',
                'type' => 3, // ผู้จำหน่าย
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
                 [
                'name' => 'CS',
                'full_name' => 'บริษัท คร็อพ ซายน์ จำกัด',
                'address' => '789 ถนนพหลโยธิน, แขวงจตุจักร, เขตจตุจักร, กรุงเทพมหานคร 10900',
                'email' => 'sales@abcshop.com',
                'phone' => '02-345-6789',
                'tax_id' => '0105555000003',
                'type' => 3, // ผู้จำหน่าย
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
