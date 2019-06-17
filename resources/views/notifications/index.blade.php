@extends('layouts.app')
@section('page_title', 'Notifications Management')
@section('breadcrumbs', Breadcrumbs::render('notifications.index'))

@section('content')
<div class='main-section'>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-1'>
                <a href='{{ route('notifications.create') }}' class='btn btn-primary'>Create New</a>
            </div>
            <div class='col-md-10'>
                <!-- Search box -->
                <form id='search-notifications' action="#" method='POST'>
                    @csrf
                    <div class='input-group mb-3'>
                        <div class='input-group-prepend'>
                            <span class='input-group-text' id='search-contacts'><span class='fa fa-search'></span></span>
                        </div>
                        <input type='text' class='form-control' name="search_term" placeholder='search notifications...' aria-label='search-contacts' aria-describedby='search-contacts'>
                    </div>
                </form>
            </div>
            <div class='col-md-1'>
                <a href='{{ route('notifications.index') }}' class='btn btn-secondary float-right'>Clear Search</a>
            </div>
        </div>

        <div class='row'>

            @isset($notifications)

                @empty($notifications)

                    There are no notifications to display.

                @else

                    @foreach($notifications as $i => $notification_user)

                        <div class='card m-2'>
                            <div class='card-body'>
                                <b>Send Type: </b> {{ $notification_user['send_type']->name }}<br>
                                <b>Notification Type: </b> {{ $notification_user['notification_type']->description }}<br>
                                <b>User: </b> {{ $notification_user['user']->first_name }} {{ $notification_user['user']->last_name }} ({{ $notification_user['user']->email }})<br>
                            </div>
                        </div>

                    @endforeach

                @endempty

            @else

                There are no notifications to display.

            @endisset

        </div>

    </div>
</div>
@endsection
