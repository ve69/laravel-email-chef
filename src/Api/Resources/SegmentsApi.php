<?php

namespace OfflineAgency\LaravelEmailChef\Api\Resources;

use Carbon\Carbon;
use OfflineAgency\LaravelEmailChef\Api\Api;
use OfflineAgency\LaravelEmailChef\Entities\Error;
use OfflineAgency\LaravelEmailChef\Entities\Segments\SegmentCollection;
use OfflineAgency\LaravelEmailChef\Entities\Segments\Segment;
use OfflineAgency\LaravelEmailChef\Entities\Segments\SegmentCount;
use OfflineAgency\LaravelEmailChef\Entities\Segments\ContactsCount;
use OfflineAgency\LaravelEmailChef\Entities\Segments\CreateSegment;
use OfflineAgency\LaravelEmailChef\Entities\Segments\UpdateSegment;
use OfflineAgency\LaravelEmailChef\Entities\Segments\SegmentDeletion;

class SegmentsApi extends Api
{
    public function getCollection(
        string $list_id,
        ?int $limit,
        ?int $offset
    ) {
        $response = $this->get('segments', [
            'list_id' => $list_id,
            'limit' => $limit,
            'offset' => $offset,
        ]);

        if (! $response->success) {
            return new Error($response->data);
        }

        $getCollection = $response->data;

        return new SegmentCollection($getCollection);
    }

    public function getInstance(
        string $segment_id
    )
    {
        $response = $this->get('lists/251338/segments/' . $segment_id);

        if (! $response->success) {
            return new Error($response->data);
        }

        $getInstance = $response->data;

        return new Segment($getInstance);
    }

    public function getCount(
        string $list_id
    )
    {
        $response = $this->get('lists/' . $list_id . '/segments/count?');

        if (! $response->success) {
            return new Error($response->data);
        }

        $getCount = $response->data;

        return new SegmentCount($getCount);
    }

    public function getContactsCount(
        string $segment_id
    )
    {
        $response = $this->get('segments/' . $segment_id . '/contacts/count');

        if (! $response->success) {
            return new Error($response->data);
        }

        $getContactsCount = $response->data;

        return new ContactsCount($$getContactsCount);
    }

    public function createInstance(
        array $body
    )
    {
        $response = $this->post('segments ', $body);

        if (! $response->success) {
            return new Error($response->data);
        }

        $createInstance = $response->data;

        return new CreateSegment($createInstance);
    }

    public function updateInstance(
        string $segment_id,
        array $body
    )
    {
        $response = $this->put('segments/'. $segment_id, $body);

        if (! $response->success) {
            return new Error($response->data);
        }

        $updateInstance = $response->data;

        return new UpdateSegment($updateInstance);
    }

    public function deleteInstance(
        string $segment_id
    )
    {
        $response = $this->destroy('segments/'. $segment_id);

        if (! $response->success) {
            return new Error($response->data);
        }

        $deleteInstance = $response->data;

        return new SegmentDeletion($deleteInstance);
    }
}
