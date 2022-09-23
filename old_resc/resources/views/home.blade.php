@extends('layout') 
@section('page')



<div class="row ">  
         <div class="col-md-3"> 
            <h3 class="text-center">Top 20 Songs:</h3> <hr>

            <table class="table tabil mb-4">
  <thead>
    <tr>
      <th scope="col">Position</th>
      <th scope="col">Artist</th>
      <th scope="col">Song</th>
      <th scope="col">Duration</th>
      <th scope="col">Move</th>
    </tr>
  </thead>
  <tbody id="songs"> 
    <tr id="loading">
     
      <td class="font-weight-bold"> Loading... </td>
    </tr>

    
  </tbody>
</table>

<input type="text" hidden="" id="myStageName" value="{{$thisUser->stage_name}}">

             </div>  

         <div class="col-md-3"> </div>
           <div class="col-md-6 text-center" style="background-image: url('images/image.jpg');background-repeat:no-repeat; min-height: 600px;">
             <h3 class="text-center">Recent Most Popular Content for {{$thisUser->stage_name}}</h3>

           

             <hr>
             <p class="mb-1 font-weight-bold">Your Rank today! <span id="rank"class="d-block font-weight-bold text-danger"></span></p>

             <p class="font-weight-bold">Your Plays this week! <span id="played"class="d-block font-weight-bold text-light"></span></p>


             <div id="mySongs"> <p id="load" class="mt-3 w-50 rounds mx-auto bg-light px-4 py-1">Loading...</p> </div>
             

           </div>    
          
</div>

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

            Object.entries(today).forEach(entry => {
           const [key, value] = entry;
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
           if( value.title == title){ if(value.duration<10) dur=value.duration; else dur=(value.duration/60).toFixed();
            $('#songs').append('<tr><th scope="row" class="text-center">'+i+'</th> <td>'+value.artist+'</td> <td>'+value.title+' </td> <td> '+dur+' mins </td> <td> - </td></tr>');
               $('#loading').remove();

               // if(value.artist=='Otile Brown')  document.getElementById('played').innerHTML=count;           
           //console.log(value.album); 
           i++; throw BreakException; };
          });  

          }
          catch(e) { if (e !== BreakException) throw e;}
            
          }); 

           
           // Top 10 songs of artist

           Object.entries(all_titles).forEach(entry => {
           const [title, count] = entry; 
           try{
            Object.entries(songs_all).forEach(entry => {
           const [key, value] = entry;
           if( value.title == title && value.artist == stageName && tops<=10){ 
              $('#mySongs').append(' <p class="mt-3 w-50 rounds mx-auto bg-light px-4 py-1">'+tops+'. '+value.title+'</p>');
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
        
       

