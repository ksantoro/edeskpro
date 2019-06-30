<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\Main\EntityType;
use App\Models\Tenant\ActivityLog;
use App\Models\Tenant\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                        $log                 = new ActivityLog();
                        $log->entity_type_id = EntityType::CONTACT;
                        $log->entity_id      = $contact->id;
                        $log->note           = $request->note;
                        $log->user_id        = Auth::user()->id;
                        $log->created_at     = Carbon::now();
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
