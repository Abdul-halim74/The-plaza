<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Image;
class ProductController extends Controller
{
    //
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	function addproductview(){
		$products=Product::paginate(3);
		$deleted_products= Product::onlyTrashed()->get();
		$categories = Category::all();
		return view('product/view', compact('products','deleted_products','categories'));
		
	}
	
	function addproductinsert(Request $request){
		//echo $r->product_name;
		
		$request->validate([
			'category_id'=>'required',
			'product_name'=>'required',
			
			'product_description'=>'required',
			'product_price'=>'required|numeric',
			'product_quantity'=>'required|numeric',
			'alert_quantity'=>'required|numeric',
		]);
		$last_inserted_id = Product::insertGetId([
			'category_id'=>$request->category_id,
			'product_name'=>$request->product_name,
			
			'product_description' => $request->product_description,
			'product_price' => $request->product_price,
			'product_quantity' => $request->product_quantity,
			'alert_quantity' => $request->alert_quantity,
			'created_at'=>now(),
			'updated_at'=>now(),
			
		]);
		
		
		if($request->hasFile('product_image')){
			//echo $last_inserted_id;
			$photo_to_upload = $request->product_image;
			$filename=$last_inserted_id.".".$photo_to_upload->getClientOriginalExtension();
			
			Image::make($photo_to_upload)->resize(400,450)->save(base_path('public/uploads/products_photos/'.$filename));
			Product::find($last_inserted_id)->update([
				'product_image' => $filename,
			]);
		}
		
		 return back()->with('status','Product Insert Successfully');
		
	}
	
	function deleteproduct($product_id){
		//echo $product_id;
		
		//Product::where('id', $product_id)->delete();
		
		Product::find($product_id)->delete();
		return back()->with('deleteStatus', 'Product deleted successfully');
	}
	
	function restoreproduct($product_id){
		//echo $product_id;
		Product::onlyTrashed()->where('id',$product_id)->restore();
		return back()->with('restore','restore successfully');
	}
	
	function permanently_deleteproduct($product_id){
				$delete_this_file = Product::onlyTrashed()->find($product_id)->product_image;
				unlink(base_path('public/uploads/products_photos/'.$delete_this_file));
		Product::onlyTrashed()->where('id',$product_id)->forceDelete();
		return back()->with('forceDelete','Permanent deleted successfully');
	}
	
	function editproduct($product_id){
		//echo $product_id;
		$single_product_info= Product::findOrFail($product_id);
		return view('product/edit', compact('single_product_info'));
	}
	
	function editproductinsert(Request $request){
		//print_r($request->all());
		//echo $request->product_name;
		if($request->hasFile('product_image')){
			
			if( Product::find($request->product_id)->product_image == 'defaultProductPhoto.jpg'){
				$photo_to_upload = $request->product_image;
				$filename=$request->product_id.".".$photo_to_upload->getClientOriginalExtension();
				
				Image::make($photo_to_upload)->resize(400,450)->save(base_path('public/uploads/products_photos/'.$filename));
				Product::find($request->product_id)->update([
					'product_image' => $filename,
				]);
			
				
			}
			else{
				//At first delete the old photo
				$delete_this_file = Product::find($request->product_id)->product_image;
				unlink(base_path('public/uploads/products_photos/'.$delete_this_file));
				
				//now insert new photo
				$photo_to_upload = $request->product_image;
				$filename=$request->product_id.".".$photo_to_upload->getClientOriginalExtension();
				
				Image::make($photo_to_upload)->resize(400,450)->save(base_path('public/uploads/products_photos/'.$filename));
				Product::find($request->product_id)->update([
					'product_image' => $filename,
				]);
			}
		}
		
		 Product::find($request->product_id)->update([
			'product_name'=>$request->product_name,
			'product_description' => $request->product_description,
			'product_price' => $request->product_price,
			'product_quantity' => $request->product_quantity,
			'alert_quantity' => $request->alert_quantity,
			'updated_at'=>now(),
		]);
		return back()->with('editStatus', 'Product Updated successfully');
		
		
	}
}
