@extends('layouts.app')
@section('page_title', 'Company Management')
@section('breadcrumbs', Breadcrumbs::render('companies.index'))
@section('content')
    <div class='main-section'>
        <div class='container-fluid'>
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
            <div class='row justify-content-center'>
                <div class='col-md-12'>

                    <div class='row'>

                        @isset($companies)

                            @empty($companies)

                                There are no companies to display.

                            @else

                                @foreach ($companies as $company)
                                    <div class='col-md-4 contact-card'>
                                        <div class='card'>
                                            <div class='card-header'>

                                                <div class='row justify-content-end'>
                                                    <div class='col-8 ml-auto'>
                                                        <i class='fas fa-user-circle'></i> &nbsp; {{ $company->name }}
                                                    </div>
                                                    <div class='col-4 mr-auto'>
                                                        {{--action icons (temporary)--}}
                                                        <div class='float-right px-1'>
                                                            <a href='#' onclick="event.preventDefault(); $('#archive-form-{{ $company->id }}').submit();">
                                                                <i class='fas fa-archive'  title='Archive Company' data-toggle='tooltip' data-placement='bottom'></i>
                                                            </a>
                                                            <form id='archive-form-{{ $company->id }}' action="/companies/{{ $company->id }}" method='POST' class='d-none'>
                                                                @method('DELETE')
                                                                @csrf
                                                            </form>
                                                        </div>
                                                        <div class='float-right px-1'>
                                                            <a href='/companies/{{ $company->id }}/edit' class='float-right'>
                                                                <i class='fas fa-user-edit' title='Edit Company' data-toggle='tooltip' data-placement='bottom'></i>
                                                            </a>
                                                        </div>
                                                        <div class='float-right px-1'>
                                                            <a href='/companies/{{ $company->id }}'>
                                                                <i class='far fa-eye' title='View Company' data-toggle='tooltip' data-placement='bottom'></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class='card-body'>
                                                <div class='row'>
                                                    <div class='col col-9'>
                                                        Name: {{ $company->name }} <br>
                                                        Database: {{ $company->database }} <br>
                                                        Created: {{ $company->created_at->format('m/d/Y g:i A') }}
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                @endforeach

                            @endempty

                        @else

                            There are no companies to display.

                        @endisset

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
