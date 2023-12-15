<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Validator;

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
            $imageName = '';
            if ($request->hasFile("file")) {
                $imageFile = $request->file("file");
                $imageName = preg_replace('/\s+/','',self::fileformat($imageFile));
                $imageFile->move(base_path('/../uploads_delta/partner/marketing_resources'),$imageName);
            }

            $id = DB::table('marketing_resource')->insertGetID(
                [
                    "status" => $request->status,
                    "cate_id" => $request->mr_categories,
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                ]
            );
                foreach($langs as $lang){
                     DB::table('marketing_resource_translations')->insert(
                        [   
                            "mr_id" => $id,
                            "name" => $request->name,
                            "file" => $imageName,
                            "local" => $lang,
                        ]
                    );
                }
                return redirect()->route('MarketResource.index')->with('flash_message', 'Insert Data successfully');
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

        return view('MarketResource.edit')
        ->with('name', 'Resource')
        ->with('menu', 'marketing_resource')
        ->with('submenu', 'market_resource')
        ->with('margetCates', $margetCate)
        ->with('margeting', $margeting)
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
                        $loopfile[$lang]->move(base_path('/../uploads_delta/partner/marketing_resources'),$fileName[$lang]);
                        $arrayfileName[$lang] = $fileName[$lang];
                        if(isset($oldfile[$lang])){
                            $file_pointer = base_path('/../uploads_delta/partner/marketing_resources/').$oldfile[$lang];
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
        $file = $request->file;
        $oldfile  = $request->oldfile;
      
        $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        // return dd($validate->fails());
        if ($validate->fails()) {
        
            return redirect()->back()->withErrors($validate->errors());
        } else {
      
                DB::table('marketing_resource')->where('id',$id)->update(
                        [
                            "status" => $request->status,
                            "cate_id" => $request->mr_categories,
                            "created_at" => \Carbon\Carbon::now(),
                            "updated_at" => \Carbon\Carbon::now(),
                        ]
                    );
                $arrayfileName = self::UpdateOldfile($file ,$langs ,$oldfile);
                foreach($langs as $lang){
                     DB::table('marketing_resource_translations')->where('local', $lang)->where('mr_id',$id)->update(
                        [   
                            "name" => $name[$lang],
                            "file" => $arrayfileName[$lang],
                            "local" => $lang,
                        ]
                    );
                }
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
        $file_pointer2 = base_path('/../uploads_delta/partner/marketing_resources/').$mar->file;
        if (file_exists($file_pointer2) && isset($mar->file)) {
            unlink($file_pointer2);
        }

     }
       

        DB::table('marketing_resource')->where('id', '=', $id)->delete();
        DB::table('marketing_resource_translations')->where('mr_id', '=', $id)->delete();

        return back()->with('flash_message', 'Delete Data successfully');
    }

    public function removefileMargeting($id ,$lang){
        // return dd($id);
        DB::table('marketing_resource_translations')->where('local' ,$lang)->where('mr_id' ,$id)->update(
            [
                "file" => null,
            ]

        );
        return redirect()->back()->with('flash_message', 'Remove file Data successfully');
    }

}