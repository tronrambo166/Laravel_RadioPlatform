@extends('layout') 
@section('page')


<p id="success" class=" float-right bg-warning rounded px-3 py-1 font-weight-bold ">Please click and add your artist id for all platform!</p> 
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


    <tr class=" bg-dark w-100 mx-auto text-center">
       <div class="links mx-auto text-center my-5">

    @if($complete == 1)
    <a href="{{route('overall10')}}" style="background: #6f8187;" class="mx-2 btn btn-light font-weight-bold   rounded">Overall top 10</a>
    <a href="{{route('region10')}}" style="background: #6f8187;" class="mx-2 btn btn-light font-weight-bold  rounded">Regions top 10</a> 
    @else
    <a onclick="success_msg()" style="background: #6f8187;" class="mx-2 btn btn-light font-weight-bold   rounded">Overall top 10</a>
    <a onclick="success_msg()" style="background: #6f8187;" class="mx-2 btn btn-light font-weight-bold  rounded">Regions top 10</a> 
    @endif
                    
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

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

<script type="text/javascript">
  $('#success').hide();
  function success_msg(){
    console.log('success');
    $('#success').show();
  }
</script>

          @endsection
        
       

