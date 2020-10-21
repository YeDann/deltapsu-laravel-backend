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
     

        // return dd($contents_e);

        return view('language.index')
            ->with('name', 'setting')
            ->with('menu','language')
            ->with('language', $language);
    }
    public function copyToLang($lang){
         $taskNameArr = [
         'product_field_translation',
         'static_keyword_translations',
         'sub_pro_categories_translation',
         'banner_slide_translations',
         'application_translation',
         'section_translation',
         'products_translation',
         'product_has_property_translation (Wait about 15 minutes)',
         'main_pro_categories_translations',
         'series_translations',
         'static_content_translations',
         'cproducts',
         'contents_translations (news)',
         'news_type_translation',
         'contents_translations (events)',
         'pro_ducuments_cate_translations',
         'continents_translations',
         'faq_categories_translations',
         'faq_translations',
         'least_products_translation',
         'marketing_resource_cate_translations',
         'marketing_resource_translations',
         'office_translations',
         'partner_documents_translations',
         'partner_page_info_translation',
         'relate_pro_launch_schedule_translation',
         'subpro_has_profilter_translation',
         'tech_type_translation',
         'about_us_translations',
         'product_ducument_translations'
        ];
        // return dd(count($taskNameArr));
         return view('language.copy_lang')
         ->with('name', 'setting')
         ->with('newlang', $lang)
         ->with('taskarr', $taskNameArr)
         ->with('menu','language');
    }
    public function copyDataActionReq(Request $request){
        $task = $request->task;
        $new_local = $request->newlang;
        self::copydataallContent($new_local, $task);
        return response()->json([
            'status' => 1,
            'new_local'=>$new_local,
        ],200);
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
        

                $create_language = DB::table('language')->insert(
                    [
                        "name" => $name,
                        "abbreviation" => $abbreviation,
                        "status" => 0,
                        "created_at" => \Carbon\Carbon::now(),
                        "updated_at" => \Carbon\Carbon::now(),
                    ]
                );
            
            if ($create_language) {
                return redirect()->route('copyToLang',$new_local);
            } else {
                return redirect()->route('language.index')->with('error_message', 'Can not Insert Data');
            }
        }
    }


    private function copydataallContent($new_local ,$task){

             if($task == 1){
                $product_field = DB::table('product_field_translation as pft')
                ->where('pft.local', '=', 'en')
                ->select('pft.*')
                ->get();

                foreach ($product_field as $item) {
                    $check_local = DB::table('product_field_translation as pft')
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
             }
       
             if($task == 2){
                $static_word = DB::table('static_keyword_translations as skt')
                ->select('skt.*')
                ->where('skt.local','en')
                ->get();
                if(count($static_word) > 0){
                    foreach($static_word as $word){
                        $check2_local = DB::table('static_keyword_translations as skt')
                        ->select('skt.*')
                        ->where('skt.key_word',$word->key_word)
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
            }
            if($task == 3){
                $subpro_categories =  DB::table('sub_pro_categories_translation as sct')
                    ->select('sct.*')
                    ->where('sct.local','en')
                    ->get();
                    if(count($subpro_categories) > 0){
                        foreach($subpro_categories as $cate){
                            $check3_local = DB::table('sub_pro_categories_translation as sct')
                            ->select('sct.*')
                            ->where('sct.sub_pro_id',$cate->sub_pro_id)
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
                }
                if($task == 4){
                    $banners = DB::table('banner_slide_translations as bst')
                    ->where('bst.local','=','en')
                    ->select('bst.*')
                    ->get();

                    if(count($banners) > 0){
                        foreach($banners as $banner){
                            $check4_local = DB::table('banner_slide_translations as bst')
                            ->where('bst.ban_id','=',$banner->ban_id)
                            ->where('bst.local','=',$new_local)
                            ->select('bst.*')
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

                }
                if($task == 5){
                    $contents = DB::table('application_translation as apt')
                    ->where('apt.local','=','en')
                    ->select('apt.*')
                    ->get();

                    if(count($contents) > 0){
                        foreach($contents as $con){
                            $check5_local =  DB::table('application_translation as apt')
                            ->where('apt.app_id','=',$con->app_id)
                            ->where('apt.local','=',$new_local)
                            ->select('apt.*')
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
                }
            if($task == 6){
                $section = DB::table('section_translation as stt')
                ->where('stt.local','=','en')
                ->select('stt.*')
                ->get();
        
                foreach($section as $item){
                    $check_local = DB::table('section_translation as stt')
                    ->where('stt.section_id','=',$item->section_id)
                    ->where('stt.local','=',$new_local)
                    ->get();
        
                    if(count($check_local) == 0){
                        DB::table('section_translation')->insert(
                            [
                                "section_id" => $item->section_id,
                                "name" => $item->name,
                                "sortname" =>$item->sortname,
                                "local" => $new_local
                            ]
                        );
                    }
                }
            }
            if($task == 7){
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
                }
              
                if($task == 8){
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
                    }
                    if($task == 9){
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
                    }
                    if($task == 10){
                     $series =  DB::table('series_translations as st')
                        ->where('st.local' ,'en')
                        ->select('st.*')
                        ->get();
                     if(count($series) > 0){
                         foreach($series as $ser){
                             $checkse_dup =   DB::table('series_translations as st')
                             ->where('st.local' ,$new_local)
                             ->where('st.series_id',$ser->series_id)
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
                    }
                    if($task == 11){
                     $static_content = DB::table('static_content_translations as sct')
                     ->select('sct.*')
                     ->get();

                     if(count($static_content) > 0){
                        foreach($static_content as $st_con){
                            $checkse_dup2 =   DB::table('static_content_translations as sct')
                            ->where('sct.local' ,$new_local)
                            ->where('sct.sta_fk_id',$st_con->sta_fk_id)
                            ->select('sct.*')
                            ->get();
                            if(count($checkse_dup2) == 0){
                                DB::table('static_content_translations')->insert(
                                    [
                                        "sta_fk_id" => $st_con->sta_fk_id,
                                        "title" => $st_con->title,
                                        "content" =>  $st_con->content,
                                        "local" =>$new_local
                                    ]
                                );

                            }
                        }

                     }
                    }
                    if($task == 12){
                     $cproducts = DB::table('cproducts')
                     ->where('language','=','en')
                     ->select('cproducts.*')
                     ->get();
                     if(count($cproducts) > 0){
                        foreach($cproducts as $c_pro){    
                            DB::table('cproducts')->insert(
                                [
                                    'product_code'=>$c_pro->product_code,
                                    "translate_id" => $c_pro->translate_id,
                                    'slug'=> $c_pro->slug,
                                    'description'=>$c_pro->description,
                                    'thumb_img'=>$c_pro->thumb_img,
                                    'certificate_img'=>$c_pro->certificate_img,
                                    'preview_img'=>$c_pro->preview_img,
                                    'dimensions'=>$c_pro->dimensions,
                                    'dimen_w'=>$c_pro->dimen_w,
                                    'dimen_d'=>$c_pro->dimen_d,
                                    'weight'=>$c_pro->weight,
                                    'max_power'=>$c_pro->max_power,
                                    'max_slot'=>$c_pro->max_slot,
                                    'model'=>$c_pro->model,
                                    'panel'=>$c_pro->panel,
                                    'frame'=>$c_pro->frame,
                                    'status'=>$c_pro->status,
                                    'language'=> $new_local,
                                    "time_create" => \Carbon\Carbon::now(),
                                    "time_update" => \Carbon\Carbon::now(),
                                ]
                            );
                       }

                    }
                }
                if($task == 13){
                    $contents_e = DB::table('contents as c')
                    ->join('contents_translations as ct' ,'c.id' ,'=','ct.content_id')
                    ->where('ct.local', '=', 'en')
                    ->where('c.content_type', '=', 'news')
                    ->select('ct.*')
                    ->get();

                    if(count($contents_e) > 0){
                        foreach($contents_e as $con_data){
                            DB::table('contents_translations')->insert(
                                [
                                    "content_id" =>$con_data->content_id,
                                    "title" => $con_data->title,
                                    "content" => $con_data->content,
                                    "description" => $con_data->description,
                                    "meta_title" => $con_data->meta_title,
                                    "meta_description" =>$con_data->meta_description,
                                    "meta_keywords" =>$con_data->meta_keywords,
                                    "location" =>$con_data->location,
                                    'file' => $con_data->file,
                                    "local"=>$new_local,
                                ]
                            );
                        }
                    }
                }
                if($task == 14){
                    $new_type  = DB::table('news_type_translation as nt')
                    ->select('nt.*')
                    ->where('nt.local','en')
                    ->get();
                    if(count($new_type) > 0){
                        foreach($new_type as $type){
                            DB::table('news_type_translation')->insert(
                                [
                                    "title" => $type->title,
                                    "fk_nt_id" =>$type->fk_nt_id,
                                    "local" => $new_local,
                                ]
                            );
                       }
                    }
                }
                if($task == 15){
                    $contents_e2 = DB::table('contents as c')
                    ->join('contents_translations as ct' ,'c.id' ,'=','ct.content_id')
                    ->where('ct.local', '=', 'en')
                    ->where('c.content_type', '=', 'event')
                    ->select('ct.*')
                    ->get();

                    if(count($contents_e2) > 0){
                        foreach($contents_e2 as $con_data){
                            DB::table('contents_translations')->insert(
                                [
                                    "content_id" =>$con_data->content_id,
                                    "title" => $con_data->title,
                                    "content" => $con_data->content,
                                    "description" => $con_data->description,
                                    "meta_title" => $con_data->meta_title,
                                    "meta_description" =>$con_data->meta_description,
                                    "meta_keywords" =>$con_data->meta_keywords,
                                    "location" =>$con_data->location,
                                    'file' => $con_data->file,
                                    "local"=>$new_local,
                                ]
                            );
                        }
                    }
                }
                if($task == 16){
                    $pro_ducuments_cate = DB::table('pro_ducuments_cate_translations as pdct')
                    ->where('pdct.local', '=', 'en')
                    ->select('pdct.*')
                    ->get();
                    if(count($pro_ducuments_cate) > 0){
                        foreach($pro_ducuments_cate as $doc_cate){
                            DB::table('pro_ducuments_cate_translations')->insert(
                                [
                                    "doc_cate_id" => $doc_cate->doc_cate_id,
                                    "lable" => $doc_cate->lable,
                                    "local"=>$new_local
                                ]
                            );
                        }
                    }
                }
                if($task == 17){
                    $continents = DB::table('continents_translations as ct')
                    ->where('ct.local', '=', 'en')
                    ->select('ct.*')
                    ->get();
                    if(count($continents) > 0){
                        foreach($continents as $conti){
                            DB::table('continents_translations')->insert(
                                [   
                                    'cont_id'=> $conti->cont_id,
                                    "name" => $conti->name,
                                    "local"=> $new_local
                                ]
                            );
                        }
                    }
                }
                if($task == 18){
                    $faq_categories = DB::table('faq_categories_translations as fct')
                    ->where('fct.local' ,'en')
                    ->select('fct.*')
                    ->get();
                    if(count($faq_categories) > 0){
                        foreach($faq_categories as $faq_cate){
                            DB::table('faq_categories_translations')->insert(
                                [   
                                    "f_cate_id" => $faq_cate->f_cate_id,
                                    "name" => $faq_cate->name,
                                    "local" => $new_local,
                                ]
                            );
                        }
                    }
                }
                if($task == 19){
                    $faqs = DB::table('faq_translations as ft')
                    ->where('ft.local', '=', 'en')
                    ->select('ft.*')
                    ->get();
                    if(count($faqs) > 0){
                        foreach($faqs as $faq){
                            DB::table('faq_translations')->insert(
                                [   
                                    "faq_id" => $faq->faq_id,
                                    "title" => $faq->title,
                                    "content" =>$faq->content,
                                    "local" => $new_local,
                                ]
                            );
                        }
                    }
                }
                if($task == 20){
                    $least_products = DB::table('least_products_translation as let')
                    ->where('let.local', '=', 'en')
                    ->select('let.*')
                    ->get();
                    if(count($least_products) > 0){
                        foreach($least_products as $least){
                            DB::table('least_products_translation')->insert(
                                [
                                    "last_id" => $least->last_id,
                                    "title" => $least->title,
                                    "description" => $least->description,
                                    "link" => $least->link,
                                    "local" => $new_local
                                ]
                             );
                         }
                    }
                }
                if($task == 21){
                    $margetCate = DB::table('marketing_resource_cate_translations as mct')
                    ->where('mct.local', '=', 'en')
                    ->select('mct.*')
                    ->get();
                    if(count($margetCate) > 0){
                        foreach($margetCate as $mar){
                            DB::table('marketing_resource_cate_translations')->insert(
                                [   
                                    "mk_fk_id" => $mar->mk_fk_id,
                                    "name" => $mar->name,
                                    "local" => $new_local,
                                ]
                            );
                        }
                    }
                }
                if($task == 22){
                    $marget = DB::table('marketing_resource_translations as mt')
                    ->where('mt.local', '=', 'en')
                    ->select('mt.*')
                    ->get();
                    if(count($marget) > 0){
                        foreach($marget as $item){
                            DB::table('marketing_resource_translations')->insert(
                                [   
                                    "mr_id" => $item->mr_id,
                                    "name" => $item->name,
                                    "file" => $item->file,
                                    "local" => $new_local,
                                ]
                            );
                        }
                    }
                }
                if($task == 23){
                    $offices = DB::table('office_translations as oft')
                    ->where('oft.local', '=', 'en')
                    ->select('oft.*')
                    ->get();
                    if(count($offices) > 0){
                        foreach($offices as $item2){
                            DB::table('office_translations')->insert(
                                [   
                                    "fk_office_id" => $item2->fk_office_id,
                                    "title" => $item2->title,
                                    "sub_title" => $item2->sub_title,
                                    "content" => $item2->content,
                                    "local" => $new_local,
                                ]
                            );
                        }
                    }
                }
                if($task == 24){
                    $partner_documents = DB::table('partner_documents_translations as pdt')
                    ->where('pdt.local', '=', 'en')
                    ->select('pdt.*')
                    ->get();
                    if(count($partner_documents) > 0){
                        foreach($partner_documents as $item2){
                            DB::table('partner_documents_translations')->insert(
                                [   "sk_fk_id"=>$item2->sk_fk_id,
                                    "name" => $item2->name,
                                    "file" => $item2->file,
                                    "local" => $new_local,
                                ]
                            );
                        }
                    }
                }
                if($task == 25){
                    $partner_page_info = DB::table('partner_page_info_translation as pit')
                    ->select('pit.*')
                    ->where('pit.local' ,'en')
                    ->get();
                    if(count($partner_page_info) > 0){
                        foreach($partner_page_info as $item2){
                            DB::table('partner_page_info_translation')->insert(
                                [
                                    "fk_p_id" => $item2->fk_p_id,
                                    "title" => $item2->title,
                                    "content" => $item2->content,
                                    "local" => $new_local
                                ]
                            );
                        }
                    }
                }
                if($task == 26){
                    $relate_pro_launch = DB::table('relate_pro_launch_schedule_translation as rpl')
                    ->select('rpl.*')
                    ->where('rpl.local' ,'en')
                    ->get();
                    if(count($relate_pro_launch) > 0){
                        foreach($relate_pro_launch as $item2){
                            DB::table('relate_pro_launch_schedule_translation')->insert(
                                [
                                    "fk_relate_pl" => $item2->fk_relate_pl,
                                    "modelname" => $item2->modelname,
                                    "op_voltage" => $item2->op_voltage,
                                    "op_wattage" => $item2->op_wattage,
                                    "phase" => $item2->phase,
                                    "remark" => $item2->remark,
                                    "file" =>  $item2->file,
                                    "local" => $new_local,
                
                                ]
                             );
                        }
                    }
                }
                if($task == 27){
                    $subpro_has_profilter = DB::table('subpro_has_profilter_translation as subpro')
                    ->where('subpro.local' ,'en')
                    ->select('subpro.*')
                    ->get();
                    if(count($subpro_has_profilter) > 0){
                        foreach($subpro_has_profilter as $item2){
                            DB::table('subpro_has_profilter_translation')->insert(
                                [
                                    "fk_sub_pro_id" => $item2->fk_sub_pro_id,
                                    "title" => $item2->title,
                                    "local" => $new_local,
                
                                ]
                             );
                        }
                    }
                }
                if($task == 28){
                    $tech_type_translation = DB::table('tech_type_translation as type')
                    ->where('type.local' ,'en')
                    ->select('type.*')
                    ->get();
                    if(count($tech_type_translation) > 0){
                        foreach($tech_type_translation as $item2){
                            DB::table('tech_type_translation')->insert(
                                [
                                    "tech_id" => $item2->tech_id,
                                    "name" => $item2->name,
                                    "local" => $new_local,
                
                                ]
                             );
                        }
                    }
                }
                if($task == 29){
                    $about_us = DB::table('about_us_translations as aut')
                    ->where('aut.local', '=', 'en')
                    ->select('aut.*')
                    ->get();
                    if(count($about_us) > 0){
                        foreach($about_us as $abt){
                            DB::table('about_us_translations')->insert(
                                [   
                                    "abt_id" => $abt->abt_id,
                                    "title" => $abt->title,
                                    "content" => $abt->content,
                                    "metaTitle" => $abt->metaTitle,
                                    "metaDescription" =>$abt->metaDescription,
                                    "metaKeyword" => $abt->metaKeyword,
                                    "local" => $new_local,
                                ]
                            );
                        }
                    }
                }
                if($task == 30){

                    $pro_doc_translations = DB::table('product_ducument_translations as pdt')
                    ->where('pdt.local', '=', 'en')
                    ->select('pdt.*')
                    ->get();

                    if(count($pro_doc_translations) > 0){
                        foreach($pro_doc_translations as $pdt){
                            DB::table('product_ducument_translations')->insert(
                                [
                                    "doc_fk_id" =>$pdt->doc_fk_id,
                                    "name" =>$pdt->name,
                                    "file" =>$pdt->file,
                                    "local" =>$new_local,
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
        DB::table('static_content_translations')->where('local',$language[0]->name)->delete();
        DB::table('cproducts')->where('language',$language[0]->name)->delete();
        DB::table('news_type_translation')->where('local',$language[0]->name)->delete();
        DB::table('about_us_translations')->where('local',$language[0]->name)->delete();
        DB::table('continents_translations')->where('local',$language[0]->name)->delete();
        DB::table('faq_categories_translations')->where('local',$language[0]->name)->delete();
        DB::table('marketing_resource_cate_translations')->where('local',$language[0]->name)->delete();
        DB::table('marketing_resource_translations')->where('local',$language[0]->name)->delete();
        DB::table('partner_documents_translations')->where('local',$language[0]->name)->delete();
        DB::table('partner_page_info_translation')->where('local',$language[0]->name)->delete();
        DB::table('relate_pro_launch_schedule_translation')->where('local',$language[0]->name)->delete();
        DB::table('section_translation')->where('local',$language[0]->name)->delete();
        DB::table('subpro_has_profilter_translation')->where('local',$language[0]->name)->delete();
        DB::table('contents_translations')->where('local',$language[0]->name)->delete();
        DB::table('faq_translations')->where('local',$language[0]->name)->delete();
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
