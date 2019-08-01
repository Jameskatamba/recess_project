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
           $table->string('firstName')->nullable();
           $table->string('lastName')->nullable();
           $table->string('email')->nullable();
           $table->char('agentSignature')->nullable();
           $table->unsignedBigInteger('districtId')->nullable();
           $table->string('gender')->nullable();
           $table->BigInteger('payment')->nullable();
           $table->timestamps();
           $table->foreign('districtId')->references('DistrictId')->on('districts');
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
