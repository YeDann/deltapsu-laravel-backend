<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
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
            ->where('ett.local', '=', 'en')
            ->select('et.*', 'ett.title as name')
            ->orderBy('et.order_seq', 'asc')
            ->get();


        $countContent = count($contents);

        return view('eol-type.index')
            ->with('name', 'update')
            ->with('menu', 'eol-type')
            ->with('contents', $contents)
            ->with('countContent', $countContent);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = DB::table('language')->get();
        return view('eol-type.create')
            ->with('name', "update")
            ->with('menu', "eol-type")
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
        $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        } else {
            $name = $request->name;
            // $description = $request->description;
            // $metaTitle = $request->meta_title;
            // $metaDescription = $request->meta_des;
            // $metaKeyword = $request->metaKeyword;

            $langloop = $request->langloop;

            $id = DB::table('eol_type')->insertGetID(
                [
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "sort" => 0,
                    // "color_type" => ... if needed
                ]
            );

            foreach ($langloop as $lang) {
                DB::table('eol_type_translation')->insert(
                    [
                        "fk_et_id" => $id,
                        "title" => isset($name[$lang]) ? $name[$lang] : '',
                        "local" => $lang,
                    ]
                );
            }

            return redirect()->route('eol-type.index')->with('flash_message', 'Insert Data successfully');
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
        $contents = DB::table('eol_type as et')
            ->join('eol_type_translation as ett', 'et.id', '=', 'ett.fk_et_id')
            ->where('et.id', '=', $id)
            ->select('et.*', 'ett.*')
            ->orderBy('et.updated_at', 'desc')
            ->get();
        $language = DB::table('language')->get();

        return view('eol-type.edit')
            ->with('name', "update")
            ->with('menu', "eol-type")
            ->with('contents', $contents)
            ->with('language', $language);
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
        $typeId = $request->typeId;
        $name = $request->name;
        // $description = $request->description;
        // $metaTitle = $request->meta_title;
        // $metaDescription = $request->meta_des;
        // $metaKeyword = $request->metaKeyword;

        $langloop = $request->langloop;

        DB::table('eol_type')->where('id', $typeId)->update(
            [
                "updated_at" => \Carbon\Carbon::now(),
            ]
        );

        foreach ($langloop as $lang) {
            DB::table('eol_type_translation')->where('fk_et_id', $typeId)->where('local', $lang)->update(
                [
                    "title" => $name[$lang],
                ]
            );
        }

        return redirect()->route('eol-type.index')->with('flash_message', 'Update Data successfully');
    }

    public function sort(Request $request)
    {
        $array_sort = $request->sort;
        $i = 1;
        foreach ($array_sort as $sort) {
            DB::table('eol_type')
                ->where('id', $sort)
                ->update(['sort' => $i]);
            $i++;
        }
        return "Sort Data successfully";
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
