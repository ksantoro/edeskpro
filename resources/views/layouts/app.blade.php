<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

   <title>@yield('page_title') - {{ config('app.name')}}</title>
   @include('layouts.partials.head')

</head>
<body>

<div style='height: 100%;'> <!-- TODO: add this somewhere else -->

    @include('layouts.partials.nav')

    <div style='margin-top: 70px;'></div> <!-- TODO: add this somewhere else -->

    @yield('breadcrumbs')

    @yield('content')

    @include('layouts.partials.footer')

</div>

   @include('layouts.partials.footer-scripts')

   <script src='/js/app.js'></script>
</body>
</html>
