<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;

class MakeRepository extends Command
{
    protected $signature = 'make:repository {name}';
    protected $description = '產生一個 Repository，並綁定對應的 Eloquent Model';
    protected $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    public function handle()
    {
        $name = $this->argument('name'); // e.g. EmployeeRepository
        $className = Str::studly($name);
        $modelName = str_replace('Repository', '', $className); // e.g. Employee
        $path = app_path("Repositories/{$className}.php");

        if ($this->files->exists($path)) {
            $this->error("Repository already exists: {$className}");
            return;
        }

        $stub = $this->getStub($modelName, $className);

        $this->makeDirectory($path);
        $this->files->put($path, $stub);

        $this->info("Repository created: {$className}");
    }

    protected function makeDirectory($path)
    {
        $dir = dirname($path);

        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
    }

    protected function getStub($modelName, $className)
    {
        return <<<PHP
<?php

namespace App\Repositories;

use App\Models\\{$modelName};
use Illuminate\Support\Facades\Hash;

class {$className}
{
    public function getAll()
    {
        return {$modelName}::all();
    }

    public function getById(\$id)
    {
        return {$modelName}::find(\$id);
    }

    public function getByCriteria(array \$criteria)
    {
        return {$modelName}::where(\$criteria)->get();
    }

    public function create(array \$data)
    {
        \$data['password'] = Hash::make(\$data['password'] ?? 'password');
        return {$modelName}::create(\$data);
    }

    public function update(\$id, array \$data)
    {
        \$item = {$modelName}::find(\$id);
        if (!\$item) return false;

        if (isset(\$data['password'])) {
            \$data['password'] = Hash::make(\$data['password']);
        }

        return \$item->update(\$data);
    }

    public function delete(\$id)
    {
        return {$modelName}::destroy(\$id);
    }
}
PHP;
    }
}
