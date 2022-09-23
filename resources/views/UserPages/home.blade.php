@extends('UserPages.layout')  
@section('content')


<div class="row " > 
@if(Session::has('success'))
  <div class="w-100 d-block py-2 bg-light text-center text-success">{{Session::get('success')}}</div>
  @php Session::forget('success'); @endphp @endif


 <h2 class="px-4 w-100 d-block py-4 text-center"> <span class="text-danger">Rewind</span> to Know Your Playback</h2>

 </div> <p id="rank"></p>

<div class="row " >  
         <div class="col-md-3"> 
            

             </div>  

         <div class="col-md-3"> </div>
           <div class="col-md-6 text-center">
             

             <img src="images/image.jpg" class="img-fluid" height="500px">

           </div>    
          
</div>
</div>
    


<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

<script type="text/javascript">

</script>



          @endsection
        
       

