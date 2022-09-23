 
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
                    <form method="POST" class="form-inline" action="{{ route('loginP') }}">
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
                    <p class=" py-0 text-success d-inline">don't have an account? <a href="{{ route('register') }}" class="font-weight-bold text-danger d-inline-block py-0"> Register</a></p>

                </div>

    </ul>

  </div>
</nav>
</div>


    <div class="row justify-content-center py-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }} @if(Session::has('email')) <p class="text-danger ml-5">{{Session::get('email')}}</p> @endif</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('registerP') }}" enctype="multipart/form-data">
                        @csrf


                        <div class="row mb-3">
                            <label for="appId" class="col-md-4 col-form-label text-md-right">{{ __('Artist Id') }}</label>

                            <div class="col-md-6">
                                <input id="appId" type="text" class="form-control @error('appId') is-invalid @enderror" name="art_id" value="{{ old('appId') }}" required autocomplete="appId">

                                @error('appId')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

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
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

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
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Stage Name') }}</label>

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
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

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
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

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
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Short Bio') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="text" class="form-control" name="bio" required autocomplete="new-password">
                            </div>
                        </div>




                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
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
    

{{-- Vue files --}}
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.23.0/axios.min.js"></script>

<script type="text/javascript" src="js/vue-router.js"></script>
<script type="module" src="js/routerCode.js"></script>
{{-- Vue files --}}


<script>


</script>



</body>
</html>
