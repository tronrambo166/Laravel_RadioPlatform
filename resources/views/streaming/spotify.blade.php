@extends('layout') 
@section('page')



<div class="row mx-auto" style="width:90%; background:#161616;" >   
         <div class="col-md-12"> 
             <h4 class="text-center mt-2 text-light">Rewind Cloud Monitoring</h4> <hr> 
<a href="{{route('reportSP')}}" class="rounded-0 px-4 btn btn-outline-light font-weight-bold my-1">Graph</a>
<a href="{{route('streaming')}}" class="float-right text-light rounded-0 mr-2 px-4 btn btn-outline-dark font-weight-bold my-1">Back To Streaming</a>

 <table class="shadow mb-3 w-100 bg-white table tabil">
  <thead>
    <tr class=" bg-dark w-100">
      <h3 class="text-center bg-light text-dark py-1">Spotify</h3>
      
      

      
      
    </tr>
  </thead>
  <tbody>
    <tr class="border">
   
    </tr>
    
  </tbody>
</table>

<div class="row ">

  <div class="col-sm-4">
     <p class="text-left py-3 my-0  font-weight-bold text-success h6 pl-2">Top 10 Tracks</p> 

          <table class="table tabil mb-4 text-white">
  <thead>
    <tr>
      <th scope="col">Position</th>
      <th scope="col">Title</th>
      <th scope="col">Album</th>
      <th scope="col">Duration</th>
     
    
    </tr>
  </thead>
  <tbody id="songs">  <?php $i=0;?>

  @if(isset($tracks))
   @foreach($tracks as $song) <?php  ?>
   @if($i<=10)
   

    <tr id="loading">
       <td scope="row" class="text-center"> {{ ++$i }} </td>
      <td scope="row" class="text-center"> {{ $song['song'] }} </td>
     <td scope="row" class="text-center"> {{ $song['album'] }} </td>
     <td scope="row" class="text-center"> {{ round($song['duration'])  }} sec</td>
       
         
    </tr>

   @endif
   @endforeach
   @endif


    
  </tbody>
</table>
  </div>

<div class="col-sm-1"></div>
  <div class="col-sm-5 pt-5 text-white">
    @if(isset($listeners))
    Monthly Listeners = {{$listeners}}
    @endif

     <a class="btn btn-outline-success ml-4" href="https://accounts.spotify.com/en/login" target="popup" onclick="window.open('https://open.spotify.com/user/31atwg367suskoge6efthhch67j4','popup','width=600','height=600')">Go to Stats</a>
  </div>


  <div class="col-sm-2">
    
  </div>

</div>

  

<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>

             </div>  

        
</div>



          @endsection
        
       
