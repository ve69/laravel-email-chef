<?php

namespace OfflineAgency\LaravelEmailChef\Entities\Lists;

use Carbon\Carbon;
use OfflineAgency\LaravelEmailChef\Entities\AbstractEntity;

class GetStats extends AbstractEntity
{
    public array $total_list;
    public array $daily_delta_list;
    public string $start_date;
    public string $last_date;

}
