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
        Schema::create('colis_prices', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_id')->nullable();
            $table->boolean('status')->default('0');
            $table->string('titre');
            $table->integer('qty');
            $table->integer('prix');
            $table->integer('prix_unit');
            $table->integer('prix_total');
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
        Schema::dropIfExists('colis_prices');
    }
};
