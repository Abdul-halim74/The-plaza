<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User, App\Contact;;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
	
	public function contactmessageview(){
		$contactmessages= Contact::paginate(5);
		return view('contact/view', compact('contactmessages'));
	}
	
	public function readmessage($msg_id){
		//echo Contact::find($msg_id);
		if(Contact::find($msg_id)->read_status==1){
			Contact::find($msg_id)->update([
				'read_status'=> 2,
			]);
			return back();
		}
	}
}
