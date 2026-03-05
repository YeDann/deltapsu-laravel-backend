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

        // $language = DB::table('language')->get();
        // foreach($metatags as $meta){
        //   foreach($language as $lang){
        //     DB::table('meta_tag_page_translations')->insert(
        //        [
        //         "meta_id" =>$meta->id,
        //         "title" =>$meta->meta_title,
        //         "description" => $meta->meta_description,
        //         "local"=>$lang->name,
        //        ]
        //       );                     
        //    }
        // }

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
        // $metatags = DB::table('meta_tag_page as mtp')
        // ->where('mtp.id',$id)
        // ->select('mtp.*')
        // ->get();
        $language = DB::table('language')->get();
        $metatags = DB::table('meta_tag_page as mtp')
        ->join('meta_tag_page_translations as mtpt', 'mtp.id', '=', 'mtpt.meta_id')
        ->where('mtp.id',$id)
        ->select('mtp.*' ,'mtpt.*')
        ->get();

  
        return view('metatag.edit')
        ->with('oldid',$id)
        ->with('metatags',$metatags)
        ->with('language',$language)
        ->with('name', 'setting')
        ->with('menu', 'metatags');
    }
    public function store(Request $request){
       $metaId = DB::table('meta_tag_page')->insertGetId(
        [
            "page" => $request->page,
            "meta_title" => $request->metaTitle,
            "meta_description" => $request->metaDescription,
            "meta_key" => $request->metaKeyword,
        ]
      );
      
      // 為所有語言創建翻譯記錄
      $languages = DB::table('language')->get();
      foreach($languages as $lang) {
          DB::table('meta_tag_page_translations')->insert([
              'meta_id' => $metaId,
              'title' => $request->metaTitle,
              'description' => $request->metaDescription,
              'h1' => '', // 預設為空
              'local' => $lang->name
          ]);
      }
      
      return redirect()->route('metaTags')->with('flash_message', 'Insert Data successfully');
    }
    public function update(Request $request){
        $id = $request->oldId;
        $langloop = $request->lang_loop;
        $meta_title = $request->meta_title;
        $metaDescription = $request->metaDescription;
        $h1_title = $request->h1_title;
        // DB::table('meta_tag_page')->where('id',$id)->update(
        //     [
        //         "meta_title" => $request->metaTitle,
        //         "meta_description" => $request->metaDescription,
        //         "meta_key" => $request->metaKeyword,
        //     ]
        //   );

          foreach($langloop as $lang){
            DB::table('meta_tag_page_translations')->where('meta_id',$id)->where('local',$lang)->update(
                [
                    "h1" => isset($h1_title[$lang]) ? $h1_title[$lang] : null ,
                    "title" => isset($meta_title[$lang]) ? $meta_title[$lang] : null ,
                    "description" => $metaDescription[$lang],
                ]
            );
        }
          return redirect()->route('metaTags')->with('flash_message', 'Update Data successfully');

    }
    public function deleteMeta(Request $request){
        $id = $request->itemId;
        DB::table('meta_tag_page')->where('id',$id)->delete();
        return redirect()->route('metaTags')->with('flash_message', 'Delte Data successfully');
    }

}

?>