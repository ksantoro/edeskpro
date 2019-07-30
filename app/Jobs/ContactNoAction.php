<?php

namespace App\Jobs;

use App\Mail\Contacts\ContactNoActionNotification;
use App\Models\Tenant\Contact;
use App\Models\Main\NotificationSendType;
use App\Models\Main\NotificationType;
use App\Models\Tenant\NotificationUser;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ContactNoAction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($tenant)
    {
        tenant_connect($tenant->hostname, $tenant->username, $tenant->password, $tenant->database);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            if ($users_to_notify = (new NotificationUser())->find_users_to_notify(NotificationType::find(7), NotificationSendType::find(2))) {
                foreach ($users_to_notify as $user_to_notify) {
                    if ($contacts = Contact::NoActionTaken()->get()) {
                        foreach ($contacts as $contact) {
                            Mail::to(User::find($user_to_notify))->send(new ContactNoActionNotification($contact));
                        }
                    }
                }
            }
        }
        catch (\Exception $exception) {
            Log::debug($exception);
        }
    }
}
