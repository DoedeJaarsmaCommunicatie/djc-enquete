<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('questions', static function(Blueprint $table) {
            $table->bigIncrements('id');
                $table->string('name')->unique();
                $table->integer('position')->default(0);
            $table->timestamps();
        });

        Schema::create('options', static function (Blueprint $table) {
            $table->bigIncrements('id');
                $table->string('name');
                $table->unsignedBigInteger('question_id');
                $table->string('image')->nullable();
            $table->timestamps();

            $table->foreign('question_id')
                  ->references('id')
                  ->on('questions')
                  ->onDelete('CASCADE');
        });

        Schema::create('answers', static function (Blueprint $table) {
            $table->bigIncrements('id');
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('option_id');
                $table->unsignedBigInteger('question_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('CASCADE');

            $table->foreign('option_id')
                  ->references('id')
                  ->on('options')
                  ->onDelete('CASCADE');

            $table->foreign('question_id')
                  ->references('id')
                  ->on('questions')
                  ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
        Schema::dropIfExists('options');
        Schema::dropIfExists('answers');
    }
}
