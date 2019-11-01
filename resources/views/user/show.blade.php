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
                        <a href='/users/{{ $user->id }}/edit'>Edit</a>
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
                <div class='col-sm-12 mt-3 contact-card'>
                    <div class='card'>
                        <div class='card-header'>User Roles</div>

                        <div class='card-body'>

                            @if (! empty($parents))

                                <div class='row'>

                                @foreach ($parents as $parent)

                                    <div class='col col-auto pr-5'>
                                        <h4>{{ $parent->name }}</h4>

                                        @if (! empty($roles))

                                            <ul style='list-style: none; padding-left: 0;'>

                                            @foreach ($roles as $role)

                                                @if ($role->parent_id == $parent->id)

                                                    <li>
                                                        @if (in_array($role->id, $user_roles))
                                                            <i class='far fa-check-circle text-success'></i>
                                                        @else
                                                            <i class='far fa-times-circle text-danger'></i>
                                                        @endif
                                                        {{ $role->name }}
                                                        <small>
                                                            <i title='{{ $role->description }}' class='fas fa-question-circle text-secondary' data-toggle='tooltip' data-placement='right'></i>
                                                        </small>
                                                    </li>

                                                @endif

                                            @endforeach

                                            </ul>
                                        @else

                                            There are no roles to display.

                                        @endif
                                    </div>

                                @endforeach

                                </div>
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
