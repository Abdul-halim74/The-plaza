@extends('layouts/app')

@section('content')
	
		<div class="row">
			<div class="col-3 offset-1">
				<div class="card">
					<div class="card-header bg-success">
						Add product form
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
						<form action="{{ url('add/product/insert') }}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
								<label for="">Category name</label>
								<select class="form-control" name="category_id" id="">
									<option value="">-Select one-</option>
									@foreach($categories as $category)
									<option value="{{$category->id}}">{{$category->category_name}}</option>
									@endforeach
								</select>
							</div>
							
							<div class="form-group">
								<label for="">Product name</label>
								<input type="text" class="form-control" name="product_name" value="{{ old('product_name') }}" placeholder="enter your product name" />
							</div>
							<div class="form-group">
								<label for="">Product Description</label>
								<textarea class="form-control" name="product_description" id=""  rows="3">{{ old('product_description') }}</textarea>
							</div>
							<div class="form-group">
								<label for="">Product Price</label>
								<input type="text" class="form-control" name="product_price" value="{{ old('product_price') }}" placeholder="enter your product price" />
							</div>
							<div class="form-group">
								<label for="">Product Quantity</label>
								<input type="text" class="form-control" name="product_quantity" value="{{ old('product_quantity') }}" placeholder="enter your product quantity" />
							</div>
							<div class="form-group">
								<label for="">Alert Quantity</label>
								<input type="text" class="form-control" name="alert_quantity" value="{{ old('alert_quantity') }}" placeholder="enter your Alert quantity" />
							</div>
							<div class="form-group">
								<label for="">Product image</label>
								<input type="file" class="form-control" name="product_image"  />
							</div>
							<button type="submit" class="btn btn-info">Add Product</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col-8">
				<div class="card">
					<div class="card-header bg-success">
						Product list
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
									<th>Products Name</th>
									<th>Products Description</th>
									<th>Product prices</th>
									<th>Product quantity</th>
									<th>Alert quantity</th>
									<th>Product Image</th>
									<th> Action </th>
								</tr>
								
							</thead>
							<tbody>
								@forelse($products as $product)
									<tr>
										<td>{{$loop->index + 1}}</td>
										{{-- <td>{{App\Category::find($product->category_id)->category_name}}</td> p-8 --}}
										<td>{{$product->relationTocategories->category_name}}</td>	
										<td>{{$product->product_name}}</td>
										<td>{{str_limit($product->product_description,10)}}</td>
										<td>{{$product->product_price}}</td>
										<td>{{$product->product_quantity}}</td>
										<td>{{$product->alert_quantity}}</td>
										<td>
											<img src="{{ asset('uploads/products_photos') }}/{{$product->product_image}}" alt="Not found" width="50"/>
										</td>
										<td>
											<div class="btn-group" role="group" area-label="Basic Example">
												<a href="{{ url('edit/product') }}/{{ $product->id }}" class="btn  btn-info">Edit</a>
											&nbsp;
											<a href="{{ url('delete/product') }}/{{ $product->id }}" class="btn  btn-danger">Delete</a>
											</div>
										
											
										</td>
										
									</tr>
									@empty
									<tr class="text-center text-danger">
										<td colspan="9"> No data available </td>
									</tr>
								@endforelse
								
							</tbody>
						</table>
						{{$products->links() }}
					</div>
				</div>
				
				<div class="card mt-3">
					<div class="card-header bg-danger text-white">
						Deleted Product
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
								@forelse($deleted_products as $deleted_product)
									<tr>
										<td>{{$loop->index + 1}}</td>
										<td>{{$deleted_product->product_name}}</td>
										<td>{{str_limit($deleted_product->product_description,10)}}</td>
										<td>{{$deleted_product->product_price}}</td>
										<td>{{$deleted_product->product_quantity}}</td>
										<td>{{$deleted_product->alert_quantity}}</td>
										<td>
											<div class="btn-group" role="group" area-label="Basic Example">
												
											<a href="{{ url('restore/product') }}/{{ $deleted_product->id }}" class="btn  btn-success">Restore</a>
											&nbsp;
											<a href="{{ url('permanently_delete/product') }}/{{ $deleted_product->id }}" class="btn  btn-danger">Permanent delete</a>
											</div>
										
											
										</td>
										
									</tr>
									@empty
									<tr class="text-center text-danger">
										<td colspan="9"> No data available </td>
									</tr>
								@endforelse
								
							</tbody>
						</table>
						{{$products->links() }}
					</div>
				</div>
			</div>
		</div>
	
	
@endsection