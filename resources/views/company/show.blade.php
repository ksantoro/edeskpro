@extends('layouts.app')
@section('page_title', 'Company Profile')
@section('breadcrumbs', Breadcrumbs::render('companies.show', $company))
@section('content')
<div class='main-section'>
    <div class="container-fluid">
        <div class='row'>
            <div class='col-md-1'>
                <a href='/companies/create' class='btn btn-primary'>Create New</a>
            </div>
            <div class='col-md-11'>
                <!-- Search box -->
                <div class='input-group mb-3'>
                    <div class='input-group-prepend'>
                        <span class='input-group-text' id='search-companies'><span class='fa fa-search'></span></span>
                    </div>
                    <input type='text' class='form-control' placeholder='search companies...' aria-label='search-companies' aria-describedby='search-companies'>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Company Profile</div>

                    <div class="card-body"><br>
                        ID: {{ $company->id  }}
                        Name: {{ $company->name }}<br>
                        Database: {{ $company->database }} <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
