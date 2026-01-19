<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
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
        $contents = DB::table('product_notice_type as nt')
            ->join('product_notice_type_translation as ntt', 'ntt.product_notice_type_id', '=', 'nt.id')
            ->where('ntt.local', '=', 'en')
            ->select('nt.*', 'ntt.name')
            ->orderBy('nt.sort', 'asc')
            ->get();
        
        $countContent = count($contents);

        return view('product-notice-type.index')
            ->with('name', 'update')
            ->with('menu', 'product-notice-type')
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
        return view('product-notice-type.create')
            ->with('name', "update")
            ->with('menu', "product-notice-type")
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
            'title' => 'required',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        } else {
            $title = $request->title;
            // $description = $request->description;
            // $metaTitle = $request->meta_title;
            // $metaDescription = $request->meta_des;
            // $metaKeyword = $request->metaKeyword;

            $langloop = $request->langloop;

            $id = DB::table('product_notice_type')->insertGetID(
                [
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "sort" => 0,
                ]
            );

            foreach ($langloop as $lang) {
                DB::table('product_notice_type_translation')->insert(
                    [
                        "product_notice_type_id" => $id,
                        "name" => isset($title[$lang]) ? $title[$lang] : '',
                        // "description" => $description[$lang],
                        // "meta_title" => $metaTitle[$lang],
                        // "meta_description" => $metaDescription[$lang],
                        // "meta_keywords" => $metaKeyword[$lang],
                        "local" => $lang,
                    ]
                );
            }

            return redirect()->route('product-notice-type.index')->with('flash_message', 'Insert Data successfully');
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
        $contents = DB::table('product_notice_type')
            ->join('product_notice_type_translation', 'product_notice_type.id', '=', 'product_notice_type_translation.product_notice_type_id')
            ->where('product_notice_type.id', '=', $id)
            ->select('product_notice_type.*', 'product_notice_type_translation.*')
            ->orderBy('product_notice_type.updated_at', 'desc')
            ->get();
        $language = DB::table('language')->get();

        return view('product-notice-type.edit')
            ->with('name', "update")
            ->with('menu', "product-notice-type")
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
        $title = $request->title;
        // $description = $request->description;
        // $metaTitle = $request->meta_title;
        // $metaDescription = $request->meta_des;
        // $metaKeyword = $request->metaKeyword;

        $langloop = $request->langloop;

        DB::table('product_notice_type')->where('id', $typeId)->update(
            [
                "updated_at" => \Carbon\Carbon::now(),
            ]
        );

        foreach ($langloop as $lang) {
            DB::table('product_notice_type_translation')->where('product_notice_type_id', $typeId)->where('local', $lang)->update(
                [
                    "name" => $title[$lang],
                    // "description" => $description[$lang],
                    // "meta_title" => $metaTitle[$lang],
                    // "meta_description" => $metaDescription[$lang],
                    // "meta_keywords" => $metaKeyword[$lang],
                ]
            );
        }

        return redirect()->route('product-notice-type.index')->with('flash_message', 'Update Data successfully');
    }

    public function sort(Request $request)
    {
        $array_sort = $request->sort;
        $i = 1;
        foreach ($array_sort as $sort) {
            DB::table('product_notice_type')
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
        DB::table('product_notice_type')->where('id', '=', $id)->delete();
        DB::table('product_notice_type_translation')->where('product_notice_type_id', '=', $id)->delete();

        return back()->with('flash_message', 'Delete Data successfully');
    }
}
