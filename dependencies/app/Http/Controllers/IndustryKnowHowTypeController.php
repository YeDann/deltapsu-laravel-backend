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
        $contents = DB::table('industry_know_how_type as ikht')
        ->join('industry_know_how_type_translation as ikhtt', 'ikhtt.fk_ikht_id', '=', 'ikht.id')
        ->select('ikhtt.*', 'ikht.*')
        ->where('ikhtt.local', 'en')
        ->orderBy('ikht.order_seq', 'asc')
        ->get();

        return view('industry-know-how-type.index')
        ->with('name', 'update')
        ->with('menu', 'industry-know-how')
        ->with('contents', $contents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('industry-know-how-type.create')
        ->with('name', 'update')
        ->with('menu', 'industry-know-how');
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
                     "color_type" => $request->color_type,
                     "created_at" => \Carbon\Carbon::now(),
                     "updated_at" => \Carbon\Carbon::now(),
                 ]
            );
            $language = DB::table('language')->get();
            foreach ($language as $lang) {
                DB::table('industry_know_how_type_translation')->insert(
                    [
                        "title" => $name,
                        "fk_ikht_id" => $id,
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contents = DB::table('industry_know_how_type as ikht')
        ->where('ikht.id', '=', $id)
        ->Leftjoin('industry_know_how_type_translation as ikhtt', 'ikhtt.fk_ikht_id', '=', 'ikht.id')
        ->select('ikhtt.*', 'ikht.*')
        ->get();
        $language = DB::table('language')->get();
        return view('industry-know-how-type.edit')
        ->with('name', 'update')
        ->with('menu', 'industry-know-how')
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
            DB::table('industry_know_how_type')->where('id', '=', $request->type_id)->update(array(
                "name" => $name['en'] ?? $name[array_key_first($name)],
                "color_type" => $request->color_type,
                "order_seq" => $request->order_seq,
                "updated_at" => \Carbon\Carbon::now()
            ));
            foreach ($langloop as $lang) {
                $data = DB::table('industry_know_how_type_translation')->where('fk_ikht_id', '=', $request->type_id)->where('local', $lang)->get();
                if (count($data) > 0) {
                    DB::table('industry_know_how_type_translation')->where('fk_ikht_id', '=', $request->type_id)->where('local', $lang)->update(array(
                        "title" => $name[$lang]
                    ));
                } else {
                    DB::table('industry_know_how_type_translation')->insert(
                        [
                            "title" => $name[$lang],
                            "fk_ikht_id" => $request->type_id,
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
        DB::table('industry_know_how_type_translation')->where('fk_ikht_id', '=', $id)->delete();
        return back()->with('flash_message', 'Delete Data successfully');
    }
}
