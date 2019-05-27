<div class='container-fluid nav-web'>
   <div class='row'>
      <div class='col-xl'>
         <nav class='navbar navbar-expand-md navbar-light'>
            <div class='collapse navbar-collapse'>

               <!-- Left Side Of Navbar -->
               <ul class='navbar-nav mr-auto'><img src='{{ asset('storage/images/edesk_logo_nav.png') }}' class='edesk-logo'></ul>

               <!-- Right Side Of Navbar -->
               <ul class='navbar-nav ml-auto'>

                  @if (Route::has('login'))

                     @auth

                        <li><a href="{{ url('/') }}"><i class="fas fa-home"></i> &nbsp; Home</a></li>

                     @else

                        <a href="{{ route('register') }}" class='nav-web-links'>Register &nbsp; <i class="fas fa-user-plus"></i></a>
                        <a href="{{ route('login') }}" class='nav-web-links'>Login &nbsp; <i class="fas fa-sign-in-alt"></i></a>

                     @endauth

                  @endif
               </ul>
            </div>
         </nav>
      </div>
   </div>
</div>