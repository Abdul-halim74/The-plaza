<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
class CartController extends Controller
{
    function addtocart($product_id){
		$ip_address = $_SERVER['REMOTE_ADDR'];
		
		if(Cart::where('customer_ip',$ip_address)->where('product_id',$product_id)->exists()){
			Cart::where('customer_ip',$ip_address)->where('product_id',$product_id)->increment('product_quantity',1);
		}
		else{
			Cart::insert([
			'customer_ip'=>$ip_address,
			'product_id'=>$product_id,
			'created_at'=>now(),
		]);
		
		}
		return back();
	}
	
	function cart(){
		$cart_items = Cart::where('customer_ip', $_SERVER['REMOTE_ADDR'])->get();
		return view('frontend/cart',compact('cart_items'));
	}
	
	function deletefromcart($cart_id){
		//echo $cart_id;
		Cart::find($cart_id)->delete();
		return back();
	}
	function clearcart(){
		//echo $cart_id;
		Cart::where('customer_ip', $_SERVER['REMOTE_ADDR'])->delete();
		return back();
	}
	
}
