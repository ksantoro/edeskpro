@extends('layouts.app')
@section('page_title', 'Edit User')
@section('breadcrumbs', Breadcrumbs::render('users.edit', $user))
@section('content')
    <div class='main-section'>
        <div class='container-fluid'>
            <div class='row justify-content-center'>
                <div class='col-md-12'>
                    <!-- user Info -->
                    <div class='card'>
                        <div class='card-header'>User Information</div>
                        <div class='card-body'>
                            <form id='edit-user' name='edit-user' action='{{ route('users.update', $user->id) }}' method='POST'>
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class='row form-row'>
                                    <div class='col'>
                                        <div class='form-group'>
                                            <label for='user_type_id'>User Type</label><br>
                                            <select class='form-control' name='user_type_id'>
                                                @if (isset($user_types))
                                                    @foreach ($user_types as $type)
                                                        <option value='{{ $type->id }}'
                                                                @if ($type->id == $user->type_id)
                                                                selected='selected'
                                                            @endif
                                                        >{{ $type->description }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if ($errors->has('user_type_id'))
                                                <div class='alert alert-danger mt-1'>{{ $errors->first('user_type_id') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class='col'>
                                        <div class='form-group'>
                                            <label for='email'>Email</label>
                                            <input type='text' name='email' id='email' class='form-control' value='{{ $user->email }}' maxlength='255' disabled>
                                            @if ($errors->has('email'))
                                                <div class='alert alert-danger mt-1'>{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class='row form-row'>
                                    <div class='col'>
                                        <div class='form-group'>
                                            <label for='first_name'>First Name</label>
                                            <input type='text' name='first_name' id='first_name' class='form-control' value='{{ $user->first_name }}' maxlength='64'>
                                            @if ($errors->has('first_name'))
                                                <div class='alert alert-danger mt-1'>{{ $errors->first('first_name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class='col'>
                                        <div class='form-group'>
                                            <label for='last_name'>Last Name</label>
                                            <input type='text' name='last_name' id='last_name' class='form-control' value='{{ $user->last_name }}'  maxlength='64'>
                                            @if ($errors->has('last_name'))
                                                <div class='alert alert-danger mt-1'>{{ $errors->first('last_name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class='row form-row'>
                                    <div class='col'>
                                        <button class='btn btn-alert btn-lg float-right' onclick="alert('Cant reset yet'); return false;">Reset Password</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <br>
                    <!-- user roles -->
                    <div class='card'>
                        <div class='card-header'>User Permissions & Roles</div>
                        <div class='card-body'>

                            @foreach($roles as $role)

                                <div class='form-check'>
                                    <input type='checkbox' class='form-check-input' name='role_user[{{ $role->id }}]' {{ $user->hasRole($role->id) ? 'checked' : ''}}>
                                    <label class='form-check-label' for='exampleCheck1'>{{ $role->name }} - {{ $role->description }}</label>
                                </div>

                            @endforeach

                        </div>
                    </div>
                    <br>
                    <div class='form-group'>
                        <input type='submit' value='Edit User' class='btn btn-primary btn-lg'>
                        <a href='#' class='btn btn-success btn-lg' onclick='document.getElementById("create-new-user").reset();'>Clear Form</a>
                        <a href='{{ URL::to('users') }}' class='btn btn-secondary btn-lg'>Cancel</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
