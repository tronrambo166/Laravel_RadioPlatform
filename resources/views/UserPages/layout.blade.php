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
   
{{-- Vue component files --}}
<script src="https://unpkg.com/vue"></script>
<script src="https://unpkg.com/http-vue-loader"></script>
  {{-- Vue component files --}}

  <style type="text/css">
      .#col-form-label{text-align: left; font-size: 12px; font-family: lato;}
      .#login,#register,#user,#artist,#user_log,#artist_log{ font-family: lato;}

  </style>
  
</head>


<body>
<div class="container-fluid" style="background: #161616; color:white;">
    
    
       
  <div class="row  pt-2 pb-3" style="background:black;">
<nav class=" navbar navbar-expand-md navbar-light py-0 w-100">
  
  <div class="  navbar-collapse" id="navbarNav">
    <ul class="navbar-nav links">
      <li class="nav-item text-responsive  text-light  mr-md-5 sm-f30">
      <a href="{{route('static20')}}">
          <h3 class="text-success font-weight-bold"> <img style="width:142px; height:55px;" src="images/logo.png"></h3>
      </a>
      
      </li>

      <li class="nav-item ">
        <a class="{{ Request::is('static20') ? 'text-success' : 'text-light' }} nav-link  font-weight-bold" href="static20">Home </a>
       
      </li>

      <li class="nav-item ">
         <a class="{{ Request::is('live') ? 'text-success' : 'text-light' }} nav-link  font-weight-bold" href="live">Live</a>
      </li>

      <li class="nav-item">
        <a class="{{ Request::is('artists') ? 'text-success' : 'text-light' }} nav-link   font-weight-bold" href="artists">Artists</a>
      </li>
    
     

    
      

    </ul>

    @if(Session::has('Userlogged'))
    <ul class="ml-auto pr-2">
       <li class="nav-item text-responsive  text-light  mr-md-5 sm-f30">
        Welcome, User
      </li>

      <li class="nav-item">
        <a class="nav-link  text-light" href="{{route('logout')}}">Logout</a>
      </li>

    </ul>

@else
<ul class="ml-auto pr-2"> 

<!--     
        
<div id="artist_log" class="card-body text-center py-0">

  <div class="d-inline">
      <input checked onchange="artist_log();"  type="radio" name="type" value="artist">
                                            <span class="small text-light ml-1">Artist</span> 
                                            <input onchange="user_log();"  class="ml-2" type="radio" name="type" value="user">
                                              <span class="small text-light ml-1 mr-2">User</span> 
                                                </div>

                          <form method="POST" class="d-inline form-inline" action="{{ route('login') }}">
                           @csrf

                                            <input class=" d-inline  form-control my-1 px-2 py-1 mr-1" type="email" name="email" placeholder="Enter email" id="inputEmailAddress" 
                                            value=""    />
                                                                       
                                          
                                            <input class=" d-inline  form-control my-1 px-2 py-1 mr-1" name="password" id="inputPassword" type="password" placeholder="Enter password"
                                            value=""  />
                                            

                                          

                                          @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                           @enderror

                                       
                                           
                                            @if (Route::has('forgetPass')) 
                                            <a href="{{ route('password.request') }}" class="small text">Forgot password ?</a> @endif
                                            
                                            <input  type="submit"class="  btn btn-outline-success d-inline-block font-weight-bold " href="" name="Log In" value="Login" />
                    </form>

                  

                    
                    @if(Session::has('reset'))<p class="text-light font-weight-bold">{{Session::get('reset')}}   @php Session::forget('reset'); @endphp </p>@endif
                    

                   @if(Session::has('login_err')) <p class="text-danger">{{Session::get('login_err')}}   @php Session::forget('login_err'); @endphp </p>  @endif
                        
                        <div class="row">
                              <div class="col-sm-7 pr-1">
                    <a href="{{ route('forgot','email') }}" class=" text-responsive font-weight-bold text-info d-inline-block py-0 small">Forgot Password?</a>
                    </div>
                    
                     <div class="col-sm-5 pl-1">
                    <p class=" small py-0 text-success d-inline  text-responsive">Don't have an account? <a href="{{ route('register') }}" class=" text-responsive font-weight-bold text-danger d-inline-block py-0"> Register</a></p>
                    </div>
                    
                    </div>
                    

                </div>


                 HIDDEN USER LOG 


