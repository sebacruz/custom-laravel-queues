<?php

namespace Cruz\CustomLaravelQueues;

use Cruz\CustomLaravelQueues\Commands\CustomLaravelQueuesRunCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CustomLaravelQueuesServiceProvider extends PackageServiceProvider
{
    // public function register(): void
    // {
    //     parent::register();

    // }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('custom-laravel-queues')
            ->hasConfigFile(['custom-laravel-queues', 'logging'])
            ->hasViews()
            ->hasMigration('create_custom_laravel_queues_table')
            ->hasCommand(CustomLaravelQueuesRunCommand::class);
    }
}
