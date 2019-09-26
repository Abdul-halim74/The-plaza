<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Product;
use App\Category;
use App\Contact;
use App\Order;

use App\Mail\ContactMessage;

class FrontendController extends Controller
{
    //
	function index(){
		$products = Product::all();
		$categories= Category::all();
		return view('welcome',compact('products','categories'));
	}
	
	function productdetails($product_id){
		$single_product_info= Product::find($product_id);
		//echo $single_product_info->category_id;
		$related_products= Product::where('id', '!=', $product_id)->where('category_id',$single_product_info->category_id)->get();
		//echo $product_id;
		return view('frontend/productdetails', compact('single_product_info','related_products'));
	}
	
	function contact(){
		return view('contact');
	}
	
	function contactinsert(Request $request){
		//send mail to the company
		 
		Contact::insert($request->except('_token'));
		
		$message= $request->message;
		
		 Mail::to('halimkhanfeni7@gmail.com')->send(new ContactMessage($message));
		 
		return back()->with('status','Message sent successfully');
	}
	
}
