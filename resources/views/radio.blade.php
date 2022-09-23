@extends('layout') 
@section('page')



<div class="row mx-auto" style="width:90%; background:#161616;">  
         <div class="col-md-12"> 
            <h4 class="text-center mt-2 text-light">Rewind Cloud Monitoring</h4> <hr> 

       <table class="shadow mb-3 w-100  shadow border table tabil text-light" style="width:90%; background:#1e1e1e;">
  <thead>
    <tr class="  w-100">
       <p class="text-left py-3 my-0 bg-dark font-weight-bold text-success h5 pl-2">Radio Jambo</p> 

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

<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>

             </div>  

        
</div>



          @endsection
        
       

