@php 
use App\Models\User;
$user=DB::table('users')->where('email',Session::get('logged'))->first();
$stage_name=$user->fname;       
@endphp

<!DOCTYPE HTML> 
<head>
     <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <title>Rewind</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
     <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="calander/6-calendar.css">
   
{{-- Vue component files 
<script src="https://unpkg.com/vue"></script>
<script src="https://unpkg.com/http-vue-loader"></script>
   Vue component files --}}

<style type="text/css">
  .links li a{font-size: 13px;}
</style>

  
</head>
<body>
<div class="container-fluid" style="background:  #161616;">
    
    
       
  <div class="row pt-2 pb-3" style="background:black;">
<nav class=" navbar navbar-expand-md navbar-light py-0 w-100">
  
  <div class="  navbar-collapse" id="navbarNav">
    <ul class="navbar-nav links"> 
      <li class="nav-item text-responsive  text-light  mr-md-5 sm-f30">
         <a href="{{route('home')}}">
        <img style="width:142px; height:55px;" src="images/logo.png">
      </a>
        
      </li>

      <li class="nav-item ">
      <a style="color: #e9e3e3;" class="nav-link   {{ Request::is('home') ? 'text-success' : '' }}" href="home">Home </a>
      </li>
      <li class="nav-item">
        <a style="color: #e9e3e3;"class="nav-link  {{ Request::is('radio') ? 'text-success' : '' }}" href="radio">Live</a>
      </li>
    
      <li class="nav-item">
        <a style="color: #e9e3e3;"class="nav-link  {{ Request::is('breakdown') ? 'text-success' : '' }}" href="breakdown">Breakdown</a>
      </li>

        <li class="nav-item">
        <a style="color: #e9e3e3;" class="nav-link px-0 {{ Request::is('bio') ? 'text-success' : '' }} text-responsive" href="bio">My Bio</a>
      </li>

      <li class="nav-item">
        <a style="color: #e9e3e3;" class="px-0  nav-link {{ Request::is('myMusic') ? 'text-success' : '' }} text-responsive" href="myMusic">My Music</a>
      </li>
      

        <li class="nav-item">
        <a style="color: #e9e3e3;"class="nav-link  {{ Request::is('schedules') ? 'text-success' : '' }}" href="schedules">My Calendar</a>
      </li>


        <li class="nav-item">
        <a style="color: #e9e3e3;"class="nav-link  {{ Request::is('streaming') ? 'text-success' : '' }}" href="streaming">Streaming</a>
      </li>


        <li class="nav-item">
        <a style="color: #e9e3e3;"class="nav-link  {{ Request::is('social') ? 'text-success' : '' }}" href="social">Social</a>
      </li>


        <li class="nav-item">
        <a style="color: #e9e3e3;"class="nav-link {{ Request::is('payout') ? 'text-success' : '' }}" href="payout">Payout</a>
      </li>

      <li class="nav-item">
        <a style="color: #e9e3e3;"class="nav-link {{ Request::is('about') ? 'text-success' : '' }} " href="about">About</a>
      </li>

    </ul>

<ul class="ml-auto pr-2"><li class="nav-item">
  <img style="max-width: 40px;min-height: 35px; border-radius: 50%;" class=" img-fluid d-inline" src="images/artists/{{$user->image}}"> <p class="d-inline text-light">  {{substr($stage_name,0,7)}} </p>
        <a style="color: #e9e3e3;"class="nav-link d-inline text-light " href="{{route('logoutA')}}">Logout</a>
      </li></ul>

  </div>
</nav>
</div>


    @yield('page')


<div class="container-fluid px-0 ">
       
        
        <footer>
            <div class="row fix  fixed-bottom" style="background:black;">
                <p class="m-auto font-italic text-light py-3 text-responsive small">&copy; Copyright 2022. Rewind Cloud Radio Monitoring, All Rights Reserved</p>
            </div>
        </footer>
        
    </div>
    </div>
    
    
    


<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
       
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    




<script type="text/javascript" src="rank.js"></script>




</body>
</html>
