<?php

namespace OfflineAgency\LaravelEmailChef\Entities\SMS;

use OfflineAgency\LaravelEmailChef\Entities\AbstractEntity;

class BulkMessageStatus extends AbstractEntity
{
    public string $bulk_id;
    public $message_id;

    public $to;
    public $from;
    public string $text;
    public $sent_at;
    public $done_at;

    public $sms_count;

    public object $price;

    public $status;

    public $error;
}
