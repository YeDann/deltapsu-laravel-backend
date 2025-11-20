<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Validator;

class ProductFieldController extends Controller
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
        $language = DB::table('language')->get();

        $pd_field = DB::table('product_field as pf')
            ->join('product_field_translation as pft', 'pf.id', '=', 'pft.product_field_id')
            ->join('section as st', 'pf.section_id', '=', 'st.id')
            ->join('section_translation as stt', 'st.id', '=', 'stt.section_id')
            ->where('pft.local', '=', 'en')
            ->where('stt.local', '=', 'en')
            ->select('pf.id as pd_field_id', 'pf.type', 'pf.created_at', 'pft.field_name', 'pft.local as pft_local', 'st.id as section_id', 'stt.name as section_name')
            ->orderBy('pf.created_at', 'desc')
            ->get();

        return view('product-field.index')
            ->with('name', 'product')
            ->with('menu', 'product_field')
            ->with('pd_field', $pd_field)
            ->with('language', $language);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = DB::table('language')->get();

        $section = DB::table('section as st')
            ->join('section_translation as stt', 'st.id', '=', 'stt.section_id')
            ->where('stt.local', '=', 'en')
            ->select('st.*', 'stt.*')
            ->get();

        return view('product-field.create')
            ->with('name', 'product')
            ->with('language', $language)
            ->with('menu', 'product_field')
            ->with('section', $section);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title = $request->title;
        $section = $request->section;
        $type = $request->type;
        $unit = $request->unit;

        $langs = $request->lang_loop;

        $validate = Validator::make($request->all(), [
            'section' => 'required',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        }

        $profieldId = DB::table('product_field')->insertGetID(
            [
                    'type' => $type,
                    'section_id' => $section,
                    'unit_name' => $unit,
                    'status' => $request->status,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]
        );

        foreach ($langs as $lang) {
            $create_pd_field_translation = DB::table('product_field_translation')->insert(
                [
                            'product_field_id' => $profieldId,
                            'field_name' => $title,
                            'local' => $lang,
                        ]
            );
        }

        if ($profieldId && $create_pd_field_translation) {
            return redirect()->route('product-field.index')->with('flash_message', 'Insert Data successfully');
        }

        return redirect()->route('product-field.index')->with('error_message', 'Error insert data !!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pd_field = DB::table('product_field as pf')
            ->join('product_field_translation as pft', 'pf.id', '=', 'pft.product_field_id')
            ->where('pf.id', '=', $id)
            ->select('pf.*', 'pft.*')
            ->get();

        $section = DB::table('section as st')
            ->join('section_translation as stt', 'st.id', '=', 'stt.section_id')
            ->where('stt.local', '=', 'en')
            ->select('st.*', 'stt.*')
            ->get();

        return view('product-field.edit')
            ->with('name', 'product')
            ->with('menu', 'product_field')
            ->with('pd_field', $pd_field)
            ->with('section', $section);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $product_field_id = $request->product_field_id;
        $section = $request->section;
        $type = $request->type;
        $unit = $request->unit;

        DB::table('product_field')
        ->where('id', '=', $product_field_id)
        ->update([
            'section_id' => $section,
            'type' => $type,
            'status' => $request->status,
            'unit_name' => $request->unit,
        ]);

        $pd_field = DB::table('product_field as pf')
            ->join('product_field_translation as pft', 'pf.id', '=', 'pft.product_field_id')
            ->where('pf.id', '=', $product_field_id)
            ->select('pf.*', 'pft.*')
            ->get();

        foreach ($pd_field as $item) {
            $title = 'title_' . $item->local;

            DB::table('product_field_translation')->where('product_field_id', '=', $item->product_field_id)->where('local', '=', $item->local)->update([
               'field_name' => $request->$title,
            ]);
        }

        return redirect()->route('product-field.index')->with('flash_message', 'Update Data successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('product_field')->where('id', '=', $id)->delete();
        DB::table('product_field_translation')->where('product_field_id', '=', $id)->delete();

        return back()->with('flash_message', 'Delete Data successfully');
    }

    public function copyProductField(Request $request)
    {
        $new_local = $request->language;

        $name_en = DB::table('product_field as pf')
            ->join('product_field_translation as pft', 'pf.id', '=', 'pft.product_field_id')
            ->where('pft.local', '=', 'en')
            ->select('pf.*', 'pft.*')
            ->get();

        foreach ($name_en as $item) {
            $check_local = DB::table('product_field as pf')
                ->join('product_field_translation as pft', 'pf.id', '=', 'pft.product_field_id')
                ->where('pft.product_field_id', '=', $item->product_field_id)
                ->where('pft.local', '=', $new_local)
                ->get();

            if (0 == count($check_local)) {
                DB::table('product_field_translation')->insert(
                    [
                        'product_field_id' => $item->product_field_id,
                        'field_name' => $item->field_name,
                        'local' => $new_local,
                    ]
                );
            }
        }

        return redirect()->route('product-field.index')->with('flash_message', 'Copy Data successfully');
    }

    public function copyProductFieldsingle(Request $request)
    {
        $new_local = $request->language;
        $pd_field_id = $request->pd_field_id;

        $name_en = DB::table('product_field as pf')
            ->join('product_field_translation as pft', 'pf.id', '=', 'pft.product_field_id')
            ->where('pf.id', '=', $pd_field_id)
            ->where('pft.local', '=', 'en')
            ->select('pf.*', 'pft.*')
            ->get();

        foreach ($name_en as $item) {
            $check_local = DB::table('product_field as pf')
                ->join('product_field_translation as pft', 'pf.id', '=', 'pft.product_field_id')
                ->where('pft.product_field_id', '=', $item->product_field_id)
                ->where('pft.local', '=', $new_local)
                ->get();

            if (0 == count($check_local)) {
                DB::table('product_field_translation')->insert(
                    [
                        'product_field_id' => $item->product_field_id,
                        'field_name' => $item->field_name,
                        'local' => $new_local,
                    ]
                );
            }
        }

        return redirect()->route('product-field.index')->with('flash_message', 'Copy Data successfully');
    }
}
