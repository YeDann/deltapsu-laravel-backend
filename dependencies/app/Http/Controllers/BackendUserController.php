<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Validator;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;
class BackendUserController extends Controller
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
        $users = DB::table('users')
            ->select('users.*')
            ->where('users.id', '!=', 1)
            ->get();
            $user = auth()->user();
        $language = DB::table('language')->get();

        return view('user.backenduser')
            ->with('name', 'User')
            ->with('users', $users)
            ->with('language', $language)
            ->with('menu', 'backenduser');
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = DB::table('language')->get();
        $countries = DB::table('countries')->get();
        return view('user.createUser')
        ->with('name', 'User')
        ->with('menu', 'backenduser')
        ->with('countries',$countries)
        ->with('language',$language);
    }
    public function store(Request $request){
         
        $validate = Validator::make($request->all(), [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'companyName' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'fax' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        } else {
            $stemail = $request->email;
            $email = strtolower($stemail);
            $olddata = DB::table('users')->where('email',trim($email))->get();
            if(count($olddata) == 0){
                User::create([
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'position' => $request->position,
                    'companyName' => $request->companyName,
                    'phone' => $request->phone,
                    'fax' => $request->fax,
                    'lang' => $request->role,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
                return redirect()->route('backendUser.index')->with('flash_message', 'Insert Data successfully');
            }else{
                return redirect()->back()->withErrors(['email'=>'Dupplicate email']);
            }
       
        }
      
        return redirect()->route('backendUser.index')->with('error_message', 'Error');
    }
       /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $language = DB::table('language')->get();
        $user = DB::table('users')
        ->select('users.*')
        ->where('users.id',$id)
        ->first();
        $countries = DB::table('countries')->get();
        // return dd($user);

        return view('user.editUser')
        ->with('name', 'User')
        ->with('menu', 'backenduser')
        ->with('user',$user)
        ->with('countries',$countries)
        ->with('language',$language);
    }
    public function update(Request $request){
       
             $id  = $request->userId;
            //  return dd($id);
        $validate = Validator::make($request->all(), [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'companyName' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'fax' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        } else {
         
               if($request->password != null){
                User::where('id', $id)->update([
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'position' => $request->position,
                    'companyName' => $request->companyName,
                    'phone' => $request->phone,
                    'fax' => $request->fax,
                    'lang' => $request->role,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
               }else{
                User::where('id', $id)->update([
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'position' => $request->position,
                    'companyName' => $request->companyName,
                    'phone' => $request->phone,
                    'fax' => $request->fax,
                    'lang' => $request->role,
                    'email' => $request->email
                ]);
               }

                return redirect()->route('backendUser.index')->with('flash_message', 'Insert Data successfully');
            
       
        }
      
        return redirect()->route('backendUser.index')->with('error_message', 'Error');

    }
    public function updatestatusbackend($id){
        $user = DB::table('users')
        ->select('users.*')
        ->where('users.id',$id)
        ->first();

       if($user->status == 1){
        User::where('id', $id)->update([
            'status' =>  0,
        ]);
        return response()->json([
            'data' =>  'Deactive',
                ], 200);
       }else{
        User::where('id', $id)->update([
            'status' => 1,
        ]);
        return response()->json([
            'data' =>  'Active',
                ], 200);
       }
    }
    public function destroy(Request $request){
       $id =  $request->itemId;
    //    return dd($id);
       $user = DB::table('users')
       ->where('users.id',$id)
       ->delete();                                                                                                                                                                                                                                                                 
       return redirect()->route('backendUser.index')->with('flash_message', 'Delete Data successfully');
    }

}