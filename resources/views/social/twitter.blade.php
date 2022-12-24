@extends('layout') 
@section('page')



<div class=" mx-auto" style="width:95%; background:#161616;" >  
   <h4 class="text-center mt-2 text-light border m-auto w-25">Twitter 
   </h4> <a href="{{route('youtube')}}" class="float-right text-light rounded-0 mr-2 px-4 btn btn-outline-dark font-weight-bold my-1 ml-auto">Back</a> <hr>
   

         <div class="row mt-5"> 


  <div class="col-sm-4">
     <p class="text-left py-3 my-0  font-weight-bold text-success h5 pl-2">Top 10 Tweets</p> 
          <table class="table tabil mb-4 text-white">
  <thead>
    <tr>
      <th scope="col">Position</th>

      <th scope="col">Tweet</th>
  
    </tr>
  </thead>
  <tbody id="songs">  <?php $i=0;?>

   @foreach($tweets as $songs) <?php $cnt=0;$k=0; ?>
  
    <tr id="loading">
       <td scope="row" class="text-center"> {{ ++$i }} </td>

        <td scope="row" class="text-white text-center"> <a class="text-primary " href="https://twitter.com/RewindTwitt/status/{{$songs->id}}"> {{ $songs->text }} </a> </td>
       
    </tr>

   @endforeach
 
  </tbody>
</table>
  </div>

<div class="col-sm-1"> </div>

@if($mentions != 0)
  <div class="col-sm-4">
     <p class="text-left py-3 my-0  font-weight-bold text-success h5 pl-2">Mentions</p> 
          <table class="table tabil mb-4 text-white">
  <thead>
    <tr>
      <th scope="col">Position</th>

      <th scope="col">Tweet</th>
  
    </tr>
  </thead>
  <tbody id="songs">  <?php $i=0;?>

   @foreach($tweets as $songs) <?php $cnt=0;$k=0; ?>
  
    <tr id="loading">
       <td scope="row" class="text-center"> {{ ++$i }} </td>

      <td scope="row" class="text-center"> <a href="https://twitter.com/RewindTwitt/status/{{$songs->id}}"> {{ $songs->text }} </a> </td>
   
       
    </tr>

   @endforeach
 
  </tbody>
</table>
  </div>
  @endif

            
<div class="col-sm-1"> </div>

     <div class="col-sm-2 mt-4">
     <p class="text-left py-3 my-0  font-weight-bold text-success h5 pl-0">Followers</p> 
          <table class="  mb-4 text-white">
  <thead>
    <tr>
      <th scope="col">Followers</th>
    
  
    </tr>
  </thead>
  <tbody id="songs">
  
    <tr id="loading">
       <td scope="row" class="text-center"> {{ $data['followers'] }} </td>
              
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



          @endsection
        
       

