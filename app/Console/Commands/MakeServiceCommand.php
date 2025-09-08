<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeServiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * Contoh penggunaan:
     * php artisan make:service MidtransService
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     */
    protected $description = 'Create a new service class in app/Services';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $path = app_path("Services/{$name}.php");

        if (File::exists($path)) {
            $this->error("Service {$name} sudah ada!");
            return;
        }

        // Pastikan folder app/Services ada
        if (!File::isDirectory(app_path('Services'))) {
            File::makeDirectory(app_path('Services'));
        }

        $stub = <<<PHP
<?php

namespace App\Services;

class {$name}
{
    public function __construct()
    {
        //
    }
}
PHP;

        File::put($path, $stub);

        $this->info("Service {$name} berhasil dibuat di app/Services.");
    }
}
