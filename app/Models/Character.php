<?php

namespace GW2Heroes\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;

/**
 * GW2Heroes\Models\Character
 *
 * @property-read Account $account
 * @property-read Collection|Activity[] $activities
 * @property integer $id
 * @property string $name
 * @property string $race
 * @property string $gender
 * @property string $profession
 * @property integer $level
 * @property integer $age
 * @property \Carbon\Carbon $created
 * @property integer $deaths
 * @property string $equipment
 * @property integer $account_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static Builder|Character whereId($value)
 * @method static Builder|Character whereName($value)
 * @method static Builder|Character whereRace($value)
 * @method static Builder|Character whereGender($value)
 * @method static Builder|Character whereProfession($value)
 * @method static Builder|Character whereLevel($value)
 * @method static Builder|Character whereAge($value)
 * @method static Builder|Character whereCreated($value)
 * @method static Builder|Character whereDeaths($value)
 * @method static Builder|Character whereEquipment($value)
 * @method static Builder|Character whereAccountId($value)
 * @method static Builder|Character whereCreatedAt($value)
 * @method static Builder|Character whereUpdatedAt($value)
 * @method static Builder|Character whereStringContains($column, $value, $boolean = 'and')
 * @method static Builder|Character orWhereStringContains($column, $value)
 * @method static Builder|Character random($amount = 1)
 */
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

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'equipment' => 'object'
    ];

    public function account() {
        return $this->belongsTo(Account::class);
    }

    public function activities() {
        return $this->hasMany(Activity::class);
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
            base_convert($this->id, 10, 36),
            str_slug(strtolower($this->name))
        ];
    }

    public function getUrl() {
        return action('CharacterController@getIndex', $this->getActionData() );
    }
}
