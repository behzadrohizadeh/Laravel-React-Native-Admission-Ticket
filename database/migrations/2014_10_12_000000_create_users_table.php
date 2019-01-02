<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->bigInteger();
            $table->string('name');
            $table->string('password');
            $table->string('email')->unique();
            $table->string('avatar')->default("");
            $table->string('active_key');
            $table->string('date_create');
            $table->integer('id_role'); 
            $table->string('mobile');
            $table->boolean('active')->default(0);
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
