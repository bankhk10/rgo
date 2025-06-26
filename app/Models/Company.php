<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'full_name',
        'address',
        'email',
        'phone',
        'tax_id',
    ];

    // ความสัมพันธ์: 1 บริษัท -> มีหลาย chemical import
    public function chemicalImports()
    {
        return $this->hasMany(ChemicalImport::class);
    }
}
