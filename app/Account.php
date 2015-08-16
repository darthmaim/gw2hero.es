<?php namespace GW2Heroes;

use GW2Treasures\GW2Api\GW2Api;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Expression;

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
        return $this->belongsTo('\GW2Heroes\User');
    }

    public function characters() {
        return $this->hasMany('\GW2Heroes\Character');
    }

    public function activities() {
        return $this->hasMany('\GW2Heroes\Activity');
    }

    public function getNameHtml() {
        return new Expression(trim(view('helper.accountName', ['account' => $this])));
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
