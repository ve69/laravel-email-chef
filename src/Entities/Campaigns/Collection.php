<?php

namespace OfflineAgency\LaravelEmailChef\Entities\Campaigns;

use OfflineAgency\LaravelEmailChef\Entities\AbstractEntity;

class Collection extends AbstractEntity
{
    public $id;
    public $sender_id;
    public $name;
    public $date;
    public $status;
    public $scheduled_time;
    public $send_time;
    public $recipients;
    public $queue_num;
    public $delivered;
    public $unique_opened;
    public $unique_clicked;
    public $attempted;

}
