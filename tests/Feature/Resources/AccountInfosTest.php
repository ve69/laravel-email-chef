<?php

namespace OfflineAgency\LaravelEmailChef\Tests\Feature\Resources;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use OfflineAgency\LaravelEmailChef\Api\Resources\AccountInfosApi;
use OfflineAgency\LaravelEmailChef\Entities\AccountInfos\GetInstance;
use OfflineAgency\LaravelEmailChef\Entities\AccountInfos\UpdatedAccountInfosEntity;
use OfflineAgency\LaravelEmailChef\Tests\TestCase;

class AccountInfosTest extends TestCase
{
    public function test_get_instance()
    {
        $account = new AccountInfosApi();

        $response = $account->getInstance('810136');

        $this->assertInstanceOf(GetInstance::class, $response);
    }

    public function test_update()
    {
        $account = new AccountInfosApi();

        $response  = $account->update('810136');

        dd($response);//todo: check why there's an error
    }
}
