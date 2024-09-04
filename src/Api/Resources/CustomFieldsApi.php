<?php

namespace OfflineAgency\LaravelEmailChef\Api\Resources;

use Illuminate\Support\Facades\Validator;
use OfflineAgency\LaravelChef\Entities\CustomFields\UpdatedCustomFieldsEntity;
use OfflineAgency\LaravelEmailChef\Api\Api;
use OfflineAgency\LaraEmail\Entities\CustomFields\CountCustomFieldsEntity;
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
        $response = $this->get('lists/'.$list_id.'/custom-fields', [
            'list_id' => $list_id,
        ]);

        if (!$response->success) {
            return new Error($response->data);
        }

        $collection = $response->data;

        $out = collect();
        foreach ($collection as $collectionItem) {
            $out->push(new GetCollection($collectionItem));//Qui come devo fare?
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

        $instance = $response->data;

        return new GetInstance($instance);
    }

    public function count(
        int $list_id
    ) {
        $response = $this->get('lists/'.$list_id.'/custom-fields/count', [
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
            'data_type' => 'required',
            'name' => 'string',
            'place_holder' => 'string',
            'default_value' => 'integer'
        ]);

        if ($validator->fails()) {
            return new Error($validator->errors());
        }

        $response = $this->post('lists/'.$list_id.'/customfields', [
            'instance_in' => array_merge($instance_in, [
                //Non so cosa mettere
            ]),
        ]);

        if (!$response->success) {
            return new Error($response->data);
        }

        $instance = $response->data;

        return new CreatedCustomFieldsEntity($instance);
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
            'default_value' => 'integer'
        ]); //QUALI BISOGNA VALIDARE

        $response = $this->put('lists/customfields/'.$field_id, [
            'instance_in' => array_merge($instance_in, [

            ]),
        ]);

        if (!$response->success) {
            return new Error($response->data);
        }

        $instance = $response->data;

        return new UpdatedCustomFieldsEntity($instance);
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

