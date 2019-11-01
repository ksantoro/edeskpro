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
                            <form id='edit-user' name='edit-user' action='/users/{{ $user->id }}' method='POST'>
                                @csrf
                                {{ method_field('PUT') }}
                                <div class='row form-row'>
                                    <div class='col'>
                                        <div class='form-group'>
                                            <label for='user_type_id'>User Type</label><br>
                                            <select class='form-control' name='user_type_id'>
                                                @if (isset($user_types))
                                                    @foreach ($user_types as $type)
                                                        <option value='{{ $type->id }}'
                                                            @if ($type->id == $user->type_user_id)
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
                                        <a class='btn btn-secondary float-right' data-toggle='modal' data-target='#editUserModal'>Reset Password</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <br>
                    <!-- user roles -->
                    <div class='card'>
                        <div class='card-header'>User Permissions & Roles</div>
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

                                                            <div class='form-check'>
                                                                <input type='checkbox' class='form-check-input' name='role_user[{{ $role->id }}]' {{ $user->hasRole($role->id) ? 'checked' : ''}}>
                                                                <label class='form-check-label' for='exampleCheck1'>
                                                                    {{ $role->name }}
                                                                    <small>
                                                                        <i title='{{ $role->description }}' class='fas fa-question-circle text-secondary' data-toggle='tooltip' data-placement='right'></i>
                                                                    </small>
                                                                </label>
                                                            </div>

                                                        @endif

                                                    @endforeach

                                                </ul>
                                                <button type='button' class='btn btn-secondary btn-sm'>Check All</button>
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
                    <br>
                    <div class='form-group'>
                        <input type='submit' value='Save' class='btn btn-primary'>
                        <a href="/users/{{ $user->id }}" class='btn btn-secondary'>Cancel</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class='modal fade' id='editUserModal' tabindex='-1' role='dialog' aria-labelledby='editUserModalTitle' aria-hidden='true'>
        <div class='modal-dialog modal-dialog-centered' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='editUserModalTitle'>Edit User</h5>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <div class='modal-body' id='editUserModalBody'>
                    Are you sure you want to set a password reset email to {{ $user->email }}?
                    <form method='POST' action='/password/email' aria-label='{{ __('Reset Password') }}' id='userResetPasswordForm'>
                        @csrf
                        <input id='resetPasswordEmail' type='hidden' name='resetPasswordEmail' value="{{ $user->email }}">
                    </form>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                    <button type='button' class='btn btn-primary' id='userResetPasswordFormButton'>Send Email</button>
                </div>
            </div>
        </div>
    </div>
@endsection
