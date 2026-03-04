<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Validator;

class VideoController extends Controller
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
        $contents = DB::table('product_video_has_categories as pvc')
            ->join('contents as c', 'c.id', '=', 'pvc.content_id')
            ->join('contents_translations as ct', 'ct.content_id', '=', 'c.id')
            ->join('video_type as vt', 'vt.id', '=', 'pvc.categories_id')
            ->where('ct.local', '=', 'en')
            ->where('c.content_type', '=', 'video')
            ->select('c.*', 'ct.*', 'vt.name as cateName', 'pvc.video_link')
            ->orderBy('c.updated_at', 'desc')
            ->distinct()
            ->get();

        $countContent = count($contents);

        $language = DB::table('language')->get();

        return view('video.index')
            ->with('name', 'update')
            ->with('menu', 'videos')
            ->with('contents', $contents)
            ->with('countContent', $countContent)
            ->with('language', $language);
    }

    public function ImportVideoData($type)
    {
        return redirect()->route('video.index')->with('flash_message', 'Insert Data successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $videoType = DB::table('video_type')
            ->get();
        $language = DB::table('language')->get();
        return view('video.create')
            ->with('name', "update")
            ->with('menu', "videos")
            ->with('language', $language)
            ->with('videoType', $videoType);
    }


    private function SaveimageArray($arrayfile, $arrfilename)
    {
        $arrayfileName = [];
        foreach ($arrfilename as $key => $value) {
            $emptyornot = isset($arrayfile[$value]);
            if ($emptyornot) {
                $fileName = preg_replace('/\s+/', '', uniqid().$arrayfile[$value]->getClientOriginalName());
                $arrayfile[$value]->move(base_path('/../uploads_delta'), $fileName);
                $arrayfileName[$value] = $fileName;
            } else {
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
            $videoType = $request->videoType;
            $videoLink = $request->video_link; // New field for YouTube link
            $datePublish = $request->datePublish;
            $datainfo = $request->dateinfo;
            $videoStatus = $request->videoStatus;
            $content = $request->content;
            $description = $request->description;
            $metaTitle = $request->metaTitle;
            $metaDescription = $request->metaDescription;

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
                    "content_type" => "video",
                    "thumb" => $arrFileName['thumbnail'],
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "date_publish" => $datePublish,
                    "date_info" => $request->dateinfo,
                    "slug" => $slug,
                    "status" => $videoStatus,
                ]
            );
            DB::table('product_video_has_categories')->insert(
                [
                    "content_id" => $id,
                    "categories_id" => $videoType,
                    "video_link" => $videoLink, // Save YouTube link
                ]
            );
            foreach($langloop as $lang){
                DB::table('contents_translations')->insert(
                    [
                        "content_id" =>$id,
                        "title" => $title,
                        "content" => $content,
                        "description"=>$request->description,
                        "meta_title" => $metaTitle,
                        "meta_description" => $metaDescription,
                        // "meta_keywords" => $metaKeyword,
                        'file' => isset($arrFileName['newsfile']) ? $arrFileName['newsfile'] : '',
                        "local"=>$lang,
                    ]
                );
            }

            return redirect()->route('video.index')->with('flash_message', 'Insert Data successfully');
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
        $videoType = DB::table('video_type')
            ->get();

        $contents = DB::table('contents as c')
            ->join('contents_translations as ct', 'ct.content_id', '=', 'c.id')
            ->join('product_video_has_categories as pvc', 'pvc.content_id', '=', 'c.id')
            ->where('c.id', $id)
            ->select('c.*', 'ct.*', 'pvc.categories_id', 'pvc.video_link')
            ->get();

        $language = DB::table('language')->get();

        return view('video.edit')
            ->with('name', 'update')
            ->with('menu', 'videos')
            ->with('language', $language)
            ->with('videoType', $videoType)
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
        $validate = Validator::make($request->all(), [
            'title' => 'required',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        } else {

            $title = $request->title;
            $videoType = $request->videoType;
            $videoLink = $request->video_link; // New field for YouTube link
            $datePublish = $request->datePublish;
            $datainfo = $request->dateinfo;
            $videoStatus = $request->videoStatus;
            $content = $request->content;
            $description = $request->description;
            $metaTitle = $request->metaTitle;
            $metaDescription = $request->metaDescription;
            $langloop = $request->langloop;
            $videoId = $request->videoId;
            $oldThumb = $request->oldThumb;
            $oldfile = $request->oldfile;

            // Handle Thumbnail
            $thumbName = $oldThumb;
            if ($request->hasFile("thumb")) {
                $imageFile = $request->file("thumb");
                $thumbName = uniqid().$imageFile->getClientOriginalName();
                $imageFile->move(base_path('/../uploads_delta'), preg_replace('/\s+/', '', $thumbName));
                $thumbName = preg_replace('/\s+/', '', $thumbName);

                // Delete old thumbnail
                if ($oldThumb) {
                    $file_pointer = base_path('/../uploads_delta/').$oldThumb;
                    if (file_exists($file_pointer)) {
                        unlink($file_pointer);
                    }
                }
            }

            // Handle main file upload
            $oldMainFile = $request->oldMainFile;
            $fileName = $oldMainFile;
            if ($request->hasFile("file")) {
                $fileUpload = $request->file("file");
                $fileName = preg_replace('/\s+/', '', uniqid().$fileUpload->getClientOriginalName());
                $fileUpload->move(base_path('/../uploads_delta'), $fileName);
                
                // Delete old main file
                if ($oldMainFile) {
                    $file_pointer = base_path('/../uploads_delta/').$oldMainFile;
                    if (file_exists($file_pointer)) {
                        unlink($file_pointer);
                    }
                }
            }

            // Handle Filelang (Files per language)
            $fileLangNames = [];
            foreach ($langloop as $lang) {
                $fileLangNames[$lang] = isset($oldfile[$lang]) ? $oldfile[$lang] : '';
                
                if ($request->hasFile('Filelang') && isset($request->file('Filelang')[$lang])) {
                    $f = $request->file('Filelang')[$lang];
                    $fName = preg_replace('/\s+/', '', uniqid().$f->getClientOriginalName());
                    $f->move(base_path('/../uploads_delta'), $fName);
                    
                    // Delete old file
                    if (isset($oldfile[$lang]) && $oldfile[$lang]) {
                        $file_pointer = base_path('/../uploads_delta/').$oldfile[$lang];
                        if (file_exists($file_pointer)) {
                            unlink($file_pointer);
                        }
                    }
                    
                    $fileLangNames[$lang] = $fName;
                }
            }

            // Slug generation
            $slugTitle = $title['en'];
            $re1 = str_replace("/", "_", $slugTitle);
            $key = str_replace(" ", "-", $re1);
            $key2 = $this->clean($key);
            $slug  =  $key2;

            DB::table('contents')->where('id', $videoId)->update([
                "thumb" => $thumbName,
                "file" => $fileName,
                "updated_at" => \Carbon\Carbon::now(),
                "date_publish" => $datePublish,
                "date_info" => $datainfo,
                "slug" => $slug,
                "status" => $videoStatus,
            ]);

            DB::table('product_video_has_categories')
                ->where('content_id', $videoId)
                ->update([
                    "categories_id" => $videoType,
                    "video_link" => $videoLink, // Update YouTube link
                ]);

            foreach ($langloop as $lang) {
                $data = DB::table('contents_translations')
                    ->where('content_id', $videoId)
                    ->where('local', $lang)
                    ->get();

                if (count($data) > 0) {
                    DB::table('contents_translations')
                        ->where('content_id', $videoId)
                        ->where('local', $lang)
                        ->update([
                            "title" => isset($title[$lang]) ? $title[$lang] : '',
                            "content" => isset($content[$lang]) ? $content[$lang] : '',
                            "description" => isset($description[$lang]) ? $description[$lang] : '',
                            "meta_title" => isset($metaTitle[$lang]) ? $metaTitle[$lang] : '',
                            "meta_description" => isset($metaDescription[$lang]) ? $metaDescription[$lang] : '',
                            'file' => $fileLangNames[$lang],
                        ]);
                } else {
                    DB::table('contents_translations')->insert([
                        "content_id" => $videoId,
                        "title" => isset($title[$lang]) ? $title[$lang] : '',
                        "content" => isset($content[$lang]) ? $content[$lang] : '',
                        "description" => isset($description[$lang]) ? $description[$lang] : '',
                        "meta_title" => isset($metaTitle[$lang]) ? $metaTitle[$lang] : '',
                        "meta_description" => isset($metaDescription[$lang]) ? $metaDescription[$lang] : '',
                        'file' => $fileLangNames[$lang],
                        "local" => $lang,
                    ]);
                }
            }

            return redirect()->route('video.index')->with('flash_message', 'Update Data successfully');
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
        DB::table('contents')->where('id', '=', $id)->delete();
        DB::table('contents_translations')->where('content_id', '=', $id)->delete();
        DB::table('product_video_has_categories')->where('content_id', '=', $id)->delete();
        return back()->with('flash_message', 'Delete Data successfully');
    }

    // Helper functions
    protected function clean($string)
    {
        $string = str_replace(' ', '-', $string);
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    }

    public function copyVideosingle(Request $request)
    {
        $videoId = $request->videoId;
        $contents = DB::table('contents as c')
            ->join('contents_translations as ct', 'ct.content_id', '=', 'c.id')
            ->join('product_video_has_categories as pvc', 'pvc.content_id', '=', 'c.id')
            ->where('c.id', $videoId)
            ->select('c.*', 'ct.*', 'pvc.categories_id', 'pvc.video_link')
            ->get();

        if (count($contents) > 0) {
            $content = $contents[0];
            $id = DB::table('contents')->insertGetID([
                "content_type" => "video",
                "thumb" => $content->thumb,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
                "date_publish" => $content->date_publish,
                "date_info" => $content->date_info,
                "slug" => $content->slug . '-copy',
                "status" => $content->status,
            ]);

            DB::table('product_video_has_categories')->insert([
                "content_id" => $id,
                "categories_id" => $content->categories_id,
                "video_link" => $content->video_link,
            ]);

            foreach ($contents as $translation) {
                DB::table('contents_translations')->insert([
                    "content_id" => $id,
                    "title" => $translation->title . ' - Copy',
                    "content" => $translation->content,
                    "description" => $translation->description,
                    "meta_title" => $translation->meta_title,
                    "meta_description" => $translation->meta_description,
                    'file' => $translation->file,
                    "local" => $translation->local,
                ]);
            }
        }

        return redirect()->route('video.index')->with('flash_message', 'Copy Data successfully');
    }

    public function copyVideo(Request $request)
    {
        $videosIdCheck = $request->videosIdCheck;
        foreach ($videosIdCheck as $videoId) {
            $this->copyVideosingle(new Request(['videoId' => $videoId]));
        }
        return redirect()->route('video.index')->with('flash_message', 'Copy Data successfully');
    }

    public function removeFileVideoDoc($name, $id)
    {
        DB::table('contents_translations')
            ->where('local', $name)
            ->where('content_id', $id)
            ->update([
                "file" => null,
            ]);
        return redirect()->route('video.edit', $id)->with('flash_message', 'Delete File successfully');
    }
}