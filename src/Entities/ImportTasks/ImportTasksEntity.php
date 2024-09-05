<?php

namespace OfflineAgency\LaravelEmailChef\Entities\ImportTasks;

use OfflineAgency\LaravelEmailChef\Entities\AbstractEntity;

class ImportTasksEntity extends AbstractEntity //TODO: check variables
{
    public int $id;
    public int $list_id;
    public string $creation_time;
    public string $error_message;
    public string $imported_success;
    public string $imported_fail;
    public string $imported_updated;
    public string $last_updated;
    public int $progress;
    public string $uploaded_file_name;
    public string $list_name;
    public string $notification_link;
}
