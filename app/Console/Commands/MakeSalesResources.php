<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeSalesResources extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:sales-resources';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate migration, model, controller, and views for Sales';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Step 1: Create Migration
        $this->call('make:migration', [
            'name' => 'create_sales_table',
        ]);
        $this->info('Migration "create_sales_table" created.');

        // Step 2: Create Model
        $this->call('make:model', [
            'name' => 'Sales',
        ]);
        $this->info('Model "Sales" created.');

        // Step 3: Create Controller
        $this->call('make:controller', [
            'name' => 'SaleController',
            '--resource' => true,
        ]);
        $this->info('Controller "SaleController" created.');

        // Step 4: Create Views
        $this->createViews();

        $this->info('Sales resources generated successfully!');
        return 0;
    }

    /**
     * Create view files for the sales resource.
     */
    private function createViews()
    {
        $viewsPath = resource_path('views/sales');
        $views = [
            'index'  => '<!-- Sales index view -->',
            'create' => '<!-- Sales create view -->',
            'edit'   => '<!-- Sales edit view -->',
            'show'   => '<!-- Sales show view -->',
        ];

        // Ensure the directory exists
        if (!File::exists($viewsPath)) {
            File::makeDirectory($viewsPath, 0755, true);
            $this->info("Directory '$viewsPath' created.");
        }

        // Create each view file
        foreach ($views as $viewName => $content) {
            $viewFile = $viewsPath . "/$viewName.blade.php";

            if (!File::exists($viewFile)) {
                File::put($viewFile, $content);
                $this->info("View '$viewName.blade.php' created.");
            } else {
                $this->warn("View '$viewName.blade.php' already exists, skipping.");
            }
        }
    }
}
