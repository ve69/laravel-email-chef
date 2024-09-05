<?php

namespace OfflineAgency\LaravelEmailChef\Entities\Autoresponders;

use OfflineAgency\LaravelEmailChef\Entities\AbstractEntity;

class Activate extends AbstractEntity
{
    public string $status;
    public $autoresponder_id;
}
