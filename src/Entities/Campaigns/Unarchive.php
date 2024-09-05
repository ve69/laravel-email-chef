<?php


namespace OfflineAgency\LaravelEmailChef\Entities\Campaigns;

use OfflineAgency\LaravelEmailChef\Entities\AbstractEntity;

class Unarchive extends AbstractEntity
{
    public $status;
    public string $campaign_id;
}
