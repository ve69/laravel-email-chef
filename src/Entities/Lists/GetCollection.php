<?php

namespace OfflineAgency\LaravelEmailChef\Entities\Lists;

use Carbon\Carbon;
use OfflineAgency\LaravelEmailChef\Entities\AbstractEntity;

class GetCollection extends AbstractEntity
{
    public string $name;
    public int $id;
    public ?string $description;
    public Carbon $date;
    public $demo;
    public int $active;
    public int $subscribed;
    public int $unsubscribed;
    public int $bounced;
    public int $reported;
    public int $segments;
    public int $forms;
}
