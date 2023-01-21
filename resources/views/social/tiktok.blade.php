@extends('layout') 
@section('page')



<div class=" mx-auto" style="width:95%; background:#161616;" >  
   <h4 class="text-center mt-2 text-light border m-auto w-25">TikTok 
   </h4> <a href="{{route('social')}}" class="float-right text-light rounded-0 mr-2 px-4 btn btn-outline-dark font-weight-bold my-1 ml-auto">Back</a> <hr>
   

         <div class="row mt-5"> 


  <div class="col-sm-4">
     <p class="text-left py-3 my-0  font-weight-bold text-success h5 pl-2">Top 10 Videos</p> 
          <table style="border-top: none;" class="table tabil mb-4 text-white">
  <thead>
    <tr>
      <th scope="col">Position</th>

      <th scope="col">Title</th>
       <th scope="col">Likes</th>
  
    </tr>
  </thead>
  <tbody id="songs">  <?php $i=0;?>

  @foreach($videos as $video)
  
    <tr id="loading">
       <td scope="row" class="text-center"> {{ ++$i }} </td>

        <td scope="row" class="text-success text-center"> <a target="_blank" class="text-primary " href="https://www.tiktok.com/@rewtik248/video/{{$video['id']}}"> {{ $video['title'] }} </a> </td>

       <td scope="row" class="text-center">{{$video['likes']}} </td>
       
    </tr>

@endforeach
 
  </tbody>
</table>
  </div>

<div class="col-sm-1"> </div>


<div class="col-sm-1"> </div>

     <div class="col-sm-2 mt-4">
     <p class="text-left py-3 my-0  font-weight-bold text-success h5 pl-0">Followers</p> 

 
     <p class="text-light font-weight-bold">Followers : <span class="text-success">{{$user['followers']}}</span></p>

        <p class="text-light font-weight-bold">Likes : <span class="text-success">{{$user['likes']}}</span></p>
              
  </div>
          



         </div>  


  

<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>


        
</div>



          @endsection
        
       

