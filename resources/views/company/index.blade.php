@extends('layouts.app')
@section('page_title', 'Company Management')
@section('breadcrumbs', Breadcrumbs::render('companies.index'))
@section('content')
    <div class='main-section'>
        <div class='container-fluid'>
            <div class='row'>
                <div class='col-md-1'>
                    <a href='{{ route('companies.create') }}' class='btn btn-primary'>Create New</a>
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
                                                    <div class='col-6 ml-auto'>
                                                        <i class='fas fa-user-circle'></i> &nbsp; {{ $company->name }}
                                                    </div>
                                                    <div class='col-6 mr-auto'>
                                                        <div class='btn-group btn-group-sm float-right'>
                                                            <button type='button' class='btn btn-info dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                                <i class='fas fa-cog'></i> <span class='caret'></span>
                                                            </button>
                                                            <ul class='dropdown-menu dropdown-menu-right'>
                                                                <li><a href='{{ route('companies.show', ['company' => $company]) }}'><i class='far fa-eye'></i> &nbsp; View Details</a></li>
                                                                <li><a href='{{ route('companies.edit', ['company' => $company]) }}'><i class='fas fa-user-edit'></i> &nbsp; Edit Company</a></li>
                                                                <li role='separator' class='dropdown-divider'></li>
                                                                <li>
                                                                    <a href='{{ route('companies.destroy', ['company' => $company]) }}' onclick="event.preventDefault(); $('#archive-form-{{ $company->id }}').submit();">
                                                                        <i class='fas fa-archive'></i> &nbsp; Archive
                                                                    </a>
                                                                    <form id='archive-form-{{ $company->id }}' action="{{ route('companies.destroy', ['company' => $company]) }}" method='POST' style='display: none;'>
                                                                        @method('DELETE')
                                                                        @csrf
                                                                    </form>
                                                                </li>
                                                            </ul>
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
