<?php

namespace App\Console\Commands;

use App\Models\Domain;
use App\Models\Tenant;
use Illuminate\Console\Command;

class CreateTenant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-tenant {name} {domain?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will create tenant with custom domain';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Creating tenant...');

        if (Tenant::find($this->argument('name'))) {
            $this->error('Tenant already exists!');

            return;
        }

        if (Domain::whereDomain($this->argument('domain'))->exists()) {
            $this->error('Domain already exists!');

            return;
        }

        $tenant = Tenant::create([
            'id' => $this->argument('name'),
        ]);

        $tenant->domains()->create([
            'domain' => $this->argument('domain'),
        ]);

        $this->info('Tenant created successfully.');
    }
}
