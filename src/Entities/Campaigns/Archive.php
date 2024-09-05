<?php


namespace OfflineAgency\LaravelEmailChef\Entities\Campaigns;

use OfflineAgency\LaravelEmailChef\Entities\AbstractEntity;

class Archive extends AbstractEntity
{
    public $status;
    public string $campaign_id;
}
