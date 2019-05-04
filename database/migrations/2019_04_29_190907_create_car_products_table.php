<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('carname')->nullable();
            $table->string('price')->nullable();
            $table->string('description')->nullable();
            $table->text('thumbnail')->nullable();
            $table->text('photos')->nullable();
            $table->string('vin')->nullable();
            $table->string('model')->nullable();
            $table->string('year')->nullable();
            $table->string('make')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('type')->nullable();
            $table->string('engine')->nullable();
            $table->string('transmission')->nullable();
            $table->string('body')->nullable();
            $table->string('miles')->nullable();
            $table->string('fueltype')->nullable();
            $table->string('interiorcolor')->nullable();
            $table->string('exteriorcolor')->nullable();
            $table->string('drivetrain')->nullable();
            $table->string('steeringlocation')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('car_products');
    }
}
