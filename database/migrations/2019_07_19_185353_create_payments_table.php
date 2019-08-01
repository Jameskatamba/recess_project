<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('paymentId');
            
            $table->double('plainAgents')->nullable();
            $table->double('AgentsHeadOfPlain')->nullable();
            $table->double('AgentsHeadOfHigh')->nullable();
            $table->double('Admin')->nullable();
            $table->double('available')->nullable();
            $table->double('payable')->nullable();
            
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
        Schema::dropIfExists('payments');
    }
}
