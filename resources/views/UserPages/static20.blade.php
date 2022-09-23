@extends('UserPages.layout')  
@section('content')



<div class="row mx-auto shadow" style="width:90%; background:#161616;">  
         <div class="col-md-3"> 
            <h5 class="text-center mt-2">The Top 20</h5> <hr>

            <table class="table tabil mb-4 text-white">
  <thead>
    <tr>
      <th scope="col">Position</th>
      <th scope="col">Artist</th>
      <th scope="col">Song</th>
      <th scope="col">Move</th>
    
    </tr>
  </thead>
  <tbody id="songs">

   @foreach($static20 as $static) <?php $cnt=0; ?>
   @foreach($lastDay as $yester)

@if($static->song == $yester->song)  
@if($static->position < $yester->position) 
<?php $pos='up'; $cnt++;?>
@elseif($static->position == $yester->position) 
<?php  $pos='-'; $cnt++;?>
@else <?php $pos='down'; $cnt++; ?>
@endif

    <tr id="loading">
     
      <td scope="row" class="text-center"> {{$static->position}} </td>
       <td scope="row" class="text-center"> {{$static->artist}} </td>
        <td scope="row" class="text-center"> {{$static->song}} </td>
         <td id="move{{$static->id}}" scope="row" class="text-center small">
          @if($pos=='up') <i class="fas fa-arrow-alt-circle-up text-success fa-2x"></i>
          @elseif($pos=='down') <i class="fas fa-arrow-alt-circle-down text-danger fa-2x"></i>
          @else -
          @endif 
        </td>
    </tr>

   @endif
   @endforeach

@if($cnt==0)
    <tr id="loading">
     
      <td scope="row" class="text-center"> {{$static->position}} </td>
       <td scope="row" class="text-center"> {{$static->artist}} </td>
        <td scope="row" class="text-center"> {{$static->song}} </td>
         <td id="move{{$static->id}}" scope="row" class="text-center small"> <i class="fas fa-arrow-alt-circle-up text-success fa-2x"></i> </td>
    </tr>
    
   @endif
    @endforeach

    
  </tbody>
</table>

<div class="clearfix py-3"></div>



             </div>  

         <div class="col-md-3"> </div>
           <div class="col-sm-6 text-center" style="background-image: url('images/rewind.png');background-repeat:no-repeat; max-height: 600px; background-size:contain; background-position:center;">
           

          <h2 class="px-4 w-100 d-block  text-left text-dark">

                 

                   @if(Session::has('reset'))
                   <div class="alert alert-success" role="alert">
                        <p style="font-size: 14px"; class="m-0">{{Session::get('reset')}}   @php Session::forget('reset'); @endphp </p> </div>  
                    @endif


                    
              @if(Session::has('login_err'))
                   <div class="alert alert-primary" role="alert">
                        <p style="font-size: 14px"; class="m-0">{{Session::get('login_err')}}   @php Session::forget('login_err'); @endphp </p>   </div>  
              @endif
                   


                @if(Session::has('email'))
                   <div class="alert alert-danger" role="alert">
                        <p style="font-size: 14px"; class="m-0">{{Session::get('email')}}   @php Session::forget('email'); @endphp </p>   </div>  
              @endif

                 

                   <!-- <span  style="color: green;" class="">Rewind</span> to Know Your Playback</h2> -->

            
             

           </div>    
          
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>


<script type="text/javascript">
/*
$(window).on("load", getSongs);

function getSongs() {
  var key, value,i=1, j=1,tops=1,dur,p=1;
  var BreakException = {};
  //var stageName=document.getElementById('myStageName').value;

     $.ajax({
            url:"move", 
            method:"GET",
            dataType: 'json',
          success: function(data) {  
            const songs20=data.data;
            const songs_all=data.data2;
            const today=data.today;
            const artists=data.artists;
            const all_titles=data.all_titles;


// Top 20 chart
           Object.entries(songs20).forEach(entry => {
           const [title, pos] = entry;
           console.log(title,pos);
           if(pos=='up')
           $('#move'+p).html('<i class="fas fa-arrow-alt-circle-up text-success fa-2x"></i>'); 
           if(pos=='down')
           $('#move'+p).html('<i class="fas fa-arrow-alt-circle-down text-danger fa-2x"></i>'); 
          if(pos=='not')
           $('#move'+p).html('-'); 
           p++;
          
            
          }); 

            
          },
          error:function(error)
          {console.log(error);}

        });
}
*/

</script>


          @endsection
        
       

