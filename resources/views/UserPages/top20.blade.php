@extends('UserPages.layout')  
@section('content')



<div class="row ">  
         <div class="col-md-3"> 
            <h5 class="text-center mt-2">Top 20 Songs</h5> <hr>

            <table class="table tabil mb-4">
  <thead>
    <tr>
      <th scope="col">Position</th>
      <th scope="col">Artist</th>
      <th scope="col">Song</th>
      <th scope="col">Duration</th>
    
    </tr>
  </thead>
  <tbody id="songs"> 
    <tr id="loading">
     
      <td class="font-weight-bold"> Loading... </td>
    </tr>

    
  </tbody>
</table>

<div class="clearfix py-3"></div>



             </div>  

         <div class="col-md-3"> </div>
           <div class="col-md-6 text-center" style="background-image: url('images/image.jpg');background-repeat:no-repeat; min-height: 600px;">
           

           

            
             

           </div>    
          
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

<script type="text/javascript">
$(window).on("load", getSongs);

function getSongs() {
  var key, value,i=1, j=1,tops=1,dur;
  var BreakException = {};
 
     $.ajax({
            url:"getTop20", 
            method:"GET",
            dataType: 'json',
          success: function(data) {  
            const songs20=data.data;
            const songs_all=data.data2;
            const today=data.today;
            const artists=data.artists;
            const all_titles=data.all_titles;

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
            
          }); 

           // Top 10 songs of artist

            
          },
          error:function(error)
          {console.log(error);}

        });
}

</script>



          @endsection
        
       

