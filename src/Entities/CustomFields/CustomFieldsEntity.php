<?php

namespace OfflineAgency\LaravelEmailChef\Entities\CustomFields;

use OfflineAgency\LaravelEmailChef\Entities\AbstractEntity;

class CustomFieldsEntity extends AbstractEntity
{
    public int $id;
    public int $list_id;
    public string $name;
    public int $type_id;
    public string $place_holder;
    public array $options;
    public string $default_value;
    public int $admin_only;
    public int $ord;
    public string $data_type;
}
