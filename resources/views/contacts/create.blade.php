@extends('layouts.app')
@section('page_title', 'New Contact')
@section('breadcrumbs', Breadcrumbs::render('contacts.create'))
@section('content')
<div class='main-section'>
   <div class='container-fluid'>
      <div class='row justify-content-center'>
         <div class='col-md-12'>
            <!-- Contact Info -->
            <div class='card'>
               <div class='card-header'>Contact Information</div>
               <div class='card-body'>
                  <form id='create-new-contact' name='create-new-contact' action='/contacts' method='POST'>
                     @csrf
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
                                                    <option value='{{ $owner->id }}'>{{ $owner->first_name }} {{ $owner->last_name }}</option>
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
                                                    <option value='{{ $source->id }}'>{{ $source->name }} - {{ $source->description }}</option>
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
                                        <input type='text' name='title' id='title' class='form-control' value='{{ old('title') }}' maxlength='64'>
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
                                                    <option value='{{ $type->id }}'>{{ $type->name }}</option>
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
                              <input type='text' name='first_name' id='first_name' class='form-control' value='{{ old('first_name') }}' maxlength='64'>
                              @if ($errors->has('first_name'))
                                 <div class='alert alert-danger mt-1'>{{ $errors->first('first_name') }}</div>
                              @endif
                           </div>
                        </div>
                        <div class='col'>
                           <div class='form-group'>
                              <label for='last_name'>Last Name</label>
                              <input type='text' name='last_name' id='last_name' class='form-control' value='{{ old('last_name') }}'  maxlength='64'>
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
                              <input type='text' name='phone' id='phone' class='form-control' value='{{ old('phone') }}' placeholder='xxxxxxxxxx'  maxlength='20'>
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
                                       <option value='{{ $method_type->id }}'>{{ $method_type->name }}</option>
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
                              <input type='text' name='email' id='email' class='form-control' value='{{ old('email') }}' placeholder='xxx@xxx.xxx'  maxlength='255'>
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
                                       <option value='{{ $method_type->id }}'>{{ $method_type->name }}</option>
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
                         <button id='copy_to_delivery' type='button' class='btn btn-primary btn-sm float-right'>Copy to Delivery</button>
                         <div class='clearfix'></div>
                        <div class='form-group'>
                            <label for='billing_address_type'>Type</label><br>
                            <select class='form-control' name='billing_address_type'>
                            @if (isset($contact_method_types))
                                @foreach ($contact_method_types as $method_type)
                                    <option value='{{ $method_type->id }}'>{{ $method_type->name }}</option>
                                @endforeach
                            @endif
                            </select>
                           @if ($errors->has('billing_address_type'))
                              <div class='alert alert-danger mt-1'>{{ $errors->first('billing_address_type') }}</div>
                           @endif
                        </div>
                        <div class='form-group'>
                           <label for='billing_street'>Street</label>
                           <input type='text' name='billing_street' id='billing_street' class='form-control' value='{{ old('billing_street') }}'>
                           @if ($errors->has('billing_street'))
                              <div class='alert alert-danger mt-1'>{{ $errors->first('billing_street') }}</div>
                           @endif
                        </div>
                        <div class='form-group'>
                           <label for='billing_suite'>Suite</label>
                           <input type='text' name='billing_suite' id='billing_suite' class='form-control' value='{{ old('billing_suite') }}'>
                           @if ($errors->has('billing_suite'))
                              <div class='alert alert-danger mt-1'>{{ $errors->first('billing_suite') }}</div>
                           @endif
                        </div>
                        <div class='row'>
                           <div class='col'>
                              <div class='form-group'>
                                 <label for='billing_city'>City</label>
                                 <input type='text' name='billing_city' id='billing_city' class='form-control' value='{{ old('billing_city') }}'>
                                 @if ($errors->has('billing_city'))
                                    <div class='alert alert-danger mt-1'>{{ $errors->first('billing_city') }}</div>
                                 @endif
                              </div>
                           </div>
                           <div class='col'>
                              <div class='form-group'>
                                 <label for='billing_state'>State</label>
                                 <select name='billing_state' id='billing_state' class='form-control' value='{{ old('billing_state') }}'>
                                     @foreach ($states as $state)
                                         <option
                                             value='{{ $state->code }}'
                                             @if (old('billing_state') == $state->code)
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
                                 <input type='text' name='billing_zip' id='billing_zip' class='form-control' value='{{ old('billing_zip') }}'>
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
                         <button id='copy_to_billing' type='button' class='btn btn-primary btn-sm float-right'>Copy to Billing</button>
                         <div class='clearfix'></div>
                        <div class='form-group'>
                           <label for='delivery_address_type'>Type</label><br>
                            <select class='form-control' name='delivery_address_type'>
                                @if (isset($contact_method_types))
                                    @foreach ($contact_method_types as $method_type)
                                        <option value='{{ $method_type->id }}'>{{ $method_type->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                           @if ($errors->has('delivery_address_type'))
                              <div class='alert alert-danger mt-1'>{{ $errors->first('delivery_address_type') }}</div>
                           @endif
                        </div>
                        <div class='form-group'>
                           <label for='delivery_street'>Street</label>
                           <input type='text' name='delivery_street' id='delivery_street' class='form-control' value='{{ old('delivery_street') }}'>
                           @if ($errors->has('delivery_street'))
                              <div class='alert alert-danger mt-1'>{{ $errors->first('delivery_street') }}</div>
                           @endif
                        </div>
                        <div class='form-group'>
                           <label for='delivery_suite'>Suite</label>
                           <input type='text' name='delivery_suite' id='delivery_suite' class='form-control' value='{{ old('delivery_suite') }}'>
                           @if ($errors->has('delivery_suite'))
                              <div class='alert alert-danger mt-1'>{{ $errors->first('delivery_suite') }}</div>
                           @endif
                        </div>
                        <div class='row'>
                           <div class='col'>
                              <div class='form-group'>
                                 <label for='delivery_city'>City</label>
                                 <input type='text' name='delivery_city' id='delivery_city' class='form-control' value='{{ old('delivery_city') }}'>
                                 @if ($errors->has('delivery_city'))
                                    <div class='alert alert-danger mt-1'>{{ $errors->first('delivery_city') }}</div>
                                 @endif
                              </div>
                           </div>
                           <div class='col'>
                              <div class='form-group'>
                                 <label for='delivery_state'>State</label>
                                 <select name='delivery_state' id='delivery_state' class='form-control' value='{{ old('delivery_state') }}'>
                                  @foreach ($states as $state)
                                      <option
                                          value='{{ $state->code }}'
                                          @if (old('delivery_state') == $state->code)
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
                                 <input type='text' name='delivery_zip' id='delivery_zip' class='form-control' value='{{ old('delivery_zip') }}'>
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
             <!-- Initial Note -->
             <div class='card mt-3'>
                 <div class='card-header'>Notes</div>
                 <div class='card-body'>
                     <div class='row form-row'>
                         <div class='col'>
                             <div class='form-group'>
                                 <label for='notes'>Example textarea</label>
                                 <textarea class='form-control' id='notes' name='notes' rows='3' value='{{ old('notes') }}'></textarea>
                                 @if ($errors->has('notes'))
                                     <div class='alert alert-danger mt-1'>{{ $errors->first('notes') }}</div>
                                 @endif
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
            <br>
            <div class='form-group'>
               <input type='submit' value='Save New Contact' class='btn btn-primary btn-lg'>
               <a href='#' class='btn btn-success btn-lg' onclick='document.getElementById("create-new-contact").reset();'>Clear Form</a>
               <a href='/contacts' class='btn btn-secondary btn-lg'>Cancel</a>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection
