@extends('layouts.app')
@section('page_title', 'Contact Details')
@section('breadcrumbs', Breadcrumbs::render('contacts.show', $contact->first_name))
@section('content')
<div class='main-section'>
   <div class='container-fluid'>
      <div class='row'>
         <div class='col-sm-8'>
            <p>
               <span class='contact-name-title'>{{ $contact->first_name }} {{ $contact->last_name }}</span>
               <a href='#' class='contact-toggle-favorite'><i class='far fa-star' title='toggle favorite' data-toggle='tooltip' data-placement='top'></i></a>
            </p>
         </div>
          <div class='col-sm-4'>
              <p class='float-right'>
                  <a href='{{ route('contacts.edit', ['contact' => $contact]) }}'>Edit</a> |
                  <a href='' data-toggle='modal'
                     data-id='{{ $contact->id }}'
                     data-title='Assign Owner to {{ $contact->first_name }} {{ $contact->last_name }}'
                     data-target='#modal_popup'>
                      Assign Owner
                  </a> |
                  <a href='#'>Send Contact</a>
              </p>
          </div>
      </div>
       <div class='row'>
           <div class='col-sm-12'>
            <div class='card'>
                <div class='card-header'>Contact Details</div>

               <div class='card-body'>
                  <b>Name:</b> {{ $contact->first_name }} {{ $contact->last_name }}<br>
                  <b>Email:</b> {{ $contact->email }}
                     @foreach($contact_method_types as $contact_method)
                        @if ($contact_method->id == $contact->email_type_id)
                           <i class='{{ $contact_method->icon_class }}'></i>
                        @endif
                     @endforeach
                  <br>
                  <b>Phone:</b> {{ $contact->phone }} <br>
                  <b>Owner:</b>
                     @if (isset($contact_owner))
                       {{ $contact_owner->first_name }} {{ $contact_owner->last_name }}
                     @else
                         Unassigned
                     @endif
                  <br>
                   <b>Owner:</b>
                   @if (isset($contact_source))
                       {{ $contact_source->name }} - {{ $contact_source->description }}
                   @else
                       Unknown
                   @endif
                   <br>
                  <b>Contact Type:</b> {{ $contact_type->name }}
               </div>
            </div>
         </div>
      </div>

       <!-- Address Details -->
       <div class='row mt-3'>
           <div class='col-sm-6'>
               <div class='card'>
                   <div class='card-header'>Billing Details</div>
                   <div class='card-body'>
                       <div class='row'>
                           <div class='col-sm-6'>
                               <b>Street:</b> {{ $billing->street }} <br>
                               <b>City:</b> {{ $billing->city }} <br>
                               <b>State:</b> {{ $billing->state }} <br>
                               <b>Zip:</b> {{ $billing->zip }}
                           </div>
                           <div class='col-sm-6'>
                               <iframe width='100%' height='150' frameborder='0' style='border:0'
                                   src="https://www.google.com/maps/embed/v1/search?key={{ env('GOOGLE_API_KEY') }}&q={{ urlencode($billing->street) }}+{{ urlencode($billing->city) }}+{{ urlencode($billing->state) }}+{{ urlencode($billing->zip) }}" allowfullscreen>
                               </iframe>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
           <div class='col-sm-6'>
               <div class='card'>
                   <div class='card-header'>Delivery Details</div>
                   <div class='card-body'>
                       <div class='row'>
                           <div class='col-sm-6'>
                               <b>Street:</b> {{ $delivery->street }} <br>
                               <b>City:</b> {{ $delivery->city }} <br>
                               <b>State:</b> {{ $delivery->state }} <br>
                               <b>Zip:</b> {{ $delivery->zip }}
                           </div>
                           <div class='col-sm-6'>
                               <iframe width='100%' height='150' frameborder='0' style='border:0'
                                       src="https://www.google.com/maps/embed/v1/search?key={{ env('GOOGLE_API_KEY') }}&q={{ urlencode($delivery->street) }}+{{ urlencode($delivery->city) }}+{{ urlencode($delivery->state) }}+{{ urlencode($delivery->zip) }}" allowfullscreen>
                               </iframe>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>

        <!-- Activity & Notes -->
        <div class='row mt-3'>
            <div class='col-sm-6'>
                <div class='card'>
                <div class='card-header'>Notes</div>
                    <div class='card-body'>
                        <div class='row mt-1'>
                            <div class='col col-sm-10 text-left'>
                                <form method='POST' id='add_contact_note_form' name='add_contact_note_form' action='#'>
                                    {{ csrf_field() }}
                                    <input type='hidden' name='contact_id' value='{{ $contact->id }}'>
                                    <div class='form-group'>
                                        <input type='text' class='form-control' id='note' name='note' placeholder='Add note...'>
                                    </div>
                                </form>
                            </div>
                            <div class='col col-sm-2 text-right'>
                                <button type='button' class='btn btn-primary btn-sm' id='add_contact_note'>Add Note</button>
                            </div>
                        </div>

                        @isset($notes)

                            @empty($notes)

                                There are no notes for this contact yet.

                            @else

                                @foreach ($notes as $item)
                                    <div class='row mt-2 border-bottom'>
                                        <div class='col col-sm-3 text-left'>
                                            <small class='font-weight-bold'>{{ $item['ts']->format('m/d/Y g:i A') }}</small>
                                        </div>
                                        <div class='col col-sm-3 text-left'>
                                            <small class='text-uppercase'>{{ $item['user'] }}</small>
                                        </div>
                                        <div class='col col-sm-6 text-left'>
                                            <small>{{ $item['note'] }}</small>
                                        </div>
                                    </div>
                                @endforeach

                            @endempty

                        @endisset
                    </div>
                </div>
            </div>
            <div class='col-sm-6'>
               <div class='card'>
                   <div class='card-header'>Activity</div>
                   <div class='card-body'>

                       @isset($activity)

                           @empty($activity)

                               There is no activity on this contact yet.

                           @else

                               @foreach ($activity as $item)
                                   <div class='row mt-2 border-bottom'>
                                       <div class='col col-sm-3 text-left'>
                                           <small class='font-weight-bold'>{{ $item['ts']->format('m/d/Y g:i A') }}</small>
                                       </div>
                                       <div class='col col-sm-3 text-left'>
                                           <small class='text-uppercase'>{{ $item['user'] }}</small>
                                       </div>
                                       <div class='col col-sm-6 text-left'>
                                           <small>{{ $item['note'] }}</small>
                                       </div>
                                   </div>
                               @endforeach

                           @endempty

                       @endisset

                   </div>
               </div>
           </div>
       </div>
   </div>
</div>

<!-- Modal -->
<div class='modal fade' id='modal_popup' tabindex='-1' role='dialog' aria-labelledby='modal_popup' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='modal_popup_title'></h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body'>
                <form>


                </form>
                <div class='form-group'>
                    <label for='contact_owner_id'>Contact Owner</label><br>
                    <select class='form-control' name='contact_owner_id'>
                        <option value=''>Unassigned</option>
                        @if (isset($contact_owners))
                            @foreach ($contact_owners as $owner)
                                <option value='{{ $owner->id }}'
                                   @if ($contact_owner)
                                      @if ($owner->id == $contact_owner->id)
                                         selected='selected'
                                      @endif
                                   @endif
                                >{{ $owner->first_name }} {{ $owner->last_name }}</option>
                            @endforeach
                        @endif
                    </select>
                    @if ($errors->has('contact_owner_id'))
                        <div class='alert alert-danger mt-1'>{{ $errors->first('contact_owner_id') }}</div>
                    @endif
                </div>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                <button type='submit' class='btn btn-primary'>Save</button>
            </div>
        </div>
    </div>
</div>
@endsection
