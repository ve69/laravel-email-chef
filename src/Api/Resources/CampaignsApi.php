<?php

namespace OfflineAgency\LaravelEmailChef\Api\Resources;

use OfflineAgency\LaravelEmailChef\Api\Api;
use Illuminate\Support\Facades\Validator;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\CampaignCount;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\CampaignCollection;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\Campaign;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\CreateCampaign;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\UpdateCampaign;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\CampaignDeletion;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\SendTestEmail;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\SendCampaign;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\Schedule;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\CancelScheduling;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\CampaignArchiving;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\Cloning;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\LinkCollection;
use OfflineAgency\LaravelEmailChef\Entities\Error;

class CampaignsApi extends Api
{
    public function getCount()
    {
        $response = $this->get('campaigns/count');

        $this->error = new Error($response->data);
        if (!$response->success) {
            return $this->error;
        }

        $getCount = $response->data;

        return new CampaignCount($getCount);
    }

    public function getCollection(
        string $status,
        ?int $limit,
        ?int $offset,
        string $orderby,
        string $ordertype
    )
    {
        $response = $this->get('campaigns', [
            'status' => $status,
            'limit' => $limit,
            'offset' => $offset,
            'orderby' => $orderby,
            'ordertype' => $ordertype,
        ]);

        if (!$response->success) {
            return new Error($response->data);
        }

        $getCollection = $response->data;

        return new CampaignCollection($getCollection);

    }

    public function getInstance(
        string $id
    )
    {
        $response = $this->get('campaigns/' . $id);

        if (!$response->success) {
            return new Error($response->data);
        }

        $getInstance = $response->data;

        return new Campaign($getInstance);
    }

    public function createInstance(
        array $body
    )
    {
        $response = $this->post('campaigns', $body);

        if (!$response->success) {
            return new Error($response->data);
        }

        $createInstance = $response->data;

        return new CreateCampaign($createInstance);
    }

    public function updateInstance(
        string $id,
        array  $body
    )
    {
        $response = $this->put('campaigns/' . $id, $body);

        if (!$response->success) {
            return new Error($response->data);
        }

        $updateInstance = $response->data;

        return new UpdateCampaign($updateInstance);
    }

    public function deleteInstance(
        string $id
    )
    {
        $response = $this->destroy('campaigns/' . $id);

        if (!$response->success) {
            return new Error($response->data);
        }

        $deleteInstance = $response->data;

        return new CampaignDeletion($deleteInstance);
    }

    public function sendTestEmail(
        string $id,
        array  $body
    )
    {
        $validator = Validator::make($body, [
            'email' => 'required',
        ]);

        $response = $this->put('campaigns/' . $id . '/sendtest', $body);

        if (!$response->success) {
            return new Error($response->data);
        }

        $sendTestEmail = $response->data;

        return new SendTestEmail($sendTestEmail);
    }

    public function sendCampaign(
        string $id
    )
    {
        $response = $this->put('campaigns/' . $id . '/send', []);

        if (!$response->success) {
            return new Error($response->data);
        }

        $sendCampaign = $response->data;

        return new SendCampaign($sendCampaign);
    }

    public function schedule(
        string $id,
        array  $body
    )
    {
        $response = $this->put('campaigns/' . $id . '/schedule', $body);

        if (!$response->success) {
            return new Error($response->data);
        }

        $schedule = $response->data;

        return new Schedule($schedule);
    }

    public function cancelScheduling(
        string $id
    )
    {
        $response = $this->put('campaigns/' . $id . '/unschedule', []);

        if (!$response->success) {
            return new Error($response->data);
        }

        $cancelScheduling = $response->data;

        return new CancelScheduling($cancelScheduling);
    }

    public function archive(
        string $id
    )
    {
        $response = $this->put('campaigns/' . $id . '/archive', []);

        if (!$response->success) {
            return new Error($response->data);
        }

        $archive = $response->data;

        return new CampaignArchiving($archive);
    }

    public function unarchive(
        string $campaign_id

    )
    {
        $response = $this->put('campaigns/' . $campaign_id . '/archivecampaign', []);

        if (!$response->success) {
            return new Error($response->data);
        }

        $unarchive = $response->data;

        return new CampaignArchiving($unarchive);
    }

    public function cloning(
        array $body
    )
    {
        $response = $this->post('newsletters?clone=1', $body);

        if (!$response->success) {
            return new Error($response->data);
        }

        $clone = $response->data;

        return new Cloning($clone);
    }

    public function getLinkCollection(
        string $id
    )
    {
        $response = $this->get('campaigns/' . $id . '/links');

        if (!$response->success) {
            return new Error($response->data);
        }

        $getLinkCollection = $response->data;

        return new LinkCollection($getLinkCollection);
    }
}
