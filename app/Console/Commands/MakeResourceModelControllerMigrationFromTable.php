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
    protected $signature = 'make:resource-model-controller-migration-from-table {table} {--api} {--policy} {--factory} {--test} {--routes} {--seeder}';
    protected $description = 'Generate Model, Controller, Migration, Policy, Factory, Test, Routes, and Seeder from a table schema';

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

        $this->info("Resources creation complete for {$table}");
    }

    protected function generateModel($table, $columns, $schema)
    {
        $modelName = Str::studly(Str::singular($table));
        $modelContent = "<?php\n\nnamespace App\Models;\n\nuse Illuminate\Database\Eloquent\Model;\n\nclass {$modelName} extends Model\n{\n    protected \$table = '{$table}';\n    protected \$fillable = [" . implode(',', array_map(fn($col) => "'{$col}'", $columns)) . "];\n";

        // Loop through the schema to check for foreign key relationships
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
        $controllerContent = "<?php\n\nnamespace App\Http\Controllers;\n\nuse App\Models\\" . Str::studly(Str::singular($table)) . ";\nuse Illuminate\Http\Request;\n\nclass {$controllerName} extends Controller\n{\n";

        // Generate basic index, store, show, etc.
        // Validation for store and update
        $controllerContent .= "    public function store(Request \$request) {\n";
        $controllerContent .= "        \$data = \$request->validate([";

        foreach ($columns as $column) {
            $controllerContent .= "'{$column}' => 'required',";  // You can adjust validation rules based on column type
        }

        $controllerContent .= "]);\n";
        $controllerContent .= "        return " . Str::studly(Str::singular($table)) . "::create(\$data);\n";
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
            File::makeDirectory($policyDirectory, 0755, true);  // Create the directory if it doesn't exist
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
        $routeName = Str::plural($table);
        $routeContent = "\nRoute::resource('{$routeName}', {$this->generateControllerName($table)}::class);";
        File::append(base_path('routes/api.php'), $routeContent);

        $this->info("Routes added to routes/api.php");
    }

    protected function generateSeeder($table)
    {
        $seederName = Str::studly(Str::singular($table)) . 'Seeder';
        $seederContent = "<?php\n\nnamespace Database\\Seeders;\n\nuse App\Models\\" . Str::studly(Str::singular($table)) . ";\nuse Illuminate\Database\Seeder;\n\nclass {$seederName} extends Seeder\n{\n    public function run()\n    {\n        \\" . Str::studly(Str::singular($table)) . "::factory()->count(10)->create();\n    }\n}";

        File::put(database_path("seeders/{$seederName}.php"), $seederContent);

        $this->info("Seeder created: {$seederName}");
    }

    private function generateControllerName($table)
    {
        return Str::studly(Str::singular($table)) . 'Controller';
    }
}



// Usage: "php artisan make:resource-model-controller-migration-from-table users --policy --factory --test --routes --seeder"
