<?php

namespace OfflineAgency\LaravelEmailChef\Entities\Autoresponders;

use OfflineAgency\LaravelEmailChef\Entities\AbstractEntity;

class DeleteInstance extends AbstractEntity
{
    public string $status;
    public string $id;
}
