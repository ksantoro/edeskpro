@extends('layouts.app')
@section('page_title', 'New User')
@section('breadcrumbs', Breadcrumbs::render('users.create'))
@section('content')
    <div class='main-section'>
        <div class='container-fluid'>
            <div class='row justify-content-center'>
                <div class='col-md-12'>
                    <!-- user Info -->
                    <div class='card'>
                        <div class='card-header'>User Information</div>
                        <div class='card-body'>
                            <form id='create-new-user' name='create-new-user' action='{{ route('users.store') }}' method='POST'>
                                {{ csrf_field() }}
                                <div class='row form-row'>
                                    <div class='col'>
                                        <div class='form-group'>
                                            <label for='user_type_id'>User Type</label><br>
                                            <select class='form-control' name='user_type_id'>
                                                @if (isset($user_types))
                                                    @foreach ($user_types as $type)
                                                        <option value='{{ $type->id }}'>{{ $type->description }}</option>
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
                                            <input type='text' name='email' id='email' class='form-control' value='{{ old('email') }}' placeholder='xxx@xxx.xxx'  maxlength='255'>
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
                                            <input type='text' name='first_name' id='first_name' class='form-control' value='{{ old('first_name') }}' maxlength='64'>
                                            @if ($errors->has('first_name'))
                                                <div class='alert alert-danger mt-1'>{{ $errors->first('first_name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class='col'>
                                        <div class='form-group'>
                                            <label for='last_name'>Last Name</label>
                                            <input type='text' name='last_name' id='last_name' class='form-control' value='{{ old('last_name') }}'  maxlength='64'>
                                            @if ($errors->has('last_name'))
                                                <div class='alert alert-danger mt-1'>{{ $errors->first('last_name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class='row form-row'>
                                    <div class='col'>
                                        <div class='form-group'>
                                            <label for='password'>Password</label>
                                            <div class='input-group'>
                                                <input type='password' name='password' id='password' class='form-control' value='{{ old('password') }}' maxlength='20' required>
                                                <span class='input-group-addon'>
                                                    <a id='show-password' href="#"><i class='fas fa-eye' id='show-password-icon'></i></a>
                                                </span>
                                            </div>
                                            @if ($errors->has('password'))
                                                <div class='alert alert-danger mt-1'>{{ $errors->first('password') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class='col'>
                                        <div class='form-group'>
                                            <label for='password-confirm'>Confirm Password</label>
                                            <div class='input-group'>
                                                <input type='password' name='password_confirmation' id='password-confirm' class='form-control' value='{{ old('password_confirmation') }}' maxlength='20' required>
                                                <span class='input-group-addon'>
                                                    <a id='show-password-confirm' href="#"><i class='fas fa-eye' id='show-password-confirm-icon'></i></a>
                                                </span>
                                            </div>
                                            @if ($errors->has('password_confirmation'))
                                                <div class='alert alert-danger mt-1'>{{ $errors->first('password_confirmation') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <br>
                    <div class='form-group'>
                        <input type='submit' value='Save New User' class='btn btn-primary btn-lg'>
                        <a href='#' class='btn btn-success btn-lg' onclick='document.getElementById("create-new-user").reset();'>Clear Form</a>
                        <a href='{{ URL::to('users') }}' class='btn btn-secondary btn-lg'>Cancel</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
