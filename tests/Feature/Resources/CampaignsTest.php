<?php

namespace OfflineAgency\LaravelEmailChef\Tests\Feature\Resources;

use Illuminate\Support\Facades\Http;
use OfflineAgency\LaravelEmailChef\Api\Resources\CampaignsApi;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\CountCampaignEntity;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\GetCollectionCampaign;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\GetInstanceCampaign;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\UpdatedCampaingsEntity;
use OfflineAgency\LaravelEmailChef\Tests\TestCase;
use OfflineAgency\LaravelEmailChef\Entities\Error;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\LinkEntity;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\CreatedCampaignEntity;


class CampaignsTest extends TestCase
{
    public function test_count_campaigns()
    {
        $mockResponse = [
            'saved_draft_counter' => '1',
            'sent_counter' => '2',
            'scheduled_counter' => '0',
            'archived_counter' => '0',
            'failed_counter' => '0',
        ];

        Http::fake([
            'https://app.emailchef.com/apps/api/v1/campaigns/count' => Http::response($mockResponse),
        ]);

        $api = new CampaignsApi();
        $response = $api->countCampaigns();

        $this->assertInstanceOf(CountCampaignEntity::class, $response);
        $this->assertEquals('2', $response->sent_counter);
    }

    public function test_get_collection()
    {
        $mockResponse = [
            [
                'id' => '1',
                'name' => 'Campaign 1',
                'status' => 'SENT',
                'subject' => 'Subject 1',
            ],
            [
                'id' => '2',
                'name' => 'Campaign 2',
                'status' => 'SCHEDULED',
                'subject' => 'Subject 2',
            ],
        ];

        Http::fake([
            'https://app.emailchef.com/apps/api/v1/campaigns*' => Http::response($mockResponse, 200),
        ]);

        $api = new CampaignsApi();
        $response = $api->getCollection('SENT');

        $this->assertCount(2, $response);
        $this->assertInstanceOf(GetCollectionCampaign::class, $response->first());
    }

    public function test_get_instance()
    {
        $mockResponse = [
            'id' => '104633',
            'account_id' => '785618',
            'name' => 'Cmp1080',
            'type' => 'CAMPAIGN',
            'subject' => 'Special Offer #2',
            'html_body' => '<html>...</html>',
            'text_body' => 'Text body',
            'sender_id' => '784',
            'template_id' => null,
            'reply_to_id' => '784',
            'sent_count_cache' => '1',
            'open_count_cache' => '0',
            'click_count_cache' => '0',
            'ga_enabled' => null,
            'ga_campaign_title' => null,
            'campaign' => [
                'id' => '104633',
                'name' => 'Cmp1080',
                'recipients_count_cache' => '1',
                'status' => 'SENT',
                'scheduled_time' => null,
                'send_time' => '2016-03-17 16:39:07',
                'timezone' => null,
                'confirmation_email_address' => 'admin@yoursite.com',
            ],
        ];

        Http::fake([
            'https://app.emailchef.com/apps/api/v1/campaigns/104633' => Http::response($mockResponse, 200),
        ]);

        //TODO: handle error

        $api = new CampaignsApi();
        $response = $api->getInstance(104633);

        $this->assertInstanceOf(GetInstanceCampaign::class, $response);
        $this->assertEquals('104633', $response->id);
        $this->assertEquals('Cmp1080', $response->name);
    }
    public function test_create_instance()
    {
        // Simula una risposta API finta
        Http::fake([
            'https://app.emailchef.com/apps/api/v1/campaigns' => Http::response([
                'status' => 'OK',
                'id' => '104636'
            ], 200)
        ]);

        // Istanzia la classe CampaignsApi
        $campaignApi = new CampaignsApi();

        // Dati della campagna da creare
        $campaignData = [
            'name' => 'My Campaign',
            'type' => 'CAMPAIGN',
            'subject' => 'Special Offer #2',
            'html_body' => '<html><head></head><body>Hello</body></html>',
            'text_body' => 'Text version',
            'sender_id' => '784',
            'reply_to_id' => '784',
            'confirmation_email_address' => 'admin@yoursite.com',
            'lists' => [
                ['list_id' => '251398']
            ]
        ];

        // Esegui il metodo
        $response = $campaignApi->createInstance($campaignData);

        // Verifica che la risposta sia della classe attesa
        $this->assertInstanceOf(CreatedCampaignEntity::class, $response);
        $this->assertEquals('OK', $response->status);
        $this->assertEquals('104636', $response->id);
    }
    public function test_update_instance()
    {
        Http::fake([
            'https://app.emailchef.com/apps/api/v1/campaigns/104636' => Http::response([
                'status' => 'OK',
                'id' => '104636',
            ], 200)
        ]);

        $campaignApi = new CampaignsApi();

        $campaignData = [
            'name' => 'Updated Campaign',
            'type' => 'CAMPAIGN',
            'subject' => 'Updated Subject',
            'html_body' => '<html><body>Updated HTML</body></html>',
            'text_body' => 'Updated text',
            'sender_id' => '784',
            'reply_to_id' => '784',
            'confirmation_email_address' => 'admin@yoursite.com',
            'lists' => [
                ['list_id' => '251398']
            ]
        ];

        $response = $campaignApi->updateInstance(104636, $campaignData);

        $this->assertInstanceOf(UpdatedCampaingsEntity::class, $response);
        $this->assertEquals('OK', $response->status);
        $this->assertEquals('104636', $response->id);
    }

