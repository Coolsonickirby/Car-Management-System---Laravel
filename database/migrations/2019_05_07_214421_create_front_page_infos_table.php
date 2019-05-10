<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrontPageInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('front_page_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->text('frontimages')->nullable();
            $table->text('frontdescription')->nullable();
            $table->text('aboutimages')->nullable();
            $table->text('aboutdescription')->nullable();
            $table->text('contactemail')->nullable();
            $table->text('contactphone')->nullable();
            $table->text('contactaddress')->nullable();
            $table->text('Main')->nullable();
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
        Schema::dropIfExists('front_page_infos');
    }
}
