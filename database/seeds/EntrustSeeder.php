<?php

use Illuminate\Database\Seeder;
use GW2Heroes\User;
use GW2Heroes\Role;
use GW2Heroes\Permission;

class EntrustSeeder extends Seeder{

	public function run(){
		DB::table(Config::get('entrust.roles_table'))->delete();
		DB::table(Config::get('entrust.permissions_table'))->delete();
		DB::table(Config::get('entrust.permission_role_table'))->delete();
		DB::table(Config::get('entrust.role_user_table'))->delete();

		// create some roles
		$adminRole = new Role;
		$adminRole->name = 'admin';
		$adminRole->display_name = 'Administrator';
		$adminRole->save();

		$modRole = new Role;
		$modRole->name = 'moderator';
		$modRole->display_name = 'Moderator';
		$modRole->save();

		$userRole = new Role;
		$userRole->name = 'user';
		$userRole->display_name = 'User';
		$userRole->save();

		// now assign the above roles to some users
		$user = User::where('email', '=', 'admin@gw2hero.es')->first();
		$user->attachRole($adminRole);

		$user = User::where('email', '=', 'moderator@gw2hero.es')->first();
		$user->attachRole($modRole);

		$user = User::where('email', '=', 'user@gw2hero.es')->first();
		$user->attachRole($userRole);

		// create some permissions
		$editSystem = new Permission;
		$editSystem->name = 'edit-system';
		$editSystem->display_name = 'Edit system';
		$editSystem->description = 'allows to edit system settings';
		$editSystem->save();

		$editAllProfiles = new Permission;
		$editAllProfiles->name = 'edit-all-profiles';
		$editAllProfiles->display_name = 'Edit all profiles';
		$editAllProfiles->description = 'allows to edit all user profiles';
		$editAllProfiles->save();

		$editOwnProfile = new Permission;
		$editOwnProfile->name = 'edit-own-profile';
		$editOwnProfile->display_name = 'Edit own profile';
		$editOwnProfile->description = 'allows to edit your own user profile';
		$editOwnProfile->save();

		// and finally attach the permissions to the roles
		$adminRole->attachPermissions([$editSystem, $editAllProfiles, $editOwnProfile]);

		$modRole->attachPermissions([$editAllProfiles, $editOwnProfile]);

		$userRole->attachPermissions([$editOwnProfile]);

	}

}