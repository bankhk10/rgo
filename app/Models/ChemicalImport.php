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
        'import_quantity',
        'remaining_quantity',
        'second_expiry_date',
        'packaging',
        'note',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}
