<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddClassificationFieldsPasswords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('participants', function ($table) {
            $table->boolean('has_pattern')->nullable()->default(null);
            $table->boolean('has_form')->nullable()->default(null);
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
            $table->dropColumn('has_pattern');
            $table->dropColumn('has_form');
        });

    }
}
