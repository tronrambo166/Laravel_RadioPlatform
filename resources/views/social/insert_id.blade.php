@extends('layout') 
@section('page')


<p id="success" class=" float-right bg-success rounded px-3 py-2 font-weight-bold ">Id added successfully!</p> 
<div class="w-50 row m-auto" style="width:90%; background:#161616;" >  
         <div class="col-md-12">  
             <h4 class="text-center mt-2 text-light">Rewind Cloud Monitoring</h4> <hr> 


 <a href="{{route('social')}}" class="h6 mb-5 text-light rounded-0 mr-2 px-4 btn btn-outline-dark font-weight-bold my-1">Back To Social</a>

 <table class="shadow mb-3 w-100 bg-white table tabil">
  <thead>
    <tr class=" bg-dark w-100">
     <h3 class="text-center mb-4 w-75 h6 text-success bg-dark font-weight-bold py-1">Add/Update Your {{$platform}} ID</h3>
      
         
      
    </tr>
  </thead>
  <tbody>
    <tr class="border">
   <form method="POST" onsubmit="success_msg()" class="form-group form-inline" action="{{route('social_ids')}}">@csrf
     <input hidden type="text" name="type" value="{{$platform}}">
     
     @if($platform == 'Insta')
     <div>
     <input required="" class="form-group form-control d-inline  w-50"type="text" name="insta_pageid_of_fb" placeholder="Enter the page Id, ex:200952529947077">

     <button  style="margin-bottom: 1px;" type="submit" class=" w-25 d-inline btn  btn-outline-info">Save</button>
     
     </div>
     @else
     <div>
     <input required="" class="form-group form-control d-inline  w-50"type="text" name="twitter_id" placeholder="Enter twitter profile Id, ex:1616803039956045824">

     <button  style="margin-bottom: 1px;" type="submit" class=" w-25 d-inline btn  btn-outline-info">Save</button>
     
     </div>

      @endif

     
   </form>
    </tr>
    
  </tbody>
</table>



  
<div style="width:90%; background:#161616;" class=" mx-auto py-2"></div>
<div style="width:100%; background:#949ea9;" class=" text-dark mx-auto p-5 my-2">
  <h5>How to find those Id's</h5> <hr>
  <p class="small "><strong>Instagram Page Id: </strong>Go to your facebook page that is connected to instagram, right click and select 'view source'. Search with 'delegate_page_id' in view source page. <img class="py-2" src="{{asset('images/insta_id.png')}}"></p>

<p class="small mt-4"><strong>Twitter Profile Id: </strong>Go to your twitter profile page, right click and select 'view source'. Search with 'user_id' in view source page. You will find your user id like the image below. <img class="py-2" src="{{asset('images/twitter_id.png')}}"></p>
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
        
       

