<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeResources extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:resources {name : The singular name of the resource}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a migration, model, controller, and views for a given resource name';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $singularName = Str::studly($this->argument('name')); // e.g., "Sale"
        $pluralName = Str::snake(Str::plural($this->argument('name'))); // e.g., "sales"
        $kebabPluralName = Str::kebab(Str::plural($this->argument('name'))); // e.g., "sales"
        $viewsPath = resource_path("views/$kebabPluralName"); // Views folder path

        // Step 1: Create Migration
        $this->call('make:migration', [
            'name' => "create_{$pluralName}_table",
        ]);
        $this->info("Migration 'create_{$pluralName}_table' created.");

        // Step 2: Create Model
        $this->call('make:model', [
            'name' => $singularName,
        ]);
        $this->info("Model '$singularName' created.");

        // Step 3: Create Controller
        $controllerName = "{$singularName}Controller";
        $this->call('make:controller', [
            'name' => $controllerName,
            '--resource' => true,
        ]);
        $this->info("Controller '$controllerName' created.");

        // Step 4: Create Views
        $this->createViews($viewsPath);
        $this->info("Views for '$pluralName' created at '$viewsPath'.");

        // Step 5: Display Route Registration Info
        $this->info("Don't forget to register your resource route:");
        $this->line("Route::resource('$pluralName', '{$controllerName}');");

        return 0;
    }

    /**
     * Create view files for the resource.
     *
     * @param string $viewsPath
     * @return void
     */
    private function createViews(string $viewsPath)
    {
        $views = ['index', 'create', 'edit', 'show'];

        // Ensure the views directory exists
        if (!File::exists($viewsPath)) {
            File::makeDirectory($viewsPath, 0755, true);
        }

        // Generate placeholder content for each view
        foreach ($views as $view) {
            $viewFile = $viewsPath . "/$view.blade.php";

            if (!File::exists($viewFile)) {
                $content = "<!-- $view view for resource -->";
                File::put($viewFile, $content);
                $this->info("View '$view.blade.php' created.");
            } else {
                $this->warn("View '$view.blade.php' already exists. Skipping.");
            }
        }
    }
}
