<?php

namespace OfflineAgency\LaravelEmailChef\Api\Resources;

use OfflineAgency\LaravelEmailChef\Api\Api;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\Archive;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\CancelScheduling;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\Cloning;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\Collection;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\Count;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\CreateInstance;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\DeleteInstance;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\Instance;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\LinkCollection;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\Schedule;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\SendCampaign;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\SendTestEmail;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\Unarchive;
use OfflineAgency\LaravelEmailChef\Entities\Campaigns\UpdateInstance;
use OfflineAgency\LaravelEmailChef\Entities\Error;

class CampaignsApi extends Api
{
    private $error;

    public function archive(
        $id
    ) {
        $response = $this->put('campaigns/' . $id . '/archive', []);

        if (! $response->success) {
            return new Error($response->data);
        }

        $archive = $response->data;

        return new Archive($archive);
    }

    public function cancelScheduling(
        $id
    ) {
        $response = $this->put('campaigns/' . $id . '/unschedule', []);

        if (! $response->success) {
            return new Error($response->data);
        }

        $cancelScheduling = $response->data;

        return new CancelScheduling($cancelScheduling);
    }

    public function cloning(
        array $body
    ) {
        $response = $this->put('newsletters?clone=1', $body);

        if (! $response->success) {
            return new Error($response->data);
        }

        $clone = $response->data;

        return new Cloning($clone);

    }

    public function getCollection(
        $status,
        ?int $limit,
        ?int $offset,
        string $orderby,
        string $ordertype
    ) {
        $response = $this->get('campaigns', [
            'status' => $status,
            'limit' => $limit,
            'offset' => $offset,
            'orderby' => $orderby,
            'ordertype' => $ordertype,
        ]);

        if (! $response->success) {
            return new Error($response->data);
        }

        $getCollection = $response->data;

        return new Collection($getCollection);

    }

    public function getCount()
    {
        $response = $this->get('campaigns/count');

        $this->error = new Error($response->data);
        if (! $response->success) {
            return $this->error;
        }

        $getCount = $response->data;

        return new Count($getCount);
    }

    public function getInstance(
        $id
    ) {
        $response = $this->get('campaigns/' . $id);

        if (! $response->success) {
            return new Error($response->data);
        }

        $getInstance = $response->data;

        return new Instance($getInstance);
    }

    public function createInstance(
        $body
    ) {
        $response = $this->post('campaigns', $body);

        if (! $response->success) {
            return new Error($response->data);
        }

        $createInstance = $response->data;

        return new CreateInstance($createInstance);
    }

    public function deleteInstance(
        $id
    ) {
        $response = $this->destroy('campaigns/' . $id);

        if (! $response->success) {
            return new Error($response->data);
        }

        $deleteInstance = $response->data;

        return new DeleteInstance($deleteInstance);
    }

    public function getLinkCollection(
        $id
    ) {
        $response = $this->get('campaigns/' . $id . '/links');

        if (! $response->success) {
            return new Error($response->data);
        }

        $getLinkCollection = $response->data;

        return new LinkCollection($getLinkCollection);
    }

    public function schedule(
        $id,
        array $body
    ) {
        $response = $this->put('campaigns/' . $id . '/schedule', $body);

        if (! $response->success) {
            return new Error($response->data);
        }

        $schedule = $response->data;

        return new Schedule($schedule);
    }

    public function updateInstance(
        $id,
        array $body
    ) {
        $response = $this->put('campaigns/' . $id, $body);

        if (! $response->success) {
            return new Error($response->data);
        }

        $updateInstance = $response->data;

        return new UpdateInstance($updateInstance);
    }

    public function sendCampaign(
        $id
    ) {
        $response = $this->put('campaigns/' . $id.'/send', []);

        if (! $response->success) {
            return new Error($response->data);
        }

        $sendCampaign = $response->data;

        return new SendCampaign($sendCampaign);
    }

    public function sendTestEmail(
        $id,
        $body
    ) {
        $response = $this->put('campaigns/' . $id. '/sendtest', $body);

        if (! $response->success) {
            return new Error($response->data);
        }

        $sendTestEmail = $response->data;

        return new SendTestEmail($sendTestEmail);
    }

    public function unarchive(
        $campaign_id

    ) {
        $response = $this->put('campaigns/' . $campaign_id . '/archivecampaign', []);

        if (! $response->success) {
            return new Error($response->data);
        }

        $unarchive = $response->data;

        return new Unarchive($unarchive);
    }

}
