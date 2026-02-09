<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Validator;

class ProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $products = DB::table('products as p')
        ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
        ->where('pt.local' ,'en')
        ->select('p.*', 'pt.*' )
        ->orderBy('pt.showstatus' ,'desc')
        ->orderBy('p.created_at', 'desc')
        ->get();

        // $propertys = DB::table('product_has_property as ph')
        // ->where('type_value','text')
        // ->where('type_id',6)
        // ->get();
        // foreach($propertys as $per){
        //     DB::table('product_has_property')->where('per_id',$per->per_id)->update([
        //         'type_value' =>'number',
        //     ]);
        // }
        // return dd('success');


        return view('product.index')
        ->with('menu', "products")
        ->with('products', $products)
        ->with('name', "product");
    }
    public function create()
    {
        $language = DB::table('language')->get();
        $subCategories = DB::table('sub_pro_categories as sc')
        ->join('sub_pro_categories_translation as sct', 'sct.sub_pro_id', '=', 'sc.sub_pro_id')
        ->where('sct.local', 'en')
        ->select('sc.*', 'sct.*')
        ->orderBy('sc.created_at', 'desc')
        ->get();

        $section = DB::table('section as st')
        ->join('section_translation as stt', 'st.id', '=', 'stt.section_id')
        ->select('st.*', 'st.id as sectid', 'stt.*')
        ->where('stt.local', 'en')
        ->get();

        $pd_fields = DB::table('product_field as pf')
        ->join('product_field_translation as pft', 'pf.id', '=', 'pft.product_field_id')
        ->where('pft.local', '=', 'en')
        ->select('pf.id as pd_field_id', 'pf.type', 'pft.field_name', 'pf.section_id')
        ->orderBy('pf.id', 'asc')
        ->get();

        $products  = DB::table('products as p')
        ->select('p.*')
        ->get();

        return  view('product.create')
        ->with('products', $products)
        ->with('pd_fields', $pd_fields)
        ->with('section', $section)
        ->with('language', $language)
        ->with('subCategories', $subCategories)
        ->with('menu', "products")
        ->with('name', "product");
        ;

    }
    public function ImportOldProduct($type)
    {

    }
    public function searhSeries(Request $request)
    {
        $data  = $request->data;
        $series = [];
        if (isset($data)) {
            $series =  DB::table('series_has_pro_categories as sc')
            ->join('series as s', 'sc.se_id', '=', 's.se_id')
            ->join('series_translations as st', 'st.series_id', '=', 's.se_id')
            ->whereIn('sc.pro_categories_id', $data)
            ->where('st.local', 'en')
            ->select('s.*', 'st.*')
            ->distinct('s.se_id')
            ->get();
        }


        return response()->json([
            'modalContent' => $series
                ], 200);
    }
    public function store(Request $request)
    {

        $langs = $request->lang_loop;
        $overview = $request->overview;
        $content = $request->content;
        $short_features = $request->short_features;
        $status = $request->status;
        $productfieldText = $request->productfieldText;
        $productfieldNumbers = $request->productfieldNumbers;
        $inputText = $request->inputText;
        $inputNumber = $request->inputNumber;
        $status_input = $request->status_input;
        $certificate =  $request->status_certificate;
        $tags  = $request->tag;
        $optional_models = $request->optional_models;
        $relatePros  = $request->relatePro;
        $pro_categories  = $request->pro_categories;
        $meta_description = $request->metaDescription;

        $validate = Validator::make($request->all(), [
            'productCode' => 'required',
        ]);
        // return dd($validate->fails());
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        } else {
            if ($request->hasFile('thumbnail')) {

                $thumbnailImage = $request->file('thumbnail');
                $thumbnailName = uniqid() . "." . $thumbnailImage->getClientOriginalExtension();
                $thumbnailImage->move(base_path('/../upload/thumbs'), preg_replace('/\s+/', '', $thumbnailName));
                $id = DB::table('products')->insertGetID(
                    [
                     'picture' => $thumbnailName,
                     'pro_code' => $request->productCode,
                     'series_id' => $request->Series,
                     'enable_pro' => $request->enable_pro,
                     'status_product' => $request->status_pro,
                     'manaul_page' => $request->manaul_status,
                     'dimensionL' => $request->dimensionL,
                     'dimensionW' => $request->dimensionw,
                     'dimensionD' => $request->dimensionD,
                     'unit_weight' => $request->unitWeight,
                     // 'alt_img' => $request->alt_img,
                     "created_at" => \Carbon\Carbon::now(),
                     "updated_at" => \Carbon\Carbon::now(),
                ]
                );

            } else {

                $id = DB::table('products')->insertGetID(
                    [
                        'pro_code' => $request->productCode,
                        'series_id' => $request->Series,
                        'enable_pro' => $request->enable_pro,
                        'status_product' => $request->status_pro,
                        'manaul_page' => $request->manaul_status,
                        'dimensionL' => $request->dimensionL,
                        'dimensionW' => $request->dimensionw,
                        'dimensionD' => $request->dimensionD,
                        'unit_weight' => $request->unitWeight,
                        // 'alt_img' => $request->alt_img,
                        "created_at" => \Carbon\Carbon::now(),
                        "updated_at" => \Carbon\Carbon::now(),
                    ]
                );
            }
            if (isset($pro_categories)) {
                foreach ($pro_categories as $cate) {
                    DB::table('product_has_categories')->insert(
                        [
                              "categories_id" => $cate,
                              "product_id" => $id,
                          ]
                    );
                }
            }

            if (isset($certificate)) {
                foreach ($certificate as $cer) {
                    $cerdata = DB::table('certificate_product')->insert(
                        [
                            "certificate_id" => $cer,
                            "product_id" => $id,
                        ]
                    );
                }
            }
            if (isset($tags)) {
                foreach ($tags as $tag) {
                    DB::table('product_tags')->insert(
                        [
                            "tag" => $tag,
                            "product_id" => $id,
                        ]
                    );
                }
            }
            if (isset($optional_models)) {
                foreach ($optional_models as $optional) {
                    DB::table('product_optional_model')->insert(
                        [
                            "optional_model" => $optional,
                            "product_id" => $pro_id,
                        ]
                    );
                }
            }
            if (isset($relatePros)) {
                foreach ($relatePros as $relatePro) {
                    DB::table('product_related')->insert(
                        [
                            "related_id" => $relatePro,
                            "product_id" => $id,
                        ]
                    );
                }
            }


            foreach ($langs as $lang) {
                $products_translation = DB::table('products_translation')->insert(
                    [
                        "product_id" => $id,
                        "content_1" => $overview,
                        "content_2" => $content,
                        "short_features" => $short_features,
                        "meta_description" => $meta_description,
                        "showstatus" => $status,
                        "local" => $lang,
                    ]
                );
            }
            foreach ($productfieldText as $fieldTextid) {

                $pro_id_perty = DB::table('product_has_property')->insertGetID(
                    [
                        'product_id' => $id,
                        'type_id' => $fieldTextid,
                        'type_value' => 'text',

                    ]
                );
                foreach ($langs as $lang) {
                    DB::table('product_has_property_translation')->insert(
                        [
                             "per_fk_id" => $pro_id_perty,
                             "product_id" => $id,
                             "value_text" =>  isset($inputText[$fieldTextid]['en']) ? $inputText[$fieldTextid]['en'] : null,
                             "local" => $lang,
                         ]
                    );
                }
            }

            foreach ($productfieldNumbers as $fieldNumid) {

                $data4 = null;
                $data5 = null;
                if (isset($inputNumber[$fieldNumid]['m'][4])) {
                    $data4 = $inputNumber[$fieldNumid]['m'][4];
                }

                if (isset($inputNumber[$fieldNumid]['m'][5])) {
                    $data5 = $inputNumber[$fieldNumid]['m'][5];
                }

                if ($status_input[$fieldNumid] == 1) {
                    // return dd($inputNumber[3]['s'][1]);
                    $pro_id_perty = DB::table('product_has_property')->insertGetID(
                        [
                            'product_id' => $id,
                            'type_id' => $fieldNumid,
                            'type_value' => 'number',
                            'status_input' => $status_input[$fieldNumid],
                            'data_1' => $inputNumber[$fieldNumid]['s'][1]
                        ]
                    );

                } elseif ($status_input[$fieldNumid] == 2) {
                    $pro_id_perty = DB::table('product_has_property')->insertGetID(
                        [
                            'product_id' => $id,
                            'type_id' => $fieldNumid,
                            'type_value' => 'number',
                            'status_input' => $status_input[$fieldNumid],
                            'data_1' => isset($inputNumber[$fieldNumid]['m'][1]) ? $inputNumber[$fieldNumid]['m'][1] : null,
                            'data_2' => isset($inputNumber[$fieldNumid]['m'][2]) ? $inputNumber[$fieldNumid]['m'][2] : null,
                            'data_3' => isset($inputNumber[$fieldNumid]['m'][3]) ? $inputNumber[$fieldNumid]['m'][3] : null,
                            'data_4' => isset($inputNumber[$fieldNumid]['m'][4]) ? $inputNumber[$fieldNumid]['m'][4] : null,
                            'data_5' => isset($inputNumber[$fieldNumid]['m'][5]) ? $inputNumber[$fieldNumid]['m'][5] : null,
                            'data_6' => isset($inputNumber[$fieldNumid]['m'][6]) ? $inputNumber[$fieldNumid]['m'][6] : null,
                            'data_7' => isset($inputNumber[$fieldNumid]['m'][7]) ? $inputNumber[$fieldNumid]['m'][7] : null,
                            'data_8' => isset($inputNumber[$fieldNumid]['m'][8]) ? $inputNumber[$fieldNumid]['m'][8] : null,
                            'data_9' => isset($inputNumber[$fieldNumid]['m'][9]) ? $inputNumber[$fieldNumid]['m'][9] : null,
                            'data_10' => isset($inputNumber[$fieldNumid]['m'][10]) ? $inputNumber[$fieldNumid]['m'][10] : null,
                            'data_11' => isset($inputNumber[$fieldNumid]['m'][11]) ? $inputNumber[$fieldNumid]['m'][11] : null,
                            'data_12' => isset($inputNumber[$fieldNumid]['m'][12]) ? $inputNumber[$fieldNumid]['m'][12] : null,
                        ]
                    );

                } elseif ($status_input[$fieldNumid] == 3) {

                    $pro_id_perty = DB::table('product_has_property')->insertGetID(
                        [
                            'product_id' => $id,
                            'type_id' => $fieldNumid,
                            'type_value' => 'number',
                            'status_input' => $status_input[$fieldNumid],
                            'data_1' => $inputNumber[$fieldNumid]['r'][1],
                            'data_2' => $inputNumber[$fieldNumid]['r'][2],
                        ]
                    );

                }
                foreach ($langs as $lang) {
                    DB::table('product_has_property_translation')->insert(
                        [
                             "per_fk_id" => $pro_id_perty,
                             "product_id" => $id,
                             "local" => $lang,
                         ]
                    );
                }


            }

            return redirect()->route('products.index')->with('flash_message', 'Insert Data successfully');
        }

    }
    public function edit($id)
    {
        $products = DB::table('products as p')
            ->join('products_translation as pt', 'pt.product_id', '=', 'p.pro_id')
            ->where('p.pro_id', $id)
            ->select('p.*', 'pt.*')
            ->orderBy('p.created_at', 'desc')
            ->get();

        $cerpros = DB::table('certificate_product as cp')
            ->where('cp.product_id', $id)
            ->get();

        $procategories = DB::table('product_has_categories as pc')
            ->join('sub_pro_categories as sc', 'sc.sub_pro_id', '=', 'pc.categories_id')
            ->where('pc.product_id', $id)
            ->select('pc.categories_id', 'sc.url_item')
            ->get();
        $arrProcate = [];
        $arrProCateName = [];
        foreach ($procategories as $item) {
            array_push($arrProcate, $item->categories_id);
            array_push($arrProCateName, $item->url_item);
        }
        $langinproduct = [];
        foreach ($products as $product) {
            array_push($langinproduct, $product->local);
        }
        $langresult = array_unique($langinproduct);
        $userdata = auth()->user();
        if ($userdata->lang == 'All') {
            $allLang = DB::table('language')->select('language.name')->get();
            $addLang = DB::table('language')->whereNotIn('language.name', $langresult)->select('language.name')->get();
        } else {
            $allLang = DB::table('language')->where('name', $userdata->lang)->select('language.name')->get();
            $addLang = DB::table('language')->whereNotIn('language.name', $langresult)->select('language.name')->get();
        }
        $subCategories = DB::table('sub_pro_categories as sc')
            ->join('sub_pro_categories_translation as sct', 'sct.sub_pro_id', '=', 'sc.sub_pro_id')
            ->where('sct.local', 'en')
            ->select('sc.*', 'sct.*')
            ->orderBy('sc.created_at', 'desc')
            ->get();
        $section = DB::table('section as st')
            ->join('section_translation as stt', 'st.id', '=', 'stt.section_id')
            ->select('st.*', 'st.id as sectid', 'stt.*')
            ->where('stt.local', 'en')
            ->get();
        $arrayInfeild = [];
        $propertys = DB::table('product_has_property as ph')
            ->join('product_has_property_translation as pht', 'pht.per_fk_id', '=', 'ph.per_id')
            ->join('product_field as pf', 'ph.type_id', '=', 'pf.id')
            ->join('product_field_translation as pft', 'ph.type_id', '=', 'pft.product_field_id')
            ->where('pft.local', '=', 'en')
            ->where('ph.product_id', $id)
            ->select('ph.*', 'pht.*', 'ph.type_id as pd_field_id', 'pf.type as type', 'pft.field_name', 'pf.section_id')
            ->orderBy('ph.type_id', 'asc')
            ->distinct()
            ->get();

        $arrcheckuni = [];
        $KeepResult = [];
        foreach ($propertys as $props) {
            $value = $props->type_id.$props->local;
            if (!in_array($value, $arrcheckuni)) {
                array_push($KeepResult, $props);
                array_push($arrcheckuni, $value);
            }

        }
        // return dd(count($arrcheckuni) , count($propertys));

        foreach ($propertys as $pro) {
            array_push($arrayInfeild, $pro->type_id);
        }
        $result = array_unique($arrayInfeild);

        $pd_fields = DB::table('product_field as pf')
            ->join('product_field_translation as pft', 'pf.id', '=', 'pft.product_field_id')
            ->where('pft.local', '=', 'en')
            ->whereNotIn('pf.id', $result)
            ->select('pf.id as pd_field_id', 'pf.type', 'pft.field_name', 'pf.section_id')
            ->orderBy('pf.created_at', 'desc')
            ->get();

        $product_related = DB::table('product_related as pr')
            ->join('products as p', 'p.pro_id', '=', 'pr.related_id')
            ->where('pr.product_id', $id)
            ->select('pr.*')
            ->get();
        $arrRelate = [];
        foreach ($product_related as $relate) {
            array_push($arrRelate, $relate->related_id);
        }
        $tags_pro = DB::table('product_tags as pt')
            ->where('pt.product_id', $id)
            ->select('pt.*')
            ->get();

        $arrtags = [];
        foreach ($tags_pro as $tag) {
            array_push($arrtags, $tag->tag);
        }

        $optional_pro = DB::table('product_optional_model as op')
            ->where('op.product_id', $id)
            ->select('op.*')
            ->get();

        $arrOptionalPro = [];
        foreach ($optional_pro as $item) {
            array_push($arrOptionalPro, $item->optional_model);
        }

        $products_input  = DB::table('products as p')
            ->select('p.*')
            ->get();

        $products_input2  = DB::table('products as p')
            ->select('p.*')
            ->where('p.pro_id', '!=', $products[0]->pro_id)
            ->where('p.pro_categories_id', $products[0]->pro_categories_id)
            ->get();

        $proInarr = [];
        foreach ($products_input as $pro) {
            array_push($proInarr, $pro->pro_code);
        }

        return view('product.edit')
            ->with('arrProCateName', $arrProCateName)
            ->with('arrProcate', $arrProcate)
            ->with('products_input', $products_input)
            ->with('products_input2', $products_input2)
            ->with('product_related', $arrRelate)
            ->with('arrtags', $arrtags)
            ->with('arrOptionalPro', $arrOptionalPro)
            ->with('proInarr', $proInarr)
            ->with('cerpros', $cerpros)
            ->with('propertys', $KeepResult)
            ->with('allLang', $allLang)
            ->with('language', $addLang)
            ->with('pd_fields', $pd_fields)
            ->with('section', $section)
            ->with('subCategories', $subCategories)
            ->with('products', $products)
            ->with('menu', "products")
            ->with('name', "product");
    }

    public function update(Request $request)
    {
        $pro_id = $request->pro_id;
        $langs = $request->lang_loop;
        $overview = $request->overview;
        $content = $request->content;
        $short_features = $request->short_features;
        $status = $request->status;
        $productfieldText = $request->productfieldText;
        $inputfiledNum = $request->productfieldNumbers;
        $inputText = $request->inputText;
        $inputNumber = $request->inputNumber;
        $status_input = $request->status_input;
        $oldFile = $request->oldFile;
        $certificate =  $request->status_certificate;
        $tags  = $request->tag;
        $optional_models  = $request->optional_models;
        $relatePros  = $request->relatePro;
        $pro_categories = $request->pro_categories;
        $productfieldNumbers = array_unique($inputfiledNum);
        $oldFile = $request->oldFile;
        $meta_description = $request->metaDescription;
        $enable_pro = isset($request->enable_pro) && $request->enable_pro == 1 ? 1 : 0;
        $manaul_status = isset($request->manaul_status) && $request->manaul_status == 1 ? 1 : 0;

        $validate = Validator::make($request->all(), [
            'productCode' => 'required',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        } else {
            if ($request->hasFile('thumbnail')) {
                $thumbnailImage = $request->file('thumbnail');
                $thumbnailName = uniqid() . "." . $thumbnailImage->getClientOriginalExtension();
                $thumbnailImage->move(base_path('/../upload/thumbs/'), preg_replace('/\s+/', '', $thumbnailName));

                $file_pointer = base_path('/../upload/thumbs/').$oldFile;
                if (file_exists($file_pointer) && $oldFile != null) {
                    unlink($file_pointer);
                }

                DB::table('products')->where('pro_id', $pro_id)->update(
                    [
                        'picture' => preg_replace('/\s+/', '', $thumbnailName),
                        'pro_code' => $request->productCode,
                        'enable_pro' => $enable_pro,
                        'series_id' => $request->Series,
                        'status_product' => $request->status_pro,
                        'manaul_page' => $manaul_status,
                        'dimensionL' => $request->dimensionL,
                        'dimensionW' => $request->dimensionw,
                        'dimensionD' => $request->dimensionD,
                        'unit_weight' => $request->unitWeight,
                        // 'alt_img' => $request->alt_img,
                        "updated_at" => \Carbon\Carbon::now(),
                    ]
                );
            } else {
                DB::table('products')->where('pro_id', $pro_id)->update(
                    [
                        'pro_code' => $request->productCode,
                        'series_id' => $request->Series,
                        'enable_pro' => $enable_pro,
                        'status_product' => $request->status_pro,
                        'manaul_page' => $manaul_status,
                        'dimensionL' => $request->dimensionL,
                        'dimensionW' => $request->dimensionw,
                        'dimensionD' => $request->dimensionD,
                        'unit_weight' => $request->unitWeight,
                        // 'alt_img' => $request->alt_img,
                        "updated_at" => \Carbon\Carbon::now(),
                    ]
                );
            }

            DB::table('product_has_categories')->where('product_id', $pro_id)->delete();
            if (isset($pro_categories)) {
                foreach ($pro_categories as $cate) {
                    DB::table('product_has_categories')->insert(
                        [
                              "categories_id" => $cate,
                              "product_id" => $pro_id,
                          ]
                    );
                }
            }
            DB::table('certificate_product')->where('product_id', $pro_id)->delete();
            if (isset($certificate)) {
                foreach ($certificate as $cer) {
                    $cerdata = DB::table('certificate_product')->insert(
                        [
                            "certificate_id" => $cer,
                            "product_id" => $pro_id,
                        ]
                    );
                }
            }

            DB::table('product_tags')->where('product_id', $pro_id)->delete();
            if (isset($tags)) {
                foreach ($tags as $tag) {
                    DB::table('product_tags')->insert(
                        [
                            "tag" => $tag,
                            "product_id" => $pro_id,
                        ]
                    );
                }
            }
            $optional_old = DB::table('product_optional_model as op')
                ->where('op.product_id', $pro_id)
                ->get();
            if (!isset($optional_models) || !is_array($optional_models)) {
                $optional_models = [];
            }
            foreach ($optional_old as $value) {
                if (!in_array($value->optional_model, $optional_models)) {
                    DB::table('product_optional_model')->where('id', $value->id)->delete();
                }
            }

            if (isset($optional_models)) {
                foreach ($optional_models as $optional) {
                    $optional_pro = DB::table('product_optional_model as op')
                        ->where('op.product_id', $pro_id)
                        ->where('op.optional_model', $optional)
                        ->select('op.*')
                        ->first();

                    if (isset($optional_pro)) {
                        DB::table('product_optional_model')->where('id', $optional_pro->id)->delete();
                        DB::table('product_optional_model')->insert(
                            [
                                "optional_model" => $optional,
                                "product_id" => $pro_id,
                                "remark" => $optional_pro->remark,
                            ]
                        );
                    } else {
                        DB::table('product_optional_model')->insert(
                            [
                                "optional_model" => $optional,
                                "product_id" => $pro_id,
                            ]
                        );
                    }
                }
            }

            if (isset($relatePros)) {
                DB::table('product_related')->where('product_id', $pro_id)->delete();
                foreach ($relatePros as $relatePro) {
                    DB::table('product_related')->insert(
                        [
                            "related_id" => $relatePro,
                            "product_id" => $pro_id,
                        ]
                    );
                }
            }

            foreach ($langs as $lang) {
                $products_translation = DB::table('products_translation')->where('product_id', $pro_id)->where('local', $lang)->update(
                    [
                        "content_1" => $overview[$lang],
                        "content_2" => $content[$lang],
                        "meta_description" => $meta_description[$lang],
                        "short_features" => $short_features[$lang],
                        "showstatus" => $status[$lang],

                    ]
                );
            }

            DB::table('product_has_property_translation')->where('product_id', '=', $pro_id)->delete();
            DB::table('product_has_property')->where('product_id', '=', $pro_id)->delete();
            foreach ($productfieldText as $fieldTextid) {
                $pro_id_perty = DB::table('product_has_property')->insertGetID(
                    [
                        'product_id' => $pro_id,
                        'type_id' => $fieldTextid,
                        'type_value' => 'text',

                    ]
                );

                $products_translation = DB::table('product_has_property_translation')->insert(
                    [
                        "per_fk_id" => $pro_id_perty,
                        "product_id" => $pro_id,
                        "value_text" => isset($inputText[$fieldTextid]['en']) ? $inputText[$fieldTextid]['en'] : null ,
                        "local" => 'en',
                    ]
                );
            }

            foreach ($productfieldNumbers as $fieldNumid) {
                if (isset($status_input[$fieldNumid]) && $status_input[$fieldNumid] == 1) {
                    $pro_id_perty = DB::table('product_has_property')->insertGetID(
                        [
                            'product_id' => $pro_id,
                            'type_id' => $fieldNumid,
                            'type_value' => 'number',
                            'status_input' => $status_input[$fieldNumid],
                            'data_1' => $inputNumber[$fieldNumid]['s'][1]
                        ]
                    );
                } elseif (isset($status_input[$fieldNumid]) && $status_input[$fieldNumid] == 2) {

                    $pro_id_perty = DB::table('product_has_property')->insertGetID(
                        [
                            'product_id' => $pro_id,
                            'type_id' => $fieldNumid,
                            'type_value' => 'number',
                            'status_input' => $status_input[$fieldNumid],
                            'data_1' => isset($inputNumber[$fieldNumid]['m'][1]) ? $inputNumber[$fieldNumid]['m'][1] : null,
                            'data_2' => isset($inputNumber[$fieldNumid]['m'][2]) ? $inputNumber[$fieldNumid]['m'][2] : null,
                            'data_3' => isset($inputNumber[$fieldNumid]['m'][3]) ? $inputNumber[$fieldNumid]['m'][3] : null,
                            'data_4' => isset($inputNumber[$fieldNumid]['m'][4]) ? $inputNumber[$fieldNumid]['m'][4] : null,
                            'data_5' => isset($inputNumber[$fieldNumid]['m'][5]) ? $inputNumber[$fieldNumid]['m'][5] : null,
                            'data_6' => isset($inputNumber[$fieldNumid]['m'][6]) ? $inputNumber[$fieldNumid]['m'][6] : null,
                            'data_7' => isset($inputNumber[$fieldNumid]['m'][7]) ? $inputNumber[$fieldNumid]['m'][7] : null,
                            'data_8' => isset($inputNumber[$fieldNumid]['m'][8]) ? $inputNumber[$fieldNumid]['m'][8] : null,
                            'data_9' => isset($inputNumber[$fieldNumid]['m'][9]) ? $inputNumber[$fieldNumid]['m'][9] : null,
                            'data_10' => isset($inputNumber[$fieldNumid]['m'][10]) ? $inputNumber[$fieldNumid]['m'][10] : null,
                            'data_11' => isset($inputNumber[$fieldNumid]['m'][11]) ? $inputNumber[$fieldNumid]['m'][11] : null,
                            'data_12' => isset($inputNumber[$fieldNumid]['m'][12]) ? $inputNumber[$fieldNumid]['m'][12] : null,
                        ]
                    );

                } elseif (isset($status_input[$fieldNumid]) && $status_input[$fieldNumid] == 3) {

                    $pro_id_perty = DB::table('product_has_property')->insertGetID(
                        [
                            'product_id' => $pro_id,
                            'type_id' => $fieldNumid,
                            'type_value' => 'number',
                            'status_input' => $status_input[$fieldNumid],
                            'data_1' => $inputNumber[$fieldNumid]['r'][1],
                            'data_2' => $inputNumber[$fieldNumid]['r'][2],
                        ]
                    );
                }

                $products_translation = DB::table('product_has_property_translation')->insert(
                    [
                        "per_fk_id" => $pro_id_perty,
                        "product_id" => $pro_id,
                        "local" => 'en',
                    ]
                );
            }

            return redirect()->route('products.index')->with('flash_message', 'Update Data successfully');
        }
    }

    public function deleteProduct(Request $request)
    {
        $itemId = $request->itemId;

        $product = DB::table('products as p')
            ->join('products_translation as pt', 'pt.product_id', '=', 'p.pro_id')
            ->where('p.pro_id', $itemId)
            ->where('pt.local', 'en')
            ->select('p.*')
            ->first();

        if (isset($product->picture) && !empty($product->picture)) {
            $file_pointer = base_path('/../upload/thumbs').$product->picture;
            if (file_exists($file_pointer)) {
                unlink($file_pointer);
            }
        }

        DB::table('products')->where('pro_id', '=', $itemId)->delete();
        DB::table('products_translation')->where('product_id', '=', $itemId)->delete();
        DB::table('product_has_property_translation')->where('product_id', '=', $itemId)->delete();
        DB::table('product_has_property')->where('product_id', '=', $itemId)->delete();
        DB::table('least_products')->where('id', $itemId)->delete();
        DB::table('least_products_translation')->where('last_id', $itemId)->delete();
        DB::table('certificate_product')->where('product_id', $itemId)->delete();
        DB::table('product_related')->where('product_id', $itemId)->delete();
        DB::table('product_tags')->where('product_id', $itemId)->delete();
        DB::table('product_has_categories')->where('product_id', $itemId)->delete();

        return redirect()->route('products.index')->with('flash_message', 'Delete Data successfully');
    }

    public function duplicateProduct($id)
    {
        $products = DB::table('products as p')
            ->join('products_translation as pt', 'pt.product_id', '=', 'p.pro_id')
            ->where('p.pro_id', $id)
            ->select('p.*', 'pt.*')
            ->orderBy('p.created_at', 'desc')
            ->get();

        $propertys = DB::table('product_has_property as ph')
            ->join('product_has_property_translation as php', 'php.per_fk_id', '=', 'ph.per_id')
            ->where('ph.product_id', $id)
            ->select('ph.*', 'php.*')
            ->orderBy('ph.type_id', 'asc')
            ->get();

        $id = DB::table('products')->insertGetID(
            [
                'picture' => '',
                'pro_code' => $products[0]->pro_code,
                'pro_categories_id' => $products[0]->pro_categories_id,
                'series_id' => $products[0]->series_id,
                'status_product' => $products[0]->status_product,
                'certificate' => $products[0]->certificate,
                'dimensionL' => $products[0]->dimensionL,
                'dimensionW' => $products[0]->dimensionW,
                'dimensionD' => $products[0]->dimensionD,
                'unit_weight' => $products[0]->unit_weight,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]
        );

        foreach ($products as $pro) {
            $products_translation = DB::table('products_translation')->insert(
                [
                    "product_id" => $id,
                    "content_1" =>  $pro->content_1,
                    "content_2" =>  $pro->content_2,
                    "showstatus" => $pro->showstatus,
                    "local" =>  $pro->local,
                ]
            );
        }
        $idperty = [];
        $newId  = [];
        foreach ($propertys as $per) {
            if (!in_array($per->per_id, $idperty)) {
                $newId  = [];
                array_push($idperty, $per->per_id);
                $pro_id_perty = DB::table('product_has_property')->insertGetID(
                    [
                        'product_id' => $id,
                        'type_id' => $per->type_id,
                        'type_value' => $per->type_value,
                        'status_input' => $per->status_input,
                        'data_1' => $per->data_1,
                        'data_2' => $per->data_2,
                        'data_3' => $per->data_3,
                        'data_4' => $per->data_4,
                        'data_5' => $per->data_5,
                    ]
                );
                array_push($newId, $pro_id_perty);
            }
            DB::table('product_has_property_translation')->insert(
                [
                    "per_fk_id" => $newId[0],
                    "product_id" => $id,
                    "value_text" => $per->value_text,
                    "local" => $per->local,
                ]
            );
        }

        return redirect()->route('products.index')->with('flash_message', 'Duplicate Data successfully');
    }

    public function lastetproducts()
    {
        $last_products = DB::table('least_products as lp')
            ->join('least_products_translation as lpt', 'lp.id', '=', 'lpt.last_id')
            ->Leftjoin('products as p', 'p.pro_id', '=', 'lp.product_id')
            ->select('lp.*', 'lpt.*', 'p.pro_code', 'p.picture')
            ->where('lpt.local', 'en')
            ->get();

        return  view('product.lastest_product')
            ->with('last_products', $last_products)
            ->with('menu', "leatest_pro")
            ->with('name', "product");
    }

    public function createlastproduct()
    {
        $language = DB::table('language')->get();

        $product  = DB::table('products as p')
            ->join('products_translation as pt', 'pt.product_id', '=', 'p.pro_id')
            ->where('pt.local', 'en')
            ->orderBy('p.created_at', 'desc')
            ->select('p.*')
            ->get();

        return  view('product.create_lastpro')
            ->with('language', $language)
            ->with('product', $product)
            ->with('menu', "leatest_pro")
            ->with('name', "product");
    }

    public function StoreLastProduct(Request $request)
    {
        $productId = $request->productId;
        $status   = $request->status;
        $lang_loop  = $request->lang_loop;
        $title    = $request->title;
        $content  = $request->content;
        $link  = $request->link;

        if ($request->hasFile('thumbnail')) {
            $thumbnailImage = $request->file('thumbnail');
            $thumbnailName = uniqid() . "." . $thumbnailImage->getClientOriginalExtension();
            $thumbnailImage->move(base_path('/../medias/categories'), preg_replace('/\s+/', '', $thumbnailName));

            $id = DB::table('least_products')->insertGetID(
                [
                    "image" => $thumbnailName,
                    "bg_color" => $request->bg_color,
                    "status" => $status,
                    "text_color" => $request->text_color,
                    "title_color" => $request->title_color,
                    "product_id" => $request->productId,
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                ]
            );
            foreach ($lang_loop as $lang) {
                DB::table('least_products_translation')->insert(
                    [
                        "last_id" => $id,
                        "title" => $title[$lang],
                        "description" => $content[$lang],
                        "link" => $link[$lang],
                        "local" => $lang,
                    ]
                );
            }

            return redirect()->route('lastetproducts')->with('flash_message', 'Insert Data successfully');
        } else {
            $id = DB::table('least_products')->insertGetID(
                [
                    "bg_color" => $request->bg_color,
                    "status" => $status,
                    "text_color" => $request->text_color,
                    "title_color" => $request->title_color,
                    "product_id" => $request->productId,
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                ]
            );

            foreach ($lang_loop as $lang) {
                DB::table('least_products_translation')->insert(
                    [
                        "last_id" => $id,
                        "title" => $title[$lang],
                        "description" => $content[$lang],
                        "link" => $link[$lang],
                        "local" => $lang,
                    ]
                );
            }
            return redirect()->route('lastetproducts')->with('flash_message', 'Insert Data successfully');
        }

        return redirect()->route('lastetproducts')->with('error_message', 'Can not Insert Data successfully');
    }

    public function editLastest($id)
    {
        $language = DB::table('language')->get();
        $product  = DB::table('products as p')
        ->join('products_translation as pt', 'pt.product_id', '=', 'p.pro_id')
        ->where('pt.local', 'en')
        ->select('p.*')
        ->get();

        $last_products = DB::table('least_products as lp')
        ->join('least_products_translation as lpt', 'lp.id', '=', 'lpt.last_id')
        ->Leftjoin('products as p', 'p.pro_id', '=', 'lp.product_id')
        ->select('lp.*', 'lpt.*', 'p.pro_code')
        ->where('lp.id', $id)
        ->get();
        //    return dd($last_products);

        return  view('product.edit_lastpro')
        ->with('language', $language)
        ->with('lastId', $id)
        ->with('last_products', $last_products)
        ->with('product', $product)
        ->with('menu', "leatest_pro")
        ->with('name', "product");
    }
    public function deleteLastestPro(Request $request)
    {
        $itemId = $request->itemId;
        $last_products = DB::table('least_products as lp')
        ->select('lp.*')
        ->where('lp.id', $itemId)
        ->first();
        $image  =  $last_products->image;
        $file_pointer = base_path('/../medias/categories/').$image;
        if (file_exists($file_pointer) && $image != null) {
            unlink($file_pointer);
        }
        DB::table('least_products')->where('id', $itemId)->delete();
        DB::table('least_products_translation')->where('last_id', $itemId)->delete();
        return redirect()->route('lastetproducts')->with('flash_message', 'Delete Data successfully');
    }


    public function UpdateLastProduct(Request $request)
    {
        $productId = $request->productId;
        $status   = $request->status;
        $lang_loop  = $request->lang_loop;
        $title    = $request->title;
        $lastproId = $request->lastproId;
        $content  = $request->content;
        $link  = $request->link;
        if ($request->hasFile('thumbnail')) {
            $thumbnailImage = $request->file('thumbnail');
            $thumbnailName = uniqid() . "." . $thumbnailImage->getClientOriginalExtension();
            $thumbnailImage->move(base_path('/../medias/categories'), preg_replace('/\s+/', '', $thumbnailName));

            DB::table('least_products')->where('id', $lastproId)->update(
                [
                        "image" => $thumbnailName,
                        "bg_color" => $request->bg_color,
                        "status" => $status,
                        "text_color" => $request->text_color,
                        "title_color" => $request->title_color,
                        "product_id" => $request->productId,
                        "updated_at" => \Carbon\Carbon::now(),
                    ]
            );
            foreach ($lang_loop as $lang) {
                DB::table('least_products_translation')->where('last_id', $lastproId)->where('local', $lang)->update(
                    [
                     "title" => $title[$lang],
                     "description" => $content[$lang],
                     "link" => $link[$lang],
                     ]
                );
            }
            return redirect()->route('lastetproducts')->with('flash_message', 'Update Data successfully');

        } else {
            DB::table('least_products')->where('id', $lastproId)->update(
                [
                    "bg_color" => $request->bg_color,
                    "status" => $status,
                    "text_color" => $request->text_color,
                    "title_color" => $request->title_color,
                    "product_id" => $request->productId,
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                ]
            );
            foreach ($lang_loop as $lang) {
                $data =  DB::table('least_products_translation')->where('last_id', $lastproId)->where('local', $lang)->select('*')->get();
                if (count($data) == 1) {
                    DB::table('least_products_translation')->where('last_id', $lastproId)->where('local', $lang)->update(
                        [
                            "title" => $title[$lang],
                            "description" => $content[$lang],
                            "link" => $link[$lang],
                        ]
                    );
                } else {
                    DB::table('least_products_translation')->insert(
                        [
                            "last_id" => $lastproId,
                            "title" => $title[$lang],
                            "description" => $content[$lang],
                            "link" => $link[$lang],
                            "local" => $lang,
                        ]
                    );
                }
            }
            return redirect()->route('lastetproducts')->with('flash_message', 'Update Data successfully');
        }

        return redirect()->route('lastetproducts')->with('error_message', 'Can not Update Data successfully');

    }
    public function featureProduct()
    {

        $Allproducts = DB::table('products as p')
        ->join('products_translation as pt', 'pt.product_id', '=', 'p.pro_id')
        ->select('p.*', 'pt.*')
        ->where('pt.local', 'en')
        ->where('p.feature_product', '!=', 1)
        ->orderBy('p.created_at', 'desc')
        ->get();

        $products = DB::table('products as p')
        ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
        ->where('pt.local', 'en')
        ->where('p.feature_product', 1)
        ->select('p.*', 'pt.*')
        ->orderBy('p.created_at', 'desc')
        ->get();


        $subCategories = DB::table('sub_pro_categories as sc')
        ->join('sub_pro_categories_translation as sct', 'sct.sub_pro_id', '=', 'sc.sub_pro_id')
        ->where('sct.local', 'en')
        ->select('sc.*', 'sct.*')
        ->orderBy('sc.created_at', 'desc')
        ->get();


        $Allseries = DB::table('series as s')
        ->join('series_translations as st', 'st.series_id', '=', 's.se_id')
        ->where('st.local', 'en')
        ->where('s.status', 1)
        ->select('s.*', 'st.*')
        ->orderBy('order_seq', 'asc')
        ->get();

        $series = DB::table('least_series_product as ls')
        ->join('series as s', 's.se_id', '=', 'ls.series_id')
        ->join('series_translations as st', 'st.series_id', '=', 's.se_id')
        ->join('sub_pro_categories as sp', 'sp.sub_pro_id', '=', 'ls.cate_id')
        ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'sp.sub_pro_id')
        ->where('st.local', 'en')
        ->where('spt.local', 'en')
        ->where('s.status', 1)
        ->select('s.*', 'ls.*', 'st.title', 'sp.url_item', 'sp.sub_pro_id as cate_id', 'spt.name as cateName')
        ->orderBy('ls.order_seq', 'asc')
        ->get();

        return view('product.feature_products')
        ->with('name', 'Home')
        ->with('menu', 'featureProduct')
        ->with('subCategories', $subCategories)
        ->with('Allseries', $Allseries)
        ->with('series', $series)
        ->with('products', $products)
        ->with('Allproducts', $Allproducts);
    }
    public function setFeatureproducts(Request $request)
    {
        $id = $request->se_id;
        $cate = $request->cateId;
        DB::table('least_series_product')->insert(
            [
                "series_id" => $id,
                "cate_id" => $cate,
                "created_at" => \Carbon\Carbon::now(),
            ]
        );
        return back()->with('flash_message', 'Setting Data successfully');
    }
    public function unSetting($id)
    {
        DB::table('least_series_product')->where('id', $id)->delete();
        return back()->with('flash_message', 'UnSetting Data successfully');
    }
    public function ProductSelection()
    {
        $mainCategories = DB::table('main_pro_categories as mp')
            ->join('main_pro_categories_translations as mpt', 'mpt.main_pro_id', '=', 'mp.main_id')
            ->where('mpt.local', '=', 'en')
            ->select('mp.*', 'mpt.*')
            ->orderBy('mp.order_seq', 'asc')
            ->get();

        return view('product.productSection')
            ->with('name', 'Home')
            ->with('menu', 'ProductSection')
            ->with('mainCategories', $mainCategories);
    }

    public function update_order_seriesLeast(Request $request)
    {
        $HomeIds = array_filter(explode(",", $request->home_id));
        $HomeOrders = array_filter(explode(",", $request->home_order));
        foreach ($HomeIds as $HomeId => $value) {
            DB::table('least_series_product')->where('id', '=', $value)->update(['order_seq' => $HomeOrders[$HomeId]]);
        }
        return response()->json([
            'order' => $request->home_order
        ], 200);

    }
    public function update_order_productselect(Request $request)
    {
        // 新的排序
        $HomeIds = array_filter(explode(",", $request->home_id));
        // 舊的排序
        $HomeOrders = array_filter(explode(",", $request->home_order));

        foreach ($HomeIds as $HomeId => $value) {
            DB::table('main_pro_categories')->where('main_id', '=', $value)->update(['order_seq' => $HomeOrders[$HomeId]]);
        }
        return response()->json([
            'order' => $request->home_order
        ], 200);

    }
    public function updateProSection($id)
    {
        $mainCategory = DB::table('main_pro_categories as mp')
        ->where('mp.main_id', $id)
        ->select('mp.*')
        ->first();

        if (is_null($mainCategory)) {
            return response()->json([
                'data' =>  'Category not found',
                    ], 404);
        }

        if ($mainCategory->active == 1) {
            DB::table('main_pro_categories as mp')
                ->where('mp.main_id', $id)
                ->update(['active' => 0]);

            $status = "Hide";
        } else {
            DB::table('main_pro_categories as mp')
                ->where('mp.main_id', $id)
                ->update(['active' => 1]);

            $status = "Show";
        }


        return response()->json([
            'data' =>  $status,
                ], 200);
    }

    public function listexternal_link()
    {

        $list = DB::table('external_link as e')
        ->orderBy('e.created_at', 'desc')
        ->get();

        return view('product.external_link')
        ->with('menu', "external_link")
        ->with('list', $list)
        ->with('name', "product");
    }

    public function storeExternallink(Request $request)
    {

        $product = $request->relatePro;
        $striPro = implode(",", $product);
        $logoname = '';
        if ($request->hasFile('thumbnail')) {
            $thumbnailImage = $request->file('thumbnail');
            $thumbnailName = uniqid() . "." . $thumbnailImage->getClientOriginalExtension();
            $thumbnailImage->move(base_path('/../upload/thumbs/'), preg_replace('/\s+/', '', $thumbnailName));
            $logoname = $thumbnailName;
        }

        DB::table('external_link')->insert(
            [
                "name" => $request->name,
                "link" => $request->link,
                "logo" => $logoname,
                "products" => $striPro,
                "created_at" => \Carbon\Carbon::now(),
            ]
        );
        return redirect()->route('externallist')->with('flash_message', 'Save Data successfully');
    }
    public function updateExternalLink(Request $request)
    {

        $product = $request->relatePro;
        $striPro = implode(",", $product);
        $logoname = $request->oldfile;
        $id = $request->old_id;
        if ($request->hasFile('thumbnail')) {
            $thumbnailImage = $request->file('thumbnail');
            $thumbnailName = uniqid() . "." . $thumbnailImage->getClientOriginalExtension();
            $thumbnailImage->move(base_path('/../upload/thumbs/'), preg_replace('/\s+/', '', $thumbnailName));
            $logoname = $thumbnailName;
        }

        DB::table('external_link')->where('id', $id)->update(
            [
                "name" => $request->name,
                "link" => $request->link,
                "logo" => $logoname,
                "products" => $striPro,
            ]
        );
        return redirect()->route('externallist')->with('flash_message', 'Update Data successfully');
    }
    public function editExternallink($id)
    {
        $item = DB::table('external_link as e')
         ->select('e.*')
         ->where('e.id', $id)
         ->first();
        $arrProduct = explode(",", $item->products);
        $products  = DB::table('products as p')
        ->join('products_translation as pt', 'pt.product_id', '=', 'p.pro_id')
        ->where('pt.local', 'en')
        ->orderBy('p.created_at', 'desc')
        ->select('p.*')
        ->get();
        return view('product.edit_external')
         ->with('item', $item)
         ->with('arrProduct', $arrProduct)
         ->with('products', $products)
         ->with('menu', "external_link")
         ->with('name', "product");
    }

    public function createExternallist()
    {
        $products  = DB::table('products as p')
        ->join('products_translation as pt', 'pt.product_id', '=', 'p.pro_id')
        ->where('pt.local', 'en')
        ->orderBy('p.created_at', 'desc')
        ->select('p.*')
        ->get();
        return view('product.create_external')
        ->with('products', $products)
        ->with('menu', "external_link")
        ->with('name', "product");
    }
    public function deleteExternallink(Request $request)
    {
        $itemId = $request->itemId;
        $links = DB::table('external_link as e')
       ->select('e.*')
       ->where('e.id', $itemId)
       ->first();
        $image  =  $links->logo;
        $file_pointer = base_path('/../upload/thumbs/').$image;
        if (file_exists($file_pointer) && $image != null) {
            unlink($file_pointer);
        }
        DB::table('external_link')->where('id', $itemId)->delete();
        return redirect()->route('externallist')->with('flash_message', 'Delete Data successfully');
    }

    // EC Link Methods
    public function listEcLink()
    {
        $list = DB::table('custom_product_button')
        ->orderBy('created_at', 'desc')
        ->get();

        // Get product codes for each EC Link
        foreach ($list as $item) {
            if ($item->products) {
                $productIds = explode(',', $item->products);
                $productCodes = DB::table('products')
                    ->whereIn('pro_id', $productIds)
                    ->pluck('pro_code')
                    ->toArray();
                $item->product_names = implode(', ', $productCodes);
            } else {
                $item->product_names = '';
            }
        }

        return view('product.ec_link')
        ->with('menu', "ec_link")
        ->with('list', $list)
        ->with('name', "product");
    }

    public function createEcLink()
    {
        $language = DB::table('language')->get();
        $products  = DB::table('products as p')
        ->join('products_translation as pt', 'pt.product_id', '=', 'p.pro_id')
        ->where('pt.local', 'en')
        ->orderBy('p.created_at', 'desc')
        ->select('p.*')
        ->get();
        return view('product.create_ec_link')
        ->with('products', $products)
        ->with('language', $language)
        ->with('menu', "ec_link")
        ->with('name', "product");
    }

    public function storeEcLink(Request $request)
    {
        $product = $request->relatePro;
        $striPro = implode(",", $product);

        DB::table('custom_product_button')->insert(
            [
                "name" => $request->name,
                "local" => $request->language,
                "note" => $request->note,
                "link" => $request->link,
                "products" => $striPro,
                "status" => $request->status ?? 1,
                "created_at" => now(),
                "updated_at" => now(),
            ]
        );

        return redirect()->route('eclinklist')->with('flash_message', 'Create Data successfully');
    }

    public function editEcLink($id)
    {
        $item = DB::table('custom_product_button')
         ->where('id', $id)
         ->first();

        $arrProduct = explode(",", $item->products);
        $language = DB::table('language')->get();
        $products  = DB::table('products as p')
            ->join('products_translation as pt', 'pt.product_id', '=', 'p.pro_id')
            ->where('pt.local', 'en')
            ->orderBy('p.created_at', 'desc')
            ->select('p.*')
            ->get();

        return view('product.edit_ec_link')
            ->with('item', $item)
            ->with('language', $language)
            ->with('arrProduct', $arrProduct)
            ->with('products', $products)
            ->with('menu', "ec_link")
            ->with('name', "product");
    }

    public function updateEcLink(Request $request)
    {
        $id = $request->old_id;
        $product = $request->relatePro;
        $striPro = implode(",", $product);

        DB::table('custom_product_button')->where('id', $id)->update(
            [
                "name" => $request->name,
                "local" => $request->language,
                "note" => $request->note,
                "link" => $request->link,
                "products" => $striPro,
                "status" => $request->status ?? 1,
                "updated_at" => now(),
            ]
        );

        return redirect()->route('eclinklist')->with('flash_message', 'Update Data successfully');
    }

    public function deleteEcLink($id)
    {
        DB::table('custom_product_button')->where('id', $id)->delete();
        return redirect()->route('eclinklist')->with('flash_message', 'Delete Data successfully');
    }

}
