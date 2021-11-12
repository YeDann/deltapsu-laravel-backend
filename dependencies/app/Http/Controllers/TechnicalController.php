<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;

class TechnicalController extends Controller
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
    
        $contents = DB::table('article_has_categories as anc')
        ->join('contents as c' ,'c.id' ,'=','anc.content_id')
        ->join('contents_translations as ct' ,'ct.content_id' ,'=','c.id')
        ->join('tech_type as ty' ,'ty.id' ,'=','anc.categories_id')
        ->join('tech_type_translation as tyt' ,'ty.id' ,'=','tyt.tech_id')
        ->where('ct.local', '=', 'en')
        ->where('tyt.local', '=', 'en')
        ->where('c.content_type', '=', 'blog')
        ->select('c.*' ,'ct.*','tyt.name as cateName')
        ->orderBy('c.created_at', 'desc')
        ->distinct()
        ->get();
        
        $language = DB::table('language')->get();

        return view('technical.index')
            ->with('name', 'update')
            ->with('menu', 'technical')
            ->with('language', $language)
            ->with('contents',$contents);
    }
    // public function ImportArticle($type){
    //     $contents = DB::table('old_contents')
    //     ->where('type', '=', $type)
    //     ->orderBy('translate_id', 'asc')
    //     ->orderBy('id', 'asc')
    //     ->get();
          
    //     $Translation = [];
    //     $newId  = [];
    //     $checkcate = [];
    //     foreach($contents as $data){
    //         if(!in_array($data->translate_id, $Translation)){
    //             $newId  = [];
    //                array_push($Translation ,$data->translate_id);
    //              $id = DB::table('contents')->insertGetID(
    //                     [
    //                         "content_type" => "blog",
    //                         "thumb" => $data->thumb,
    //                         "created_at" => $data->created_at,
    //                         "updated_at" => $data->updated_at,
    //                         "date_publish" => $data->ext_2,
    //                         "date_info" => $data->ext_2,
    //                         "date_end" => $data->ext_4,
    //                         "slug" => preg_replace('/[^A-Za-z0-9\-]/', '', $data->slug),
    //                         "status" => $data->status,
    //                     ]
    //                 );
    //                 array_push($newId ,$id);
    //                 $cate_id = DB::table('contents_cat4s')
    //                 ->where('contents_id', '=',$data->id)
    //                 ->select('categorys_id')
    //                 ->get();
                
    //                 array_push($checkcate ,$data->id ,count($cate_id));
    //               if(count($cate_id) != 0){
    //                 $catenew_id;
    //                 if($cate_id[0]->categorys_id == 679){
    //                     $catenew_id = 1;
    //                 }else if($cate_id[0]->categorys_id == 686){
    //                     $catenew_id = 2;
    //                 }else if($cate_id[0]->categorys_id == 688){
    //                     $catenew_id = 3;
    //                 }else if($cate_id[0]->categorys_id == 690){
    //                     $catenew_id = 4;
    //                 }else if($cate_id[0]->categorys_id == 746){
    //                     $catenew_id = 5;
    //                 }

    //                 DB::table('article_has_categories')->insert(
    //                     [
    //                         "content_id" => $newId[0],
    //                         "categories_id" => $catenew_id,
    //                     ]
    //                 );
    //               }
    //          }

    //          DB::table('contents_translations')->insert(
    //             [
    //                 "content_id" =>$newId[0],
    //                 "title" => $data->title,
    //                 "content" => $data->content,
    //                 "description" => $data->description,
    //                 "meta_title" => $data->meta_title,
    //                 "meta_description" =>$data->meta_description,
    //                 "meta_keywords" =>$data->meta_keywords,
    //                 'file' => $data->ext_10,
    //                 "local"=>$data->language,
    //             ]
    //         );

    //     }
    //     return redirect()->route('technical.index')->with('flash_message', 'Insert Data successfully');
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $techType = DB::table('tech_type as tc')
        ->join('tech_type_translation as tct','tc.id','=','tct.tech_id')
        ->select('tc.*','tct.*')
        ->get();
        $language = DB::table('language')->get();
        return view('technical.create')
            ->with('name', "update")
            ->with('menu', "technical")
            ->with('language',$language)
            ->with('techType',$techType);
    }
    private function  SaveimageArray($arrayfile ,$arrfilename){
        $arrayfileName = [];
      foreach ($arrfilename as $key => $value) {
              $emptyornot = isset($arrayfile[$value]);
              if($emptyornot){
              $fileName = preg_replace('/\s+/', '', uniqid().$arrayfile[$value]->getClientOriginalName());
              $arrayfile[$value]->move(base_path('/../uploads_delta'),$fileName);
              $arrayfileName[$value] = $fileName;
              }else{
               $fileName = '';
               $arrayfileName[$value] = $fileName;
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
           
        $validate = Validator::make($request->all(), [
            'title' => 'required',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        } else {
            $title = $request->title;
            $newsType = $request->type;
            $datePublish = $request->datePublish;
            $datainfo = $request->dateinfo;
            $newsStatus = $request->status;
            $Content = $request->content;
            $metaTitle = $request->metaTitle;
            $metaDescription = $request->metaDescription;
            $metaKeyword = $request->metaKeyword;
            $filename = $request->namefile;
            $file  = $request->file;
            $arrFileName =  Self::SaveimageArray($file , $filename);
            $langloop = $request->langloop;
            $re1 = str_replace("/","_",$title);
            $key = str_replace(" ","-",$re1);
            $slug  =  $key;

                    $id = DB::table('contents')->insertGetID(
                        [
                            "content_type" => "blog",
                            "thumb" => $arrFileName['thumbnail'],
                            "created_at" => \Carbon\Carbon::now(),
                            "updated_at" => \Carbon\Carbon::now(),
                            "date_publish" => $datePublish,
                            "date_info" => $request->dateinfo,
                            "slug" => $slug,
                            "status" => $newsStatus,
                        ]
                    );
                    DB::table('article_has_categories')->insert(
                        [
                            "content_id" => $id,
                            "categories_id" =>$newsType,
                        ]
                    );
                    foreach($langloop as $lang){
                        DB::table('contents_translations')->insert(
                            [
                                "content_id" =>$id,
                                "title" => $title,
                                "content" => $Content,
                                "description"=>$request->description,
                                "meta_title" => $metaTitle,
                                "meta_description" => $metaDescription,
                                "meta_keywords" => $metaKeyword,
                                "local"=>$lang,
                            ]
                        );
                    }
                 
                    return redirect()->route('technical.index')->with('flash_message', 'Insert Data successfully');
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
     
        $contents = DB::table('article_has_categories as anc')
        ->join('contents as c' ,'c.id' ,'=','anc.content_id')
        ->join('contents_translations as ct' ,'ct.content_id' ,'=','c.id')
        ->join('tech_type as ty' ,'ty.id' ,'=','anc.categories_id')
        ->join('tech_type_translation as tyt' ,'ty.id' ,'=','tyt.tech_id')
        ->where('tyt.local', '=', 'en')
        ->where('c.id', '=', $id)
        ->where('c.content_type', '=', 'blog')
        ->select('c.*' ,'ct.*','tyt.name as cateName')
        ->orderBy('c.created_at', 'desc')
        ->get();

        $techType = DB::table('tech_type as tc')
        ->join('tech_type_translation as tct','tc.id','=','tct.tech_id')
        ->select('tc.*','tct.*')
        ->get();
        $language = DB::table('language')->get();

        return view('technical.edit')
        ->with('name', "update")
        ->with('menu', "technical")
        ->with('language', $language)
        ->with('contents', $contents)
        ->with('techType', $techType);
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
      
        $techId = $request->techId;
        $datePublish = $request->datePublish;
        $newsStatus = $request->status;
        $newsType = $request->newsType;
        $langloop = $request->langloop;
        $title  = $request->title;
        $content = $request->content;
        $meta_title = $request->meta_title;
        $meta_des  = $request->meta_des;
        $meta_key  = $request->meta_key;
        $oldfilethumb = $request->oldfilethumb;
        $imageName  = $oldfilethumb;
        $re1 = str_replace("/","_",$title['en']);
        $key = str_replace(" ","-",$re1);
        $slug  =  $key;
      
        if ($request->hasFile("thumb")) {
            $imageFile = $request->file("thumb");
            $imageName = uniqid().$imageFile->getClientOriginalName();
            $imageFile->move(base_path('/../uploads_delta'), preg_replace('/\s+/', '', $imageName));
        }
        DB::table('contents')->where('id',$techId)->update(
            [
                "thumb" =>   preg_replace('/\s+/', '', $imageName),
                "updated_at" => \Carbon\Carbon::now(),
                "date_publish" => $datePublish,
                "date_info" => $request->dateinfo,
                "slug" => $slug,
                "status" => $newsStatus,
            ]
        );
        DB::table('product_news_has_categories')->where('content_id',$techId)->update(
            [
                "categories_id" => $newsType,
            ]
        );
     
        foreach($langloop as $lang){
            DB::table('contents_translations')->where('content_id',$techId)->where('local',$lang)->update(
                [
                    "title" => $title[$lang],
                    "content" => $content[$lang],
                    "meta_title" => $meta_title[$lang],
                    "meta_description" => $meta_des[$lang],
                    "meta_keywords" => $meta_key[$lang],
                ]
            );
        }
        return redirect()->route('technical.index')->with('flash_message', 'Update Data successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $con = DB::table('contents')
        ->where('id' ,$id)
        ->select('contents.thumb')
        ->first();
        if($con->thumb != null && $con->thumb != '' ){
        $file_pointer2 = base_path('/../uploads_delta').$con->thumb;
        if (file_exists($file_pointer2) && isset($con->thumb)) {
            unlink($file_pointer2);
        }
    }

        DB::table('contents')->where('id', '=', $id)->delete();
        DB::table('contents_translations')->where('content_id', '=', $id)->delete();
        DB::table('article_has_categories')->where('content_id', '=', $id)->delete();

        return back()->with('flash_message', 'Delete Data successfully');
    }

    public function copyTechsingle(Request $request)
    {

        $techId = $request->techId;
        $new_local = $request->language;

        $contentEn = DB::table('contents')
            ->where("contents.translate_id", '=', $techId)
            ->select('contents.*')
            ->get();

        foreach ($contentEn as $item) {

            $check_local = DB::table('contents')
                ->where('contents.translate_id', '=', $item->translate_id)
                ->where('contents.language', '=', $new_local)
                ->get();

            if (count($check_local) == 0) {
                DB::table('contents')->insert(
                    [
                        "language" => $new_local,
                        "translate_id" => $item->translate_id,
                        "type" => $item->type,
                        "news_type" => $item->news_type,
                        "date_publish" => $item->date_publish,
                        "thumb" => $item->thumb,
                        "title" => $item->title,
                        "content" => $item->content,
                        "created_at" => $item->created_at,
                        "updated_at" => $item->updated_at,
                        "status" => $item->status,
                        "slug" => $item->slug,
                        "meta_title" => $item->meta_title,
                        "meta_description" => $item->meta_description,
                        "meta_keywords" => $item->meta_keywords,
                    ]
                );
            }
        }
        return redirect()->route('technical.index')->with('flash_message', 'Copy Data successfully');
    }

    public function copyTechnical(Request $request)
    {
        $new_local = $request->language;

        $contentEn = DB::table('contents')
            ->where('contents.type', '=', 'blog')
            ->select('contents.*')
            ->get();

        // return dd($contentEn);

        foreach ($contentEn as $item) {
            $check_local = DB::table('contents')
                ->where('contents.type', '=', 'news')
                ->where('contents.translate_id', '=', $item->translate_id)
                ->where('contents.language', '=', $new_local)
                ->get();

            if (count($check_local) == 0) {
                DB::table('contents')->insert(
                    [
                        "language" => $new_local,
                        "translate_id" => $item->translate_id,
                        "type" => $item->type,
                        "news_type" => $item->news_type,
                        "date_publish" => $item->date_publish,
                        "thumb" => $item->thumb,
                        "title" => $item->title,
                        "content" => $item->content,
                        "created_at" => $item->created_at,
                        "updated_at" => $item->updated_at,
                        "status" => $item->status,
                        "meta_title" => $item->meta_title,
                        "meta_description" => $item->meta_description,
                        "meta_keywords" => $item->meta_keywords,
                    ]
                );
            }
        }

        return redirect()->route('technical.index')->with('flash_message', 'Copy Data successfully');
    }
}
