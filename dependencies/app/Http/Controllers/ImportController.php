<?php

namespace App\Http\Controllers;

use App;
use DB;
use Illuminate\Http\Request;
use Validator;
use File;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Excel as ExcelFormat;
use Illuminate\Support\Facades\Hash;
class ImportController extends Controller
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
    public function importExel(Request $request){
     $fieldid = $request->fieldid;
    //  DB::table('product_has_property')->where('type_id',$fieldid)->delete();
    //   return dd('delete Old data');
     $language = DB::table('language')->get();
     $pd_field = DB::table('product_field as pf')->where('pf.id',$fieldid)->first();
    //  return dd($pd_field->type);
      if ($request->hasFile('file')) {
        $extension = File::extension($request->file->getClientOriginalName());
        if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
            $path = $request->file->getRealPath();
            $data = Excel::load($path, function ($reader) {})->get();
            $arrpro  = [];
            $arrempty = [];
            $checkduplicate = [];
            if (!empty($data) && $data->count()) {
              // return dd($data);
              foreach ($data as $key => $value) {
               $pro =  DB::table('products')->where('pro_code',trim($value->model_name))->get();
               if(count($pro) > 0 ){
                 if($pd_field->type == 'number'){
                  $ph_pro = DB::table('product_has_property as php')->where('php.product_id',$pro[0]->pro_id)->where('php.type_id',$fieldid)->get();
                  $find = false;
                  $item = 0;
                  foreach($checkduplicate as $che) {
                      if ($che->modelname == trim($value->model_name)) {
                          $find = true;
                          $item = $che->value;
                          break;
                      }
                  }

                  // return dd($checkduplicate);
                if($find){
                  $object = (object) [
                    'modelname' => trim($value->model_name),
                    'value' => ($item+1),
                  ];
                  array_push($checkduplicate ,$object);
                 }else{
                  $object = (object) [
                    'modelname' => trim($value->model_name),
                    'value' => 1,
                  ];
                  array_push($checkduplicate ,$object);
                 }

                  if(isset($ph_pro) && count($ph_pro) > 0){

                  }else{
                    (int)$typical = substr($value->typical_output_power,0,-1);
                    $pro_id_perty = DB::table('product_has_property')->insertGetID(
                      [
                          'product_id'=> $pro[0]->pro_id,
                          'type_id'=> $fieldid,
                          'type_value'=>'number',
                          'status_input'=>1,
                          'data_1'=>(int)$typical,
                      ]
                  );

                  foreach($language as $lang){
                    $products_translation = DB::table('product_has_property_translation')->insert(
                        [
                            "per_fk_id" => $pro_id_perty,
                            "product_id" => $pro[0]->pro_id,
                            "local" => $lang->name,
                        ]
                    );
                  }

                }
                }else{

                 }
                  array_push($arrpro,$pro[0]->pro_code);
               }else{
                 $object = (object) [
                  'modelname' =>$value->model_name,
                  'value' => substr($value->typical_output_power,0,-1),
                ];
                array_push($arrempty,$object);
               }
            }
          }
          // return dd($arrempty);
          if(isset($arrempty)){
            Excel::create('Data_productNotfind', function ($excel) use ($arrempty) {
              $excel->sheet('Data_productNotfind', function ($sheet) use ($arrempty) {
                  $sheet->row(1,[
                      'modelName',
                      'Typical Output Power',
                  ]);
                  $i = 2;
                  foreach ($arrempty as $model) {
                          $sheet->row($i, [
                              $model->modelname,
                              $model->value
                          ]);
                          $i++;
                  }
              });
          })->export('csv');
          }
        }
      }

    }
    public function getExcelProduct(){
      $pd_field = DB::table('product_field as pf')
      ->join('product_field_translation as pft', 'pf.id', '=', 'pft.product_field_id')
      ->join('section as st', 'pf.section_id', '=', 'st.id')
      ->join('section_translation as stt', 'st.id', '=', 'stt.section_id')
      ->where('pft.local', '=', 'en')
      ->where('stt.local', '=', 'en')
      ->select('pf.id as pd_field_id', 'pf.type', 'pf.created_at', 'pft.field_name', 'pft.local as pft_local', 'st.id as section_id', 'stt.name as section_name')
      ->orderBy('pf.created_at', 'desc')
      ->get();

      return view('product.importExel')
      ->with('pd_field', $pd_field)
      ->with('menu', "products")
      ->with('name', "product");
    }
   public function getExportProduct()
    {
        $products = DB::table('products as p')
            ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
            ->where('pt.local', 'en')
            ->select('p.*', 'pt.*')
            ->orderBy('pt.showstatus', 'desc')
            ->orderBy('p.created_at', 'desc')
            ->get();

        $doc_cate = DB::table('products_documents_categories as doc_cate')
            ->orderBy('doc_cate.title', 'asc')
            ->pluck('doc_cate.title')
            ->toArray();

        $arrNotfound = [];

        if (isset($products)) {
            // สร้าง array สำหรับ export
            $exportData = [];

            // Headers
            $arr1 = [
                "pro_code",
                "pro_categories 1",
                "pro_categories 2",
                "series",
                "dimensionL",
                "dimensionW",
                "dimensionD",
                "unit_weight",
                "Status",
                "Show ManaulPage",
                'Highlights & Features',
                "Industrial Power",
                "Medical Power",
                "Lighting & Signage"
            ];
            $firstColum = array_merge($arr1, $doc_cate);
            $exportData[] = $firstColum;

            // Data rows
            foreach ($products as $pro) {
                $subCategories = DB::table('sub_pro_categories as sc')
                    ->join('sub_pro_categories_translation as sct', 'sct.sub_pro_id', '=', 'sc.sub_pro_id')
                    ->where('sc.sub_pro_id', $pro->pro_categories_id)
                    ->select('sc.*', 'sct.*')
                    ->where('sct.local', 'en')
                    ->orderBy('sc.created_at', 'desc')
                    ->get();

                $series = DB::table('series_translations')
                    ->where('series_id', '=', $pro->series_id)
                    ->where('local', 'en')
                    ->get();

                if (count($subCategories) == 0) {
                    array_push($arrNotfound, $pro->pro_categories_id);
                }

                // Certificate checks
                $cer1 = DB::table('certificate_product as c')
                    ->where('c.product_id', $pro->pro_id)
                    ->where('c.certificate_id', 1)
                    ->exists();

                $cer2 = DB::table('certificate_product as c')
                    ->where('c.product_id', $pro->pro_id)
                    ->where('c.certificate_id', 2)
                    ->exists();

                $cer3 = DB::table('certificate_product as c')
                    ->where('c.product_id', $pro->pro_id)
                    ->where('c.certificate_id', 3)
                    ->exists();

                $arrcon2 = [];
                array_push($arrcon2, $cer1 ? 'Y' : 'N');
                array_push($arrcon2, $cer2 ? 'Y' : 'N');
                array_push($arrcon2, $cer3 ? 'Y' : 'N');

                $procategories = DB::table('product_has_categories as pc')
                    ->leftjoin('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'pc.categories_id')
                    ->where('spt.local', 'en')
                    ->where('pc.product_id', $pro->pro_id)
                    ->select('spt.name')
                    ->get();

                $arrcon1 = [
                    $pro->pro_code,
                    isset($procategories[0]->name) && count($procategories) > 0 ? $procategories[0]->name : '',
                    isset($procategories[1]->name) && count($procategories) == 2 ? $procategories[1]->name : '',
                    isset($series[0]->title) ? $series[0]->title : '',
                    $pro->dimensionL,
                    $pro->dimensionW,
                    $pro->dimensionD,
                    $pro->unit_weight,
                    $pro->enable_pro == 1 ? 'Yes' : 'No',
                    $pro->manaul_page == 1 ? 'Yes' : 'No',
                    strip_tags($pro->content_1),
                ];

                $documents = self::getProductDocument($doc_cate, $pro->pro_id);
                $collection = array_merge($arrcon2, $documents);
                $arrcon1 = array_merge($arrcon1, $collection);

                $exportData[] = $arrcon1;
            }

        // Export using new Laravel Excel syntax
        return Excel::download(
        new class($exportData) implements FromArray {
        protected $data;

        public function __construct(array $data) {
            $this->data = $data;
        }

        public function array(): array {
            return $this->data;
        }

        // ✅ UTF-8 BOM settings for Excel
        public function getCsvSettings(): array
                {
                    return [
                        'use_bom' => true,
                         'encoding' => 'UTF-16LE',
                        'delimiter' => ',',
                    ];
                }
            },
            'products.csv',
            ExcelFormat::CSV,
            [
                'use_bom' => true,  // must have for Excel in Windows
                 'encoding' => 'UTF-16LE',
             ]
           );
        }
    }

   public function getExportProductImage()
    {
        $products = DB::table('products as p')
            ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
            ->where('pt.local', 'en')
            ->select('p.*', 'pt.*')
            ->orderBy('pt.showstatus', 'desc')
            ->orderBy('p.created_at', 'desc')
            ->get();

        $arrNotfound = [];

        if (isset($products)) {
            // สร้าง array สำหรับ export
            $exportData = [];

            // Headers
            $headers = ["No", "pro_code", "thumbnail"];
            $exportData[] = $headers;

            // Data rows
            $i = 1;
            foreach ($products as $pro) {
                $arrcon1 = [
                    $i,
                    $pro->pro_code,
                    $pro->picture ? 'https://deltapsu.com/upload/thumbs/' . $pro->picture : 'No thumbnail',
                ];

                $exportData[] = $arrcon1;
                $i++;
            }

            // Export using new Laravel Excel syntax
            return Excel::download(new class($exportData) implements FromArray {
                protected $data;

                public function __construct(array $data)
                {
                    $this->data = $data;
                }

                public function array(): array
                {
                    return $this->data;
                }
                public function getCsvSettings(): array
                {
                    return [
                        'use_bom' => true,
                         'encoding' => 'UTF-16LE',
                        'delimiter' => ',',
                    ];
                }
            },
            'products_images.csv',
             ExcelFormat::CSV,
            [
                'use_bom' => true,  // must have for Excel in Windows
                 'encoding' => 'UTF-16LE',
            ]
          );
        }
    }

    function getExportProductSpecification(){
      $fileName = 'product_specifications.xlsx';

      $lang = App::getLocale();

      $products = DB::table('products as p')
      ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
      ->where('pt.local' ,'en')
      ->select('p.*', 'pt.*')
      ->orderBy('pt.showstatus' ,'desc')
      ->orderBy('p.created_at', 'desc')
      ->get();

      $section = DB::table('section as st')
                ->join('section_translation as stt','st.id','=','stt.section_id')
                ->where('stt.local',$lang)
                // ->where('st.status', 1)
                ->select('st.id', 'stt.sortname','stt.name')
                ->get();

      $sectionData = ["Product"];
      $productData = [];
      for($i = 0; $i < count($products); $i++) {
        // echo $i ,"." , $products[$i]->pro_code, "</br>";
        array_push($productData, $products[$i]->pro_code);
        $product_has_property = DB::table('product_has_property as ph')
        ->join('product_has_property_translation as pht','ph.per_id' ,'=','pht.per_fk_id')
        ->join('product_field as pf','pf.id' ,'=','ph.type_id')
        ->join('product_field_translation as pft','ph.type_id' ,'=','pft.product_field_id')
        ->where('pht.local' ,'en')
        ->where('pft.local' ,$lang)
        ->where('ph.product_id',$products[$i]->pro_id)
        ->where('ph.type_id','!=',115)
        ->orderBy('ph.type_id' ,'asc')
        ->select('pht.value_text','ph.*','pf.section_id' ,'pft.field_name as fieldCate','pf.unit_name')
        ->get();
        for($sec = 0 ; $sec < count($section); $sec++){
          foreach ($product_has_property as $prh) {
            if($prh->section_id == $section[$sec]->id) {
              $strig = '-';
              $numberText = '';
              $numberarr = [];
              $check = false;
              if($prh->type_value == 'number'){
                if($prh->status_input == 3){
                  if(!is_null($prh->data_1)){
                    $numberText = $prh->data_1.'-'.$prh->data_2.$prh->unit_name;
                    $check = true;
                    // echo $numberText. "\n";
                  }else {
                    $numberText = '-';
                  }
                } else {
                  $arr_data = [];
                  $datacheck = [
                    $prh->data_1,
                    $prh->data_2,
                    $prh->data_3,
                    $prh->data_4,
                    $prh->data_5,
                    $prh->data_6,
                    $prh->data_7,
                    $prh->data_8,
                    $prh->data_10,
                    $prh->data_11,
                    $prh->data_12,
                  ];
                  foreach ($datacheck as $dch) {
                    if (!is_null($dch)) {
                      array_push($arr_data, $dch . $prh->unit_name);
                      // return dd($arr_data);
                    }
                  }
                  if (isset($arr_data) && count($arr_data) > 0) {
                    $check = true;
                    $numberarr = $arr_data;
                  }
                }
              } else {
                if($prh->value_text != null && $prh->value_text != 'null'){
                    $check = true;
                    $strig = $prh->value_text;
                }
               }

              //  echo $prh->fieldCate . "\n";
              if($i == 0){
                array_push($sectionData, $prh->fieldCate);
              }
               if($prh->type_value == 'number'){
                if($prh->status_input == 3){
                  array_push($productData, $numberText);
                  // echo $numberText. "\n";
                } else {
                  array_push($productData, join(",",$numberarr));
                  // echo join(",",$numberarr);
                }
              } else {
                array_push($productData, $strig);
                // echo $strig."\n";
              }
            }
          }
        }
        array_push($productData, ".");
      }
      // return dd($sectionData, $productData);
      Excel::create('Product_Specification', function ($excel) use ($sectionData, $productData) {
        $excel->sheet('Product_Specification', function ($sheet) use ($sectionData, $productData) {
          // จำนวนคอลัมน์ต่อแถว
        $columnsPerRow = 134;

        // สร้างฟังก์ชันเพื่อตรวจสอบและแยกแถวถ้าพบจุด
        function splitRowsOnDot($data, $columnsPerRow) {
            $result = [];
            $currentRow = [];

            foreach ($data as $item) {
                if ($item === '.') {
                    // ถ้ามีจุดให้เพิ่มแถวใหม่
                    if (!empty($currentRow)) {
                        $result[] = $currentRow;
                        $currentRow = [];
                    }
                } else {
                    // เพิ่ม item ในแถวปัจจุบัน
                    $currentRow[] = $item;

                    // ถ้าคอลัมน์ครบตามที่กำหนดให้เพิ่มแถวใหม่
                    if (count($currentRow) == $columnsPerRow) {
                        $result[] = $currentRow;
                        $currentRow = [];
                    }
                }
            }

            // เพิ่มแถวสุดท้ายถ้ามีข้อมูลเหลือ
            if (!empty($currentRow)) {
                $result[] = $currentRow;
            }

            return $result;
        }

        // สร้างแถวแรกด้วย sectionData
        $sectionDataRows = splitRowsOnDot($sectionData, $columnsPerRow);
        $i = 1; // แถวเริ่มต้นสำหรับ sectionData

        foreach ($sectionDataRows as $row) {
            $sheet->row($i, $row);
            $i++;
        }

        // สร้างแถวสำหรับ productData
        $productDataRows = splitRowsOnDot($productData, $columnsPerRow);

        foreach ($productDataRows as $row) {
            $sheet->row($i, $row);
            $i++;
        }
        });
      })->export('csv');

      // foreach($sectionData as $data){
      //   echo $data;
      // }
      // foreach($productData as $product){
      //   echo $product;
      // }
    }

    function getProductDocument($cates ,$pro_id){
      $appUrl = config('app.url');
      $arr_doc = [];
      foreach ($cates as $cate) {
        $documents = DB::table('product_has_documents as phd')
          ->join('products as p','p.pro_id','=','phd.product_id')
          ->join('product_ducuments as pd','phd.document_id','=','pd.doc_id')
          ->join('product_ducument_translations as pdt','pdt.doc_fk_id','=','pd.doc_id')
          ->join('products_documents_categories as pdc','pdc.id','=','pd.cate_id')
          ->join('pro_ducuments_cate_translations as pdct','pdct.doc_cate_id','=','pdc.id')
          ->where('pdt.local','en')
          ->where('pdct.local','en')
          ->where('pdt.file','!=','')
          ->where('pdt.file','!=',null)
          ->where('pdc.title',$cate)
          ->where('p.pro_id',$pro_id)
          ->select('p.pro_code','pd.doc_id','phd.product_id','pdct.lable' ,'pdc.slug' ,'pdt.name','pdc.title as catename','pd.created_at' ,'pdc.main_cate_id','pdt.file' ,'pd.cate_id')
          ->orderBy('pdc.title','asc')
          ->first();
          if(isset($documents)){
            array_push($arr_doc,$appUrl.'/products/download/'.$documents->slug.'/'.$documents->pro_code);
          }else{
            array_push($arr_doc, '');
          }
      }
    // return dd($arr_doc,$cates);
      return $arr_doc;
    }
    public function getExportProductProperty(){

      $product_fields = DB::table('product_field as pf')
      ->join('product_field_translation as pft', 'pf.id', '=', 'pft.product_field_id')
      ->join('section as st', 'pf.section_id', '=', 'st.id')
      ->join('section_translation as stt', 'st.id', '=', 'stt.section_id')
      ->where('pft.local', '=', 'en')
      ->where('stt.local', '=', 'en')
      ->select('pf.id as pd_field_id','pf.unit_name' ,'pf.type', 'pf.created_at', 'pft.field_name', 'pft.local as pft_local', 'st.id as section_id', 'stt.name as section_name')
      ->orderBy('pf.id' ,'asc')
      ->get();

      $products = DB::table('products as p')
      ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
      ->where('pt.local' ,'en')
      ->where('p.pro_id',670)
      ->select('p.*', 'pt.*')
      ->orderBy('pt.showstatus' ,'desc')
      ->orderBy('p.created_at', 'desc')
      ->get();

      $columArray = ["product_code"];
      foreach ($product_fields as $pop) {
      //
       $data = $pop->pd_field_id.",".$pop->field_name.",".$pop->type.",".$pop->unit_name;
       array_push($columArray,$data);
      }
      // return dd($columArray);
      if(isset($product_fields)){

        Excel::create('product_fields', function ($excel) use ($products ,$product_fields ,$columArray)  {
          $excel->sheet('product_fields', function ($sheet) use ($products ,$product_fields,$columArray) {
            $arr1 = $columArray;
              $sheet->row(1,$arr1);
              $i = 2;
              foreach ($products as $pro) {


                 $arraysub = DB::table('product_has_property as ph')
                ->join('product_has_property_translation as pht','ph.per_id' ,'=','pht.per_fk_id')
                ->join('product_field as pf','pf.id' ,'=','ph.type_id')
                ->join('product_field_translation as pft','ph.type_id' ,'=','pft.product_field_id')
                ->where('ph.product_id',$pro->pro_id)
                ->where('pht.local' ,'en')
                ->where('pft.local' ,'en')
                ->orderBy('pf.id' ,'asc')
                ->select('pht.value_text','ph.*' ,'pft.field_name as fieldCate','pf.unit_name')
                ->get();

                $arrcon2 = [];
                foreach($arraysub as $sub){
                  if($sub->type_value == 'number'){
                    array_push($arrcon2,$sub->data_1.','.$sub->data_2.','.$sub->data_3.','.$sub->data_4.','.$sub->data_5);
                  }else{
                    array_push($arrcon2,$sub->value_text);
                  }
                }

                $arrcon1  =  [
                  $pro->pro_code,
                ];

                $arrconmer = array_merge($arrcon1, $arrcon2);
                      $sheet->row($i,$arrconmer);
                      $i++;
              }
          });
      })->export('csv');
      }
    }
    // public function getExportOldProduct(){

    //   $products = DB::table('old_products as op')
    //   ->where('op.language' ,'en')
    //   ->select('op.*')
    //   ->get();

    //   $arrNotfound = [];
    //   if(isset($products)){

    //     Excel::create('products', function ($excel) use ($products ,$arrNotfound)  {
    //       $excel->sheet('products', function ($sheet) use ($products,$arrNotfound) {
    //         $arr1 = array("pro_code", "content_en", "content_cn","content_de", "content_ru" ,"content_tw" );

    //           $sheet->row(1,$arr1);
    //           $i = 2;
    //           foreach ($products as $pro) {
    //             $arrcon1  =  [
    //               $pro->product_code,
    //             ];

    //             $arrcon2 = [];

    //             $trandata = DB::table('old_products as op')
    //             ->where('op.translate_id',$pro->id)
    //             ->select('op.*')
    //             ->get();

    //             foreach($trandata as $tran){
    //              array_push($arrcon2,$tran->description);
    //             }

    //             $arrcon1 = array_merge($arrcon1, $arrcon2);
    //                   $sheet->row($i,$arrcon1);
    //                   $i++;
    //           }
    //       });
    //   })->export('csv');
    //   }

    // }
    public function getExcelProductCerti(){
       return view('product.importfileCerti')
       ->with('menu', "products")
       ->with('name', "product");

    }
    public function importCertificate(Request $request){

      if ($request->hasFile('file')) {
        $extension = File::extension($request->file->getClientOriginalName());
        if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
            $path = $request->file->getRealPath();
            $data = Excel::load($path, function ($reader) {})->get();
        }

           if(!empty($data) && $data->count()) {
            foreach ($data as $key => $value) {
              // return dd($value->LightingSignage);
                $pro = DB::table('products as p')->where('p.pro_code',trim($value->product_code))->first();
                // if(isset($pro) &&  $pro->pro_id == 145 && $value->lighting == "Y" ){
                //      return dd($value->lighting == "Y");
                // }
                if(isset($pro)){
                  if($value->industrial == "Y"){
                    DB::table('certificate_product')->insert(
                      [
                          "product_id" => $pro->pro_id,
                          "certificate_id" => 1,
                      ]
                    );
                   }
                 if($value->medical == "Y"){
                  DB::table('certificate_product')->insert(
                    [
                        "product_id" => $pro->pro_id,
                        "certificate_id" => 2,
                    ]
                  );
                 }
                 if($value->lighting == "Y"){
                  DB::table('certificate_product')->insert(
                    [
                        "product_id" => $pro->pro_id,
                        "certificate_id" => 3,
                    ]
                  );
                 }

                }


          }
        }
        return redirect()->route('products.index')->with('flash_message', 'create data Successfully');
      }
      return redirect()->route('products.index')->with('error_message', 'No file');

  }


  public function importProdoctCate(Request $request){

    if ($request->hasFile('file')) {

      $extension = File::extension($request->file->getClientOriginalName());
      if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
          $path = $request->file->getRealPath();
          $data = Excel::load($path, function ($reader) {})->get();
      }

         if(!empty($data) && $data->count()) {
          foreach ($data as $key => $value) {

              $pro = DB::table('products as p')->where('p.pro_code',trim($value->product_code))->first();
              $procate1 = DB::table('sub_pro_categories as s')
              ->join('sub_pro_categories_translation as sub','s.sub_pro_id' ,'=','sub.sub_pro_id')
              ->where('sub.local','en')->where('s.slug', preg_replace('/\s+/', '', $value->package_type_1))->first();
              $procate2 = DB::table('sub_pro_categories as s')
              ->join('sub_pro_categories_translation as sub','s.sub_pro_id' ,'=','sub.sub_pro_id')
              ->where('sub.local','en')->where('s.slug', preg_replace('/\s+/', '', $value->package_type_2))->first();
              // if(isset($pro->pro_code) &&  $pro->pro_code =='PMT-30V100W2BA'){
              //   return dd(isset($procate2));
              // }

              if(isset($pro)){
                  if(isset($procate1)){
                    DB::table('product_has_categories')->insert(
                      [
                          "categories_id" => $procate1->sub_pro_id,
                          "product_id" =>$pro->pro_id,
                      ]
                    );
                  }
                  if(isset($procate2)){
                    DB::table('product_has_categories')->insert(
                      [
                          "categories_id" => $procate2->sub_pro_id,
                          "product_id" =>$pro->pro_id,
                      ]
                    );
                  }
              }




        }
      }
      return redirect()->route('products.index')->with('flash_message', 'create data Successfully');
    }
    return redirect()->route('products.index')->with('error_message', 'No file');

}


