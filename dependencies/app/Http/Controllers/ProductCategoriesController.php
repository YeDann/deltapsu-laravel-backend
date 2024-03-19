<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Validator;

class ProductCategoriesController extends Controller
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
        $language = DB::table('language')->get();
        $mainCategories = DB::table('main_pro_categories as mp')
        ->join('main_pro_categories_translations as mpt', 'mpt.main_pro_id', '=', 'mp.main_id')
        ->where('mpt.local', '=', 'en')
        ->select('mp.*', 'mpt.*')
        ->orderBy('mp.created_at', 'desc')
        ->get();

        // return dd($mainCategories);

        return view('pro_categories.main_index')
            ->with('name', 'product')
            ->with('menu', 'mainCategories')
            ->with('mainCategories', $mainCategories)
            ->with('language', $language);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return dd('55');
        $language = DB::table('language')->get();

        return view('pro_categories.main_create')
            ->with('language', $language)
            ->with('name', 'product')
            ->with('menu', 'mainCategories');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->name;
        $langs = $request->lang_loop;
         
        $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        // return dd($validate->fails());
        if ($validate->fails()) {
        
            return redirect()->back()->withErrors($validate->errors());
        } else {

            $id = DB::table('main_pro_categories')->insertGetID(
                [
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                ]
            );

                foreach($langs as $lang){
                    $main_pro_categories = DB::table('main_pro_categories_translations')->insert(
                        [
                            "main_pro_id" => $id,
                            "name" => $name,
                            "local" => $lang,
                        ]
                    );

                }
                return redirect()->route('mainprotype.index')->with('flash_message', 'Insert Data successfully');
            
        }
        

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

         $mainCategories = DB::table('main_pro_categories as mp')
            ->join('main_pro_categories_translations as mpt', 'mpt.main_pro_id', '=', 'mp.main_id')
            ->where('mp.main_id', '=',$id)
            ->select('mp.*', 'mpt.*')
            ->get();


        return view('pro_categories.main_edit')
            ->with('name', 'product')
            ->with('menu', 'mainCategories')
            ->with('mainId', $id)
            ->with('mainCategories', $mainCategories);
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
        $name = $request->name;
        $langs = $request->lang_loop;
        $mainId = $request->mainId;

        DB::table('main_pro_categories')
        ->where('main_id','=',$mainId)
        ->update(array(
            "updated_at" => \Carbon\Carbon::now()
        ));
        foreach($langs as $lang){
            DB::table('main_pro_categories_translations')->where('main_pro_id', "=", $mainId)
            ->where('local',$lang)->update(array(
               "name" => $name[$lang]
            ));
        }
        return redirect()->route('mainprotype.index')->with('flash_message', 'Update Data successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)

    {
        $id = $request->itemId;
        // return dd($id);
        DB::table('main_pro_categories')->where('main_id', '=', $id)->delete();
        DB::table('main_pro_categories_translations')->where('main_pro_id', '=', $id)->delete();

        return redirect()->route('mainprotype.index')->with('flash_message', 'Delete Data successfully');
    }


    public function subCatories(){
          

        $subCategories = DB::table('sub_pro_categories as sp')
        ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'sp.sub_pro_id')
        ->where('spt.local', '=', 'en')
        ->select('sp.*', 'spt.*')
        ->orderBy('sp.created_at', 'desc')
        ->get();
        
            return view('pro_categories.sub_index')
                ->with('name', 'product')
                ->with('menu', 'subCategories')
                ->with('subCategories', $subCategories);
         
    }
    public function createSubCategories(){

        $language = DB::table('language')->get();

        $mainCategories = DB::table('main_pro_categories as mp')
        ->join('main_pro_categories_translations as mpt', 'mpt.main_pro_id', '=', 'mp.main_id')
        ->where('mpt.local', '=', 'en')
        ->select('mp.*', 'mpt.*')
        ->orderBy('mp.created_at', 'desc')
        ->get();
        return view('pro_categories.sub_create')
        ->with('name', 'product')
        ->with('mainCategories',$mainCategories)
        ->with('menu', 'subCategories')
        ->with('language', $language);
    }
    private function savearrayfile($loopfile ,$loop){
         $arrayfileName = [];
            foreach($loop as $lang){
                $emptyornot = isset($loopfile[$lang]);
                if($emptyornot){
                $fileName[$lang] = preg_replace('/\s+/', '', uniqid().$loopfile[$lang]->getClientOriginalName());
                $loopfile[$lang]->move(base_path('/../medias/categories'),$fileName[$lang]);
               
                $arrayfileName[$lang] = $fileName[$lang];
                }else{
                 $fileName[$lang] = '';
                 $arrayfileName[$lang] = $fileName[$lang];
                }
            }
        return $arrayfileName;
    }


    
    public function storeSubCategories(Request $request){

        $name = $request->name;
        $langs = $request->lang_loop;
        $main_id = $request->main_categories;
        $content = $request->content;
        $fileGU = $request->file('fileGU');
        $productfield = $request->productfield;
        $thumbnailOpt = $request->thumbnailOpt;
        $typeImage  = $request->typeImage;
        $arrayfileName = self::savearrayfile($thumbnailOpt ,$typeImage);
        // return dd($arrayfileName['type2']);
        $warranty_file = "";
        if($request->hasFile('warranty_file')){
            $filewarr = $request->file('warranty_file');
            $warranty_file = preg_replace('/\s+/', '', self::fileformat($filewarr));
            $filewarr->move(base_path('/../medias/categories'),$warranty_file);
        }

        $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        // return dd($validate->fails());
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        } else {
            if ($request->hasFile('thumbnail')) {
                $thumbnailImage = $request->file('thumbnail');
                $thumbnailName = uniqid() . "." . $thumbnailImage->getClientOriginalExtension();
                $thumbnailImage->move(base_path('/../medias/categories'), preg_replace('/\s+/', '', $thumbnailName));
                $string = str_replace(' ', '-', $name);
                $id = DB::table('sub_pro_categories')->insertGetID(
                    [
                        'image' =>$thumbnailName,
                        'image_type1' =>$arrayfileName['type1'],
                        'image_type2' =>$arrayfileName['type2'],
                        'image_type3' =>$arrayfileName['type3'],
                        'url_item' => strtolower($string),
                        "unit_dimension" => $request->unit_dimension,
                        'warranty_file'=>$warranty_file,
                        "created_at" => \Carbon\Carbon::now(),
                        "updated_at" => \Carbon\Carbon::now(),
                    ]
                );

            }else{

                $id = DB::table('sub_pro_categories')->insertGetID(
                    [
                        "unit_dimension" => $request->unit_dimension,
                        "created_at" => \Carbon\Carbon::now(),
                        "updated_at" => \Carbon\Carbon::now(),
                        'warranty_file'=>$warranty_file,
                    ]
                );
              

            }
            foreach($main_id as $main){
                DB::table('categories_has_main_pro')->insert(
                    [
                        "cate_id" =>  $id,
                        "main_cateid" => $main,
                    ]
                );
            }
          
            $filename = '';
            if ($request->hasFile('fileGU')) {
                $file = $request->file('fileGU');
                $filename = preg_replace('/\s+/', '', self::fileformat($file));
                $file->move(base_path('/../medias/categories'),$filename);
            }
                foreach($langs as $lang){
                    $main_pro_categories = DB::table('sub_pro_categories_translation')->insert(
                        [
                            "sub_pro_id" => $id,
                            "name" => $name,
                            "content" => $content,
                            "contenttype1" => $request->contentAddType1,
                            "contenttype2" => $request->contentAddType2,
                            "contenttype3" => $request->contentAddType3,
                            "file" => $filename,
                            "local" => $lang,                 
                        ]
                    );
                }
     
              
                return redirect()->route('subCategories')->with('flash_message', 'Insert Data successfully');
        }
    }

    public function editSubCategories($id){

        $language = DB::table('language')->get();

        $subCategories = DB::table('sub_pro_categories as sc')
        ->join('sub_pro_categories_translation as sct', 'sct.sub_pro_id', '=', 'sc.sub_pro_id')
        ->where('sc.sub_pro_id', $id)
        ->select('sc.*', 'sct.*')
        ->orderBy('sc.created_at', 'desc')
        ->get();
        $arrayIncate = [];
        $mainInCate = DB::table('categories_has_main_pro as chp')
        ->rightjoin('main_pro_categories as mp', 'mp.main_id', '=', 'chp.main_cateid')
        ->rightjoin('main_pro_categories_translations as mpt', 'mpt.main_pro_id', '=', 'mp.main_id')
        ->where('mpt.local', '=', 'en')
        ->where('chp.cate_id', $id)
        ->select('mp.*', 'mpt.*')
        ->orderBy('mp.created_at', 'desc')
        ->get();
        
        foreach($mainInCate as $data){
            array_push($arrayIncate, $data->main_id);
        }
        $orderCate = DB::table('categories_has_main_pro as chp')
        ->where('chp.cate_id', $id)
        ->select('chp.*')
        ->get();

        $mainCategories = DB::table('main_pro_categories as mp')
        ->join('main_pro_categories_translations as mpt', 'mpt.main_pro_id', '=', 'mp.main_id')
        ->where('mpt.local', '=', 'en')
        ->whereNotIn('mp.main_id' ,$arrayIncate)
        ->select('mp.*', 'mpt.*')
        ->orderBy('mp.created_at', 'desc')
        ->get();

       

  
        return view('pro_categories.sub_edit')
        ->with('name', 'product')
        ->with('subid', $id)
        ->with('orderCate',$orderCate)
        ->with('subCategories',$subCategories)
        ->with('mainCategories',$mainCategories)
        ->with('mainInCate',$mainInCate)
        ->with('menu', 'subCategories')
        ->with('language', $language);

    }
    private function fileformat($file){
        $string = '';
    if(isset($file) && is_file($file)){
      $filename = str_replace('.'.$file->getClientOriginalExtension(),"",$file->getClientOriginalName());
      $string   =  $filename.uniqid().'.'.$file->getClientOriginalExtension();
    }
    return $string;
  }
    private function UpdateOldfile($loopfile ,$loop ,$oldfile){
        
        $arrayfileName = [];
           foreach($loop as $lang){
               $emptyornot = isset($loopfile[$lang]);
               if($emptyornot){
                    $fileName[$lang] = preg_replace('/\s+/', '', self::fileformat($loopfile[$lang]));
                    $loopfile[$lang]->move(base_path('/../medias/categories'),$fileName[$lang]);
                    $arrayfileName[$lang] = $fileName[$lang];

                    if(isset($oldfile[$lang])){
                            $file_pointer = base_path('/../medias/categories/').$oldfile[$lang];
                            if (file_exists($file_pointer)) {
                                unlink($file_pointer);
                            }
                        }
               }else{
                $arrayfileName[$lang] = $oldfile[$lang];
               }
           }
       return $arrayfileName;
   }

   private function updatesiglefile($oldfilename ,$file){
       $file_pointer = base_path('/../medias/categories/').$oldfilename;
       if (file_exists($file_pointer) && $oldfilename != null) {
           unlink($file_pointer);
           $filename = preg_replace('/\s+/', '', uniqid().$file->getClientOriginalName());
           $file->move(base_path('/../medias/categories'),$filename);
           $Newfilename = $filename;
       }else {
           $filename = preg_replace('/\s+/', '', uniqid().$file->getClientOriginalName());
           $file->move(base_path('/../medias/categories'),$filename);
           $Newfilename = $filename;
       }
         return $Newfilename;
   }

    public function UpdateSubCategories(Request $request){

        $name = $request->name;
        $langs = $request->lang_loop;
        $main_id = $request->main_categories;
        $content = $request->content;
        $fileGU = $request->file('fileGU');
        $productfield = $request->productfield;
        $subid = $request->subid;
        $oldfile = $request->oldfile;
        $oldfileimage = $request->oldfileimage;
        $content1  = $request->content1;
        $content2  = $request->content2;
        $safety_cer  = $request->safety_cer;
        $features  = $request->features;
        $dimensions  = $request->dimensions;
        $unit  = $request->unit;
        $oldfileytype = $request->oldfileytype;
        $thumbnailOpt = $request->thumbnailOpt;
        $typeImage  = $request->typeImage;
        $orderCate   = $request->orderCate;
        $contentAddType1 = $request->contentAddType1;
        $contentAddType2 = $request->contentAddType2;
        $contentAddType3 = $request->contentAddType3;
        $oldfile_warranty_file  = $request->oldfile_warranty_file;
        $url_item  = $request->url_item;
        
        $arrayfileName = self::UpdateOldfile($thumbnailOpt, $typeImage ,$oldfileytype);
        // return dd($arrayfileName);
        $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        // return dd($validate->fails());
        $warranty_file = "";
        if($request->hasFile('warranty_file')){
            $filewarr = $request->file('warranty_file');
            $warranty_file = preg_replace('/\s+/', '', self::fileformat($filewarr));
            $filewarr->move(base_path('/../medias/categories'),$warranty_file);
        }else{
            $warranty_file = $oldfile_warranty_file;
        }

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        } else {
            if ($request->hasFile('thumbnail')) {
                $thumbnailName =  self::updatesiglefile($oldfileimage ,$request->File('thumbnail'));
                DB::table('sub_pro_categories')->where('sub_pro_id' ,$subid)->update(
                    [
                        'image' =>$thumbnailName,
                        'image_type1' =>$arrayfileName['type1'],
                        'image_type2' =>$arrayfileName['type2'],
                        'image_type3' =>$arrayfileName['type3'],
                        "unit_dimension" => $request->unit_dimension,
                        'url_item' => $url_item,
                        'warranty_file'=>$warranty_file,
                        "updated_at" => \Carbon\Carbon::now(),
                    ]
                );
            }else{
                DB::table('sub_pro_categories')->where('sub_pro_id' ,$subid)->update(
                    [    
                        'image_type1' =>$arrayfileName['type1'],
                        'image_type2' =>$arrayfileName['type2'],
                        'image_type3' =>$arrayfileName['type3'],
                        "unit_dimension" => $request->unit_dimension,
                        'warranty_file'=>$warranty_file,
                        'url_item' => $url_item,
                        "updated_at" => \Carbon\Carbon::now(),
                    ]
                );
            }

         
            if(isset($main_id)){
                DB::table('categories_has_main_pro')->where('cate_id', '=', $subid)->delete();
                foreach($main_id as $main){
                    DB::table('categories_has_main_pro')->insert(
                        [
                            "cate_id" =>  $subid,
                            "main_cateid" => $main,
                            "order_seq" => isset($orderCate[$main]) ? $orderCate[$main] : 0,
                        ]
                    );
                }
            }
          
            $arrayfileName = self::UpdateOldfile($fileGU ,$langs ,$oldfile);
              $arraySucess = [];
                foreach($langs as $lang){
                   $data =  DB::table('sub_pro_categories_translation')->where('local' ,$lang)->where('sub_pro_id' ,$subid)->select('*')->get();
                   $data_con  = count($data);
                   if($data_con == 1){
                    DB::table('sub_pro_categories_translation')
                    ->where('local' ,$lang)
                    ->where('sub_pro_id' ,$subid)->update(
                        [
                            "name" => $name[$lang],
                            "content" => $content[$lang],
                            "contenttype1" => $contentAddType1[$lang],
                            "contenttype2" => $contentAddType2[$lang],
                            "contenttype3" => $contentAddType3[$lang],
                            "file" => $arrayfileName[$lang],
                            "content1" => isset($content1[$lang]) ?  $content1[$lang] :null,
                            "content2" => isset($content2[$lang]) ? $content2[$lang] : null ,
                            "safety_cer" => isset($safety_cer[$lang]) ? $safety_cer[$lang] :null ,
                            "highlight" => isset($features[$lang]) ? $features[$lang] : null ,
                            "dimension" => isset($dimensions[$lang]) ? $dimensions[$lang] : null ,
                            "unit_wight" => isset($unit[$lang]) ? $unit[$lang] : null,
                        ]
                    );
                   }else{
                    DB::table('sub_pro_categories_translation')->insert(
                        [
                            
                            "sub_pro_id" => $subid,
                            "name" => $name[$lang],
                            "content" => $content[$lang],
                            "contenttype1" => $contentAddType1[$lang],
                            "contenttype2" => $contentAddType2[$lang],
                            "contenttype3" => $contentAddType3[$lang],
                            "file" => $arrayfileName[$lang],
                            "content1" => isset($content1[$lang]) ?  $content1[$lang] :null,
                            "content2" => isset($content2[$lang]) ? $content2[$lang] : null ,
                            "safety_cer" => isset($safety_cer[$lang]) ? $safety_cer[$lang] :null ,
                            "highlight" => isset($features[$lang]) ? $features[$lang] : null ,
                            "dimension" => isset($dimensions[$lang]) ? $dimensions[$lang] : null ,
                            "unit_wight" => isset($unit[$lang]) ? $unit[$lang] : null,
                            "local" => $lang,
                        ]
                    );

                   }
 
                }
                
 
            return redirect()->route('subCategories')->with('flash_message', 'Update Data successfully');
        }
    }
    private function removeImage($arrayfilename){
        foreach($arrayfilename as $filename){
            $file_pointer = base_path('/../medias/categories/').$filename;
            if (isset($filename) &&  $filename != null && file_exists($file_pointer)) {
                unlink($file_pointer);
            }
        }
    }
    public function destroysubcategories(Request $request){
            $itemId = $request->itemId;
            $subCategories = DB::table('sub_pro_categories as sc')
            ->join('sub_pro_categories_translation as sct', 'sct.sub_pro_id', '=', 'sc.sub_pro_id')
            ->where('sc.sub_pro_id', $itemId)
            ->select('sc.*', 'sct.*')
            ->orderBy('sc.created_at', 'desc')
            ->first();

            DB::table('sub_pro_categories')->where('sub_pro_id', '=', $itemId)->delete();
            DB::table('sub_pro_categories_translation')->where('sub_pro_id', '=', $itemId)->delete();
            $arrayfilename = array($subCategories->image);
            self::removeImage($arrayfilename);
            
            return redirect()->route('subCategories')->with('flash_message', 'Delete Data successfully');
    }


     public function series_index($id){

        $series =  DB::table('series_has_pro_categories as sc')
        ->join('series as s' ,'sc.se_id' ,'=' ,'s.se_id')
        ->join('series_translations as st' ,'st.series_id' ,'=' ,'s.se_id')
        ->where('sc.pro_categories_id' ,$id)
        ->where('st.local' ,'en')
        ->select('s.*' ,'st.*')
        ->orderBy('s.created_at','desc')
        ->distinct()
        ->get();

        return view('pro_categories.series')
        ->with('menu', 'subCategories')
        ->with('name', 'product')
        ->with('pro_cate_id', $id)
        ->with('series', $series);
     }

     public function series_all(){

        $series =  DB::table('series as s')
        ->join('series_translations as st' ,'st.series_id' ,'=' ,'s.se_id')
        ->where('st.local' ,'en')
        ->select('s.*' ,'st.*')
        ->orderBy('s.created_at','desc')
        ->distinct()
        ->get();

        return view('pro_categories.series_all')
        ->with('menu', 'series')
        ->with('name', 'product')
        ->with('pro_cate_id',0)
        ->with('series', $series);
     }


     public function createSeries($id){

        $language = DB::table('language')->get();

        $applications =  DB::table('application as app')
        ->join('application_translation as appt' ,'appt.app_id' ,'=' ,'app.id')
        ->where('appt.local' ,'en')
        ->select('app.*','app.id as appId' ,'appt.*')
        ->get();

        $subCategories = DB::table('sub_pro_categories as sc')
        ->join('sub_pro_categories_translation as sct', 'sct.sub_pro_id', '=', 'sc.sub_pro_id')
        ->where('sct.local' ,'en')
        ->select('sc.*', 'sct.*')
        ->orderBy('sc.created_at', 'desc')
        ->get();

        $mainCategories = DB::table('main_pro_categories as mp')
        ->join('main_pro_categories_translations as mpt', 'mpt.main_pro_id', '=', 'mp.main_id')
        ->where('mpt.local', '=', 'en')
        ->select('mp.*', 'mpt.*')
        ->orderBy('mp.created_at', 'desc')
        ->get();

        $modeSeries = DB::table('mode_series as ms')
        ->select('ms.*')
        ->get();


        return view('pro_categories.series_create')
        ->with('pro_cate_id', $id)
        ->with('modeSeries', $modeSeries)
        ->with('language', $language)
        ->with('mainCategories', $mainCategories)
        ->with('applications', $applications)
        ->with('subCategories', $subCategories)
        ->with('menu', 'subCategories')
        ->with('name', 'product');
     }
    //  private function saveOneImage($file){

    //  }
     public function storeSeries(Request $request){
      
          $langs = $request->lang_loop;
          $productCategories = $request->productCategories;
          $aplication = $request->aplication;
          $name = $request->name;
          $overview = $request->overview;
          $pro_cate_id = $request->pro_cate_id;
          $mainCategories = $request->mainCategories;
          $status_mode   = $request->status_mode;
        //   return dd($mainCategories);
          $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        // return dd($validate->fails());
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        } else {
            $string = str_replace(' ', '-', $name);
            if ($request->hasFile('thumbnail')) {
                $thumbnailImage = $request->file('thumbnail');
                $thumbnailName = uniqid() . "." . $thumbnailImage->getClientOriginalExtension();
                $thumbnailImage->move(base_path('/../medias/categories'), preg_replace('/\s+/', '', $thumbnailName));
          
            $id = DB::table('series')->insertGetID(
                [
                    'image' =>$thumbnailName,
                    'slug'=> strtolower($string),
                    'status'=>$request->status,
                    'mode_series'=>$status_mode,
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                ]
            );

            }else{

                $id = DB::table('series')->insertGetID(
                    [
                        'slug'=> strtolower($string),
                        'status'=>$request->status,
                        'mode_series'=>$status_mode,
                        "created_at" => \Carbon\Carbon::now(),
                        "updated_at" => \Carbon\Carbon::now(),
                    ]
                );

            }
            
                foreach($langs as $lang){
                   DB::table('series_translations')->insert(
                        [
                            "series_id" => $id,
                            "title" => $name,
                            "overview_content" => $overview,
                            "local" => $lang,
                        ]
                    );
                }
                if(isset($productCategories) && isset($mainCategories)){
                foreach($mainCategories as $mainId){
                  foreach($productCategories as $cate ){
                    DB::table('series_has_pro_categories')->insert(
                        [
                            'se_id'=>$id,
                            'pro_categories_id'=>$cate,
                            'main_cate'=> $mainId
                        ]
                    );
                 }
              }
              
              }else if(isset($productCategories)){
                foreach($productCategories as $cate ){
                    DB::table('series_has_pro_categories')->insert(
                        [
                            'se_id'=>$id,
                            'pro_categories_id'=>$cate,
                            'main_cate'=> $mainId
                        ]
                    );
                 }

              }
       
               if(isset($aplication)){
               $i = 1;
               foreach($aplication as $app ){
                DB::table('series_has_application')->insert(
                    [
                        'se_id'=>$id,
                        'app_id'=>$app,
                        'order_sq'=>$i,
                    ]
                );
                $i++;
            }
          }
            
                if($pro_cate_id == 0){
                    return redirect()->route('series_all')->with('flash_message', 'Insert Data successfully');
                }else{
                    return redirect()->route('series_index' , $pro_cate_id)->with('flash_message', 'Insert Data successfully');
                }
             
        }


     }
     public function editSeries($id ,$cateId){
        
        $language = DB::table('language')->get();

        $series =  DB::table('series as s')
        ->join('series_translations as st' ,'st.series_id' ,'=' ,'s.se_id')
        ->where('s.se_id' ,$id)
        ->select('s.*' ,'st.*')
        ->get();

        // return dd($series);
 
        $arraynotapp = [];

        $series_has_application = DB::table('series_has_application as shp')
        ->join('application as app', 'app.id', '=', 'shp.app_id')
        ->join('application_translation as appt' ,'appt.app_id' ,'=' ,'app.id')
        ->where('appt.local' ,'en')
        ->where('shp.se_id' ,$id)
        ->select('shp.app_id','appt.name' )
        ->get();
      
        foreach($series_has_application as $data){
            array_push($arraynotapp,$data->app_id);
        }
    
        $applications =  DB::table('application as app')
        ->join('application_translation as appt' ,'appt.app_id' ,'=' ,'app.id')
        ->where('appt.local' ,'en')
        ->whereNotIn('app.id' , $arraynotapp)
        ->select('app.*','app.id as appId' ,'appt.*')
        ->get();
      

        $arraynotcate = [];
        $maincate = [];

        $series_has_pro_categories = DB::table('series_has_pro_categories as shpc')
        ->join('sub_pro_categories as spc', 'spc.sub_pro_id', '=', 'shpc.pro_categories_id')
        ->join('sub_pro_categories_translation as spct' ,'spct.sub_pro_id' ,'=' ,'spc.sub_pro_id')
        ->where('spct.local' ,'en')
        ->where('shpc.se_id' ,$id)
        ->select('spc.*','shpc.pro_categories_id' ,'spct.*' )
        ->distinct()
        ->get();

        $main_cate_content = DB::table('series_has_pro_categories as shpc')
        ->join('sub_pro_categories as spc', 'spc.sub_pro_id', '=', 'shpc.pro_categories_id')
        ->join('sub_pro_categories_translation as spct' ,'spct.sub_pro_id' ,'=' ,'spc.sub_pro_id')
        ->where('spct.local' ,'en')
        ->where('shpc.se_id' ,$id)
        ->select('shpc.main_cate')
        ->distinct()
        ->get();

        // return  dd($series_has_pro_categories);
        foreach($series_has_pro_categories as $cate){
            array_push($arraynotcate,$cate->sub_pro_id);
        }
        foreach($main_cate_content as $main){
            if($main->main_cate != null){
                array_push($maincate,$main->main_cate);
            }
        }
      

        $subCategories = DB::table('sub_pro_categories as sc')
        ->join('sub_pro_categories_translation as sct', 'sct.sub_pro_id', '=', 'sc.sub_pro_id')
        ->where('sct.local' ,'en')
        ->select('sc.*', 'sct.*')
        ->whereNotIn('sc.sub_pro_id' , $arraynotcate)
        ->orderBy('sc.created_at', 'desc')
        ->get();

       
      if(isset($maincate)){
        $mainCategories = DB::table('main_pro_categories as mp')
        ->join('main_pro_categories_translations as mpt', 'mpt.main_pro_id', '=', 'mp.main_id')
        ->where('mpt.local', '=', 'en')
        ->select('mp.*', 'mpt.*')
        ->whereNotIn('mp.main_id' , $maincate)
        ->orderBy('mp.created_at', 'desc')
        ->get();
      }else{
        $mainCategories = DB::table('main_pro_categories as mp')
        ->join('main_pro_categories_translations as mpt', 'mpt.main_pro_id', '=', 'mp.main_id')
        ->where('mpt.local', '=', 'en')
        ->select('mp.*', 'mpt.*')
        ->orderBy('mp.created_at', 'desc')
        ->get();
      }
     
        $mainCateInSection = DB::table('main_pro_categories as mp')
        ->join('main_pro_categories_translations as mpt', 'mpt.main_pro_id', '=', 'mp.main_id')
        ->where('mpt.local', '=', 'en')
        ->select('mp.*', 'mpt.*')
        ->whereIn('mp.main_id' , $maincate)
        ->orderBy('mp.created_at', 'desc')
        ->get();
      
        $modeSeries = DB::table('mode_series as ms')
        ->select('ms.*')
        ->get();

        return view('pro_categories.series_edit')
        ->with('pro_cate_id',$cateId)
        ->with('modeSeries',$modeSeries)
        ->with('series_has_pro_categories', $series_has_pro_categories)
        ->with('series_has_application', $series_has_application)
        ->with('seriesId', $id)
        ->with('series', $series)
        ->with('mainCateInSection', $mainCateInSection)
        ->with('language', $language)
        ->with('applications', $applications)
        ->with('subCategories', $subCategories)
        ->with('mainCategories', $mainCategories)
        ->with('menu', 'subCategories')
        ->with('name', 'product');
     }

     public function updateSeries(Request $request){
        $seriesId = $request->seriesId;
        $langs = $request->lang_loop;
        $productCategories = $request->productCategories;
        $aplication = $request->aplication;
        $name = $request->name;
        $overview = $request->overview;
        $pro_cate_id = $request->pro_cate_id;
        $oldfile = $request->oldfile;
        $mainCategories = $request->mainCategories;
        $status_mode   = $request->status_mode;

        $validate = Validator::make($request->all(), [
          'name' => 'required',
      ]);
      // return dd($validate->fails());
      if ($validate->fails()) {
          return redirect()->back()->withErrors($validate->errors());
      } else {
        $string = str_replace(' ', '-', $name['en']);
            if ($request->hasFile('thumbnail')) {
                $thumbnailImage = $request->file('thumbnail');
                $thumbnailName = uniqid() . "." . $thumbnailImage->getClientOriginalExtension();
                $thumbnailImage->move(base_path('/../medias/categories'), preg_replace('/\s+/', '', $thumbnailName));
                    $file_pointer = base_path('/../medias/categories/').$oldfile;
                    if (file_exists($file_pointer) && $oldfile != null) {
                        unlink($file_pointer);
                    }
                 
                    DB::table('series')->where('se_id',$seriesId)->update(
                        [
                            'image' =>$thumbnailName,
                            'slug'=> strtolower($string),
                            'status'=>$request->status,
                            "mode_series" =>$status_mode,
                            "created_at" => \Carbon\Carbon::now(),
                            "updated_at" => \Carbon\Carbon::now(),
                        ]
                    );
            }else{
                DB::table('series')->where('se_id',$seriesId)->update(
                    [
                        'status'=>$request->status,
                        'slug'=> strtolower($string),
                        "mode_series" =>$status_mode,
                        "created_at" => \Carbon\Carbon::now(),
                        "updated_at" => \Carbon\Carbon::now(),
                    ]
                );
            }
            foreach($langs as $lang){
                 $data = DB::table('series_translations')->where('local', $lang)->where('series_id',$seriesId)->select('*')->get();
                 $data_con = count($data);
                 if($data_con == 1){
                    DB::table('series_translations')->where('local', $lang)->where('series_id',$seriesId)->update(
                        [
                            "title" => $name[$lang],
                            "overview_content" => $overview[$lang],
                        ]
                    );
                 }else{
                    DB::table('series_translations')->insert(
                        [
                            "series_id" => $seriesId,
                            "title" => $name[$lang],
                            "overview_content" => $overview[$lang],
                            "local" => $lang,
                        ]
                    );
                 }
            }
            DB::table('series_has_pro_categories')->where('se_id', '=', $seriesId)->delete();
            // if(isset($productCategories)){
            //  foreach($productCategories as $cate ){
            //       DB::table('series_has_pro_categories')->insert(
            //           [
            //               'se_id'=>$seriesId,
            //               'pro_categories_id'=>$cate,
            //           ]
            //       );
            //  }
            // }

            if(isset($productCategories) && isset($mainCategories)){
                foreach($mainCategories as $mainId){
                  foreach($productCategories as $cate ){
                    DB::table('series_has_pro_categories')->insert(
                        [
                            'se_id'=>$seriesId,
                            'pro_categories_id'=>$cate,
                            'main_cate'=> $mainId
                        ]
                    );
                 }
              }
              
              }else if(isset($productCategories)){
                foreach($productCategories as $cate ){
                    DB::table('series_has_pro_categories')->insert(
                        [
                            'se_id'=>$seriesId,
                            'pro_categories_id'=>$cate,
                        ]
                    );
                 }

              }


             DB::table('series_has_application')->where('se_id', '=', $seriesId)->delete();
           
             if(isset($aplication)){
                $i = 1;
                foreach($aplication as $app ){
                 DB::table('series_has_application')->insert(
                     [
                         'se_id'=>$seriesId,
                         'app_id'=>$app,
                         'order_sq'=>$i,
                     ]
                 );
                 $i++;
               }
             }
             if($pro_cate_id == 0){
                return redirect()->route('series_all')->with('flash_message', 'Update Data successfully');
            }else{
                return redirect()->route('series_index' , $pro_cate_id)->with('flash_message', 'Update Data successfully');
            }
      
       }
   }
   public function destroySeries(Request $request){
       $pro_cate_id = $request->pro_cate_id;
       $itemId = $request->itemId;
       $series =  DB::table('series_has_pro_categories as sc')
       ->join('series as s' ,'sc.se_id' ,'=' ,'s.se_id')
       ->join('series_translations as st' ,'st.series_id' ,'=' ,'s.se_id')
       ->where('sc.se_id' ,$itemId)
       ->select('s.*' ,'st.*')
       ->first();
       DB::table('series')->where('se_id',$itemId)->delete();
       DB::table('series_translations')->where('series_id',$itemId)->delete();
       DB::table('series_has_application')->where('se_id' ,$itemId)->delete();
       DB::table('series_has_pro_categories')->where('se_id' ,$itemId)->delete();
       if(isset($series->image)){
            $file_pointer = base_path('/../medias/categories/').$series->image;
            if (file_exists($file_pointer) && !empty($series->image)) {
                unlink($file_pointer);
            }
       }
  
       if($pro_cate_id != 0){
        return redirect()->route('series_index',$pro_cate_id)->with('flash_message', 'Delete Data successfully');
       }else{
        return redirect()->route('series_all')->with('flash_message', 'Delete Data successfully');
       }
     
   }
    public function orderSeries($id)
    {
        $series = DB::table('series_has_pro_categories as sc')
        ->join('series as s' ,'sc.se_id' ,'=' ,'s.se_id')
        ->join('series_translations as st' ,'st.series_id' ,'=' ,'s.se_id')
        ->where('sc.pro_categories_id' ,$id)
        ->where('st.local' ,'en')
        ->select('s.*' ,'st.*')
        ->orderBy('order_seq' ,'asc')
        ->get();

        return view('pro_categories.orderSeries')
        ->with('menu', 'subCategories')
        ->with('name', 'product')
        ->with('pro_cate_id', $id)
        ->with('series', $series);
    }
    public function update_order_Series(Request $request){
        $HomeIds = array_filter(explode(",", $request->home_id));
        $HomeOrders = array_filter(explode(",", $request->home_order));
        foreach ($HomeIds as $HomeId => $value){
             DB::table('series')->where('se_id', '=', $value)->update(['order_seq'=>$HomeOrders[$HomeId]]);
        }
        return response()->json([
            'order' => $request->home_order
        ],200);
    }
     public function order_pro_categoriesBymain($id){
     $subCategories =   DB::table('categories_has_main_pro as chmp')
        ->join('sub_pro_categories as sc', 'chmp.cate_id', '=', 'sc.sub_pro_id')
        ->join('sub_pro_categories_translation as sct', 'sct.sub_pro_id', '=', 'sc.sub_pro_id')
        ->select('sc.*', 'sct.*' ,'chmp.*')
        ->where('chmp.main_cateid', $id)
        ->where('sct.local', 'en')
        ->orderBy('chmp.order_seq', 'asc')
        ->get();

        return view('pro_categories.order_pro_categories')
        ->with('name', 'product')
        ->with('cate_id', $id)
        ->with('subCategories',$subCategories)
        ->with('menu', 'subCategories');
     }

     public function update_order_procate(Request $request){
        $HomeIds = array_filter(explode(",", $request->home_id));
        $HomeOrders = array_filter(explode(",", $request->home_order));
        foreach ($HomeIds as $HomeId => $value){
             DB::table('categories_has_main_pro')->where('pk_id', '=', $value)->update(['order_seq'=>$HomeOrders[$HomeId]]);
        }
        return response()->json([
            'order' => $request->home_order
        ],200);
    }
    public function removefileDocSelectionGuide($id,$lang){

        DB::table('sub_pro_categories_translation')
        ->where('local' ,$lang)
        ->where('sub_pro_id' ,$id)->update(
            [

                "file" => null,
            ]
        );
        return redirect()->route('editSubCategories',$id)->with('flash_message', 'Delete File successfully');
        

    }

    public function removefileDocWaranfile($id,$filename){

        DB::table('sub_pro_categories')
        ->where('sub_pro_id' ,$id)->update(
            [

                "warranty_file" => null,
            ]
        );
        return redirect()->route('editSubCategories',$id)->with('flash_message', 'Delete File successfully');
        

    }
 

}