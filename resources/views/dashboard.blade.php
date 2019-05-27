@extends('layouts.app')

@section('page_title', 'Dashboard')
@section('breadcrumbs', Breadcrumbs::render('dashboard'))

@section('content')
<div class='main-section'>
   <div class='container-fluid'>
      <h4>Welcome {{ Auth::user()->first_name }}</h4>

       @if (Auth::user()->type_user_id == 1)

           @include('dashboard.admin')

       @endif


       @if (Auth::user()->type_user_id == 2)

           @include('dashboard.admin')

       @endif

       @if (Auth::user()->type_user_id == 3)

           @include('dashboard.technical')

       @endif

       @if (Auth::user()->type_user_id == 4)

           @include('dashboard.csr')

       @endif

       @if (Auth::user()->type_user_id == 5)

           @include('dashboard.sales')

       @endif

       @if (Auth::user()->type_user_id == 6)

           @include('dashboard.salesmgr')

       @endif

       @if (Auth::user()->type_user_id == 7)

           @include('dashboard.field')

       @endif

       @if (Auth::user()->type_user_id == 8)

           @include('dashboard.foreman')

       @endif

       @if (Auth::user()->type_user_id == 9)

           @include('dashboard.marketing')

       @endif

       @if (Auth::user()->type_user_id == 10)

           @include('dashboard.finance')

       @endif

   </div>
</div>

@endsection
