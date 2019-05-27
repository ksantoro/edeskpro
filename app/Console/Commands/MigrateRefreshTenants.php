<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Main\Company;

class MigrateRefreshTenants extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:migrate:refresh {tenant=all : The company ID of the tenant or ALL tenants}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate REFRESH all tenant database schemas.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->argument('tenant') && $this->argument('tenant') != 'all') {

            $tenant = Company::find($this->argument('tenant'));
            $this->info("Refreshing migrations for - {$tenant->name}, DB - {$tenant->database}");
            tenant_connect($tenant->hostname, $tenant->username, $tenant->password, $tenant->database);
            tenant_refresh_migrate();
        }
        else {

            $tenants = Company::all();

            foreach ($tenants as $tenant) {
                $this->info("Refreshing migrations for - {$tenant->name}, DB - {$tenant->database}");
                tenant_connect($tenant->hostname, $tenant->username, $tenant->password, $tenant->database);
                tenant_refresh_migrate();
            }
        }
    }
}
