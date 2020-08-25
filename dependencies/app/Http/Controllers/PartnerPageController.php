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
class PartnerPageController extends Controller
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

        $static_content = DB::table('partner_page_info as pi')
        ->join('partner_page_info_translation as pit','pit.fk_p_id','=','pi.id')
        ->select('pi.*','pit.*')
        ->where('pit.local' ,'en')
        ->get();
     
        $language = DB::table('language')->get();

        return view('partners.page_info_index')
        ->with('name','partnersAuthenicate')
        ->with('menu','page_info')
        ->with('static_content',$static_content)
        ->with('language',$language);
    }

    public function page_info_edit($id){

        $static_content = DB::table('partner_page_info as pi')
        ->join('partner_page_info_translation as pit','pit.fk_p_id','=','pi.id')
        ->where('pi.id',$id)
        ->select('pi.*','pit.*')
        ->get();
        $language = DB::table('language')->get();
        return view('partners.page_info_edit')
        ->with('name','partnersAuthenicate')
        ->with('menu','page_info')
        ->with('static_content',$static_content)
        ->with('language',$language);
    }
    public function page_info_create(){
        $language = DB::table('language')->get();
        return view('partners.page_info_create')
        ->with('name','partnersAuthenicate')
        ->with('menu','page_info')
        ->with('language',$language);
    }
 

    private function  SaveimageArray($arrayfile ,$arrfilename){
        $arrayfileName = [];
      foreach ($arrfilename as $key => $value) {
              $emptyornot = isset($arrayfile[$value]);
              if($emptyornot){
              $fileName = preg_replace('/\s+/', '', uniqid().$arrayfile[$value]->getClientOriginalName());
              $arrayfile[$value]->move(base_path('/../medias/static_content'),$fileName);
              $arrayfileName[$value] = $fileName;
              }else{
               $fileName = '';
               $arrayfileName[$value] = $fileName;
              }
      }
      return $arrayfileName;
  }
  private function  updateoldImage($arrayfile , $oldfile ,$arrfilename){
    $arrayfileName = [];
  foreach ($arrfilename as $key => $value) {
          $emptyornot = isset($arrayfile[$value]);
          if($emptyornot){
            $file_pointer = base_path('/../medias/static_content/').$oldfile[$key];
            // return dd(file_exists($file_pointer));
            if (file_exists($file_pointer) && $oldfile[$key] != null ) {
                unlink($file_pointer);
                $fileName = preg_replace('/\s+/', '', uniqid().$arrayfile[$value]->getClientOriginalName());
                $arrayfile[$value]->move(base_path('/../medias/static_content'),$fileName);
                $arrayfileName[$value] = $fileName;
            }else{
                $fileName = preg_replace('/\s+/', '', uniqid().$arrayfile[$value]->getClientOriginalName());
                $arrayfile[$value]->move(base_path('/../medias/static_content'),$fileName);
                $arrayfileName[$value] = $fileName;
            }
          }else{
            $arrayfileName[$value] = $oldfile[$value];     
          } 
  }
  return $arrayfileName;
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
       $lang_loop = $request->lang_loop;
       $title = $request->title;
       $content  = $request->content;
       $meta_title = $request->meta_title;
       $meta_desc  = $request->meta_desc;
       $meta_key  = $request->meta_key;
       $status  = $request->status;
       $filename = $request->filename;
       $fileimage = $request->fileimage;

       $arrayfileName = self::SaveimageArray($fileimage,$filename);
       if(isset($arrayfileName)){
        $filename =  $arrayfileName['icon'];
        }else{
         $filename = '';
        }
       $id  = DB::table('partner_page_info')->insertGetID(
        [
            "status" => $status,
            "meta_title" => $meta_title,
            "meta_description" =>$meta_desc,
            "meta_keyword" => $meta_key,
            "icon" => $filename,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]
    );
        foreach($lang_loop as $lang){
            DB::table('partner_page_info_translation')->insert(
                [
                    "fk_p_id" => $id,
                    "title" => $title,
                    "content" => $content,
                    "local" => $lang
                ]
            );
        }
    return redirect()->route('partner_page')->with('flash_message', 'Insert Data successfully');
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->page_id;
       $lang_loop = $request->lang_loop;
    //    return dd($lang_loop);
       $title = $request->title;
       $content  = $request->content;
       $meta_title = $request->meta_title;
       $meta_desc  = $request->meta_desc;
       $meta_key  = $request->meta_key;
       $status  = $request->status;
       $filename = $request->filename;
       $fileimage = $request->fileimage;
       $oldfile  = $request->oldfile;
       $arrayfileName = self::updateoldImage($fileimage,$oldfile,$filename);
       if(isset($arrayfileName)){
           $filename =  $arrayfileName['icon'];
       }else{
           $filename = '';
       }
       DB::table('partner_page_info')->where('id',$id)->update(
        [
            "status" => $status,
            "meta_title" => $meta_title,
            "meta_description" =>$meta_desc,
            "icon" => $filename,
            "meta_keyword" => $meta_key,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]
      );
        foreach($lang_loop as $lang){
            DB::table('partner_page_info_translation')->where('local',$lang)->update(
                [
                    "fk_p_id" =>$id,
                    "title" => $title[$lang],
                    "content" => $content[$lang],
                    "local" => $lang
                ]
            );
        }
        return redirect()->route('partner_page')->with('flash_message', 'Update Data successfully');
    }
    public function deteletepartpage(Request $request){
        $id = $request->itemId;
        DB::table('partner_page_info')->where('id',$id)->delete();
        DB::table('partner_page_info_translation')->where('fk_p_id',$id)->delete();
        return redirect()->route('partner_page')->with('flash_message', 'Delete Data successfully');
    }



}