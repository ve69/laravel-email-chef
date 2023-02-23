<?php

namespace OfflineAgency\LaravelEmailChef\Commands;

use Illuminate\Console\Command;

class LaravelEmailChefCommand extends Command
{
    public $signature = 'laravel-email-chef';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
