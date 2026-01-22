<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Validator;

class EolController extends Controller
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
        $contents = DB::table('product_eol_has_categories as pnc')
            ->join('contents as c', 'c.id', '=', 'pnc.content_id')
            ->join('contents_translations as ct', 'ct.content_id', '=', 'c.id')
            ->join('eol_type as et', 'et.id', '=', 'pnc.categories_id')
            ->where('ct.local', '=', 'en')
            ->where('c.content_type', '=', 'eol')
            ->select('c.*', 'ct.*', 'et.name as cateName')
            ->orderBy('c.updated_at', 'desc')
            ->distinct()
            ->get();

        $countContent = count($contents);

        $language = DB::table('language')->get();

        return view('eol.index')
            ->with('name', 'update')
            ->with('menu', 'eol')
            ->with('contents', $contents)
            ->with('countContent', $countContent)
            ->with('language', $language);
    }

    public function ImportEolData($type)
    {
        return redirect()->route('eol.index')->with('flash_message', 'Insert Data successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $eolType = DB::table('eol_type')
            ->get();
        $language = DB::table('language')->get();
        return view('eol.create')
            ->with('name', "update")
            ->with('menu', "eol")
            ->with('language', $language)
            ->with('eolType', $eolType);
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
            $eolType = $request->eolType;
            $datePublish = $request->datePublish;
            $datainfo = $request->dateinfo;
            $eolStatus = $request->eolStatus;
            $Content = $request->content;
            $description = $request->description;
            $metaTitle = $request->meta_title;
            $metaDescription = $request->meta_des;

            $langloop = $request->langloop;

            $thumbName = '';
            if ($request->hasFile("thumb")) {
                $imageFile = $request->file("thumb");
                $thumbName = uniqid().$imageFile->getClientOriginalName();
                $imageFile->move(base_path('/../uploads_delta'), preg_replace('/\s+/', '', $thumbName));
                $thumbName = preg_replace('/\s+/', '', $thumbName);
            }

            $fileLangNames = [];
            if ($request->hasFile('Filelang')) {
                $files = $request->file('Filelang');
                foreach ($langloop as $lang) {
                    if (isset($files[$lang])) {
                        $f = $files[$lang];
                        $fName = preg_replace('/\s+/', '', uniqid().$f->getClientOriginalName());
                        $f->move(base_path('/../uploads_delta'), $fName);
                        $fileLangNames[$lang] = $fName;
                    } else {
                        $fileLangNames[$lang] = '';
                    }
                }
            }

            $slugTitle = isset($title['en']) ? $title['en'] : (reset($title) ?? '');
            $re1 = str_replace("/", "_", $slugTitle);
            $key = str_replace(" ", "-", $re1);
            $key2 = $this->clean($key);
            $slug  =  $key2;

            $id = DB::table('contents')->insertGetID(
                [
                    "content_type" => "eol",
                    "thumb" => $thumbName,
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "date_publish" => $datePublish,
                    "date_info" => $datainfo,
                    "slug" => $slug,
                    "status" => $eolStatus,
                ]
            );
            DB::table('product_eol_has_categories')->insert(
                [
                    "content_id" => $id,
                    "categories_id" => $eolType,
                ]
            );
            foreach ($langloop as $lang) {
                DB::table('contents_translations')->insert(
                    [
                        "content_id" => $id,
                        "title" => isset($title[$lang]) ? $title[$lang] : '',
                        "content" => isset($Content[$lang]) ? $Content[$lang] : '',
                        "description" => isset($description[$lang]) ? $description[$lang] : '',
                        "meta_title" => isset($metaTitle[$lang]) ? $metaTitle[$lang] : '',
                        "meta_description" => isset($metaDescription[$lang]) ? $metaDescription[$lang] : '',
                        'file' => isset($fileLangNames[$lang]) ? $fileLangNames[$lang] : '',
                        "local" => $lang,
                    ]
                );
            }

            return redirect()->route('eol.index')->with('flash_message', 'Insert Data successfully');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $contents = DB::table('product_eol_has_categories as pnc')
        ->join('contents as c', 'c.id', '=', 'pnc.content_id')
        ->join('contents_translations as ct', 'ct.content_id', '=', 'c.id')
        ->join('eol_type as et', 'et.id', '=', 'pnc.categories_id')
        ->where('c.content_type', '=', 'eol')
        ->where('c.id', '=', $id)
        ->select('c.id as content_id', 'c.*', 'ct.*', 'et.name as cateName', 'pnc.*')
        ->orderBy('c.created_at', 'desc')
        ->distinct()
        ->get();

        $language = DB::table('language')->get();
        $eolType = DB::table('eol_type')
            ->get();

        return view('eol.edit')
            ->with('name', "update")
            ->with('menu', "eol")
            ->with('contents', $contents)
            ->with('language', $language)
            ->with('eolType', $eolType);
    }

    private function UpdateOldfile($loopfile, $loop, $oldfile)
    {
        $arrayfileName = [];
        foreach ($loop as $lang) {
            $emptyornot = isset($loopfile[$lang]);
            if ($emptyornot) {
                $fileName[$lang] = preg_replace('/\s+/', '', uniqid().$loopfile[$lang]->getClientOriginalName());
                $loopfile[$lang]->move(base_path('/../uploads_delta'), $fileName[$lang]);
                $arrayfileName[$lang] = $fileName[$lang];

                if (isset($oldfile[$lang])) {
                    $file_pointer = base_path('/../uploads_delta/').$oldfile[$lang];
                    if (file_exists($file_pointer)) {
                        unlink($file_pointer);
                    }
                }

            } else {
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
        $eolId = $request->eolId;
        $description = $request->description;
        $datePublish = $request->datePublish;
        $eolStatus = $request->eolStatus;
        $eolType = $request->eolType;
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

        $slugTitle = isset($title['en']) ? $title['en'] : (reset($title) ?? '');
        $re1 = str_replace("/", "_", $slugTitle);
        $key = str_replace(" ", "-", $re1);
        $key2 = $this->clean($key);
        $slug  =  $key2;

        if ($request->hasFile("thumb")) {
            $imageFile = $request->file("thumb");
            $imageName = uniqid().$imageFile->getClientOriginalName();
            $imageFile->move(base_path('/../uploads_delta'), preg_replace('/\s+/', '', $imageName));

            $file_pointer = base_path('/../uploads_delta/').$oldfilethumb;
            if (file_exists($file_pointer) && $oldfilethumb != null) {
                unlink($file_pointer);
            }
        }
        DB::table('contents')->where('id', $eolId)->update(
            [
                "thumb" =>   preg_replace('/\s+/', '', $imageName),
                "updated_at" => \Carbon\Carbon::now(),
                "date_publish" => $datePublish,
                "date_info" => $request->dateinfo,
                "slug" => $slug,
                "status" => $eolStatus,
            ]
        );
        DB::table('product_eol_has_categories')->where('content_id', $eolId)->update(
            [
                "categories_id" => $eolType,
            ]
        );
        $arrrayName = self::UpdateOldfile($Filelang, $langloop, $oldFile);
        foreach ($langloop as $lang) {
            DB::table('contents_translations')->where('content_id', $eolId)->where('local', $lang)->update(
                [
                    "title" => $title[$lang],
                    "content" => $content[$lang],
                    "meta_title" => $meta_title[$lang],
                    "meta_description" => $meta_des[$lang],
                    "description" => $description[$lang],
                    // "meta_keywords" => $meta_key[$lang],
                    'file' =>  $arrrayName[$lang],
                ]
            );
        }

        return redirect()->route('eol.index')->with('flash_message', 'Update Data successfully');
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
        ->where('content_id', $id)
        ->select('ct.file')
        ->get();

        foreach ($con_trans as $cot) {
            if ($cot->file != null && $cot->file != '') {
                $file_pointer = base_path('/../uploads_delta/').$cot->file;
                if (file_exists($file_pointer) && isset($cot->file)) {
                    unlink($file_pointer);
                }

            }
        }

        $con = DB::table('contents')
        ->where('id', $id)
        ->select('contents.thumb')
        ->first();
        if ($con->thumb != null && $con->thumb != '') {
            $file_pointer2 = base_path('/../uploads_delta').$con->thumb;
            if (file_exists($file_pointer2) && isset($con->thumb)) {
                unlink($file_pointer2);
            }
        }

        DB::table('contents')->where('id', '=', $id)->delete();
        DB::table('contents_translations')->where('content_id', '=', $id)->delete();
        DB::table('product_eol_has_categories')->where('content_id', '=', $id)->delete();

        return back()->with('flash_message', 'Delete Data successfully');
    }


    public function copyEolsingle(Request $request)
    {

        $eolId = $request->eolId;
        $new_local = $request->language;

        $contentEn = DB::table('contents')
            ->where("contents.translate_id", '=', $eolId)
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
        return redirect()->route('eol.index')->with('flash_message', 'Copy Data successfully');
    }

    public function copyEol(Request $request)
    {
        $new_local = $request->language;

        $contentEn = DB::table('contents')
            ->where('contents.type', '=', 'eol')
            ->select('contents.*')
            ->get();

        foreach ($contentEn as $item) {
            $check_local = DB::table('contents')
                ->where('contents.type', '=', 'eol')
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

        return redirect()->route('eol.index')->with('flash_message', 'Copy Data successfully');
    }
    public function removeFileEolDoc($name, $id)
    {
        $con_trans = DB::table('contents_translations as ct')
        ->where('content_id', $id)
        ->select('ct.file')
        ->get();

        if (isset($con_trans[0]->file) && $con_trans[0]->file != '' && count($con_trans) > 0) {
            DB::table('contents_translations')->where('content_id', $id)->update(
                [
                  'file' => '',
            ]
            );

            foreach ($con_trans as $cot) {
                if ($cot->file != null && $cot->file != '') {
                    $file_pointer = base_path('/../uploads_delta/').$cot->file;
                    if (file_exists($file_pointer) && isset($cot->file)) {
                        unlink($file_pointer);
                    }

                }
            }
            return back()->with('flash_message', 'Delete File successfully');
        } else {
            return back()->with('error_message', 'Can Not Detete File');
        }

    }
}
