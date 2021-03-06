<?php

namespace App\Console;

use App\Jobs\ContactNoAction;
use App\Models\Main\Company;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        try{
            Log::debug(' ----- Running Scheduled Tasks for Tenants ----- ');

            // Multi Tenant Tasks Runner
            //
            $tenants = Company::all();

            foreach ($tenants as $tenant) {

                Log::debug(" Tenant -  {$tenant->name}, DB - {$tenant->database}");

                // Scheduled Tasks Per Tenant
                //
                $schedule->job(new ContactNoAction($tenant))->everyThirtyMinutes();
            }
        }
        catch (\Exception $e) {
            Log::debug(__METHOD__ . ' - ' . $e->getMessage());
        }
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
