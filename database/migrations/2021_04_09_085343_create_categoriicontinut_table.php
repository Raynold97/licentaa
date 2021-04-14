<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriicontinutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoriicontinut', function (Blueprint $table) {
            $table->integer('categorii_id')->unsigned();
            $table->integer('continut_id')->unsigned();
            $table->primary(['categorii_id', 'continut_id']);
            $table->foreign('categorii_id')->references('id')->on('categorii')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('continut_id')->references('id')->on('continut')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categoriicontinut');
    }
}
