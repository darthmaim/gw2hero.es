<?php

namespace GW2Heroes\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Auth\Access\Authorizable;

/**
 * GW2Heroes\Models\User
 *
 * @property-read Collection|Account[] $accounts
 * @property-read Collection|Activity[] $activities
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property boolean $is_admin
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereIsAdmin($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @method static Builder|User whereStringContains($column, $value, $boolean = 'and')
 * @method static Builder|User orWhereStringContains($column, $value)
 * @method static Builder|User random($amount = 1)
 * @mixin \Eloquent
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract {
    use Authenticatable, Authorizable, CanResetPassword;

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
	protected $hidden = ['email', 'password', 'remember_token', 'is_admin'];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'is_admin' => 'bool'
	];

    public function accounts() {
        return $this->hasMany(Account::class);
    }

    public function activities() {
        return $this->hasMany(Activity::class);
    }


    public function getActionData() {
        return [
            base_convert($this->id, 10, 36),
            str_slug(strtolower($this->name))
        ];
    }
}
