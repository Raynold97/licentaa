<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContinutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('continut', function (Blueprint $table) {
            $table->increments('id')->lenght(11);
            $table->dateTime('data')->nullable();
            $table->integer('idCategorie')->lenght(11)->nullable();
            $table->string('titlu')->lenght(256);
            $table->mediumText('descriere');
            $table->string('cover_image');
            $table->unsignedBigInteger('idUtilizator');
            $table->integer('idRating')->lenght(11)->nullable();
            $table->tinyInteger('verificat')->length(11)->nullable();
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
        Schema::dropIfExists('continut');
    }
}
