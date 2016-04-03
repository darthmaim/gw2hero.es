<?php

namespace GW2Heroes\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\HtmlString;

/**
 * GW2Heroes\Models\Guild
 *
 * @property integer $id
 * @property string $guid
 * @property string $name
 * @property string $tag
 * @property integer $member_count
 * @property integer $member_capacity
 * @property string $emblem
 * @property integer $level
 * @property integer $influence
 * @property integer $aetherium
 * @property integer $resonance
 * @property integer $favor
 * @property string $motd
 * @property boolean $authorized
 * @property boolean $public
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\GW2Heroes\Models\Account[] $members
 * @method static \Illuminate\Database\Query\Builder|\GW2Heroes\Models\Guild whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\GW2Heroes\Models\Guild whereGuid($value)
 * @method static \Illuminate\Database\Query\Builder|\GW2Heroes\Models\Guild whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\GW2Heroes\Models\Guild whereTag($value)
 * @method static \Illuminate\Database\Query\Builder|\GW2Heroes\Models\Guild whereMemberCount($value)
 * @method static \Illuminate\Database\Query\Builder|\GW2Heroes\Models\Guild whereMemberCapacity($value)
 * @method static \Illuminate\Database\Query\Builder|\GW2Heroes\Models\Guild whereEmblem($value)
 * @method static \Illuminate\Database\Query\Builder|\GW2Heroes\Models\Guild whereLevel($value)
 * @method static \Illuminate\Database\Query\Builder|\GW2Heroes\Models\Guild whereInfluence($value)
 * @method static \Illuminate\Database\Query\Builder|\GW2Heroes\Models\Guild whereAetherium($value)
 * @method static \Illuminate\Database\Query\Builder|\GW2Heroes\Models\Guild whereResonance($value)
 * @method static \Illuminate\Database\Query\Builder|\GW2Heroes\Models\Guild whereFavor($value)
 * @method static \Illuminate\Database\Query\Builder|\GW2Heroes\Models\Guild whereMotd($value)
 * @method static \Illuminate\Database\Query\Builder|\GW2Heroes\Models\Guild whereAuthorized($value)
 * @method static \Illuminate\Database\Query\Builder|\GW2Heroes\Models\Guild wherePublic($value)
 * @method static \Illuminate\Database\Query\Builder|\GW2Heroes\Models\Guild whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\GW2Heroes\Models\Guild whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\GW2Heroes\Models\Model whereStringContains($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Query\Builder|\GW2Heroes\Models\Model orWhereStringContains($column, $value)
 * @method static \Illuminate\Database\Query\Builder|\GW2Heroes\Models\Model random($amount = 1)
 * @mixin \Eloquent
 */
class Guild extends Model {
    protected $table = 'guilds';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['guid', 'name', 'tag', 'member_count', 'member_capacity', 'emblem', 'level', 'influence', 'aetherium', 'resonance', 'favor', 'motd', 'authorized', 'public'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    public function members() {
        return $this->belongsToMany(Account::class, 'guild_members');
    }

    public function getNameHtml() {
        return new HtmlString(trim(view('helper.guildName', ['guild' => $this])));
    }

    /**
     * Creates a new guild.
     *
     * @param mixed   $apiData The data returned by the api.
     * @return static
     */
    public static function createFromApiData($apiData) {
        return Guild::create([
            'guid' => $apiData->id,
            'name' => $apiData->name,
            'tag' => $apiData->tag,
            'member_count' => $apiData->member_count,
            'member_capacity' => $apiData->member_capacity,
            'emblem' => json_encode($apiData->emblem),
            'level' => 0,
            'influence' => 0,
            'aetherium' => 0,
            'resonance' => 0,
            'favor' => 0,
            'motd' => '',
            'authorized' => false,
            'public' => false
        ]);
    }

    /**
     * Creates a new guild.
     *
     * @param mixed   $apiData The data returned by the api.
     * @return static
     */
    public static function createFromLegacyApiData($apiData) {
        return Guild::create([
            'guid' => $apiData->guild_id,
            'name' => $apiData->guild_name,
            'tag' => $apiData->tag,
            'member_count' => 0,
            'member_capacity' => 0,
            'emblem' => json_encode(new \stdClass()),
            'level' => 0,
            'influence' => 0,
            'aetherium' => 0,
            'resonance' => 0,
            'favor' => 0,
            'motd' => '',
            'authorized' => false,
            'public' => false
        ]);
    }


    public function getActionData() {
        return [
            base_convert($this->id, 10, 36),
            str_slug(strtolower($this->name))
        ];
    }

    public function getUrl() {
        return action('GuildController@getIndex', $this->getActionData() );
    }
}
