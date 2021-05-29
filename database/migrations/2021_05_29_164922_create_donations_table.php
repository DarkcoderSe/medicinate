<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_not_controlled_substance')->default(false);
            $table->boolean('not_expire_in_5_month')->default(false);
            $table->boolean('sealed_packaging')->default(false);
            $table->boolean('not_require_refrigeration')->default(false);
            $table->boolean('shipping_paid')->default(false);


            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->boolean('is_guest')->default(true);
            $table->unsignedBigInteger('user_id')->nullable();

            $table->integer('donation_weight')->default(0);
            $table->string('donation_weight_standard')->default(0);

            $table->string('expected_cost')->nullable();

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
        Schema::dropIfExists('donations');
    }
}
