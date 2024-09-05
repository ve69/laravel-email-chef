<?php

namespace OfflineAgency\LaravelEmailChef\Api\Resources;

use OfflineAgency\LaravelEmailChef\Api\Api;
use OfflineAgency\LaravelEmailChef\Entities\Autoresponders\Activate;
use OfflineAgency\LaravelEmailChef\Entities\Autoresponders\Cloning;
use OfflineAgency\LaravelEmailChef\Entities\Autoresponders\CreateInstance;
use OfflineAgency\LaravelEmailChef\Entities\Autoresponders\Deactivate;
use OfflineAgency\LaravelEmailChef\Entities\Autoresponders\DeleteInstance;
use OfflineAgency\LaravelEmailChef\Entities\Autoresponders\Collection;
use OfflineAgency\LaravelEmailChef\Entities\Autoresponders\Count;
use OfflineAgency\LaravelEmailChef\Entities\Autoresponders\Instance;
use OfflineAgency\LaravelEmailChef\Entities\Autoresponders\LinksCollection;
use OfflineAgency\LaravelEmailChef\Entities\Autoresponders\SendTestEmail;
use OfflineAgency\LaravelEmailChef\Entities\Autoresponders\UpdateInstance;
use OfflineAgency\LaravelEmailChef\Entities\Error;

class AutorespondersApi extends Api
{
    private $error;

    public function activate(
        $id
    ) {
        $response = $this->put('autoresponders/' . $id . '/activate', []);

        if (! $response->success) {
            return new Error($response->data);
        }

        $activate = $response->data;

        return new Activate($activate);
    }

    public function cloning(
        $id,
        array $body
    ) {
        $response = $this->put('autoresponders/' . $id . '/clone', $body);

        if (! $response->success) {
            return new Error($response->data);
        }

        $clone = $response->data;

        return new Cloning($clone);

    }


    public function createInstance(
        $body
    ) {
        $response = $this->post('autoresponders', $body);

        if (! $response->success) {
            return new Error($response->data);
        }

        $create = $response->data;

        return new CreateInstance($create);
    }

    public function deactivate(
        $id
    ) {
        $response = $this->put('autoresponders/' . $id . '/deactivate', []);

        if (! $response->success) {
            return new Error($response->data);
        }

        $deactivate = $response->data;

        return new Deactivate($deactivate);
    }

    public function deleteInstance(
        $id
    ) {
        $response = $this->destroy('autoresponders/' . $id);

        if (! $response->success) {
            return new Error($response->data);
        }

        $deleteInstance = $response->data;

        return new DeleteInstance($deleteInstance);
    }

    public function getCollection(
        ?int $limit,
        ?int $offset,
        string $orderby,
        string $ordertype
    ) {
        $response = $this->get('autoresponders', [
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
        $response = $this->get('autoresponders/count');

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
        $response = $this->get('autoresponders/' . $id);

        if (! $response->success) {
            return new Error($response->data);
        }

        $getInstance = $response->data;

        return new Instance($getInstance);
    }

    public function getLinksCollection(
        $id
    ) {
        $response = $this->get('autoresponders/' . $id . '/links');

        if (! $response->success) {
            return new Error($response->data);
        }

        $getLinksCollection = $response->data;

        return new LinksCollection($getLinksCollection);
    }

    public function sendTestEmail(
        $id,
        array $body
    ) {
        $response = $this->put('autoresponders/' . $id . '/sendtest', $body);

        if (! $response->success) {
            return new Error($response->data);
        }

        $sendTestEmail = $response->data;

        return new SendTestEmail($sendTestEmail);
    }

    public function updateInstance(
         $id,
        array $body
    ) {
        $response = $this->put('autoresponders/' . $id, $body);

        if (! $response->success) {
            return new Error($response->data);
        }

        $updateInstance = $response->data;

        return new UpdateInstance($updateInstance);
    }

}
