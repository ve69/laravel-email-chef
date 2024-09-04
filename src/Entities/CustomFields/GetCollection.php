<?php

namespace OfflineAgency\LaravelEmailChef\Entities\CustomFields;

use OfflineAgency\LaravelEmailChef\Entities\AbstractEntity;

class GetCollection extends AbstractEntity
{
    public int $id;
    public int $list_id;
    public string $name;
    public int $type_id;
    public string $place_holder;
    public array $options;
    public int $default_value;
    public int $admin_only;
    public int $ord;
    public string $data_type;
}
