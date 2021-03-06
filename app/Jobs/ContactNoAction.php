<?php

namespace App\Jobs;

use App\Mail\Contacts\ContactNoActionNotification;
use App\Models\Main\NotificationSendType;
use App\Models\Main\NotificationType;
use App\Models\Main\User;
use App\Models\Tenant\Contact;
use App\Models\Tenant\NotificationUser;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactNoAction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tenant;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($tenant)
    {
        $this->tenant = $tenant;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        tenant_connect($this->tenant->hostname, $this->tenant->username, $this->tenant->password, $this->tenant->database);

        try {
            if ($users_to_notify = (new NotificationUser())->find_users_to_notify(NotificationType::find(7), NotificationSendType::find(2))) {
                Log::debug(__METHOD__. ' --- Found users to notify --- ');
                foreach ($users_to_notify as $user_to_notify) {
                    Log::debug(__METHOD__ . " - User to notify: {$user_to_notify}");
                    if ($contacts = (new Contact())->noActionTaken()) {
                        Log::debug(__METHOD__. ' --- Found contacts created in the last 24 hours --- ');
                        foreach ($contacts as $contact) {
                            Log::debug(__METHOD__ . " - Contact: {$contact->first_name} {$contact->last_name}");
                            Mail::to(User::find($user_to_notify))->send(new ContactNoActionNotification($contact, $this->tenant));
                        }
                    }
                }
            }
        }
        catch (\Exception $exception) {
            Log::debug($exception->getMessage());
        }
    }
}
