<?php

namespace App\Imports;

use App\Models\ChemicalImport;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ChemicalImportsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // dd($row); // Uncomment บรรทัดนี้เพื่อตรวจสอบข้อมูลที่อ่านได้จาก Excel

        $parseDate = function ($dateValue) {
            if (is_numeric($dateValue) && $dateValue > 0) {
                try {
                    return Carbon::createFromTimestamp(Date::excelToTimestamp($dateValue))->toDateString();
                } catch (\Exception $e) {
                    return null;
                }
            } elseif (is_string($dateValue) && !empty($dateValue)) {
                try {
                    return Carbon::parse($dateValue)->toDateString();
                } catch (\Exception $e) {
                    return null;
                }
            }
            return null;
        };

        // ตรวจสอบชื่อคอลัมน์ใน $row[] ให้ตรงกับชื่อหัวข้อในไฟล์ Excel ของคุณ
        // และตรวจสอบว่าตรงกับฟิลด์ใน migration ด้วย

        // ตัวอย่างการแมปข้อมูล (ปรับคีย์ให้ตรงกับหัวข้อใน Excel ของคุณ)
        return new ChemicalImport([
            'company_id'          =>  $row['company_id'] ?? null, // คุณต้องมีคอลัมน์ company_id ใน Excel หรือหา id จากชื่อบริษัท
            'registration_no'     => $row['registration_no'] ?? null,
            'expiry_date'         => $parseDate($row['expiry_date'] ?? null),
            'chemical_name_th'    => $row['chemical_name_th'] ?? null,
            'chemical_name_en'    => $row['chemical_name_en'] ?? null,
            'formula'             => $row['formula'] ?? null,
            'trade_name'          => $row['trade_name'] ?? null,
            'manufacturer'        => $row['manufacturer'] ?? null,
            'supplier'            => $row['supplier'] ?? null,
            'license_no'          => $row['license_no'] ?? null,
            'import_quantity'     => $row['import_quantity'] ?? null,
            'remaining_quantity'  => $row['remaining_quantity'] ?? null,
            'second_expiry_date'  => $parseDate($row['second_expiry_date'] ?? null),
            'packaging'           => $row['packaging'] ?? null,
            'remarks'              => $row['note'] ?? null,
            'store_company_1'   => $row['store_company_1'] ?? null,
            'store_company_2'  => $row['store_company_2'] ?? null,
            'possession_form_wo2' => $row['possession_form_wo2'] ?? null,
            'possession_form_expiry' => $parseDate($row['possession_form_expiry'] ?? null),
        ]);
    }

    public function headingRow(): int
    {
        return 1; // ให้แพ็กเกจใช้แถวแรกเป็นชื่อคอลัมน์
    }
}
