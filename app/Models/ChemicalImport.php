<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChemicalImport extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'registration_no',
        'expiry_date',
        'chemical_name_th',
        'chemical_name_en',
        'formula',
        'trade_name',
        'manufacturer',
        'supplier',
        'license_no',
        'store_company_1',
        'store_company_2',
        'import_quantity',
        'remaining_quantity',
        'second_expiry_date',
        'possession_form_wo2',
        'possession_form_expiry',
        'packaging',
        'remarks',
    ];

    // protected $casts = [
    //     'expiry_date' => 'date',
    //     'second_expiry_date' => 'date',
    //     'possession_form_expiry' => 'date',
    //     'import_quantity' => 'float',
    // ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
