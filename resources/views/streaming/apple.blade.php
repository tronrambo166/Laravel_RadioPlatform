@extends('layout') 
@section('page')



<div class="row mx-auto" style="width:90%; background:#161616;" >  
         <div class="col-md-12"> 
             <h4 class="text-center mt-2 text-light">Rewind Cloud Monitoring</h4> <hr> 
{{--<a href="{{route('reportAPP')}}" class="rounded-0 mr-2 px-4 btn btn-outline-dark font-weight-bold my-1">Graph</a>--}}
 <a class="text-light rounded-0 mr-2 px-4 btn btn-outline-dark font-weight-bold my-1" href="https://artists.apple.com/a" target="popup" onclick="window.open('https://artists.apple.com/a','popup','width=600','height=600')">Go to Stats</a>
<a href="{{route('update_id', ['type' => 'Apple Artist'] )}}" class="float-right text-warning rounded-0  px-4 btn btn-outline-dark font-weight-bold my-1">Update Id</a>

<a href="{{route('streaming')}}" class="float-right text-light rounded-0 mr-2 px-4 btn btn-outline-dark font-weight-bold my-1">Back To Streaming</a>

 <table class="shadow mb-3 w-100 bg-white table tabil">
  <thead>
    <tr class=" bg-dark w-100">
      <h3 class="text-center bg-light text-dark py-1">Apple</h3>
       

      
      
    </tr>
  </thead>
  <tbody>
    <tr class="border">
   
    </tr>
    
  </tbody>
</table>

<div class="row ">


  <div class="col-sm-4">
     <p class="text-left py-3 my-0  font-weight-bold text-success h5 pl-2">Top 10 Tracks</p> 
          <table class="table tabil mb-4 text-white">
  <thead>
    <tr>
      <th scope="col">Position</th>
      <th scope="col">Title</th>
      <th scope="col">Artist</th>
     
      <th scope="col">Duration</th>
    
    </tr>
  </thead>
  <tbody id="songs">  <?php $i=0;?>

  @if(isset($merge2))
   @foreach($merge2 as $songs) <?php $cnt=0;$k=0; ?>
  
    <tr id="loading">
       <td scope="row" class="text-center"> {{ ++$i }} </td>
       <td scope="row" class="text-center"> {{ $songs['title'] }}  </td>
       <td scope="row" class="text-center"> {{ $songs['artist'] }}  </td>
       <td scope="row" class="text-center"> {{ $songs['duration'] }}  </td>
     
     
         
    </tr>

   @endforeach
   @endif


    
  </tbody>
</table>
  </div>

<div class="col-sm-1"> </div>
  <div class="col-sm-4">
     <p class="text-left py-3 my-0  font-weight-bold text-success h5 pl-2">Top 10 in the region</p> 
          <table class="table tabil mb-4 text-white">
  <thead>
    <tr>
      <th scope="col">Position</th>
      <th scope="col">Title</th>
      <th scope="col">Artist</th>
     
      <th scope="col">Duration</th>
    
    </tr>
  </thead>
  <tbody id="songs">  <?php $i=0;?>

  @if(isset($merge))
   @foreach($merge as $songs) <?php $cnt=0;$k=0; ?>
  
    <tr id="loading">
       <td scope="row" class="text-center"> {{ ++$i }} </td>
       <td scope="row" class="text-center"> {{ $songs['title'] }}  </td>
       <td scope="row" class="text-center"> {{ $songs['artist'] }}  </td>
       <td scope="row" class="text-center"> {{ $songs['duration'] }}  </td>
     
     
         
    </tr>

   @endforeach
   @endif


    
  </tbody>
</table>
  </div>

 

  <!--<div class="col-sm-3">
     <p class="text-left mx-auto text-center py-3 my-0  font-weight-bold text-success h5 pl-2">Earnings</p> 
  </div> -->

</div>

  

<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>

             </div>  

        
</div>



          @endsection
        
       

