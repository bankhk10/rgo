<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            //
            $table->string('common_name_eng')->nullable();
            $table->string('percent_formula')->nullable();
            $table->string('trade_name')->nullable();
            $table->string('registrant')->nullable();
            $table->string('distributor')->nullable();
            $table->string('importer')->nullable();
            $table->string('trial_summary')->nullable();
            $table->string('crop')->nullable();
            $table->string('pest')->nullable();
            $table->string('protocol_sent')->nullable();
            $table->string('protocol_inspector_status')->nullable();
            $table->string('protocol_approved')->nullable();
            $table->string('efficacy_report_sent')->nullable();
            $table->string('efficacy_status')->nullable();
            $table->string('efficacy_report_approval')->nullable();
            $table->string('efficacy_responsible_person')->nullable();
            $table->string('residue_protocol_sent')->nullable();
            $table->string('residue_protocol_inspector_status')->nullable();
            $table->string('residue_protocol_approved')->nullable();
            $table->string('residue_report_sent')->nullable();
            $table->string('residue_status')->nullable();
            $table->string('residue_report_approval')->nullable();
            $table->string('residue_responsible_person')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            //
        });
    }
}
