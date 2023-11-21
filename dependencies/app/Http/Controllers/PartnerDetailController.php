<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Validator;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;
class PartnerDetailController extends Controller
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
    public function pro_lauch()
    {
        $pro_launch_sche = DB::table('product_launch_schedule as pls')
            ->select('pls.*')
            ->get();
        return view('partners.pro_launch_index')
            ->with('name', 'partnersAuthenicate')
            ->with('pro_launch_sche', $pro_launch_sche)
            ->with('menu', 'proLaunchSchedule');
    }
    public function pro_lauch_create(){
        return view('partners.pro_launch_create')
            ->with('name', 'partnersAuthenicate')
            ->with('menu', 'proLaunchSchedule');
    }
    public function pro_lauch_store(Request $request){
        $id = DB::table('product_launch_schedule')->insertGetID(
            [
                "title" =>  $request->title,
                "date" => $request->date,
            ]
        );
        return redirect()->route('pro_lauch')->with('flash_message', 'Insert Data successfully');
    }
    public function pro_lauch_edit($id){
        $pro_launch_sche = DB::table('product_launch_schedule as pls')
        ->select('pls.*')
        ->where('pls.pl_id',$id)
        ->get();
        return view('partners.pro_launch_edit')
            ->with('name', 'partnersAuthenicate')
            ->with('pro_launch_sche', $pro_launch_sche)
            ->with('menu', 'proLaunchSchedule');

        }
    public function pro_lauch_update(Request $request){
        $pl_id = $request->pl_id;
        DB::table('product_launch_schedule')->where('pl_id', $pl_id)->update(
            [
                "title" =>  $request->title,
                "date" => $request->date,
            ]
        );
        return redirect()->route('pro_lauch')->with('flash_message', 'Insert Data successfully');
    }
    public function prolaunchDestroy(Request $request){
        $itemid = $request->itemId;
        DB::table('product_launch_schedule')->where('pl_id', $itemid)->delete();
        return redirect()->route('pro_lauch')->with('flash_message', 'Delete Data successfully');
    }
    public function schedules_month($id){
        $pro_launch_sche_mo = DB::table('product_launch_schedule_month as plsm')
        ->select('plsm.*')
        ->where('plsm.pl_fk_id' ,$id)
        ->get();
        return view('partners.schedule')
        ->with('name', 'partnersAuthenicate')
        ->with('headId', $id)
        ->with('pro_launch_sche_mo', $pro_launch_sche_mo)
        ->with('menu', 'proLaunchSchedule');
    }
    public function edit_schedule($id){
        $pro_launch_sche_mo = DB::table('product_launch_schedule_month as plsm')
        ->select('plsm.*')
        ->where('plsm.pl_m_id' ,$id)
        ->first();
        return response()->json([
            'data' =>  $pro_launch_sche_mo,
                ], 200);
    }
    public function store_schedule(Request $request){
          $headId = $request->pl_fk_id;
        //   return dd($request->date);
            $id = DB::table('product_launch_schedule_month')->insertGetID(
                [
                    "month" => $request->date,
                    "pl_fk_id" => $request->pl_fk_id,
                ]
            );
        return redirect()->route('schedules_month', $headId )->with('flash_message', 'Insert Data successfully');
    }

    public function scheduleUpdate(Request $request){
     
         $headId = $request->pl_fk_id;
         $id = $request->pl_m_id;
        //  return dd($id);
        DB::table('product_launch_schedule_month')->where('pl_m_id',$id)->update(
              [
                  "month" => $request->date,
                  "pl_fk_id" => $request->pl_fk_id,
              ]
          );
      return redirect()->route('schedules_month', $headId )->with('flash_message', 'Update Data successfully');
  }

  public function scheduleDelete(Request $request){
    $headId = $request->pl_fk_id;
    $id = $request->itemId;
    DB::table('product_launch_schedule_month')->where('pl_m_id',$id)->delete();
    return redirect()->route('schedules_month', $headId )->with('flash_message', 'Delete Data successfully');
  }
  public function launch_datail($id){
    $relate_pro_launch_schedule = DB::table('relate_pro_launch_schedule as rpls')
    ->join('relate_pro_launch_schedule_translation as rplst' ,'rplst.fk_relate_pl' ,'=' ,'rpls.re_id')
    ->select('rpls.*' ,'rplst.*')
    ->where('rpls.fk_pl' ,$id)
    ->where('rplst.local' ,'en')
    ->get();

    $mainid = DB::table('product_launch_schedule_month as  plsm')
    ->select('plsm.*')
    ->where('plsm.pl_m_id',$id)
    ->get();

      return view('partners.product_launch_detail')
      ->with('name', 'partnersAuthenicate')
      ->with('headId', $id)
      ->with('mainid', $mainid)
      ->with('relate_pro_launch_schedule', $relate_pro_launch_schedule)
      ->with('menu', 'proLaunchSchedule');
  }
  public function launch_datail_create($id){
  
    $language = DB::table('language')->get();
    return view('partners.product_launch_detail_create')
    ->with('name', 'partnersAuthenicate')
    ->with('headId', $id)
    ->with('language', $language)
    ->with('menu', 'proLaunchSchedule');
}

