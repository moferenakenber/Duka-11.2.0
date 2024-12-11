<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MakeResourceModelControllerMigrationFromTable extends Command
{
    protected $signature = 'make:resource-model-controller-migration-from-table {table} {--api} {--policy} {--factory} {--test} {--routes} {--seeder} {--views}';
    protected $description = 'Generate Model, Controller, Migration, Policy, Factory, Test, Routes, Seeder, and Views from a table schema';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $table = $this->argument('table');

        if (!Schema::hasTable($table)) {
            $this->error("Table '{$table}' does not exist.");
            return;
        }

        $columns = Schema::getColumnListing($table);
        $schema = DB::select("DESCRIBE `{$table}`");

        $this->info("Creating resources for table: {$table}");

        // Generate Model
        $this->generateModel($table, $columns, $schema);

        // Generate Controller
        $this->generateController($table, $columns);

        // Generate Migration
        $this->generateMigration($table, $schema);

        // Generate Policy if flag is set
        if ($this->option('policy')) {
            $this->generatePolicy($table);
        }

        // Generate Factory if flag is set
        if ($this->option('factory')) {
            $this->generateFactory($table, $columns);
        }

        // Generate Test if flag is set
        if ($this->option('test')) {
            $this->generateTest($table);
        }

        // Generate Routes if flag is set
        if ($this->option('routes')) {
            $this->generateRoutes($table);
        }

        // Generate Seeder if flag is set
        if ($this->option('seeder')) {
            $this->generateSeeder($table);
        }

        // Generate Views if flag is set
        if ($this->option('views')) {
            $this->generateViews($table);
        }

        $this->info("Resources creation complete for {$table}");
    }

    // Other existing methods (generateModel, generateController, generateMigration, generatePolicy, generateFactory, generateTest, generateSeeder) remain the same

    protected function generateViews($table)
    {
        $modelName = Str::studly(Str::singular($table));
        $viewsDirectory = resource_path('views/admin/' . Str::plural($table));

        // Create views directory if it doesn't exist
        if (!File::exists($viewsDirectory)) {
            File::makeDirectory($viewsDirectory, 0755, true);
        }

        // Index View
        $indexView = $this->generateIndexView($modelName, $table);
        File::put("{$viewsDirectory}/index.blade.php", $indexView);
        $this->info("Index view created for {$modelName}");

        // Create View
        $createView = $this->generateCreateView($modelName, $table);
        File::put("{$viewsDirectory}/create.blade.php", $createView);
        $this->info("Create view created for {$modelName}");

        // Edit View
        $editView = $this->generateEditView($modelName, $table);
        File::put("{$viewsDirectory}/edit.blade.php", $editView);
        $this->info("Edit view created for {$modelName}");

        // Show View
        $showView = $this->generateShowView($modelName, $table);
        File::put("{$viewsDirectory}/show.blade.php", $showView);
        $this->info("Show view created for {$modelName}");
    }

    protected function generateIndexView($modelName, $table)
    {
        return <<<EOL
@extends('admin')

@section('content')
    <h1>{$modelName}s</h1>
    <a href="{{ route('admin.{$table}.create') }}" class="btn btn-primary">Create {$modelName}</a>
    <table class="table">
        <thead>
            <tr>
                <!-- Add column headers dynamically here -->
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach (\App\Models\\{$modelName}::all() as \${$table})
                <tr>
                    <td>{{ \${$table}->name }}</td>
                    <td>
                        <a href="{{ route('admin.{$table}.show', \${$table}->id) }}" class="btn btn-info">Show</a>
                        <a href="{{ route('admin.{$table}.edit', \${$table}->id) }}" class="btn btn-warning">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
EOL;
    }

    protected function generateCreateView($modelName, $table)
    {
        return <<<EOL
@extends('admin')

@section('content')
    <h1>Create {$modelName}</h1>
    <form action="{{ route('admin.{$table}.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
@endsection
EOL;
    }

    protected function generateEditView($modelName, $table)
    {
        return <<<EOL
@extends('admin')

@section('content')
    <h1>Edit {$modelName}</h1>
    <form action="{{ route('admin.{$table}.update', \${$table}->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ \${$table}->name }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
@endsection
EOL;
    }

    protected function generateShowView($modelName, $table)
    {
        return <<<EOL
@extends('admin')

@section('content')
    <h1>Show {$modelName}</h1>
    <div class="form-group">
        <label for="name">Name</label>
        <p>{{ \${$table}->name }}</p>
    </div>
    <a href="{{ route('admin.{$table}.edit', \${$table}->id) }}" class="btn btn-warning">Edit</a>
@endsection
EOL;
    }

    protected function generateRoutes($table)
    {
        $routeName = Str::plural($table);
        $controllerName = Str::studly(Str::singular($table)) . 'Controller';
        $routeContent = "\nRoute::resource('{$routeName}', {$controllerName}::class)->name('admin.{$table}.');";

        // Append the routes to the routes file
        File::append(base_path('routes/web.php'), $routeContent);

        $this->info("Routes added to routes/web.php");
    }
}
