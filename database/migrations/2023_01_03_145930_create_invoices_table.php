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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no');
            $table->string('invoice_zip');
            $table->integer('unit_id');
            $table->integer('country_id');
            $table->integer('state_id');
            $table->integer('countryr_id');
            $table->integer('stater_id');
            $table->string('status_livraison');
            $table->date('date');
            $table->longText('description')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0=pending,1=Approve');
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
        Schema::dropIfExists('invoices');
    }
};