<div id="user_log" class="collapse card-body text-center py-0">

   <div class="d-inline">
      <input  onchange="artist_log();"  type="radio" name="types" value="artist">
                                            <span class="small text-light ml-1">Artist</span> 
                                            <input checked onchange="user_log();"  class="ml-2" type="radio" name="types" value="user">
                                              <span class="small text-light ml-1 mr-2">User</span> 
                                                </div>
                    <form method="POST" class="d-inline form-inline" action="{{ route('Userlogin') }}">
                        @csrf

                                            <input class=" d-inline  form-control my-1 px-2 py-1 mr-1" type="email" name="email" placeholder="Enter email" id="inputEmailAddress" 
                                            value=""    />
                                                                       
                                          
                                            <input class=" d-inline  form-control my-1 px-2 py-1 mr-1" name="password" id="inputPassword" type="password" placeholder="Enter password"
                                            value=""  />
                                            

                                          

                                          @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                           @enderror

                                       
                                           
                                            @if (Route::has('forgetPass')) 
                                            <a href="{{ route('password.request') }}" class="text">Forgot password ?</a> @endif
                                            
                                            <input  type="submit"class="  btn btn-outline-success d-inline-block font-weight-bold " href="" name="Log In" value="Login" />
                    </form>
                    
                    @if(Session::has('reset'))<p class="text-light font-weight-bold">{{Session::get('reset')}}  </p>
                      @php Session::forget('reset'); @endphp @endif
                    

                   @if(Session::has('login_err'))
                    <p class="text-danger ">{{Session::get('login_err')}}</p>@php Session::forget('login_err'); 
                    @endphp @endif
                        
                        <div class="row">
                              <div class="col-sm-7 pr-1">
                    <a href="{{ route('forgot','email') }}" class=" text-responsive font-weight-bold text-info d-inline-block py-0 small">Forgot Password?</a>
                    </div>
                    
                     <div class="col-sm-5 pl-1">
                    <p class="small py-0 text-success d-inline  text-responsive">Don't have an account? <a href="{{ route('register') }}" class=" text-responsive font-weight-bold text-danger d-inline-block py-0"> Register</a></p>
                    </div>
                    
                    </div>
                    

                </div>


                 HIDDEN USER LOG 
-->

 
 
   <li class="nav-item">
        <a href=""class="nav-link  text-light" data-target="#loginModal" data-toggle="modal"> Login</a>
      </li>
</ul>

 @endif



  </div>
</nav>
</div>


    @yield('content')


