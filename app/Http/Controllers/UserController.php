<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
 use Illuminate\Support\Facades\Validator;
use Hash;

class UserController extends Controller
{
	
     public function __construct()
    {
        $this->middleware('auth');
    }
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::latest()->paginate(5);
        return view('users.all', compact('users'));
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
          return view('users.create');
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
         $validatedData =  Validator::make($request->all(),[
        'name' => 'required|max:40',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6'
    ]);
          if ($validatedData->fails()) {
            return redirect('users/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        $inputs=[
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ];
       if(User::create($inputs)){
 
        return  redirect('users'); //This is users Route
      }
    }
 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
		 $user = User::find($id);
         return view('users.view', compact('user'));
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
		$user= User::find($id);
		return view('users.update', compact('user'));	//users.update is folder and file name
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
		$validatedData = Validator::make($request->all(), [
			'name' => 'required|max:40',
			'email' => 'required|email',
			'password' => 'required|min:6'
		]);
		
		if ($validatedData->fails()) {
           return redirect('users/create')
                       ->withErrors($validatedData)
                       ->withInput();
       }
	   
	    $inputs=[
           'name' => $request['name'],
           'email' => $request['email'],
           'password' => Hash::make($request['password']),
       ];
		User::find($id)->update($inputs);
 
		return redirect("users");
   
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete
		User::find($id)->delete();
		return redirect("users");
		
    }
	
	
	//Laravel File Upload with Validation
	public function uploadFile(){
		return view('uploadFileView');
	}
	
	public function uploadFileMethod(Request $request){
		$request->validate([
			'fileToUploadName' => 'required|file|max:1024',
		]);
		$request->fileToUploadName->store('logos');
		return back()->with('success','You have already successfully uploaded a file');
	}
 
}