<?php

namespace OfflineAgency\LaravelEmailChef\Api\Resources;

use Illuminate\Support\Facades\Validator;
use OfflineAgency\LaravelEmailChef\Entities\CustomFields\UpdatedCustomFieldsEntity;
use OfflineAgency\LaravelEmailChef\Api\Api;
use OfflineAgency\LaravelEmailChef\Entities\CustomFields\CountCustomFieldsEntity;
use OfflineAgency\LaravelEmailChef\Entities\CustomFields\CustomFieldsEntity;
use OfflineAgency\LaravelEmailChef\Entities\CustomFields\CreatedCustomFieldsEntity;
use OfflineAgency\LaravelEmailChef\Entities\CustomFields\GetCollection;
use OfflineAgency\LaravelEmailChef\Entities\CustomFields\GetInstance;
use OfflineAgency\LaravelEmailChef\Entities\Error;

class CustomFieldsApi extends Api
{
    public function getCollection(
        int $list_id
    ) {
        $response = $this->get('lists/'.$list_id.'/customfields', [
            'list_id' => $list_id,
        ]);

        if (!$response->success) {
            return new Error($response->data);
        }

        $collection = $response->data;
            // dd(gettype($collection)); //ERROR: $collection è un array, dovrebbe essere un object <-- controllare tutte le chiamate in get
        $out = collect();
        foreach ($collection as $collectionItem) {//todo: check if condition
            // Set 'options' to an empty array if it's null
            $collectionItem->options = $collectionItem->options ?? [];

            // Set 'ord' to 0 if it's null
            $collectionItem->ord = $collectionItem->ord ?? 0;
            $out->push(new GetCollection($collectionItem));
        }

        return $out;
    }

    public function getInstance(
        int $field_id
    ) {
        $response = $this->get('customfields/'.$field_id, [
            'field_id' => $field_id,
        ]);

        if (!$response->success) {
            return new Error($response->data);
        }

        $customfield = $response->data;

        return new GetInstance($customfield);
    }

    public function count(
        int $list_id
    ) {
        $response = $this->get('lists/'.$list_id.'/customfields/count', [
            'list_id' => $list_id,
        ]);

        if (!$response->success) {
            return new Error($response->data);
        }

        $count = $response->data;

        return new CountCustomFieldsEntity($count);
    }

    public function create(
        int $list_id,
        array $instance_in = []
    ) {
        $validator = Validator::make($instance_in, [
            'data_type' => 'string',
            'name' => 'string',
            'place_holder' => 'string',
            'default_value' => 'integer'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $response = $this->post('lists/'.$list_id.'/customfields', [
            'instance_in' => $instance_in,
        ]);

        if (!$response->success) {
            return new Error($response->data);
        }

        $customfield = $response->data;

        return new CreatedCustomFieldsEntity($customfield);
    }

    public function update(
        int $field_id,
        array $instance_in = []
    ) {
        $validator = Validator::make($instance_in, [
            'list_id' => 'integer',
            'name' => 'string',
            'type_id' => 'integer',
            'place_holder' => 'string',
            'options' => 'array',
            'default_value' => 'integer',
            'admin_only' => 'integer',
            'ord' =>  'array',
            'data_type' => 'string',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $response = $this->put('lists/customfields/'.$field_id, [
            'instance_in' => $instance_in,
        ]);

        if (!$response->success) {
            return new Error($response->data);
        }

        $customfield = $response->data;

        return new UpdatedCustomFieldsEntity($customfield);
    }

    public function delete(
        int $field_id
    )
    {
        $response = $this->destroy('customfields/'.$field_id);

        if (!$response->success) {
            return new Error($response->data);
        }

        return 'CustomFields #'.$field_id.' deleted';
    }
}
