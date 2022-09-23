@extends('UserPages.layout')  
@section('content')


  <h3 class="text-center">Contact</h3> <hr>
<div class="row mx-auto" style="width:90%; background:#161616; min-height: 500px" >   


  <!-- HIDDEN USER REG -->

                    <div id="user_reg" class=" w-75 mx-auto card-body" style=" background:#161616;" >
                    <form method="POST" action="{{ route('sendEmail') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __( 'Artist Name') }} <span  class="text-danger"></span></label>

                            <div class="col-md-6">
                                <input readonly id="name" type="text" class="form-control" name="name" value="{{$artist_contact->fname. ' '.$artist_contact->lname}}" >

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

        <input readonly hidden type="text"  name="userName" value="{{$userEmail->name}}" >



                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('To') }} <span title="Required" class="text-danger"></span></label>

                            <div class="col-md-6">
                                <input readonly id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="toEmail" value="{{$artist_contact->email}}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('From') }} <span title="Required" class="text-danger"></span></label>

                            <div class="col-md-6">
                                <input readonly id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="fromEmail" value="{{$userEmail->email}}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                       
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Message') }} <span title="Required" class="text-danger"></span></label>

                            <div class="col-md-6">
                                <textarea  id="message" type="text" class="form-control @error('email') is-invalid @enderror" name="message"  required > </textarea>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> 

                       



                        <div class="row mb-0">
                           
                                <button type="submit" class="w-25 mx-auto mt-3 font-weight-bold rounds  btn btn-outline-success">
                                    {{ __('Send') }}
                                </button>
                            
                        </div>

                    </form>

                </div>

                </div>
                <!-- HIDDEN USER REG -->


           

        


<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>







          @endsection
        
       

