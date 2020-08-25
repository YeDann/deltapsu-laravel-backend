<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Validator;

class AboutUsController extends Controller
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

        // DB::table('states')->where('id',3544)->delete();
        $language = DB::table('language')->get();
        $userdata = auth()->user();
        // return dd($userdata->lang);
       if($userdata->lang == 'All'){
        $contents = DB::table('about_us as au')
        ->join('about_us_translations as aut', 'au.id', '=', 'aut.abt_id')
        ->where('aut.local', '=', 'en')
        ->select('au.*' ,'aut.*')
        ->get();
       }else{
        $contents = DB::table('about_us as au')
        ->join('about_us_translations as aut', 'au.id', '=', 'aut.abt_id')
        ->where('aut.local', '=', $userdata->lang)
        ->select('au.*' ,'aut.*')
        ->get();
       }
     

        return view('aboutUs.index')
            ->with('name', 'aboutUs')
            ->with('contents', $contents)
            ->with('menu', '');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = DB::table('language')->get();
        return view('aboutUs.create')
            ->with('name', 'aboutUs')
            ->with('language', $language)
            ->with('menu', '');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $title = $request->title;
        $content = $request->content;
        $langs = $request->langloop;
        $type_content = $request->type_content;

        $validate = Validator::make($request->all(), [
            'title' => 'required',
        ]);
        // return dd($validate->fails());
        if ($validate->fails()) {
        
            return redirect()->back()->withErrors($validate->errors());
        } else {

            $id = DB::table('about_us')->insertGetID(
                [
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                ]
            );
                foreach($langs as $lang){
                     DB::table('about_us_translations')->insert(
                        [   
                            "abt_id" => $id,
                            "title" => $title,
                            "content" => $content,
                            "metaTitle" => $request->metaTitle,
                            "metaDescription" =>$request->metaDescription,
                            "metaKeyword" => $request->metaKeyword,
                            "local" => $lang,
                        ]
                    );

                }
                return redirect()->route('AboutUs.index')->with('flash_message', 'Insert Data successfully');
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
       $contents = DB::table('about_us as au')
            ->join('about_us_translations as aut', 'au.id', '=', 'aut.abt_id')
            ->where('au.id' ,$id)
            ->select('au.*','au.id as abt_id' ,'aut.*')
            ->get();
            $userdata = auth()->user();
           
           if($userdata->lang == 'All'){
            $language = DB::table('language')->get();
           }else{
            $language = DB::table('language')->where('name',$userdata->lang)->get();
           }      
   
        return view('aboutUs.edit')
            ->with('name', 'aboutUs')
            ->with('menu', '')
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
        $title = $request->title;
        $content = $request->content;
        $langs = $request->lang_loop;
        $type_content = $request->type_content;
        $abt_id = $request->abt_id;
        $metaTitle =  $request->metaTitle;
        $metaDescription = $request->metaDescription;
        $metaKeyword  =$request->metaKeyword;
        $validate = Validator::make($request->all(), [
            'title' => 'required',
        ]);
        // return dd($validate->fails());
        if ($validate->fails()) {
        
            return redirect()->back()->withErrors($validate->errors());
        } else {

            DB::table('about_us')->where('id',$abt_id)->update(
                [
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                ]
            );
                foreach($langs as $lang){
                    $data = DB::table('about_us_translations')->where('abt_id' ,$abt_id)->where('local',$lang)->get();
                    if(count($data) > 0){
                        DB::table('about_us_translations')->where('abt_id' ,$abt_id)->where('local',$lang)->update(
                            [
                                "title" => $title[$lang],
                                "content" => $content[$lang],
                                "metaTitle" =>$metaTitle[$lang],
                                "metaDescription" =>$metaDescription[$lang],
                                "metaKeyword" => $metaKeyword[$lang],
                            ]
                        );
                    }else{
                        DB::table('about_us_translations')->insert(
                            [
                                'abt_id' => $abt_id,
                                "title" => $title[$lang],
                                "content" => $content[$lang],
                                "metaTitle" =>$metaTitle[$lang],
                                "metaDescription" =>$metaDescription[$lang],
                                "metaKeyword" => $metaKeyword[$lang],
                                "local"=>$lang
                            ]
                        );

                    }
                

                }
                return redirect()->route('AboutUs.index')->with('flash_message', 'Update Data successfully');
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
        DB::table('about_us')->where('id', '=', $id)->delete();
        DB::table('about_us_translations')->where('abt_id', '=', $id)->delete();

        return back()->with('flash_message', 'Delete Data successfully');
    }

}
