<?php

namespace OfflineAgency\LaravelEmailChef\Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Config;
use OfflineAgency\LaravelEmailChef\LaravelEmailChefFacade;
use OfflineAgency\LaravelEmailChef\LaravelEmailChefServiceProvider;
use Orchestra\Testbench\Concerns\CreatesApplication;

class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        Config::set('email-chef.baseUrl', 'https://app.emailchef.com/apps/api/v1/');
        Config::set('email-chef.login_url', 'https://app.emailchef.com/api/');
        Config::set('email-chef.username', '');
        Config::set('email-chef.password', '');
        Config::set('email-chef.list_id', '97322');

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'OfflineAgency\\LaravelEmailChef\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelEmailChefServiceProvider::class,
        ];
    }

    public function getPackageAliases(
        $app
    ): array {
        return [
            'LaravelEmailChef' => LaravelEmailChefFacade::class,
        ];
    }
}
