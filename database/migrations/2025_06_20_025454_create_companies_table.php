<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();  // ชื่อบริษัท
            $table->string('full_name')->nullable();    // ชื่อบริษัท
            $table->string('address')->nullable(); // ที่อยู่
            $table->string('email')->nullable();   // อีเมล
            $table->string('phone')->nullable();   // เบอร์โทร
            $table->string('tax_id')->nullable();  // เลขผู้เสียภาษี
            $table->integer('type')->nullable();  // ประเภทบริษัท (1 = ผู้ผลิต, 2 = ผู้นำเข้า, 3 = ผู้จำหน่าย, 4 = อื่นๆ)
            $table->timestamps();                  // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
