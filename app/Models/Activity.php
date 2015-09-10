<?php

namespace GW2Heroes\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model {

    // account activity types
    const TYPE_ACCOUNT_CREATED = 'account.created';

    // character activity types
    const TYPE_CHARACTER_CREATED = 'character.created';
    const TYPE_CHARACTER_LEVEL   = 'character.level';
    const TYPE_CHARACTER_RENAMED = 'character.renamed';


    protected $table = 'activities';
    protected $fillable = ['user_id', 'account_id', 'character_id', 'type', 'data'];

    public static function createForUser( User $user, $type, $data = null ) {
        $activity = $user->activities()->create([
            'type' => $type,
            'data' => $data
        ]);

        return $activity;
    }

    public static function createForAccount( Account $account, $type, $data = null ) {
        $activity = $account->activities()->create([
            'user_id' => $account->user_id,
            'type' => $type,
            'data' => $data
        ]);

        return $activity;
    }


    public static function createForCharacter( Character $character, $type, $data = null ) {
        $activity = $character->activities()->create([
            'user_id' => $character->account->user_id,
            'account_id' => $character->account->id,
            'type' => $type,
            'data' => $data
        ]);

        return $activity;
    }

    public static function accountCreated(Account $account) {
        return self::createForAccount($account, self::TYPE_ACCOUNT_CREATED);
    }

    public static function characterCreated(Character $character) {
        return self::createForCharacter($character, self::TYPE_CHARACTER_CREATED);
    }

    public static function characterLevel(Character $character, $level) {
        return self::createForCharacter($character, self::TYPE_CHARACTER_LEVEL, $level);
    }

    public static function characterRenamed(Character $character, $oldName, $newName) {
        return self::createForCharacter($character, self::TYPE_CHARACTER_RENAMED, [
            'old' => $oldName, 'new' => $newName
        ]);
    }

    public function account() {
        return $this->belongsTo('\GW2Heroes\Models\Account');
    }

    public function user() {
        return $this->belongsTo('\GW2Heroes\Models\User');
    }

    public function character() {
        return $this->belongsTo('\GW2Heroes\Models\Character');
    }
}
