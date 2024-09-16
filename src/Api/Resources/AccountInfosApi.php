<?php

namespace OfflineAgency\LaravelEmailChef\Api\Resources;

use OfflineAgency\LaravelEmailChef\Api\Api;
use OfflineAgency\LaravelEmailChef\Entities\AccountInfos\GetInstance;
use OfflineAgency\LaravelEmailChef\Entities\AccountInfos\UpdatedAccountInfosEntity;
use OfflineAgency\LaravelEmailChef\Entities\Error;

class AccountInfosApi extends Api
{
    public function getInstance(
        string $accountId
    )
    {
        $response = $this->get('account_infos/'.$accountId);

        if (! $response->success) {
            return new Error($response->data);
        }

        return new GetInstance($response->data);
    }

    public function update(
        string $accountId
    )
    {
        $response = $this->put('account_infos/'.$accountId, []);


        if (! $response->success) {
            return new Error($response->data);
        }

        return new UpdatedAccountInfosEntity($response->data);
    }
}
