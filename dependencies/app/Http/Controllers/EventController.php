<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;

class EventController extends Controller
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
        $contents = DB::table('contents as c')
        ->join('contents_translations as ct' ,'ct.content_id' ,'=','c.id')
        ->where('ct.local', '=', 'en')
        ->where('c.content_type', '=', 'event')
        ->select('c.*' ,'ct.*')
        ->orderBy('c.created_at', 'desc')
        ->get();

        $language = DB::table('language')->get();

        return view('event.index')
        ->with('name','update')
        ->with('menu','event')
        ->with('language',$language)
        ->with('contents',$contents);
    }
    // public function ImportEvent($type){

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
    //                         "content_type" => "event",
    //                         "thumb" => $data->thumb,
    //                         "created_at" => $data->created_at,
    //                         "updated_at" => $data->updated_at,
    //                         "date_publish" => $data->ext_2,
    //                         "date_info" => $data->ext_2,
    //                         "date_end" => $data->ext_4,
    //                         "date_end" => $data->ext_4,
    //                         "slug" => preg_replace('/[^A-Za-z0-9\-]/', '', $data->slug),
    //                         "status" => $data->status,
    //                     ]
    //                 );
    //                 array_push($newId ,$id);

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
    //                 "location" =>$data->ext_3,
    //                 'file' => $data->ext_10,
    //                 "local"=>$data->language,
    //             ]
    //         );

    //     }
    //     return redirect()->route('event.index')->with('flash_message', 'Insert Data successfully');
      
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = DB::table('language')->get();
        return view('event.create')
        ->with('language',$language)
        ->with('name','update')
        ->with('menu','event');
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
            $langloop = $request->langloop;
            $title = $request->title;
            $dateStart = $request->date_start;
            $dateEnd =$request->date_end;
            $timeStart = $request->time_start;
            $timeEnd = $request->time_end;
            $status = $request->status;
            $location = $request->location;
            $content = $request->content;
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
                            "content_type" => "event",
                            "thumb" => $arrFileName['thumbnail'],
                            "created_at" => \Carbon\Carbon::now(),
                            "updated_at" => \Carbon\Carbon::now(),
                            "date_publish" => $dateStart,
                            "date_end"=> $dateEnd,
                            "slug"=> $slug,
                            "time_start"=> $timeStart,
                            "time_end"=> $timeEnd,
                            "status" => $status,
                        ]
                    );

                    foreach($langloop as $lang){
                        DB::table('contents_translations')->insert(
                            [
                                "content_id" =>$id,
                                "title" => $title,
                                "content" => $content,
                                "description"=>$request->description,
                                "meta_title" => isset($metaTitle) ? $metaTitle :null ,
                                "location" =>$request->location,
                                "meta_description" => $metaDescription,
                                "head" => $request->head,
                                "local"=>$lang,
                            ]
                        );
                    }
                    return redirect()->route('event.index')->with('flash_message', 'Insert Data successfully');
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
       
        $language = DB::table('language')->get();
        $contents = DB::table('contents as c')
        ->join('contents_translations as ct' ,'ct.content_id' ,'=','c.id')
        ->where('c.content_type', '=', 'event')
        ->where('id' ,$id)
        ->select('c.*' ,'ct.*')
        ->orderBy('c.created_at', 'desc')
        ->get();


        return view('event.edit')
        ->with('name', "update")
        ->with('menu', "event")
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
        $eventId = $request->eventId;
        $dateStart = $request->date_start;
        $dateEnd = $request->date_end;
        $timeStart = $request->time_start;
        $timeEnd = $request->time_end;
        $status = $request->status;
        $title = $request->title;
        $content = $request->content;
        $description = $request->description;
        $location = $request->location;
        $meta_title = $request->meta_title;
        $meta_des =$request->meta_des;
        $meta_key = $request->meta_key;
        $oldfilethumb = $request->oldfilethumb;
        $imageName  = $oldfilethumb;
        $langloop = $request->langloop;
        $location = $request->location;
        // return dd($title['en']);
        $re1 = str_replace("/","_",$title['en']);
        $key = str_replace(" ","-",$re1);
        $slug  =  $key;
        if ($request->hasFile("thumb")) {
            $imageFile = $request->file("thumb");
            $imageName = uniqid().$imageFile->getClientOriginalName();
            $imageFile->move(base_path('/../uploads_delta'), preg_replace('/\s+/', '', $imageName));

            $file_pointer = base_path('/../uploads_delta/').$oldfilethumb;
            if (file_exists($file_pointer) && $oldfilethumb != null ) {
                unlink($file_pointer);
            }
        }
        $id = DB::table('contents')->where('id',$eventId)->update(
            [
                "content_type" => "event",
                "thumb" =>  preg_replace('/\s+/', '', $imageName),
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
                "date_publish" => $dateStart,
                "date_end"=> $dateEnd,
                "slug"=> $slug,
                "time_start"=> $timeStart,
                "time_end"=> $timeEnd,
                "status" => $status,
            ]
        );
     
        foreach($langloop as $lang){
            DB::table('contents_translations')->where('content_id',$eventId)->where('local',$lang)->update(
                [
                    "title" => $title[$lang],
                    "content" => $content[$lang],
                    "description"=>$description[$lang],
                    "location"=>$location[$lang],
                    "meta_title" => isset($meta_title[$lang]) ? $meta_title[$lang] :null ,
                    "meta_description" => $meta_des[$lang],
                    "head" => $request->head[$lang] ?? '',
                ]
            );
        }
        return redirect()->route('event.index')->with('flash_message', 'Update Data successfully');
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

        return back()->with('flash_message', 'Delete Data successfully');
    }


    public function copyEventsingle(Request $request){
        $eventId = $request->eventId;
        $new_local = $request->language;

        $contentEn = DB::table('contents')
            ->where("contents.translate_id", '=', $eventId)
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
                        "date_end"=> $item->date_end,
                        "time_start" => $item->time_start,
                        "time_end" => $item->time_end,
                        "thumb" => $item->thumb,
                        "title" => $item->title,
                        "content" => $item->content,
                        "address_1" => $item->address_1,
                        "address_2" => $item->address_2,
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
        return redirect()->route('event.index')->with('flash_message', 'Copy Data successfully');
    }

    public function copyEvent(Request $request)
    {
        $new_local = $request->language;

        $contentEn = DB::table('contents')
            ->where('contents.type', '=', 'event')
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
                        "date_end"=> $item->date_end,
                        "time_start" => $item->time_start,
                        "time_end" => $item->time_end,
                        "thumb" => $item->thumb,
                        "title" => $item->title,
                        "slug" => $item->slug,
                        "content" => $item->content,
                        "address_1" => $item->address_1,
                        "address_2" => $item->address_2,
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

        return redirect()->route('event.index')->with('flash_message', 'Copy Data successfully');
    }
}