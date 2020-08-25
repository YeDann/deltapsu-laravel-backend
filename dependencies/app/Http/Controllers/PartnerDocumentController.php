<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Validator;

class PartnerDocumentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id ,$name){
        $sales_kits = DB::table('partner_documents as s')
        ->join('partner_documents_translations as st', 's.id', '=', 'st.sk_fk_id')
        ->where('st.local' ,'en')
        ->where('s.type_info' ,$id)
        ->select('s.*', 'st.*')
        ->get();
        if($id == 1){
           $name = 'Sales_Kits';
        }else{
          $name  = 'Product_Cross_Reference';
        }
        return view('partners.sales_Kits')
        ->with('name', 'partnersAuthenicate')
        ->with('sales_kits',$sales_kits)
        ->with('type_id',$id)
        ->with('type_name',$name)
        ->with('menu',  $name);
    }
    public function create($type_id ,$type_name){
        $language = DB::table('language')->get();
        if($type_id == 1){
            $name = 'Sales_Kits';
         }else{
           $name  = 'Product_Cross_Reference';
         }
        return view('partners.sale_kits_create')
        ->with('name', 'partnersAuthenicate')
        ->with('language',$language)
        ->with('type_id',$type_id)
        ->with('type_name',$type_name)
        ->with('menu',$name);
    }
    public function edit($id ,$type_id ,$type_name){
        // return dd($id);
        $language = DB::table('language')->get();
        $sales_kits = DB::table('partner_documents as s')
        ->join('partner_documents_translations as st', 's.id', '=', 'st.sk_fk_id')
        ->where('s.id' ,$id)
        ->select('s.*', 'st.*')
        ->get();
        if($type_id == 1){
            $name = 'Sales_Kits';
         }else{
           $name  = 'Product_Cross_Reference';
         }
        return view('partners.sale_kits_edit')
        ->with('name', 'partnersAuthenicate')
        ->with('sales_kits', $sales_kits)
        ->with('language',$language)
        ->with('type_id',$type_id)
        ->with('type_name',$type_name)
        ->with('menu', $name);
    }
    public function store(Request $request){
         $langs = $request->langloop;
         $name = $request->name;
         $filesale = $request->filesale;
         $date = $request->date;
         $typeId = $request->typeId;
         $typeName = $request->typeName;
         if(isset($filesale)){
            $fileName = preg_replace('/\s+/', '', uniqid().$filesale->getClientOriginalName());
            $filesale->move(base_path('/../medias/marketing_resources'),$fileName);
            
         }else{
            $fileName = '';
         }
       
            $id = DB::table('partner_documents')->insertGetID(
                [
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "date_info" => $date,
                    "type_name" => $typeName,
                    "type_info" => $typeId,
                ]
            );
            foreach($langs as $lang){
                DB::table('partner_documents_translations')->insert(
                    [   "sk_fk_id"=>$id,
                        "name" => $name,
                        "file" => $fileName,
                        "local" => $lang,
                    ]
                );
            }
            return redirect()->route('partner_doc_index' ,[$typeId ,$typeName ])->with('flash_message', 'Insert Data successfully');
    }
    private function UpdateOldfile($loopfile ,$loop ,$oldfile){
        
        $arrayfileName = [];
           
            foreach($loop as $lang){
         
                $emptyornot = isset($loopfile[$lang]);
                // return dd($emptyornot);
    
                if($emptyornot){
                         $fileName[$lang] = preg_replace('/\s+/', '', uniqid().$loopfile[$lang]->getClientOriginalName());
                         $loopfile[$lang]->move(base_path('/../medias/marketing_resources'),$fileName[$lang]);
                         $arrayfileName[$lang] = $fileName[$lang];
                     
                }else{
                    $arrayfileName[$lang] = $oldfile[$lang];
                }
            }
        
          
       return $arrayfileName;
    }
    public function update(Request $request){
        $id = $request->update_id;
        $langs = $request->langloop;
        $name = $request->name;
        $filesale = $request->filesale;
        $date = $request->date;
        $oldfile = $request->oldfile;
        $typeId = $request->typeId;
        $typeName = $request->typeName;
        DB::table('partner_documents')->where('id',$id)->update(
            [
                "updated_at" => \Carbon\Carbon::now(),
                "date_info" => $date,
            ]
        );
        $arrayfileName = self::UpdateOldfile($filesale ,$langs ,$oldfile);
        // return dd($arrayfileName);
        foreach($langs as $lang){
            DB::table('partner_documents_translations')->where('local' ,$lang)->where('sk_fk_id' ,$id)->update(
                [
                    "name" => $name[$lang],
                    "file" =>  $arrayfileName[$lang],
                ]
            );
        }
        return redirect()->route('partner_doc_index' ,[$typeId ,$typeName ])->with('flash_message', 'Update Data successfully');
    }
    public function deleteSaleKit(Request $request){

       $id = $request->itemId;
       $typeId = $request->typeId;
       $typeName = $request->typeName;
       DB::table('partner_documents')->where('id', $id)->delete();
       DB::table('partner_documents_translations')->where('sk_fk_id', $id)->delete();
       return redirect()->route('partner_doc_index' ,[$typeId ,$typeName ])->with('flash_message', 'Delete Data successfully');
    }
}
?>