<?php namespace GW2Heroes;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole{

	/**
	 * Attach one or more permissions to current role.
	 *
	 * @param mixed $permissions
	 *
	 * @return void
	 */
	public function attachPermissions($permissions){
		if(is_array($permissions) && !isset($permissions['id'])){
			foreach($permissions as $perm){
				$this->attachPermissions($perm);
			}
		}
		else{
			if(is_object($permissions)){
				$permissions = $permissions->getKey();
			}

			if(is_array($permissions)){
				$permissions = $permissions['id'];
			}

			if(is_int($permissions)){
				$this->perms()->attach($permissions);
			}
		}
	}

	/**
	 * Detach one or more permissions form current role.
	 *
	 * @param mixed $permissions
	 *
	 * @return void
	 */
	public function detachPermissions($permissions){
		if(is_array($permissions) && !isset($permissions['id'])){
			foreach($permissions as $perm){
				$this->detachPermissions($perm);
			}
		}
		else{
			if(is_object($permissions)){
				$permissions = $permissions->getKey();
			}

			if(is_array($permissions)){
				$permissions = $permissions['id'];
			}

			if(is_int($permissions)){
				$this->perms()->detach($permissions);
			}
		}
	}

	/**
	 * Alias to preserve backward compatibility.
	 *
	 * @param mixed $permission
	 */
	public function attachPermission($permission){
		$this->attachPermissions($permission);
	}

	/**
	 * Alias to preserve backward compatibility.
	 *
	 * @param mixed $permission
	 */
	public function detachPermission($permission){
		$this->detachPermissions($permission);
	}

}
