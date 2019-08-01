<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminpaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adminpays', function (Blueprint $table) {
            $table->bigIncrements('PayId');
            $table->unsignedbigInteger('AdminId')->nullable();
            $table->double('Payment')->nullable();
            $table->foreign('AdminId')->references('id')->on('users');
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
        Schema::dropIfExists('adminpays');
    }
}
