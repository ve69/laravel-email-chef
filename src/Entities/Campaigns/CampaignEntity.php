<?php

namespace OfflineAgency\LaravelEmailChef\Entities\Campaigns;

use OfflineAgency\LaravelEmailChef\Entities\AbstractEntity;

class CampaignEntity extends AbstractEntity
{
    public string $id;
    public string $name;
    public string $recipients_count_cache;
    public string $status;
    public ?string $scheduled_time;
    public ?string $send_time;
    public ?string $timezone;
    public ?string $confirmation_email_address;
}
