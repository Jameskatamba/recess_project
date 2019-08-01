<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentHeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_heads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('AgentHeadId')->nullable();
            $table->unsignedbigInteger('DistrictId')->nullable();
            $table->timestamps();
            $table->foreign('AgentHeadId')->references('AgentId')->on('agents');
            $table->foreign('DistrictId')->references('DistrictId')->on('districts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agent_heads');
    }
}
