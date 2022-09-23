

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Artist Sign Up</title>
        <link href="css/styles.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    </head>
	
	
    <body style="background:azure;">
	
	
	
	<?php  
	

	
	if(isset($_POST['email_ck'])){
		
		$email=$_POST['email'];
		$_SESSION['mail']=$email;
		
		$sel=" Select * from visitors where Email='$email'"; $run=$db->select($sel);
        if($run->num_rows > 0) $forgot="Something";		
		
	}
	
	if(isset($_POST['reset'])){
		
		$password=$_POST['password'];
		$c_password=$_POST['c_password'];
	
	    $email=$_SESSION['mail'];
		
		if($password==$c_password){
		$sel=" Update visitors set Password='$password' where Email='$email'"; $run=$db->select($sel);

        if($run==true) { $_SESSION['reset']="Password Reset Successfull !";	
		header('location:login.php'); exit;  }
		
		}
		
		else{ $_SESSION['unmatched']="Password doesn't match !"; $forgot="Something";	}
		
		
    	
		
	}
	
	
	
	
	?>
	
	
	
	
	
	
	
	
	
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container ">
                        <p class="text-danger">@if(Session::has('login_err')){{Session::get('login_err')}}   @php Session::forget('login_err'); @endphp @endif</p>
                        
                        <div class="row justify-content-center">
                        	<h4 class="my-3 text-success font-weight-bold text-center">Private Artist Registration Page</h4>
				
						 <div id="artist_reg" class="card-body w-75 m-auto bg-light px-5 my-4">

                    <form method="POST" action="{{ route('registerP') }}" enctype="multipart/form-data">
                        @csrf


                        


                      <div class="row mb-3">
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
                        </div> 


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
                        
                        
                       <!--   <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-left">{{ __('Confirm Password') }}<span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="c_password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> -->
                        


                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-left">{{ __('Location') }} <span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-3 ">
                                <input id="location" type="text" class="form-control" name="country" required placeholder ="Country">
                            </div>

                          

                             <div class="col-md-3 ">
                                <input id="location" type="text" class="form-control" name="city" required placeholder ="City">
                            </div>
                        </div>
                        

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-left">{{ __('Short Bio') }} <span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="text" class="form-control" name="bio" required autocomplete="new-password">
                            </div>
                        </div>


                         <div class="row mb-3">
                             <label for="password-confirm" class="col-md-4 col-form-label text-md-left">{{ __('Image') }} <span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input required="" type="file" class="form-control" name="image"  >
                            </div>
                        </div>



                        <div class="row mb-4 pb-4">
                            <div class="col-md-12 ">
                                <button type="submit" class="mt-3 w-25 d-block mx-auto btn btn-outline-success">
                                    {{ __('Register') }}
                                </button>
                            </div>
                            </div> <hr>

                            
                    </form>

                </div>
                         

                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto fixed-bottom mt-4">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; 2022. Rewind Cloud Radio Monitoring, All Rights Reserved</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	
		<script src="js/scripts.js"></script>
    </body>
</html>
