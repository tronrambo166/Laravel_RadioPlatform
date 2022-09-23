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

         

            @if ($errors->any()) <div class="alert text-center alert-danger"> <ul>
            @foreach ($errors->all() as $error)  <li>{{ $error }}</li> @endforeach  </ul> </div><br />
                @endif

                 @if (Session::has('song')) 
                 <div class="alert text-center alert-success"> <ul>
                 <li>{{ Session::get('song') }} @php Session::forget('song'); @endphp</li>  </ul> </div> <br/>
                 @endif


                    <a class=" mx-auto d-block mt-3 mb-4 p-2 w-25 font-weight-bold btn btn-outline-success" 
                    href="{{route('myMusic')}}" >Back to Music</a>


             <p class="text-left py-3 my-0 bg-dark font-weight-bold text-light h5 pl-2 mt-5"> Album Title -  @foreach($songs as $title) 
                <span class="text-success">{{$title->album_title}}</span> @break @endforeach

              <button class=" float-right btn py-0 text-primary" type="button" data-toggle="collapse" data-target="#musicDIv" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-2x fa-angle-down"></i></button></p> 

  <div id="musicDIv" class="show musics" style="max-height: 600px; overflow-y: scroll;">
  <table class="shadow mb-3 w-100  shadow border-none table tabil text-light" style="width:90%; background:#1e1e1e;">
  <thead>
    <tr class="  w-100">
       

      <th width="5%"> No</th>
      <th> Title</th>
      <th> Album</th>
      <th> Description</th>
     
      
    </tr>
  </thead>
  <tbody>
   @php $i=0; @endphp
    @foreach($songs as $music)  @php $i++; @endphp
    <tr class="borders">
      
      <td>{{$i}}</td>
      <td class="text-left pl-5">
        <img src="images/albums/{{$music->image}}" width="75px" height="75px">
        &nbsp;{{$music->title}}</td>
      <td>{{$music->album_title}}</td>
      <td>{{$music->album_description}}</td>
    </tr>

   @endforeach
    
  </tbody>
</table>
</div>



<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>

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
        
       

