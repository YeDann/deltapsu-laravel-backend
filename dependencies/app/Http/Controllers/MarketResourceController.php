<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Http\UploadedFile;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class MarketResourceController extends Controller
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
        // return dd('555');
        $language = DB::table('language')->get();

        $margeting = DB::table('marketing_resource as mr')
            ->join('marketing_resource_translations as mrt', 'mr.id', '=', 'mrt.mr_id')
            ->where('mrt.local', '=', 'en')
            ->select('mr.*' ,'mrt.*')
            ->orderBy('mr.created_at','desc')
            ->get();
          

        return view('MarketResource.index')
            ->with('name', 'Resource')
            ->with('menu', 'marketing_resource')
            ->with('submenu', 'market_resource')
            ->with('margeting', $margeting);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
 {
        $language = DB::table('language')->get();
        $margetCate = DB::table('marketing_resource_cate as mc')
        ->join('marketing_resource_cate_translations as mct', 'mc.cate_id', '=', 'mct.mk_fk_id')
        ->where('mct.local', '=', 'en')
        ->select('mc.*' ,'mct.*')
        ->get();
        return view('MarketResource.create')
        ->with('name', 'Resource')
        ->with('menu', 'marketing_resource')
        ->with('submenu', 'market_resource')
        ->with('margetCates', $margetCate)
        ->with('language', $language);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $langs  = $request->lang_loop;
        // return dd($langs);
        $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        // return dd($validate->fails());
        if ($validate->fails()) {
        
            return redirect()->back()->withErrors($validate->errors());
        } else {
            // 檔案已由分塊上傳端點（chunkUpload）預先存好，表單只帶最終檔名；basename 防路徑穿越
            $imageName = $request->input('file_uploaded') ? basename($request->input('file_uploaded')) : '';

            // 主表 + 各語系 translation 包在同一交易，避免中途失敗留下半套資料（主表有、部分語系缺）
            DB::transaction(function () use ($request, $langs, $imageName) {
                $id = DB::table('marketing_resource')->insertGetID(
                    [
                        "status" => $request->status,
                        "cate_id" => $request->mr_categories,
                        "created_at" => \Carbon\Carbon::now(),
                        "updated_at" => \Carbon\Carbon::now(),
                    ]
                );
                foreach ($langs as $lang) {
                    DB::table('marketing_resource_translations')->insert(
                        [
                            "mr_id" => $id,
                            "name" => $request->name,
                            "file" => $imageName,
                            "local" => $lang,
                        ]
                    );
                }
            });

            return redirect()->route('MarketResource.index')->with('flash_message', 'Insert Data successfully');
        }


    }

    /**
     * 分塊上傳端點（resumable.js + pion/laravel-chunk-upload）。
     * 收齊所有 chunk 後組成完整檔、move 到 marketing_resources，回傳最終檔名供表單以 file_uploaded 帶出；
     * 未收齊時回傳目前進度百分比。讓 2GB 大檔免拉高 php.ini/nginx 上限（每塊都很小）。
     */
    public function chunkUpload(Request $request)
    {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        if (false === $receiver->isUploaded()) {
            throw new UploadMissingFileException();
        }

        $save = $receiver->receive();

        if ($save->isFinished()) {
            return $this->saveChunkedFile($save->getFile());
        }

        $handler = $save->handler();

        return response()->json([
            'done' => $handler->getPercentageDone(),
            'status' => true,
        ]);
    }

    /**
     * 收齊後存檔：沿用既有檔名格式（去空白 + uniqid），move 到行銷資源目錄，回傳最終檔名。
     */
    private function saveChunkedFile(UploadedFile $file)
    {
        $fileName = preg_replace('/\s+/', '', self::fileformat($file));
        $file->move(base_path('/../uploads_delta/partner/marketing_resources'), $fileName);

        return response()->json([
            'done' => 100,
            'status' => true,
            'file' => $fileName,
        ]);
    }

    /**
     * 儲存瀏覽器端（canvas）擷取的影片縮圖（poster）：存成「影片同名 .jpg」於行銷資源目錄。
     * 縮圖很小（遠小於 upload_max_filesize），以一般檔案上傳即可。供前端 <video poster> 顯示，避免靜止黑屏。
     */
    public function savePoster(Request $request)
    {
        $video = basename($request->input('video', ''));
        if ('' === $video || !$request->hasFile('poster')) {
            return response()->json(['status' => false], 422);
        }
        $poster = pathinfo($video, PATHINFO_FILENAME) . '.jpg';
        $request->file('poster')->move(base_path('/../uploads_delta/partner/marketing_resources'), $poster);

        return response()->json(['status' => true, 'poster' => $poster]);
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
        $margetCate = DB::table('marketing_resource_cate as mc')
            ->join('marketing_resource_cate_translations as mct', 'mc.cate_id', '=', 'mct.mk_fk_id')
            ->select('mc.*' ,'mct.*')
            ->where('mct.local','en')
            ->get();
    
            $margeting = DB::table('marketing_resource as mr')
            ->join('marketing_resource_translations as mrt', 'mr.id', '=', 'mrt.mr_id')
            ->where('mr.id', '=', $id)
            ->select('mr.*' ,'mrt.*')
            ->get();

        $language = DB::table('language')->get();

        // Product Images / Videos 分類採「一個共用檔（套用所有語系）」，其他分類維持逐語系
        $isGallery = $margeting->isNotEmpty() && $margeting[0]->cate_id == $this->galleryCateId();

        return view('MarketResource.edit')
        ->with('name', 'Resource')
        ->with('menu', 'marketing_resource')
        ->with('submenu', 'market_resource')
        ->with('margetCates', $margetCate)
        ->with('margeting', $margeting)
        ->with('language', $language)
        ->with('isGallery', $isGallery);
    }

    /**
     * Product Images / Videos 分類 id（以英文名定位，含更名前後）。
     */
    private function galleryCateId()
    {
        return DB::table('marketing_resource_cate_translations')
            ->where('local', 'en')
            ->whereIn('name', ['Product Images', 'Product Images / Videos'])
            ->value('mk_fk_id');
    }

    private function fileformat($file){
        $string = '';
    if(isset($file) && is_file($file)){
      $filename = str_replace('.'.$file->getClientOriginalExtension(),"",$file->getClientOriginalName());
      $string   =  $filename.uniqid().'.'.$file->getClientOriginalExtension();
    }
    return $string;
  }

    /**
     * 依分塊上傳結果決定各語系最終檔名：有新上傳（file_uploaded[lang]）則用新檔並刪舊檔，否則沿用 oldfile[lang]。
     */
    private function applyChunkedFiles($uploaded, $loop, $oldfile)
    {
        $result = [];
        foreach ($loop as $lang) {
            $new = isset($uploaded[$lang]) && '' !== $uploaded[$lang] ? basename($uploaded[$lang]) : '';
            $result[$lang] = '' !== $new ? $new : (isset($oldfile[$lang]) ? $oldfile[$lang] : '');
        }
        return $result;
    }

    /**
     * 刪除「已無任何語系/記錄引用」的舊檔（與其縮圖）。
     * 行銷資源各語系常共用同一檔，須先確認 DB 中已無 translation 引用該檔才刪實體檔，避免誤刪。
     */
    private function deleteOrphanFiles(array $files)
    {
        foreach (array_unique(array_filter($files)) as $f) {
            $stillUsed = DB::table('marketing_resource_translations')->where('file', $f)->exists();
            if (!$stillUsed) {
                $this->deleteResourceFile($f);
            }
        }
    }

    /**
     * 刪除行銷資源檔案；若為影片，一併刪同名縮圖（poster）。
     */
    private function deleteResourceFile($file)
    {
        if (!$file) {
            return;
        }
        $dir = base_path('/../uploads_delta/partner/marketing_resources/');
        if (file_exists($dir.$file)) {
            unlink($dir.$file);
        }
        if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['mp4', 'webm', 'mov'])) {
            $poster = $dir.pathinfo($file, PATHINFO_FILENAME).'.jpg';
            if (file_exists($poster)) {
                unlink($poster);
            }
        }
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
       
        $langs  = $request->lang_loop;
        $id = $request->mr_id;
        $name = $request->name;
        $uploaded = $request->input('file_uploaded');   // 各語系分塊上傳完成的最終檔名
        $oldfile  = $request->oldfile;
      
        $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        // return dd($validate->fails());
        if ($validate->fails()) {
        
            return redirect()->back()->withErrors($validate->errors());
        } else {
      
                // Product Images / Videos（gallery）：file_uploaded 是單一字串 → 共用檔套用所有語系；
                // 其他分類：file_uploaded[locale] 是陣列 → 逐語系（純讀 request，可在交易外先算好）
                if (is_array($uploaded)) {
                    $arrayfileName = $this->applyChunkedFiles($uploaded, $langs, (array) $oldfile);
                    $oldVals = (array) $oldfile;
                } else {
                    $newFile = ($uploaded && '' !== $uploaded) ? basename($uploaded) : (is_string($oldfile) ? $oldfile : '');
                    $arrayfileName = [];
                    foreach ($langs as $lang) { $arrayfileName[$lang] = $newFile; }
                    $oldVals = [$oldfile];
                }

                // 主表 + 各語系 translation 包在同一交易，避免中途失敗留下半套資料
                DB::transaction(function () use ($request, $id, $langs, $name, $arrayfileName) {
                    DB::table('marketing_resource')->where('id', $id)->update(
                        [
                            "status" => $request->status,
                            "cate_id" => $request->mr_categories,
                            "created_at" => \Carbon\Carbon::now(),
                            "updated_at" => \Carbon\Carbon::now(),
                        ]
                    );
                    foreach ($langs as $lang) {
                        DB::table('marketing_resource_translations')->where('local', $lang)->where('mr_id', $id)->update(
                            [
                                "name" => $name[$lang],
                                "file" => $arrayfileName[$lang],
                                "local" => $lang,
                            ]
                        );
                    }
                });

                // DB 交易 commit 後才刪實體檔；避免「DB rollback 但舊檔已刪」的不一致
                $this->deleteOrphanFiles($oldVals);

                return redirect()->route('MarketResource.index')->with('flash_message', 'Update Data successfully');
        }
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


        $margeting = DB::table('marketing_resource as mr')
        ->join('marketing_resource_translations as mrt', 'mr.id', '=', 'mrt.mr_id')
        ->where('mr.id', '=', $id)
        ->select('mr.*' ,'mrt.*')
        ->get();
     foreach($margeting  as $mar){
        if (isset($mar->file)) {
            $this->deleteResourceFile($mar->file);   // 刪主檔；影片連同縮圖一起刪
        }
     }
       

        DB::table('marketing_resource')->where('id', '=', $id)->delete();
        DB::table('marketing_resource_translations')->where('mr_id', '=', $id)->delete();

        return back()->with('flash_message', 'Delete Data successfully');
    }

    public function removefileMargeting($id ,$lang){
        $file = DB::table('marketing_resource_translations')->where('local', $lang)->where('mr_id', $id)->value('file');
        if (DB::table('marketing_resource')->where('id', $id)->value('cate_id') == $this->galleryCateId()) {
            // Product Images / Videos 共用檔：清掉所有語系
            DB::table('marketing_resource_translations')->where('mr_id', $id)->update(["file" => null]);
        } else {
            DB::table('marketing_resource_translations')->where('local' ,$lang)->where('mr_id' ,$id)->update(["file" => null]);
        }
        // 解除引用後刪實體檔（影片含縮圖）；僅在已無其他語系/記錄引用該檔時才刪，避免誤刪共用檔
        if ($file) {
            $this->deleteOrphanFiles([$file]);
        }
        return redirect()->back()->with('flash_message', 'Remove file Data successfully');
    }

}