<div class="container-fluid px-0 ">
       
        
        <footer>
            <div class="row fix fixed-bottom" style="background:black;">
			 <div class="col-sm-7 text-right" >
                <p class="text-light  text-light py-3 text-responsive small">&copy; Copyright 2022. Rewind Cloud Radio Monitoring, All Rights Reserved</p>
            </div>  <div class="col-sm-1" > </div>
			 <div class="col-sm-4 m-auto" >
			 <a class="ml-5 text-success nav-link d-inline font-weight-bold" href="terms">Terms</a>
			 <a class="text-success nav-link d-inline font-weight-bold" href="policy">Privacy Policy</a>
			</div>
        </footer>
        
    </div>
    </div>



  <!-- Hidden Login Modal -->
  <!-- Hidden Login Modal -->
  <!-- Hidden Login Modal -->
  
  <div  class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

         <div class="card-header w-100">
            <button id="login" onclick="login()" class="w-25 btn   px-4 mr-2">{{ __('Log In') }}</button>
            <button  id="register" onclick="register()" class="w-25 btn  px-4">{{ __('Register') }}</button>

             @if(Session::has('email')) <p class="text-danger ml-5">{{Session::get('email')}} @php Session::forget('email'); @endphp </p> @endif
        </div>

              

        <button type="button" class="m-0 close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    
    
      <div class="modal-body">

         

        
      <div class="hidden_currency ">

    <div class="row justify-content-center py-3 mb-5">
        <div class="px-0 w-100 py-2">
            <div class="card collapse" id="all_registers">

            <div class=" mt-2 text-center User-Artist-Select">
            <div class="col-md-5"></div>                
            
            <button  id="user"onclick="user()" class="w-75 btn btn-light font-weight-bold px-3 mr-2">{{ __('User') }}</button> <br><br>
            <button  id="artist" onclick="artist()" class="font-weight-bold w-75 btn btn-light text-warning px-3 mr-2">{{ __("Artist's Sign Up Request") }}</button>

            <button  id="business" onclick="business()" class="mt-2 font-weight-bold w-75 btn btn-light text-danger px-3 mr-2">{{ __("Business Sign Up") }}</button>

                                          </div>
               

               <!-- HIDDEN Artist REG -->

                <div id="artist_reg" class="card-body">
                    <form method="POST" action="{{ route('registerP') }}" enctype="multipart/form-data">
                        @csrf


                        


                    <!--    <div class="row mb-3">
                            <label for="appId" class="col-md-4 col-form-label text-md-left">{{ __('Artist Id') }} 
                            <span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="appId" type="text" class="form-control @error('appId') is-invalid @enderror" name="art_id" value="{{ old('appId') }}" required autocomplete="appId">

                                @error('appId')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> -->


                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('First Name') }} <span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="fname" value="{{ old('fname') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('Last Name') }} <span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="lname" value="{{ old('fname') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('Stage Name') }} <span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="stage_name" value="{{ old('fname') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-left">{{ __('E-Mail') }} <span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-left">{{ __('Telephone') }} <span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="phone" type="number" class="form-control @error('email') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>





                        <div class="row mb-4">
                            <div class="col-md-12 ">
                                <button type="submit" class="mt-3 w-25 d-block mx-auto btn btn-outline-success">
                                    {{ __('Register') }}
                                </button>
                            </div>
                            </div> <hr>

                              <div class="row mb-0">
                            <div class="col-md-12">
                                <a href="{{route('login')}}" class=" w-25 d-block mx-auto btn btn-outline-danger">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                            
                        </div>
                    </form>

                </div>
                <!-- HIDDEN Artist REG -->




                <!-- HIDDEN USER REG -->

                           <div id="user_reg" class=" collapse card-body">
                    <form method="POST" action="{{ route('user_reg') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-left">{{ __( 'Name') }} <span  class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

           


                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-left">{{ __('E-Mail') }} <span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-left">{{ __('Password') }} <span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        
                         <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-left">{{ __('Confirm Password') }}<span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="c_password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        

                       



                        <div class="row mb-4">
                            <div class="col-md-12 ">
                                <button type="submit" class="w-25 d-block mx-auto btn btn-outline-success">
                                    {{ __('Register') }}
                                </button>
                            </div>
                            </div> <hr>

                              <div class="row mb-0">
                            <div class="col-md-12">
                                <a href="{{route('login')}}" class=" w-25 d-block mx-auto btn btn-outline-danger">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                            
                        </div>
                    </form>

                </div>

                <!-- HIDDEN USER REG -->


                <!-- HIDDEN Business REG -->

                <div id="business_reg" class=" collapse card-body">
                    <form method="POST" action="{{ route('registerB') }}" enctype="multipart/form-data">
                        @csrf    
                         

                         <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('Business Name') }} <span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="stage_name" value="{{ old('fname') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-left">{{ __('E-Mail') }} <span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-left">{{ __('Password') }} <span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-left">{{ __('Telephone') }} <span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="phone" type="number" class="form-control @error('email') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-left">{{ __('Image') }} <span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="file" type="file" class="form-control @error('email') is-invalid @enderror" name="image" autocomplete="phone">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>





                        <div class="row mb-4">
                            <div class="col-md-12 ">
                                <button type="submit" class="mt-3 w-25 d-block mx-auto btn btn-outline-success">
                                    {{ __('Register') }}
                                </button>
                            </div>
                            </div> <hr>

                              <div class="row mb-0">
                            <div class="col-md-12">
                                <a href="{{route('login')}}" class=" w-25 d-block mx-auto btn btn-outline-danger">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                            
                        </div>
                    </form>

                </div>
                <!-- HIDDEN Business REG -->


                </div>
                 <!-- HIDDEN USER REG Card ends-->




                <!-- HIDDEN login-->
                <!-- HIDDEN login-->
                <!-- HIDDEN login-->

  <div class="card" id="all_logins">

     <div class=" my-3 text-center User-Artist-Select">
            <div class="col-md-5"></div>                
            <button  id="art_log" onclick="artist_log()" class="w-25 btn btn-success px-3 mr-2">{{ __('Artist') }}</button>
            <button  id="usr_log"onclick="user_log()" class="w-25 btn btn-light px-3 mr-2">{{ __('User') }}</button>
                                          </div>

 <div id="artist_log" class="card-body text-center py-0">

                          <form method="POST" class="" action="{{ route('loginP') }}">
                           @csrf

                                            <input class=" w-75 d-inline my-2 form-control my-1 px-2 py-1 mr-1" type="email" name="email" placeholder="Enter email" id="inputEmailAddress" 
                                            value=""    />
                                                                       
                                          
                                            <input class=" w-75 d-inline my-2 form-control my-1 px-2 py-1 mr-1" name="password" id="inputPassword" type="password" placeholder="Enter password"
                                            value=""  />
                                            

                                          

                                          @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                           @enderror

                                       
                                           
                                            @if (Route::has('forgetPass')) 
                                            <a href="{{ route('password.request') }}" class="small text">Forgot password ?</a> @endif
                                            
                                            <input  type="submit"class=" d-block w-25 mx-auto my-2 btn btn-outline-success  font-weight-bold " href="" name="Log In" value="Login" />
                    </form>

                    
                    @if(Session::has('reset'))<p class="text-light font-weight-bold">{{Session::get('reset')}}   @php Session::forget('reset'); @endphp </p>@endif
                    

                   @if(Session::has('login_err'))
                   <div class="alert alert-danger" role="alert">
                                  <p class="">{{Session::get('login_err')}}   @php Session::forget('login_err'); @endphp </p> 

                                 </div>  @endif
                   
                        
                       <hr>  <div class="row">
                              <div class="col-sm-12 pr-1">
                    <a href="{{ route('forgot','email') }}" class=" text-responsive font-weight-bold text-info mx-auto my-2 d-inline-block py-0 small">Forgot Password?</a>
                    </div>
                  
                    
                    </div>
                    

                </div>




  <!-- HIDDEN USER LOG -->
