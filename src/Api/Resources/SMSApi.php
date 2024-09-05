<?php

namespace OfflineAgency\LaravelEmailChef\Api\Resources;

use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use OfflineAgency\LaravelEmailChef\Api\Api;
use OfflineAgency\LaravelEmailChef\Entities\Error;
use OfflineAgency\LaravelEmailChef\Entities\SMS\Send;
use OfflineAgency\LaravelEmailChef\Entities\SMS\Balance;
use OfflineAgency\LaravelEmailChef\Entities\SMS\StatusMessage;
use OfflineAgency\LaravelEmailChef\Entities\SMS\BulkMessageStatus;


class SMSApi extends Api
{
    public function send(
        array $body
    ) {

        $response = $this->post('sms/send', $body);

        if (! $response->success) {
            return new Error($response->data);
        }

        $send = $response->data;

        return new Send($send);
    }

    public function getBalance()
    {

        $response = $this->get('sms/balance');

        if (! $response->success) {
            return new Error($response->data);
        }

        $getBalance = $response->data;

        return new Balance($getBalance);
    }

    public function getStatusMessage(
        $messageId
    ) {

        $response = $this->get('sms/status/' . $messageId);

        if (! $response->success) {
            return new Error($response->data);
        }

        $getStatusMessage = $response->data;

        return new StatusMessage($getStatusMessage);
    }

    public function getBulkMessageStatus(
        $bulkId
    ) {

        $response = $this->get('sms/bulk/status/' . $bulkId);

        if (! $response->success) {
            return new Error($response->data);
        }

        $getBulkMessageStatus = $response->data;

        return new BulkMessageStatus($getBulkMessageStatus);
    }
}
