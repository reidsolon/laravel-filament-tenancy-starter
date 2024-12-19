<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use App\Models\Tenant\Admin;
use Illuminate\Console\Command;

class CreateTenantAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin {tenant} {name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will create tenant admin for cms';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Creating admin user...');

        if (! $tenant = Tenant::find($this->argument('tenant'))) {
            $this->error('Tenant not found');
            return;
        }

        $tenant->run(function () {
            Admin::firstOrCreate([
                'email' => $this->argument('email'),
            ], [
                'name' => $this->argument('name'),
                'password' => bcrypt($this->argument('password')),
            ]);
        });

        $this->info('Admin user created successfully.');
    }
}
