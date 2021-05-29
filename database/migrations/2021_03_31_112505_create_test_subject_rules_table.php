<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestSubjectRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_subject_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_id')->constrained('tests');
            $table->foreignId('subject_id')->constrained('subjects');
            $table->double('percentage')->nullable();
            $table->integer('difficulty')->default(0);
            $table->boolean('is_random')->default(false);
            $table->timestamps();
        });

        Schema::table('tests', function (Blueprint $table) {
            $table->integer('total_questions')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_subject_rules');

        Schema::table('tests', function (Blueprint $table) {
            $table->dropColumn('total_questions');
        });
    }
}
