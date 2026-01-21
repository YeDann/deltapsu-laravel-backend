<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;

class EolTypeController extends Controller
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
        $contents = DB::table('eol_type as et')
        ->join('eol_type_translation as ett', 'ett.fk_et_id', '=', 'et.id')
        ->select('ett.*', 'et.*')
        ->where('ett.local', 'en')
        ->orderBy('et.order_seq', 'asc')
        ->get();
        // return dd($contents);

        return view('eol-type.index')
        ->with('name', 'update')
        ->with('menu', 'eol')
        ->with('contents', $contents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('eol-type.create')
        ->with('name', 'update')
        ->with('menu', 'eol');
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

            $id =  DB::table('eol_type')->insertGetID(
                [
                     "name" => $name,
                     "color_type" => $request->color_type,
                     "created_at" => \Carbon\Carbon::now(),
                     "updated_at" => \Carbon\Carbon::now(),
                 ]
            );
            $language = DB::table('language')->get();
            foreach ($language as $lang) {
                DB::table('eol_type_translation')->insert(
                    [
                        "title" => $name,
                        "fk_et_id" => $id,
                        "local" => $lang->name,
                    ]
                );
            }

        }
        return redirect()->route('eol-type.index')->with('flash_message', 'Insert Data successfully');
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
        // $contents = DB::table('eol_type')
        // ->where('id','=',$id)
        // ->select('eol_type.*')
        // ->get();
        $contents = DB::table('eol_type as et')
        ->where('et.id', '=', $id)
        ->Leftjoin('eol_type_translation as ett', 'ett.fk_et_id', '=', 'et.id')
        ->select('ett.*', 'et.*')
        ->get();
        $language = DB::table('language')->get();
        return view('eol-type.edit')
        ->with('name', 'update')
        ->with('menu', 'eol')
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
        $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        } else {

            $name = $request->name;
            $langloop = $request->langloop;
            // return dd($name);
            DB::table('eol_type')->where('id', '=', $request->type_id)->update(array(
                "color_type" => $request->color_type,
                "order_seq" => $request->order_seq,
                "updated_at" => \Carbon\Carbon::now()
            ));
            foreach ($langloop as $lang) {
                $data = DB::table('eol_type_translation')->where('fk_et_id', '=', $request->type_id)->where('local', $lang)->get();
                if (count($data) > 0) {
                    DB::table('eol_type_translation')->where('fk_et_id', '=', $request->type_id)->where('local', $lang)->update(array(
                        "title" => $name[$lang]
                    ));
                } else {
                    DB::table('eol_type_translation')->insert(
                        [
                            "title" => $name[$lang],
                            "fk_et_id" => $request->type_id,
                            "local" => $lang,
                        ]
                    );
                }

            }


        }
        return redirect()->route('eol-type.index')->with('flash_message', 'Update Data successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('eol_type')->where('id', '=', $id)->delete();
        DB::table('eol_type_translation')->where('fk_et_id', '=', $id)->delete();
        return back()->with('flash_message', 'Delete Data successfully');
    }
}
