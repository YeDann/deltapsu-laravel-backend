<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;

class TechnicalType extends Controller
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
        $contents = DB::table('tech_type as tc')
        ->join('tech_type_translation as tct','tc.id','=','tct.tech_id')
        ->select('tc.*','tct.*')
        ->where('tct.local','en')
        ->get();

        return view('technical-type.index')
        ->with('name','update')
        ->with('menu','technical')
        ->with('contents',$contents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('technical-type.create')
        ->with('name','update')
        ->with('menu','technical');
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

            $tech_id =  DB::table('tech_type')->insertGetID(
                [
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                ]
            );

            // $tech_id = DB::table('tech_type')->max('id');
            $language = DB::table('language')->get();
            foreach($language as $lang){
                DB::table('tech_type_translation')->insert(
                    [
                        "tech_id" => $tech_id,
                        "name" => $name,
                        "local" => $lang->name
                    ]
                );
            }
         
        }
        return redirect()->route('technical-type.index')->with('flash_message', 'Insert Data successfully');
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
        $contents = DB::table('tech_type as tc')
        ->join('tech_type_translation as tct','tc.id','=','tct.tech_id')
        ->where('tc.id','=',$id)
        ->select('tc.*','tct.*')
        ->get();
        // return dd($contents);
        $language = DB::table('language')->get();
        return view('technical-type.edit')
        ->with('name','update')
        ->with('menu','technical')
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
            $techId = $request->techId;

            // DB::table('tech_type')->where('id','=',$techId)
            // ->update(array(
            //     "updated_at" => \Carbon\Carbon::now()
            // ));

            // DB::table('tech_type_translation')->where('tech_id','=',$techId)
            // ->update(array(
            //     "name" => $name
            // ));

            $langloop = $request->langloop;

            DB::table('news_type')->where('id','=',$request->type_id)->update(array(
                "updated_at" => \Carbon\Carbon::now()
            ));
            foreach($langloop as $lang){
                $data = DB::table('tech_type_translation')->where('tech_id','=',$techId)->where('local' ,$lang)->get();
                if(count($data) > 0){
                   DB::table('tech_type_translation')->where('tech_id','=',$techId)->where('local' ,$lang)->update(array(
                       "name" => $name[$lang]
                   ));
                }else{
                    DB::table('tech_type_translation')->insert(
                        [
                            "name" => $name[$lang],
                            "tech_id" => $techId,
                            "local" => $lang,
                        ]
                    );
                }

            }
        }
        return redirect()->route('technical-type.index')->with('flash_message', 'ํ Update Data successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('tech_type')->where('id', '=', $id)->delete();
        DB::table('tech_type_translation')->where('tech_id','=',$id)->delete();

        return back()->with('flash_message', 'Delete Data successfully');
    }
}
