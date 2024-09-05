<?php

namespace OfflineAgency\LaravelEmailChef\Entities\Autoresponders;

use OfflineAgency\LaravelEmailChef\Entities\AbstractEntity;

class Deactivate extends AbstractEntity
{
    public string $status;
    public string $atoresponder_id;
}
