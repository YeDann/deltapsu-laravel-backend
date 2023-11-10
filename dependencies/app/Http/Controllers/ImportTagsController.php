<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Validator;
use Excel;
use File;
use Illuminate\Support\Facades\Hash;
class ImportTagsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    } 

    public function getExcelProTag(){
         return view('product.importExelTag')
         ->with('menu', "products")
         ->with('name', "product");
    }
    public function getExcelProOptional(){
         return view('product.importOptinalModel')
         ->with('menu', "products")
         ->with('name', "product");
    }
    


    public function importProductTag(Request $request){

    if ($request->hasFile('file')) {
    $extension = File::extension($request->file->getClientOriginalName());
    if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
        $path = $request->file->getRealPath();
        $data = Excel::load($path, function ($reader) {})->get();
    }
    
       if(!empty($data) && $data->count()) {
        foreach ($data as $key => $value) {
        $pro = DB::table('products as p')->where('p.pro_code',trim($value->model))->first();
        if(isset($pro) && isset($value->tags) && $value->tags != null){
            DB::table('product_tags')->where('product_id',$pro->pro_id)->delete();
                $arr = [];
                $arr = explode(",",$value->tags);
            
                if(count($arr) > 0){
                   foreach($arr as $tag){
                    DB::table('product_tags')->insert(
                        [
                            "tag" => $tag,
                            "product_id" => $pro->pro_id,
                        ]
                    );

                   }
                }
        }
           
        
      }
    }
    return redirect()->route('getExcelProTag')->with('flash_message', 'create data Successfully');
  }
  return redirect()->route('getExcelProTag')->with('error_message', 'No file');

}

public function importProductOptionalModel(Request $request){

if ($request->hasFile('file')) {
$extension = File::extension($request->file->getClientOriginalName());
if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
    $path = $request->file->getRealPath();
    $data = Excel::load($path, function ($reader) {})->get();
}

   if(!empty($data) && $data->count()) {
    foreach ($data as $key => $value) {
      // return dd($value);
    $pro = DB::table('products as p')->where('p.pro_code',trim($value->model))->first();
    if(isset($pro) && isset($value->optional_model) && $value->optional_model != null){
        DB::table('product_optional_model')->where('product_id',$pro->pro_id)->delete();
            $arr = [];
            $arr = explode(",",$value->optional_model);
        
            if(count($arr) > 0){
               foreach($arr as $optional_model){
                DB::table('product_optional_model')->insert(
                    [
                        "optional_model" => $optional_model,
                        "product_id" => $pro->pro_id,
                    ]
                );

               }
            }
    }
       
    
  }
}
return redirect()->route('getExcelProTag')->with('flash_message', 'create data Successfully');
}
return redirect()->route('getExcelProTag')->with('error_message', 'No file');

}
   

    public function exports_tags(){
      $products = DB::table('products as p')
      ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
      ->where('pt.local' ,'en')
      ->select('p.*', 'pt.*')
      ->orderBy('pt.showstatus' ,'desc')
      ->orderBy('p.created_at', 'desc')
      ->get();

      if(isset($products)){
        Excel::create('products_tags', function ($excel) use ($products )  {
          $excel->sheet('products_tags', function ($sheet) use ($products) {
            $arr1 = array("Model", "Tags"); 
              $sheet->row(1,$arr1);
              $i = 2;
              foreach ($products as $pro) {
               $tags_all = DB::table('product_tags as t')
                           ->select('t.tag')
                           ->where('t.product_id',$pro->pro_id)
                           ->get()->toArray();
                $output = array_map(function ($object) { return $object->tag; }, $tags_all);
                $string_tags  = implode(', ', $output);
                $sheet->row($i, [
                  $pro->pro_code,
                  $string_tags,
                  ]);
               $i++;
              }
          });
      })->export('csv');
      }
    }
}

?>