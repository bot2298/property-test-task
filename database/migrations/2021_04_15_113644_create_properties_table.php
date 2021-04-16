<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->float('price', 8, 2, true)->default(0);
            $table->tinyInteger('bedrooms')->default(0);
            $table->tinyInteger('bathrooms')->default(0);
            $table->tinyInteger('storeys')->default(0);
            $table->tinyInteger('garages')->default(0);
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
        Schema::dropIfExists('properties');
    }
}
