@php
use App\Models\User;
$user=DB::table('users')->where('email',Session::get('logged'))->first();
$stage_name=$user->stage_name;       
@endphp

<!DOCTYPE HTML>
<head>
    <title>Test Website</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
     <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	
    <link rel="stylesheet" type="text/css" href="style.css">
   
{{-- Vue component files --}}
<script src="https://unpkg.com/vue"></script>
<script src="https://unpkg.com/http-vue-loader"></script>
  {{-- Vue component files --}}
  
</head>
<body>
<div class="container-fluid" style="background: #CFD8C7;">
    
    
       
  <div class="row bg-dark ">
<nav class=" navbar navbar-expand-lg navbar-light w-100">
  
  <div class=" collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav links">
      <li class="nav-item h4  text-light  mr-5">
        Welkom {{$stage_name}}
      </li>

      <li class="nav-item ">
        <a class="nav-link text-light" href="home">Home </a>
      </li>
      <li class="nav-item">
        <a class="nav-link  text-light" href="radio">Radio Tv</a>
      </li>
    
      <li class="nav-item">
        <a class="nav-link  text-light" href="breakdown">Breakdown</a>
      </li>

        <li class="nav-item">
        <a class="nav-link  text-light" href="social">My Bio</a>
      </li>

      <li class="nav-item">
        <a class="nav-link  text-light" href="about">About</a>
      </li>

    </ul>

<ul class="ml-auto"><li class="nav-item">
        <a class="nav-link  text-light" href="{{route('logout')}}">Logout</a>
      </li></ul>

  </div>
</nav>
</div>


    @yield('page')


<div class="container-fluid px-0 ">
       
        
        <footer>
            <div class="row fix bg-dark fixed-bottom">
                <p class="m-auto font-italic text-light py-3">&copy; Copyright 2022. Rewind Cloud Radio, All Rights Reserved</p>
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
