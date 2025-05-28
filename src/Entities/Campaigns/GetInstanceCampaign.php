<?php

namespace OfflineAgency\LaravelEmailChef\Entities\Campaigns;

use OfflineAgency\LaravelEmailChef\Entities\AbstractEntity;

class GetInstanceCampaign extends AbstractEntity
{
    public string $id;
    public string $account_id;
    public string $name;
    public string $type;
    public string $subject;
    public string $html_body;
    public string $text_body;
    public string $sender_id;
    public ?string $template_id;
    public string $reply_to_id;
    public string $sent_count_cache;
    public string $open_count_cache;
    public string $click_count_cache;
    public ?string $ga_enabled;
    public ?string $ga_campaign_title;

   /*
    public ?CampaignEntity $campaign = null;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['campaign'])) {
            $this->campaign = new CampaignEntity($data['campaign']);
        }
    }
   */
}
