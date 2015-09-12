<?php
use Illuminate\Database\Seeder;
use GW2Heroes\Models\User;

class UserTableSeeder extends Seeder{

	public function run(){
		DB::table(Config::get('auth.table'))->delete();

		User::create([
			'name' => 'admin',
			'email' => 'admin@gw2hero.es',
			'password' => Hash::make('fancy password')
		]);

		User::create([
			'name' => 'moderator',
			'email' => 'moderator@gw2hero.es',
			'password' => Hash::make('fancy password')
		]);

		User::create([
			'name' => 'user',
			'email' => 'user@gw2hero.es',
			'password' => Hash::make('fancy password')
		]);
	}

}
