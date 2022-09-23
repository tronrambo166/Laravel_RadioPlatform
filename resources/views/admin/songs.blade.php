@extends('layout.mainlayout_admin')
@section('content')	
<!-- Page Wrapper -->
<div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12 col-auto">

								<div class="row mx-auto shadow" style="width:90%; background:#ffffff;">  
         <div class="col-md-3"> 
            <h5 class="text-center mt-2">The Top 20</h5> <hr>

            <table class="table tabil mb-4 text-dark">
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
          @if($pos=='up') <span class="text-success">up</span> <i class="fas fa-arrow-alt-circle-up text-success fa-2x"></i>
          @elseif($pos=='down') <span class="text-danger">down</span> <i class="fas fa-arrow-alt-circle-down text-danger fa-2x"></i>
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
</div>
								
			</div>
			<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

			<!-- /Page Wrapper -->
			
			
			






@endsection