public function pro_lauch_DetailEdit($headid ,$id){
  
    $language = DB::table('language')->get();
    $relate_pro_launch_schedule = DB::table('relate_pro_launch_schedule as rpls')
    ->join('relate_pro_launch_schedule_translation as rplst' ,'rplst.fk_relate_pl' ,'=' ,'rpls.re_id')
    ->select('rpls.*' ,'rplst.*')
    ->where('rpls.re_id' ,$id)
    ->get();

    // return dd($relate_pro_launch_schedule);
    return view('partners.product_launch_detail_edit')
    ->with('name', 'partnersAuthenicate')
    ->with('headId', $headid)
    ->with('language', $language)
    ->with('relate_pro_launch_schedule', $relate_pro_launch_schedule)
    ->with('menu', 'proLaunchSchedule');
}
  public function store_launch_datail(Request $request){
          $headId = $request->headId;
          $langs  = $request->langloop;
           $file =  $request->file;
          if(isset($file)){
            $fileName = preg_replace('/\s+/', '', uniqid().$file->getClientOriginalName());
            $file->move(base_path('/../medias/partner/marketing_resources'),$fileName);
          }else{
            $fileName = '';
          }
          $id = DB::table('relate_pro_launch_schedule')->insertGetID(
            [
                "fk_pl" => $headId,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]
         );

         foreach($langs as $lang){
            DB::table('relate_pro_launch_schedule_translation')->insert(
                [
                    "fk_relate_pl" => $id,
                    "modelname" => $request->modelname,
                    "op_voltage" => $request->op_voltage,
                    "op_wattage" => $request->op_wattage,
                    "phase" => $request->phase,
                    "remark" => $request->remark,
                    "file" =>  $fileName,
                    "local" => $lang,

                ]
             );
         }
    return redirect()->route('launch_datail', $headId)->with('flash_message', 'Insert Data successfully');
  }

  private function UpdateOldfile($loopfile ,$loop ,$oldfile){
        
    $arrayfileName = [];
       
        foreach($loop as $lang){
     
            $emptyornot = isset($loopfile[$lang]);
            // return dd($emptyornot);

            if($emptyornot){
                     $fileName[$lang] = preg_replace('/\s+/', '', uniqid().$loopfile[$lang]->getClientOriginalName());
                     $loopfile[$lang]->move(base_path('/../medias/partner/marketing_resources'),$fileName[$lang]);
                     $arrayfileName[$lang] = $fileName[$lang];
                 
            }else{
                $arrayfileName[$lang] = $oldfile[$lang];
            }
        }
    
      
   return $arrayfileName;
}
  public function update_launch_datail(Request $request){
   
       $id  = $request->pro_detail_id;

      $headId = $request->headId;
      $langs  = $request->langloop;
      $modelname = $request->modelname;
      $op_voltage  = $request->op_voltage;
      $op_wattage = $request->op_wattage;
      $phase  = $request->phase;
      $remark  = $request->remark;
      $oldfile = $request->oldfile;
      $file =  $request->filepro;
    //   return dd($file);
      DB::table('relate_pro_launch_schedule')->where('re_id' ,$id)->update(
        [
            "updated_at" => \Carbon\Carbon::now(),
        ]
     );
     $arrayfileName = self::UpdateOldfile($file ,$langs ,$oldfile);
    //  return dd($arrayfileName);
     foreach($langs as $lang){
        DB::table('relate_pro_launch_schedule_translation')->where('local' ,$lang)->where('fk_relate_pl' ,$id)->update(
            [
                "modelname" => $modelname[$lang],
                "op_voltage" => $op_voltage[$lang],
                "op_wattage" => $op_wattage[$lang],
                "phase" => $phase[$lang],
                "remark" => $remark[$lang],
                "file" =>  $arrayfileName[$lang],
            ]
         );
     }
     return redirect()->route('launch_datail', $headId)->with('flash_message', 'Update Data successfully');
      


  }

  public function prolaunchdetailDelete(Request $request){

    $headId = $request->headId;
    $id = $request->itemId;
    DB::table('relate_pro_launch_schedule')->where('fk_pl',$id)->delete();
    DB::table('relate_pro_launch_schedule_translation')->where('fk_relate_pl',$id)->delete();
    return redirect()->route('launch_datail', $headId )->with('flash_message', 'Delete Data successfully');

  }

    

}