<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Validator;

class FaqController extends Controller
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

        $faqs = DB::table('faq as f')
        ->join('faq_translations as ft', 'f.id', '=', 'ft.faq_id')
        ->join('faq_categories_translations as fct', 'fct.f_cate_id', '=', 'f.cate_id')
        ->where('ft.local', '=', 'en')
        ->where('fct.local', '=', 'en')
        ->select('f.*' ,'ft.*' ,'fct.name as cateName')
        ->get();

        return view('faq.index')
            ->with('name', 'Resource')
            ->with('submenu', 'faq_list')
            ->with('menu', 'faq')
            ->with('faqs', $faqs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = DB::table('language')->get();
        $faq_categories = DB::table('faq_categories as fc')
        ->join('faq_categories_translations as fct', 'fc.cate_id', '=', 'fct.f_cate_id')
        ->where('fct.local', '=', 'en')
        ->select('fc.*' ,'fct.*')
        ->get();

        return view('faq.create')
        ->with('name', 'Resource')
        ->with('submenu', 'faq_list')
        ->with('menu', 'faq')
        ->with('faq_categories', $faq_categories)
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
            $id = DB::table('faq')->insertGetID(
                [
                    "status" => $request->status,
                    "cate_id" => $request->faq_categories,
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                ]
            );
                foreach($langs as $lang){
                     DB::table('faq_translations')->insert(
                        [   
                            "faq_id" => $id,
                            "title" => $request->name,
                            "content" => $request->content,
                            "local" => $lang,
                        ]
                    );
                }
                return redirect()->route('Faq.index')->with('flash_message', 'Insert Data successfully');
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
   
        $faqs = DB::table('faq as f')
        ->join('faq_translations as ft', 'f.id', '=', 'ft.faq_id')
        ->where('f.id',$id)
        ->select('f.*' ,'ft.*')
        ->get();
        $faq_categories = DB::table('faq_categories as fc')
        ->join('faq_categories_translations as fct', 'fc.cate_id', '=', 'fct.f_cate_id')
        ->where('fct.local', '=', 'en')
        ->select('fc.*' ,'fct.*')
        ->get();

        $language = DB::table('language')->get();

        return view('faq.edit')
            ->with('name', 'Resource')
            ->with('submenu', 'faq_list')
            ->with('menu', 'faq')
            ->with('language', $language)
            ->with('faqs', $faqs)
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
        $id = $request->faq_id;
        $name = $request->name;
        $content = $request->content;
       
        $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        // return dd($validate->fails());
        if ($validate->fails()) {
        
            return redirect()->back()->withErrors($validate->errors());
        } else {
           DB::table('faq')->where('id',$id)->update(
                [
                    "status" => $request->status,
                    "cate_id" => $request->faq_categories,
                    "updated_at" => \Carbon\Carbon::now(),
                ]
            );
                foreach($langs as $lang){
                     DB::table('faq_translations')->where('local', $lang)->where('faq_id',$id)->update(
                        [   
                            "title" => $name[$lang],
                            "content" => $content[$lang],
                        ]
                    );
                }
                return redirect()->route('Faq.index')->with('flash_message', 'Update Data successfully');
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
        DB::table('faq')->where('id', '=', $id)->delete();
        DB::table('faq_translations')->where('faq_id', '=', $id)->delete();
        return back()->with('flash_message', 'Delete Data successfully');
    }

}
