<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Validator;

class MarketResourceCateController extends Controller
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

        $margetCate = DB::table('marketing_resource_cate as mc')
            ->join('marketing_resource_cate_translations as mct', 'mc.cate_id', '=', 'mct.mk_fk_id')
            ->where('mct.local', '=', 'en')
            ->select('mc.*' ,'mct.*')
            ->get();

        // return dd('dede');

        return view('MarketResource.market_cate')
            ->with('name', 'Resource')
            ->with('menu', 'marketing_resource')
            ->with('submenu', 'marketing_categories')
            ->with('marketing_categories', $margetCate);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = DB::table('language')->get();
        return view('MarketResource.market_cate_create')
        ->with('name', 'Resource')
        ->with('menu', 'marketing_resource')
        ->with('submenu', 'marketing_categories')
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
        $permiss = $request->role;
        // return dd($permiss);
        $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        // return dd($validate->fails());
        if ($validate->fails()) {
        
            return redirect()->back()->withErrors($validate->errors());
        } else {
            $id = DB::table('marketing_resource_cate')->insertGetID(
                [
                    "status" => $request->status,
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                ]
            );
                foreach($langs as $lang){
                     DB::table('marketing_resource_cate_translations')->insert(
                        [   
                            "mk_fk_id" => $id,
                            "name" => $request->name,
                            "local" => $lang,
                        ]
                    );
                }
                if(isset($permiss)){
                    foreach($permiss as $per){
                        DB::table('permission_marketcate')->insert(
                            [   
                                "market_cate_id" => $id,
                                "permission_id" => $per,
                            ]
                        );
                    }
                }
            
                return redirect()->route('MarketResourceCategories.index')->with('flash_message', 'Insert Data successfully');
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
            ->where('mc.cate_id',$id)
            ->select('mc.*' ,'mct.*')
            ->get();
      

            $per1 = DB::table('permission_marketcate as pm')
                ->where('pm.market_cate_id',$id)
                ->where('pm.permission_id',1)
                ->select('pm.*')
                ->first();

            $per2 = DB::table('permission_marketcate as pm')
            ->where('pm.market_cate_id',$id)
            ->where('pm.permission_id',2)
            ->select('pm.*')
            ->first();
            
            $per3 = DB::table('permission_marketcate as pm')
            ->where('pm.market_cate_id',$id)
            ->where('pm.permission_id',3)
            ->select('pm.*')
            ->first();
           
       

            // return dd($perm_marts);
        $language = DB::table('language')->get();

        return view('MarketResource.market_cate_edit')
        ->with('name', 'Resource')
        ->with('menu', 'marketing_resource')
        ->with('submenu', 'marketing_categories')
        ->with('language', $language)
        ->with('per1', $per1)
        ->with('per2', $per2)
        ->with('per3', $per3)
        ->with('margetCate', $margetCate);
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
        $id = $request->mk_cate_id;
        $name = $request->name;
        $permiss = $request->role;
        // return dd( $permiss);
        $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        // return dd($validate->fails());
        if ($validate->fails()) {
        
            return redirect()->back()->withErrors($validate->errors());
        } else {
                DB::table('marketing_resource_cate')->where('cate_id',$id)->update(
                        [
                            "status" => $request->status,
                            "created_at" => \Carbon\Carbon::now(),
                            "updated_at" => \Carbon\Carbon::now(),
                        ]
                    );
                foreach($langs as $lang){
                     DB::table('marketing_resource_cate_translations')->where('local', $lang)->where('mk_fk_id',$id)->update(
                        [   
                            "name" => $name[$lang],
                            "local" => $lang,
                        ]
                    );
                }
                if(isset($permiss)){
                  DB::table('permission_marketcate')->where('market_cate_id',$id)->delete();
                    foreach($permiss as $per){
                        DB::table('permission_marketcate')->insert(
                            [   
                                "market_cate_id" => $id,
                                "permission_id" => $per,
                            ]
                        );
                    }
                }
                return redirect()->route('MarketResourceCategories.index')->with('flash_message', 'Update Data successfully');
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
        DB::table('marketing_resource_cate')->where('cate_id', '=', $id)->delete();
        DB::table('marketing_resource_cate_translations')->where('mk_fk_id', '=', $id)->delete();
        return back()->with('flash_message', 'Delete Data successfully');
    }

}
