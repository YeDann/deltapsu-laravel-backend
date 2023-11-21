<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Validator;

class OptionalModelController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id){
        $products = DB::table('products as p')
        ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
        ->where('pt.local' ,'en')
        ->where('p.pro_id' ,$id)
        ->select('p.*', 'pt.*')
        ->orderBy('pt.showstatus' ,'desc')
        ->orderBy('p.created_at', 'desc')
        ->get();

        $optional_models = DB::table('product_optional_model as po')
        ->where('po.product_id' ,$id)
        ->select('po.*')
        ->get();

        return view('product.optional_model')
        ->with('menu', "products")
        ->with('products', $products)
        ->with('pro_id', $id)
        ->with('optional_models', $optional_models)
        ->with('name', "product");
    }
    public function saveOptionalModel(Request $request){
        $id = $request->id;
        $pro_id = $request->pro_id;
        $modelName = $request->modelName;
        $remark   = $request->remark;
        DB::table('product_optional_model')->where('id',$id)->update(
            [
                "optional_model" => $modelName,
                "remark" => $remark,
            ]
        );
        return redirect()->route('optional_models',$pro_id)->with('flash_message', 'Update Data successfully');
    }

 



}
?>