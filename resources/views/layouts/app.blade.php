<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

   <title>@yield('page_title') - {{ config('app.name')}}</title>
   @include('layouts.partials.head')

</head>
<body>

   @include('layouts.partials.nav')

   @yield('breadcrumbs')

   @yield('content')

   @include('layouts.partials.footer')

   @include('layouts.partials.footer-scripts')

</body>
</html>
