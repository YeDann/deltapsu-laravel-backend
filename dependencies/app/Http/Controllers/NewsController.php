<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Validator;

class NewsController extends Controller
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
        $contents = DB::table('product_news_has_categories as pnc')
            ->join('contents as c' ,'c.id' ,'=','pnc.content_id')
            ->join('contents_translations as ct' ,'ct.content_id' ,'=','c.id')
            ->join('news_type as nt' ,'nt.id' ,'=','pnc.categories_id')
            ->where('ct.local', '=', 'en')
            ->where('c.content_type', '=', 'news')
            ->select('c.*' ,'ct.*','nt.name as cateName')
            ->orderBy('c.updated_at', 'desc')
            ->distinct()
            ->get();

            //     $contents = DB::table('contents as c')
            // ->join('contents_translations as ct' ,'ct.content_id' ,'=','c.id')
            // ->where('ct.local', '=', 'en')
            // ->where('c.content_type', '=', 'news')
            // ->select('c.*' ,'ct.*')
            // ->orderBy('c.updated_at', 'desc')
            // ->get();

    //   $data =  DB::table('contents as c')->select('c.*')->get();
    //   foreach($data as $item){
    //     DB::table('contents')->where('id',$item->id)->update(
    //         [
    //             "slug" =>  str_replace("”","",$item->slug),
           
    //         ]
    //     );
    //   }
           
                    
            // return dd($contents);
        $countContent = count($contents);

        $language = DB::table('language')->get();

        return view('news.index')
            ->with('name', 'update')
            ->with('menu', 'news')
            ->with('contents', $contents)
            ->with('countContent', $countContent)
            ->with('language', $language);
    }
    public function ImportNewsData($type){
    //     $contents = DB::table('contents')
    //     ->where('content_type', '=', 'news')
    //     ->orderBy('id', 'asc')
    //     ->get();
    //    foreach($contents as $con){
    //     DB::table('contents')->where('id', '=', $con->id)->delete();
    //     DB::table('contents_translations')->where('content_id', '=', $con->id)->delete();
    //    }
    //    return dd('ok');
 

        // $contents = DB::table('old_contents')
        // ->where('type', '=', $type)
        // ->orderBy('translate_id', 'asc')
        // ->orderBy('id', 'asc')
        // ->get();
          
        // $Translation = [];
        // $newId  = [];
        // $checkcate = [];
        // foreach($contents as $data){
        //     if(!in_array($data->translate_id, $Translation)){
        //         $newId  = [];
        //            array_push($Translation ,$data->translate_id);
        //          $id = DB::table('contents')->insertGetID(
        //                 [
        //                     "content_type" => "news",
        //                     "thumb" => $data->thumb,
        //                     "created_at" => $data->created_at,
        //                     "updated_at" => $data->updated_at,
        //                     "date_publish" => $data->ext_2,
        //                     "date_info" => $data->ext_2,
        //                     "date_end" => $data->ext_4,
        //                     "slug" => preg_replace('/[^A-Za-z0-9\-]/', '', $data->slug),
        //                     "status" => $data->status,
        //                 ]
        //             );
        //             array_push($newId ,$id);
                    
        //             $cate_id = DB::table('contents_cat1s')
        //             ->where('contents_id', '=',$data->id)
        //             ->select('categorys_id')
        //             ->get();
                
        //             array_push($checkcate ,$data->id ,count($cate_id));
        //           if(count($cate_id) != 0){
        //             $catenew_id;
        //             if($cate_id[0]->categorys_id == 65){
        //                 $catenew_id = 7;
        //             }else if($cate_id[0]->categorys_id == 15){
        //                 $catenew_id = 8;
        //             }else if($cate_id[0]->categorys_id == 992){
        //                 $catenew_id = 9;
        //             }else if($cate_id[0]->categorys_id == 67){
        //                 $catenew_id = 10;
        //             }else if($cate_id[0]->categorys_id == 69){
        //                 $catenew_id = 11;
        //             }

        //             DB::table('product_news_has_categories')->insert(
        //                 [
        //                     "content_id" => $newId[0],
        //                     "categories_id" => $catenew_id,
        //                 ]
        //             );

        //           }

        //      }

        //      DB::table('contents_translations')->insert(
        //         [
        //             "content_id" =>$newId[0],
        //             "title" => $data->title,
        //             "content" => $data->content,
        //             "description" => $data->description,
        //             "meta_title" => $data->meta_title,
        //             "meta_description" =>$data->meta_description,
        //             "meta_keywords" =>$data->meta_keywords,
        //             'file' => $data->ext_10,
        //             "local"=>$data->language,
        //         ]
        //     );

        // }

        return redirect()->route('news.index')->with('flash_message', 'Insert Data successfully');
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $newsType = DB::table('news_type')
            ->get();
         $language = DB::table('language')->get();
        return view('news.create')
            ->with('name', "update")
            ->with('menu', "news")
            ->with('language', $language)
            ->with('newsType', $newsType);
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
            $newsType = $request->newsType;
            $datePublish = $request->datePublish;
            $datainfo = $request->dateinfo;
            $newsStatus = $request->newsStatus;
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
            $key2 = $this->clean($key);
            $slug  =  $key2;

                    $id = DB::table('contents')->insertGetID(
                        [
                            "content_type" => "news",
                            "thumb" => $arrFileName['thumbnail'],
                            "created_at" => \Carbon\Carbon::now(),
                            "updated_at" => \Carbon\Carbon::now(),
                            "date_publish" => $datePublish,
                            "date_info" => $request->dateinfo,
                            "slug" => $slug,
                            "status" => $newsStatus,
                        ]
                    );
                    DB::table('product_news_has_categories')->insert(
                        [
                            "content_id" => $id,
                            "categories_id" => $newsType,
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
                                'file' => $arrFileName['newsfile'],
                                "local"=>$lang,
                            ]
                        );
                    }
                 
                    return redirect()->route('news.index')->with('flash_message', 'Insert Data successfully');
                
            
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
    
            $contents = DB::table('product_news_has_categories as pnc')
            ->join('contents as c' ,'c.id' ,'=','pnc.content_id')
            ->join('contents_translations as ct' ,'ct.content_id' ,'=','c.id')
            ->join('news_type as nt' ,'nt.id' ,'=','pnc.categories_id')
            ->where('c.content_type', '=', 'news')
            ->where('c.id', '=', $id)
            ->select('c.*' ,'ct.*','nt.name as cateName','pnc.*')
            ->orderBy('c.created_at', 'desc')
            ->distinct()
            ->get();

            // return  dd( $contents);
        $language = DB::table('language')->get();
        $newsType = DB::table('news_type')
            ->get();

        return view('news.edit')
            ->with('name', "update")
            ->with('menu', "news")
            ->with('contents', $contents)
            ->with('language', $language)
            ->with('newsType', $newsType);
    }
   
    private function UpdateOldfile($loopfile ,$loop ,$oldfile){
        
        $arrayfileName = [];
           foreach($loop as $lang){
               $emptyornot = isset($loopfile[$lang]);
               if($emptyornot){
                        $fileName[$lang] = preg_replace('/\s+/', '', uniqid().$loopfile[$lang]->getClientOriginalName());
                        $loopfile[$lang]->move(base_path('/../uploads_delta'),$fileName[$lang]);
                        $arrayfileName[$lang] = $fileName[$lang];
               }else{
                 $arrayfileName[$lang] = $oldfile[$lang];
               }
           }
       return $arrayfileName;
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
        $newsId = $request->newsId;
        $description = $request->description;
        $datePublish = $request->datePublish;
        $newsStatus = $request->newsStatus;
        $newsType = $request->newsType;
        $langloop = $request->langloop;
        $oldFile   = $request->oldFile;
        $Filelang  =  $request->Filelang;
        $title  = $request->title;
        $content = $request->content;
        $meta_title = $request->meta_title;
        $meta_des  = $request->meta_des;
        $meta_key  = $request->meta_key;
        $oldfilethumb = $request->oldfilethumb;
        $imageName  = $oldfilethumb;
        $re1 = str_replace("/","_",$title['en']);
        $key = str_replace(" ","-",$re1);
        $key2 = $this->clean($key);
        $slug  =  $key2;
       
        if ($request->hasFile("thumb")) {
            $imageFile = $request->file("thumb");
            $imageName = uniqid().$imageFile->getClientOriginalName();
            $imageFile->move(base_path('/../uploads_delta'), preg_replace('/\s+/', '', $imageName));
        }
        DB::table('contents')->where('id',$newsId)->update(
            [
                "thumb" =>   preg_replace('/\s+/', '', $imageName),
                "updated_at" => \Carbon\Carbon::now(),
                "date_publish" => $datePublish,
                "date_info" => $request->dateinfo,
                "slug" => $slug,
                "status" => $newsStatus,
            ]
        );
        DB::table('product_news_has_categories')->where('content_id',$newsId)->update(
            [
                "categories_id" => $newsType,
            ]
        );
        $arrrayName = self::UpdateOldfile($Filelang, $langloop,$oldFile);
        foreach($langloop as $lang){
            DB::table('contents_translations')->where('content_id',$newsId)->where('local',$lang)->update(
                [
                    "title" => $title[$lang],
                    "content" => $content[$lang],
                    "meta_title" => $meta_title[$lang],
                    "meta_description" => $meta_des[$lang],
                    "description"=>$description[$lang],
                    "meta_keywords" => $meta_key[$lang],
                    'file' =>  $arrrayName[$lang],
                ]
            );
        }

        return redirect()->route('news.index')->with('flash_message', 'Update Data successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $con_trans = DB::table('contents_translations as ct')
        ->where('content_id' ,$id)
        ->select('ct.file')
        ->get();
    
        foreach($con_trans  as $cot){
            if($cot->file != null && $cot->file != '' ){
                $file_pointer = base_path('/../uploads_delta').$cot->file;
                if (file_exists($file_pointer) && isset($cot->file)) {
                    unlink($file_pointer);
                }
         
            }
        }

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
        DB::table('product_news_has_categories')->where('content_id', '=', $id)->delete();

        return back()->with('flash_message', 'Delete Data successfully');
    }

  
    public function copyNewssingle(Request $request)
    {

        $newsId = $request->newsId;
        $new_local = $request->language;

        $contentEn = DB::table('contents')
            ->where("contents.translate_id", '=', $newsId)
            ->select('contents.*')
            ->get();

        foreach ($contentEn as $item) {

            $check_local = DB::table('contents')
                ->where('contents.translate_id', '=', $item->translate_id)
                ->where('contents.language', '=', $new_local)
                ->get();

            // return dd(count($check_local));

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
                        "description" => $item->description,
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
        return redirect()->route('news.index')->with('flash_message', 'Copy Data successfully');
    }

    public function copyNews(Request $request)
    {
        $new_local = $request->language;

        $contentEn = DB::table('contents')
            ->where('contents.type', '=', 'news')
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
                        "description" => $item->description,
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

        return redirect()->route('news.index')->with('flash_message', 'Copy Data successfully');
    }
   Public function removeFileNewsDoc($name , $id){
        $con_trans = DB::table('contents_translations as ct')
        ->where('content_id' ,$id)
        ->select('ct.file')
        ->get();
      
         if(isset($con_trans[0]->file) && count($con_trans) > 0){
          DB::table('contents_translations')->where('content_id',$id)->update(
            [
                'file' => '',
            ]
           );

           foreach($con_trans  as $cot){
            if($cot->file != null && $cot->file != '' ){
               $file_pointer = base_path('/../uploads_delta').$cot->file;
               if (file_exists($file_pointer) && isset($cot->file)) {
                   unlink($file_pointer);
               }
        
            }
           }
           return back()->with('flash_message', 'Delete File successfully');
     }else{
           return back()->with('flash_message_error', 'Can Not Detete File');
     }

   }
}
