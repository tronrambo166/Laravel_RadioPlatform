@extends('UserPages.layout')  
@section('content')


  <a class=" mx-auto d-block mt-4 mb-4 p-2 w-25 font-weight-bold btn btn-outline-success" 
                    href="{{route('artists')}}" >Back to Artists</a>

<div class="row mx-auto" style="width:90%; background:#161616; min-height: 500px" >   


  <div class="col-md-5 my-3 text-center" style="background:#161616;" >
<div class="image text-center"> <img class="img-fluid rounded" style="max-width: 200px;" src="images/artists/{{$thisArtist->image}}"></div>

<div class="artist_info  mt-4">
<h5 class="d-inline">Artist Name: </h5> <p href="" class="d-inline my-2"> {{$thisArtist->stage_name}} </p>



@if(Session::has('Userlogged')) @php Session::put('contact_id',$thisArtist->id); @endphp
<a href="{{route('artist_contact')}}" class=" d-block w-50 mx-auto btn btn-outline-light  my-3 rounds">Contact Artist</a>

@else @php Session::put('contact_id',$thisArtist->id); @endphp
<a onclick="alert('You need to login as a User first!');" href="{{route('login')}}" class=" d-block w-50 mx-auto btn btn-outline-light  my-3 rounds">Contact Artist</a>
@endif

</div>

   </div>


    <div class="col-md-7 my-3" style="background:#161616;" >
        <div class="row">
            <div class="col-md-6 text-center mb-4">
             <h4 class="text-success font-weight-bold">Top Songs </h4> <hr>
              <div id="mySongs" class="mb-3"> <p id="load" class="mt-3 w-75 rounds mx-auto text-dark bg-light px-4 py-1">Loading...</p> </div>
           </div>


           <div class="col-md-6 text-center">
             <h4 class="text-success font-weight-bold">Schedules </h4> <hr>
              
              @foreach($artistSchedule as $schedule) 
              <div class="row my-3"> 
                  <div class="col-md-5"> 
                <h5 class="text-left d-inline ml-4 text-light font-weight-bold">
                  {{date('M d',strtotime($schedule->evt_start))}}:  </h5> </div>

                <div class="col-md-7">
               <p id="" class="text-warning px-4 py-2 d-inline mt-3 w-100 rounds mx-auto bg-dark"> {{$schedule->evt_text}}</p> 
             </div>

            </div>
            @endforeach

           </div>


     </div> 

     </div> 
     </div> 
           

        
<input type="text" hidden="" id="myStageName" value="{{$thisArtist->stage_name}}">

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

<script type="text/javascript">
$(window).on("load", getSongs);

function getSongs() {
  var key, value,i=1, j=1,tops=1,dur;
  var BreakException = {};
  var stageName=document.getElementById('myStageName').value;

     $.ajax({
            url:"getSongs", 
            method:"GET",
            dataType: 'json',
          success: function(data) {  
            const songs20=data.data;
            const songs_all=data.data2;
            const today=data.today;
            const artists=data.artists;
            const all_titles=data.all_titles;

          /*  Object.entries(today).forEach(entry => {
           const [key, value] = entry;
           console.log(key+'='+value);
           if(key==stageName) {
           //console.log(j,key,value);
          document.getElementById('rank').innerHTML=j;
         
        }
           j++;
          
          });  
             Object.entries(artists).forEach(entry => {
            const [title, count] = entry;
              if(title==stageName)  document.getElementById('played').innerHTML=count;
              //console.log(title,count);
         })  


           Object.entries(songs20).forEach(entry => {
           const [title, count] = entry;
           try{
            Object.entries(songs_all).forEach(entry => {
           const [key, value] = entry;
           if( value.title == title && i<21){ if(value.duration<10) dur=value.duration; else dur=(value.duration/60).toFixed();
            $('#songs').append('<tr><th scope="row" class="text-center">'+i+'</th> <td>'+value.artist+'</td> <td>'+value.title+' </td> <td> '+dur+' mins </td> </tr>');
               $('#loading').remove();

               // if(value.artist=='Otile Brown')  document.getElementById('played').innerHTML=count;           
           //console.log(value.album); 
           i++; throw BreakException; };
          });  

          }
          catch(e) { if (e !== BreakException) throw e;}
            
          });   */

           
           // Top 10 songs of artist

           Object.entries(all_titles).forEach(entry => {
           const [title, count] = entry; 
           try{
            Object.entries(songs_all).forEach(entry => {
           const [key, value] = entry;
           if( value.title == title && value.artist == stageName && tops<=5){ 
              $('#mySongs').append(' <p class="mt-3 w-75 rounds mx-auto text-dark bg-light px-4 py-1">'+tops+'. '+value.title+'</p>');
              $('#load').remove(); console.log(value.title);

           //console.log(value.album); 
           tops++; throw BreakException; 
          };
          });  

          }
          catch(e) { if (e !== BreakException) throw e;}       
          }); 

            
          },
          error:function(error)
          {console.log(error);}

        });
}

</script>




          @endsection
        
       