<div id="user_log" class="collapse card-body text-center py-0">

                    <form method="POST" class="d-inline form-inline" action="{{ route('Userlogin') }}">
                        @csrf

                                        
                                            <input class=" w-75 d-inline my-2 form-control my-1 px-2 py-1 mr-1" type="email" name="email" placeholder="Enter email" id="inputEmailAddress" 
                                            value=""    />
                                                                       
                                          
                                            <input class=" w-75 d-inline my-2 form-control my-1 px-2 py-1 mr-1" name="password" id="inputPassword" type="password" placeholder="Enter password"
                                            value=""  />
                                            

                                          

                                          @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                           @enderror

                                       
                                           
                                            @if (Route::has('forgetPass')) 
                                            <a href="{{ route('password.request') }}" class="small text">Forgot password ?</a> @endif
                                            
                                            <input  type="submit"class=" d-block w-25 mx-auto my-2 btn btn-outline-success  font-weight-bold " href="" name="Log In" value="Login" />
                    </form>
                    
                    @if(Session::has('reset'))<p class="text-light font-weight-bold">{{Session::get('reset')}}  </p>
                      @php Session::forget('reset'); @endphp @endif
                    

                   @if(Session::has('login_err'))
                    <p class="text-danger ">{{Session::get('login_err')}}</p>@php Session::forget('login_err'); 
                    @endphp @endif
                        
                     <hr>   <div class="row">
                              <div class="col-sm-12 pr-1">
                    <a href="{{ route('forgot','email') }}" class=" text-responsive font-weight-bold text-info mx-auto my-2 d-inline-block py-0 small">Forgot Password?</a>
                    </div>
                  
                    
                    </div>

                </div>

            </div>
        </div>
    </div>
  
  </div>
    
    
      </div>
    
    
     
    </div>
  </div>
</div>
  
  
  
  <!-- Hidden login Modal -->
  
    
    
    


<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
       
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    




<script type="text/javascript" src="rank.js"></script>


<script type="text/javascript">
    $('#login').css('border-bottom', '2px solid red');
    $('#business_reg').hide();
    
    function login(){
    $('#register').css('border-bottom', 'none');    
    $('#login').css('border-bottom', '2px solid red');

    $('#all_logins').show();
    $('#all_registers').hide();
    }

     function register(){ 
    $('#login').css('border-bottom', 'none');
    $('#register').css('border-bottom', '2px solid red');

   $('#all_logins').hide();
    $('#all_registers').show();
    
    }


</script>


<script type="text/javascript">
    function user_log(){
    $('#art_log').removeClass('btn-success');
    $('#usr_log').removeClass('btn-light');
    $('#usr_log').addClass('btn-success');

    $('#user_log').show();
    $('#artist_log').hide();
    }

     function artist_log(){ 
    $('#usr_log').removeClass('btn-success');
    $('#art_log').removeClass('btn-light');
    $('#art_log').addClass('btn-success');

    $('#artist_log').show();
    $('#user_log').hide();
    
    }


</script>


<script type="text/javascript">
    $('#artist_reg').hide();
    function user(){
    $('#artist').removeClass('btn-success');
    $('#user').removeClass('btn-light');
    $('#business').removeClass('btn-success');
    $('#user').addClass('btn-success');

    $('#user_reg').show();
    $('#artist_reg').hide();
     $('#business_reg').hide();
    }

     function artist(){
    $('#user').removeClass('btn-success');
    $('#artist').removeClass('btn-light');
     $('#business').removeClass('btn-success');
    $('#artist').addClass('btn-success');

    $('#user_reg').hide();
    $('#artist_reg').show();
     $('#business_reg').hide();
    
    }

     function business(){
    $('#user').removeClass('btn-success');
    $('#artist').removeClass('btn-success');
    $('#business').removeClass('btn-light');
    $('#business').addClass('btn-success');

    $('#user_reg').hide();
    $('#artist_reg').hide();
    $('#business_reg').show();
    
    }



</script>


</body>
</html>
