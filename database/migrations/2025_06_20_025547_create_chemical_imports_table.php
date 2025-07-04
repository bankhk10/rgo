<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChemicalImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chemical_imports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')
                ->nullable()
                ->constrained('companies')
                ->onDelete('set null');

            $table->string('registration_no')->nullable();         // เลขที่ทะเบียน
            $table->date('expiry_date')->nullable();               // วันหมดอายุ
            $table->string('chemical_name_th')->nullable();        // ชื่อวัตถุอันตราย (ไทย)
            $table->string('chemical_name_en')->nullable();        // ชื่อวัตถุอันตราย (อังกฤษ)
            $table->string('formula')->nullable();                 // % และสูตร
            $table->string('trade_name')->nullable();              // ชื่อการค้า
            $table->string('manufacturer')->nullable();            // ผู้ผลิต
            $table->string('supplier')->nullable();                // ผู้จำหน่าย
            $table->string('license_no')->nullable();              // ใบอนุญาต
            $table->string('store_company_1')->nullable(); // ชื่อบริษัทที่เก็บรักษาผลิตภัณฑ์ 1
            $table->string('store_company_2')->nullable(); // ชื่อบริษัทที่เก็บรักษาผลิตภัณฑ์ 2
            $table->double('import_quantity')->nullable();         // ปริมาณนำเข้า
            $table->string('remaining_quantity')->nullable();      // ปริมาณคงเหลือ
            $table->date('second_expiry_date')->nullable();        // วันหมดอายุ (สำรอง)
            $table->string('possession_form_wo2')->nullable(); // ใบแจ้งครอบครอง วอ.2
            $table->date('possession_form_expiry')->nullable(); // วันหมดอายุใบแจ้งครอบครอง วอ.2
            $table->text('packaging')->nullable();                 // รายละเอียดขนาดบรรจุ
            $table->text('status')->nullable();                 // normal expired soon_expired
            $table->text('remarks')->nullable();                      // หมายเหตุ
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
        Schema::dropIfExists('chemical_imports');
    }
}
