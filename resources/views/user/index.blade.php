@extends('layouts.app')
@section('page_title', 'User Management')
@section('breadcrumbs', Breadcrumbs::render('users.index'))
@section('content')
    <div class='main-section'>
        <div class='container-fluid'>
            <div class='d-flex flex-row'>
                <div class='p-2'>
                    <a href='/users/create' class='btn btn-primary'>Create New</a>
                </div>
                <div class='p-2 flex-grow-1'>
                    <!-- Search box -->
                    <form id='search-users' action="{{ route('users.search') }}" method='POST'>
                        @csrf
                        <div class='input-group mb-3'>
                            <div class='input-group-prepend'>
                                <span class='input-group-text' id='search-users'><span class='fa fa-search'></span></span>
                            </div>
                            <input type='text' class='form-control' name="search_term" placeholder='search users by first name, last name, email...' aria-label='search-users' aria-describedby='search-users'>
                        </div>
                    </form>
                </div>
                <div class='p-2'>
                    <a href='/users' class='btn btn-secondary float-right'>Clear Search</a>
                </div>
            </div>
            <div class='row justify-content-center'>
                <div class='col-md-12'>

                    <div class='row'>
                        <div class='col'>
                            <div class='card text-white bg-primary mb-3'>
                                <div class='card-body'>
                                    <h4 class='card-title'>All Users</h4>
                                    <p class='card-text'><h1 class='float-right'>{{ $counts['all'] }}</h1></p>
                                </div>
                            </div>
                        </div>
                        <div class='col'>
                            <div class='card text-white bg-secondary mb-3'>
                                <div class='card-body'>
                                    <h4 class='card-title'>Admin Users</h4>
                                    <p class='card-text'><h1 class='float-right'>{{ $counts['admin'] }}</h1></p>
                                </div>
                            </div>
                        </div>
                        <div class='col'>
                            <div class='card text-white bg-success mb-3'>
                                <div class='card-body'>
                                    <h4 class='card-title'>Sales Users</h4>
                                    <p class='card-text'><h1 class='float-right'>{{ $counts['sales'] }}</h1></p>
                                </div>
                            </div>
                        </div>
                        <div class='col'>
                            <div class='card text-white bg-info mb-3'>
                                <div class='card-body'>
                                    <h4 class='card-title'>Tech Users</h4>
                                    <p class='card-text'><h1 class='float-right'>{{ $counts['tech'] }}</h1></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class='row'>

                        @isset($message)
                            <div class='alert alert-danger' role='alert'>{{ $message }}</div>
                        @endisset

                        @isset($users)

                            @empty($users)

                                There are no users to display.

                            @else

                                @foreach ($users as $user)
                                    <div class='col-md-4 contact-card'>
                                        <div class='card mt-3'>
                                            <div class='card-header'>

                                                <div class='row justify-content-end'>
                                                    <div class='col-6 ml-auto'>
                                                        <i class='fas fa-user-circle'></i> &nbsp; {{ $user->first_name }} {{ $user->last_name }}
                                                    </div>
                                                    <div class='col-6 mr-auto'>

                                                        {{--action icons (temporary)--}}
                                                        <div class='float-right px-1'>
                                                            <a href='{{ route('users.destroy', ['user' => $user]) }}' onclick="event.preventDefault(); $('#archive-form-{{ $user->id }}').submit();">
                                                                <i class='fas fa-archive'  title='Archive User' data-toggle='tooltip' data-placement='bottom'></i>
                                                            </a>
                                                            <form id='archive-form-{{ $user->id }}' action="{{ route('users.destroy', ['user' => $user]) }}" method='POST' style='display: none;'>
                                                                @method('DELETE')
                                                                @csrf
                                                            </form>
                                                        </div>
                                                        <div class='float-right px-1'>
                                                            <a href='{{ route('users.edit', ['user' => $user]) }}' class='float-right'>
                                                                <i class='fas fa-user-edit' title='Edit User' data-toggle='tooltip' data-placement='bottom'></i>
                                                            </a>
                                                        </div>
                                                        <div class='float-right px-1'>
                                                            <a href='{{ route('users.show', ['user' => $user]) }}'>
                                                                <i class='far fa-eye' title='View User' data-toggle='tooltip' data-placement='bottom'></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class='card-body'>
                                                <div class='row'>
                                                    <div class='col col-9'>
                                                        Name: {{ $user->first_name }} {{ $user->last_name }} <br>
                                                        Email: {{ $user->email }} <br>
                                                        Created: {{ $user->created_at->format('m/d/Y g:i A') }}
                                                    </div>
                                                    <div class='col col-1 contact-buttons'>
                                                        <a href='tel:{{ $user->phone }}' title='Call {{ $user->first_name }}' class='float-right'>
                                                            <i class='fas fa-phone-square fa-2x px-1'></i>
                                                        </a>
                                                    </div>
                                                    <div class='col col-1 contact-buttons'>
                                                        <a href='mailto:{{ $user->email }}' title='Email {{ $user->first_name }}' class='float-right'>
                                                            <i class='fas fa-envelope-square fa-2x px-1'></i>
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                @endforeach

                            @endempty

                        @else

                            There are no users to display.

                        @endisset

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
