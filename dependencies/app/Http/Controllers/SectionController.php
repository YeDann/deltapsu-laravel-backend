<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;

class SectionController extends Controller
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
        $section = DB::table('section as st')
        ->join('section_translation as stt','st.id','=','stt.section_id')
        ->where('stt.local','=','en')
        ->select('st.*','stt.*')
        ->get();

        $language = DB::table('language')->get();

        return view('section.index')
        ->with('name','product')
        ->with('menu','section')
        ->with('section',$section)
        ->with('language',$language);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = DB::table('language')->get();

        return view('section.create')
        ->with('name','section')
        ->with('language',$language);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
          $lang_loop = $request->lang_loop;
          $name = $request->name;
        //   return dd($lang_loop);
        $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);
      

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        } else {
           $id  = DB::table('section')->insertGetID(
                [
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                ]
            );
            foreach($lang_loop as $lang){
                DB::table('section_translation')->insert(
                    [
                        "section_id" => $id,
                        "name" => $name[$lang],
                        "local" => $lang
                    ]
                );
            }
         
        }

        return redirect()->route('section.index')->with('flash_message', 'Insert Data successfully');
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
        $section = DB::table('section as st')
        ->join('section_translation as stt','st.id','=','stt.section_id')
        ->where('st.id','=',$id)
        ->select('st.*','stt.*')
        ->get();

        
        $languages = DB::table('language')->get();

        return view('section.edit')
        ->with('name','product')
        ->with('menu','section')
        ->with('languages',$languages)
        ->with('section',$section);
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
        $section_id = $request->section_id;
        $langs = $request->section_loop;
        $name = $request->name;
         $sortname = $request->sortname;
        $section = DB::table('section as st')
        ->join('section_translation as stt','st.id','=','stt.section_id')
        ->where('st.id','=',$section_id)
        ->select('st.*','stt.*')
        ->get();

        
    

        foreach($langs as $lang){
            DB::table('section_translation')->where('section_id', "=", $section_id)->where('local', "=", $lang)->update(array(
               "name" => $name[$lang],
               "sortname" => $sortname[$lang],
            ));

        }
        // return dd($section);
        return redirect()->route('section.index')->with('flash_message', 'Update Data successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('section')->where('id', '=', $id)->delete();
        DB::table('section_translation')->where('section_id', '=', $id)->delete();

        return back()->with('flash_message', 'Delete Data successfully');
    }

    public function copySection(Request $request){
        
        $new_local = $request->language;

        $name_en = DB::table('section as st')
        ->join('section_translation as stt','st.id','=','stt.section_id')
        ->where('stt.local','=','en')
        ->select('st.*','stt.*')
        ->get();

        foreach($name_en as $item){

            $check_local = DB::table('section as st')
            ->join('section_translation as stt','st.id','=','stt.section_id')
            ->where('stt.section_id','=',$item->section_id)
            ->where('stt.local','=',$new_local)
            ->get();

            if(count($check_local) == 0){
                DB::table('section_translation')->insert(
                    [
                        "section_id" => $item->section_id,
                        "name" => $item->name,
                        "local" => $new_local
                    ]
                );
            }
        }


        

        return redirect()->route('section.index')->with('flash_message', 'Copy Data successfully');
    }

    public function copySectionsingle(Request $request){

        $section_id = $request->section_id;
        $new_local = $request->language;

        $name_en = DB::table('section as st')
        ->join('section_translation as stt','st.id','=','stt.section_id')
        ->where('stt.local','=','en')
        ->where("st.id",'=',$section_id)
        ->select('st.*','stt.*')
        ->get();

        foreach($name_en as $item){

            $check_local = DB::table('section as st')
            ->join('section_translation as stt','st.id','=','stt.section_id')
            ->where('stt.section_id','=',$item->section_id)
            ->where('stt.local','=',$new_local)
            ->get();

            if(count($check_local) == 0){
                DB::table('section_translation')->insert(
                    [
                        "section_id" => $item->section_id,
                        "name" => $item->name,
                        "local" => $new_local
                    ]
                );
            }
        }
        return redirect()->route('section.index')->with('flash_message', 'Copy Data successfully');
    }
}
