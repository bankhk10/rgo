<?php

namespace App\Imports;

use App\Models\ProductionRegistration;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;

class ProductionRegistrationImport implements ToModel
{
    public function model(array $row)
    {
        // ข้าม header row
        if ($row[0] === 'registration_number') {
            return null;
        }

        return new ProductionRegistration([
            'registration_number' => $row[0],
            'expired_license_date' => $this->toDate($row[1]),
            'chemical_name_th' => $row[2],
            'chemical_name_en' => $row[3],
            'composition' => $row[4],
            'manufacturer' => $row[5],
            'registrant' => $row[6],
            'registration_type' => $row[7],
            'importer' => $row[8],
            'distributor' => $row[9],
            'trade_name' => $row[10],
            'trade_name_at' => $row[11],
            'type_production_registration' => $row[12],
            'usage_production_registration' => $row[13],
            'group_of_substances' => $row[14],
            'plant' => $row[15],
            'pests' => $row[16],
            'production_license_number' => $row[17],
            'production_license_expiry' => $this->toDate($row[18]),
            'production_license_quantity' => $row[19],
            'possession_form_wo2' => $row[20],
            'possession_form_expiry' => $this->toDate($row[21]),
            'packaging_size_details' => $row[22],
            'registration_number_pass' => $row[23],
            'registration_expiry_date' => $this->toDate($row[24]),
            'expired_at' => $this->toDate($row[25]),
            'status_date' => $row[26],
            'remarks' => $row[27],
            'new_or_old' => $row[28] === 'ใหม่' ? true : false,
            'step' => $row[29],
            'status' => $row[30] ?? 'pending',
            'is_active' => $row[31] === '1' ? true : false,
            'is_deleted' => $row[32] === '1' ? true : false,
            'image' => $row[33],
            'document' => $row[34],
            'progress' => (float) $row[35],
            'sub_progress' => (float) $row[36],
            'created_by' => $row[37],
            'updated_by' => $row[38],
        ]);
    }

    private function toDate($value)
    {
        try {
            return $value ? Carbon::parse($value) : null;
        } catch (\Exception $e) {
            return null;
        }
    }
}
