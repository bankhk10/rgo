<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('imports', function (Blueprint $table) {
            $table->id();
            $table->string('company')->nullable();
            $table->string('registration_number')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('hazardous_name_th')->nullable();
            $table->string('hazardous_name_en')->nullable();
            $table->string('percentage_formula')->nullable();
            $table->string('trade_name')->nullable();
            $table->string('manufacturer_source')->nullable();
            $table->string('supplier')->nullable();
            $table->string('license_number')->nullable();
            $table->integer('import_quantity')->nullable();
            $table->integer('remaining_quantity')->nullable();
            $table->date('shelf_life')->nullable();
            $table->string('package_size')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imports');
    }
};
