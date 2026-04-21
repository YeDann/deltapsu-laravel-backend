<?php

namespace App\Http\Controllers;

use App;
use DB;
use Illuminate\Http\Request;
use Validator;

class ProductNoticeController extends Controller
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
        $contents = DB::table('product_product_notice_has_categories as pnc')
            ->join('contents as c', 'c.id', '=', 'pnc.content_id')
            ->join('contents_translations as ct', 'ct.content_id', '=', 'c.id')
            ->join('product_notice_type as pnt', 'pnt.id', '=', 'pnc.categories_id')
            ->where('ct.local', '=', 'en')
            ->where('c.content_type', '=', 'product-notice')
            ->select('c.*', 'ct.*', 'pnt.name as cateName')
            ->orderBy('c.updated_at', 'desc')
            ->distinct()
            ->get();

        $countContent = count($contents);

        $language = DB::table('language')->get();

        $lang = App::getLocale();
        $metatag = DB::table('meta_tag_page as mtp')
                ->join('meta_tag_page_translations as mtpt', 'mtp.id', '=', 'mtpt.meta_id')
                ->where('mtp.id', 30)
                ->where('mtpt.local', $lang)
                ->select('mtp.*', 'mtpt.*')
                ->get();

        return view('product-notice.index')
            ->with('name', 'update')
            ->with('metatag', $metatag)
            ->with('menu', 'product-notice')
            ->with('contents', $contents)
            ->with('countContent', $countContent)
            ->with('language', $language);
    }

    public function ImportProductNoticeData($type)
    {
        return redirect()->route('product-notice.index')->with('flash_message', 'Insert Data successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productNoticeType = DB::table('product_notice_type')
            ->get();
        $language = DB::table('language')->get();
        return view('product-notice.create')
            ->with('name', "update")
            ->with('menu', "product-notice")
            ->with('language', $language)
            ->with('productNoticeType', $productNoticeType);
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
            $productNoticeType = $request->productNoticeType;
            $datePublish = $request->datePublish;
            $datainfo = $request->dateinfo;
            $productNoticeStatus = $request->productNoticeStatus;
            $Content = $request->content;
            $description = $request->description;
            $metaTitle = $request->metaTitle;
            $metaDescription = $request->metaDescription;
            $langloop = $request->langloop;

            // Handle file uploads
            $arrayfileName = [];
            if ($request->hasFile('file')) {
                $arrayfileName = $this->SaveimageArray($request->file, $request->namefile);
            }

            $thumbName = '';
            if (isset($arrayfileName['thumbnail'])) {
                $thumbName = $arrayfileName['thumbnail'];
            }

            $re1 = str_replace("/", "_", $title);
            $key = str_replace(" ", "-", $re1);
            $key2 = $this->clean($key);
            $slug  =  $key2;

            $id = DB::table('contents')->insertGetID(
                [
                    "content_type" => "product-notice",
                    "thumb" => $thumbName,
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "date_publish" => $datePublish,
                    "date_info" => $datainfo,
                    "slug" => $slug,
                    "status" => $productNoticeStatus,
                ]
            );
            DB::table('product_product_notice_has_categories')->insert(
                [
                    "content_id" => $id,
                    "categories_id" => $productNoticeType,
                ]
            );
            // 取得英文內容作為預設內容
            $defaultTitle = $title ?? '';
            $defaultContent = $Content ?? '';
            $defaultDescription = $description ?? '';
            $defaultMetaTitle = $metaTitle ?? '';
            $defaultMetaDescription = $metaDescription ?? '';
            
            foreach ($langloop as $lang) {
                DB::table('contents_translations')->insert(
                    [
                        "content_id" => $id,
                        "title" => $defaultTitle,
                        "content" => $defaultContent,
                        "description" => $defaultDescription,
                        "meta_title" => $defaultMetaTitle,
                        "meta_description" => $defaultMetaDescription,
                        'file' => isset($arrayfileName['newsfile']) ? $arrayfileName['newsfile'] : '',
                        "head" => $request->head,
                        "local" => $lang,
                    ]
                );
            }

            return redirect()->route('product-notice.index')->with('flash_message', 'Insert Data successfully');
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

        $contents = DB::table('product_product_notice_has_categories as pnc')
        ->join('contents as c', 'c.id', '=', 'pnc.content_id')
        ->join('contents_translations as ct', 'ct.content_id', '=', 'c.id')
        ->join('product_notice_type as pnt', 'pnt.id', '=', 'pnc.categories_id')
        ->where('c.content_type', '=', 'product-notice')
        ->where('c.id', '=', $id)
        ->select('c.id as content_id', 'c.*', 'ct.*', 'pnt.name as cateName', 'pnc.*')
        ->orderBy('c.created_at', 'desc')
        ->distinct()
        ->get();

        $language = DB::table('language')->get();
        $productNoticeType = DB::table('product_notice_type')
            ->get();

        return view('product-notice.edit')
            ->with('name', "update")
            ->with('menu', "product-notice")
            ->with('contents', $contents)
            ->with('language', $language)
            ->with('productNoticeType', $productNoticeType);
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
        $productNoticeId = $request->productNoticeId;
        $description = $request->description;
        $datePublish = $request->datePublish;
        $productNoticeStatus = $request->productNoticeStatus;
        $productNoticeType = $request->productNoticeType;
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

        $slugTitle = $title['en'];
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
        DB::table('contents')->where('id', $productNoticeId)->update(
            [
                "thumb" =>   preg_replace('/\s+/', '', $imageName),
                "updated_at" => \Carbon\Carbon::now(),
                "date_publish" => $datePublish,
                "date_info" => $request->dateinfo,
                "slug" => $slug,
                "status" => $productNoticeStatus,
            ]
        );
        DB::table('product_product_notice_has_categories')->where('content_id', $productNoticeId)->update(
            [
                "categories_id" => $productNoticeType,
            ]
        );
        $arrrayName = self::UpdateOldfile($Filelang, $langloop, $oldFile);
        foreach ($langloop as $lang) {
            DB::table('contents_translations')->where('content_id', $productNoticeId)->where('local', $lang)->update(
                [
                    "title" => $title[$lang],
                    "content" => $content[$lang],
                    "meta_title" => $meta_title[$lang],
                    "meta_description" => $meta_des[$lang],
                    "description" => $description[$lang],
                    'file' =>  $arrrayName[$lang],
                    "head" => $request->head[$lang] ?? '',
                ]
            );
        }

        return redirect()->route('product-notice.index')->with('flash_message', 'Update Data successfully');
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
        DB::table('product_product_notice_has_categories')->where('content_id', '=', $id)->delete();

        return back()->with('flash_message', 'Delete Data successfully');
    }


    public function copyProductNoticesingle(Request $request)
    {

        $productNoticeId = $request->productNoticeId;
        $new_local = $request->language;

        $contentEn = DB::table('contents')
            ->where("contents.translate_id", '=', $productNoticeId)
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
        return redirect()->route('product-notice.index')->with('flash_message', 'Copy Data successfully');
    }

    public function copyProductNotice(Request $request)
    {
        $new_local = $request->language;

        $contentEn = DB::table('contents')
            ->where('contents.type', '=', 'product-notice')
            ->select('contents.*')
            ->get();

        foreach ($contentEn as $item) {
            $check_local = DB::table('contents')
                ->where('contents.type', '=', 'product-notice')
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

        return redirect()->route('product-notice.index')->with('flash_message', 'Copy Data successfully');
    }

    public function removeFileProductNoticeDoc($name, $id)
    {
        $con_trans = DB::table('contents_translations as ct')
            ->where('content_id', $id)
            ->where('local', $name)
            ->select('ct.file')
            ->first();

        if (isset($con_trans->file) && $con_trans->file != '') {
            // Delete the file from filesystem
            $file_pointer = base_path('/../uploads_delta/').$con_trans->file;
            if (file_exists($file_pointer)) {
                unlink($file_pointer);
            }

            // Update database to remove file reference for this specific language
            DB::table('contents_translations')
                ->where('content_id', $id)
                ->where('local', $name)
                ->update([
                    'file' => '',
                ]);

            return back()->with('flash_message', 'Delete File successfully');
        } else {
            return back()->with('error_message', 'Can Not Delete File');
        }
    }
}
