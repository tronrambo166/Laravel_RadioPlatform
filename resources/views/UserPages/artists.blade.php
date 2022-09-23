@extends('UserPages.layout')  
@section('content')


  

  <div class="row mx-auto" style="width:90%; background:#161616;">  
  <div class="col-md-3">  </div>
   <div class="col-md-5 my-4 text-right">
    <form  action="{{ route('searchArtist') }}" class=""> 
      <input type="search" class="w-75 d-inline small form-control" name="searchArtist" placeholder="Type an artist name or location..">
      <button type="submit"class=" text-light font-weight-bold d-inline btn btn-outline-success">Search</button>
    </form> </div>
 </div>

 @if(isset($result) && $result->count()==0)  <h6  style="background: black;" class="mx-auto text-center d-block py-1 text-info rounds">No matches found! for  &nbsp;<span class="text-light font-weight-light">'{{$searchName}}'</span></h6> 
 

 @elseif(isset($result) && $result->count()>0)
         <h6  style="background: black;" class="mx-auto text-center d-block py-1 text-info rounds">{{$result->count()}} matches found! for  &nbsp;<span class="text-light font-weight-light"> '{{$searchName}}'</span></h6>  

<div class="row mx-auto" style="width:90%; background:#161616;">   
         @foreach($result as $artist)
<a href="{{route('artist_profile',$artist->id)}}" >
<div class="col-md-2 my-3  shadow rounded mx-3" style="background:#1e1e1e;">
<div class="image text-center"> <img class="img-fluid rounded" style="max-width: 165px;min-height: 111px;max-height: 111px;" src="images/artists/{{$artist->image}}"></div>
<a  style="font-size: 16px;" class=" w-100 text-light  text-left mt-4 h5"> {{$artist->stage_name}} </a>
<p  style="font-size: 12px;" class=" w-75   text-light text-left my-2 h6"><span class="font-weight-bold">Location: </span> {{$artist->country.', '.ucwords($artist->city)}} </p>
<a href="{{route('artist_profile',$artist->id)}}" style="background:black;" class="  text-success w-100 py-1 mx-auto rounded text-center mt-3"> View profile </a>

   </div> </a>

    @endforeach
     </div>

     @else

<div class="row mx-auto" style="width:90%; background:#161616;"> 
@foreach($artists as $artist)
<a href="{{route('artist_profile',$artist->id)}}" >
<div class="col-md-2 my-3  shadow rounded mx-3" style="background:#1e1e1e;">
<div class="image text-center"> <img class="img-fluid rounded" style="max-width: 165px;min-height: 111px;max-height: 111px;" src="images/artists/{{$artist->image}}"></div>
<a  style="font-size: 16px;" class=" w-100 text-light  text-left mt-4 h5"> {{$artist->stage_name}} </a>
<p  style="font-size: 12px;" class=" w-75   text-light text-left my-2 h6"><span class="font-weight-bold">Location: </span> {{$artist->country.', '.ucwords($artist->city)}} </p>
<a href="{{route('artist_profile',$artist->id)}}" style="background:black;" class="  text-success w-100 py-1 mx-auto rounded text-center mt-3"> View profile </a>

   </div> </a>
    @endforeach
      </div>
    @endif

<div class="py-5">
            </div> 
           

        


<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

<script type="text/javascript">

</script>



          @endsection
        
       

