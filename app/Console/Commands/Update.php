<?php

namespace GW2Heroes\Console\Commands;

use Carbon\Carbon;
use GW2Heroes\Account;
use GW2Heroes\Activity;
use GW2Heroes\Character;
use GW2Treasures\GW2Api\GW2Api;
use GW2Treasures\GW2Api\V2\Authentication\Exception\AuthenticationException;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Mail\Message;
use Mail;

class Update extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gw2heroes:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates all accounts.';

    /**
     * Create a new command instance.
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        // get all accounts

        /** @var Account[]|Collection $accounts */
        $accounts = Account::with('characters', 'user')
            ->where('api_key_valid', '=', true)
            ->get();

        $api = new GW2Api();

        foreach( $accounts as $account ) {
            try {
                /** @var Collection|Character[] $charactersLocal */
                $charactersLocal = $account->characters;

                // get all characters from api
                $charactersApi = $api->characters($account->api_key)->all();

                $characterMapping = $this->mapCharacters( $charactersLocal, $charactersApi );

                foreach( $characterMapping as $char ) {
                    if( is_null( $char->api )) {
                        $this->deletedChar( $account, $char->local );
                    } elseif( is_null( $char->local )) {
                        $this->createChar( $account, $char->api );
                    } else {
                        $this->updateChar( $account, $char->local, $char->api );
                    }
                }
            } catch( AuthenticationException $authException ) {
                $this->output->warning( 'API Key of ' . $account->name . ' [' . $account->id . '] is invalid' );

                $this->sendInvalidApiKeyMail($account);

                // mark the api key as invalid
                $account->api_key_valid = false;
                $account->save();
            }
        }
    }

    /**
     * Maps local characters to the characters returned from the api.
     *
     * @param Character[] $charactersLocal
     * @param array[]     $charactersApi
     * @return array
     */
    protected function mapCharacters($charactersLocal, $charactersApi) {
        $mapping = [];

        // insert all characters from api into mapping array
        foreach( $charactersApi as $char ) {
            $mapping[] = (object)[
                'api' => $char,
                'local' => null
            ];
        }

        // map local characters to api
        foreach( $charactersLocal as $char ) {
            $apiChar = null;

            foreach( $mapping as $map ) {
                // check if this char was already mapped to a local char
                if( !is_null( $map->local )) {
                    continue;
                }

                // check if char is the same
                if( $char->created->eq(Carbon::createFromFormat( Carbon::ISO8601, $map->api->created )) &&
                    $char->race === $map->api->race &&
                    $char->profession === $map->api->profession &&
                    $char->level <= $map->api->level &&
                    $char->age <= $map->api->age &&
                    $char->deaths <= $map->api->deaths
                ) {
                    $map->local = $char;
                    $apiChar = $map->api;
                    continue;
                }
            }

            // if we havent mapped this char, it was deleted
            if( is_null( $apiChar )) {
                $mapping[] = (object)[
                    'api' => null,
                    'local' => $char
                ];
            }
        }

        return $mapping;
    }

    /**
     * Mark local character as deleted.
     *
     * @param Account $account
     * @param Character $char
     */
    protected function deletedChar( Account $account, Character $char ) {
        // we don't do anything with this yet.
    }

    /**
     * Create a new local character based on the data returned from the api.
     *
     * @param Account $account
     * @param $char
     */
    protected function createChar( Account $account, $char ) {
        /** @var Character $character */
        $character = $account->characters()->create([
            'name' => $char->name,
            'race' => $char->race,
            'gender' => $char->gender,
            'profession' => $char->profession,
            'level' => $char->level,
            'age' => $char->age,
            'created' =>  Carbon::createFromFormat( Carbon::ISO8601, $char->created ),
            'deaths' => $char->deaths
        ]);

        Activity::createForCharacter( $character, Activity::TYPE_CHARACTER_CREATED );
        $this->output->writeln('created character ' . $char->name);
    }

    /**
     * Update the local character with the data returned from the api.
     *
     * @param Account $account
     * @param Character $localChar
     * @param $apiChar
     */
    protected function updateChar( Account $account, Character $localChar, $apiChar ) {
        // level
        if( $apiChar->level !== (int)$localChar->level ) {
            $localChar->level = $apiChar->level;

            Activity::createForCharacter( $localChar, Activity::TYPE_CHARACTER_LEVEL, $localChar->level );
        }

        // name
        if( $apiChar->name !== $localChar->name ) {
            $oldName = $localChar->name;
            $localChar->name = $apiChar->name;

            Activity::createForCharacter( $localChar, Activity::TYPE_CHARACTER_RENAMED, [
                'old' => $oldName,
                'new' => $apiChar->name
            ]);
        }

        // update all other changeable properties we don't fire activities for (yet)
        $localChar->gender = $apiChar->gender;
        $localChar->age = $apiChar->age;
        $localChar->deaths = $apiChar->deaths;

        if( $localChar->isDirty() ) {
            $this->output->writeln('updated character ' . $localChar->name);
            $localChar->save();
        }
    }

    /**
     * Send a mail for invalid api keys
     * @param Account $account
     */
    protected function sendInvalidApiKeyMail(Account $account) {
        $subject = 'Invalid API key for your account ' . $account->name;
        Mail::send([
            'emails.invalid_api_key.html',
            'emails.invalid_api_key.text'
        ], compact('account', 'subject'), function (Message $mail) use ($account, $subject) {
            $mail->to($account->user->email, $account->user->name)
                ->subject($subject);
        });
    }
}
