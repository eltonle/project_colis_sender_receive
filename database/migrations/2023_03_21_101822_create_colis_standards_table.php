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
        Schema::create('colis_standards', function (Blueprint $table) {
            $table->id();
        
            $table->string('titre');    
            $table->double('longueur')->nullable();    
            $table->double('largeur')->nullable();    
            $table->double('hauteur')->nullable();     
            $table->string('nature')->nullable();    
            $table->string('type')->nullable();    
            $table->string('capacite')->nullable();     
            $table->integer('prix');    
            $table->string('description')->nullable();    
            $table->string('status')->default('0');    

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
        Schema::dropIfExists('colis_standards');
    }
};
