<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Validator;

class ProductFilterController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function filter_setting($id){

        $pd_fields = DB::table('product_field as pf')
        ->join('product_field_translation as pft', 'pf.id', '=', 'pft.product_field_id')
        ->where('pft.local' ,'en')
        ->where('pf.status' ,1)
        ->select('pf.id as pd_field_id', 'pf.type', 'pf.created_at', 'pft.field_name','pf.section_id' , 'pft.local as pft_local')
        ->orderBy('pf.created_at', 'desc')
        ->get();

        // return dd($pd_fields);
        $filter_pro = DB::table('sub_pro_has_product_filter as shf')
        ->where('shf.sub_pro_id' ,$id)
        ->select('shf.*')
        ->orderBy('shf.order_seq', 'asc')
        ->get();

        $section = DB::table('section as st')
        ->join('section_translation as stt','st.id','=','stt.section_id')
        ->where('stt.local' ,'en')
        ->select('st.id as sectionId','stt.name')
        ->get();

         return view('product.product_filter')
               ->with('pro_cate', $id)
                ->with('name', 'product')
                ->with('menu', 'subCategories')
                ->with('section', $section)
                ->with('filter_pro', $filter_pro)
                ->with('pd_fields', $pd_fields);
    }
    public function storeFilter(Request $request){
     $filername = $request->filername;
     $sub_pro_id = $request->pro_categories;
     $language = DB::table('language')->get();
    //  return dd($language);
     if( $filername != 'null'){
        $result_explode = explode('|', $filername);
    
      $feildname = $result_explode[1];
      $feildId =  $result_explode[0] ;
      $data = DB::table('sub_pro_has_product_filter')->where('sub_pro_id', $sub_pro_id)->where('field_id' , $feildId)->get();
    //return dd(count($data));
      if(count($data) == 0){
        $id = DB::table('sub_pro_has_product_filter')->insertGetID(
            [
                'sub_pro_id'=> $sub_pro_id,
                'name'=> $feildname,
                'field_id'=> $feildId,
            ]
           
        );
        foreach($language as $lang){

            DB::table('subpro_has_profilter_translation')->insert(
                [
                    "fk_sub_pro_id" => $id,
                    "title" => $feildname,
                    "local" => $lang->name,
                ]
            );
        }
        return redirect()->route('filter_setting', $sub_pro_id)->with('flash_message', 'Insert Data successfully');

      }else{
        return redirect()->route('filter_setting', $sub_pro_id)->with('error_message', 'Field was already');
      }
      
     }else{
        return redirect()->route('filter_setting', $sub_pro_id)->with('error_message', 'Please Select Filter');
     }
    }

    public function deletefilter(Request $request){
        $item = $request->itemId;
        $sub_pro_id = $request->pro_categories;
        DB::table('sub_pro_has_product_filter')->where('id' ,$item)->delete();
        return redirect()->route('filter_setting', $sub_pro_id)->with('flash_message', 'Delete Data successfully');
    }

    
    public function update_order_filer(Request $request){
        $HomeIds = array_filter(explode(",", $request->home_id));
        $HomeOrders = array_filter(explode(",", $request->home_order));
        foreach ($HomeIds as $HomeId => $value){
             DB::table('sub_pro_has_product_filter')->where('id', '=', $value)->update(['order_seq'=>$HomeOrders[$HomeId]]);
        }
        return response()->json([
            'order' => $request->home_order
        ],200);
        
    }
    public function default_filer(){
        $pd_fields = DB::table('product_field as pf')
        ->join('product_field_translation as pft', 'pf.id', '=', 'pft.product_field_id')
        ->where('pft.local' ,'en')
        ->where('pf.status' ,1)
        ->select('pf.id as pd_field_id', 'pf.type', 'pf.created_at', 'pft.field_name','pf.section_id' , 'pft.local as pft_local')
        ->orderBy('pf.created_at', 'desc')
        ->get();

        // return dd($pd_fields);
        $filter_pro = DB::table('default_filter as df')
        ->select('df.*')
        ->get();

        $section = DB::table('section as st')
        ->join('section_translation as stt','st.id','=','stt.section_id')
        ->where('stt.local' ,'en')
        ->select('st.id as sectionId','stt.name')
        ->get();

         return view('product.default_filter')
                ->with('name', 'product')
                ->with('menu', 'subCategories')
                ->with('section', $section)
                ->with('filter_pro', $filter_pro)
                ->with('pd_fields', $pd_fields);
    }

    public function storeDefaultfiler(Request $request){
        $filername = $request->filername;
        $language = DB::table('language')->get();
        if( $filername != 'null'){
           $result_explode = explode('|', $filername);
       
         $feildname = $result_explode[1];
         $feildId =  $result_explode[0] ;
         $data = DB::table('default_filter')->where('filter_id' , $feildId)->get();
       //return dd(count($data));
         if(count($data) == 0){
           $id = DB::table('default_filter')->insertGetID(
               [
                   'name'=> $feildname,
                   'filter_id'=> $feildId,
               ]
              
           );
     
           return redirect()->route('default_filer')->with('flash_message', 'Insert Data successfully');
   
         }else{
           return redirect()->route('default_filer')->with('error_message', 'Field was already');
         }
         
        }else{
           return redirect()->route('default_filer')->with('error_message', 'Please Select Filter');
        }
       }
       public function deleteDefaultfilter(Request $request){
        $item = $request->itemId;
  
        DB::table('default_filter')->where('id' ,$item)->delete();
        return redirect()->route('default_filer')->with('flash_message', 'Delete Data successfully');
    }




}
?>