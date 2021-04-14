<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ZApplyForeignkey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::table('continut', function (Blueprint $table) {
           $table->foreign('idUtilizator')->references('id')->on('users')->onDelete('cascade');;
        });

        Schema::table('key', function (Blueprint $table) {
            $table->foreign('continut_id')->references('id')->on('continut')->onDelete('cascade');;
         });

         Schema::table('categoriicontinut', function (Blueprint $table) {
            $table->foreign('continut_id')->references('id')->on('continut')->onDelete('cascade');;
            $table->foreign('categorii_id')->references('id')->on('categorii')->onDelete('cascade');;
         });

        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('commenter_id')->references('id')->on('users')->onDelete('cascade');;
            $table->foreign('child_id')->references('id')->on('users')->references('id')->on('comments')->onDelete('cascade');;
            // $table->foreign('child_id')->references('id')->on('comments')->onDelete('cascade');;
         });

        //   Schema::table('comments', function (Blueprint $table) {
        //  $table->foreign('child_id')->references('id')->on('users')->onDelete('cascade');;
        //   });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
