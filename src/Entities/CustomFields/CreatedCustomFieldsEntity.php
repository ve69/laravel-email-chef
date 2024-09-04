<?php

namespace OfflineAgency\LaravelEmailChef\Entities\CustomFields;

use OfflineAgency\LaravelEmailChef\Entities\AbstractEntity;

class CreatedCustomFieldsEntity extends AbstractEntity
{
    public string $status;
    public int $custom_field_id;
    public bool $updated; //Lo mettiamo come in contacts?
}
