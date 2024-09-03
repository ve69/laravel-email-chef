<?php

namespace OfflineAgency\LaravelEmailChef\Entities\PredefinedFields;

use OfflineAgency\LaravelEmailChef\Entities\AbstractEntity;

class PredefinedFieldsEntity extends AbstractEntity
{
    public int $id;
    public string $name;
    public int $type_id;
    public string $place_holder;
    public string $reference;
    public int $mandatory;
    public string $data_type;

}
