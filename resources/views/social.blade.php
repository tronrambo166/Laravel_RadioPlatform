@extends('layout') 
@section('page')



<div class="row my-4 text-light mx-auto" style="width:90%; background:#161616;">    
         
         <div class="col-md-3">      <h3 class="text-center my-5">Edit Your Bio</h3> <hr> 

      <div class="text-center">
          <img style="max-width: 150px;border-radius: 10%;" class=" img-fluid" src="images/artists/{{$thisUser->image}}">
      </div> 

         </div>

   <div class="col-md-9 justify-content-center py-3" >
        <div class="">
            <div class="card"  style=" background:#161616;">
                

                <div class="card-body">
                    <form method="POST" action="{{ route('updateBio') }}" enctype="multipart/form-data">
                        @csrf


                        <div class="row mb-3">
                            <label for="appId" class="col-md-4 col-form-label text-md-right">{{ __('Artist Id') }}</label>

                            <div class="col-md-6">
                                <input id="appId" type="text" class="form-control @error('appId') is-invalid @enderror" name="art_id" value="{{ $thisUser->art_id }}" required autocomplete="appId">

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
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="fname" value="{{ $thisUser->fname }}" required autocomplete="name" autofocus>

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
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="lname" value="{{ $thisUser->lname }}" required autocomplete="name" autofocus>

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
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="stage_name" value="{{ $thisUser->stage_name }}" required autocomplete="name" autofocus>

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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" readonly name="email" value="{{ $thisUser->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Short Bio') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="text" class="form-control" name="bio" required autocomplete="new-password" value="{{$thisUser->bio}}">
                            </div>
                        </div>


                         <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Change Image') }}</label>

                            <div class="col-md-6">
                                <input type="file" class="form-control" name="image"  >
                            </div>
                        </div>



                        <div class="row mb-4">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="text-dark btn btn-success">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

            
</div>



          @endsection
        
       

