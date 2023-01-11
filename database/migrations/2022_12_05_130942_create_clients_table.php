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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('client_number');
            $table->string('name');
            $table->string('firstname'); 
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->string('country_id')->nullable();
            $table->string('state_id')->nullable();
            $table->string('city_id')->nullable();
            $table->string('sub_total')->nullable();
            $table->string('tax_1')->nullable(); 
            $table->string('discount')->nullable();
            $table->string('grand_total')->nullable();
            $table->string('description')->nullable();
            $table->string('status_livraison');
            $table->integer('unit_id');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('clients');
    }
};
