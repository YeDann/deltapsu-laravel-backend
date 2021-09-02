<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Validator;

class ContinentsController extends Controller
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
    public function index($id)
    {
        $userdata = auth()->user();
        if($userdata->lang == 'All'){
         $continents = DB::table('continents as c')
            ->join('continents_translations as ct', 'c.id', '=', 'ct.cont_id')
            ->where('type_id' ,$id)
            ->where('ct.local', '=', 'en')
            ->orderBy('c.order_seq','asc')
            ->select('c.*' ,'ct.*')
            ->get();
        }else{
            $continents = DB::table('continents as c')
            ->join('continents_translations as ct', 'c.id', '=', 'ct.cont_id')
            ->where('type_id' ,$id)
            ->where('ct.local',$userdata->lang)
            ->orderBy('c.order_seq','asc')
            ->select('c.*' ,'ct.*')
            ->get();
        }
       
        if($id == 1){
            $name = "sales_offices";
            $subname = 'continents_type1';
        }else if($id == 2){
            $name = "distributors";
            $subname = 'continents_type2';
        }
       
        return view('continents.index')
            ->with('name', 'contact_us')
            ->with('submenu', $subname)
            ->with('menu', $name)
            ->with('type_id', $id)
            ->with('continents', $continents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $language = DB::table('language')->get();

        if($id == 1){
            $name = "sales_offices";
            $subname = 'continents_type1';
        }else if($id == 2){
            $name = "distributors";
            $subname = 'continents_type2';
        }

        return view('continents.create')
        ->with('name', 'contact_us')
        ->with('submenu', $subname)
        ->with('menu', $name)
        ->with('type_id', $id)
        ->with('language', $language);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $langs  = $request->lang_loop;
        $type_id = $request->type_id;
        $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        // return dd($validate->fails());
        if ($validate->fails()) {
        
            return redirect()->back()->withErrors($validate->errors());
        } else {
            $id = DB::table('continents')->insertGetID(
                [
                    "type_id" => $type_id,
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                ]
            );
                foreach($langs as $lang){
                     DB::table('continents_translations')->insert(
                        [   
                            "cont_id" => $id,
                            "name" => $request->name,
                            "local" => $lang,
                        ]
                    );
                }
                return redirect()->route('getContinent',$type_id)->with('flash_message', 'Insert Data successfully');
        }
        
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id ,$type_id)
    {
        $userdata = auth()->user();
        if($userdata->lang == 'All'){
        $continents = DB::table('continents as c')
        ->join('continents_translations as ct', 'c.id', '=', 'ct.cont_id')
        ->where('id' ,$id)
        ->where('type_id' ,$type_id)
        ->select('c.*' ,'ct.*')
        ->get();
        }else{
            $continents = DB::table('continents as c')
            ->join('continents_translations as ct', 'c.id', '=', 'ct.cont_id')
            ->where('id' ,$id)
            ->where('ct.local',$userdata->lang)
            ->where('type_id' ,$type_id)
            ->select('c.*' ,'ct.*')
            ->get();
        }

        $language = DB::table('language')->get();

        if($type_id == 1){
            $name = "sales_offices";
            $subname = 'continents_type1';
        }else if($type_id == 2){
            $name = "distributors";
            $subname = 'continents_type2';
        }

        return view('continents.edit')
            ->with('name', 'contact_us')
            ->with('submenu', $subname)
            ->with('menu', $name)
            ->with('type_id', $type_id)
            ->with('continents', $continents)
            ->with('language', $language);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $langs  = $request->lang_loop;
        $id = $request->con_id;
        $name = $request->name;
        $type_id = $request->type_id;
       
        $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        // return dd($validate->fails());
        if ($validate->fails()) {
        
            return redirect()->back()->withErrors($validate->errors());
        } else {
           DB::table('continents')->where('id',$id)->update(
                [
                    "updated_at" => \Carbon\Carbon::now(),
                ]
            );
                foreach($langs as $lang){
                    $data =   DB::table('continents_translations')->where('local', $lang)->where('cont_id',$id)->get();
                    if(count($data) > 0){
                        DB::table('continents_translations')->where('local', $lang)->where('cont_id',$id)->update(
                            [   
                                "name" => $name[$lang],
                            ]
                        );
                    }else{
                        DB::table('continents_translations')->insert(
                            [   
                                'cont_id'=> $id,
                                "name" => $name[$lang],
                                "local"=> $lang
                            ]
                        );
                    }
                  
                }
                return redirect()->route('getContinent',$type_id)->with('flash_message', 'Update Data successfully');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->itemId;
        $offices = DB::table('office as f')
            ->join('office_translations as oft', 'f.id', '=', 'oft.fk_office_id')
            ->where('continent_id' ,$id)
            ->where('oft.local', '=', 'en')
            ->select('f.*' ,'oft.*')
            ->get();
        if(count($offices) != 0){
            foreach($offices as $item){
                DB::table('office')->where('id',$item->id)->delete();
                DB::table('office_translations')->where('fk_office_id', '=',$item->id)->delete();
            }
        }

        DB::table('continents')->where('id',$id)->delete();
        DB::table('continents_translations')->where('cont_id', '=', $id)->delete();
    
        return back()->with('flash_message', 'Delete Data successfully');
    }

    public function update_order_Continent(Request $request){
        $HomeIds = array_filter(explode(",", $request->home_id));
        $HomeOrders = array_filter(explode(",", $request->home_order));
        foreach ($HomeIds as $HomeId => $value){
             DB::table('continents')->where('id', '=', $value)->update(['order_seq'=>$HomeOrders[$HomeId]]);
        }
        return response()->json([
            'order' => $request->home_order
        ],200);
        
    }

}
