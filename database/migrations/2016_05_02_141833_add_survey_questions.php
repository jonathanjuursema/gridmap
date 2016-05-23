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
            $table->dropColumn('question_wasclear');
            $table->dropColumn('question_baseonbg');
            $table->dropColumn('question_association');
            $table->dropColumn('question_canrecall');
            $table->dropColumn('question_canguess');
            $table->dropColumn('question_wantsresults');
            $table->dropColumn('question_mayrecall');
        });

    }
}
