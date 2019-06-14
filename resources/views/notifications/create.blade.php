@extends('layouts.app')
@section('page_title', 'Create New Notification')
@section('breadcrumbs', Breadcrumbs::render('notifications.create'))

@section('content')
    <div class='main-section'>
        <div class='container-fluid'>
            <div class='row justify-content-center'>
                <div class='col-md-12'>
                    <form id='create-new-notification' name='create-new-notification' action='{{ route('notifications.store') }}' method='POST'>
                    {{ csrf_field() }}
                    <!-- company info -->
                        <div class='card'>
                            <div class='card-header'>Set Up New Custom Notification</div>
                            <div class='card-body'>
                                <div class='row form-row'>
                                    <div class='col'>
                                        <div class='form-group'>
                                            <label for='notification_type_id'>Notification Type</label><br>
                                            <select class='form-control' name='notification_type_id' id='notification_type_id'>
                                                @if (isset($notification_types))
                                                    @foreach ($notification_types as $type)
                                                        <option value='{{ $type->id }}'>
                                                            {{ $type->action_type->name }}
                                                            {{ $type->entity_type->name }}
                                                            - {{ $type->description }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if ($errors->has('notification_type_id'))
                                                <div class='alert alert-danger mt-1'>{{ $errors->first('notification_type_id') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class='col'>
                                        <label for='user_id'>Send To</label><br>
                                        <select class='form-control' name='users[]' id='notification_user_id' multiple></select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class='form-group'>
                            <input type='submit' value='Save New Notification' class='btn btn-primary btn-lg'>
                            <a href='#' class='btn btn-success btn-lg' onclick='document.getElementById("create-new-notification").reset();'>Clear Form</a>
                            <a href='{{ URL::to('notifications') }}' class='btn btn-secondary btn-lg'>Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
