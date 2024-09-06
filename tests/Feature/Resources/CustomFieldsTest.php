<?php

namespace OfflineAgency\LaravelEmailChef\Tests\Feature\Resources;

use Illuminate\Support\Collection;
use OfflineAgency\LaravelEmailChef\Api\Resources\CustomFieldsApi;
use OfflineAgency\LaravelEmailChef\Entities\CustomFields\CreatedCustomFieldsEntity;
use OfflineAgency\LaravelEmailChef\Entities\CustomFields\UpdatedCustomFieldsEntity;
use OfflineAgency\LaravelEmailChef\Entities\CustomFields\CustomFieldsEntity;
use OfflineAgency\LaravelEmailChef\Entities\CustomFields\CountCustomFieldsEntity;
use OfflineAgency\LaravelEmailChef\Entities\CustomFields\GetCollection;
use OfflineAgency\LaravelEmailChef\Entities\CustomFields\GetInstance;
use OfflineAgency\LaravelEmailChef\Tests\TestCase;
use PHPUnit\Framework\Constraint\Count;

class CustomFieldsTest extends TestCase
{
    public function test_get_collection()//todo: check this method
    {
        $custom_fields = new CustomFieldsApi;

        $response = $custom_fields->getCollection(
            108094
        );

        $custom_fields = $response->first();
        //todo: check if "$this->assertInstanceOf(GetCollection::class, $custom_fields);" should be put
        $this->assertInstanceOf(GetCollection::class, $custom_fields);
        $this->assertIsInt($custom_fields->id);
        $this->assertIsInt($custom_fields->list_id);
        $this->assertIsString($custom_fields->name);
        $this->assertIsInt($custom_fields->type_id);
        $this->assertIsString($custom_fields->place_holder);
        $this->assertIsArray($custom_fields->options);
        $this->assertIsInt($custom_fields->default_value);
        $this->assertIsInt($custom_fields->admin_only);
        $this->assertIsInt($custom_fields->ord);
        $this->assertIsString($custom_fields->data_type);
    }

    public function test_get_instance()
    {
        $custom_fields = new CustomFieldsApi;

        $response = $custom_fields->getInstance(
            171072
        );

        $this->assertInstanceOf(GetInstance::class, $response);
    }

    public function test_get_count()
    {
        $custom_fields = new CustomFieldsApi;

        $response = $custom_fields->count(
            108094
        );

        $this->assertInstanceOf(CountCustomFieldsEntity::class, $response);
        $this->assertIsInt($response->totalcount);
    }

    public function test_create()
    {
        $custom_fields = new CustomFieldsApi();
        $instance = [
            'data_type' => 'boolean',
            'name' => 'Smartphone2',
            'place_holder' => 'smartphone2',
            'default_value' => 1
        ];
        $response = $custom_fields->create(
            108094,
            $instance
        );

        $this->assertInstanceOf(CreatedCustomFieldsEntity::class, $response);
    }

    public function test_update()//todo: check this method
    {
        $custom_fields = new CustomFieldsApi();

        $instance = [
            'list_id' => 108094,
            'name' => 'Smartphone3',
            'type_id' => 4,
            'place_holder' => 'smartphone3',
            'options' => [],
            'default_value' => 1,
            'admin_only' => 0,
            'ord' =>  [],
            'data_type' => 'string',
        ];

        $response = $custom_fields->update(
            171072,
            $instance
        );

        $this->assertInstanceOf(UpdatedCustomFieldsEntity::class, $response);
        $this->assertIsInt($response->custom_field_id);
    }

    public function test_delete()
    {
        $custom_fields = new CustomFieldsApi();

        $instance = [
            'data_type' => 'boolean',
            'name' => 'Smartphone1',
            'place_holder' => 'smartphone1',
            'default_value' => 1
        ];

        $response = $custom_fields->create(
            108094,
            $instance
        );

        $response = $custom_fields->delete($response->custom_field_id);

        $this->assertIsString($response);
    }
}
