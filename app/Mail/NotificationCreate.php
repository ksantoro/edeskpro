<?php

namespace App\Mail;

use App\Models\Main\Company;
use App\Models\Main\NotificationType;
use App\Models\Main\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificationCreate extends Mailable
{
    use Queueable, SerializesModels;

    public
        $company,
        $notification_type,
        $user,
        $title = 'New Notification Created';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(NotificationType $notification_type, User $user)
    {
        $this->company           = Company::find(Auth::user()->company_id);
        $this->notification_type = $notification_type;
        $this->user              = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->replyTo('info@edesk.pro', 'eDeskPro')
            ->from('info@edesk.pro', 'eDeskPro')
            ->subject("eDeskPro Notification - {$this->title} ({$this->notification_type->description}) for {$this->company->name}")
            ->text('emails.notifications.create_plain')
            ->view('emails.notifications.create');
    }
}
