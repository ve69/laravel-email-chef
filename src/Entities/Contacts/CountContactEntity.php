<?php

namespace OfflineAgency\LaravelEmailChef\Entities\Contacts;

use OfflineAgency\LaravelEmailChef\Entities\AbstractEntity;

class CountContactEntity extends AbstractEntity
{
    public int $active;
    public int $unsubscribed;
    public int $bounced;
    public int $reported;
}
