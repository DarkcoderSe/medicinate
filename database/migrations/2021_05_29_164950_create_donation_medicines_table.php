<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_medicines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('donation_id');
            $table->string('name');
            $table->string('ndc')->nullable()->comment('National Drug Code');
            $table->date('expire_date')->nullable();
            $table->integer('quantity')->default(1);
            $table->string('quantity_type')->nullable();
            $table->foreignId('nhs_id')
                ->constrained();
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
        Schema::dropIfExists('donation_medicines');
    }
}
