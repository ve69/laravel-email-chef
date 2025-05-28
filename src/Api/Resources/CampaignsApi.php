<?php

namespace OfflineAgency\LaravelEmailChef\Api\Resources;


use OfflineAgency\LaravelEmailChef\Api\Api;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\CountCampaignEntity;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\GetCollectionCampaign;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\GetInstanceCampaign;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\CreatedCampaignEntity;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\UpdatedCampaingsEntity;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\LinkEntity;
use OfflineAgency\LaravelEmailChef\Entities\Error;

class CampaignsApi extends Api
{
    public function countCampaigns()
    {
        $response = $this->get('campaigns/count');

        if (!$response->success) {
            return new Error($response->data);
        }

        $count = $response->data;

        return new CountCampaignEntity($count);
    }

    public function getCollection(
        ?string $status = null,
        ?string $status1 = null,
        ?string $status2 = null,
        ?int    $limit = 10,
        ?int    $offset = 0,
        ?string $order_by = 't',
        ?string $order_type = 'd'
    )
    {
        $query = 'campaigns?';

        if ($status) {
            $query .= 'status=' . $status . '&';
        } else {
            if ($status1) {
                $query .= 'status1=' . $status1 . '&';
            }
            if ($status2) {
                $query .= 'status2=' . $status2 . '&';
            }
        }

        $query .= 'limit=' . $limit . '&offset=' . $offset . '&orderby=' . $order_by . '&ordertype=' . $order_type;

        $response = $this->get($query);

        if (!$response->success) {
            return new Error($response->data);
        }

        $collections = $response->data;

        $out = collect();
        foreach ($collections as $collection) {
            $out->push(new GetCollectionCampaign($collection));
        }

        return $out;
    }

    public function getInstance(int $id)
    {
        $response = $this->get('campaigns/' . $id);

        if (!$response->success) {
            return new Error($response->data);
        }

        $instance = $response->data;

        return new GetInstanceCampaign($instance);

    }

    public function createInstance(array $campaignData)
    {
        $response = $this->post('campaigns', [
            'instance_in' => $campaignData
        ]);

        if (!$response->success) {
            return new Error($response->data);
        }

        return new CreatedCampaignEntity($response->data);
    }

    public function updateInstance(int $id, array $data)
    {
        $response = $this->put("campaigns/{$id}", [
            'instance_in' => $data,
        ]);

        if (!$response->success) {
            return new Error($response->data);
        }

        $updated = $response->data;

        return new UpdatedCampaingsEntity($updated);
    }

    public function deleteInstance(int $id)
    {
        $response = $this->destroy("campaigns/{$id}");

        if (!$response->success) {
            return new Error($response->data);
        }

        return $response->data;
    }

    public function sendTestEmail(int $id, string $email)
    {
        $response = $this->put("campaigns/{$id}/sendtest", [
            'instance_in' => [
                'email' => $email,
            ],
        ]);

        if (!$response->success) {
            return new Error($response->data);
        }

        return $response->data;
    }

    public function sendCampaign(int $id)
    {
        $response = $this->put("campaigns/{$id}/send", []);

        if (!$response->success) {
            return new Error($response->data);
        }

        return $response->data;
    }

    public function scheduleCampaign(int $id, int $timezone, string $schedule_time)
    {
        $payload = [
            'instance_in' => [
                'timezone' => $timezone,
                'scheduled_time' => $schedule_time,
            ],
        ];

        $response = $this->put("campaigns/{$id}/schedule", $payload);

        if (!$response->success) {
            return new Error($response->data);
        }

        return (object)$response->data;
    }

    public function deleteScheduling(int $id)
    {
        $response = $this->put("campaigns/{$id}/unschedule", []);

        if (!$response->success) {
            return new Error($response->data);
        }

        return $response->data;
    }

    public function archiveCampaign(int $id)
    {
        $response = $this->put("campaigns/{$id}/archive", []);

        if (!$response->success) {
            return new Error($response->data);
        }

        return $response->data;
    }

    public function unarchiveCampaign(int $id)
    {
        $response = $this->put("campaigns/{$id}/archivecampaign", []);

        if (!$response->success) {
            return new Error($response->data);
        }

        return $response->data;
    }

    public function cloneCampaign(int $id)
    {
        $response = $this->post('newsletters?clone=1', [
            'instance_in' => [
                'id' => $id,
            ],
        ]);

        if (!$response->success) {
            return new Error($response->data);
        }

        return $response->data;
    }

    public function getLinksCollection(int $campaign_id)
    {
        $response = $this->get("campaigns/{$campaign_id}/links");

        if (!$response->success) {
            return new Error($response->data);
        }

        $links = $response->data;

        $out = collect();
        foreach ($links as $link) {
            $out->push(new LinkEntity($link));
        }

        return $out;
    }

}
