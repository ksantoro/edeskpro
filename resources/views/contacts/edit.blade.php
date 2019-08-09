@extends('layouts.app')
@section('page_title', 'Edit Contact')
@section('breadcrumbs', Breadcrumbs::render('contacts.edit', $contact->first_name))
@section('content')
<div class='main-section'>
   <div class='container-fluid'>
      <div class='row justify-content-center'>
         <div class='col-md-12'>
            <!-- Contact Info -->
            <div class='card'>
               <div class='card-header'>Edit {{ $contact->first_name }} {{ $contact->last_name }}</div>
               <div class='card-body'>
                  <form id='edit-contact' name='edit-contact' action='/contacts/{{ $contact->i }}' method='POST'>
                     @csrf
                     {{ method_field('PUT') }}
                     <div class='row form-row'>
                        <div class='col'>
                            <div class='row form-row'>
                                <div class='col'>
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
                                <div class='col'>
                                    <div class='form-group'>
                                        <label for='contact_source'>Contact Source</label><br>
                                        <select class='form-control' name='contact_source'>
                                            <option value=''>Unknown</option>
                                            @if (isset($contact_sources))
                                                @foreach ($contact_sources as $source)
                                                    <option value='{{ $source->id }}'
                                                            @if ($contact_source)
                                                            @if ($source->id == $contact_source->id)
                                                            selected='selected'
                                                        @endif
                                                        @endif
                                                    >{{ $source->name }} - {{ $source->description }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @if ($errors->has('contact_source'))
                                            <div class='alert alert-danger mt-1'>{{ $errors->first('contact_source') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='col'>
                            <div class='row form-row'>
                                <div class='col'>
                                    <div class='form-group'>
                                        <label for='title'>Title</label>
                                        <input type='text' name='title' id='title' class='form-control' value='{{ $contact->title }}' maxlength='64'>
                                        @if ($errors->has('title'))
                                            <div class='alert alert-danger mt-1'>{{ $errors->first('title') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class='col'>
                                    <div class='form-group'>
                                        <label for='contact_type_id'>Contact Type</label><br>
                                        <select class='form-control' name='contact_type_id'>
                                            @if (isset($contact_types))
                                                @foreach ($contact_types as $type)
                                                    <option value='{{ $type->id }}'
                                                    @if ($type->id == $contact->contact_type_id)
                                                        selected='selected'
                                                    @endif
                                                    >{{ $type->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @if ($errors->has('contact_type_id'))
                                            <div class='alert alert-danger mt-1'>{{ $errors->first('contact_type_id') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                     </div>

                     <div class='row form-row'>
                        <div class='col'>
                           <div class='form-group'>
                              <label for='first_name'>First Name</label>
                              <input type='text' name='first_name' id='first_name' class='form-control' value='{{ $contact->first_name }}' maxlength='64'>
                              @if ($errors->has('first_name'))
                                 <div class='alert alert-danger mt-1'>{{ $errors->first('first_name') }}</div>
                              @endif
                           </div>
                        </div>
                        <div class='col'>
                           <div class='form-group'>
                              <label for='last_name'>Last Name</label>
                              <input type='text' name='last_name' id='last_name' class='form-control' value='{{ $contact->last_name }}'  maxlength='64'>
                              @if ($errors->has('last_name'))
                                 <div class='alert alert-danger mt-1'>{{ $errors->first('last_name') }}</div>
                              @endif
                              </div>
                        </div>
                     </div>
                     <div class='row form-row'>
                        <div class='col'>
                           <div class='form-group'>
                              <label for='phone'>Phone</label>
                              <input type='text' name='phone' id='phone' class='form-control' value='{{ $contact->phone }}' placeholder='xxxxxxxxxx'  maxlength='20'>
                              @if ($errors->has('phone'))
                                 <div class='alert alert-danger mt-1'>{{ $errors->first('phone') }}</div>
                              @endif
                           </div>
                        </div>
                        <div class='col'>
                           <div class='form-group'>
                              <label for='phone_type_id'>Type</label><br>
                              <select class='form-control' name='phone_type_id'>
                                 @if (isset($contact_method_types))
                                    @foreach ($contact_method_types as $method_type)
                                       <option value='{{ $method_type->id }}'
                                          @if ($method_type->id == $contact->phone_type_id)
                                              selected='selected'
                                          @endif
                                       >{{ $method_type->name }}</option>
                                    @endforeach
                                 @endif
                              </select>
                              @if ($errors->has('phone_type_id'))
                                 <div class='alert alert-danger mt-1'>{{ $errors->first('phone_type_id') }}</div>
                              @endif
                           </div>
                        </div>
                        <div class='col'>
                           <div class='form-group'>
                              <label for='email'>Email</label>
                              <input type='text' name='email' id='email' class='form-control' value='{{ $contact->email }}' placeholder='xxx@xxx.xxx'  maxlength='255'>
                              @if ($errors->has('email'))
                                 <div class='alert alert-danger mt-1'>{{ $errors->first('email') }}</div>
                              @endif
                           </div>
                        </div>
                        <div class='col'>
                           <div class='form-group'>
                              <label for='email_type_id'>Type</label><br>
                              <select class='form-control' name='email_type_id'>
                                 @if (isset($contact_method_types))
                                    @foreach ($contact_method_types as $method_type)
                                       <option value='{{ $method_type->id }}'
                                          @if ($method_type->id == $contact->email_type_id)
                                              selected='selected'
                                          @endif
                                       >{{ $method_type->name }}</option>
                                    @endforeach
                                 @endif
                              </select>
                              @if ($errors->has('email_type_id'))
                                 <div class='alert alert-danger mt-1'>{{ $errors->first('email_type_id') }}</div>
                              @endif
                           </div>
                        </div>
                     </div>
               </div>
            </div>

            <br>
            <!-- Address Info -->
            <div class='card'>
               <div class='card-header'>Address Information</div>
               <div class='card-body'>
                  <div class='row form-row'>
                     <div class='col'>
                        <!-- Billing -->
                        <h3>Billing</h3><hr>
                        <div class='form-group'>
                            <label for='billing_address_type'>Type</label><br>
                            <select class='form-control' name='billing_address_type'>
                            @if (isset($contact_method_types))
                                @foreach ($contact_method_types as $method_type)
                                    <option value='{{ $method_type->id }}'
                                        @if ($method_type->id == $billing->contact_method_type_id)
                                            selected='selected'
                                        @endif
                                    >{{ $method_type->name }}</option>
                                @endforeach
                            @endif
                            </select>
                           @if ($errors->has('billing_address_type'))
                              <div class='alert alert-danger mt-1'>{{ $errors->first('billing_address_type') }}</div>
                           @endif
                        </div>
                        <div class='form-group'>
                           <label for='billing_street'>Street</label>
                           <input type='text' name='billing_street' id='billing_street' class='form-control' value='{{ $billing->street }}'>
                           @if ($errors->has('billing_street'))
                              <div class='alert alert-danger mt-1'>{{ $errors->first('billing_street') }}</div>
                           @endif
                        </div>
                        <div class='form-group'>
                           <label for='billing_suite'>Suite</label>
                           <input type='text' name='billing_suite' id='billing_suite' class='form-control' value='{{ $billing->suite }}'>
                           @if ($errors->has('billing_suite'))
                              <div class='alert alert-danger mt-1'>{{ $errors->first('billing_suite') }}</div>
                           @endif
                        </div>
                        <div class='row'>
                           <div class='col'>
                              <div class='form-group'>
                                 <label for='billing_city'>City</label>
                                 <input type='text' name='billing_city' id='billing_city' class='form-control' value='{{ $billing->city }}'>
                                 @if ($errors->has('billing_city'))
                                    <div class='alert alert-danger mt-1'>{{ $errors->first('billing_city') }}</div>
                                 @endif
                              </div>
                           </div>
                           <div class='col'>
                              <div class='form-group'>
                                 <label for='billing_state'>State</label>
                                  <select name='billing_state' id='billing_state' class='form-control' value='{{ $billing->state }}'>
                                      @foreach ($states as $state)
                                          <option
                                              value='{{ $state->code }}'
                                              @if ($billing->state == $state->code)
                                              selected='selected'
                                              @endif
                                          >
                                              {{ $state->code }} - {{ $state->name }}
                                          </option>
                                      @endforeach
                                  </select>
                                 @if ($errors->has('billing_state'))
                                    <div class='alert alert-danger mt-1'>{{ $errors->first('billing_state') }}</div>
                                 @endif
                              </div>
                           </div>
                           <div class='col'>
                              <div class='form-group'>
                                 <label for='billing_zip'>Zip</label>
                                 <input type='text' name='billing_zip' id='billing_zip' class='form-control' value='{{ $billing->zip }}'>
                                 @if ($errors->has('billing_zip'))
                                    <div class='alert alert-danger mt-1'>{{ $errors->first('billing_zip') }}</div>
                                 @endif
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class='col'>
                        <!-- Delivery -->
                        <h3>Delivery</h3><hr>
                        <div class='form-group'>
                           <label for='delivery_address_type'>Type</label><br>
                            <select class='form-control' name='delivery_address_type'>
                                @if (isset($contact_method_types))
                                    @foreach ($contact_method_types as $method_type)
                                        <option value='{{ $method_type->id }}'
                                        @if ($method_type->id == $delivery->contact_method_type_id)
                                            selected='selected'
                                        @endif
                                        >{{ $method_type->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                           @if ($errors->has('delivery_address_type'))
                              <div class='alert alert-danger mt-1'>{{ $errors->first('delivery_address_type') }}</div>
                           @endif
                        </div>
                        <div class='form-group'>
                           <label for='delivery_street'>Street</label>
                           <input type='text' name='delivery_street' id='delivery_street' class='form-control' value='{{ $delivery->street }}'>
                           @if ($errors->has('delivery_street'))
                              <div class='alert alert-danger mt-1'>{{ $errors->first('delivery_street') }}</div>
                           @endif
                        </div>
                        <div class='form-group'>
                           <label for='delivery_suite'>Suite</label>
                           <input type='text' name='delivery_suite' id='delivery_suite' class='form-control' value='{{ $delivery->suite }}'>
                           @if ($errors->has('delivery_suite'))
                              <div class='alert alert-danger mt-1'>{{ $errors->first('delivery_suite') }}</div>
                           @endif
                        </div>
                        <div class='row'>
                           <div class='col'>
                              <div class='form-group'>
                                 <label for='delivery_city'>City</label>
                                 <input type='text' name='delivery_city' id='delivery_city' class='form-control' value='{{ $delivery->city }}'>
                                 @if ($errors->has('delivery_city'))
                                    <div class='alert alert-danger mt-1'>{{ $errors->first('delivery_city') }}</div>
                                 @endif
                              </div>
                           </div>
                           <div class='col'>
                              <div class='form-group'>
                                 <label for='delivery_state'>State</label>
                                  <select name='delivery_state' id='delivery_state' class='form-control' value='{{ $delivery->state }}'>
                                      @foreach ($states as $state)
                                          <option
                                              value='{{ $state->code }}'
                                              @if ($delivery->state == $state->code)
                                              selected='selected'
                                              @endif
                                          >
                                              {{ $state->code }} - {{ $state->name }}
                                          </option>
                                      @endforeach
                                  </select>
                                 @if ($errors->has('delivery_state'))
                                    <div class='alert alert-danger mt-1'>{{ $errors->first('delivery_state') }}</div>
                                 @endif
                              </div>
                           </div>
                           <div class='col'>
                              <div class='form-group'>
                                 <label for='delivery_zip'>Zip</label>
                                 <input type='text' name='delivery_zip' id='delivery_zip' class='form-control' value='{{ $delivery->zip }}'>
                                 @if ($errors->has('delivery_zip'))
                                    <div class='alert alert-danger mt-1'>{{ $errors->first('delivery_zip') }}</div>
                                 @endif
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <br>
            <div class='form-group'>
               <input type='submit' value='Save Contact' class='btn btn-primary btn-lg'>
               <a href='/contacts/{{ $contact->id }}' class='btn btn-secondary btn-lg'>Cancel</a>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection
