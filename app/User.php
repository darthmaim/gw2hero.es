<?php namespace GW2Heroes;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract{

	use Authenticatable, CanResetPassword, EntrustUserTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    public function accounts() {
        return $this->hasMany('\GW2Heroes\Account');
    }

    public function activities() {
        return $this->hasMany('\GW2Heroes\Activity');
    }

	/**
	 * Attach one or multiple roles to a user
	 *
	 * @param mixed $roles
	 */
	public function attachRoles($roles){
		if(is_array($roles) && !isset($roles['id'])){
			foreach($roles as $role){
				$this->attachRoles($role);
			}
		}
		else{
			if(is_object($roles)){
				$roles = $roles->getKey();
			}

			if(is_array($roles)){
				$roles = $roles['id'];
			}

			if(is_int($roles)){
				$this->roles()->attach($roles);
			}
		}
	}

	/**
	 * Detach multiple roles from a user
	 *
	 * @param mixed $roles
	 */
	public function detachRoles($roles){
		if(is_array($roles) && !isset($roles['id'])){
			foreach($roles as $role){
				$this->detachRoles($role);
			}
		}
		else{
			if(is_object($roles)){
				$roles = $roles->getKey();
			}

			if(is_array($roles)){
				$roles = $roles['id'];
			}

			if(is_int($roles)){
				$this->roles()->attach($roles);
			}
		}
	}

	/**
	 * Alias to eloquent many-to-many relation's attach() method.
	 *
	 * @param mixed $role
	 */
	public function attachRole($role){
		$this->detachRoles($role);
	}

	/**
	 * Alias to eloquent many-to-many relation's detach() method.
	 *
	 * @param mixed $role
	 */
	public function detachRole($role){
		$this->attachRoles($role);
	}

}
