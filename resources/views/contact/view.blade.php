@extends('layouts/app')

@section('content')


	<div class="container">
		<div class="row">
			
			<div class="col-12">
				<div class="card">
					<div class="card-header bg-success">
						 <b>List Contact Message</b> 
					</div>
					<div class="card-body">
					@if(session('deleteStatus'))
							<div class="alert alert-danger">
								{{ session('deleteStatus') }}
							</div>
						@endif
						
						<table class="table table-bordered">
							<thead>
							
								<tr>
									<th>SL No.</th>
									
									<th>First Name</th>
									<th>Last Name</th>
									<th>Subject</th>
									<th>Message</th>
									<th>Action</th>
									
									
								</tr>
								
							</thead>
							<tbody>
								@forelse($contactmessages as $contactmessage)
									<tr class="{{ ($contactmessage->read_status==1)?'bg-info':'' }}">
										<td>{{$loop->index + 1}}</td>
										
										<td>{{$contactmessage->first_name}}</td>	
										<td>{{$contactmessage->last_name}}</td>	
										<td>{{$contactmessage->subject}}</td>	
										<td>{{$contactmessage->message}}</td>	
										<td>
										@if($contactmessage->read_status==1)
											<a href="{{ url('read/message') }}/{{$contactmessage->id}}" class="btn btn-warning">Read</a>
										@else
										<a href="{{ url('read/message') }}/{{$contactmessage->id}}" class="text-secondary"><b> has been read</b></a>
										@endif
										</td>	
										
										
									</tr>
									@empty
									<tr class="text-center text-danger">
										<td colspan="9"> No data available </td>
									</tr>
								@endforelse
								
							</tbody>
						</table>
						{{$contactmessages->links() }}
					</div>
				</div>
				
				
			</div>
		</div>
	
	</div>
@endsection