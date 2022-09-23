 
@extends('UserPages.layout')  
@section('content')
       


    <div class="row justify-content-center py-3 mb-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }} @if(Session::has('email')) <p class="text-danger ml-5">{{Session::get('email')}} @php Session::forget('email'); @endphp </p> @endif</div>

               <div class="row mt-2 text-center">
                            <div class="col-md-5"></div>

                           <input required="" checked onclick="artist();"type="radio" name="type" value="artist">
                                            <span class="small text-dark ml-1">Artist</span> 
                                            <input onclick="user();" required="" class="ml-4" type="radio" name="type" value="user">
                                              <span class="small text-dark ml-1 mr-2">User</span> 
                                          </div>


                <div id="artist_reg" class="card-body">
                    <form method="POST" action="{{ route('registerP') }}" enctype="multipart/form-data">
                        @csrf


                        


                        <div class="row mb-3">
                            <label for="appId" class="col-md-4 col-form-label text-md-right">{{ __('Artist Id') }} 
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
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }} <span title="Required" class="text-danger">*</span></label>

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
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }} <span title="Required" class="text-danger">*</span></label>

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
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Stage Name') }} <span title="Required" class="text-danger">*</span></label>

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
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }} <span title="Required" class="text-danger">*</span></label>

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
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }} <span title="Required" class="text-danger">*</span></label>

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
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }} <span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="c_password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        


                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Location') }} <span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-3">
                                <input id="location" type="text" class="form-control" name="country" required placeholder ="Enter Country">
                            </div>

                          

                             <div class="col-md-3">
                                <input id="location" type="text" class="form-control" name="city" required placeholder ="Enter City">
                            </div>
                        </div>
                        

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Short Bio') }} <span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="text" class="form-control" name="bio" required autocomplete="new-password">
                            </div>
                        </div>




                        <div class="row mb-0">
                            <div class="col-md-6 ">
                                <button type="submit" class="float-right btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                            
                            <div class="col-md-6">
                                <a href="{{route('login')}}" class=" w-25 d-block mx-auto btn btn-outline-warning">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                            
                        </div>
                    </form>

                </div>


                <!-- HIDDEN USER REG -->

                           <div id="user_reg" class=" collapse card-body">
                    <form method="POST" action="{{ route('user_reg') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __( 'Name') }} <span  class="text-danger">*</span></label>

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
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }} <span title="Required" class="text-danger">*</span></label>

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
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }} <span title="Required" class="text-danger">*</span></label>

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
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }} <span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="c_password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        

                       



                        <div class="row mb-0">
                            <div class="col-md-6 ">
                                <button type="submit" class="float-right btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                            
                            <div class="col-md-6">
                                <a href="{{route('login')}}" class=" w-25 d-block mx-auto btn btn-outline-warning">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                            
                        </div>
                    </form>

                </div>

                <!-- HIDDEN USER REG -->


            </div>
        </div>
    </div>

<script type="text/javascript">
    function user(){
    $('#user_reg').show();
    $('#artist_reg').hide();
    }

     function artist(){
    $('#user_reg').hide();
    $('#artist_reg').show();
    
    }


</script>

@endsection