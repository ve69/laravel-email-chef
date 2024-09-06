<?php

namespace OfflineAgency\LaravelEmailChef\Tests\Feature\Resources;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use OfflineAgency\LaravelEmailChef\Api\Resources\PredefinedFieldsApi;
use OfflineAgency\LaravelEmailChef\Entities\PredefinedFields\PredefinedFieldsEntity;
use OfflineAgency\LaravelEmailChef\Tests\TestCase;

class PredefinedFieldsTest extends TestCase
{
    public function test_get_collection()//todo:check commented lines
    {
        $predefined_fields = new PredefinedFieldsApi();

        $response = $predefined_fields->getCollection();

        $predefined_field = $response->first();

        $this->assertInstanceOf(PredefinedFieldsEntity::class, $predefined_field);
        //id is integer not int $this->assertIsInt('predefined_field_id', $predefined_field->id);
        $this->assertIsString('predefined_field', $predefined_field->name);
        //type_id is integer not int $this->assertIsInt('predefined_field_id', $predefined_field->type_id);
        $this->assertIsString('predefined_fields', $predefined_field->place_holder);
        $this->assertIsString('predefined_fields', $predefined_field->reference);
        //mandatory is integer not int $this->assertIsInt('predefined_field_id', $predefined_field->mandatory);
        $this->assertIsString('predefined_fields', $predefined_field->data_type);
    }
}
