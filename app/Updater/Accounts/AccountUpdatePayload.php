<?php

namespace GW2Heroes\Updater\Accounts;

use GW2Heroes\Models\Account;
use GW2Heroes\Updater\UpdatePayload;

class AccountUpdatePayload extends UpdatePayload {
    /** @var Account */
    public $account;

    function __construct(Account $account) {
        $this->account = $account;
    }
}
