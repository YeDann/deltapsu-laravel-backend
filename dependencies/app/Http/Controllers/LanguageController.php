<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $language = DB::table('language')->get();

        return view('language.index')
            ->with('name', 'setting')
            ->with('menu','language')
            ->with('language', $language);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('language.create')->with('name', 'setting')->with('menu', 'language');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = $request->language;

        $result_explode = explode('|', $result);

        $name = $result_explode[0];
        $abbreviation = $result_explode[1];

        $check_lang = DB::table('language')
            ->where('language.name', '=', $name)
            ->get();

        if (count($check_lang) == 1) {
            return redirect()->route('language.index')->with('error_message', 'Can not Insert Data');
        } else {
            $new_local = $name;  
            $create_language = false;
            $check =  self::copydataallContent($new_local);
            if($check){
                $create_language = DB::table('language')->insert(
                    [
                        "name" => $name,
                        "abbreviation" => $abbreviation,
                        "created_at" => \Carbon\Carbon::now(),
                        "updated_at" => \Carbon\Carbon::now(),
                    ]
                );
            }
            if ($create_language) {
                return redirect()->route('language.index')->with('flash_message', 'Insert Data successfully');
            } else {
                return redirect()->route('language.index')->with('error_message', 'Can not Insert Data');
            }
        }
    }

    private function copydataallContent($new_local){

                $product_field = DB::table('product_field as pf')
                ->join('product_field_translation as pft', 'pf.id', '=', 'pft.product_field_id')
                ->where('pft.local', '=', 'en')
                ->select('pf.*', 'pft.*')
                ->get();

                foreach ($product_field as $item) {
                    $check_local = DB::table('product_field as pf')
                        ->join('product_field_translation as pft', 'pf.id', '=', 'pft.product_field_id')
                        ->where('pft.product_field_id', '=', $item->product_field_id)
                        ->where('pft.local', '=', $new_local)
                        ->get();

                    if (count($check_local) == 0) {
                        DB::table('product_field_translation')->insert(
                            [
                                "product_field_id" => $item->product_field_id,
                                "field_name" => $item->field_name,
                                "local" => $new_local,
                            ]
                        );
                    }
                }

                $static_word = DB::table('static_keyword as w')
                ->join('static_keyword_translations as skt','skt.key_word','=','w.key_word')
                ->select('w.*','skt.*')
                ->where('skt.local','en')
                ->get();
                if(count($static_word) > 0){
                    foreach($static_word as $word){
                        $check2_local = DB::table('static_keyword as w')
                        ->join('static_keyword_translations as skt','skt.key_word','=','w.key_word')
                        ->select('w.*','skt.*')
                        ->where('w.key_word',$word->key_word)
                        ->where('skt.local',$new_local)
                        ->get();
                        if(count($check2_local) == 0){
                            DB::table('static_keyword_translations')->insert([
                                'key_word' => $word->key_word,
                                'word' => $word->word,
                                'local' => $new_local,
                            ]);
                        }
                    }
                }
               
                $subpro_categories =  DB::table('sub_pro_categories as sc')
                    ->join('sub_pro_categories_translation as sct', 'sct.sub_pro_id', '=', 'sc.sub_pro_id')
                    ->select('sc.*', 'sct.*')
                    ->where('sct.local','en')
                    ->get();
                    if(count($subpro_categories) > 0){
                        foreach($subpro_categories as $cate){
                            $check3_local = DB::table('sub_pro_categories as sc')
                            ->join('sub_pro_categories_translation as sct', 'sct.sub_pro_id', '=', 'sc.sub_pro_id')
                            ->select('sc.*', 'sct.*')
                            ->where('sct.local',$new_local)
                            ->get();
                            if(count($check3_local) == 0){
                               DB::table('sub_pro_categories_translation')->insert(
                                    [
                                        "sub_pro_id" => $cate->sub_pro_id,
                                        "name" => $cate->name,
                                        "content" => $cate->content,
                                        "file" => $cate->file,
                                        "local" =>$new_local,
                                    ]
                                );
                            }
                        }
                    }

                    $banners = DB::table('banner_slide as bs')
                    ->join('banner_slide_translations as bst','bs.id','=','bst.ban_id')
                    ->where('bst.local','=','en')
                    ->select('bs.*','bst.*')
                    ->orderBy('bs.order_seq' ,'asc')
                    ->get();

                    if(count($banners) > 0){
                        foreach($banners as $banner){
                            $check4_local = DB::table('banner_slide as bs')
                            ->join('banner_slide_translations as bst','bs.id','=','bst.ban_id')
                            ->where('bst.local','=',$new_local)
                            ->select('bs.*','bst.*')
                            ->orderBy('bs.order_seq' ,'asc')
                            ->get();

                            if(count($check4_local) == 0){
                               DB::table('banner_slide_translations')->insert(
                                    [
                                        "ban_id" => $banner->ban_id,
                                        "title" => $banner->title,
                                        "title2" => $banner->title2,
                                        "content" => $banner->content,
                                        "btn_link" =>$banner->btn_link,
                                        "btn_name" =>$banner->btn_name,
                                        "local" => $new_local
                                    ]
                                );
                            }
                        }
                    }

                    $contents = DB::table('application as ap')
                    ->join('application_translation as apt','ap.id','=','apt.app_id')
                    ->where('apt.local','=','en')
                    ->select('ap.*' ,'ap.id as applica_id','apt.*')
                    ->orderBy('ap.order_seq' ,'asc')
                    ->get();

                    if(count($contents) > 0){
                        foreach($contents as $con){
                            $check5_local =  DB::table('application as ap')
                            ->join('application_translation as apt','ap.id','=','apt.app_id')
                            ->where('apt.local','=',$new_local)
                            ->select('ap.*' ,'ap.id as applica_id','apt.*')
                            ->orderBy('ap.order_seq' ,'asc')
                            ->get();
                            if(count($check5_local) == 0){
                               DB::table('application_translation')->insert(
                                    [
                                        "app_id" => $con->app_id,
                                        "name" => $con->name,
                                        "overview" => $con->overview,
                                        "content" => $con->content,
                                        "overview_text" => $con->overview_text,
                                        "local" => $new_local
                                    ]
                                );
                            }
                        }
                    }

                $section = DB::table('section as st')
                ->join('section_translation as stt','st.id','=','stt.section_id')
                ->where('stt.local','=','en')
                ->select('st.*','stt.*')
                ->get();
        
                foreach($section as $item){
                    $check_local = DB::table('section as st')
                    ->join('section_translation as stt','st.id','=','stt.section_id')
                    ->where('stt.section_id','=',$item->section_id)
                    ->where('stt.local','=',$new_local)
                    ->get();
        
                    if(count($check_local) == 0){
                        DB::table('section_translation')->insert(
                            [
                                "section_id" => $item->section_id,
                                "name" => $item->name,
                                "local" => $new_local
                            ]
                        );
                    }
                }

                $products = DB::table('products_translation as pt')
                ->select('pt.*')
                ->where('pt.local','en')
                ->get();
                  foreach($products as $pro){
                    $check1_dup = DB::table('products_translation as pt')
                    ->select('pt.*')
                    ->where('pt.product_id',$pro->product_id)
                    ->where('pt.local',$new_local)
                    ->get();
                    if(count($check1_dup) == 0){
                        $products_translation = DB::table('products_translation')->insert(
                            [
                                "product_id" => $pro->product_id,
                                "content_1" =>  $pro->content_1,
                                "content_2" =>  $pro->content_2,
                                "showstatus"=> $pro->showstatus,
                                "local" => $new_local,
                            ]
                        );
                    }
                  }
              
               
                  $propertys = DB::table('product_has_property_translation as php')
                  ->select('php.*' )
                  ->where('php.local' ,'en')
                  ->get();

                  foreach($propertys as $per){
                    DB::table('product_has_property_translation')->insert(
                                [
                                    "per_fk_id" => $per->per_fk_id,
                                    "product_id" => $per->product_id,
                                    "value_text" => $per->value_text,
                                    "local" =>$new_local,
                                ]
                            );
                     }


                     $mainCategories = DB::table('main_pro_categories_translations as mpt')
                     ->where('mpt.local', '=', 'en')
                     ->select('mpt.*')
                     ->get();
 
                     if(count($mainCategories) > 0){
                         foreach($mainCategories as $main){
                             $checkMin1_dup =  DB::table('main_pro_categories_translations as mpt')
                             ->where('mpt.main_pro_id', '=', $main->main_pro_id)
                             ->where('mpt.local', '=', $new_local)
                             ->select('mpt.*')
                             ->get();
                             if(count($checkMin1_dup) == 0){
                                DB::table('main_pro_categories_translations')->insert(
                                    [
                                        "main_pro_id" => $main->main_pro_id,
                                        "name" => $main->name,
                                        "local" => $new_local,
                                    ]
                                );
                             }
                         }
                     }

                     $series =  DB::table('series_translations as st')
                        ->where('st.local' ,'en')
                        ->select('st.*')
                        ->get();
                     if(count($series) > 0){
                         foreach($series as $ser){
                             $checkse_dup =   DB::table('series_translations as st')
                             ->where('st.local' ,'en')
                             ->select('st.*')
                             ->get();
                             if(count($checkse_dup) == 0){
                                DB::table('series_translations')->insert(
                                    [
                                        "series_id" => $ser->series_id,
                                        "title" => $ser->title,
                                        "overview_content" =>$ser->overview_content,
                                        "local" => $new_local,
                                    ]
                                );
                             }
                         }
                     }



                return true;


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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $language = DB::table('language')->where('id',$id)->get();
        DB::table('product_field_translation')->where('local' ,$language[0]->name)->delete();
        DB::table('application_translation')->where('local' ,$language[0]->name)->delete();
        DB::table('least_products_translation')->where('local' ,$language[0]->name)->delete();
        DB::table('products_translation')->where('local' ,$language[0]->name)->delete();
        DB::table('product_ducument_translations')->where('local' ,$language[0]->name)->delete();
        DB::table('product_has_property_translation')->where('local' ,$language[0]->name)->delete();
        DB::table('pro_ducuments_cate_translations')->where('local' ,$language[0]->name)->delete();
        DB::table('series_translations')->where('local' ,$language[0]->name)->delete();
        DB::table('sub_pro_categories_translation')->where('local' ,$language[0]->name)->delete();
        DB::table('static_keyword_translations')->where('local' ,$language[0]->name)->delete();
        DB::table('banner_slide_translations')->where('local',$language[0]->name)->delete();
        DB::table('language')->where('id', '=', $id)->delete();
       
        return redirect()->route('language.index')->with('flash_message', 'Delete Data successfully');
    }
    public function updateLangStatus($id){
        $language = DB::table('language as lang')
        ->where('lang.id' ,$id)
        ->select('lang.*')
        ->get();
    
    if( $language[0]->status == 1){

        DB::table('language')->where('id',$id)->update(
            [
                "status" => 0,
            ]
        );
        $status = "Hide";
    }else{
        DB::table('language')->where('id',$id)->update(
            [
                "status" => 1,
            ]
        );
        $status = "Show";
    }
      

        return response()->json([
            'data' =>  $status,
                ], 200);

    }
}
