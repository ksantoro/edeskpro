<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use App\Mail\ContactCreate;
use App\Models\Main\NotificationType;
use App\Models\Main\User;
use App\Models\Tenant\Contact;
use App\Models\Tenant\NotificationUser;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('tenant');
    }

    public function index()
    {
        return view('notifications.index')
            ->with('notifications', NotificationUser::all());
    }

    public function create()
    {
        return view('notifications.create')->with('notification_types', NotificationType::all());
    }

    public function store(Request $request)
    {
        Log::debug($request);

        $validator = Validator::make($request->all(), [
            'notification_type_id' => 'required|numeric|max:25',
            'users'                => 'required|array',
        ]);

        if ($validator->fails())
        {
            return redirect('/notifications/create')
                ->withErrors($validator)
                ->withInput();
        }

        // Notification Save
        //
        foreach ($request->users as $user)
        {
            $notification_user                            = new NotificationUser();
            $notification_user->notification_type_id      = $request->notification_type_id;
            $notification_user->notification_send_type_id = 1; // System
            $notification_user->user_id                   = $user;
            $notification_user->save();

            $notification_user                            = new NotificationUser();
            $notification_user->notification_type_id      = $request->notification_type_id;
            $notification_user->notification_send_type_id = 2; // Email
            $notification_user->user_id                   = $user;
            $notification_user->save();
        }

        // Send Notifications
        //
        //Mail::to(Auth::user())->send(new ContactCreate($contact));

        return redirect()->route('notifications.index');
    }

    public function find_users(Request $request)
    {
        $all_users  = User::AllUsers()->get();
        $types      = [];
        $user_types = NotificationType::find($request->notification_type_id)->user_types()->get();

        foreach ($user_types as $type)
        {
            $types[] = $type->id;
        }

        $users = $all_users->whereIn('type_user_id', $types);

        return $users;
    }

    public function send(NotificationType $notification_type)
    {
        // Get all users assigned to notification type...
        // Send the right mailable object...
    }

    public function test_email_template()
    {
        $contact = Contact::find(3);
        return new ContactCreate($contact);
    }
}
