<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Validator;
use Excel;
use File;
class GetDataController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getAllSubCategories(){

        $dochas =  DB::table('product_has_documents as phd')
        ->select('phd.*')
        ->get();

        $arrbox = [];
      foreach($dochas as $doc){
          
        $pro_has_doc = DB::table('product_ducuments as pd')
        ->join('product_ducument_translations as pdct', 'pd.doc_id', '=', 'pdct.doc_fk_id')
        ->join('products_documents_categories as pro_cate', 'pro_cate.id', '=', 'pd.cate_id')
        ->select('pd.*' , 'pdct.*' ,'pro_cate.title')
        ->where('pdct.local', '=', 'en')
        ->where('pd.doc_id', '=',$doc->document_id)
        ->orderBy('pd.created_at', 'desc')
        ->get();

        if(count($pro_has_doc) == 0){
          array_push($arrbox ,$doc->document_id);
        }

      }

       return dd('test');
       




        // return dd('get getAllSubCategories');

        // $categorys = DB::table('categorys as c')
        // ->where('c.type' ,'cat2')
        // ->whereIn('c.id',[1,3,5,7,9,11,786,998])
        // ->select('c.*')
        // ->get();

        // // return dd($categorys);
    
        // $language = DB::table('language')->get();
    
        // foreach($categorys as $cate){
        //     $id = DB::table('sub_pro_categories')->insertGetID(
        //         [
        //             'main_id'=> 0,
        //             'old_id'=> $cate->id,
        //             "created_at" => \Carbon\Carbon::now(),
        //             "updated_at" => \Carbon\Carbon::now(),
        //         ]
        //     );
        //     foreach($language as $lang){
        //         DB::table('sub_pro_categories_translation')->insert(
        //             [
        //                 "sub_pro_id" => $id,
        //                 "name" =>  $cate->title,
        //                 "content" => $cate->content,
        //                 "local" => $lang->name,
        //             ]
        //         );
        //     }
       

        // }

        //update series 
        // $series =  DB::table('series as s')
        // ->join('series_translations as st' ,'st.series_id' ,'=' ,'s.se_id')
        // ->where('st.local' ,'en')
        // ->select('s.*' ,'st.*')
        // ->orderBy('s.created_at','desc')
        // ->get();
        // foreach($series as $serie){
        //     $string = str_replace(' ', '-', $serie->title);
        //     DB::table('series')->where('se_id',$serie->se_id)->update(
        //         [
        //             'slug'=> strtolower($string),
        //             "updated_at" => \Carbon\Carbon::now(),
        //         ]
        //     );
        // }

        //update application 
        // $contents = DB::table('application as ap')
        // ->join('application_translation as apt','ap.id','=','apt.app_id')
        // ->where('apt.local','=','en')
        // ->select('ap.*' ,'ap.id as applica_id','apt.*')
        // ->orderBy('ap.order_seq' ,'asc')
        // ->get();
        // foreach($contents as $app){
        //     $string = str_replace(' ', '-', $app->name);
        //     DB::table('application')->where('id',$app->applica_id)->update(
        //         [
        //             'slug_app'=> strtolower($string),
        //         ]
        //     );
        // }

       //update faq 

        // $contents = DB::table('application as ap')
        // ->join('application_translation as apt','ap.id','=','apt.app_id')
        // ->where('apt.local','=','en')
        // ->select('ap.*' ,'ap.id as applica_id','apt.*')
        // ->orderBy('ap.order_seq' ,'asc')
        // ->get();

   


  

        // $contents = DB::table('old_contents')
        // ->where('type', '=', 'faq')
        // ->orderBy('translate_id', 'asc')
        // ->orderBy('id', 'asc')
        // ->get();
          
        // $Translation = [];
        // $newId  = [];
        // $checkcate = [];
        // foreach($contents as $data){
        //     if(!in_array($data->translate_id, $Translation)){
        //         $newId  = [];
        //         $cate_id = DB::table('contents_cat3s')
        //         ->where('contents_id','=',$data->translate_id)
        //         ->select('categorys_id')
        //         ->get();
        //           if(count($cate_id) != 0){
        //             $catenew_id = null;
        //             if($cate_id[0]->categorys_id == 17){
        //                 $catenew_id = 3;
        //             }else if($cate_id[0]->categorys_id == 21){
        //                 $catenew_id = 2;
        //             }else if($cate_id[0]->categorys_id == 19){
        //                 $catenew_id = 1;
        //             }
        //           }

