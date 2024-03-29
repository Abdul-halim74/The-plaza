@extends('layouts/frontendapp')

@section('frontend_content')

	<!-- Page Info -->
		<div class="page-info-section page-info">
			<div class="container">
				<div class="site-breadcrumb">
					<a href="">Home</a> / 
					<a href="">Sales</a> / 
					<a href="">Bags</a> / 
					<span>Cart</span>
				</div>
				<img src="img/page-info-art.png" alt="" class="page-info-art">
			</div>
		</div>
		<!-- Page Info end -->
	
	<!-- Page -->
	<div class="page-area cart-page spad">
		<div class="container">
			<div class="cart-table">
				<table>
					<thead>
						<tr>
							<th class="product-th">Product</th>
							<th>Price</th>
							<th>Quantity</th>
							<th class="total-th">Total</th>
						</tr>
					</thead>
					<tbody>
						@forelse($cart_items as $cart_item)
						<tr>
							<td class="product-col">
								<img src="{{asset('uploads/products_photos')}}/{{$cart_item->relationTocart->product_image}}" alt="Image Not found" width="50">
								<div class="pc-title">
								{{--<h4>{{App\Product::find($cart_item->product_id)->product_name}}</h4>p-10 --}}
								
									<h4>{{$cart_item->relationTocart->product_name}}</h4>
									<a href="{{ url('delete/from/cart') }}/{{$cart_item->id}}">Delete Product</a>
										
									@if($cart_item->relationTocart->product_quantity == 0)
										<div class="alert alert-danger">
											Please, delete this product .because, this product is unavailable
									</div>
									@endif	
								</div>
							</td>
							<td class="price-col">${{$cart_item->relationTocart->product_price}}</td>
							<td class="quy-col">
								<div class="quy-input">
									<span>Qty</span>
									<input type="number" value="{{$cart_item->product_quantity}}">
								</div>
							</td>
							<td class="total-col">${{($cart_item->relationTocart->product_price) * $cart_item->product_quantity}} </td>
						</tr>
						@empty
							<tr>
								<td class="text-warning">No Product to show</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>
			<div class="row cart-buttons">
				<div class="col-lg-5 col-md-5">
					<div class="site-btn btn-continue">
						<a class="text-white" href="{{url('/')}}">Continue shooping</a> 
					</div>
				</div>
				<div class="col-lg-7 col-md-7 text-lg-right text-left">
					<div class="site-btn btn-clear">
						<a href="{{url('clear/cart')}}">Clear cart</a>	
					</div>
					<div class="site-btn btn-line btn-update">Update Cart</div>
				</div>
			</div>
		</div>
		<div class="card-warp">
			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<div class="shipping-info">
							<h4>Shipping method</h4>
							<p>Select the one you want</p>
							<div class="shipping-chooes">
								<div class="sc-item">
									<input type="radio" name="sc" id="one">
									<label for="one">Next day delivery<span>$4.99</span></label>
								</div>
								<div class="sc-item">
									<input type="radio" name="sc" id="two">
									<label for="two">Standard delivery<span>$1.99</span></label>
								</div>
								<div class="sc-item">
									<input type="radio" name="sc" id="three">
									<label for="three">Personal Pickup<span>Free</span></label>
								</div>
							</div>
							<h4>Cupon code</h4>
							<p>Enter your cupone code</p>
							<div class="cupon-input">
								<input type="text">
								<button class="site-btn">Apply</button>
							</div>
						</div>
					</div>
					<div class="offset-lg-2 col-lg-6">
						<div class="cart-total-details">
							<h4>Cart total</h4>
							<p>Final Info</p>
							<ul class="cart-total-card">
								<li>Subtotal<span>$59.90</span></li>
								<li>Shipping<span>Free</span></li>
								<li class="total">Total<span>$59.90</span></li>
							</ul>
							<a class="site-btn btn-full" href="checkout.html">Proceed to checkout</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Page end -->

@endsection