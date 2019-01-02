<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmissionHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admission_history', function (Blueprint $table) {
            $table->bigIncrements('id_history')->bigInteger();
            $table->integer('type');
            $table->string('id_gate');
            $table->string('date_create');
            $table->integer('id_admission'); 
            $table->integer('id_ticket'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admission_history');
    }
}
