<!--SIDE DRAWER NAVIGATION-->
<div class='nav-wrapper'>
    <!-- Sidebar -->
    <nav id='sidebar'>

      <!-- Toggle Menu Bars -->
      <a id='sidebar-collapse' class='pull-right'><i class='fas fa-chevron-circle-left'></i></a>

      <!-- edesk logo -->
      <div class='sidebar-header'>
         <img src='https://s3.us-east-2.amazonaws.com/elasticbeanstalk-us-east-2-899413643241/resources/images/edesk_logo_white.png' id='edesk-logo'>
         <img src='https://s3.us-east-2.amazonaws.com/elasticbeanstalk-us-east-2-899413643241/resources/images/edesk_e_icon.png' id='edesk-logo-e'>
         <div class='search-site-div'>
            <span class='fa fa-search'></span>
            <input type='text' id='search-site' placeholder='search...'>
         </div>
      </div>

      <ul class='components'>
         <li>
            <a href='{{ URL::to('dashboard') }}'><i class="fas fa-tachometer-alt"></i> &nbsp; Dashboard</a>
         </li>
         <li>
            <a href='#submenu-contacts' data-toggle='collapse' data-target='#submenu-contacts' aria-expanded='false' class='dropdown-toggle'><i class="fas fa-users"></i> &nbsp;Contacts</a>
            <ul class='collapse components' id='submenu-contacts'>
               <li><a href='{{ route('contacts.leads') }}'>Leads</a></li>
               <li><a href='{{ route('contacts.opportunities') }}'>Opportunities</a></li>
               <li><a href='{{ route('contacts.customers') }}'>Customers</a></li>
               <li><a href='{{ route('contacts.index') }}'>Contact Management</a></li>
                <li><a href='{{ route('contacts.archived') }}'>Archive</a></li>
            </ul>
         </li>
         <li>
            <a href='#submenu-scheduling' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'><i class="far fa-calendar-alt"></i> &nbsp; Scheduling</a>
            <ul class='collapse components' id='submenu-scheduling'>
               <li><a href='#'>Booking</a></li>
               <li><a href='#'>Calendar</a></li>
               <li><a href='#'>Maps & Routes</a></li>
            </ul>
         </li>
         <li>
            <a href='#submenu-sales' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'><i class="fas fa-chart-bar"></i> &nbsp; Sales</a>
            <ul class='collapse components' id='submenu-sales'>
               <li><a href='#'>Estimates</a></li>
               <li><a href='#'>Invoices</a></li>
               <li><a href='#'>Orders</a></li>
               <li><a href='#'>Products</a></li>
               <li><a href='#'>Services</a></li>
            </ul>
         </li>
         <li>
            <a href='#submenu-reports' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'><i class="fas fa-chart-line"></i> &nbsp; Reports</a>
            <ul class='collapse components' id='submenu-reports'>
               <li><a href='#'>Revenue</a></li>
               <li><a href='#'>Marketing ROI</a></li>
               <li><a href='#'>Sales</a></li>
               <li><a href='#'>Tracking</a></li>
            </ul>
         </li>
         <li>
            <a href='#submenu-marketing' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'><i class="fas fa-magic"></i> &nbsp; Marketing</a>
            <ul class='collapse components' id='submenu-marketing'>
               <li><a href='#'>Ad Spend</a></li>
               <li><a href='#'>Analytics</a></li>
               <li><a href='#'>Email Automation</a></li>
               <li><a href='#'>Segments</a></li>
            </ul>
         </li>

        @if (in_array(Auth::user()->type_user_id, [1,2]))

            <li>
                <a href='#submenu-admin' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'><i class='fas fa-cogs'></i>&nbsp; Admin</a>
                <ul class='collapse components' id='submenu-admin'>
                <li><a href='#'>App Settings</a></li>
                <li><a href='#'>Company Profile</a></li>
                <li><a href='#'>API Documentation</a></li>
                <li><a href='#'>Help Center</a></li>
                <li><a href='#'>Import/Export</a></li>
                <li><a href='#'>Integrations</a></li>
                <li><a href='{{ route('notifications.index') }}'>Notification Settings</a></li>
                <li><a href='{{ route('users.index') }}'>User Management</a></li>
                <li><a href='#'>Webhooks</a></li>
                </ul>
            </li>

        @endif

         <li>
            <a href='#submenu-contact' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'><i class='fas fa-phone-volume'></i> &nbsp; Contact</a>
            <ul class='collapse components' id='submenu-contact'>
               <li><a href='#'>Customer Service</a></li>
               <li><a href='#'>Technical Support</a></li>
            </ul>
         </li>

          @if (Auth::user()->type_user_id == 1)

              <li>
                  <a href='#submenu-superuser' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'><i class='fab fa-superpowers'></i> &nbsp; SuperUser</a>
                  <ul class='collapse components' id='submenu-superuser'>
                      <li><a href='{{ route('companies.index') }}'>Companies</a></li>
                  </ul>
              </li>

          @endif

      </ul>
   </nav>

   <!-- TOP NAVIGATION-->
   <div class='container-fluid' id='top-nav'>
      <div class='row'>
         <div class='col-xl'>
            <nav class='navbar navbar-expand-md navbar-light'>
               <div class='collapse navbar-collapse'>

                  <!-- Left Side Of Navbar -->
                   <ul class='navbar-nav mr-auto'><h5 class='text-primary'>{{ Auth::user()->company->name  }}</h5></ul>

                  <!-- Right Side Of Navbar -->
                  <ul class='navbar-nav ml-auto'>
                     <li><a href='#'><i class='fas fa-question-circle' title='Help' data-toggle='tooltip' data-placement='bottom'></i></a></li>
                     <li><a href='#'><i class='fas fa-bell' title='Notifications' data-toggle='tooltip' data-placement='bottom'></i></a></li>
                     <li><a href='#'><i class='fas fa-envelope' title='Messages' data-toggle='tooltip' data-placement='bottom'></i></a></li>

                     <li class='dropdown'>
                        <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><i class="fas fa-user-circle"></i> &nbsp;{{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <span class="caret"></span></a>
                        <ul class='dropdown-menu dropdown-menu-right'>
                           <li><a class='dropdown-item' href="{{ URL::to('/users/' . Auth::user()->id . '/profile') }}"><i class='fas fa-user'></i> &nbsp; My Profile</a></li>
                           <li><a class='dropdown-item' href="{{ URL::to('/users/' . Auth::user()->id . '/settings') }}"><i class='fas fa-user-cog'></i> &nbsp; Settings</a></li>
                           <li>
                              <a class='dropdown-item' href="{{ route('logout') }}" onclick="event.preventDefault(); $('#logout-form').submit();">
                                 <i class='fas fa-sign-out-alt'></i> &nbsp; {{ __('Logout') }}
                              </a>
                              <form id='logout-form' action="{{ route('logout') }}" method='POST' style='display: none;'>
                              @csrf
                              </form>
                           </li>
                        </ul>
                     </li>
                  </ul>
               </div>
            </nav>
         </div>
      </div>
   </div>
</div>



