@extends('emails.main')
@section('email_content')

    <h3 style='color:#0cc;font-weight:100;'>A New Notification Has Been Created</h3>
    <b>Company: </b> {{ $company->name }}
    <br>
    <b>Notification Type: </b> {{ $notification_type->description }}
    <br>
    <b>User to Send To: </b> {{ $user->first_name }} {{ $user->last_name }} ({{ $user->email }})

@endsection