    public function test_delete_instance()
    {
        Http::fake([
            'https://app.emailchef.com/apps/api/v1/campaigns/104636' => Http::response([
                'status' => 'OK',
                'id' => '104636',
            ], 200)
        ]);

        $api = new CampaignsApi();
        $response = $api->deleteInstance(104636);
        $this->assertIsObject($response);
        $this->assertEquals('OK', $response->status);
        $this->assertEquals('104636', $response->id);
    }
    public function test_send_test_email()
    {
        Http::fake([
            'https://app.emailchef.com/apps/api/v1/campaigns/104636/sendtest' => Http::response([
                'status' => 'OK',
            ], 200),
        ]);

        $api = new CampaignsApi();
        $response = $api->sendTestEmail(104636, 'test@example.com');

        $this->assertEquals('OK', $response->status);
    }
     public function test_send_campaign()
    {
        $campaign_id = 104636;

        Http::fake([
            "https://app.emailchef.com/apps/api/v1/campaigns/{$campaign_id}/send" => Http::response([
                'status' => 'OK',
            ], 200),
        ]);

        $api = new CampaignsApi();
        $response = $api->sendCampaign($campaign_id);

        $this->assertIsObject($response);
        $this->assertEquals('OK', $response->status);
    }
    public function test_schedule_campaign()
    {
        $campaign_id = 104636;
        $timezone = 5;
        $scheduled_time = '2017-01-01 00:00:00';

        Http::fake([
            "https://app.emailchef.com/apps/api/v1/campaigns/{$campaign_id}/schedule" => Http::response([
                'status' => 'OK',
            ], 200),
        ]);

        $api = new CampaignsApi();
        $response = $api->scheduleCampaign($campaign_id, $timezone, $scheduled_time);

        $this->assertIsObject($response);
        $this->assertEquals('OK', $response->status);
    }

    public function test_unschedule_campaign(){
        $campaign_id = 104636;

        Http::fake([
            "https://app.emailchef.com/apps/api/v1/campaigns/{$campaign_id}/unschedule" => Http::response([
                'status' => 'OK',
            ], 200),
        ]);

        $api = new CampaignsApi();
        $response = $api->deleteScheduling($campaign_id);

        //TODO: handle campaign id error

        $this->assertIsObject($response);
        $this->assertEquals('OK', $response->status);
        $this->assertEquals('104636', $response->id);
    }

    public function test_archive_campaign(){
        $campaign_id = 104636;

        Http::fake([
            "https://app.emailchef.com/apps/api/v1/campaigns/{$campaign_id}/archive" => Http::response([
                'status' => 'OK',
            ], 200),
        ]);

        $api = new CampaignsApi();
        $response = $api->archiveCampaign($campaign_id);

        //TODO: handle campaign id error

        $this->assertEquals('OK', $response->status);
        $this->assertEquals((string) $campaign_id, $response->campaign_id);
    }

    public function test_unarchive_campaign(){
        $campaign_id = 104636;

        Http::fake([
            "https://app.emailchef.com  /apps/api/v1/campaigns/{$campaign_id}/archive" => Http::response([
                'status' => 'OK',
            ], 200),
        ]);

        $api = new CampaignsApi();
        $response = $api->unarchiveCampaign($campaign_id);

        //TODO: handle error

        $this->assertEquals('OK', $response->status);
        $this->assertEquals((string) $campaign_id, $response->campaign_id);
    }

    public function test_clone_campaign(){
         $campaign_id = 104636;

        Http::fake([
            "https://app.emailchef.com/apps/api/v1/campaigns/{$campaign_id}/archive" => Http::response([
                'status' => 'OK',
            ], 200),
        ]);

        $api = new CampaignsApi();
        $response = $api->cloneCampaign($campaign_id);

        //TODO: handle error

        $this->assertEquals('OK', $response->status);
        $this->assertEquals((string) $campaign_id, $response->campaign_id);

   }
   public function testGetLinksCollection()
    {
        $campaign_id = 104636;

        $campaigns = new CampaignsApi();

        //TODO: add http fake
        Http::fake([
            "https://app.emailchef.com/apps/api/v1/campaigns/{$campaign_id}/archive" => Http::response([
                'status' => 'OK',
            ], 200),
        ]);

        $response = $campaigns->getLinksCollection($campaign_id);

        $this->assertInstanceOf(Error::class, $response);

        $this->assertNotInstanceOf(\Illuminate\Support\Collection::class, $response);

        if ($response->isNotEmpty()) {
            $this->assertInstanceOf(LinkEntity::class, $response->first());
            $this->assertObjectHasAttribute('url', $response->first());
            $this->assertObjectHasAttribute('name', $response->first());
            $this->assertObjectHasAttribute('id', $response->first());
        }
    }
}
