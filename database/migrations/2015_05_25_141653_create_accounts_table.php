<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accounts', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('guid', 36);
            $table->string('name');
            $table->integer('world');

            $table->integer('user_id')->unsigned();
            $table->string('api_key', 72)->unique();
            $table->boolean('api_key_verified')->default(false);

			$table->timestamps();

            $table->index('guid');
            $table->index('user_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('accounts');
	}

}
