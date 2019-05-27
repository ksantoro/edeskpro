<?php

namespace App\Console\Commands;

use App\Models\Main\Company;
use Illuminate\Console\Command;

class MigrateTenants extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:migrate {tenant=all : The company ID of the tenant or ALL tenants}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Running migrations for tenant databases.';

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
            tenant_migrate();
        }
        else {

            $tenants = Company::all();

            foreach ($tenants as $tenant) {
                $this->info("Refreshing migrations for - {$tenant->name}, DB - {$tenant->database}");
                tenant_connect($tenant->hostname, $tenant->username, $tenant->password, $tenant->database);
                tenant_migrate();
            }
        }
    }
}
