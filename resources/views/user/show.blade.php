@extends('layouts.app')
@section('page_title', 'User Details')
@section('breadcrumbs', Breadcrumbs::render('users.show', $user))
@section('content')
    <div class='main-section'>
        <div class='container-fluid'>
            <div class='row'>
                <div class='col-sm-8'>
                    <p>
                        <span class='contact-name-title'>{{ $user->first_name }} {{ $user->last_name }}</span>
                    </p>
                </div>
                <div class='col-sm-4'>
                    <p class='float-right'>
                        <a href='{{ route('users.edit', ['user' => $user]) }}'>Edit</a>
                    </p>
                </div>
            </div>
            <div class='row'>
                <div class='col-sm-12 contact-card'>
                    <div class='card'>
                        <div class='card-header'>User Details</div>

                        <div class='card-body'>
                            <b>Name:</b> {{ $user->first_name }} {{ $user->last_name }}<br>
                            <b>Email:</b> {{ $user->email }}<br>
                            <b>User Type:</b> {{ $user_type->description }}<br>
                            <b>Created On:</b> {{ $user->created_at }}
                        </div>
                    </div>
                </div>
            </div>
            <div class='row'>
                <div class='col-sm-12 contact-card'>
                    <div class='card'>
                        <div class='card-header'>User Roles</div>

                        <div class='card-body'>

                            @if (! empty($roles))

                                @foreach ($roles as $role)

                                    @if (in_array($role->id, $user_roles))
                                        <i class='far fa-check-circle text-success'></i>
                                    @else
                                        <i class='far fa-times-circle text-danger'></i>
                                    @endif

                                    {{ $role->name }} - {{ $role->description }} <br>

                                @endforeach

                            @else

                                There are no roles to display.

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
