<?php

namespace OfflineAgency\LaravelEmailChef\Api\Resources;

use Illuminate\Support\Facades\Validator;
use OfflineAgency\LaravelEmailChef\Api\Api;

class ContactsApi extends Api
{
    public function create(
        array $instance_in = [],
        string $mode = 'ADMIN'
    ) {
        $validator = Validator::make($instance_in, [
            /*'data' => 'required',
            'data.name' => 'required',*/
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $response = $this->post(
            'contacts',
            [
                'instance_in' => $instance_in,
                'mode' => $mode
            ]
        );
dd($response);
/*        if (! $response->success) {
            return new Error($response->data);
        }

        $client = $response->data->data;

        return new ClientEntity($client);*/
    }
}
