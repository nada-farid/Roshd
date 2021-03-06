<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEducationTable extends Migration
{
    public function up()
    {
        Schema::table('education', function (Blueprint $table) {
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id', 'doctor_fk_4989186')->references('id')->on('doctors');
            $table->unsignedBigInteger('degree_id')->nullable();
            $table->foreign('degree_id', 'degree_fk_6406399')->references('id')->on('types_of_degrees');
        });
    }
}
