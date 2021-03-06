<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSalaryContractsTable extends Migration
{
    public function up()
    {
        Schema::table('salary_contracts', function (Blueprint $table) {
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id', 'doctor_fk_4987489')->references('id')->on('doctors');
        });
    }
}
