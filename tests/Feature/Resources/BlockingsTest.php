<?php

namespace OfflineAgency\LaravelChef\Tests\Feature\Resources;

use Illuminate\Support\Collection;
use OfflineAgency\LaravelEmailChef\Api\Resources\BlockingsApi;
use OfflineAgency\LaravelEmailChef\Entities\Blockings\BlockingsEntity;
use OfflineAgency\LaravelEmailChef\Entities\Blockings\CreatedBlockingsEntity;
use OfflineAgency\LaravelEmailChef\Entities\Blockings\CountBlockingsEntity;
use OfflineAgency\LaravelEmailChef\Entities\Blockings\GetCollection;
use OfflineAgency\LaravelEmailChef\Tests\TestCase;
use voku\helper\ASCII;

class BlockingsTest extends TestCase
{
    public function test_get_collection()
    {
        $blockings = new BlockingsApi();

        $response = $blockings->getCollection(
            'ciao@gmail.com',
            null,
            null
        );

        $blocking = $response->first();

        $this->assertInstanceOf(GetCollection::class, $blocking);
        $this->assertIsString($blocking->email);
        $this->assertIsString($blocking->type);
    }

    public function test_get_count()
    {
        $blockings = new BlockingsApi();

        $response = $blockings->count(
            'ciao@gmail.com',
        );

        $this->assertInstanceOf(CountBlockingsEntity::class, $response);
        $this->assertIsInt($response->totalcount);
    }

    public function test_create()//todo: check this method (the response is different from the one expected
    {
        $blockings = new BlockingsApi();

        $response = $blockings->create(
            'test_create@gmail.com',
            'UNSUBSCRIBED'
        );

        $this->assertInstanceOf(CreatedBlockingsEntity::class, $response);
    }

    public function test_delete()
    {
        $blockings = new BlockingsApi();

        $response = $blockings->create(
            'test_delete@gmail.com',
            'test_delete@gmail.com'
        );

        $response = $blockings->delete('user12354@gmail.com');

        $this->assertIsString($response);
    }
}
