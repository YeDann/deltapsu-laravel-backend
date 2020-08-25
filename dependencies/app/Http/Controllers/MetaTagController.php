<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Validator;

class MetaTagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $metatags = DB::table('meta_tag_page as mtp')
        ->select('mtp.*')
        ->get();

        return view('metatag.index')
        ->with('metatags',$metatags)
        ->with('name', 'setting')
        ->with('menu', 'metatags');
    }
    public function create(){

        return view('metatag.create')
        ->with('name', 'setting')
        ->with('menu', 'metatags');
    }
    public function edit($id){
        $metatags = DB::table('meta_tag_page as mtp')
        ->where('mtp.id',$id)
        ->select('mtp.*')
        ->get();

        return view('metatag.edit')
        ->with('oldid',$id)
        ->with('metatags',$metatags)
        ->with('name', 'setting')
        ->with('menu', 'metatags');
    }
    public function store(Request $request){
       DB::table('meta_tag_page')->insert(
        [
            "page" => $request->page,
            "meta_title" => $request->metaTitle,
            "meta_description" => $request->metaDescription,
            "meta_key" => $request->metaKeyword,
        ]
      );
      return redirect()->route('metaTags')->with('flash_message', 'Insert Data successfully');
    }
    public function update(Request $request){
        $id = $request->oldId;
        DB::table('meta_tag_page')->where('id',$id)->update(
            [
                "meta_title" => $request->metaTitle,
                "meta_description" => $request->metaDescription,
                "meta_key" => $request->metaKeyword,
            ]
          );
          return redirect()->route('metaTags')->with('flash_message', 'Update Data successfully');

    }
    public function deleteMeta(Request $request){
        $id = $request->itemId;
        DB::table('meta_tag_page')->where('id',$id)->delete();
        return redirect()->route('metaTags')->with('flash_message', 'Delte Data successfully');
    }

}

?>