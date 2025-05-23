<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    use HasFactory;

    protected $fillable = [
        'company',
        'registration_number',
        'expiry_date',
        'hazardous_name_th',
        'hazardous_name_en',
        'percentage_formula',
        'trade_name',
        'manufacturer_source',
        'supplier',
        'license_number',
        'import_quantity',
        'remaining_quantity',
        'shelf_life',
        'package_size',
        'note',
    ];
}
