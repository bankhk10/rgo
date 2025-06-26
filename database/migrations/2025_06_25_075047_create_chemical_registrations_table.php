<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChemicalRegistrationsTable extends Migration
{
    public function up(): void
    {
        Schema::create('chemical_registrations', function (Blueprint $table) {
            $table->id();
            $table->integer('chemical_imports_id')->nullable(); // Foreign key to chemical_imports table
            $table->string('registration_number')->nullable(); // เลขที่ทะเบียนผลิต
            $table->date('registration_expiry_date')->nullable(); // วันหมดอายุทะเบียน
            $table->string('chemical_name_th')->nullable(); // ชื่อวัตถุอันตราย (ไทย)
            $table->string('chemical_name_en')->nullable(); // ชื่อวัตถุอันตราย (อังกฤษ)
            $table->text('composition')->nullable(); // % และสูตร
            $table->string('manufacturer')->nullable(); // ผู้ผลิตและแหล่งผลิต
            $table->string('registrant')->nullable(); // ผู้ขึ้นทะเบียน
            $table->string('registration_type')->nullable(); // ประเภททะเบียน
            $table->string('importer')->nullable(); // ผู้นำเข้า
            $table->string('distributor')->nullable(); // ผู้จำหน่าย
            $table->string('trade_name')->nullable(); // ชื่อการค้า
            $table->string('trade_name_at')->nullable(); // ชื่อการค้าที่
            $table->string('production_license_number')->nullable(); // เลขที่ใบอนุญาตผลิต
            $table->date('production_license_expiry')->nullable(); // วันหมดอายุใบอนุญาต
            $table->string('production_license_quantity')->nullable(); // ปริมาณผลิตใบอนุญาต
            $table->string('possession_form_wo2')->nullable(); // ใบแจ้งครอบครอง วอ.2
            $table->date('possession_form_expiry')->nullable(); // วันหมดอายุใบแจ้งครอบครอง วอ.2
            $table->date('application_received_date')->nullable(); // วันที่รับคำขอ
            $table->string('expired_license_number')->nullable(); // เลขที่ใบอนุญาตหมดอายุ
            $table->date('expired_at')->nullable(); // หมดอายุเมื่อ
            $table->string('old_license_quantity')->nullable(); // ปริมาณผลิตใบอนุญาตเดิม
            $table->string('packaging_size')->nullable(); // ขนาดบรรจุ
            $table->text('remarks')->nullable(); // หมายเหตุ
            $table->boolean('new_or_old')->default(true); // สถานะของข้อมูล (true = ใหม่, false = เก่า)
            $table->string('step')->nullable(); // ขั้นตอนการขึ้นทะเบียน เช่น 'initial', 'review', 'approval'
            $table->string('chemical_type')->nullable(); // ประเภทของวัตถุอันตราย เช่น สารเคมี, ยาฆ่าแมลง, ปุ๋
            $table->string('company')->nullable(); // ชื่อบริษัทที่ผลิตผลิตภัณฑ์
            $table->string('store_company')->nullable(); // ชื่อบริษัทที่เก็บรักษาผลิตภัณฑ์
            $table->string('status')->default('pending'); // สถานะของการขึ้นทะเบียนผลิตภัณฑ์ เช่น pending, approved, rejected
            $table->boolean('is_active')->default(true); // สถานะการใช้งานของผลิตภัณฑ์ (true = ใช้งาน, false = ไม่ใช้งาน)
            $table->boolean('is_deleted')->default(false); // สถานะการลบของผลิตภัณฑ์ (true = ถูกลบ, false = ไม่ถูกลบ)
            $table->string('image')->nullable(); // ลิงก์หรือชื่อไฟล์ของภาพผลิตภัณฑ์
            $table->string('document')->nullable(); // ลิงก์หรือชื่อไฟล์ของเอกสารที่เกี่ยวข้องกับผลิตภัณฑ์
            $table->decimal('progress')->default(0)->comment('สถานะความคืบหน้าของการขึ้นทะเบียนผลิตภัณฑ์');
            $table->decimal('sub_progress')->default(0); // เพิ่มหลัง progress
            $table->string('created_by')->nullable(); // ผู้ที่สร้างข้อมูลการขึ้นทะเบียนผลิตภัณฑ์
            $table->string('updated_by')->nullable(); // ผู้ที่ปรับปรุงข้อมูลการขึ้นทะเบียนผลิตภัณฑ์
            $table->softDeletes(); // วันที่และเวลาที่ลบข้อมูลผลิตภัณฑ์ (ใช้สำหรับ soft delete)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chemical_registrations');
    }
}
