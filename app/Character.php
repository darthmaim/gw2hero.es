<?php namespace GW2Heroes;

use Illuminate\Database\Eloquent\Model;

class Character extends Model {
    protected $table = 'characters';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'race', 'gender', 'profession', 'level', 'age', 'created', 'deaths'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['api_key'];

    public function account() {
        return $this->belongsTo('\GW2Heroes\Account');
    }

    public function activities() {
        return $this->hasMany('\GW2Heroes\Activity');
    }

    public function getUrl() {
        $data = [
            base_convert( $this->id, 10, 36),
            str_slug(strtolower($this->name))
        ];
        return action('CharacterController@getIndex', $data );
    }
}
