<?php

namespace OfflineAgency\LaravelEmailChef\Entities\ImportTasks;

use OfflineAgency\LaravelEmailChef\Entities\AbstractEntity;

class GetInstance extends AbstractEntity //todo: check if the flagged variables are necessary
{
    public int $id;
    public int $list_id;
    public string $status; //necessary?
    public string $error_message;
    public int $progress;
    public int $imported;
    public int $failed;
    public string $last_updated; //necessary?
    public string $upload_file_name;
    public string $notification_link;
    public string $list_name;
}
