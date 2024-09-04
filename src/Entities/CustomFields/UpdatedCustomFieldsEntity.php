<?php

namespace OfflineAgency\LaravelEmailChef\Entities\CustomFields;

use OfflineAgency\LaravelEmailChef\Entities\AbstractEntity;

class UpdatedCustomFieldsEntity extends AbstractEntity
{
    public bool $updated;
    public int $custom_field_id;
}
