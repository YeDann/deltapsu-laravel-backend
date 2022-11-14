<?php

namespace App\Http\Controllers;

use App\OfficeZone;
use Illuminate\Http\Request;
use Validator;
use DB;

class ConfigurableProduct extends Controller
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
        $cproducts = DB::table('cproducts')
        ->where('language','=','en')
        ->select('cproducts.*')
        ->get();

        $language = DB::table('language')->get();

        return view('configurableProduct.index')
        ->with('name','config_products')
        ->with('menu','config_products_model')
        ->with('cproducts',$cproducts)
        ->with('language',$language);
    }
    public function createConfigProduct(){
        $language = DB::table('language')->get();
        
        return view('configurableProduct.create')
        ->with('name','config_products')
        ->with('menu','config_products_model')
        ->with('language',$language);

    }
    public function editConfigProduct($id){
        $language = DB::table('language')->get();

        $cproducts = DB::table('cproducts')
        ->where('translate_id',$id)
        ->select('cproducts.*')
        ->get();
        
        return view('configurableProduct.edit')
        ->with('name','config_products')
        ->with('menu','config_products_model')
        ->with('cproducts',$cproducts)
        ->with('transid',$id)
        ->with('language',$language);

    }
    private function  SaveimageArray($arrayfile ,$arrfilename){
        $arrayfileName = [];
      foreach ($arrfilename as $key => $value) {
              $emptyornot = isset($arrayfile[$value]);
              if($emptyornot){
              $fileName = preg_replace('/\s+/', '', uniqid().$arrayfile[$value]->getClientOriginalName());
              $arrayfile[$value]->move(base_path('/../media/model'),$fileName);
              $arrayfileName[$value] = $fileName;
              }else{
               $fileName = '';
               $arrayfileName[$value] = $fileName;
              }
      }
      return $arrayfileName;
  }
    public function storeConfigProduct(Request $request){
        $productCode = $request->productCode;
        $content = $request->content;
        $filename  = $request->filename;
        $fileimage = $request->fileimage;
        $langloop   = $request->langloop;
       

        $validate = Validator::make($request->all(), [
            'productCode' => 'required',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        } else {

            $arrayfileName = self::SaveimageArray($fileimage ,$filename);
           
            $id = DB::table('cproducts')->insertGetID(
                [
                    'product_code'=>$productCode,
                    'slug'=>$productCode,
                    'description'=>$request->content,
                    'thumb_img'=>$arrayfileName['thumbnail'],
                    'certificate_img'=>$arrayfileName['certificate'],
                    'preview_img'=>$arrayfileName['preview'],
                    'dimensions'=>$request->dimensionL,
                    'dimen_w'=>$request->dimensionW,
                    'dimen_d'=>$request->dimensionD,
                    'weight'=>$request->unitwWeight,
                    'max_power'=>$request->maxPower,
                    'max_slot'=>$request->max_slot,
                    'model'=>$productCode,
                    'panel'=>$request->panel,
                    'frame'=>$request->frame,
                    'status'=>$request->status,
                    'language'=>'en',
                    "time_create" => \Carbon\Carbon::now(),
                    "time_update" => \Carbon\Carbon::now(),
                ]
            );

            DB::table('cproducts')->where('id' ,$id)->update(
                [
                    "translate_id" => $id,
                ]
             );
            
            foreach($langloop as $lang){
                DB::table('cproducts')->insertGetID(
                    [
                        'product_code'=>$productCode,
                        "translate_id" => $id,
                        'slug'=>$productCode,
                        'description'=>$request->content,
                        'thumb_img'=>$arrayfileName['thumbnail'],
                        'certificate_img'=>$arrayfileName['certificate'],
                        'preview_img'=>$arrayfileName['preview'],
                        'dimensions'=>$request->dimensionL,
                        'dimen_w'=>$request->dimensionW,
                        'dimen_d'=>$request->dimensionD,
                        'weight'=>$request->unitwWeight,
                        'max_power'=>$request->maxPower,
                        'max_slot'=>$request->max_slot,
                        'model'=>$productCode,
                        'panel'=>$request->panel,
                        'frame'=>$request->frame,
                        'status'=>$request->status,
                        'language'=> $lang,
                        "time_create" => \Carbon\Carbon::now(),
                        "time_update" => \Carbon\Carbon::now(),
                    ]
                );
            }
            return redirect()->route('configurableProduct')->with('flash_message', 'Create Data successfully');
        }
    }
    private function  updateoldImage($arrayfile , $oldfile ,$arrfilename){
        $arrayfileName = [];
      foreach ($arrfilename as $key => $value) {
              $emptyornot = isset($arrayfile[$value]);
              if($emptyornot){
                $file_pointer = base_path('/../media/model/').$oldfile[$key];
               
                if (file_exists($file_pointer) && $oldfile[$key] != null ) {
                    unlink($file_pointer);
                    $fileName = preg_replace('/\s+/', '', uniqid().$arrayfile[$value]->getClientOriginalName());
                    $arrayfile[$value]->move(base_path('/../media/model'),$fileName);
                    $arrayfileName[$value] = $fileName;
                }else{
                    $fileName = preg_replace('/\s+/', '', uniqid().$arrayfile[$value]->getClientOriginalName());
                    $arrayfile[$value]->move(base_path('/../media/model'),$fileName);
                    $arrayfileName[$value] = $fileName;
                }
              }else{
                $arrayfileName[$value] = $oldfile[$value];     
              } 
      }
      return $arrayfileName;
  }

  public function updateConfigProduct(Request $request){
    $productCode = $request->productCode;
    $content = $request->content;
    $filename  = $request->filename;
    $fileimage = $request->fileimage;
    $langloop   = $request->langloop;
    $tran_id   = $request->tran_id;
    $oldfile   = $request->oldfile;
    // return dd($langloop);

    $validate = Validator::make($request->all(), [
        'productCode' => 'required',
    ]);
    if ($validate->fails()) {
        return redirect()->back()->withErrors($validate->errors());
    } else {

        $arrayfileName = self::updateoldImage($fileimage ,$oldfile  ,$filename);
        // return dd( $arrayfileName);
       
        foreach($langloop as $lang){
            $data = DB::table('cproducts')->where('language',$lang)->where('translate_id', $tran_id)->get();
            if(count($data) > 0){
                DB::table('cproducts')->where('language',$lang)->where('translate_id', $tran_id)->update(
                    [
                        'product_code'=>$productCode[$lang],
                        'slug'=>$productCode[$lang],
                        'description'=>$content[$lang],
                        'thumb_img'=>$arrayfileName['thumbnail'],
                        'certificate_img'=>$arrayfileName['certificate'],
                        'preview_img'=>$arrayfileName['preview'],
                        'dimensions'=>$request->dimensionL,
                        'dimen_w'=>$request->dimensionW,
                        'dimen_d'=>$request->dimensionD,
                        'weight'=>$request->unitwWeight,
                        'max_power'=>$request->maxPower,
                        'max_slot'=>$request->max_slot,
                        'model'=>$productCode[$lang],
                        'panel'=>$request->panel,
                        'frame'=>$request->frame,
                        'status'=>$request->status,
                        "time_update" => \Carbon\Carbon::now(),
                    ]
                );
            }else{
                DB::table('cproducts')->insert(
                    [
                        'product_code'=>$productCode[$lang],
                        'slug'=>$productCode[$lang],
                        'description'=>$content[$lang],
                        'thumb_img'=>$arrayfileName['thumbnail'],
                        'certificate_img'=>$arrayfileName['certificate'],
                        'preview_img'=>$arrayfileName['preview'],
                        'dimensions'=>$request->dimensionL,
                        'dimen_w'=>$request->dimensionW,
                        'dimen_d'=>$request->dimensionD,
                        'weight'=>$request->unitwWeight,
                        'max_power'=>$request->maxPower,
                        'max_slot'=>$request->max_slot,
                        'model'=>$productCode[$lang],
                        'panel'=>$request->panel,
                        'frame'=>$request->frame,
                        'status'=>$request->status,
                        'translate_id' =>$tran_id,
                        "time_update" => \Carbon\Carbon::now(),
                        'language'=>$lang
                    ]
                );
            }
        
        }
        return redirect()->route('configurableProduct')->with('flash_message', 'Update Data successfully');
    }
}
public function deleteConfigProduct(Request $request){
   $itemId = $request->itemId;
   $cproducts = DB::table('cproducts')
   ->where('language','=','en')
   ->where('translate_id',$itemId)
   ->select('cproducts.*')
   ->first();

   $file_pointer1 = base_path('/../medias/categories/').$cproducts->thumb_img;
   $file_pointer2 = base_path('/../medias/categories/').$cproducts->certificate_img;
   $file_pointer3 = base_path('/../medias/categories/').$cproducts->preview_img;         
   if (file_exists($file_pointer1) && $cproducts->thumb_img != null ) {
       unlink($file_pointer1);
   }
   if (file_exists($file_pointer2) && $cproducts->certificate_img != null ) {
    unlink($file_pointer2);
   }
    if (file_exists($file_pointer3) && $cproducts->preview_img != null ) {
        unlink($file_pointer3);
    }
   DB::table('cproducts')->where('translate_id', $itemId)->delete();
   return redirect()->route('configurableProduct')->with('flash_message', 'Delete Data successfully');
}
public  function getHistoryConfig(){

    $con_his = DB::table('configuration_history as ch')
        ->select('ch.*')
        ->whereIn('type_his',[0,3])
        ->orderBy('created_at','desc')
        ->get();

//    DB::table('contacts')->where('email','claire@degitobangkok.com')->delete();
//    DB::table('contacts')->where('email','chai@degitobangkok.com')->delete();

    return view('configurableProduct.historyConfig')
    ->with('name','config_products')
    ->with('menu','config_products_history')
    ->with('con_his' ,$con_his);
}
public  function getEnquiryContact(){

    $con_his = DB::table('configuration_history as ch')
        ->select('ch.*')
        ->where('type_his' ,1)
        ->orderBy('created_at','desc')
        ->get();

    return view('configurableProduct.enquiryContact')
    ->with('name','config_products')
    ->with('menu','enquiryContact')
    ->with('con_his' ,$con_his);
}

public function exportConfigable(){

    $confighistory = DB::table('configuration_history as ch')
    ->select('ch.*')
    ->get();
    $url =  config('app.url').'/config_history/';
    if(isset($subscribes)){
        
        Excel::create('Configuration_history', function ($excel) use ($confighistory ,$url) {
          $excel->sheet('Configuration_history', function ($sheet) use ($confighistory ,$url) {
              $sheet->row(1,[
                  'No',
                  'Subject',
                  'Name',
                  'Email',
                  'Phone',
                  'Company',
                  'City',
                  'Product Type',
                  'Model',
                  'Factory Model',
                  'Customer Model',
                  'Message',
                  'file',
                  'Created_at'
              ]);
              $i = 2;
              $j = 1;
              foreach ($confighistory as $con) {
              
                      $sheet->row($i, [
                          $j,
                          $con->subject,
                          $con->name,
                          $con->email,
                          $con->phone,
                          $con->company,
                          $con->city,
                          $con->product_type,
                          $con->model,
                          $con->factory_model,
                          $con->customer_model,
                          $con->Message,
                          $url.$con->file,
                          $con->created_at
                      ]);
                      $i++;
                      $j++;
              }
          });
      })->export('csv');
      }else{
        return redirect()->route('subscribers_index')->with('flash_message', 'No Data');
      }

}

 public function ParallelCon($id){
    $cproducts = DB::table('cproducts')
    ->where('language','=','en')
    ->where('cproducts.id','=',$id)
    ->select('cproducts.*')
    ->first();
    $Parallels =  DB::table('parallel_connections as pc')
    ->where('pc.model_id','=',$id)
    ->select('pc.*')
    ->get();

     return view('configurableProduct.parallelCon')
     ->with('cproducts',$cproducts)
     ->with('Parallels',$Parallels)
     ->with('name','config_products')
     ->with('menu','config_products_model');
 }
 public function storeParallel(Request $request){
   $model_id = $request->model_id;
   $max_slot = $request->max_slot;
   $arrUsing = $request->use_slot;
   $arrSpaceUsing  = [];

   for($i = 1;$i <= $max_slot;$i++){
       if(in_array($i, $arrUsing)){
        array_push( $arrSpaceUsing ,1);
       }else{
        array_push( $arrSpaceUsing ,0);
       }
   }
   $textspeceusing = implode(",",$arrSpaceUsing);
   $textuse_slot = implode(",",$arrUsing);
   $condition_para  = $request->condition;
   $code  = $request->code;
   $itemId_edit = $request->itemId_edit;
   if($itemId_edit == 0){
        DB::table('parallel_connections')->insert(
            [
                'code'=>$code,
                'model_id'=>$model_id,
                'slot_using'=>$textuse_slot,
                'condition_slot'=>$condition_para,
                'space_using'=>$textspeceusing,
            ]
        );
   }else{
        DB::table('parallel_connections')->where('id',$itemId_edit)->update(
            [
                'code'=>$code,
                'model_id'=>$model_id,
                'slot_using'=>$textuse_slot,
                'condition_slot'=>$condition_para,
                'space_using'=>$textspeceusing,
            ]
        );
   }


    return redirect()->route('ParallelConnection' ,$model_id)->with('flash_message', 'Save Data Success');
 }

 public function deleteParalle(Request $request){
     $itemId = $request->itemId;
     $model_id = $request->model_id;
    DB::table('parallel_connections')->where('id',$itemId)->delete();
    return redirect()->route('ParallelConnection' ,$model_id)->with('flash_message', 'Insert Data Success');
 }

 public function editParallel(Request $request){
    $id = $request->id;
    $Parallels =  DB::table('parallel_connections as pc')
    ->where('pc.id','=',$id)
    ->select('pc.*')
    ->get();
    return response()->json([
        'data' =>$Parallels
            ], 200);
 }
 public function connectorImage($id){
    $connectors = DB::table('connector_image as cm')
    ->select('cm.*')
    ->where('cm.product_id',$id)
    ->get();
    
    return view('configurableProduct.connector_image')
        ->with('name','config_products')
        ->with('menu','connector_image')
        ->with('productId',$id)
        ->with('connectors',$connectors);
 }
 public function create_connectorimage($id){

    return view('configurableProduct.create_connector')
        ->with('name','config_products')
        ->with('productId',$id)
        ->with('menu','connector_image');
 }
 public function edit_connectorimage($pro_id,$id){

        $item = DB::table('connector_image as cm')
        ->select('cm.*')
        ->where('cm.id',$id)
        ->first();


        return view('configurableProduct.edit_connector')
        ->with('name','config_products')
        ->with('item',$item)
        ->with('productId',$pro_id)
        ->with('menu','connector_image');
        }
 public function storeConnectorImage(Request $request){

        $product_id = $request->product_id;
  
        $logoname = '';
        if ($request->hasFile('thumbnail')) {
            $thumbnailImage = $request->file('thumbnail');
            $thumbnailName = uniqid() . "." . $thumbnailImage->getClientOriginalExtension();
            $thumbnailImage->move(base_path('/../upload/thumbs/'), preg_replace('/\s+/', '', $thumbnailName));
            $logoname = $thumbnailName;
        }
       DB::table('connector_image')->insert(
            [
                'code'=>$request->connect_code,
                'image'=>$logoname,
                'value'=>$request->value,
                'product_id'=>$product_id,
            ]
        );

        return redirect()->route('connector_image',$product_id)->with('flash_message', 'Insert Data Success');
 }

 public function updateConnectorImage(Request $request){

                $product_id = $request->product_id;
                $id = $request->old_id;
                $logoname = $request->oldfile;
                if ($request->hasFile('thumbnail')) {
                    $thumbnailImage = $request->file('thumbnail');
                    $thumbnailName = uniqid() . "." . $thumbnailImage->getClientOriginalExtension();
                    $thumbnailImage->move(base_path('/../upload/thumbs/'), preg_replace('/\s+/', '', $thumbnailName));
                    $logoname = $thumbnailName;
                }
            
                DB::table('connector_image')->where('id',$id)->update(
                    [
                        'code'=>$request->connect_code,
                        'image'=>$logoname,
                        'value'=>$request->value,
                        'product_id'=>$product_id,
                     ]
               );

                return redirect()->route('connector_image',$product_id)->with('flash_message', 'Update Data Success');
}

public function deleteConnectorImage(Request $request){
    $id = $request->itemId;
    $product_id = $request->product_id;
    DB::table('connector_image')->where('id',$id)->delete();
    return redirect()->route('connector_image',$product_id)->with('flash_message', 'Delete Data Success');
}


}
?>