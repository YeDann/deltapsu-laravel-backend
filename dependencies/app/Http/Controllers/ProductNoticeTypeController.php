<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;

class ProductNoticeTypeController extends Controller
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
        $contents = DB::table('product_notice_type as pnt')
        ->join('product_notice_type_translation as pntt', 'pntt.fk_pnt_id', '=', 'pnt.id')
        ->select('pntt.*', 'pnt.*')
        ->where('pntt.local', 'en')
        ->orderBy('pnt.order_seq', 'asc')
        ->get();

        return view('product-notice-type.index')
        ->with('name', 'update')
        ->with('menu', 'product-notice')
        ->with('contents', $contents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product-notice-type.create')
        ->with('name', 'update')
        ->with('menu', 'product-notice');
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

            $id =  DB::table('product_notice_type')->insertGetID(
                [
                     "name" => $name,
                     "color_type" => $request->color_type,
                     "created_at" => \Carbon\Carbon::now(),
                     "updated_at" => \Carbon\Carbon::now(),
                 ]
            );
            $language = DB::table('language')->get();
            foreach ($language as $lang) {
                DB::table('product_notice_type_translation')->insert(
                    [
                        "title" => $name,
                        "fk_pnt_id" => $id,
                        "local" => $lang->name,
                    ]
                );
            }

        }
        return redirect()->route('product-notice-type.index')->with('flash_message', 'Insert Data successfully');
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
        $contents = DB::table('product_notice_type as pnt')
        ->where('pnt.id', '=', $id)
        ->Leftjoin('product_notice_type_translation as pntt', 'pntt.fk_pnt_id', '=', 'pnt.id')
        ->select('pntt.*', 'pnt.*')
        ->get();
        $language = DB::table('language')->get();
        return view('product-notice-type.edit')
        ->with('name', 'update')
        ->with('menu', 'product-notice')
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
            DB::table('product_notice_type')->where('id', '=', $request->type_id)->update(array(
                "color_type" => $request->color_type,
                "order_seq" => $request->order_seq,
                "updated_at" => \Carbon\Carbon::now()
            ));
            foreach ($langloop as $lang) {
                $data = DB::table('product_notice_type_translation')->where('fk_pnt_id', '=', $request->type_id)->where('local', $lang)->get();
                if (count($data) > 0) {
                    DB::table('product_notice_type_translation')->where('fk_pnt_id', '=', $request->type_id)->where('local', $lang)->update(array(
                        "title" => $name[$lang]
                    ));
                } else {
                    DB::table('product_notice_type_translation')->insert(
                        [
                            "title" => $name[$lang],
                            "fk_pnt_id" => $request->type_id,
                            "local" => $lang,
                        ]
                    );
                }

            }


        }
        return redirect()->route('product-notice-type.index')->with('flash_message', 'Update Data successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('product_notice_type')->where('id', '=', $id)->delete();
        DB::table('product_notice_type_translation')->where('fk_pnt_id', '=', $id)->delete();
        return back()->with('flash_message', 'Delete Data successfully');
    }
}
