<?php namespace GW2Heroes;

use Illuminate\Database\Eloquent\Model;

class Account extends Model {
    protected $table = 'accounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['guid', 'name', 'world', 'user_id', 'api_key'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['api_key'];

    public function user() {
        return $this->belongsTo('\GW2Heroes\User');
    }
}
