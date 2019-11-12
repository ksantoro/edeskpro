@extends('layouts.app')
@section('page_title', 'Contacts Management')
@section('breadcrumbs', Breadcrumbs::render('contacts.index'))

@section('content')
<div class='main-section'>
    <div class='container-fluid'>
        <div class='d-flex flex-row'>
            <div class='p-2'>
            <a href='/contacts/create' class='btn btn-primary'>Create New</a>
            </div>
            <div class='p-2 flex-grow-1'>
                <!-- Search box -->
                <form id='search-contacts' action="/contacts/search" method='POST'>
                    @csrf
                    <div class='input-group mb-3'>
                        <div class='input-group-prepend'>
                            <span class='input-group-text' id='search-contacts'><span class='fa fa-search'></span></span>
                        </div>
                        <input type='text' class='form-control' name="search_term" placeholder='search contacts by first name, last name, phone, email...' aria-label='search-contacts' aria-describedby='search-contacts'>
                    </div>
                </form>
            </div>
            <div class='p-2'>
                <a href='/contacts' class='btn btn-secondary float-right'>Clear Search</a>
            </div>
        </div>
        <div class='row'>
            <div class='col-md-12'>
                <div class='row'>
                    <div class='col'>
                        <a href='/contacts'>
                            <div class='card text-white bg-primary mb-3'>
                                <div class='card-body'>
                                    <h4 class='card-title'>All Contacts</h4>
                                    <p class='card-text'><h1 class='float-right'>{{ $counts['all'] }}</h1></p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class='col'>
                        <a href='/leads'>
                            <div class='card text-white bg-secondary mb-3'>
                                <div class='card-body'>
                                    <h4 class='card-title'>Leads</h4>
                                    <p class='card-text'><h1 class='float-right'>{{ $counts['leads'] }}</h1></p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class='col'>
                        <a href='/opportunities'>
                            <div class='card text-white bg-success mb-3'>
                                <div class='card-body'>
                                    <h4 class='card-title'>Opportunities</h4>
                                    <p class='card-text'><h1 class='float-right'>{{ $counts['opps'] }}</h1></p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class='col'>
                        <a href='/customers'>
                            <div class='card text-white bg-info mb-3'>
                                <div class='card-body'>
                                    <h4 class='card-title'>Customers</h4>
                                    <p class='card-text'><h1 class='float-right'>{{ $counts['customers'] }}</h1></p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class='row'>
                    <div class='col col-md-2'>
                        <div class='row mb-3'>
                            <div class='col'>
                                <a class='btn btn-info' href='/mycontacts'>
                                    <i class="fas fa-address-card"></i> My Contacts
                                </a>
                            </div>
                        </div>
                        <div class='row mb-2'>
                            <div class='col'>
                                <hr>
                                <i class="fas fa-filter"></i> &nbsp; Filters
                                <hr>
                                @isset($filters)
                                    @empty($filters)
                                        There are no filters available.
                                    @else
                                        <form action='/filtercontacts' name='contact_filters' id='contact_filters' method='POST'>
                                            @csrf
                                            @foreach ($filters as $i => $filter)
                                                <div class='form-group'>
                                                    <label for='{{ $filter['name'] }}'>{{ $filter['label'] }}</label>
                                                    <select class='form-control' id='{{ $filter['name'] }}' name='{{ $filter['name'] }}'>
                                                        <option value=''>Select...</option>
                                                        @foreach ($filter['options'] as $option)
                                                            <option value='{{ $option['id'] }}'>{{ $option['value'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endforeach
                                            <input type='submit' value='Apply Filters' class='btn btn-secondary btn-sm'>
                                            <a href='/contacts' class='btn btn-secondary btn-sm'>Clear All</a>
                                        </form>
                                    @endempty
                                @else
                                    There are no filters available.
                                @endisset
                            </div>
                        </div>
                        <div class='row mb-2'>
                            <div class='col'>
                                <hr>
                                <i class="fas fa-filter"></i> &nbsp; Applied Filters
                                <hr>
                                @isset($applied_filters)
                                    @empty($applied_filters)
                                        There are no filters applied yet.
                                    @else
                                        @foreach ($applied_filters as $filter)
                                            <span class='badge badge-pill badge-danger'><i class='fas fa-check-square'></i> {{ $filter['name'] }}</span>
                                        @endforeach
                                    @endempty
                                @else
                                    There are no filters applied yet.
                                @endisset
                            </div>
                        </div>
                    </div>
                    <div class='col col-md-10'>

                        <div class='row'>
                            <div class='col col-auto'>
                                {{ $contacts->links() }}
                            </div>
                        </div>

                        @isset($alert_message)
                            <div class='alert alert-danger' role='alert'>{{ $alert_message }}</div>
                        @endisset

                        @isset($contacts)
                            @empty($contacts)
                                There are no contacts to display.
                            @else
                                <div class='card-columns'>
                                    @foreach ($contacts as $contact)
                                        <div class='card m-2' style='width:25rem;'>
                                            <div class='card-header'>
                                                <div class='row justify-content-end'>
                                                    <div class='col-8 ml-auto'>
                                                        <i class='fas fa-user-circle'></i> &nbsp; {{ $contact->first_name }} {{ $contact->last_name }}
                                                    </div>
                                                    <div class='col-4 mr-auto'>
                                                        {{--action icons (temporary)--}}
                                                        <div class='float-right px-1'>
                                                            <a href='#' onclick="event.preventDefault(); $('#archive-form-{{ $contact->id }}').submit();">
                                                                <i class='fas fa-archive'  title='Archive Contact' data-toggle='tooltip' data-placement='bottom'></i>
                                                            </a>
                                                            <form id='archive-form-{{ $contact->id }}' action="/contacts/{{ $contact->id }}" method='POST' class='d-none'>
                                                                @method('DELETE')
                                                                @csrf
                                                            </form>
                                                        </div>
                                                        <div class='float-right px-1'>
                                                            <a href='/contacts/{{ $contact->id }}/edit' class='float-right'>
                                                                <i class='fas fa-user-edit' title='Edit Contact' data-toggle='tooltip' data-placement='bottom'></i>
                                                            </a>
                                                        </div>
                                                        <div class='float-right px-1'>
                                                            <a href='/contacts/{{ $contact->id }}'>
                                                                <i class='far fa-eye' title='View Contact' data-toggle='tooltip' data-placement='bottom'></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='card-body'>
                                                <div class='row'>
                                                    <div class='col col-9'>
                                                        Name: {{ $contact->first_name }} {{ $contact->last_name }} <br>
                                                        Email: {{ $contact->email }} <br>
                                                        Created: {{ $contact->created_at->format('m/d/Y g:i A') }}
                                                    </div>
                                                    <div class='col col-1 float-right contact-buttons'>
                                                        <a href='tel:{{ $contact->phone }}' title='Call {{ $contact->first_name }}' onClick="log_contact_activity({{ $contact->id }}, 'called')">
                                                            <i class='fas fa-phone-square fa-2x px-1'></i>
                                                        </a>
                                                    </div>
                                                    <div class='col col-1 float-right contact-buttons'>
                                                        <a href='mailto:{{ $contact->email }}' title='Email {{ $contact->first_name }}' onClick="log_contact_activity({{ $contact->id }}, 'emailed')">
                                                            <i class='fas fa-envelope-square fa-2x px-1'></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endempty
                        @else
                            There are no contacts to display.
                        @endisset

                        <div class='row'>
                            <div class='col col-auto'>
                                {{ $contacts->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
