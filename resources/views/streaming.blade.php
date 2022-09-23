@extends('layout') 
@section('page')



<div class="row mx-auto" style="width:90%; background:#161616;" >  
         <div class="col-md-12"> 
             <h4 class="text-center mt-2 text-light">Rewind Cloud Monitoring</h4> <hr> 

 <table class="shadow mb-3 w-100 bg-white table tabil m-auto">
  <thead>
    <tr class=" bg-dark w-100 m-auto text-center">
       <div class="links m-auto text-center">
        <a href="{{route('youtube')}}" class="mx-2 btn btn-outline-danger  rounded">YouTube</a>
         <a href="{{route('spotify')}}" class="mx-2 btn btn-outline-success rounded">Spotify</a>
          <a href="{{route('deezer')}}" class="mx-2 btn btn-outline-primary rounded">Deezer</a>
          <a href="{{route('apple')}}" class="mx-2 btn btn-outline-warning  rounded">Apple</a>
           <a href="{{route('boomplay')}}" class="mx-2 btn btn-outline-secondary rounded">Boomplay</a>
            <a href="{{route('mdundo')}}" class="mx-2 btn btn-outline-light  rounded">Mdundo</a>
   
       
     </div>
        
        
      
      
    </tr>
  </thead>
  <tbody>
    <tr class="border">
   
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
        
       

