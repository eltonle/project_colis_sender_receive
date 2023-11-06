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
        Schema::create('historique_colis_entrepots', function (Blueprint $table) {
            $table->id();
            $table->integer('colis_id');
            $table->integer('entrepot_depart_id');
            $table->integer('entrepot_arrive_id');
            $table->date('date_action');
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
        Schema::dropIfExists('historique_colis_entrepots');
    }
};
