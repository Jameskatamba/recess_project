<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
           $table->bigIncrements('AgentId');
           $table->string('firstName');
           $table->string('lastName');
           $table->string('email'); 
           $table->string('agentSignature');
           $table->string('gender');
           $table->unsignedBigInteger('District_id');
           $table->foreign('District_id')->references('DistrictId')->on('districts');
          
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
        Schema::dropIfExists('agents');
    }
}
