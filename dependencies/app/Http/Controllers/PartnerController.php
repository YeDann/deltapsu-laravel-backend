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
use Excel;
use File;
class PartnerController extends Controller
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
        $users = DB::table('partner')
            ->select('partner.*')
            ->get();
        $language = DB::table('language')->get();

        return view('user.partner')
            ->with('name', 'User')
            ->with('users', $users)
            ->with('language', $language)
            ->with('menu', 'partner');
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
        return view('user.createpartner')
        ->with('name', 'User')
        ->with('menu', 'partner')
        ->with('countries',$countries)
        ->with('language',$language);
    }
    public function store(Request $request){
        //  return dd('de');
        $validate = Validator::make($request->all(), [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'companyName' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'fax' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:partner'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        } else {
            $stemail = $request->email;
            $email = strtolower($stemail);
            $olddata = DB::table('partner')->where('email',trim($email))->get();
            // return dd( $olddata);
            if(count($olddata) == 0){
                DB::table('partner')->insert([
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'position' => $request->position,
                    'companyName' => $request->companyName,
                    'phone' => $request->phone,
                    'fax' => $request->fax,
                    'role' => $request->role,
                    'email' => $request->email,
                    'country' => $request->country,
                    'password' => Hash::make($request->password),
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                ]);
                return redirect()->route('partner.index')->with('flash_message', 'Insert Data successfully');
            }else{
                return redirect()->back()->withErrors(['email'=>'Dupplicate email']);
            }
       
        }
      
        return redirect()->route('partner.index')->with('error_message', 'Error');
    }
       /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $language = DB::table('language')->get();
        $user = DB::table('partner')
        ->select('partner.*')
        ->where('partner.id',$id)
        ->first();
        $countries = DB::table('countries')->get();
        // return dd($user);

        return view('user.editPartner')
        ->with('name', 'User')
        ->with('menu', 'partner')
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
                DB::table('partner')->where('id', $id)->update([
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'position' => $request->position,
                    'companyName' => $request->companyName,
                    'phone' => $request->phone,
                    'fax' => $request->fax,
                    'role' => $request->role,
                    'email' => $request->email,
                    'country' => $request->country,
                    'password' => Hash::make($request->password),
                    "updated_at" => \Carbon\Carbon::now(),
                ]);
               }else{
                DB::table('partner')->where('id', $id)->update([
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'position' => $request->position,
                    'companyName' => $request->companyName,
                    'phone' => $request->phone,
                    'fax' => $request->fax,
                    'role' => $request->role,
                    'country' => $request->country,
                    'email' => $request->email,
                    "updated_at" => \Carbon\Carbon::now(),
                ]);
               }

                return redirect()->route('partner.index')->with('flash_message', 'Insert Data successfully');
            
       
        }
      
        return redirect()->route('partner.index')->with('error_message', 'Error');

    }
    public function updatestatuspartner($id){
        $user = DB::table('partner')
        ->select('partner.*')
        ->where('partner.id',$id)
        ->first();

       if($user->status == 1){
        DB::table('partner')->where('id', $id)->update([
            'status' =>  0,
        ]);
        return response()->json([
            'data' =>  'Deactive',
                ], 200);
       }else{
        DB::table('partner')->where('id', $id)->update([
            'status' => 1,
        ]);
        return response()->json([
            'data' =>  'Active',
                ], 200);
       }
    }
    public function successStory(){
        $AllsuccessStory =  DB::table('success_storys as s')
        ->select('s.*')
        ->orderBy('s.created_at', 'desc')
        ->where('s.status' ,1)
        ->get();

        $image_story =  DB::table('success_storys_image as ssi')
        ->select('ssi.*')
        ->get();

        return view('partners.sucessStories')
        ->with('name','partnersAuthenicate')
        ->with('menu', 'succesStory')
        ->with('image_story' ,$image_story)
        ->with('AllsuccessStory' ,$AllsuccessStory);
    }
    public function sucess_story_edit($id){

        $AllsuccessStory =  DB::table('success_storys as s')
        ->select('s.*')
        ->orderBy('s.created_at', 'desc')
        ->where('s.id' ,$id) 
        ->get();

        $models = $AllsuccessStory[0]->modelname;
        $arrModel = explode(",", $models);

        // return dd($arrModel);

        $image_story =  DB::table('success_storys_image as ssi')
        ->select('ssi.*')
        ->where('ssi.fk_story_id' ,$id)
        ->get();

        $products = DB::table('products as p')
        ->select('p.*')
        ->orderBy('p.created_at', 'desc')
        ->get();

        $countries = DB::table('countries')
        ->select('countries.*')
        ->get();

        return view('partners.sucessStories_edit')
        ->with('name','partnersAuthenicate')
        ->with('menu', 'succesStory')
        ->with('image_story' ,$image_story)
        ->with('arrModel' ,$arrModel)
        ->with('products' ,$products)
        ->with('countries' ,$countries)
        ->with('AllsuccessStory' ,$AllsuccessStory);

    }
    public function succes_stories_update(Request $request){
        $story_id_main  = $request->story_id_main;
        $model = $request->model;
        $modeltext =  implode(",",$model);
        if($story_id_main != null){
           DB::table('success_storys')->where('id',$story_id_main)->update(
               [
                   'modelname' =>  $modeltext,
                   'application' => $request->application,
                   'endCustomer' => $request->endCustomer,
                   'message' => $request->message,
                   'country' => $request->country,
                   "updated_at" => \Carbon\Carbon::now(),
               ]
           );
           return redirect()->route('successStory')->with('flash_message', 'Update Data successfully');
        }else{
            return redirect()->route('successStory')->with('flash_message', 'No Update');
        }
    }
    public function deteleteSuccessStories(Request $request){
        $id = $request->itemId;

        $story = DB::table('success_storys')->where('id',$id)->get();
        $data_image = DB::table('success_storys_image')->where('fk_story_id' ,$id)->get();
         if(count($data_image) > 0){
           DB::table('success_storys_image')->where('id',$id)->delete();
           foreach($data_image as $item){
               $file_pointer = base_path('/../medias/marketing_resources/').$item->image;
               if (file_exists($file_pointer) && isset($item->image) ) {
                   unlink($file_pointer);
                   DB::table('success_storys_image')->where('id' ,$item->id)->delete();
               }
           }
          }
          DB::table('success_storys')->where('id',$id)->delete();

          return redirect()->route('successStory')->with('flash_message', 'Delete Data successfully');
    }
    public function storyImage($id){
        $image_story =  DB::table('success_storys_image as ssi')
        ->select('ssi.*')
        ->where('ssi.fk_story_id' ,$id)
        ->get();
        return view('partners.imageStory')
        ->with('name','partnersAuthenicate')
        ->with('menu', 'succesStory')
        ->with('story_id', $id)
        ->with('image_story' ,$image_story);
    }
    public function uploadImageStory(Request $request){
   
        $story_id = $request->story_id;
        if ($request->hasFile('file')) {
            $image = $request->file('file'); 
            $imgName = uniqid().".".$image->getClientOriginalExtension();
            $image->move(base_path('/../medias/marketing_resources'),$imgName);
       
            DB::table('success_storys_image')->insert(
                [
                    'fk_story_id' => $story_id,
                    'image' =>  $imgName,
              ]);

              return response()->json([
                'status' => 1,
             ], 200);
        }
        return response()->json([
            'status' => 0,
         ], 200);
    }
    public function deleteImageStory_back(Request $request){
        $story_id = $request->story_id;
        $id = $request->itemId;
     
        $data = DB::table('success_storys_image')->where('id' ,$id)->get();
        $file_pointer = base_path('/../medias/marketing_resources/').$data[0]->image;
        if (file_exists($file_pointer) && isset($data[0]->image) ) {
            unlink($file_pointer);
            DB::table('success_storys_image')->where('id' ,$id)->delete();
            return redirect()->route('storyImage',$story_id)->with('flash_message', 'Delete Data successfully');
          
        }else{
            return redirect()->route('storyImage',$story_id)->with('flash_message', 'No image');
        }
    }
    public function  ExportPartner(){

        $users = DB::table('partner')
        ->select('partner.*')
        ->get();

        if(isset($users)){
            Excel::create('Partner', function ($excel) use ($users) {
              $excel->sheet('Partner', function ($sheet) use ($users) {
                  $sheet->row(1,[
                      'No',
                      'Firstname',
                      'Lastname',
                      'Email',
                      'Position',
                      'CompanyName',
                      'Phone',
                      'Fax',
                      'country',
                      'Role',
                      'created_at'
                  ]);
                  $i = 2;
                  $j = 1;
                  foreach ($users as $user) {
                  
                       
                         if($user->role == 1){
                             $role = 'Distributor';
                         }else{
                             $role = 'FES';
                         }
                          $sheet->row($i, [
                              $j,
                              $user->firstname,
                              $user->lastname,
                              $user->email,
                              $user->position,
                              $user->companyName,
                              $user->phone,
                              $user->fax,
                              $user->country,
                              $role,
                              $user->created_at,
                          ]);
                          $i++;
                          $j++;
                  }
              });
          })->export('csv');

          }else{
            return redirect()->route('partner.index')->with('flash_message', 'No Data');
          }
    }

    public function destroy(Request $request){
        $id =  $request->itemId;
        $user = DB::table('partner')
        ->where('partner.id',$id)
        ->delete();                                                                                                                                                                                                                                                                 
        return redirect()->route('partner.index')->with('flash_message', 'Delete Data successfully');
     }

}