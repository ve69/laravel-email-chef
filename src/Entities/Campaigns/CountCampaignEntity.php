<?php

namespace OfflineAgency\LaravelEmailChef\Entities\Campaigns;

use OfflineAgency\LaravelEmailChef\Entities\AbstractEntity;

class CountCampaignEntity extends AbstractEntity
{
    public int $saved_draft_counter;
    public int $sent_counter;
    public int $scheduled_counter;
    public int $archived_counter;
    public int $failed_counter;
}

