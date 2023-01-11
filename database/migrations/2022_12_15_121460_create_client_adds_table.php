<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_adds', function (Blueprint $table) {
            $table->id();
            $table->string('client_number');
            $table->string('model_marque');
            $table->string('chassis');
            $table->string('length');
            $table->string('width');
            $table->string('height');
            $table->string('unit_price');
            $table->string('qty');
            $table->string('item_total');
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
        Schema::dropIfExists('client_adds');
    }
};
