<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFinalSurveyQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('participants', function ($table) {
            $table->boolean('question_thinkwasright')->nullable()->default(null);
            $table->boolean('question_opinion')->nullable()->default(null);
            $table->boolean('question_recallclear')->nullable()->default(null);
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
            $table->dropColumn('question_thinkwasright');
            $table->dropColumn('question_opinion');
            $table->dropColumn('question_recallclear');
        });

    }
}
