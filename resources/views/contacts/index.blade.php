@extends('layouts.app')
@section('page_title', 'Contacts Management')
@section('breadcrumbs', Breadcrumbs::render('contacts.index'))

@section('content')
<div class='main-section'>
   <div class='container-fluid'>
      <div class='row'>
         <div class='col-md-1'>
            <a href='{{ route('contacts.create') }}' class='btn btn-primary'>Create New</a>
         </div>
         <div class='col-md-10'>
             <!-- Search box -->
             <form id='search-contacts' action="{{ route('contacts.search') }}" method='POST'>
                 @csrf
                    <div class='input-group mb-3'>
                        <div class='input-group-prepend'>
                            <span class='input-group-text' id='search-contacts'><span class='fa fa-search'></span></span>
                        </div>
                        <input type='text' class='form-control' name="search_term" placeholder='search contacts by first name, last name, phone, email...' aria-label='search-contacts' aria-describedby='search-contacts'>
                    </div>
             </form>
         </div>
          <div class='col-md-1'>
              <a href='{{ route('contacts.index') }}' class='btn btn-secondary float-right'>Clear Search</a>
          </div>
      </div>
      <div class='row'>
         <div class='col-md-12'>

             <div class='row'>
                 <div class='col'>
                     <div class='card text-white bg-primary mb-3'>
                         <div class='card-body'>
                             <h4 class='card-title'>All Contacts</h4>
                             <p class='card-text'><h1 class='float-right'>{{ $counts['all'] }}</h1></p>
                         </div>
                     </div>
                 </div>
                 <div class='col'>
                     <div class='card text-white bg-secondary mb-3'>
                         <div class='card-body'>
                             <h4 class='card-title'>Leads</h4>
                             <p class='card-text'><h1 class='float-right'>{{ $counts['leads'] }}</h1></p>
                         </div>
                     </div>
                 </div>
                 <div class='col'>
                     <div class='card text-white bg-success mb-3'>
                         <div class='card-body'>
                             <h4 class='card-title'>Opportunities</h4>
                             <p class='card-text'><h1 class='float-right'>{{ $counts['opps'] }}</h1></p>
                         </div>
                     </div>
                 </div>
                 <div class='col'>
                     <div class='card text-white bg-info mb-3'>
                         <div class='card-body'>
                             <h4 class='card-title'>Customers</h4>
                             <p class='card-text'><h1 class='float-right'>{{ $counts['customers'] }}</h1></p>
                         </div>
                     </div>
                 </div>
             </div>

            <div class='row'>

               @isset($contacts)

                  @empty($contacts)

                     There are no contacts to display.

                  @else

                     @foreach ($contacts as $contact)
                              <div class='card m-2'>
                              <div class='card-header'>

                              <div class='row justify-content-end'>
                                 <div class='col-6 ml-auto'>
                                    <i class='fas fa-user-circle'></i> &nbsp; {{ $contact->first_name }} {{ $contact->last_name }}
                                 </div>
                                 <div class='col-6 mr-auto'>
                                    <div class='btn-group btn-group-sm float-right'>
                                       <button type='button' class='btn btn-info dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                          <i class='fas fa-cog'></i> <span class='caret'></span>
                                       </button>
                                       <ul class='dropdown-menu dropdown-menu-right'>
                                          <li><a href='{{ route('contacts.show', ['contact' => $contact]) }}'><i class='far fa-eye'></i> &nbsp; View Details</a></li>
                                          <li><a href='{{ route('contacts.edit', ['contact' => $contact]) }}'><i class='fas fa-user-edit'></i> &nbsp; Edit Contact</a></li>
                                          <li><a href='#'><i class='fas fa-pencil-alt'></i> &nbsp; Assign Owner</a></li>
                                          <li role='separator' class='dropdown-divider'></li>
                                          <li>
                                              <a href='{{ route('contacts.destroy', ['contact' => $contact]) }}' onclick="event.preventDefault(); $('#archive-form-{{ $contact->id }}').submit();">
                                                  <i class='fas fa-archive'></i> &nbsp; Archive
                                              </a>
                                              <form id='archive-form-{{ $contact->id }}' action="{{ route('contacts.destroy', ['contact' => $contact]) }}" method='POST' style='display: none;'>
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
                                       Name: {{ $contact->first_name }} {{ $contact->last_name }} <br>
                                       Email: {{ $contact->email }} <br>
                                       Created: {{ $contact->created_at->format('m/d/Y g:i A') }}
                                    </div>
                                    <div class='col col-1 text-right contact-buttons'>
                                       <a href='tel:{{ $contact->phone }}' title='Call {{ $contact->first_name }}'>
                                          <i class='fas fa-phone-square fa-3x'></i>
                                       </a>
                                    </div>
                                    <div class='col col-1 text-right contact-buttons'>
                                       <a href='mailto:{{ $contact->email }}' title='Email {{ $contact->first_name }}'>
                                          <i class='fas fa-envelope-square fa-3x'></i>
                                       </a>
                                    </div>
                                 </div>

                              </div>
                           </div>

                     @endforeach

                  @endempty

               @else

                  There are no contacts to display.

               @endisset

            </div>
         </div>
      </div>
   </div>
</div>
@endsection
