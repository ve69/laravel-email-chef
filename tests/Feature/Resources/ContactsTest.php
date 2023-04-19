<?php

namespace OfflineAgency\LaravelEmailChef\Tests\Feature\Resources;

use OfflineAgency\LaravelEmailChef\Api\Resources\ContactsApi;
use OfflineAgency\LaravelEmailChef\Tests\TestCase;

class ContactsTest extends TestCase
{
    public function test_create()
    {
        $contacts = new ContactsApi;

        $response = $contacts->create([
            'list_id' => 97320,
            'status ' => 'ACTIVE',
            'email' => 'ciao@gmail.com',
            'firstname' => 'Mario',
            'lastname' => 'Rossi',
            'custom_fields' => [
/*                'id' => '1212',
                'list_id' => '251338',
                'name' => 'Smartphone4',
                'type_id' => '1',
                'place_holder' => 'smartphone4',
                'options' => 'nul',
                'default_value' => '1',
                'admin_only' => '0',
                'ord' => '8',
                'data_type' => 'text',
                'value' => '1'*/
            ]
        ]);

        dd($response);
    }
}
