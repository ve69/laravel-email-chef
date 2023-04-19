<?php

use OfflineAgency\LaravelEmailChef\LaravelEmailChef;
use OfflineAgency\LaravelEmailChef\Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_login()
    {
        $LaravelEmailChef = new LaravelEmailChef;

        $LaravelEmailChef->login();
    }
}
