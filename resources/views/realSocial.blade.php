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
        <a href="{{route('login.facebook')}}" class="mx-2 btn btn-outline-danger  rounded">Facebook</a>
         <a href="{{route('instagram')}}" class="mx-2 btn btn-outline-success rounded">Instagram</a>
          <a href="{{route('twitter')}}" class="mx-2 btn btn-outline-primary rounded">Twitter</a>
          <a href="{{route('tiktok')}}" class="mx-2 btn btn-outline-warning  rounded">TikTok</a>
           
         
     </div>  
    </tr>


    <tr class=" bg-dark w-100 mx-auto text-center">
       
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
        
       

