<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAgeCreatedDeathsToCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->integer('age')->unsigned()->default(0)->after('level');
            $table->timestamp('created')->nullable()->after('age');
            $table->integer('deaths')->default(0)->after('created');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->dropColumn(['age', 'created', 'deaths']);
        });
    }
}
