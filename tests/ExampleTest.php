<?php

namespace OfflineAgency\LaravelEmailChef\Tests;

use OfflineAgency\LaravelEmailChef\LaravelEmailChef;

class ExampleTest extends TestCase
{
    public function test_login()
    {
        $LaravelEmailChef = new LaravelEmailChef;

        $LaravelEmailChef->login();
    }
}
