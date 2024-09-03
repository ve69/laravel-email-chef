<?php

namespace OfflineAgency\LaravelEmailChef\Api\Resources;

use Illuminate\Support\Facades\Validator;
use OfflineAgency\LaravelEmailChef\Api\Api;
use OfflineAgency\LaravelEmailChef\Entities\Error;

class PredefinedFieldsApi extends Api
{
    public function getCollection(){
        $response = $this->get('/predefinedfields');
    }
}
