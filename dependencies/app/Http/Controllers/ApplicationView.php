<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;

class ApplicationView extends Controller
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
        $userdata = auth()->user();
        if($userdata->lang == 'All'){
            $contents = DB::table('application as ap')
            ->join('application_translation as apt','ap.id','=','apt.app_id')
            ->where('apt.local','=','en')
            ->select('ap.*' ,'ap.id as applica_id','apt.*')
            ->orderBy('ap.order_seq' ,'asc')
            ->get();
        }else{
         $contents = DB::table('application as ap')
          ->join('application_translation as apt','ap.id','=','apt.app_id')
           ->where('apt.local','=',$userdata->lang)
           ->select('ap.*' ,'ap.id as applica_id','apt.*')
           ->orderBy('ap.order_seq' ,'asc')
           ->get(); 
        }

        if($userdata->lang == 'All'){
            $language = DB::table('language')->get();
           }else{
            $language = DB::table('language')->where('name',$userdata->lang)->get();
           }  
        return view('application.index')
        ->with('name','application')
        ->with('menu','')
        ->with('language',$language)
        ->with('contents',$contents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $language = DB::table('language')->get();
        return view('application.create')
        ->with('menu','')
        ->with('language',$language)
        ->with('name','application');
    }

  

    private function  SaveimageArray($arrayfile ,$arrfilename){
          $arrayfileName = [];
        foreach ($arrfilename as $key => $value) {
                $emptyornot = isset($arrayfile[$value]);
                if($emptyornot){
                $fileName = preg_replace('/\s+/', '', uniqid().$arrayfile[$value]->getClientOriginalName());
                $arrayfile[$value]->move(base_path('/../medias/categories'),$fileName);
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
                $file_pointer = base_path('/../medias/categories/').$oldfile[$key];
                // return dd(file_exists($file_pointer));
                if (file_exists($file_pointer) && $oldfile[$key] != null ) {
                    unlink($file_pointer);
                    $fileName = preg_replace('/\s+/', '', uniqid().$arrayfile[$value]->getClientOriginalName());
                    $arrayfile[$value]->move(base_path('/../medias/categories'),$fileName);
                    $arrayfileName[$value] = $fileName;
                }else{
                    $fileName = preg_replace('/\s+/', '', uniqid().$arrayfile[$value]->getClientOriginalName());
                    $arrayfile[$value]->move(base_path('/../medias/categories'),$fileName);
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
     
        $fileimage = $request->fileimage;
        $arrfilename = $request->filename;
        $lang_loop = $request->lang_loop;
        $meta_description  =$request->metaDescription;
        $meta_metaTitle  = $request->metaTitle;
        $h1_title = $request->h1_title;
        $re1 = str_replace("/","_",$name);
        $key = str_replace(" ","-",$re1);
        $key2 = $this->clean($key);
        $slug  =  $key2;
        $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        } else {
            $arrayfilesave = self::SaveimageArray($fileimage ,$arrfilename);
            $name = $request->name;
            $content = $request->content;
            $content_2 = $request->content_2;
            $overview = $request->overview;
            $overview_text = $request->overview_text;
            $appId = DB::table('application')->insertGetID(
                [
                    "icon" =>  $arrayfilesave['icon'],
                    "thumbnail" => $arrayfilesave['thumbnail'],
                    "color_icon" => $arrayfilesave['color_icon'],
                    "banner" => $arrayfilesave['banner'],
                    "status" => $request->status,
                    "slug_app" => $slug,
                    "blue_outline_icon" => $arrayfilesave['blue_outline_icon'],
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                ]
            );
         
           foreach($lang_loop as $lang){
            DB::table('application_translation')->insert(
                [
                    "app_id" => $appId,
                    "name" => $name,
                    "overview" => $overview,
                    "content" => $content,
                    "content_2" => $content_2,
                    "h1" => $h1_title,
                    'meta_description' => $meta_description,
                    'meta_title' =>$meta_metaTitle,
                    "overview_text" => $overview_text,
                    "local" => $lang
                ]
            );
           }
           
            return redirect()->route('application-view.index')->with('flash_message', 'Insert Data successfully');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

     
        $userdata = auth()->user();
        if($userdata->lang == 'All'){
        $contents = DB::table('application as ap')
        ->join('application_translation as apt','ap.id','=','apt.app_id')
        ->where('apt.app_id','=',$id)
        ->select('ap.*' ,'ap.id as applica_id','apt.*')
        ->get();
        }else{
            $contents = DB::table('application as ap')
            ->join('application_translation as apt','ap.id','=','apt.app_id')
            ->where('apt.app_id','=',$id)
            ->where('apt.local',$userdata->lang)
            ->select('ap.*' ,'ap.id as applica_id','apt.*')
            ->get();
        }
        if($userdata->lang == 'All'){
            $language = DB::table('language')->get();
           }else{
            $language = DB::table('language')->where('name',$userdata->lang)->get();
           }  

        return view('application.edit')
        ->with('name', "application")
        ->with('menu','')
        ->with('language', $language)
        ->with('contents', $contents);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $appId = $request->appId;
        $fileimage = $request->fileimage;
        $arrfilename = $request->filename;
        $oldfile  =$request->oldfile;
        $arrayfilesave = self::updateoldImage($fileimage ,$oldfile ,$arrfilename);
        $meta_description  =$request->metaDescription;
        $meta_Title  = $request->metaTitle;
        $h1_title = $request->h1_title;
        // return dd($arrayfilesave);
        $lang_loop = $request->lang_loop;

       
        
        $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        } else {
            $name = $request->name;
            $content = $request->content;
            $content_2 = $request->content_2;
            $overview = $request->overview;
            $overview_text = $request->overview_text;

            $re1 = str_replace("/","_",isset($name['en']) ? $name['en'] :'app_'.$appId );
            $key = str_replace(" ","-",$re1);
            $key2 = $this->clean($key);
            $slug  =  $key2;
            // return dd( $slug);
            
         DB::table('application')->where('id' ,$appId)->update(
                [
                    "icon" =>  $arrayfilesave['icon'],
                    "thumbnail" => $arrayfilesave['thumbnail'],
                    "color_icon" => $arrayfilesave['color_icon'],
                    "banner" => $arrayfilesave['banner'],
                    "slug_app" => $slug,
                    "status" => $request->status,
                    "blue_outline_icon" => $arrayfilesave['blue_outline_icon'],
                    "updated_at" => \Carbon\Carbon::now(),
                ]
            );

           foreach($lang_loop as $lang){
           $data = DB::table('application_translation')->where('app_id' ,$appId)->where('local' ,$lang)->get();
           if(count($data) > 0){
            DB::table('application_translation')
            ->where('app_id' ,$appId)
            ->where('local' ,$lang)->update(
                [
                    "name" => $name[$lang],
                    "overview" => $overview[$lang],
                    "content" => $content[$lang],
                    'meta_description' => $meta_description[$lang],
                    'meta_title' =>$meta_Title[$lang],
                    'h1' => $h1_title[$lang],
                    "content_2"=> isset($content_2[$lang])? $content_2[$lang] :$content_2['en'],
                    "overview_text" => $overview_text[$lang],
                    
                ]
            );
           }else{
                DB::table('application_translation')->insert(
                    [
                        'app_id' =>$appId,
                        "name" => $name[$lang],
                        "overview" => $overview[$lang],
                        "content" => $content[$lang],
                        'meta_description' => $meta_description[$lang],
                        'meta_title' =>$meta_Title[$lang],
                        'h1' => $h1_title[$lang],
                        "content_2"=> isset($content_2[$lang])? $content_2[$lang] :$content_2['en'],
                        "overview_text" => $overview_text[$lang],
                        "lang"=>$lang
                        
                    ]
                );
           }
   
           }
           
            return redirect()->route('application-view.index')->with('flash_message', 'Update Data successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('application')->where('id', '=', $id)->delete();
        DB::table('application_translation')->where('app_id','=',$id)->delete();

        return back()->with('flash_message', 'Delete Data successfully');
    }

    public function copyAppsingle(Request $request){
        
        $appId = $request->appId;
        $new_local = $request->language;

        $contentEn = DB::table('application as ap')
        ->join('application_translation as apt','ap.id','=','apt.app_id')
        ->where('apt.local','=','en')
        ->where('ap.id','=',$appId)
        ->select('ap.*','apt.*')
        ->get();

        foreach ($contentEn as $item) {

            $check_local = DB::table('application as ap')
            ->join('application_translation as apt','ap.id','apt.app_id')
            ->where('apt.app_id','=',$item->app_id)
            ->where('apt.local', '=', $new_local)
            ->get();

            if (count($check_local) == 0) {
                DB::table('application_translation')->insert(
                    [
                        "app_id" => $item->app_id,
                        "name" => $item->name,
                        "title" => $item->title,
                        "local" => $new_local
                    ]
                );
            }
        }
        return redirect()->route('application-view.index')->with('flash_message', 'Copy Data successfully');
    }

    public function copyApp(Request $request)
    {
        $new_local = $request->language;

        $contentEn = DB::table('application as ap')
        ->join('application_translation as apt','ap.id','=','apt.app_id')
        ->where('apt.local','=','en')
        ->select('ap.*','apt.*')
        ->get();

        foreach ($contentEn as $item) {
            $check_local = DB::table('application as ap')
            ->join('application_translation as apt','ap.id','apt.app_id')
            ->where('apt.app_id','=',$item->app_id)
            ->where('apt.local', '=', $new_local)
            ->get();

            if (count($check_local) == 0) {
                DB::table('application_translation')->insert(
                    [
                        "app_id" => $item->app_id,
                        "name" => $item->name,
                        "title" => $item->title,
                        "local" => $new_local
                    ]
                );
            }
        }
        return redirect()->route('application-view.index')->with('flash_message', 'Copy Data successfully');
    }
    public function relateApplication($id){
       
        $relatedApp = DB::table('series_has_application as sp')
        ->join('series_translations as st' ,'st.series_id' ,'=' ,'sp.se_id')
        ->where('sp.app_id','=',$id)
        ->where('st.local' ,'en')
        ->select('sp.*','st.title')
        ->orderBy('sp.order_sq', 'asc')
        ->get();
        // return dd($id);
        $arrNotIn = [];
         foreach($relatedApp as $res){
            array_push($arrNotIn , $res->se_id);
         }
         $result = array_unique($arrNotIn);
         $series = DB::table('series as s')
         ->join('series_translations as st' ,'st.series_id' ,'=' ,'s.se_id')
         ->where('st.local', '=', 'en')
         ->whereNotIn('s.se_id' ,$arrNotIn)
         ->select('st.*', 'st.*')
         ->orderBy('s.created_at', 'desc')
         ->get();

        //  return dd($series);

        return view('application.relateApp')
        ->with('name', "application")
        ->with('menu','')
        ->with('appId',$id)
        ->with('series', $series)
        ->with('relatedApps', $relatedApp);
    }

    public function update_order_series(Request $request){
        $HomeIds = array_filter(explode(",", $request->home_id));
        $HomeOrders = array_filter(explode(",", $request->home_order));
        foreach ($HomeIds as $HomeId => $value){
             DB::table('series_has_application')->where('id', '=', $value)->update(['order_sq'=>$HomeOrders[$HomeId]]);
        }
        return response()->json([
            'order' => $request->home_order
        ],200);
        
    }
    public function deleteRelatedSeries(Request $request){
        $itemid = $request->itemId;
        $appId  = $request->appId;
        DB::table('series_has_application')->where('id', $itemid )->delete();
        return redirect()->route('relateApplication', $appId)->with('flash_message', 'Delete Data successfully');
    }
    public function addRelatedSeries(Request $request){

        $appId  = $request->appId;
        DB::table('series_has_application')->insert(
            [
                "app_id" => $appId,
                "se_id" => $request->se_id,
               
            ]
        );

        return redirect()->route('relateApplication', $appId)->with('flash_message', 'Insert Data successfully');

    }

    public function update_order_application(Request $request){
        $HomeIds = array_filter(explode(",", $request->home_id));
        $HomeOrders = array_filter(explode(",", $request->home_order));
        foreach ($HomeIds as $HomeId => $value){
             DB::table('application')->where('id', '=', $value)->update(['order_seq'=>$HomeOrders[$HomeId]]);
        }
        return response()->json([
            'order' => $request->home_order
        ],200);
        
    }
   public function addMoreImage($id)
    {
        $image = DB::table('more_image_app as mp')
        ->where('mp.app_id',$id)
        ->select('mp.*')
        ->get();

        return view('application.imageapp')
        ->with('name', "application")
        ->with('menu','')
        ->with('appid' ,$id)
        ->with('image' ,$image);
    }
    public function deleteImage(Request $request){
        $itemId = $request->itemId;
        $appId = $request->appid;

        $image = DB::table('more_image_app as ing')
        ->where('ing.id' ,$itemId)
        ->select('ing.*')
        ->get(); 
       
        if(isset($image[0]->image_name) ){
            $filepath2 =  base_path('/../medias/categories/').$image[0]->image_name;
            unlink($filepath2);  
         }

        DB::table('more_image_app')->where('id', '=', $itemId)->delete();

        return redirect()->route('addMoreImage',['id' => $appId])
        ->with('flash_message', 'Delete data Successfully');
    }

    public function uploadImagemultiple(Request $request){
   
        $typeId = $request->typeId;
        $typeName = $request->typeName;
        if ($request->hasFile('file')) {

            $image = $request->file('file'); 

            $imgName = uniqid().".".$image->getClientOriginalExtension();
            $image->move(base_path('/../medias/categories'),$imgName);
            DB::table('more_image_app')->insert(
                [
                    'app_id' => $typeId,
                    'image_name' =>  $imgName,
              ]);

              return response()->json([
                'status' => 'success',
             ], 200);
        }
        return response()->json([
            'status' => 'no file',
         ], 200);
    
    }

}