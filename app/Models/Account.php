<?php

namespace GW2Heroes\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\HtmlString;

/**
 * GW2Heroes\Models\Account
 *
 * @property-read User $user
 * @property-read Collection|Character[] $characters
 * @property-read Collection|Activity[] $activities
 * @property integer $id
 * @property string $guid
 * @property string $name
 * @property integer $world
 * @property integer $user_id
 * @property string $api_key
 * @property boolean $api_key_valid
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static Builder|Account whereId($value)
 * @method static Builder|Account whereGuid($value)
 * @method static Builder|Account whereName($value)
 * @method static Builder|Account whereWorld($value)
 * @method static Builder|Account whereUserId($value)
 * @method static Builder|Account whereApiKey($value)
 * @method static Builder|Account whereApiKeyValid($value)
 * @method static Builder|Account whereCreatedAt($value)
 * @method static Builder|Account whereUpdatedAt($value)
 * @method static Builder|Account whereStringContains($column, $value, $boolean = 'and')
 * @method static Builder|Account orWhereStringContains($column, $value)
 * @method static Builder|Account random($amount = 1)
 */
class Account extends Model {
    protected $table = 'accounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['guid', 'name', 'world', 'user_id', 'api_key', 'api_key_valid'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['api_key'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function characters() {
        return $this->hasMany(Character::class);
    }

    public function activities() {
        return $this->hasMany(Activity::class);
    }

    public function getNameHtml() {
        return new HtmlString(trim(view('helper.accountName', ['account' => $this])));
    }

    public function getActionData() {
        return [
            base_convert($this->id, 10, 36),
            substr_replace(str_slug(strtolower($this->name)), '.', -4, 0)
        ];
    }

    /**
     * Creates a new Account and adds it to the user.
     *
     * @param mixed  $apiData The data returned from the api.
     * @param string $apiKey  The api key of the account.
     * @param User   $user    The owning user.
     * @return static
     */
    public static function createFromApiData($apiData, $apiKey, User $user) {
        return $user->accounts()->create([
            'guid' => $apiData->id,
            'name' => $apiData->name,
            'world' => $apiData->world,
            'api_key' => $apiKey
        ]);
    }
}
