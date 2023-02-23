<?php

namespace OfflineAgency\LaravelEmailChef\Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Database\Eloquent\Factories\Factory;
use OfflineAgency\LaravelEmailChef\LaravelEmailChefFacade;
use OfflineAgency\LaravelEmailChef\LaravelEmailChefServiceProvider;
use Orchestra\Testbench\Concerns\CreatesApplication;

class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

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
