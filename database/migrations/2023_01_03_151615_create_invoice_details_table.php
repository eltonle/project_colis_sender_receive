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
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('invoice_id');

            $table->integer('code_zip')->nullable();
            $table->integer('charge')->nullable();
            $table->integer('decharge')->nullable();
            $table->integer('vehicule_id')->nullable();
            $table->integer('entrepot_id')->nullable();
            $table->integer('conteneur_id')->nullable();
            $table->boolean('status')->default('0');

            $table->string('model_marque')->nullable();
            $table->string('description_colis')->nullable();
            $table->string('chassis')->nullable();
            $table->string('longueur')->nullable();
            $table->string('largeur')->nullable();
            $table->string('hauteur')->nullable();
            $table->double('qty')->nullable();
            $table->double('unit_price')->nullable();
            $table->double('item_total')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('invoice_details');
    }
};
