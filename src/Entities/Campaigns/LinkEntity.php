<?php

namespace OfflineAgency\LaravelEmailChef\Entities\Campaigns;

use OfflineAgency\LaravelEmailChef\Entities\AbstractEntity;

class LinkEntity extends AbstractEntity
{
    public string $id;
    public string $url;
    public string $name;
}