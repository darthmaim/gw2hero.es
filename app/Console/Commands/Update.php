<?php

namespace GW2Heroes\Console\Commands;

use GW2Heroes\Models\Account;
use GW2Heroes\Updater\Accounts\AccountUpdatePayload;
use GW2Heroes\Updater\Accounts\UpdatesAccount;
use GW2Heroes\Updater\UpdatePayload;
use GW2Heroes\Updater\Updater;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

class Update extends Command {
    use UpdatesAccount;

    /** @var string $signature */
    protected $signature = 'gw2heroes:update';

    /** @var string $description */
    protected $description = 'Updates all accounts.';

    /** @var Updater $updater */
    protected $updater;

    /**
     * Create a new command instance.
     */
    public function __construct() {
        parent::__construct();

        $this->updater = new Updater();
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

        foreach( $accounts as $account ) {
            $this->scheduleAccountUpdate( new AccountUpdatePayload( $account ));
        }

        $this->updater->queueScheduledUpdates();
    }

    public function scheduleUpdate($updater, UpdatePayload $payload) {
        $this->updater->scheduleUpdate( $updater, $payload );
    }
}
