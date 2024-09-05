<?php

namespace OfflineAgency\LaravelEmailChef\Api\Resources;

use OfflineAgency\LaravelEmailChef\Api\Api;
use Illuminate\Support\Facades\Validator;
use OfflineAgency\LaravelEmailChef\Entities\Autoresponders\AutoresponderCount;
use OfflineAgency\LaravelEmailChef\Entities\Autoresponders\AutoresponderCollection;
use OfflineAgency\LaravelEmailChef\Entities\Autoresponders\Autoresponder;
use OfflineAgency\LaravelEmailChef\Entities\Autoresponders\CreateAutoresponder;
use OfflineAgency\LaravelEmailChef\Entities\Autoresponders\UpdateAutoresponder;
use OfflineAgency\LaravelEmailChef\Entities\Autoresponders\AutoresponderDeletion;
use OfflineAgency\LaravelEmailChef\Entities\Autoresponders\SendTestEmail;
use OfflineAgency\LaravelEmailChef\Entities\Autoresponders\AutoresponderActivation;
use OfflineAgency\LaravelEmailChef\Entities\Autoresponders\Cloning;
use OfflineAgency\LaravelEmailChef\Entities\Autoresponders\AutoresponderLinks;
use OfflineAgency\LaravelEmailChef\Entities\Error;

class AutorespondersApi extends Api
{
    public function getCount()
    {
        $response = $this->get('autoresponders/count');

        if (!$response->success) {
            return new Error($response->data);
        }

        $getCount = $response->data;

        return new AutoresponderCount($getCount);
    }

    //TODO: check with test if the parameters are required, maybe make it not required on method sign
    public function getCollection(
        ?int   $limit,
        ?int   $offset,
        string $orderby,
        string $ordertype
    )
    {
        $response = $this->get('autoresponders', [
            'limit' => $limit,
            'offset' => $offset,
            'orderby' => $orderby,
            'ordertype' => $ordertype,
        ]);


        if (!$response->success) {
            return new Error($response->data);
        }

        $getCollection = $response->data;

        return new AutoresponderCollection($getCollection);
    }

    public function getInstance(
        string $id
    )
    {
        $response = $this->get('autoresponders/' . $id);

        if (!$response->success) {
            return new Error($response->data);
        }

        $getInstance = $response->data;

        return new Autoresponder($getInstance);
    }

    public function createInstance(
        array $body
    )
    {
        //TODO: add validation after test
        $response = $this->post('autoresponders', $body);

        if (!$response->success) {
            return new Error($response->data);
        }

        $create = $response->data;

        return new CreateAutoresponder($create);
    }

    public function updateInstance(
        string $id,
        array  $body
    )
    {
        $response = $this->put('autoresponders/' . $id, $body);

        if (!$response->success) {
            return new Error($response->data);
        }

        $updateInstance = $response->data;

        return new UpdateAutoresponder($updateInstance);
    }

    public function deleteInstance(
        string $id
    )
    {
        $response = $this->destroy('autoresponders/' . $id);

        if (!$response->success) {
            return new Error($response->data);
        }

        $deleteInstance = $response->data;

        return new AutoresponderDeletion($deleteInstance);
    }

    public function sendTestEmail(
        string $id,
        array  $body
    )
    {
        $validator = Validator::make($body, [
            'email' => 'required',
        ]);

        $response = $this->put('autoresponders/' . $id . '/sendtest', $body);

        if (!$response->success) {
            return new Error($response->data);
        }

        $sendTestEmail = $response->data;

        return new SendTestEmail($sendTestEmail);
    }

    public function activate(
        string $id
    )
    {
        $response = $this->put('autoresponders/' . $id . '/activate', []);

        if (!$response->success) {
            return new Error($response->data);
        }

        $activate = $response->data;

        return new AutoresponderActivation($activate);
    }

    public function deactivate(
        string $id
    )
    {
        $response = $this->put('autoresponders/' . $id . '/deactivate', []);

        if (!$response->success) {
            return new Error($response->data);
        }

        $deactivate = $response->data;

        return new AutoresponderActivation($deactivate);
    }

    public function cloning(
        string $id
    )
    {
        $response = $this->put('autoresponders/' . $id . '/clone', []);

        if (!$response->success) {
            return new Error($response->data);
        }

        $clone = $response->data;

        return new Cloning($clone);
    }

    public function getLinksCollection(
        string $id
    )
    {
        $response = $this->get('autoresponders/' . $id . '/links');

        if (!$response->success) {
            return new Error($response->data);
        }

        $getLinksCollection = $response->data;

        return new AutoresponderLinks($getLinksCollection);
    }
}
