<?php namespace GW2Heroes;

use GW2Treasures\GW2Api\GW2Api;
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

    public function characters() {
        return $this->hasMany('\GW2Heroes\Character');
    }

    public function getNameHtml() {
        return view('helper.accountName', ['account' => $this]);
    }

    /**
     * Create a new Account
     *
     * @param string $apiKey
     * @return static
     */
    public static function fromApiKey($apiKey) {
        $api = new GW2Api();
        $account = $api->account($apiKey)->info();

        return new self([
            'guid' => $account->id,
            'name' => $account->name,
            'world' => $account->world,
            'api_key' => $apiKey
        ]);
    }
}
