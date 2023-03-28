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

            $table->string('code_zip')->nullable();
            $table->integer('charge')->nullable();
            $table->integer('decharge')->nullable();
            $table->integer('vehicule_id')->nullable();
            $table->integer('entrepot_id')->nullable();
            $table->integer('conteneur_id')->nullable();
            
            $table->string('titre');
            // $table->integer('quantite');
            $table->double('largeur')->nullable();
            $table->double('conversion')->nullable();
            $table->double('longueur')->nullable();
            $table->double('hauteur')->nullable();
            $table->double('poids')->nullable();
            $table->double('prix_kilo')->nullable();
            $table->double('prix_vol')->nullable();
            $table->string('type');
            $table->integer('prix');
            // $table->integer('total');
            $table->string('description')->nullable();
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
