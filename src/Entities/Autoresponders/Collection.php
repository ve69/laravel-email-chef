<?php

namespace OfflineAgency\LaravelEmailChef\Entities\Autoresponders;

use OfflineAgency\LaravelEmailChef\Entities\AbstractEntity;

class Collection extends AbstractEntity
{
    public string $id;
    public string $name;
    public string $trigger_id;
    public $active;
    public $hours_delay;
    public $sent;
    public $open;
    public $click;
    public $lists;
}
