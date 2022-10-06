@extends('layout') 
@section('page')


<p id="success" class=" float-right bg-success rounded px-3 py-2 font-weight-bold ">Id added successfully!</p> 
<div class="w-50 row m-auto" style="width:90%; background:#161616;" >  
         <div class="col-md-12">  
             <h4 class="text-center mt-2 text-light">Rewind Cloud Monitoring</h4> <hr> 


 <a href="{{route('streaming')}}" class="h6 mb-5 text-light rounded-0 mr-2 px-4 btn btn-outline-dark font-weight-bold my-1">Back To Streaming</a>

 <table class="shadow mb-3 w-100 bg-white table tabil">
  <thead>
    <tr class=" bg-dark w-100">
     <h3 class="text-center mb-4 w-75 h6 text-success bg-dark font-weight-bold py-1">Add/Update Your {{$platform}} ID</h3>
      
         
      
    </tr>
  </thead>
  <tbody>
    <tr class="border">
   <form method="POST" onsubmit="success_msg()" class="form-group form-inline" action="{{route('insert_id')}}">@csrf
     <input hidden type="text" name="type" value="{{$platform}}">
     <input required="" class="form-group form-control  d-inline w-50"type="text" name="id" placeholder="Enter your id">
     
     @if($platform == 'YouTube Channel' || $platform == 'Spotify Artist' || || $platform == 'Mdundo Artist')
     <div>
     <input required="" class="form-group form-control d-inline  w-50"type="text" name="regid" placeholder="Enter region playlist id, ex:'856783'">
     <p class="font-italic text-warning w-50 d-inline">(For the playlist from the platform within your region)</p>
     </div>
     @else
     <div>
     <input required="" class="form-group form-control d-inline  w-50"type="text" name="regid" placeholder="Enter Country code, ex:'KE' for Kenya">
     <p class="font-italic text-warning w-50 d-inline">(For the playlist from the platform within your region)</p>
     </div>

      @endif

     <button  style="margin-bottom: 1px;" type="submit" class=" w-25 d-inline btn  btn-outline-info">Save</button>
   </form>
    </tr>
    
  </tbody>
</table>



  
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:100%; background:#7c8997;" class=" text-dark mx-auto p-5 my-2">
  <h5>How to find those Id's</h5> <hr>
  <p class="h6 "><strong>Artist Id: </strong>Your Artist ID is the string of numbers and letters that normally appear at the end of your artist page URL, in some cases you will find it in your setting</p>

 <h6 class="mt-5 text-dark font-weight-light">Example: For Spotify</h6> <hr>
  <p class=" text-dark">
1.Open the Spotify Web Player <br>
2.Find your artist page by searching the platform <br>
3.Check the address bar for your Artist URL<br>
4.The page URL will start with “https://open.spotify.com/artist/” and the number that appears after that is the Artist ID<br>
<img src="{{asset('images/spotify.png')}}">
  </p>
</div>



<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>

             </div>  

        
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

<script type="text/javascript">
  $('#success').hide();
  function success_msg(){
    console.log('success');
    $('#success').show();
  }
</script>


          @endsection
        
       

