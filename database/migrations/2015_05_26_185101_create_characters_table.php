<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharactersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('characters', function(Blueprint $table)
		{
			$table->increments('id');

            $table->string('name');
            $table->string('race');
            $table->string('gender');
            $table->string('profession');
            $table->tinyInteger('level')->unsigned();

            $table->integer('account_id')->unsigned();

			$table->timestamps();

            $table->index('account_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('characters');
	}

}
