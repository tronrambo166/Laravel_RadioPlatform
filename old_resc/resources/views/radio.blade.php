@extends('layout') 
@section('page')



<div class="row " >  
         <div class="col-md-12"> 
            <h3 class="text-center">Rewind Cloud Radio</h3> <hr>

            <table class="shadow mb-3 w-100 bg-white table tabil">
  <thead>
    <tr class=" bg-light w-100">
       <p class="text-left py-3 my-0 bg-white font-weight-bold text-info h5 pl-2">Radio Jambo</p> 

      <th class="small " scope="col">Now Playing</th>
      <th> Title</th>
      <th> Artist</th>
      <th> Time</th>
     
      
    </tr>
  </thead>
  <tbody>
    <tr class="border">
      
      <td>01</td>
      <td>{{$titles['title']}}</td>
      <td>{{$titles['artist']}}</td>
      <td>{{round($titles['duration']/60)}} mins</td>
    </tr>
    
  </tbody>
</table>

             </div>  

        
</div>



          @endsection
        
       

