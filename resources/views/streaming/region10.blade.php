@extends('layout')  
@section('page')

<style type="text/css"> .table td,.table th {border-top: 1px solid #20252a;} </style>

<a href="{{route('streaming')}}" class="float-right text-light rounded-0 mr-2 px-4 btn btn-outline-dark font-weight-bold my-1">Back To Streaming</a>

<div class="row mx-auto" style="width:90%; background:#161616;"> 
        <div class="col-md-3"> </div>
         <div class="col-md-6"> 
            <h5 class="text-center text-light my-3">All Regions Top 10</h5> 

            <table class="table  mb-4 text-light">
  <thead>
    <tr class="text-center">
      <th scope="col">Position</th>
      <th scope="col">Song</th>
      <th scope="col">Artist</th>
    
    </tr>
  </thead>
  <tbody id="songs"> 
    <tr id="loading">
     
      <td class="font-weight-bold mx-auto"> Loading... </td>
    </tr>

    
  </tbody>
</table>

<div class="clearfix py-3"></div>

<input type="text" hidden="" id="myStageName" value="">

             </div>  

         <div class="col-md-3"> </div>
           
          
</div>

<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>


<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

<script type="text/javascript">
$(window).on("load", getSongs);

function getSongs() {
  var key, value,i=1, j=1,tops=1,dur,move;
  var BreakException = {};
  var stageName=document.getElementById('myStageName').value;

     $.ajax({
            url:"AjaxRegion10", 
            method:"GET",
            dataType: 'json',
          success: function(data) {
            console.log(data);  
            const list=data.list;

           $('#loading').remove();
           Object.entries(list).forEach(entry => {
           const [key, song] = entry; 
           if(j<=10)
           $('#songs').append('<tr><td scope="row" class="text-center">'+j+'</td> <td>'+song.title+'</td>  <td> '+song.artist+' </td> </tr>');
              j++;     
          });  

          },
          error:function(error)
          {console.log(error);}

        });
   }


</script>



          @endsection
        
       

