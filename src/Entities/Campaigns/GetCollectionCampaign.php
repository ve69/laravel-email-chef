<?php

namespace OfflineAgency\LaravelEmailChef\Entities\Campaigns;

use OfflineAgency\LaravelEmailChef\Entities\AbstractEntity;

class GetCollectionCampaign extends AbstractEntity
{
    public string $status;
    public string $name;
    public ?string $created_at;
    public int $id;
    public int $sender_id;
    public int $date;
    public int $scheduled_time;
    public int $send_time;
    public int $recipients;
    public int $queue_num;
    public int $success_num;
    public int $delivered;
    public int $sent_nunique_opened;
    public int $unique_clicked;
    public int $attempted;
}
