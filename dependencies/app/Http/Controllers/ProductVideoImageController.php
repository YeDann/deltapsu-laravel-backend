<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Validator;

class ProductVideoImageController extends Controller
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

        $vieo_img = DB::table('product_image as pm')
        ->where('pm.pro_id' ,$id)
        ->select('pm.*')
        ->orderBy('pm.order_seq' ,'asc')
        ->get();

        return view('product.video_image_pro')
        ->with('menu', "products")
        ->with('products', $products)
        ->with('vieo_img', $vieo_img)
        ->with('name', "product");
    }
    public function SaveVideoPro(Request $request){
        $pro_image_id = $request->pro_image_id;
        $pro_id   = $request->pro_id;
        if($pro_image_id == null ){
            DB::table('product_image')->insert([
                'pro_id' => $request->pro_id,
                'content' => $request->newlink,
                'type' => $request->type,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]);
            return redirect()->route('videos_images',$pro_id)->with('flash_message', 'Insert Data successfully');
        }else{
            DB::table('product_image')->where('id' ,$pro_image_id)->update([
                'content' => $request->newlink,
                'type' => $request->type,
                "updated_at" => \Carbon\Carbon::now(),
            ]);
            return redirect()->route('videos_images',$pro_id)->with('flash_message', 'Update Data successfully');
        }
    }
    public function SaveImagePro(Request $request){
        $imageNameSpace = '';
        $oldImage = $request->oldImage;
        $pro_id   = $request->pro_id;
        if ($request->hasFile("thumbnail")) {
            $imageFile = $request->file("thumbnail");
            $imageName = uniqid().$imageFile->getClientOriginalName();
            $imageNameSpace =  preg_replace('/\s+/', '', $imageName);
            $imageFile->move(base_path('/../uploads_delta'), preg_replace('/\s+/', '', $imageName));
        }else{
            if($oldImage != null){
                $imageNameSpace = $oldImage;
            }
        }
        

        $pro_image_id = $request->pro_image_id;
        if($pro_image_id == null){
            DB::table('product_image')->insert([
                'pro_id' => $request->pro_id,
                'content' => $imageNameSpace,
                'type' => $request->type,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]);
            return redirect()->route('videos_images',$pro_id)->with('flash_message', 'Insert Data successfully');
        }else{
            DB::table('product_image')->where('id' ,$pro_image_id)->update([
                'content' => $imageNameSpace,
                'type' => $request->type,
                "updated_at" => \Carbon\Carbon::now(),
            ]);
            return redirect()->route('videos_images',$pro_id)->with('flash_message', 'Update Data successfully');
        }

    }
    public function getProImageContent(Request $request){
        $id = $request->content_id;
        $proimage = DB::table('product_image')->where('id' ,$id)->first();
        return response()->json([
            'data' => $proimage,
         ], 200);

    }
    public function deleteVideImagePro(Request $request){
        $id  = $request->itemId;
        $pro_id   = $request->pro_id;
        $proimage = DB::table('product_image')->where('id' ,$id)->first();
       
        if($proimage->type == 1){
            $file_pointer = base_path('/../uploads_delta/').$proimage->content;
            if (file_exists($file_pointer) && isset($proimage->content) ) {
                unlink($file_pointer);
                DB::table('product_image')->where('id' ,$id)->delete();
                return redirect()->route('videos_images',$pro_id)->with('flash_message', 'Delete Data successfully');
            }

        }else{
            DB::table('product_image')->where('id' ,$id)->delete();
            return redirect()->route('videos_images',$pro_id)->with('flash_message', 'Delete Data successfully');
        }

        return redirect()->route('videos_images',$pro_id)->with('error_message', 'Can not delete');

    }


}
?>