        //            array_push($Translation ,$data->translate_id);
        //            $id = DB::table('faq')->insertGetID(
        //             [
        //                 "status" => $data->status,
        //                 "cate_id" => $catenew_id,
        //                 "created_at" => \Carbon\Carbon::now(),
        //                 "updated_at" => \Carbon\Carbon::now(),
        //             ]
        //           );
        //         array_push($newId ,$id);
        //      }
        //      DB::table('faq_translations')->insert(
        //         [   
        //             "faq_id" => $newId[0],
        //             "title" =>  $data->title,
        //             "content" => $data->content,
        //             "local" => $data->language,
        //         ]
        //     );

        // }
       
   
      
        return back()->with('flash_message', 'Get Data successfully');
       
        
    }
    public function getExcelProCategories(){

        return view('product.importExelCategories')
        ->with('menu', "products")
        ->with('name', "product");;
    }

    public function getCreateDataFilter(){
           
     
        $language = DB::table('language')->get();

    //     $subCategories = DB::table('sub_pro_categories as sp')
    //     ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'sp.sub_pro_id')
    //     ->where('spt.local', '=', 'en')
    //     ->select('sp.*', 'spt.*')
    //     ->orderBy('sp.created_at', 'desc')
    //     ->get();
    // // return dd( $subCategories);
    //     foreach($subCategories as $cate){
    //         DB::table('sub_pro_has_product_filter')->insertGetID(
    //             [
    //                 'sub_pro_id'=> $cate->sub_pro_id,
    //                 'name'=> 'Series',
    //                 'field_id'=> 'series01',
    //                 'order_seq'=> 1,
    //             ]
    //         );
    //         DB::table('sub_pro_has_product_filter')->insertGetID(
    //             [
    //                 'sub_pro_id'=> $cate->sub_pro_id,
    //                 'name'=>'Output Power',
    //                 'field_id'=> 8,
    //                 'order_seq'=> 2,
    //             ]
    //         );
    //         DB::table('sub_pro_has_product_filter')->insertGetID(
    //             [
    //                 'sub_pro_id'=> $cate->sub_pro_id,
    //                 'name'=> 'Output Voltage',
    //                 'field_id'=> 4,
    //                 'order_seq'=> 3,
    //             ]
    //         );
    //         DB::table('sub_pro_has_product_filter')->insertGetID(
    //             [
    //                 'sub_pro_id'=> $cate->sub_pro_id,
    //                 'name'=> 'Output Current',
    //                 'field_id'=> 3,
    //                 'order_seq'=> 4,
    //             ]
    //         );
    //         DB::table('sub_pro_has_product_filter')->insertGetID(
    //             [
    //                 'sub_pro_id'=> $cate->sub_pro_id,
    //                 'name'=> 'Input Voltage Range',
    //                 'field_id'=> 31,
    //                 'order_seq'=> 5,
    //             ]
    //         );
    //         DB::table('sub_pro_has_product_filter')->insertGetID(
    //             [
    //                 'sub_pro_id'=> $cate->sub_pro_id,
    //                 'name'=> 'Certificate',
    //                 'field_id'=> 'safety03',
    //                 'order_seq'=> 6,
    //             ]
    //         );
         
        
    //         DB::table('sub_pro_has_product_filter')->insertGetID(
    //             [
    //                 'sub_pro_id'=> $cate->sub_pro_id,
    //                 'name'=> 'Segment',
    //                 'field_id'=> 'certifi04',
    //                 'order_seq'=> 7,
    //             ]
    //         );
    //         DB::table('sub_pro_has_product_filter')->insertGetID(
    //             [
    //                 'sub_pro_id'=> $cate->sub_pro_id,
    //                 'name'=>'Status',
    //                 'field_id'=> 'status02',
    //                 'order_seq'=> 8,
    //             ]
    //         );
    //   }

        $subCategories = DB::table('sub_pro_has_product_filter as spr')
        ->select('spr.*')
        ->get();
        foreach($subCategories as $sub){
            foreach($language as $lang){
                DB::table('subpro_has_profilter_translation')->insert(
                    [
                        "fk_sub_pro_id" => $sub->id,
                        "title" => $sub->name,
                        "local" => $lang->name,
                    ]
                );
            }
        }
        return back()->with('flash_message', 'Get Data default filter successfully');

    }

    // public function getAllProduct(){

    //     $series =  DB::table('series_has_pro_categories as sc')
    //     ->join('series as s' ,'sc.se_id' ,'=' ,'s.se_id')
    //     ->join('series_translations as st' ,'st.series_id' ,'=' ,'s.se_id')
    //     ->where('s.old_id',790)
    //     ->where('st.local' ,'en')
    //     ->select('s.*' ,'st.*' ,'sc.pro_categories_id')
    //     ->get();
        
    //     // return  dd($series);

    //     $productall = DB::table('old_products as p')
    //     ->where('p.language' ,'en')
    //     ->select('p.*')
    //     ->OrderBy('p.time_create','asc')
    //     ->get();
    //     $language = DB::table('language')->get();
    //     $arrdatapro  = [];
    //     $seriesarr  = [];
    //     $productId  = [];
    //     foreach($productall as $pro){

    //         $series =  DB::table('series_has_pro_categories as sc')
    //         ->join('series as s' ,'sc.se_id' ,'=' ,'s.se_id')
    //         ->join('series_translations as st' ,'st.series_id' ,'=' ,'s.se_id')
    //         ->where('s.old_id',$pro->serie)
    //         ->where('st.local' ,'en')
    //         ->select('s.*' ,'st.*' ,'sc.pro_categories_id')
    //         ->get();    

    //         if(count($series) == 0){
    //            array_push($arrdatapro ,$pro->product_code);
    //            array_push($seriesarr ,$pro->serie);
    //            array_push($productId ,$pro->id);
    //         }
    //             $filename = substr($pro->picture_1, 22);
    //             $id = DB::table('products')->insertGetID(
    //                 [
    //                     'picture' =>$filename,
    //                     'pro_code'=>$pro->product_code,
    //                     'old_id'=>$pro->id,
    //                     'series_id'=> isset($series[0]->se_id) ? $series[0]->se_id:null,
    //                     'status_product'=>1,
    //                     'dimensionL'=>$pro->dimensions,
    //                     'dimensionW'=>$pro->dimen_w,
    //                     'dimensionD'=>$pro->dimen_d,
    //                     'unit_weight'=>$pro->weight,
    //                     "created_at" => $pro->time_create,
    //                     "updated_at" =>$pro->time_update,
    //                 ]
    //             );
    //                 foreach($language as $lang){
    //                     if($lang == 'cn'){
    //                         $traslatePro = DB::table('old_products as p')
    //                         ->where('p.language' ,'cn')
    //                         ->where('translate_id',$pro->id)
    //                         ->select('p.*')
    //                         ->get();
    //                         $products_translation = DB::table('products_translation')->insert(
    //                             [
    //                                 "product_id" => $id,
    //                                 "content_1" => $traslatePro[0]->description,
    //                                 "showstatus"=>$pro->status,
    //                                 "local" => $lang->name,
    //                             ]
    //                         );
    //                     }else{
    //                         $products_translation = DB::table('products_translation')->insert(
    //                             [
    //                                 "product_id" => $id,
    //                                 "content_1" => $pro->description,
    //                                 "showstatus"=>$pro->status,
    //                                 "local" => $lang->name,
    //                             ]
    //                         );
    //                     }
    //                 }
    
    //             $data_filds =  DB::table('product_datas as pd')
    //             ->where('pd.product_id',$pro->id)
    //             ->select('*')
    //             ->get();
                   
    //             foreach($data_filds as $data){
    //                     $pd_field = DB::table('product_field as pf')
    //                     ->where('pf.old_id', '=', $data->product_field_id)
    //                     ->select('pf.*')
    //                     ->get();
    //                 if(count($pd_field) != 0){
    //                     if($data->product_field_type != null){
    //                     if($data->product_field_type == 't'){
    //                         $pro_id_perty = DB::table('product_has_property')->insertGetID(
    //                             [
    //                                 'product_id'=>$id,
    //                                 'type_id'=> $pd_field[0]->id,
    //                                 'type_value'=>'text',
    //                                 'type_data'=> $data->product_field_type,
    //                             ]
    //                         );
    //                         foreach($language as $lang){
    //                             if($lang == 'cn'){
    //                                 $products_translation = DB::table('product_has_property_translation')->insert(
    //                                     [
    //                                         "per_fk_id" => $pro_id_perty,
    //                                         "value_text" => $data->data_text_cn,
    //                                         "product_id" => $id,
    //                                         "local" => $lang,
    //                                     ]
    //                                 );
    //                             }else{
    //                                 $products_translation = DB::table('product_has_property_translation')->insert(
    //                                     [
    //                                         "per_fk_id" => $pro_id_perty,
    //                                         "value_text" => $data->data_text,
    //                                         "product_id" => $id,
    //                                         "local" => $lang->name,
    //                                     ]
    //                                 );
    //                             }
    //                         }
                       
    //                       }else{
    //                             $status = 1;
    //                           if($data->product_field_type == 'r'){
    //                             $status = 3;
    //                           }else if($data->product_field_type == 'm'){
    //                             $status = 2;
    //                           }else if($data->product_field_type == 's'){
    //                             $status = 1;
    //                           }
    //                           $pro_id_perty = DB::table('product_has_property')->insertGetID(
    //                             [
    //                                 'product_id'=>$id,
    //                                 'type_id'=> $pd_field[0]->id,
    //                                 'type_value'=>'number',
    //                                 'type_data'=> $data->product_field_type,
    //                                 'status_input'=>$status,
    //                                 'data_1'=>$data->data_1,
    //                                 'data_2'=>$data->data_2,
    //                                 'data_3'=>$data->data_3,
    //                                 'data_4'=>$data->data_4,
    //                                 'data_5'=>$data->data_5,
    //                             ]
    //                         );
    //                              foreach($language as $lang){
    //                                 $products_translation = DB::table('product_has_property_translation')->insert(
    //                                     [
    //                                         "per_fk_id" => $pro_id_perty,
    //                                         "value_text" => $data->data_text,
    //                                         "product_id" => $id,
    //                                         "local" => $lang->name,
    //                                     ]
    //                                 );
    //                              }
    //                         }
    //                     }
    //                 }
    //              }

            
      
           
    //     }
    //     return dd($arrdatapro ,$seriesarr ,$productId);

    //     return back()->with('flash_message', 'Get Data successfully');
       
    // }
  
    // public function getAllSeries()
    // {
    //     // return dd('Empty series , series_translations ?');
    //     $arr  = [];

    //     $series =  DB::table('series as s')
    //     ->join('series_translations as st' ,'st.series_id' ,'=' ,'s.se_id')
    //     ->where('st.local' ,'en')
    //     ->select('s.*' ,'st.*')
    //     ->distinct()
    //     ->get();
        
    //     foreach($series as $se){
    //         $categorys = DB::table('categorys as c')
    //         ->where('c.language' ,'en')
    //         ->where('c.type' ,'cat2')
    //         ->where('c.id',$se->old_id)
    //         ->select('c.*')
    //         ->get();
    //         if(count($categorys) == 0){
    //             array_push($arr ,$se->title);
    //         }
            
    //     }
    //     return dd($arr);
        
    //     $language = DB::table('language')->get();

    //     foreach($categorys as $cate){

    //         $id = DB::table('series')->insertGetID(
    //             [
    //                 'status'=>$cate->status,
    //                 'old_id'=>$cate->id,
    //                 "created_at" => \Carbon\Carbon::now(),
    //                 "updated_at" => \Carbon\Carbon::now(),
    //             ]
    //         );

    //         foreach($language as $lang){
    //             DB::table('series_translations')->insert(
    //                  [
    //                      "series_id" => $id,
    //                      "title" => $cate->title,
    //                      "overview_content" => $cate->content,
    //                      "local" => $lang->name,
    //                  ]
    //              );
    //          }
            
    //          $subCategories = DB::table('sub_pro_categories as sp')
    //          ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'sp.sub_pro_id')
    //          ->where('spt.local', '=', 'en')
    //          ->select('sp.*', 'spt.*')
    //          ->where('sp.old_id', '=', $cate->parent_id)
    //          ->get();

    //              DB::table('series_has_pro_categories')->insert(
    //                  [
    //                      'se_id'=>$id,
    //                      'pro_categories_id'=>$subCategories[0]->sub_pro_id,
    //                  ]
    //              );
            
    //     }

    //     return back()->with('flash_message', 'Get Data successfully');
    // }

    public function getProductFildData(){
          return dd('Empty database product_field , product_field_translation ?');
        $language = DB::table('language')->get();
        $oldfields =  DB::table('product_fields')->orderBy('product_fields.created_at', 'desc')->get();
          foreach($oldfields as  $oldfield){
              $sectionId;
             if($oldfield->section == "output-ratings_characteristics"){
                $sectionId = 1;
             }else if($oldfield->section == "input-ratings_characteristics"){
                $sectionId = 2;
             }else if($oldfield->section == "mechanical"){
                $sectionId = 3;
             }else if($oldfield->section == "environment"){
                $sectionId = 4;
             }else if($oldfield->section == "protections"){
                $sectionId = 5;
             }else if($oldfield->section == "reliability-data"){
                $sectionId = 6;
             }else if($oldfield->section == "safty-standards_directives"){
                $sectionId = 7;
            }else if($oldfield->section == "emc"){
                $sectionId = 8;
            }else if($oldfield->section == "battery-input_output-characteristics"){
                $sectionId = 9;
            }

            $profieldId = DB::table('product_field')->insertGetID(
                [
                    "type" => $oldfield->type,
                    "old_id" => $oldfield->id,
                    "section_id" => $sectionId,
                    "unit_name" => $oldfield->unit,
                    "status"=>$oldfield->show_frontend_filter,
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                ]
            );

                foreach($language as $lang){
                    if($lang == 'cn'){
                        DB::table('product_field_translation')->insert(
                            [
                                "product_field_id" => $profieldId,
                                "field_name" =>$oldfield->title_cn,
                                "local" => $lang->name,
                            ]
                        );
                    }else{
                        DB::table('product_field_translation')->insert(
                            [
                                "product_field_id" => $profieldId,
                                "field_name" =>$oldfield->title,
                                "local" => $lang->name,
                            ]
                        );
                    }
                }
          }
          return back()->with('flash_message', 'Get Data successfully');
    }
    public function getfeatureProduct()
    {
        // return dd('dede');
        $Allproducts = DB::table('products as p')
        ->join('products_translation as pt', 'pt.product_id', '=', 'p.pro_id')
        ->select('p.*', 'pt.*')
        ->where('pt.local' ,'en')
        ->where('p.status_product' ,1)
        ->orderBy('p.created_at', 'desc')
        ->limit(4)
        ->get();

        foreach($Allproducts as $pro){
            DB::table('products')->where('pro_id',$pro->pro_id)->update(
                [
                    "feature_product" => 1,
                ]
            );
        }

        return back()->with('flash_message', 'Feature Product Data successfully');

    }
    public function getExcelProTag(){
         return view('product.importExelTag')
         ->with('menu', "products")
         ->with('name', "product");
    }

 

    public function CheckApiMail(Request $request){
        $datamacht = [];
        $notmacht = [];
        $macht = [];
     if ($request->hasFile('file')) {
         $extension = File::extension($request->file->getClientOriginalName());
         if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
             $path = $request->file->getRealPath();
             $data = Excel::load($path, function ($reader) {})->get();
         }
         // return dd($data);
            if(!empty($data) && $data->count()) {
             foreach ($data as $key => $value) {
                 // $key = $value['country'];
                 DB::table('mail_chimp_country')->insert(
                     [
                         "name" => $value['country'],
                         "created_at" => \Carbon\Carbon::now(),
                         "updated_at" => \Carbon\Carbon::now(),
                     ]
                 );
              
             }
           }

  

         return redirect()->route('products.index')->with('flash_message', 'create data Successfully');
       }
       return redirect()->route('products.index')->with('error_message', 'No file');

 }



}
?>