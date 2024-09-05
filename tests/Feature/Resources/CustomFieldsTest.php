<?php

namespace OfflineAgency\LaravelEmailChef\Tests\Feature\Resources;

use Illuminate\Support\Collection;
use OfflineAgency\LaravelEmailChef\Api\Resources\CustomFieldsApi;
use OfflineAgency\LaravelEmailChef\Api\Resources\ListsApi;
use OfflineAgency\LaravelEmailChef\Entities\CustomFields\CreatedCustomFieldsEntity;
use OfflineAgency\LaravelEmailChef\Entities\Lists\ContactList;
use OfflineAgency\LaravelEmailChef\Entities\Lists\GetCollection;
use OfflineAgency\LaravelEmailChef\Entities\Lists\GetInstance;
use OfflineAgency\LaravelEmailChef\Entities\Lists\GetStats;
use OfflineAgency\LaravelEmailChef\Entities\Lists\UpdateList;
use OfflineAgency\LaravelEmailChef\Tests\TestCase;

class CustomFieldsTest extends TestCase
{
    /* TEST NOT WORKING
    public function test_get_collection()
    {
        $custom_fields = new CustomFieldsApi;

        $response = $custom_fields->getCollection(
            108094
        );
        dd($response);
        $custom_fields = $response->first();
        dd($custom_fields);
        $this->assertInstanceOf(Collection::class, $custom_fields);




    }*/

    public function test_create()
    {
        $custom_fields = new CustomFieldsApi();
        $array = [
            'data_type' => 'boolean',
            'name' => 'Smartphone6',
            'place_holder' => 'smartphone6',
            'default_value' => 1
        ];
        $response = $custom_fields->create(
            108094,
            $array
        );

        $this->assertInstanceOf(CreatedCustomFieldsEntity::class, $response);
    }

    public function test_delete()
    {
        $custom_fields = new CustomFieldsApi();

        $array = [
            'data_type' => 'boolean',
            'name' => 'Smartphone7',
            'place_holder' => 'smartphone7',
            'default_value' => 1
        ];

        $response = $custom_fields->create(
            108094,
            $array
        );

        $response = $custom_fields->delete($response->custom_field_id);

        $this->assertIsString($response);
    }
}
