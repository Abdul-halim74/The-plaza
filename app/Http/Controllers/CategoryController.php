<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
class CategoryController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	
    function addCategoryView(){
		$categories= Category::all();
		return view('category/view', compact('categories'));
	}
	
	function addCategoryInsert(Request $request){
		$request->validate([
			'category_name' => 'required|regex:/(^([a-zA-Z]+)(\d+)?$)/u|unique:categories,category_name',
		]);
		//print_r($request->all());
		Category::insert([
			'category_name' => $request->category_name,
			'created_at' =>now(),
			'updated_at' =>now(),
		]);
		return back()->with('status', 'Inserted Successfully ');
	}
	
	function categorywiseproduct($category_id){
		//echo $category_id;
		$products = Product::where('category_id',$category_id)->get();
		return view('frontend/categorywiseproduct',compact('products'));
	}
}
