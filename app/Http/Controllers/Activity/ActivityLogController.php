<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Activity\ContactActivityLog;
use App\Models\Tenant\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ActivityLogController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('tenant');
    }

    public function log_contact_activity(Request $request)
    {
        try {
            if (! empty($request->note)) {
                if (! empty($request->contact_id)) {
                    if ($contact = Contact::find($request->contact_id)) {
                        $log                 = new ContactActivityLog();
                        $log->entity_id      = $contact->id;
                        $log->note           = $request->note;
                        $log->save();
                    }
                }
            }
        }
        catch (\Exception $exception) {
            Log::info('Error saving contact activity log: ' . $exception->getMessage());
        }
    }
}
