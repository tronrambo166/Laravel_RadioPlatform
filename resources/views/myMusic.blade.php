@extends('layout') 
@section('page')

@php use App\Models\User;
 $thisUser=User::where('email', Session::get('logged'))->first();
 $artist_id=$thisUser->id;
@endphp


<style type="text/css">
 .borders{border:none;}
 .borders td{font-size: 20px;}
 .borders: hover{background: #3a3838;}
.table td, .table th {
     border-top: none;}
     #login{border: 2px solid red;}
</style>

<div class="row mx-auto" style="width:90%; background:#161616;">  
         <div class="col-md-12"> 

            <h4 class="text-center mt-2 text-light">My Music</h4> <hr> 

            @if ($errors->any()) <div class="alert text-center alert-danger"> <ul>
            @foreach ($errors->all() as $error)  <li>{{ $error }}</li> @endforeach  </ul> </div><br />
                @endif

                 @if (Session::has('song')) 
                 <div class="alert text-center alert-success"> <ul>
                 <li>{{ Session::get('song') }} @php Session::forget('song'); @endphp</li>  </ul> </div> <br/>
                 @endif

             <button class=" mx-auto d-block mt-3 mb-4 p-2 w-25 font-weight-bold btn btn-outline-success" type="button" data-target="#musicModal" data-toggle="modal" aria-expanded="false" aria-controls="collapseExample">Upload Music</button>


             <p class="text-left py-3 my-0 bg-dark font-weight-bold text-success h5 pl-2">Recent Music

              <button class=" float-right btn py-0 text-primary" type="button" data-toggle="collapse" data-target="#musicDIv" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-2x fa-angle-down"></i></button></p> 

  <div id="musicDIv" class="show musics" style="max-height: 400px; overflow-y: scroll;">
  <table class="shadow mb-3 w-100  shadow border-none table tabil text-light" style="width:90%; background:#1e1e1e;">
  <thead>
    <tr class="  w-100">
       

      <th width="5%"> No</th>
      <th> Title</th>
      <th> Album</th>
      <th> Description</th>
     
      
    </tr>
  </thead>
  <tbody> @php $i=0; @endphp
    @foreach($musics as $music)  @php $i++; @endphp
    <tr class="borders">
      
      <td>{{$i}}</td>
      <td class="text-left pl-5">
        <img src="images/singles/{{$music->song_art}}" width="75px" height="75px">
        &nbsp; {{$music->title}}</td>
      <td>{{$music->album}}</td>
      <td>{{$music->description}}</td>
    </tr>

   @endforeach
    
  </tbody>
</table>
</div>


  <p class="text-left py-3 my-0 bg-dark font-weight-bold text-success h5 pl-2">Albums

              <button class=" float-right btn py-0 text-primary" type="button" data-toggle="collapse" data-target="#musicDIv" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-2x fa-angle-down"></i></button></p> 

 <div class="row">

@foreach($albums as $album)
@if($album->artist_id == $artist_id)
<div class="col-md-2 my-3  shadow rounded mx-3" style="background:#1e1e1e;">
<a href="{{route('albumSongs',$album->album_id)}}">
<div class="image text-center"> <img class="img-fluid rounded" style="max-width: 165px;min-height: 111px;max-height: 111px;" src="images/albums/{{$album->image}}"></div>
<p  style="font-size: 16px;" class=" w-100 text-light  text-center mt-4 h5"> {{$album->album_title}} </p>
</a>
</div>
@endif
@endforeach

              </div>


<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>

             </div>  

        
</div>


<!-- HIDDEN Artist REG -->
<!-- HIDDEN Artist REG -->


<div  class="modal fade" id="musicModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

         <div class="card-header w-100">
            <button id="login" onclick="single()" class="w-25 btn   px-4 mr-2">{{ __('Single') }}</button>
            <button  id="register" onclick="album()" class="w-25 btn  px-4">{{ __('Album') }}</button>

             @if(Session::has('email')) <p class="text-danger ml-5">{{Session::get('email')}} @php Session::forget('email'); @endphp </p> @endif
        </div>

              

        <button type="button" class="m-0 close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    
    
      <div class="modal-body">

         <!-- single-->

                <div id="singleDiv" class="card-body">
                    <form method="POST" action="{{ route('singleMp3Upload') }}" enctype="multipart/form-data">
                        @csrf
                    <input id="artist_id" hidden type="number"  name="artist_id"   value="{{$artist_id}}" >


                        <div class="row mb-3">
                            <label for="song" class="col-md-4 col-form-label text-md-left">{{ __('Choose song') }} <span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input accept="audio/*" id="song" type="file" class="form-control @error('song') is-invalid @enderror" name="song"  required autocomplete="song" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('Title') }} <span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="title"  required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('Album') }} <span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="album"  required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-left">{{ __('Description') }} <span title="Required" class="text-danger">(optional)</span></label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="description" value="{{ old('email') }}"  autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-left">{{ __('Composer') }} <span title="Required" class="text-danger">(optional)</span></label>

                            <div class="col-md-6">
                                <input id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="composer"  autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        
                         <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-left">{{ __('Publisher') }} <span title="Required" class="text-danger">(optional)</span></label>

                            <div class="col-md-6">
                                <input id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="publisher"  autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        


                       
                         <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-left">{{ __('Song art') }} <span title="Required" class="text-danger">(optional)</span></label>

                            <div class="col-md-6">
                                 <input required="" type="file" class="form-control" name="song_art"  >

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>




                      <!--    <div class="row mb-3">
                             <label for="password-confirm" class="col-md-4 col-form-label text-md-left">{{ __('Image') }} <span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input required="" type="file" class="form-control" name="image"  >
                            </div>
                        </div> -->




                        <div class="row mb-4">
                            <div class="col-md-12 ">
                                <button type="submit" class="mt-3 w-25 d-block mx-auto btn btn-outline-success">
                                    {{ __('Save') }}
                                </button>
                            </div>
                            </div> <hr>

                           
                    </form>

                </div>
                <!-- single-->

                  
                     <!-- Album -->

                  <div id="albumDiv" class="collapse card-body">
                      <form method="POST" action="{{ route('albumUpload') }}" enctype="multipart/form-data">
                        @csrf
                    <input id="artist_id" hidden type="number"  name="artist_id"   value="{{$artist_id}}" >


                        <div class="row mb-3">
                            <label for="song" class="col-md-4 col-form-label text-md-left">{{ __('Choose song') }} <span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input  id="song" type="file" class="form-control " name="song[]" multiple  required >

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('Album Title') }} <span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="album_title"  required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         



                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-left">{{ __('Album Description') }} <span title="Required" class="text-danger">(optional)</span></label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="album_description" value="{{ old('email') }}"  autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-left">{{ __('Composer') }} <span title="Required" class="text-danger">(optional)</span></label>

                            <div class="col-md-6">
                                <input id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="composer"  autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        
                         <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-left">{{ __('Publisher') }} <span title="Required" class="text-danger">(optional)</span></label>

                            <div class="col-md-6">
                                <input id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="publisher"  autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
 


                        <div class="row mb-3">
                             <label for="password-confirm" class="col-md-4 col-form-label text-md-left">{{ __('Album Cover') }} <span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input required="" type="file" class="form-control" name="image"  >
                            </div>
                        </div> 




                        <div class="row mb-4">
                            <div class="col-md-12 ">
                                <button type="submit" class="mt-3 w-25 d-block mx-auto btn btn-outline-success">
                                    {{ __('Save') }}
                                </button>
                            </div>
                            </div> <hr>

                           
                    </form>

                </div>

                <!-- Album -->



      </div>
    
    
     
    </div>
  </div>
</div>

<script type="text/javascript">
    $('#login').css('border', '2px solid red');

     function single(){
    $('#register').css('border', 'none');    
    $('#login').css('border', '2px solid red');

    $('#singleDiv').show();
    $('#albumDiv').hide();
    }

     function album(){ 
    $('#login').css('border', 'none');
    $('#register').css('border', '2px solid red');

   $('#singleDiv').hide();
    $('#albumDiv').show();
    
    }

</script>



          @endsection
        
       

