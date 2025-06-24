<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // ต้อง import ถ้าใช้ SoftDeletes

class Product extends Model
{
    use HasFactory, SoftDeletes; // เพิ่ม SoftDeletes trait เข้ามา

    /**
     * The table associated with the model.
     *
     * @var string
     */
    // กำหนดชื่อตารางที่ Model นี้จะเชื่อมโยงด้วย
    // หากชื่อตารางเป็น 'products' (พหูพจน์ของ Model Name) Laravel จะเดาให้เอง
    // แต่ในกรณีนี้คุณใช้ 'product' (เอกพจน์) จึงต้องระบุชัดเจน
    protected $table = 'product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // กำหนดคอลัมน์ที่คุณอนุญาตให้สามารถกำหนดค่าพร้อมกันได้ผ่าน Mass Assignment
    // นี่คือคอลัมน์ทั้งหมดจาก Migration ของคุณ (ยกเว้น 'id', 'created_at', 'updated_at', 'deleted_at')
    protected $fillable = [
        'chemical_imports_id',
        'trade_name',
        'manufacturer_origin',
        'importer_name',
        'distributor_name',
        'purpose_and_type_of_use',
        'packaging_type',
        'notes',
        'name',
        'registration_number',
        'registration_date',
        'expiry_date',
        'progress',
        'company',
        'status',
        'is_active',
        'is_deleted',
        'image',
        'document',
        'remarks',
        'new_or_old',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // กำหนดการแปลงประเภทข้อมูลสำหรับคอลัมน์บางคอลัมน์อัตโนมัติ
    protected $casts = [
        'registration_date' => 'date',
        'expiry_date' => 'date',
        'progress' => 'decimal:2', // คุณเปลี่ยน progress เป็น decimal ใน Migration, ตรงนี้ต้องระบุ decimal places ด้วย
        'is_active' => 'boolean',
        'is_deleted' => 'boolean',
        'new_or_old' => 'boolean',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // คุณสามารถเพิ่มคอลัมน์ที่คุณไม่ต้องการให้แสดงเมื่อแปลง Model เป็น Array/JSON ที่นี่
    // เช่น 'password', 'remember_token' เป็นต้น (ไม่น่าจะใช้กับตารางนี้)
    protected $hidden = [
        // 'password',
    ];

    // คุณสามารถเพิ่มความสัมพันธ์ (Relationships) ของ Eloquent ได้ที่นี่
    // เช่น ถ้ามีตาราง 'chemical_imports'
    public function chemicalImport()
    {
        return $this->belongsTo(ChemicalImport::class, 'chemical_imports_id');
    }

    public function progressSteps()
    {
        return $this->hasMany(DrugProgressStep::class);
    }

    // public function stepSubSteps($stepNumber)
    // {
    //     return $this->progressSteps()->where('step_number', $stepNumber);
    // }

    public function stepSubSteps($stepNumber)
    {
        return $this->hasMany(DrugProgressStep::class, 'product_id')
            ->where('step_number', $stepNumber);
    }
    // หรือเมธอดอื่นๆ ที่เกี่ยวข้องกับ Product
}
