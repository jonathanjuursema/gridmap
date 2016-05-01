<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('map');
            $table->boolean('disabledfields');
            $table->text('password')->nullable()->default(null);
            $table->boolean('survey')->default(0);
            $table->text('email')->nullable()->default(null);
            $table->boolean('emailsent')->nullable()->default(null);
            $table->boolean('guessedcorrectly')->nullable()->default(null);
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
        Schema::drop('participants');
    }
}