public function importStatusProduct(Request $request){

  if ($request->hasFile('file')) {

    $extension = File::extension($request->file->getClientOriginalName());
    if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
        $path = $request->file->getRealPath();
        $data = Excel::load($path, function ($reader) {})->get();
    }

       if(!empty($data) && $data->count()) {
        foreach ($data as $key => $value) {
            $pro = DB::table('products as p')->where('p.pro_code',trim($value->product_code))->first();
            // return dd($value->status);
            if(isset($pro)){
              DB::table('products')->where('pro_id',$pro->pro_id)->update(
                [
                    'enable_pro'=>$value->status == 'Show'? 1:0,
                ]
              );
            }
      }
    }
    return redirect()->route('products.index')->with('flash_message', 'create data Successfully');
  }
  return redirect()->route('products.index')->with('error_message', 'No file');

}


// public function importSuccessStory(Request $request){

//   if ($request->hasFile('file')) {

//     $extension = File::extension($request->file->getClientOriginalName());
//     if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
//         $path = $request->file->getRealPath();
//         $data = Excel::load($path, function ($reader) {})->get();
//     }
//     // return dd($data);
//        $arr_chek = [];
//        if(!empty($data) && $data->count()) {
//         foreach ($data as $key => $value) {

//           $old_userfound = DB::table('old_users')
//           ->where('username', '=', trim($value->username))
//           ->get();

