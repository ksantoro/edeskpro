<?php

namespace App\Mail\Contacts;

use App\Models\Main\Company;
use App\Models\Tenant\Contact;
use App\Models\Tenant\Notes;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactNoActionNotification extends Mailable
{
    use Queueable, SerializesModels;

    public
        $billing,
        $company,
        $contact,
        $delivery,
        $notes,
        $title = 'No Action Taken on New Contact';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contact $contact, Company $tenant)
    {
        $this->company  = $tenant;
        $this->contact  = $contact;
        $this->billing  = $contact->locations()->where('is_billing', 1)->first();
        $this->delivery = $contact->locations()->where('is_billing', 0)->first();
        $this->notes    = Notes::contact($contact)->orderBy('created_at', 'desc')->get();
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
            ->subject("eDeskPro Notification - {$this->title} ({$this->contact->first_name} {$this->contact->last_name}) for {$this->company->name}")
            ->text('emails.contacts.no_action_plain')
            ->view('emails.contacts.no_action');
    }
}