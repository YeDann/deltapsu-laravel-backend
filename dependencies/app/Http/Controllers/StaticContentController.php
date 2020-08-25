<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;

class StaticContentController extends Controller
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
    public function index($typeid)
    {
        // return dd($typeid);
        $static_content = DB::table('static_content as st')
        ->join('static_content_translations as sct','st.sta_id','=','sct.sta_fk_id')
        ->where('type_con_id',$typeid)
        ->select('st.*','sct.*')
        ->get();
    
        $userdata = auth()->user();
        if($userdata->lang == 'All'){
            $language = DB::table('language')->get();
        }else{
            $language = DB::table('language')->where('name',$userdata->lang)->get();
        }
           $menuName = 'Home';
           $menu  = 'static_content';
           $submenu  = '';
        if($typeid == 5 ){
            $menuName = 'setting';
            $menu  = 'privacyPoli';
        }else if($typeid == 6 ){
            $menuName = 'setting';
            $menu  = 'termsofuse';
        }
        else if($typeid == 7 ){
            $menuName = 'Resource';
            $menu  = 'faq';
            $submenu  = 'faqbanner';
        }
        

        return view('static_content.index')
        ->with('name', $menuName)
        ->with('menu',$menu)
        ->with('submenu', $submenu)
        ->with('typeid',$typeid)
        ->with('static_content',$static_content)
        ->with('language',$language);
    }

       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function video_guidline($typeid)
    {
        // return dd($typeid);
        $static_content = DB::table('static_content as st')
        ->join('static_content_translations as sct','st.sta_id','=','sct.sta_fk_id')
        ->where('type_con_id',$typeid)
        ->select('st.*','sct.*')
        ->get();
        // return dd($static_content);
        $language = DB::table('language')->get();

        return view('partners.video_guide')
        ->with('name','partnersAuthenicate')
        ->with('menu','videoGuideLine')
        ->with('typeid',$typeid)
        ->with('static_content',$static_content)
        ->with('language',$language);
    }


    public function popUp($typeid)
    {
        // return dd($typeid);
        $static_content = DB::table('static_content as st')
        ->join('static_content_translations as sct','st.sta_id','=','sct.sta_fk_id')
        ->where('type_con_id',$typeid)
        ->select('st.*','sct.*')
        ->get();
        $userdata = auth()->user();
        if($userdata->lang == 'All'){
            $language = DB::table('language')->get();
        }else{
            $language = DB::table('language')->where('name',$userdata->lang)->get();
        }

        return view('popup.index')
        ->with('name','Home')
        ->with('menu','popUp')
        ->with('typeid',$typeid)
        ->with('static_content',$static_content)
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
       $typeId = $request->type_id;
       $con_id = $request->con_id;
       $lang_loop = $request->lang_loop;
       $name = $request->name;
       $content  = $request->content;
       $filename = $request->filename;
       $fileimage = $request->fileimage;
       $oldfile  = $request->oldfile;
       $status  = $request->status;
       if($status == null){
           $status == 1;
       }
    //    return dd($fileimage);
     
       if($con_id == null){
        $arrayfileName = self::SaveimageArray($fileimage,$filename);
        $id  = DB::table('static_content')->insertGetID(
            [
                "type_con_id" => $typeId,
                "destop_image" => $arrayfileName['destop'],
                "status" => $status,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]
        );
        foreach($lang_loop as $lang){
            DB::table('static_content_translations')->insert(
                [
                    "sta_fk_id" => $id,
                    "title" => $name[$lang],
                    "content" => $content[$lang],
                    "local" => $lang
                ]
            );
        }
        
        return back()->with('flash_message', 'Create Data successfully');

       }else{

        $arrayfileName = self::updateoldImage($fileimage,$oldfile,$filename);

       DB::table('static_content')->where('sta_id',$con_id)->update(
            [
                "type_con_id" => $typeId,
                "destop_image" => $arrayfileName['destop'],
                "status" => $status,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]
        );
        foreach($lang_loop as $lang){
            DB::table('static_content_translations')->where('sta_fk_id',$con_id)->where('local',$lang)->update(
                [
                    "title" => $name[$lang],
                    "content" => $content[$lang],
                ]
            );
        }
        
          return back()->with('flash_message', 'Update Data successfully');

       }
    
       return back()->with('error_message', 'No update');
    }
    public function uploadtoTexteditor(Request $request){
        $file = $request->file;
        $url = null;
        $fileName = null;
        if($request->hasFile("file")&& isset($file)){
            $fileName = preg_replace('/\s+/', '', time().''.$file->getClientOriginalName());
            $file->move(base_path('/../editor_file'),$fileName);
        }
        if($fileName){
            $url = config('app.url').'/editor_file/'.$fileName;
        }
        
        return response()->json([
            'url' => $url
                ], 200);

    }

  
}
