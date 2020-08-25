<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Validator;

class FaqCategoriesController extends Controller
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
     
      
            $faq_categories = DB::table('faq_categories as fc')
            ->join('faq_categories_translations as fct', 'fc.cate_id', '=', 'fct.f_cate_id')
            ->where('fct.local', '=', 'en')
            ->select('fc.*' ,'fct.*')
            ->get();
       

        return view('faq.faq_categories')
            ->with('name', 'Resource')
            ->with('faq_categories', $faq_categories)
            ->with('submenu', 'faq_categories')
            ->with('menu', 'faq');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = DB::table('language')->get();
        return view('faq.faq_cate_create')
        ->with('name', 'Resource')
        ->with('submenu', 'faq_categories')
        ->with('menu', 'faq')
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
        $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        // return dd($validate->fails());
        if ($validate->fails()) {
        
            return redirect()->back()->withErrors($validate->errors());
        } else {
            $id = DB::table('faq_categories')->insertGetID(
                [
                    "status" => $request->status,
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                ]
            );
                foreach($langs as $lang){
                     DB::table('faq_categories_translations')->insert(
                        [   
                            "f_cate_id" => $id,
                            "name" => $request->name,
                            "local" => $lang,
                        ]
                    );
                }
                return redirect()->route('FaqCategories.index')->with('flash_message', 'Insert Data successfully');
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
    public function editfaqCategories($id)
    {
        $faq_categories = DB::table('faq_categories as fc')
            ->join('faq_categories_translations as fct', 'fc.cate_id', '=', 'fct.f_cate_id')
            ->where('fc.cate_id' ,$id)
            ->select('fc.*' ,'fct.*')
            ->get();

        $language = DB::table('language')->get();

        return view('faq.faq_cate_edit')
            ->with('name', 'Resource')
            ->with('submenu', 'faq_categories')
            ->with('menu', 'faq')
            ->with('language', $language)
            ->with('faq_categories', $faq_categories);
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
        $id = $request->faq_cate_id;
        $name = $request->name;
       
        $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        // return dd($validate->fails());
        if ($validate->fails()) {
        
            return redirect()->back()->withErrors($validate->errors());
        } else {
           DB::table('faq_categories')->where('cate_id',$id)->update(
                [
                    "status" => $request->status,
                    "updated_at" => \Carbon\Carbon::now(),
                ]
            );
                foreach($langs as $lang){
                     DB::table('faq_categories_translations')->where('local', $lang)->where('f_cate_id',$id)->update(
                        [   
                            "name" => $name[$lang],
                        ]
                    );
                }
                return redirect()->route('FaqCategories.index')->with('flash_message', 'Update Data successfully');
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
        DB::table('faq_categories')->where('cate_id', '=', $id)->delete();
        DB::table('faq_categories_translations')->where('f_cate_id', '=', $id)->delete();
        return back()->with('flash_message', 'Delete Data successfully');
    }

}
