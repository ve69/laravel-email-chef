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

        ]);

        dd($response);
    }
}