//           if(count($old_userfound) == 0){
//            array_push($value->username, $arr_chek);
//             }else{
//               if(trim($value->partner_role) == 'Distributor'){
//                 $role = 1;
//               }else if(trim($value->partner_role) == 'FES'){
//                 $role = 2;
//               }
//                 DB::table('partner')->insert([
//                   'old_user_id' => $old_userfound[0]->id,
//                   'firstname' => $old_userfound[0]->first_name,
//                   'lastname' => $old_userfound[0]->last_name,
//                   'position' => $old_userfound[0]->position,
//                   'companyName' => $old_userfound[0]->company,
//                   'phone' => $old_userfound[0]->phone,
//                   'fax' => $old_userfound[0]->fax,
//                   'role' => $role,
//                   'email' => $old_userfound[0]->email,
//                   'password' => Hash::make(12345678),
//                   "created_at" => \Carbon\Carbon::now(),
//                   "updated_at" => \Carbon\Carbon::now(),
//               ]);
//             }
//          }


//     }
//     return dd($arr_chek);
//     return redirect()->route('successStory')->with('flash_message', 'create data Successfully');
//   }
//   return redirect()->route('successStory')->with('error_message', 'No file');

// }


// public function getOldDataSuccess(){
//   $contents = DB::table('old_contents')
//   ->where('type', '=', 'success-story')
//   ->orderBy('translate_id', 'asc')
//   ->orderBy('id', 'asc')
//   ->where('language','en')
//   ->get();

