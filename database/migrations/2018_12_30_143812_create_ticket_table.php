<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket', function (Blueprint $table) {
            $table->bigIncrements('id_ticket')->bigInteger();
            $table->string('ticket_name');
            $table->string('ticket_code')->unique();
            $table->string('valid_from');
            $table->string('valid_to');
            $table->string('ticket_type');
            $table->string('date_create');
            $table->integer('times_used')->default(0); 
            $table->integer('limit');
            $table->boolean('active')->default(1);
            $table->string('state')->default("outside");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket');
    }
}
