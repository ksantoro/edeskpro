<!--BREADCRUMBS-->
<div class='container-fluid' id='top-nav'>
   <div class='row'>
      <div class='col-xl'>
         <nav aria-label='breadcrumb' id='breadcrumb-container'>
            <ol class='breadcrumb'>
               <li class='breadcrumb-item'><i class="fas fa-home"></i> &nbsp; Home</li>
               @if (count($breadcrumbs))

                  @foreach ($breadcrumbs as $breadcrumb)

                     @if ($breadcrumb->url && ! $loop->last)
                        <li class='breadcrumb-item'><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                     @else
                        <li class='breadcrumb-item active'>{{ $breadcrumb->title }}</li>
                     @endif

                  @endforeach

               @endif
            </ol>
         </nav>
      </div>
   </div>
</div>