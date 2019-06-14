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
    </div>
</div>
@endsection
