<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;

class BannerSlideController extends Controller
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
        // return dd($userdata);
        if(isset($userdata) && $userdata->lang == 'All'){
            $banners = DB::table('banner_slide as bs')
            ->join('banner_slide_translations as bst','bs.id','=','bst.ban_id')
            ->where('bst.local','=','en')
            ->select('bs.*','bst.*')
            ->orderBy('bs.order_seq' ,'asc')
            ->get();
        }else if(isset($userdata)){
            $banners = DB::table('banner_slide as bs')
            ->join('banner_slide_translations as bst','bs.id','=','bst.ban_id')
            ->where('bst.local',$userdata->lang)
            ->select('bs.*','bst.*')
            ->orderBy('bs.order_seq' ,'asc')
            ->get();
        }else{
            $banners = DB::table('banner_slide as bs')
            ->join('banner_slide_translations as bst','bs.id','=','bst.ban_id')
            ->where('bst.local','=','en')
            ->select('bs.*','bst.*')
            ->orderBy('bs.order_seq' ,'asc')
            ->get();
        }
    

        return view('banner.index')
        ->with('name','Home')
        ->with('menu','bannerslide')
        ->with('banners',$banners);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $language = DB::table('language')->get();
       
         return view('banner.create')
         ->with('name','Home')
         ->with('menu','bannerslide')
         ->with('language',$language);
    }

  

    private function  SaveimageArray($arrayfile ,$arrfilename){
          $arrayfileName = [];
        foreach ($arrfilename as $key => $value) {
                $emptyornot = isset($arrayfile[$value]);
                if($emptyornot){
                $fileName = preg_replace('/\s+/', '', uniqid().$arrayfile[$value]->getClientOriginalName());
                $arrayfile[$value]->move(base_path('/../medias/banners'),$fileName);
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
               
                    $fileName = preg_replace('/\s+/', '', uniqid().$arrayfile[$value]->getClientOriginalName());
                    $arrayfile[$value]->move(base_path('/../medias/banners'),$fileName);
                    $arrayfileName[$value] = $fileName;
                
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
     
        $title_1 = $request->title_1;
        $title_2 = $request->title_2;
        $content = $request->content;
        $content = $request->content;
        $btn_link = $request->btn_link;
        $btn_name = $request->btn_name;
        $btn_status = $request->btn_status;
        $fileimage  = $request->fileimage;
        $arrfilename = $request->filename;
        $arrayfilesave = self::SaveimageArray($fileimage ,$arrfilename);
        // return dd($arrayfilesave);
        $lang_loop = $request->lang_loop;
        
            $banId = DB::table('banner_slide')->insertGetID(
                [
                    "image" =>  $arrayfilesave['mobile_image'],
                    "image_destop" => $arrayfilesave['destop_image'],
                    "title_color" => $request->title_color,
                    "content_color" => $request->content_color,
                    "btn_status" => $btn_status,
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                ]
            );

           foreach($lang_loop as $lang){
            DB::table('banner_slide_translations')->insert(
                [
                    "ban_id" => $banId,
                    "title" => $title_1,
                    "title2" => $title_2,
                    "content" => $content,
                    "btn_link" =>$btn_link,
                    "btn_name" =>$btn_name,
                    "local" => $lang
                ]
            );
           }
           
            return redirect()->route('bannerSlide.index')->with('flash_message', 'Insert Data successfully');
        
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
            $language = DB::table('language')->get();
        }else{
            $language = DB::table('language')->where('name',$userdata->lang)->get();
        }
       $bannerslide = DB::table('banner_slide as bs')
        ->join('banner_slide_translations as bst','bs.id','=','bst.ban_id')
        ->where('bs.id','=',$id)
        ->select('bs.*' ,'bst.*')
        ->get();
     

        return view('banner.edit')
        ->with('name','Home')
        ->with('menu','bannerslide')
        ->with('language', $language)
        ->with('bannerslide', $bannerslide);
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
        $id = $request->id;
        $fileimage = $request->fileimage;
        $arrfilename = $request->filename;
        $oldfile  =$request->oldfile;
        $title_1 = $request->title_1;
        $title_2 = $request->title_2;
        $content = $request->content;
        $content = $request->content;
        $btn_link = $request->btn_link;
        $btn_name = $request->btn_name;
        $btn_status = $request->btn_status;
        $arrayfilesave = self::updateoldImage($fileimage ,$oldfile ,$arrfilename);
        $lang_loop = $request->lang_loop;
        
    
         
        // return dd($arrayfilesave);
         DB::table('banner_slide')->where('id' ,$id)->update(
                [
                    "image" =>  $arrayfilesave['mobile_image'],
                    "image_destop" => $arrayfilesave['destop_image'],
                    "title_color" => $request->title_color,
                    "content_color" => $request->content_color,
                    "btn_status" => $btn_status,
                    "updated_at" => \Carbon\Carbon::now(),
                ]
            );

           foreach($lang_loop as $lang){
            $data = DB::table('banner_slide_translations')->where('ban_id' ,$id)->where('local' ,$lang)->get();
            if(count($data) > 0){
                DB::table('banner_slide_translations')
                ->where('ban_id' ,$id)
                ->where('local' ,$lang)->update(
                    [
                        "title" => $title_1[$lang],
                        "title2" => $title_2[$lang],
                        "content" => $content[$lang],
                        "btn_link" =>$btn_link[$lang],
                        "btn_name" =>$btn_name[$lang],
                    ]
                );
            }else{
                DB::table('banner_slide_translations')->insert(
                    [
                        "ban_id"=> $id,
                        "title" => $title_1[$lang],
                        "title2" => $title_2[$lang],
                        "content" => $content[$lang],
                        "btn_link" =>$btn_link[$lang],
                        "btn_name" =>$btn_name[$lang],
                        "local" =>$lang
                    ]
                );
            }
     
        }
           
            return redirect()->route('bannerSlide.index')->with('flash_message', 'Update Data successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id  = $request->itemId;
        $bannerslide = DB::table('banner_slide as bs')
        ->join('banner_slide_translations as bst','bs.id','=','bst.ban_id')
        ->where('bs.id','=',$id)
        ->select('bs.*' ,'bst.*')
        ->first();

        $file_pointer = base_path('/../medias/banners/').$bannerslide->image;
        if (file_exists($file_pointer)&& isset($bannerslide->image)) {
            unlink($file_pointer);
        }
        $file_pointer2 = base_path('/../medias/banners/').$bannerslide->image_destop;
        if (file_exists($file_pointer2)&& isset($bannerslide->image_destop)) {
            unlink($file_pointer2);
        }
        
        DB::table('banner_slide')->where('id', '=', $id)->delete();
        DB::table('banner_slide_translations')->where('ban_id','=',$id)->delete();

        return back()->with('flash_message', 'Delete Data successfully');
    }


    public function update_order_Banner(Request $request){
        $HomeIds = array_filter(explode(",", $request->home_id));
        $HomeOrders = array_filter(explode(",", $request->home_order));
        foreach ($HomeIds as $HomeId => $value){
             DB::table('banner_slide')->where('id', '=', $value)->update(['order_seq'=>$HomeOrders[$HomeId]]);
        }
        return response()->json([
            'order' => $request->home_order
        ],200);
        
    }
 


}
