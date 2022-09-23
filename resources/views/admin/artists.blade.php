@extends('layout.mainlayout_admin')
@section('content')	
<!-- Page Wrapper -->
<div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-7 col-auto">
								<h3 class="page-title">Artists</h3>
									<p class="text-success"> @if(Session::has('success')) {{Session::get('success')}} </p>
								@php Session::forget('success'); @endphp @endif
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index">Dashboard</a></li>
									<li class="breadcrumb-item active">Artists</li>
								</ul>
							</div>
							
						</div>
					</div>
					<!-- /Page Header -->
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-body">
									<div class="table-responsive">
										

										<table class="datatable table table-hover table-center mb-0">
											<thead>
												<tr> 
																								
													<th>Image</th>
													
													
													<th>Stage Name</th>
													<th>Artist Id</th>
													<th>Email</th>
													
													<th>Approved</th>
												
													
													<th class="text-right">Action</th>
												</tr>
										
											</thead>
										
											<tbody>				
												@foreach($artists as $l)
												<tr>

												



													<td>
													<h2 class="table-avatar">
															<a  class="avatar avatar-lg mr-2"><img class="avatar-img rounded-circle" src="../images/artists/{{$l->image}}" alt="User Image"></a>
															<a href="profile">{{$l->name}} </a>	</h2>									
												</td>

													
													
													<td>{{$l->stage_name}}</td>
													<td>{{$l->art_id}}</td>
													<td>{{$l->email}}</td>
													
													<td>{{$l->approved}}</td>

													
													<td class="text-right">
														<div class="actions">

										@if($l->approved == 0)
										<a class="btn btn-sm bg-success-light" 
										href="{{route('approve',$l->id)}}"> <i class="fe fe-pencil"></i> Approve</a>

										@else	<a onclick="return confirm('Are you sure...?') " class="btn btn-sm bg-success-light"  href="{{ route('restrict',$l->id) }}"> <i class="fe fe-pencil"></i> Restrict</a>
										@endif

							<a onclick="return confirm('Are you sure...?') "  href="{{route('del_artist',$l->id)}}" class="btn btn-sm bg-danger-light">
																<i class="fe fe-trash"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												@endforeach
											
											


									</div>
								</div>
							</div>
						</div>			
					</div>
				</div>			
			</div>
			<!-- /Page Wrapper -->
			
			
			






@endsection