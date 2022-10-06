@extends('layout') 
@section('page')



<div class="row mx-auto" style="width:90%; background:#161616;" >  
         <div class="col-md-12"> 
             <h4 class="text-center mt-2 text-light">Rewind Cloud Monitoring</h4> <hr> 

 <!-- <a href="{{route('reportYT')}}" class="rounded-0 px-4 btn btn-outline-light font-weight-bold my-1">Graph</a> -->
 
 <a href="{{route('update_id', ['type' => 'YouTube Channel'] )}}" class=" text-warning rounded-0  px-4 btn btn-outline-dark font-weight-bold my-1">Update Id</a>

 <a href="{{route('streaming')}}" class="float-right text-light rounded-0 mr-2 px-4 btn btn-outline-dark font-weight-bold my-1">Back To Streaming</a>

 <table class="shadow mb-3 w-100 bg-white table tabil">
  <thead>
    <tr class=" bg-dark w-100"> 
       <h3 class="text-center bg-light text-dark py-1">YouTube</h3>
      
      

      
      
    </tr>
  </thead>
  <tbody>
    <tr class="border">
   
    </tr>
    
  </tbody>
</table>

<div class="row ">


  <div class="col-sm-4">
     <p class="text-left py-3 my-0  font-weight-bold text-success h6 pl-2">Your Top 10 Songs (by View Count)</p> 

          <table class="table tabil mb-4 text-white">
  <thead>
    <tr>
      <th scope="col">Position</th>
      <th scope="col">Title</th>
      <th scope="col">Imgae</th>
     
    
    </tr>
  </thead>
  <tbody id="songs">  <?php $i=0;?>

  @if(isset($tracks))
   @foreach($tracks as $song) <?php  ?>
   @if($i<=10)
   

    <tr id="loading">
       <td scope="row" class="text-center"> {{ ++$i }} </td>
      <td scope="row" class="text-center"> {{ $song['title'] }} </td>
      <td scope="row" class="text-center"> <img width="120px" src="{{ $song['image'] }}"> </td>
       
         
    </tr>

   @endif
   @endforeach
   @endif


    
  </tbody>
</table>
  </div> <div class="col-sm-1"></div>



  <div class="col-sm-4">
     <p class="text-left py-3 my-0  font-weight-bold text-success h6 pl-2">Top 10 in the region</p> 

          <table class="table tabil mb-4 text-white">
  <thead>
    <tr>
      <th scope="col">Position</th>
      <th scope="col">Title</th>
      <th scope="col">Imgae</th>
     
    
    </tr>
  </thead>
  <tbody id="songs">  <?php $i=0;?>

  @if(isset($tracks_reg))
   @foreach($tracks_reg as $song) <?php  ?>
   @if($i<=10)
   

    <tr id="loading">
       <td scope="row" class="text-center"> {{ ++$i }} </td>
      <td scope="row" class="text-center"> {{ $song['title'] }} </td>
      <td scope="row" class="text-center"> <img width="120px" src="{{ $song['image'] }}"> </td>
       
         
    </tr>

   @endif
   @endforeach
   @endif


    
  </tbody>
</table>
  </div>

  

  <div class="col-sm-3">
      <p class="text-left py-3 my-0  font-weight-bold text-success h6 pl-2">Channel Stats</p> 

      <table class="table tabil mb-4 text-white">
  <thead>
    <tr>
      <th scope="col">Month's Views</th>
      <th scope="col">Subscribers</th>
      <th scope="col">Total Views</th>
     
    
    </tr>
  </thead>
  <tbody id="songs"> 

    <tr id="loading">
       <td scope="row" class="text-center"> {{ $views}} </td>
      <td scope="row" class="text-center"> {{ $subscribers }} </td>
      <td scope="row" class="text-center"> {{$viewCount}} </td>
       
         
    </tr>
  </tbody>
</table>
    
  </div>

</div>

  

<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>

             </div>  

        
</div>



          @endsection
        
       

