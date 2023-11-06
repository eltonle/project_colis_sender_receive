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
        Schema::create('historique_colis_conteneurs', function (Blueprint $table) {
            $table->id();
            $table->integer('colis_id'); 
            $table->integer('unit_id');
            $table->string('status');
            $table->date('date_action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historique_colis_conteneurs');
    }
};
