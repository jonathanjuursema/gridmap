<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSurveyQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('participants', function ($table) {
            $table->boolean('question_wasclear')->nullable()->default(null);
            $table->boolean('question_baseonbg')->nullable()->default(null);
            $table->boolean('question_association')->nullable()->default(null);
            $table->boolean('question_canrecall')->nullable()->default(null);
            $table->boolean('question_canguess')->nullable()->default(null);
            $table->boolean('question_wantsresults')->nullable()->default(null);
            $table->boolean('question_mayrecall')->nullable()->default(null);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('participants', function ($table) {
            $table->drop('question_wasclear');
            $table->drop('question_baseonbg');
            $table->drop('question_association');
            $table->drop('question_canrecall');
            $table->drop('question_canguess');
            $table->drop('question_wantsresults');
            $table->drop('question_mayrecall');
        });

    }
}
