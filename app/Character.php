<?php namespace GW2Heroes;

use Carbon\Carbon;
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

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created', 'created_at', 'updated_at'];


    public function account() {
        return $this->belongsTo('\GW2Heroes\Account');
    }

    public function activities() {
        return $this->hasMany('\GW2Heroes\Activity');
    }

    /**
     * Creates a new character and adds it to the account.
     *
     * @param mixed   $apiData The data returned by the api.
     * @param Account $account The owner account.
     * @return static
     */
    public static function createFromApiData($apiData, Account $account) {
        return $account->characters()->create([
            'name' => $apiData->name,
            'race' => $apiData->race,
            'gender' => $apiData->gender,
            'profession' => $apiData->profession,
            'level' => $apiData->level,
            'age' => $apiData->age,
            'created' =>  Carbon::createFromFormat( Carbon::ISO8601, $apiData->created ),
            'deaths' => $apiData->deaths
        ]);
    }

    public function getActionData() {
        return [
            base_convert( $this->id, 10, 36),
            str_slug(strtolower($this->name))
        ];
    }

    public function getUrl() {
        return action('CharacterController@getIndex', $this->getActionData() );
    }
}