//   // return dd($contents);
//   foreach($contents as $story){
//           $partner = DB::table('partner')
//           ->where('old_user_id',$story->user_id)
//           ->get();

//         DB::table('success_storys')->insert(
//           [
//               'modelname' =>  $story->description,
//               'application' => $story->title,
//               'endCustomer' => $story->ext_3,
//               'message' => $story->content,
//               'user_id'=> isset($partner[0]->id)?$partner[0]->id:0,
//               'country' => $story->ext_6,
//               'status' => 1,
//               "updated_at" => $story->updated_at,
//               "created_at" => $story->created_at,
//           ]
//       );
//   }
//   return redirect()->route('successStory')->with('flash_message', 'GET data Successfully');
// }
public  function getpageSubscriber(){

  return view('importExcel.importExelSubscriber')
  ->with('name','subscribe')
  ->with('menu','');
}
public function importSubscriber(Request $request){
  if ($request->hasFile('file')) {

    $extension = File::extension($request->file->getClientOriginalName());
    if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
        $path = $request->file->getRealPath();
        $data = Excel::load($path, function ($reader) {})->get();
    }


       if(!empty($data) && $data->count()) {
        foreach ($data as $key => $value) {
          // return dd($value);
          if($value->marketing_permissions == '' && $value->marketing_permissions == null ){
            $accept = 0;
          }else{
            $accept = 1;
          }
          DB::table('subscribes')->insert(
            [
                "country_name" => $value->country,
                "email" => $value->email_address,
                "name" => $value->name,
                "accept" => $accept,
                "created_at" => \Carbon\Carbon::now(),
            ]
            );
        }
    }
    return redirect()->route('getpageSubscriber')->with('flash_message', 'create data Successfully');
  }
  return redirect()->route('getpageSubscriber')->with('error_message', 'No file');

}

