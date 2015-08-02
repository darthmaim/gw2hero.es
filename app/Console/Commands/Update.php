<?php

namespace GW2Heroes\Console\Commands;

use Carbon\Carbon;
use GW2Heroes\Account;
use GW2Heroes\Activity;
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
                /** @var Collection $characters */
                $characters = $account->characters;

                // get all characters from api
                $charactersInApi = $api->characters($account->api_key)->all();

                // find new characters
                foreach ($charactersInApi as $char) {
                    if ($characters->contains('name', $char->name)) {
                        // update char

                        $character = $characters->first(function( $key, $value ) use ( $char ) {
                            return $value->name === $char->name;
                        });

                        if( $char->level !== (int)$character->level ) {
                            $character->level = $char->level;
                            Activity::createForCharacter( $character, Activity::TYPE_CHARACTER_LEVEL, $character->level );
                            $character->save();
                        }

                        if( $character->created !== Carbon::createFromFormat( Carbon::ISO8601, $char->created )) {
                            $character->created = Carbon::createFromFormat( Carbon::ISO8601, $char->created );
                            $character->save();
                        }
                    } else {
                        // new char
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
                    }
                }
            } catch( AuthenticationException $authException ) {
                $this->output->warning( 'API Key of ' . $account->name . ' [' . $account->id . '] is invalid' );


                $subject = 'Invalid API key for your account ' . $account->name;
                Mail::send([
                    'emails.invalid_api_key.html',
                    'emails.invalid_api_key.text'
                ], compact('account', 'subject'), function(Message $mail) use ($account, $subject) {
                    $mail->to($account->user->email, $account->user->name)
                        ->subject($subject);
                });

                $account->api_key_valid = false;
                $account->save();
            }
        }
    }
}
