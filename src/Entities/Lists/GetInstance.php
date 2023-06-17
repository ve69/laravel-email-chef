<?php

namespace OfflineAgency\LaravelEmailChef\Entities\Lists;

use Carbon\Carbon;
use OfflineAgency\LaravelEmailChef\Entities\AbstractEntity;

class GetInstance extends AbstractEntity
{
    public string $name;
    public string $description;
}
