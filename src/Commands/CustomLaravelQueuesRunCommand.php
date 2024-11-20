<?php

namespace Cruz\CustomLaravelQueues\Commands;

use Illuminate\Console\Command;

class CustomLaravelQueuesRunCommand extends Command
{
    public $signature = 'cruz:queue-run {class} {method} {params?}';

    public $description = 'Excecute the given class as a background task';

    public function handle(): int
    {
        $log = \Log::channel('custom-laravel-queues');

        $class = $this->argument('class');
        $method = $this->argument('method');
        $params = $this->argument('params') ? json_decode($this->argument('params'), true) : [];

        $allowedClasses = config('custom-laravel-queues.allowed_classes', []);

        if (! in_array($class, $allowedClasses)) {
            $log->error("Error running {$class}::{$method}: Unauthorized class");

            throw new \Exception("Unauthorized class: $class");
        }

        try {
            $log->info("Running {$class}::{$method}");
            $reflection = new \ReflectionClass($class);
            $instance = $reflection->newInstance();
            $result = $reflection->getMethod($method)->invokeArgs($instance, $params);

            $log->info("Background job succeeded: {$class}::{$method}", ['result' => $result]);
        } catch (\Exception $e) {
            $log->error("Error running {$class}::{$method}", ['error' => $e->getMessage()]);

            return self::FAILURE;
        }

        return self::SUCCESS;
    }
}
