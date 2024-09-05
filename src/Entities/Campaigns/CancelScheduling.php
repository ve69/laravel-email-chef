<?php


namespace OfflineAgency\LaravelEmailChef\Entities\Campaigns;

use OfflineAgency\LaravelEmailChef\Entities\AbstractEntity;

class CancelScheduling extends AbstractEntity
{
    public $status;
    public string $campaign_id;
}
