<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;

class IndustryKnowHowTypeController extends Controller
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
        $contents = DB::table('industry_know_how_type as nt')
        ->join('industry_know_how_type_translation as ntt' ,'ntt.fk_sct_id' ,'=','nt.id')
        ->select('ntt.*' ,'nt.*')
        ->where('ntt.local','en')
        ->orderBy('nt.order_seq','asc')
        ->get();
        // return dd($contents);

        return view('industry-know-how-type.index')
        ->with('name','update')
        ->with('menu','industry-know-how')
        ->with('contents',$contents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('industry-know-how-type.create')
        ->with('name','update')
        ->with('menu','industry-know-how');
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

           $id =  DB::table('industry_know_how_type')->insertGetID(
                [
                    "name" => $name,
                    "color_type" =>$request->color_type,
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                ]
            );
            $language = DB::table('language')->get();
            foreach($language as $lang){
                DB::table('industry_know_how_type_translation')->insert(
                    [
                        "title" => $name,
                        "fk_sct_id" => $id,
                        "local" => $lang->name,
                    ]
                );
            }
          
        }
        return redirect()->route('industry-know-how-type.index')->with('flash_message', 'Insert Data successfully');
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
        // $contents = DB::table('industry_know_how_type')
        // ->where('id','=',$id)
        // ->select('industry_know_how_type.*')
        // ->get();
        $contents = DB::table('industry_know_how_type as nt')
        ->where('nt.id','=',$id)
        ->Leftjoin('industry_know_how_type_translation as ntt' ,'ntt.fk_sct_id' ,'=','nt.id')
        ->select('ntt.*' ,'nt.*')
        ->get();
        $language = DB::table('language')->get();
        return view('industry-know-how-type.edit')
        ->with('name','update')
        ->with('menu','industry-know-how')
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
            // return dd($name);
            DB::table('industry_know_how_type')->where('id','=',$request->type_id)->update(array(
                "color_type" =>$request->color_type,
                "order_seq" =>$request->order_seq,
                "updated_at" => \Carbon\Carbon::now()
            ));
            foreach($langloop as $lang){
                $data = DB::table('industry_know_how_type_translation')->where('fk_sct_id','=',$request->type_id)->where('local' ,$lang)->get();
                if(count($data) > 0){
                   DB::table('industry_know_how_type_translation')->where('fk_sct_id','=',$request->type_id)->where('local' ,$lang)->update(array(
                       "title" => $name[$lang]
                   ));
                }else{
                    DB::table('industry_know_how_type_translation')->insert(
                        [
                            "title" => $name[$lang],
                            "fk_sct_id" => $request->type_id,
                            "local" => $lang,
                        ]
                    );
                }

            }
     
           
        }
        return redirect()->route('industry-know-how-type.index')->with('flash_message', 'Update Data successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('industry_know_how_type')->where('id', '=', $id)->delete();
        DB::table('industry_know_how_type_translation')->where('fk_sct_id','=',$id)->delete();
        return back()->with('flash_message', 'Delete Data successfully');
    }
}
