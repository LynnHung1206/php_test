<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateViewCommand extends Command
{
    protected $signature = 'make:view {name}';
    protected $description = 'Create a new Blade view file';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name = $this->argument('name');
        $path = resource_path("views/{$name}.blade.php");

        if (File::exists($path)) {
            $this->error("View {$name} already exists!");
            return;
        }

        File::put($path, '');
        $this->info("View {$name} created successfully!");
    }
}
