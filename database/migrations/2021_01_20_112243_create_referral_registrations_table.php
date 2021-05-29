<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ref_id')->constrained('users');
            $table->foreignId('user_id')->constrained('users');
            $table->integer('status')->default(0);
            $table->bigInteger('ref_received_coins')->default(0);
            $table->bigInteger('user_received_coins')->default(0);
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
        Schema::dropIfExists('referral_registrations');
    }
}
