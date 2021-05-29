<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rewards', function (Blueprint $table) {
            $table->id();
            $table->integer('coins')->default(0);
            $table->boolean('status')->default(false);
            $table->bigInteger('limit')->default(0);
            $table->string('icon')->nullable();
            $table->boolean('is_ads_available')->default(false);
            $table->date('expire_at')->nullable();
            $table->text('ad')->nullable();
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
        Schema::dropIfExists('rewards');
    }
}
