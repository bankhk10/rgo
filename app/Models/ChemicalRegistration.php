<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChemicalRegistration extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'chemical_imports_id',
        'registration_number',
        'registration_expiry_date',
        'chemical_name_th',
        'chemical_name_en',
        'composition',
        'manufacturer',
        'registrant',
        'registration_type',
        'importer',
        'distributor',
        'trade_name',
        'trade_name_at',
        'production_license_number',
        'production_license_expiry',
        'production_license_quantity',
        'possession_form_wo2',
        'possession_form_expiry',
        'application_received_date',
        'expired_license_number',
        'expired_at',
        'old_license_quantity',
        'packaging_size',
        'remarks',
        'new_or_old',
        'step',
        'chemical_type',
        'company',
        'store_company',
        'status',
        'is_active',
        'is_deleted',
        'image',
        'document',
        'progress',
        'sub_progress',
        'created_by',
        'updated_by',
    ];

    // Optional: สำหรับวันที่ที่เป็น Carbon instance เช่น soft delete, timestamps
    protected $dates = [
        'registration_expiry_date',
        'production_license_expiry',
        'possession_form_expiry',
        'application_received_date',
        'expired_at',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    // Optional: ความสัมพันธ์กับตารางอื่น (ถ้า chemical_imports มี model)
    public function chemicalImport()
    {
        return $this->belongsTo(ChemicalImport::class, 'chemical_imports_id');
    }

    public function progressSteps()
    {
        return $this->hasMany(DrugProgressStep::class);
    }

    public function stepSubSteps($stepNumber)
    {
        return $this->hasMany(DrugProgressStep::class, 'chemical_registrations_id')
            ->where('step_number', $stepNumber);
    }
}
