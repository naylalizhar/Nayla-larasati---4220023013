<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InstallApi extends Command
{
    // Definisi signature perintah
    protected $signature = 'install:api';

    // Deskripsi perintah
    protected $description = 'Install API';

    // Konstruktor
    public function __construct()
    {
        parent::__construct();
    }

    // Logika perintah
    public function handle()
    {
        $this->info('Mengupdate Composer...');
        // Mengupdate Composer
        shell_exec('composer update');

        $this->info('Menjalankan migrasi...');
        // Menjalankan migrasi
        Artisan::call('migrate');

        $this->info('Menjalankan Scaffolding API...');
        // Menjalankan scaffolding API (misalnya, instalasi Sanctum)
        shell_exec('composer require laravel/sanctum');
        Artisan::call('vendor:publish', [
            '--provider' => 'Laravel\Sanctum\SanctumServiceProvider'
        ]);
        Artisan::call('migrate');

        $this->info('API scaffolding installed. Please add the [Laravel\Sanctum\HasApiTokens] trait to your user model.');
    }
}
