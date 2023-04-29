<?php

namespace OfflineAgency\LaravelEmailChef\Tests\Feature\Resources;

use Illuminate\Support\Facades\Http;
use OfflineAgency\LaravelEmailChef\Api\Resources\ContactsApi;
use OfflineAgency\LaravelEmailChef\Tests\TestCase;

class ContactsTest extends TestCase
{
    public function test_create()
    {
        $contacts = new ContactsApi;

        $contacts->callTest();

        $response = $contacts->create([
            'list_id' => 97320,
            'status ' => 'ACTIVE',
            'email' => 'ciao@gmail.com',
            'firstname' => 'Mario',
            'lastname' => 'Rossi',

        ]);

        dd($response);
    }

    public function test_simple_callback()
    {
        $result = Http::withHeaders([
            'Accept' => 'application/json; charset=utf-8',
        ])->post('https://app.emailchef.com/api/login', [
            'username' => 'support@offlineagency.it',
            'password' => ''
        ]);

        $result_body = json_decode($result->body());

        /*$response = Http::withHeaders([
            'authkey' => $result_body->authkey
        ])->get('https://app.emailchef.com/apps/api/v1/accounts/current');*/

        $response = Http::withHeaders([
            'authkey' => $result_body->authkey,
            'Accept' => 'application/json; charset=utf-8'
        ])->post('https://app.emailchef.com/apps/api/v1/contacts', [
            'instance_in' => [
                'list_id' => 97322,
                'status ' => 'ACTIVE',
                'email' => 'ciao@gmail.com',
                'firstname' => 'Mario',
                'lastname' => 'Rossi',
                'custom_fields' => [
                    [
                        'test' => 'OK'
                    ]
                ],
                'mode' => 'ADMIN'
            ]
        ]);

        dd($response->status(), $response->body());
    }
}
