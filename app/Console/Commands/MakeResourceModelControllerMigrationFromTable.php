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

    protected function generateModel($table, $columns, $schema)
    {
        $modelName = Str::studly(Str::singular($table));
        $modelContent = "<?php\n\nnamespace App\Models;\n\nuse Illuminate\Database\Eloquent\Model;\n\nclass {$modelName} extends Model\n{\n    protected \$table = '{$table}';\n    protected \$fillable = [" . implode(',', array_map(fn($col) => "'{$col}'", $columns)) . "];\n";

        // Relationships
        $relationships = DB::select("SELECT COLUMN_NAME, REFERENCED_TABLE_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_NAME = '{$table}' AND REFERENCED_TABLE_NAME IS NOT NULL;");
        foreach ($relationships as $relationship) {
            $modelContent .= "\n    public function " . Str::camel($relationship->COLUMN_NAME) . "()\n    {\n        return \$this->belongsTo(App\Models\\" . Str::studly($relationship->REFERENCED_TABLE_NAME) . "::class);\n    }";
        }

        $modelContent .= "}\n";
        File::put(app_path("Models/{$modelName}.php"), $modelContent);
        $this->info("Model created: {$modelName}");
    }

    protected function generateController($table, $columns)
    {
        $controllerName = Str::studly(Str::singular($table)) . 'Controller';
        $modelName = Str::studly(Str::singular($table));

        $controllerContent = "<?php\n\n";
        $controllerContent .= "namespace App\\Http\\Controllers;\n\n";
        $controllerContent .= "use App\\Models\\{$modelName};\n";
        $controllerContent .= "use Illuminate\\Http\\Request;\n";
        $controllerContent .= "use Illuminate\\Support\\Facades\\Schema;\n\n";
        $controllerContent .= "class {$controllerName} extends Controller\n";
        $controllerContent .= "{\n";

        // Index Method
        $controllerContent .= "    public function index()\n";
        $controllerContent .= "    {\n";
        $controllerContent .= "        $" . "items = {$modelName}::all();\n";
        $controllerContent .= "        return view('{$table}.index', compact('items'));\n";
        $controllerContent .= "    }\n\n";

        // Create Method
        $controllerContent .= "    public function create()\n";
        $controllerContent .= "    {\n";
        $controllerContent .= "        return view('{$table}.create');\n";
        $controllerContent .= "    }\n\n";

        // Store Method
        $controllerContent .= "    public function store(Request $request)\n";
        $controllerContent .= "    {\n";
        $controllerContent .= "        $columns = Schema::getColumnListing('$table');\n";
        $controllerContent .= "        $rules = [];\n";
        $controllerContent .= "        foreach ($columns as $column) {\n";
        $controllerContent .= "            if (!in_array($column, ['id', 'created_at', 'updated_at', 'deleted_at'])) {\n";
        $controllerContent .= "                $rules[$column] = 'required';\n";
        $controllerContent .= "            }\n";
        $controllerContent .= "        }\n";
        $controllerContent .= "        $data = $request->validate($rules);\n";
        $controllerContent .= "        return {$modelName}::create($data);\n";
        $controllerContent .= "    }\n\n";

        // Show Method
        $controllerContent .= "    public function show({$modelName} $" . Str::camel($modelName) . "\n";
        $controllerContent .= "    {\n";
        $controllerContent .= "        return view('{$table}.show', ['" . Str::camel($modelName) . "' => $" . Str::camel($modelName) . "]);\n";
        $controllerContent .= "    }\n\n";

        // Edit Method
        $controllerContent .= "    public function edit({$modelName} $" . Str::camel($modelName) . "\n";
        $controllerContent .= "    {\n";
        $controllerContent .= "        return view('{$table}.edit', ['" . Str::camel($modelName) . "' => $" . Str::camel($modelName) . "]);\n";
        $controllerContent .= "    }\n\n";

        // Update Method
        $controllerContent .= "    public function update(Request $request, {$modelName} $" . Str::camel($modelName) . "\n";
        $controllerContent .= "    {\n";
        $controllerContent .= "        $columns = Schema::getColumnListing('$table');\n";
        $controllerContent .= "        $rules = [];\n";
        $controllerContent .= "        foreach ($columns as $column) {\n";
        $controllerContent .= "            if (!in_array($column, ['id', 'created_at', 'updated_at', 'deleted_at'])) {\n";
        $controllerContent .= "                $rules[$column] = 'sometimes|required';\n";
        $controllerContent .= "            }\n";
        $controllerContent .= "        }\n";
        $controllerContent .= "        $data = $request->validate($rules);\n";
        $controllerContent .= "        $" . Str::camel($modelName) . "->update($data);\n";
        $controllerContent .= "        return $" . Str::camel($modelName) . ";\n";
        $controllerContent .= "    }\n\n";

        // Destroy Method
        $controllerContent .= "    public function destroy({$modelName} $" . Str::camel($modelName) . "\n";
        $controllerContent .= "    {\n";
        $controllerContent .= "        $" . Str::camel($modelName) . "->delete();\n";
        $controllerContent .= "        return response()->json(['message' => 'Deleted successfully']);\n";
        $controllerContent .= "    }\n";

        $controllerContent .= "}\n";

        File::put(app_path("Http/Controllers/{$controllerName}.php"), $controllerContent);

        $this->info("Controller created: {$controllerName}");
    }


    protected function generateMigration($table, $schema)
    {
        $migrationName = 'create_' . $table . '_table';
        $migrationContent = "<?php\n\nuse Illuminate\Database\Migrations\Migration;\nuse Illuminate\Database\Schema\Blueprint;\nuse Illuminate\Support\Facades\Schema;\n\nclass {$migrationName} extends Migration\n{\n    public function up()\n    {\n        Schema::create('{$table}', function (Blueprint \$table) {\n";

        foreach ($schema as $column) {
            $migrationContent .= "            \$table->{$column->Type}('{$column->Field}');\n";
        }

        $migrationContent .= "        });\n    }\n\n    public function down()\n    {\n        Schema::dropIfExists('{$table}');\n    }\n}";

        File::put(database_path("migrations/" . date('Y_m_d_His') . "_{$migrationName}.php"), $migrationContent);
        $this->info("Migration created: {$migrationName}");
    }

    protected function generatePolicy($table)
    {
        $policyName = Str::studly(Str::singular($table)) . 'Policy';
        $policyContent = "<?php\n\nnamespace App\Policies;\n\nuse App\Models\User;\nuse App\Models\\" . Str::studly(Str::singular($table)) . ";\nuse Illuminate\Auth\Access\HandlesAuthorization;\n\nclass {$policyName}\n{\n    use HandlesAuthorization;\n\n    public function view(User \$user, {$policyName} \$model)\n    {\n        return true;\n    }\n    public function create(User \$user)\n    {\n        return true;\n    }\n    public function update(User \$user, {$policyName} \$model)\n    {\n        return true;\n    }\n    public function delete(User \$user, {$policyName} \$model)\n    {\n        return true;\n    }\n}";

        // Check if the Policies directory exists, if not, create it
        $policyDirectory = app_path('Policies');
        if (!File::exists($policyDirectory)) {
            File::makeDirectory($policyDirectory, 0755, true);
        }

        File::put(app_path("Policies/{$policyName}.php"), $policyContent);
        $this->info("Policy created: {$policyName}");
    }

    protected function generateFactory($table, $columns)
    {
        $factoryName = Str::studly(Str::singular($table)) . 'Factory';
        $factoryContent = "<?php\n\nnamespace Database\Factories;\n\nuse App\Models\\" . Str::studly(Str::singular($table)) . ";\nuse Illuminate\Database\Eloquent\Factories\Factory;\n\nclass {$factoryName} extends Factory\n{\n    protected \$model = " . Str::studly(Str::singular($table)) . "::class;\n\n    public function definition()\n    {\n        return [\n";

        foreach ($columns as $column) {
            $factoryContent .= "            '{$column}' => \$this->faker->word(),\n";
        }

        $factoryContent .= "        ];\n    }\n}";

        File::put(database_path("factories/{$factoryName}.php"), $factoryContent);
        $this->info("Factory created: {$factoryName}");
    }

    protected function generateTest($table)
    {
        $testName = Str::studly(Str::singular($table)) . 'Test';
        $testContent = "<?php\n\nnamespace Tests\\Feature;\n\nuse App\Models\\" . Str::studly(Str::singular($table)) . ";\nuse Illuminate\Foundation\Testing\RefreshDatabase;\nuse Tests\\TestCase;\n\nclass {$testName} extends TestCase\n{\n    use RefreshDatabase;\n\n    public function testCanCreate{$testName}()\n    {\n        \$response = \$this->postJson('/api/{$table}', [/* data */]);\n        \$response->assertStatus(201);\n    }\n}";

        File::put(base_path("tests/Feature/{$testName}.php"), $testContent);
        $this->info("Test created: {$testName}");
    }

    protected function generateRoutes($table)
    {
        $isApi = $this->option('api');
        $controllerName = Str::studly(Str::singular($table)) . 'Controller';
        $routeMethod = $isApi ? 'apiResource' : 'resource';
        $routeFile = $isApi ? base_path('routes/api.php') : base_path('routes/web.php');

        $routeContent = "{$routeMethod}('{$table}', {$controllerName}::class);\n";
        File::append($routeFile, $routeContent);
        $this->info("Routes added to {$routeFile}");
    }

    protected function generateSeeder($table)
    {
        $seederName = Str::studly(Str::singular($table)) . 'Seeder';
        $seederContent = "<?php\n\nnamespace Database\\Seeders;\n\nuse Illuminate\\Database\\Seeder;\nuse App\\Models\\" . Str::studly(Str::singular($table)) . ";\n\nclass {$seederName} extends Seeder\n{\n    public function run()\n    {\n        " . Str::studly(Str::singular($table)) . "::factory(10)->create();\n    }\n}";

        File::put(database_path("seeders/{$seederName}.php"), $seederContent);
        $this->info("Seeder created: {$seederName}");
    }

    protected function generateViews($table)
    {
        $viewDirectory = resource_path('views/' . Str::plural(Str::studly($table)));

        // Create views directory if not exists
        if (!File::exists($viewDirectory)) {
            File::makeDirectory($viewDirectory, 0755, true);
        }

        // Generate basic CRUD views
        $views = [
            'index' => "<!-- Index View for {$table} -->\n\n@extends('layouts.app')\n\n@section('content')\n    <h1>Index for {$table}</h1>\n    <!-- Add Table/List of {$table} records here -->\n@endsection",
            'create' => "<!-- Create View for {$table} -->\n\n@extends('layouts.app')\n\n@section('content')\n    <h1>Create {$table}</h1>\n    <!-- Add Create Form for {$table} here -->\n@endsection",
            'edit' => "<!-- Edit View for {$table} -->\n\n@extends('layouts.app')\n\n@section('content')\n    <h1>Edit {$table}</h1>\n    <!-- Add Edit Form for {$table} here -->\n@endsection",
            'show' => "<!-- Show View for {$table} -->\n\n@extends('layouts.app')\n\n@section('content')\n    <h1>Show {$table} Details</h1>\n    <!-- Display details for one {$table} record here -->\n@endsection"
        ];

        foreach ($views as $viewName => $viewContent) {
            File::put($viewDirectory . "/{$viewName}.blade.php", $viewContent);
        }

        $this->info("Views created for {$table}");
    }
}
