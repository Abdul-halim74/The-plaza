@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-6 offset-3">
				<div class="card">
					<div class="card-header bg-success">
						Edit product form
						
					</div>
					
					<div class="card-body">
						
						@if(session('editStatus'))
							<div class="alert alert-success">
								{{ session('editStatus') }}
							</div>
						@endif
						<form action="{{ url('edit/product/insert') }}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
								<label for="">Product name</label>
								<input type="hidden" name="product_id" value="{{$single_product_info->id}}"/>
								<input type="text" class="form-control" name="product_name" value="{{ $single_product_info->product_name }}" placeholder="enter your product name" />
							</div>
							<div class="form-group">
								<label for="">Product Description</label>
								<textarea class="form-control" name="product_description" id=""  rows="3">{{ $single_product_info->product_description }}</textarea>
							</div>
							<div class="form-group">
								<label for="">Product Price</label>
								<input type="text" class="form-control" name="product_price" value="{{ $single_product_info->product_price }}" placeholder="enter your product price" />
							</div>
							<div class="form-group">
								<label for="">Product Quantity</label>
								<input type="text" class="form-control" name="product_quantity" value="{{$single_product_info->product_quantity}}" placeholder="enter your product quantity" />
							</div>
							<div class="form-group">
								<label for="">Alert Quantity</label>
								<input type="text" class="form-control" name="alert_quantity" value="{{$single_product_info->alert_quantity}}" placeholder="enter your Alert quantity" />
							</div>
							<div class="form-group">
								<label for="">Product Image</label>
								<input type="file" class="form-control" name="product_image"  />
								<img src="{{ asset('uploads/products_photos') }}/{{$single_product_info->product_image}}" alt="Not found" width="50"/>
							</div>
							<button type="submit" class="btn btn-warning"> Edit Product </button>
						</form>
					</div>
				</div>
			</div>
			
		</div>
	
	</div>
@endsection