private function checkHaveModel($strmodel){
  $stringModel =  str_replace("-", "", $strmodel);
  $queryStringModel = preg_replace('/[^A-Za-z0-9\-]/','',$stringModel);
  $queryModel = DB::table('products as p')
  ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
  ->select('p.*','phc.categories_id')
  ->where('p.enable_pro',1);

  $queryModel->where(\DB::raw("REPLACE(REPLACE(REPLACE(p.pro_code, '-', ''), '/', ''),' ','')"), 'LIKE', '%' . $queryStringModel . '%');
  $_model = $queryModel->first();

return $_model;
}
private function checkHaveModelOptional($strmodel){
  $stringModel =  str_replace("-", "", $strmodel);
  $queryStringModel = preg_replace('/[^A-Za-z0-9\-]/','',$stringModel);
  $queryModelOP = DB::table('product_optional_model as po')
  ->join('products as p', 'p.pro_id', '=', 'po.product_id')
  ->select('p.pro_code','po.optional_model');
  $queryModelOP->where(\DB::raw("REPLACE(REPLACE(REPLACE(po.optional_model, '-', ''), '/', ''),' ','')"), 'LIKE', '%' . $queryStringModel . '%');
  $_modelOptional = $queryModelOP->first();

return $_modelOptional;
}

public function checkLang($lang ,$id){
  $returnlang = 'en';
     $hidelangPro = DB::table('products_translation as pt')
     ->where('pt.product_id',$id)
     ->where('pt.local' ,$lang)
     ->where('pt.showstatus',1)
     ->first();

     if(isset($hidelangPro)){
          return $lang;
     }else{
         return $returnlang;
     }
}



}




?>
