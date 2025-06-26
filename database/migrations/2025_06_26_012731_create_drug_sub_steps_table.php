<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugSubStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drug_progress_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chemical_registrations_id');
            $table->unsignedTinyInteger('step_number');     // ขั้นตอนที่ 1-8
            $table->unsignedTinyInteger('sub_step_index');  // หัวข้อย่อยที่ 0-3
            $table->string('sub_step_label');               // ชื่อหัวข้อย่อย เช่น "พิจารณาเบื้องต้น"
            $table->string('department')->nullable();
            $table->timestamp('checked_at')->nullable();    // เวลาเลือก
            $table->string('created_by')->nullable(); // ผู้ที่สร้างข้อมูลการขึ้นทะเบียนผลิตภัณฑ์
            $table->string('updated_by')->nullable(); // ผู้ที่ปรับปรุงข้อมูลการขึ้นทะเบียนผลิตภัณฑ์
            $table->softDeletes(); // วันที่และเวลาที่ลบข้อมูลผลิตภัณฑ์ (ใช้สำหรับ soft delete)
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
        Schema::dropIfExists('drug_progress_steps');
    }
}
