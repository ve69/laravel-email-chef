<?php

namespace OfflineAgency\LaravelEmailChef\Entities\Contacts;

use OfflineAgency\LaravelEmailChef\Entities\AbstractEntity;

class ContactsEntity extends AbstractEntity
{
    public int $id;
    public int $list_id;
    public string $name;
    public int $type_id;
    public string $place_holder;
    public array $options;
    public string $text;
    public string $default_value;

}
