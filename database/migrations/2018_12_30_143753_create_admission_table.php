<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admission', function (Blueprint $table) {
            $table->bigIncrements('id_admission')->bigInteger();
            $table->string('name');
            $table->string('password');
            $table->string('avatar')->default("");
            $table->string('active_key');
            $table->string('date_create');
            $table->string('mobile')->unique();
            $table->boolean('active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admission');
    }
}
