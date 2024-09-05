<?php


namespace OfflineAgency\LaravelEmailChef\Entities\Autoresponders;

use OfflineAgency\LaravelEmailChef\Entities\AbstractEntity;

class Instance extends AbstractEntity
{
    public string $id;
    public string $account_id;
    public string $name;
    public $type;
    public string $subject;
    public string $html_body;
    public $text_body;
    public $sender_id;
    public $template_id;
    public $reply_to_id;
    public $sent_count_cache;
    public $open_count_cache;
    public $click_count_cache;
    public $ga_enabled;
    public string $ga_campaign_title;
    public object $autoreponder;
    public array $lists;
}
