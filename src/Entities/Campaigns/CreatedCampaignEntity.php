<?php

namespace OfflineAgency\LaravelEmailChef\Entities\Campaigns;

use OfflineAgency\LaravelEmailChef\Entities\AbstractEntity;

class CreatedCampaignEntity extends AbstractEntity
{
    public string $status;
    public string $id;
}