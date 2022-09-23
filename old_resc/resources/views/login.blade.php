 
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
<body >
<div style="background: #CFD8C7;" class="container-fluid">
    
    
       
  <div class="row bg-dark ">
<nav class=" navbar navbar-expand-lg navbar-light w-100">
  
  <div class=" collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav links">
      <li class="nav-item h4  text-light  mr-5">
        Rewind
      </li>


    </ul>

<ul class="ml-auto links"><li class="nav-item">
        
<div class="card-body text-center py-0">
                    <form method="POST" class="form-inline" action="{{ route('login') }}">
                        @csrf


                                            
                                            <input class=" d-inline  form-control  px-2 py-1 mr-1" type="email" name="email" placeholder="Enter email" id="inputEmailAddress" 
                                            value=""    />
                                                                       
                                          
                                            <input class=" d-inline  form-control  px-2 py-1 mr-1" name="password" id="inputPassword" type="password" placeholder="Enter password"
                                            value=""  />
                                            

                                          

                                          @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                           @enderror

                                       
                                           
                                            @if (Route::has('forgetPass')) 
                                            <a href="{{ route('password.request') }}" class="text">Forgot password ?</a> @endif
                                            
                                            <input  type="submit"class="  btn btn-success text-dark d-inline-block font-weight-bold " href="" name="Log In" value="Login" />
                    </form>

                    <p class="text-danger">@if(Session::has('login_err')){{Session::get('login_err')}}   @php Session::forget('login_err'); @endphp @endif</p>

                    <p class=" py-0 text-success d-inline">don't have an account? <a href="{{ route('register') }}" class="font-weight-bold text-danger d-inline-block py-0"> Register</a></p>

                </div>

    </ul>

  </div>
</nav>
</div>


<div class="row " >  <h2 class="px-4 w-100 d-block py-4 text-center"> <span class="text-danger">Rewind</span> to Know Your Playback</h2> </div> <p id="rank"></p>

<div class="row " >  
         <div class="col-md-3"> 
            

             </div>  

         <div class="col-md-3"> </div>
           <div class="col-md-6 text-center">
             

             <img src="images/image.jpg" height="500px">

           </div>    
          
</div>


<div class="container-fluid px-0 ">
       
        
        <footer>
            <div class="row fix bg-dark">
                <p class="m-auto font-italic text-light py-3">&copy; Copyright 2020. Radio Monitoring, All Rights Reserved</p>
            </div>
        </footer>
        
    </div>
    </div>
    
    
    


<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
       
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
<script type="text/javascript" src="rank.js"></script>

<script>


</script>



</body>
</html>
