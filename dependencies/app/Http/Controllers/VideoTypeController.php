<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;

class VideoTypeController extends Controller
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
        $contents = DB::table('video_type as vt')
        ->join('video_type_translation as vtt' ,'vtt.fk_vt_id' ,'=','vt.id')
        ->select('vtt.*' ,'vt.*')
        ->where('vtt.local','en')
        ->orderBy('vt.order_seq','asc')
        ->get();

        return view('video-type.index')
        ->with('name','update')
        ->with('menu','videos')
        ->with('contents',$contents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('video-type.create')
        ->with('name','update')
        ->with('menu','videos');
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
            'name' => 'required',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        } else {

            $name = $request->name;

           $id =  DB::table('video_type')->insertGetID(
                [
                    "name" => $name,
                    "color_type" =>$request->color_type,
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                ]
            );
            $language = DB::table('language')->get();
            foreach($language as $lang){
                DB::table('video_type_translation')->insert(
                    [
                        "title" => $name,
                        "fk_vt_id" => $id,
                        "local" => $lang->name,
                    ]
                );
            }
          
        }
        return redirect()->route('video-type.index')->with('flash_message', 'Insert Data successfully');
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
        $contents = DB::table('video_type as vt')
        ->where('vt.id','=',$id)
        ->Leftjoin('video_type_translation as vtt' ,'vtt.fk_vt_id' ,'=','vt.id')
        ->select('vtt.*' ,'vt.*')
        ->get();
        $language = DB::table('language')->get();
        return view('video-type.edit')
        ->with('name','update')
        ->with('menu','videos')
        ->with('language',$language)
        ->with('contents',$contents);
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
            'name' => 'required',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        } else {

            $name = $request->name;
            $langloop = $request->langloop;
            
            DB::table('video_type')->where('id','=',$request->type_id)->update(array(
                "color_type" =>$request->color_type,
                "order_seq" =>$request->order_seq,
                "updated_at" => \Carbon\Carbon::now()
            ));
            foreach($langloop as $lang){
                $data = DB::table('video_type_translation')->where('fk_vt_id','=',$request->type_id)->where('local' ,$lang)->get();
                if(count($data) > 0){
                   DB::table('video_type_translation')->where('fk_vt_id','=',$request->type_id)->where('local' ,$lang)->update(array(
                       "title" => $name[$lang]
                   ));
                }else{
                    DB::table('video_type_translation')->insert(
                        [
                            "title" => $name[$lang],
                            "fk_vt_id" => $request->type_id,
                            "local" => $lang,
                        ]
                    );
                }

            }
     
           
        }
        return redirect()->route('video-type.index')->with('flash_message', 'Update Data successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('video_type')->where('id', '=', $id)->delete();
        DB::table('video_type_translation')->where('fk_vt_id','=',$id)->delete();
        return back()->with('flash_message', 'Delete Data successfully');
    }
}