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


}
?>