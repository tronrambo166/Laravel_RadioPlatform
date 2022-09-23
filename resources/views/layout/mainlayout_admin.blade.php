@if(!Session::has('admin'))
        <script>window.location.href = "{{ route('loginA')}}";</script>
        @endif 

<!DOCTYPE html>
<html lang="en">
  <head>
    @include('layout.partials.head_admin')
  </head>

  <body>
  @if(!Route::is(['login','register','forgot-password','lock-screen','error-404','error-500']))
  
  @if(Session::has('admin'))
  @include('layout.partials.header_admin')
 <@include('layout.partials.nav_admin')
 @endif
 
 @endif
 @yield('content')
 @include('layout.partials.footer_admin-scripts')


  </body>
</html>