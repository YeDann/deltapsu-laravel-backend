<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Validator;

class DucumentController extends Controller
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

        $userdata = auth()->user();
        if($userdata->lang == 'All'){
            $pro_has_doc = DB::table('product_ducuments as pd')
            ->join('product_ducument_translations as pdct', 'pd.doc_id', '=', 'pdct.doc_fk_id')
            ->join('products_documents_categories as pro_cate', 'pro_cate.id', '=', 'pd.cate_id')
            ->select('pd.*', 'pdct.*' ,'pro_cate.title')
            ->where('pdct.local', '=', 'en')
            ->orderBy('pd.created_at', 'asc')
            ->get();



        }else{
            $pro_has_doc = DB::table('product_ducuments as pd')
            ->join('product_ducument_translations as pdct', 'pd.doc_id', '=', 'pdct.doc_fk_id')
            ->join('products_documents_categories as pro_cate', 'pro_cate.id', '=', 'pd.cate_id')
            ->select('pd.*', 'pdct.*' ,'pro_cate.title')
            ->where('pdct.local',$userdata->lang)
            ->orderBy('pd.doc_id', 'asc')
            ->get();
        }
        $data = [];
        $i = 0;
        // return dd($pro_has_doc[0]);
       foreach($pro_has_doc as $doc){
           $prohas = [];
           $prohas = DB::table('product_has_documents as phd')
           ->join('products as p','p.pro_id' ,'=','phd.product_id')
           ->select('p.pro_code')
           ->where('phd.document_id',$doc->doc_id)
           ->get();
        //    return dd($prohas);
           $data[$i] = [
               "doc_id"=>$doc->doc_id,
               "doc_type"=>$doc->title,
               "doc_name"=>$doc->name,
               "file"=>$doc->file,
               "prohas"=>$prohas,
               "updated_at"=>$doc->updated_at,
               "created_at"=>$doc->created_at,
           ];
           $i++;
       }
       $categories = DB::table('products_documents_categories')
        ->join('pro_ducuments_cate_translations as pdct', 'products_documents_categories.id', '=', 'pdct.doc_cate_id')
        ->where('pdct.local', '=', 'en')
        ->select('products_documents_categories.*', 'pdct.*')
        ->orderBy('products_documents_categories.created_at', 'desc')
        ->get();




        return view('product_doc.index')
            ->with('name', 'product_doc')
            ->with('menu', 'muti_doc')
            ->with('docPros', $data)
            ->with('selecValue', 'all')
            ->with('categories', $categories)
            ->with('pro_has_doc', $pro_has_doc);
    }
    public function docFilerBy($value){

        $userdata = auth()->user();
        if($userdata->lang == 'All'){
            $pro_has_doc = DB::table('product_ducuments as pd')
            ->join('product_ducument_translations as pdct', 'pd.doc_id', '=', 'pdct.doc_fk_id')
            ->join('products_documents_categories as pro_cate', 'pro_cate.id', '=', 'pd.cate_id')
            ->select('pd.*' , 'pdct.*' ,'pro_cate.title')
            ->where('pdct.local', '=', 'en')
            ->where('pro_cate.id', '=',$value)
            ->orderBy('pd.created_at', 'desc')
            ->get();

        }else{
            $pro_has_doc = DB::table('product_ducuments as pd')
            ->join('product_ducument_translations as pdct', 'pd.doc_id', '=', 'pdct.doc_fk_id')
            ->join('products_documents_categories as pro_cate', 'pro_cate.id', '=', 'pd.cate_id')
            ->select('pd.*', 'pdct.*' ,'pro_cate.title')
            ->where('pdct.local',$userdata->lang)
            ->where('pro_cate.id', '=',$value)
            ->orderBy('pd.created_at', 'desc')
            ->get();
        }
        $data = [];
        $i = 0;
       foreach($pro_has_doc as $doc){
           $prohas = [];
           $prohas = DB::table('product_has_documents as phd')
           ->join('products as p','p.pro_id' ,'=','phd.product_id')
           ->select('p.pro_code')
           ->where('phd.document_id',$doc->doc_id)
           ->get();

           $data[$i] = [
               "doc_id"=>$doc->doc_id,
               "doc_type"=>$doc->title,
               "doc_name"=>$doc->name,
               "file"=>$doc->file,
               "prohas"=>$prohas,
               "updated_at"=>$doc->updated_at,
               "created_at"=>$doc->created_at,
           ];
           $i++;
       }

       $categories = DB::table('products_documents_categories')
        ->join('pro_ducuments_cate_translations as pdct', 'products_documents_categories.id', '=', 'pdct.doc_cate_id')
        ->where('pdct.local', '=', 'en')
        ->select('products_documents_categories.*', 'pdct.*')
        ->orderBy('products_documents_categories.created_at', 'desc')
        ->get();

        return view('product_doc.index')
            ->with('name', 'product_doc')
            ->with('menu', 'muti_doc')
            ->with('docPros', $data)
            ->with('selecValue', $value)
            ->with('categories', $categories)
            ->with('pro_has_doc', $pro_has_doc);

    }
    public function SpecialLang(){
        $secial_langs = DB::table('other_lang_document as old')
        ->select('old.*')
        ->get();

        return view('product_doc.special_lang')
        ->with('secial_langs',$secial_langs)
        ->with('name', 'product_doc')
        ->with('menu', 'secial_lang');
    }
    public function Update_spelang(Request $request){
        $id = $request->langId;
        // return dd($id);
      DB::table('other_lang_document')->where('id',$id)->update(
            [
                'name'=>$request->langName,
                'full_name'=>$request->full_name,
            ]
        );
        return redirect()->route('SpecialLang')->with('flash_message', 'Update Data successfully');
    }
    public function store_spelang(Request $request){
        DB::table('other_lang_document')->insert(
              [
                  'name'=>$request->langName,
                  'full_name'=>$request->full_name,
              ]
          );
          return redirect()->route('SpecialLang')->with('flash_message', 'Insert Data successfully');
      }
      public function deleteSpecailLang(Request $request){
          $id = $request->itemId;
          $itemName = $request->itemName;
        //   return dd($itemName);
          DB::table('other_lang_document')->where('id',$id)->delete();
          DB::table('product_ducument_translations')->where('local',$itemName)->delete();
          return redirect()->route('SpecialLang')->with('flash_message', 'Delete Data successfully');
      }

    public function getDucumentType(){
        $language = DB::table('language')->get();

        // $oldDocType =  DB::table('document_types as dt')
        // ->select('dt.*')
        // ->where('dt.language', '=', 'en')
        // ->orderBy('dt.id','asc')
        // ->get();

        // foreach($oldDocType as $olddata){
        //     $id = DB::table('products_documents_categories')->insertGetID(
        //         [
        //             'title'=>$olddata->title,
        //             'main_cate_id'=>$olddata->type,
        //             'slug'=>$olddata->slug,
        //             'old_id'=>$olddata->id,
        //             "created_at" => \Carbon\Carbon::now(),
        //             "updated_at" => \Carbon\Carbon::now(),
        //         ]
        //     );

        //     foreach($language as $lang){
        //        DB::table('pro_ducuments_cate_translations')->insert(
        //             [
        //                 "doc_cate_id" => $id,
        //                 "lable" => $olddata->label,
        //                 "local"=>$lang->name
        //             ]
        //         );
        //     }
        // }

        // $documents =  DB::table('documents')
        // ->select('documents.*')
        // ->get();
        // foreach($documents as $doc){
        //     $docCateId =  DB::table('products_documents_categories as pdc')
        //     ->where('pdc.old_id',$doc->type_id)
        //     ->select('pdc.*')
        //     ->first();
        //     if(isset($docCateId) &&  $docCateId != null ){
        //         $relatedId = DB::table('product_ducuments')->insertGetID(
        //             [
        //                 'cate_id'=> $docCateId->id,
        //                 'old_id'=> $doc->id,
        //                 "created_at" => \Carbon\Carbon::now(),
        //                 "updated_at" => \Carbon\Carbon::now(),
        //             ]
        //         );
        //         $stringname =  str_replace("/upload/product_files/","",$doc->file);

        //         foreach($language as $lang){
        //              DB::table('product_ducument_translations')->insert(
        //                  [
        //                      "doc_fk_id" => $relatedId,
        //                      "name" => $stringname,
        //                      "file" => $stringname,
        //                      "local"=>$lang->name
        //                  ]
        //              );
        //          }
        //     }
        // }

        //   $docAndpro =  DB::table('products_documents as pd')
        //     ->select('pd.*')
        //     ->get();
        //     $i = 0;
        //     foreach($docAndpro as $doRe){
        //         $docId =  DB::table('product_ducuments as pdt')
        //         ->where('pdt.old_id',$doRe->document_id)
        //         ->select('pdt.*')
        //         ->get();
        //         $proData =  DB::table('products as p')
        //         ->where('p.old_id' ,$doRe->product_id)
        //         ->select('p.*')
        //         ->get();
        //       if(isset($docId[0]->doc_id) && isset($proData[0]->pro_id)){
        //         $genId = (time()+$i);
        //         DB::table('product_has_documents')->insert(
        //                 [
        //                     "id" => $genId,
        //                     "document_id" => $docId[0]->doc_id,
        //                     "product_id" => $proData[0]->pro_id,
        //                 ]
        //             );
        //             $i++;
        //       }
        //     }



        // test fix before run code
        // $documents1 =  DB::table('documents as d')
        // ->join('document_types as dt','dt.id','=','d.type_id')
        // ->select('d.*','dt.title','dt.language','dt.slug')
        // ->where('dt.language','jp')
        // ->where('dt.id','2')
        // ->get();

        // $documents =  DB::table('products_documents as pd')
        // ->join('documents as d','d.id','=','pd.document_id')
        // ->join('document_types as dt','dt.id','=','d.type_id')
        // ->select('d.*','dt.title','dt.language','dt.slug' ,'pd.product_id')
        // ->where('dt.language','jp')
        // ->where('dt.id',2)
        // ->get();
        // $i = 0;
        // foreach($documents as $doc){
        //  $stringname =  str_replace("/upload/product_files/","",$doc->file);
        //  $data = DB::table('product_has_documents as pht')
        //              ->join('product_ducuments as d','d.doc_id','=','pht.document_id')
        //              ->join('products as p','p.pro_id','=','pht.product_id')
        //              ->where('p.old_id',$doc->product_id)
        //              ->where('d.cate_id',1)
        //              ->get();

        //           if(isset($data[0])){
        //             DB::table('product_ducument_translations')->insert(
        //                 [
        //                     "doc_fk_id" => $data[0]->document_id,
        //                     "name" => $stringname,
        //                     "file" => $stringname,
        //                     "local"=>'jp'
        //                 ]
        //             );
        //           }
        //  }


        // $docINdatabase =  DB::table('product_has_documents as phd')
        // ->join('product_ducuments as pd','pd.doc_id','=','phd.document_id')
        // ->join('product_ducument_translations as pdt','pdt.doc_fk_id','=','pd.doc_id')
        // ->join('products_documents_categories as pdc','pdc.id','=','pd.cate_id')
        // ->where('pdt.local','en')
        // ->select('pd.*','pdt.file' ,'phd.*','pdc.title as type')
        // ->get();

        //   foreach($docINdatabase as $datasheet){

        //     $proData =  DB::table('products as p')
        //     ->where('p.pro_id',$datasheet->product_id)
        //     ->select('p.*')
        //     ->get();

        //     $updateContent =  DB::table('products_documents as pd')
        //     ->join('documents as d','d.id','=','pd.document_id')
        //     ->join('document_types as dt','dt.id','=','d.type_id')
        //     ->select('dt.title as type','dt.language','dt.slug' ,'d.*' ,'pd.*')
        //     ->where('pd.product_id', $proData[0]->old_id)
        //     ->where('dt.title',$datasheet->type)
        //     ->where('dt.language', '=', 'cn')
        //     ->get();

        //      if(isset($updateContent) && count($updateContent) > 0){
        //         $stringname =  str_replace("/upload/product_files/","",$updateContent[0]->file);
        //         DB::table('product_ducument_translations')->where('local','cn')->where('doc_fk_id',$datasheet->document_id)->update(
        //             [
        //                 "name" => $stringname,
        //                 "file" => $stringname,
        //             ]
        //          );
        //       }
        //   }



        // return dd($updateContent[0]  , $docINdatabase[0]);



        return dd('get data');

        return redirect()->route('index_categories')->with('flash_message', 'GET Data successfully');
    }
    public function index_categories(){
        $userdata = auth()->user();
        if($userdata->lang == 'All'){
        $categories = DB::table('products_documents_categories')
        ->join('pro_ducuments_cate_translations as pdct', 'products_documents_categories.id', '=', 'pdct.doc_cate_id')
        ->where('pdct.local', '=', 'en')
        ->select('products_documents_categories.*', 'pdct.*')
        ->orderBy('products_documents_categories.created_at', 'desc')
        ->get();
        }else{
            $categories = DB::table('products_documents_categories')
            ->join('pro_ducuments_cate_translations as pdct', 'products_documents_categories.id', '=', 'pdct.doc_cate_id')
            ->where('pdct.local', '=',$userdata->lang)
            ->select('products_documents_categories.*', 'pdct.*')
            ->orderBy('products_documents_categories.created_at', 'desc')
            ->get();
        }

    return view('product_doc.categories_index')
        ->with('name', 'product_doc')
        ->with('menu', 'categories_doc')
        ->with('categories', $categories);

    }
    public function createProDocCategories(){
        $language = DB::table('language')->get();
        return view('product_doc.categories_create')
        ->with('name', 'product_doc')
        ->with('menu', 'categories_doc')
        ->with('language', $language);
    }
    public function editProDocCategories($id){
        $userdata = auth()->user();
        if($userdata->lang == 'All'){
            $language = DB::table('language')->get();
        }else{
            $language = DB::table('language')->where('name',$userdata->lang)->get();
        }

        $categorie = DB::table('products_documents_categories')
        ->join('pro_ducuments_cate_translations as pdct', 'products_documents_categories.id', '=', 'pdct.doc_cate_id')
        ->where('products_documents_categories.id' ,$id)
        ->select('products_documents_categories.*', 'pdct.*')
        ->orderBy('products_documents_categories.created_at', 'desc')
        ->get();

        return view('product_doc.categories_edit')
        ->with('name', 'product_doc')
        ->with('menu', 'categories_doc')
        ->with('categorie', $categorie)
        ->with('language', $language);
    }

    public function storedocCategories(Request $request){

        // return dd($arrayfilesave);
        $lang_loop = $request->lang_loop;
        $title = $request->title;
        $name = $request->name;
        $string = str_replace(' ', '-', $title);
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
        $validate = Validator::make($request->all(), [
            'title' => 'required',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        } else {
            $id = DB::table('products_documents_categories')->insertGetID(
                [
                    'title'=>$title,
                    'slug'=>$slug,
                    'main_cate_id'=>$request->main_cate,
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                ]
            );
            foreach($lang_loop as $lang){
               DB::table('pro_ducuments_cate_translations')->insert(
                    [
                        "doc_cate_id" => $id,
                        "lable" => $name[$lang],
                        "local"=>$lang
                    ]
                );
            }
            return redirect()->route('index_categories')->with('flash_message', 'Create Data successfully');
        }

    }
     public function updateDocCategories(Request $request){

        $id = $request->docCateId;
        // return dd($id);
        $lang_loop = $request->lang_loop;
        $title = $request->title;
        $name = $request->name;
        $string = str_replace(' ', '-', $title);
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
        $validate = Validator::make($request->all(), [
            'title' => 'required',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        } else {

          DB::table('products_documents_categories')->where('id',$id)->update(
                [
                    'title'=>$title,
                    'slug'=>$slug,
                    'main_cate_id'=>$request->main_cate,
                    "updated_at" => \Carbon\Carbon::now(),
                ]
            );
            foreach($lang_loop as $lang){
               $data = DB::table('pro_ducuments_cate_translations')->where('local',$lang)->where('doc_cate_id' ,$id)->select('*')->get();
                $data_con = count($data);
                // return dd($data);
              if($data_con == 1){
                DB::table('pro_ducuments_cate_translations')->where('local',$lang)->where('doc_cate_id',$id)->update(
                    [
                        "lable" => $name[$lang],
                    ]
                );
              }else{
                DB::table('pro_ducuments_cate_translations')->insert(
                    [
                        "doc_cate_id" => $id,
                        "lable" => $name[$lang],
                        "local"=>$lang
                    ]
                );
              }

            }

            return redirect()->route('index_categories')->with('flash_message', 'Update Data successfully');
        }

     }

     public function deletedocCategories(Request $request){
         $itemId = $request->itemId;
         DB::table('products_documents_categories')->where('id',$itemId)->delete();
         DB::table('pro_ducuments_cate_translations')->where('doc_cate_id' ,$itemId)->delete();
         return redirect()->route('index_categories')->with('flash_message', 'Delete Data successfully');

     }

     public function createDocMutidoc(){

        $language = DB::table('language')->get();

        $categories = DB::table('products_documents_categories')
        ->join('pro_ducuments_cate_translations as pdct', 'products_documents_categories.id', '=', 'pdct.doc_cate_id')
        ->where('pdct.local', '=', 'en')
        ->select('products_documents_categories.*', 'pdct.*')
        ->orderBy('products_documents_categories.created_at', 'desc')
        ->get();


        $other_lang = DB::table('other_lang_document')->get();

        return view('product_doc.create_doc')
        ->with('name', 'product_doc')
        ->with('menu', 'muti_doc')
        ->with('categories', $categories)
        ->with('language', $language)
        ->with('other_lang', $other_lang);

     }

     private function savearrayfile($loopfile ,$loop){
        $arrayfileName = [];
           foreach($loop as $lang){
               $emptyornot = isset($loopfile[$lang]);
               if($emptyornot){
               $fileName[$lang] = preg_replace('/\s+/', '', self::fileformat($loopfile[$lang]));
               $loopfile[$lang]->move(base_path('/../upload/product_files'),$fileName[$lang]);

               $arrayfileName[$lang] = $fileName[$lang];
               }else{
                $fileName[$lang] = '';
                $arrayfileName[$lang] = $fileName[$lang];
               }
           }
       return $arrayfileName;
   }

     public function storeProdoc(Request $request){
        $name = $request->name;
        $langs = $request->lang_loop;
        $doc_cate_id = $request->doc_categories;
        $fileGU = $request->file('fileGU');
        $products = $request->product;
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'product'=> 'required',
        ]);
       //return dd($products);
        if(empty($products)){
            return redirect()->back()->with('error_message', 'Please Select Products');
        }
        foreach($products as $product){

             $exitProInCate  =  DB::table('product_has_documents as phd')
             ->join('product_ducuments as pd','pd.doc_id','=','phd.document_id')
             ->where('pd.cate_id',$doc_cate_id)
             ->where('phd.product_id',$product)
             ->get();

            //  return dd($exitProInCate);
             if(count($exitProInCate)){
                return redirect()->route('createDocMutidoc')->with('error_message', 'Already file type in this product');
             }
          }

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        } else {
                $id = DB::table('product_ducuments')->insertGetID(
                    [
                        'cate_id'=>$doc_cate_id,
                        "created_at" => \Carbon\Carbon::now(),
                        "updated_at" => \Carbon\Carbon::now(),
                    ]
                );
                $arrayfileName = self::savearrayfile($fileGU ,$langs);
                foreach($langs as $lang){
                     DB::table('product_ducument_translations')->insert(
                        [
                            "doc_fk_id" => $id,
                            "name" => $name,
                            "file" => $arrayfileName['en'],
                            "local" => $lang,
                        ]
                    );
                }
                if(!empty($products)){
                $i = 0;
                foreach($products as $product){
                  $genId = $this->unique_code_bysetf(11);
                  DB::table('product_has_documents')->insert(
                        [
                            "id" => $genId,
                            "document_id" => $id,
                            "product_id" =>  $product,
                        ]
                    );
                    $i++;
                }
            }
                return redirect()->route('docFilerBy',$doc_cate_id )->with('flash_message', 'Insert Data successfully');
        }
    }

    private function fileformat($file){
        $string = '';
    if(isset($file) && is_file($file)){
      $filename = str_replace('.'.$file->getClientOriginalExtension(),"",$file->getClientOriginalName());
      $string   =  $filename.uniqid().'.'.$file->getClientOriginalExtension();
    }
    return $string;
  }

    private function UpdateOldfile($loopfile ,$loop ,$oldfile){
        // return dd($oldfile);
        $arrayfileName = [];
        //    return dd($loopfile);
           foreach($loop as $lang){
               $emptyornot = isset($loopfile[$lang]);
               if($emptyornot){

                        $fileName[$lang] = preg_replace('/\s+/', '', self::fileformat($loopfile[$lang]));
                        $loopfile[$lang]->move(base_path('/../upload/product_files'),$fileName[$lang]);
                        $arrayfileName[$lang] = $fileName[$lang];

                        if(isset($oldfile[$lang])){
                            $file_pointer = base_path('/../upload/product_files/').$oldfile[$lang];
                            if (file_exists($file_pointer)) {
                                unlink($file_pointer);
                            }
                        }
               }else{
                $arrayfileName[$lang] = $oldfile[$lang];
               }
           }
       return $arrayfileName;
   }

   public function editDocMutidoc($id){

        $userdata = auth()->user();
        if($userdata->lang == 'All'){
            $language = DB::table('language')->get();
        }else{
            $language = DB::table('language')->where('name',$userdata->lang)->get();
        }

    $categories = DB::table('products_documents_categories')
    ->join('pro_ducuments_cate_translations as pdct', 'products_documents_categories.id', '=', 'pdct.doc_cate_id')
    ->where('pdct.local', '=', 'en')
    ->select('products_documents_categories.*', 'pdct.*')
    ->orderBy('products_documents_categories.created_at', 'desc')
    ->get();

    $doc_has_pros = DB::table('product_has_documents as phd')
    ->join('products as p', 'p.pro_id', '=', 'phd.product_id')
    ->where('phd.document_id' ,$id)
    ->select('phd.*' ,'p.pro_code' ,'p.pro_id')
    ->get();

    $arrayinHas = [];
    foreach($doc_has_pros as $doc){
        array_push($arrayinHas ,$doc->product_id);
    }

    $products = DB::table('products as p')
    ->join('products_translation as pt', 'pt.product_id', '=', 'p.pro_id')
    ->select('p.*', 'pt.*')
    ->where('pt.local' ,'en')
    ->whereNotIn('p.pro_id' ,$arrayinHas)
    ->orderBy('p.created_at', 'desc')
    ->get();

    $docs = DB::table('product_ducuments as pd')
    ->join('product_ducument_translations as pdct', 'pd.doc_id', '=', 'pdct.doc_fk_id')
    ->select('pd.*', 'pdct.*')
    ->where('pd.doc_id', '=',$id)
    ->orderBy('pd.created_at', 'desc')
    ->get();

    // return dd($docs);

    $other_lang = DB::table('other_lang_document')->get();

    return view('product_doc.edit_doc')
    ->with('name', 'product_doc')
    ->with('menu', 'muti_doc')
    ->with('products', $products)
    ->with('doc_has_pros', $doc_has_pros)
    ->with('docs', $docs)
    ->with('categories', $categories)
    ->with('other_lang', $other_lang)
    ->with('language', $language);

 }
   public function updateProdoc(Request $request){
    $id = $request->doc_id;
    $name = $request->name;
    $langs = $request->lang_loop;
    $doc_cate_id = $request->doc_categories;
    $fileGU = $request->file('fileGU');
    $oldfile = $request->oldfile;
    // return dd($langs);
    $products = $request->product;

    $validate = Validator::make($request->all(), [
        'name' => 'required',
    ]);
    // return dd($validate->fails());
    if ($validate->fails()) {
        return redirect()->back()->withErrors($validate->errors());
    } else {
             DB::table('product_ducuments')->where('doc_id',$id)->update(
                [
                    'cate_id'=>$doc_cate_id,
                    "updated_at" => \Carbon\Carbon::now(),
                ]
            );
            // return dd($name['jp']);
        $arrayfileName = self::UpdateOldfile($fileGU ,$langs,$oldfile);
            foreach($langs as $lang){
                $data = DB::table('product_ducument_translations')->where('local',$lang)->where('doc_fk_id',$id)->select('*')->get();
                  $data_con  = count($data);

                if($data_con == 1){
                    DB::table('product_ducument_translations')->where('local',$lang)->where('doc_fk_id',$id)->update(
                        [
                            "name" => $name[$lang],
                            "file" => $arrayfileName[$lang],

                        ]
                    );
                }else{
                    if(isset($arrayfileName[$lang]) && $arrayfileName[$lang] != null && $arrayfileName[$lang] != ''){
                        DB::table('product_ducument_translations')->insert(
                            [
                                "doc_fk_id" => $id,
                                "name" => $name[$lang],
                                "file" => $arrayfileName[$lang],
                                "local" => $lang,
                            ]
                        );
                    }

                }

            }
            if(!empty($products) && isset($products)){
             DB::table('product_has_documents')->where('document_id',$id)->delete();
                $i = 0;
                foreach($products as $product){
                $genId = $this->unique_code_bysetf(11);
                    DB::table('product_has_documents')->insert(
                        [
                            "id" => $genId,
                            "document_id" => $id,
                            "product_id" =>  $product,
                        ]
                    );
                    $i++;
                }
            }

            return redirect()->route('docFilerBy',$doc_cate_id )->with('flash_message', 'Insert Data successfully');
    }

}
    public function deleteproDoc(Request $request){
        $id = $request->itemId;
        $data =  DB::table('product_ducuments')->where('doc_id',$id)->get();
        $cateid = $data[0]->cate_id;
         $olddatas =  DB::table('product_ducument_translations')->where('doc_fk_id',$id)->get();
        foreach($olddatas as $data){
            $file_pointer = base_path('/../upload/product_files/').$data->file;
            if (isset($data->file) && $data->file != '' && file_exists($file_pointer)) {
                unlink($file_pointer);
            }
        }
         DB::table('product_ducuments')->where('doc_id',$id)->delete();
         DB::table('product_ducument_translations')->where('doc_fk_id',$id)->delete();
         DB::table('product_has_documents')->where('document_id',$id)->delete();
         if(isset($cateid)){
            return redirect()->route('docFilerBy',$cateid)->with('flash_message', 'Delete Data successfully');
         }else{
            return redirect()->route('docFilerBy' ,1)->with('flash_message', 'Delete Data successfully');
         }

    }

    public function getDocument($id){

        $doc_has_pros = DB::table('product_has_documents as phd')
        ->join('products as p', 'p.pro_id', '=', 'phd.product_id')
        ->join('product_ducuments as pd', 'pd.doc_id', '=', 'phd.document_id')
        ->join('product_ducument_translations as pdct', 'pd.doc_id', '=', 'pdct.doc_fk_id')
        ->join('products_documents_categories as pdc', 'pdc.id', '=', 'pd.cate_id')
        ->where('phd.product_id' ,$id)
        ->where('pdct.local' ,'en')
        ->select('pd.*', 'pdct.*','phd.*' ,'pdc.title as catename')
        ->orderBy('pd.created_at','desc')
        ->get();


         $arrayNotin = [];

         foreach($doc_has_pros  as $doc){
          array_push($arrayNotin ,$doc->document_id);
         }

        $docs = DB::table('product_ducuments as pd')
        ->join('product_ducument_translations as pdct', 'pd.doc_id', '=', 'pdct.doc_fk_id')
        ->join('products_documents_categories as pdc', 'pdc.id', '=', 'pd.cate_id')
        ->select('pd.*', 'pdct.*','pdc.title as catename' ,'pdc.main_cate_id')
        ->where('pdct.local', '=','en')
        ->whereNotIn('doc_id',$arrayNotin)
        ->orderBy('pd.created_at', 'desc')
        ->get();

        $language = DB::table('language')->get();

        $categories = DB::table('products_documents_categories')
        ->join('pro_ducuments_cate_translations as pdct', 'products_documents_categories.id', '=', 'pdct.doc_cate_id')
        ->where('pdct.local', '=', 'en')
        ->select('products_documents_categories.*', 'pdct.*')
        ->orderBy('products_documents_categories.created_at', 'desc')
        ->get();


        $other_lang = DB::table('other_lang_document')->get();


        return  view('product.document_pro')
        ->with('language' ,$language)
        ->with('categories' ,$categories)
        ->with('other_lang' ,$other_lang)
        ->with('docs' ,$docs)
        ->with('productId' ,$id)
        ->with('doc_has_pros' ,$doc_has_pros)
        ->with('menu', "products")
        ->with('name', "product");
    }
    public function storeProDocuments(Request $request){
      $productid = $request->productId;
      $docId  =  $request->documents;
      $genId = $this->unique_code_bysetf(11);
        DB::table('product_has_documents')->insert(
                [
                    "id" => $genId,
                    "document_id" => $docId,
                    "product_id" =>  $productid,
                ]
            );

            return redirect()->route('getDocument',$productid)->with('flash_message', 'Add Data successfully');

    }
    public function removefileDoc($lang, $id){

        DB::table('product_ducument_translations')->where('local' ,$lang)->where('doc_fk_id' ,$id)->update(
        [
            "file" => null,
        ]

        );
        return redirect()->back()->with('flash_message', 'Remove file Data successfully');
    }
    public function deleteproHasDoc(Request $request){
        $productid = $request->productId;
        $itemId  = $request->itemId;
        DB::table('product_has_documents')->where('id' ,$itemId)->delete();

        return redirect()->route('getDocument',$productid)->with('flash_message', 'Delete Data successfully');
    }
    public function createProdocuments(Request $request){

        $name = $request->name;
        $langs = $request->lang_loop;
        $doc_cate_id = $request->doc_categories;
        $fileGU = $request->file('fileGU');
        // return dd($fileGU);
        $product_id = $request->productId;

        $dochas_cate  =  DB::table('product_has_documents as phd')
        ->join('product_ducuments as pd','pd.doc_id','=','phd.document_id')
        ->where('pd.cate_id',$doc_cate_id)
        ->where('phd.product_id',$product_id)
        ->get();

        if(count($dochas_cate) > 0){
            return redirect()->route('getDocument',$product_id)->with('error_message', 'Already file type in this product');
        }else{
            $id = DB::table('product_ducuments')->insertGetID(
                [
                    'cate_id'=>$doc_cate_id,
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                ]
            );
            $arrayfileName = self::savearrayfile($fileGU ,$langs);
            foreach($langs as $lang){
                 DB::table('product_ducument_translations')->insert(
                    [
                        "doc_fk_id" => $id,
                        "name" => $name,
                        "file" => $arrayfileName['en'],
                        "local" => $lang,
                    ]
                );
            }
            $genId = $this->unique_code_bysetf(11);
            DB::table('product_has_documents')->insert(
                [
                    "id" => $genId,
                    "document_id" => $id,
                    "product_id" =>$product_id,
                ]
            );
            return redirect()->route('getDocument',$product_id)->with('flash_message', 'Insert Data successfully ,Can See this file in Multidoc');
        }

    }
    public function searhModelProductByCatedoc(Request $request){
        $cate_id = $request->cateid;

       $dochas_cate  =  DB::table('product_has_documents as phd')
        ->join('product_ducuments as pd','pd.doc_id','=','phd.document_id')
        ->where('pd.cate_id',$cate_id)
        ->get();

        $proINdoc = [];

        foreach($dochas_cate as $doc){
          if(!in_array($doc->product_id ,$proINdoc)){
            array_push($proINdoc,$doc->product_id);
          }

        }


        $products = DB::table('products as p')
        ->join('products_translation as pt', 'pt.product_id', '=', 'p.pro_id')
        ->select('p.pro_id','p.pro_code')
        ->whereNotIn('p.pro_id',$proINdoc)
        ->where('pt.local' ,'en')
        ->orderBy('p.created_at', 'desc')
        ->get();

        return response()->json([
            'data' => $products,
                ], 200);

    }




}

?>