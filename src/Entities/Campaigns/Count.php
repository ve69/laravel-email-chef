<?php

namespace OfflineAgency\LaravelEmailChef\Entities\Campaigns;

use OfflineAgency\LaravelEmailChef\Entities\AbstractEntity;

class Count extends AbstractEntity
{
    public $saved_draft_counter;
    public $sent_counter;
    public $scheduled_counter;
    public $archived_counter;
    public $failed_counter;
}
