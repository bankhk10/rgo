<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->integer('chemical_imports_id')->nullable(); // Foreign key to chemical_imports table
            $table->string('trade_name')->nullable(); // ชื่อทางการค้า
            $table->string('manufacturer_origin')->nullable(); // ชื่อผู้ผลิตและแหล่งผลิต
            $table->string('importer_name')->nullable(); // ชื่อผู้นำเข้า
            $table->string('distributor_name')->nullable(); // ชื่อผู้จำหน่าย/ผู้จัดจำหน่าย
            $table->string('purpose_and_type_of_use')->nullable(); // วัตถุประสงค์และประเภทของการใช้
            $table->string('packaging_type')->nullable(); // ชนิดและลักษณะหีบห่อหรือภาชนะบรรจุ
            $table->text('notes')->nullable(); // อื่นๆ (ระบุ) - ใช้ text สำหรับข้อความยาวๆ

            $table->string('name')->nullable()->comment('ชื่อผลิตภัณฑ์');
            $table->string('registration_number')->unique()->nullable()->comment('หมายเลขทะเบียนผลิตภัณฑ์');
            $table->date('registration_date')->nullable()->comment('วันที่ขึ้นทะเบียนผลิตภัณฑ์');
            $table->date('expiry_date')->nullable()->comment('วันหมดอายุของผลิตภัณฑ์');
            $table->decimal('progress')->default(0)->comment('สถานะความคืบหน้าของการขึ้นทะเบียนผลิตภัณฑ์');

            // $table->integer('progress')->default(0)->comment('สถานะความคืบหน้าของการขึ้นทะเบียนผลิตภัณฑ์');
            // $table->text('description')->nullable()->comment('คำอธิบายเกี่ยวกับผลิตภัณฑ์');
            $table->string('company')->nullable()->comment('ชื่อบริษัทที่ผลิตผลิตภัณฑ์');
            $table->string('status')->default('pending')->comment('สถานะของการขึ้นทะเบียนผลิตภัณฑ์ เช่น pending, approved, rejected');
            $table->boolean('is_active')->default(true)->comment('สถานะการใช้งานของผลิตภัณฑ์ (true = ใช้งาน, false = ไม่ใช้งาน)');
            $table->boolean('is_deleted')->default(false)->comment('สถานะการลบของผลิตภัณฑ์ (true = ถูกลบ, false = ไม่ถูกลบ)');
            $table->softDeletes()->comment('วันที่และเวลาที่ลบข้อมูลผลิตภัณฑ์ (ใช้สำหรับ soft delete)');
            $table->string('image')->nullable()->comment('ลิงก์หรือชื่อไฟล์ของภาพผลิตภัณฑ์');
            $table->string('document')->nullable()->comment('ลิงก์หรือชื่อไฟล์ของเอกสารที่เกี่ยวข้องกับผลิตภัณฑ์');
            $table->string('remarks')->nullable()->comment('หมายเหตุเพิ่มเติมเกี่ยวกับผลิตภัณฑ์');
            $table->boolean('new_or_old')->default(true)->comment('สถานะของข้อมูล (true = ใหม่, false = เก่า)');
            $table->string('created_by')->nullable()->comment('ผู้ที่สร้างข้อมูลการขึ้นทะเบียนผลิตภัณฑ์');
            $table->string('updated_by')->nullable()->comment('ผู้ที่ปรับปรุงข้อมูลการขึ้นทะเบียนผลิตภัณฑ์');
            $table->string('deleted_by')->nullable()->comment('ผู้ที่ลบข้อมูลการขึ้นทะเบียนผลิตภัณฑ์');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
