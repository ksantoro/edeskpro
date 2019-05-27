@extends('layouts.app')
@section('page_title', 'User Settings')
@section('breadcrumbs', Breadcrumbs::render('users.settings', $user))
@section('content')
<div class='main-section'>
    <div class='container-fluid'>
        <div class='row justify-content-center'>
            <div class='col-md-12'>
                <div class='card'>
                    <div class='card-header'>My Settings</div>
                    <div class='card-body'>

                        @empty($user)

                            No user found for ID specified.

                        @else

                            <div class='well'>
                                ID: {{ $user->id }} <br>
                                Name: {{ $user->first_name }} {{ $user->last_name }} <br>
                                Email: {{ $user->email }} <br>
                            </div>

                        @endempty

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
