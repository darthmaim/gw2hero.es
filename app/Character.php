<?php namespace GW2Heroes;

use Illuminate\Database\Eloquent\Model;

class Character extends Model {
    protected $table = 'characters';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'race', 'gender', 'profession', 'level'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['api_key'];

    public function account() {
        return $this->belongsTo('\GW2Heroes\Account');
    }
}
