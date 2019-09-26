@extends('layouts/app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-4">
				<div class="card">
					<div class="card-header bg-success">
						Add Category form
					</div>
					
					<div class="card-body">
						
						@if(session('status'))
							<div class="alert alert-success">
								{{ session('status') }}
							</div>
						@endif
						
						@foreach($errors->all() as $error)
							<div class="alert alert-danger">
								<li>{{ $error }}</li>
							</div>
						
						
						@endforeach
						<form action="{{ url('add/category/insert') }}" method="post" >
							@csrf
							<div class="form-group">
								<label for="">Category name</label>
								<input type="text" class="form-control" name="category_name" value="{{ old('category_name') }}" placeholder="enter your category name" />
							</div>
							
							<button type="submit" class="btn btn-info">Add Category</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col-8">
				<div class="card">
					<div class="card-header bg-success">
						Category list
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
									<th>Category Name</th>
									<th>Created At</th>
									
								</tr>
								
							</thead>
							<tbody>
								@forelse($categories as $category)
									<tr>
										<td>{{$loop->index + 1}}</td>
										<td>{{$category->category_name}}</td>
										<td>{{$category->created_at->format('d-M-Y h:i:s A')}}
											<br>
											{{$category->created_at->diffForHumans()}}
										</td>
										
									</tr>
									@empty
								
								<tr class="text-center text-danger">
									<td colspan="3">No data is available</td>
								</tr>
								@endforelse
							</tbody>
						</table>
						
					</div>
				</div>
				
				<div class="card mt-3">
					<div class="card-header bg-danger text-white">
						Deleted Category
					</div>
					<div class="card-body">
					@if(session('forceDelete'))
						<div class="alert alert-danger">
						{{session('forceDelete')}}
					
						</div>
					
					@endif
						
						@if(session('restore'))
						<div class="alert alert-success">
						{{session('restore')}}
					
						</div>
					
					@endif
					
						<table class="table table-bordered">
							<thead>
							
								<tr>
								<th>SL No.</th>
									<th>Products Name</th>
									<th>Products Description</th>
									<th>Product prices</th>
									<th>Product quantity</th>
									<th>Alert quantity</th>
									<th> Action </th>
								</tr>
								
							</thead>
							<tbody>
								
								
								
							</tbody>
						</table>
						
					</div>
				</div>
			</div>
		</div>
	
	</div>
@endsection