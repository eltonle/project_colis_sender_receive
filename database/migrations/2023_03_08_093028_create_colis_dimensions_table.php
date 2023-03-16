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
        Schema::create('colis_dimensions', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_id')->nullable();
            $table->boolean('status')->default('0');
            $table->string('titre');
            $table->integer('quantite');
            $table->double('largeur');
            $table->double('conversion');
            $table->double('longueur');
            $table->double('hauteur');
            $table->double('poids');
            $table->double('prix_kilo');
            $table->double('prix_vol');
            $table->integer('prix');
            $table->integer('total');
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
        Schema::dropIfExists('colis_dimensions');
    }
};
