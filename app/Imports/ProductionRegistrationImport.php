<?php

namespace App\Imports;

use App\Models\ProductionRegistration;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Log;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ProductionRegistrationImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
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

        return new ProductionRegistration([
            'company_id'          =>  $row['company_id'] ?? null, // คุณต้องมีคอลัมน์ company_id ใน Excel หรือหา id จากชื่อบริษัท
            'registration_number'           => $row['registration_number'] ?? null,
            'expired_license_date'          => $parseDate($row['expired_license_date'] ?? null),
            'chemical_name_th'              => $row['chemical_name_th'] ?? null,
            'chemical_name_en'              => $row['chemical_name_en'] ?? null,
            'composition'                   => $row['composition'] ?? null,
            'manufacturer'                  => $row['manufacturer'] ?? null,
            'registrant'                    => $row['registrant'] ?? null,
            'registration_type'             => $row['registration_type'] ?? null,
            'importer'                      => $row['importer'] ?? null,
            'distributor'                   => $row['distributor'] ?? null,
            'trade_name'                    => $row['trade_name'] ?? null,
            'trade_name_at'                 => $row['trade_name_at'] ?? null,
            'type_production_registration'  => $row['type_production_registration'] ?? null,
            'usage_production_registration' => $row['usage_production_registration'] ?? null,
            'group_of_substances'           => $row['group_of_substances'] ?? null,
            'plant'                         => $row['plant'] ?? null,
            'pests'                         => $row['pests'] ?? null,
            'production_license_number'     => $row['production_license_number'] ?? null,
            'production_license_expiry'     => $parseDate($row['production_license_expiry'] ?? null),
            'production_license_quantity'   => $row['production_license_quantity'] ?? null,
            'possession_form_wo2'           => $row['possession_form_wo2'] ?? null,
            'possession_form_expiry'        => $parseDate($row['possession_form_expiry'] ?? null),
            'packaging_size_details'        => $row['packaging_size_details'] ?? null,
            'registration_number_pass'      => $row['registration_number_pass'] ?? null,
            'expired_at'                    => $parseDate($row['expired_at'] ?? null),
        ]);
    }


    public function headingRow(): int
    {
        return 1; // ให้แพ็กเกจใช้แถวแรกเป็นชื่อคอลัมน์
    }
}
