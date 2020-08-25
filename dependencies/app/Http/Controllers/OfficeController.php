<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Validator;

class OfficeController extends Controller
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
    public function index($conid ,$type_id)
    {

         $continents = DB::table('continents as c')
            ->join('continents_translations as ct', 'c.id', '=', 'ct.cont_id')
            ->where('type_id' ,$type_id)
            ->where('ct.local', '=', 'en')
            ->select('c.*' ,'ct.*')
            ->orderBy('c.created_at','desc')
            ->get();

         $offices = DB::table('office as f')
            ->join('office_translations as oft', 'f.id', '=', 'oft.fk_office_id')
            ->where('continent_id' ,$conid)
            ->where('oft.local', '=', 'en')
            ->select('f.*' ,'oft.*')
            ->orderBy('f.created_at','desc')
            ->get();
        
       
        if($type_id == 1){
            $name = "sales_offices";
            $subname = 'continents_type1';
        }else if($type_id == 2){
            $name = "distributors";
            $subname = 'continents_type2';
        }
       
        return view('office.index')
            ->with('name', 'contact_us')
            ->with('submenu', $subname)
            ->with('menu', $name)
            ->with('type_id', $type_id)
            ->with('conid', $conid)
            ->with('offices', $offices)
            ->with('continents', $continents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($conid ,$type_id)
    {
        $language = DB::table('language')->get();

        if($type_id == 1){
            $name = "sales_offices";
            $subname = 'continents_type1';
        }else if($type_id == 2){
            $name = "distributors";
            $subname = 'continents_type2';
        }

        return view('office.create')
        ->with('name', 'contact_us')
        ->with('submenu', $subname)
        ->with('menu', $name)
        ->with('type_id', $type_id)
        ->with('conid', $conid)
        ->with('language', $language);
    }
     private function fileformat($file){
          $string = '';
      if(isset($file) && is_file($file)){
        $filename = str_replace('.'.$file->getClientOriginalExtension(),"",$file->getClientOriginalName());
        $string   =  $filename.uniqid().'.'.$file->getClientOriginalExtension();
      }
      return $string;
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
        $con_id  = $request->con_id;
        $lat = $request->lat;
        $lon  = $request->lon;
        $filecer  = $request->filecer;
        // return dd($filecer);
        $subfile = '';
        if ($request->hasFile("filecer")) {
            $File = $request->file("filecer");
            $fileName = self::fileformat($File);
            $subfile  = preg_replace('/\s+/', '', $fileName);
            $File->move(base_path('/../medias/distributor'),$subfile);
        }

        $validate = Validator::make($request->all(), [
            'title' => 'required',
        ]);
        // return dd($validate->fails());
        if ($validate->fails()) {
        
            return redirect()->back()->withErrors($validate->errors());
        } else {
            $id = DB::table('office')->insertGetID(
                [
                    "type_id" => $type_id,
                    "continent_id" => $con_id,
                    "status" => $request->status,
                    "lat" => $request->lat,
                    "lon" => $request->lon,
                    "file_cer" => $subfile,
                    "status_cer"=>$request->status_cer,
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                ]
            );
                foreach($langs as $lang){
                     DB::table('office_translations')->insert(
                        [   
                            "fk_office_id" => $id,
                            "title" => $request->title,
                            "sub_title" => $request->sub_title,
                            "content" => $request->content,
                            "local" => $lang,
                        ]
                    );
                }
                return redirect()->route('getOffices',[$con_id,$type_id ] )->with('flash_message', 'Insert Data successfully');
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
    public function edit($id,$conid ,$type_id)
    {
        $offices = DB::table('office as f')
        ->join('office_translations as oft', 'f.id', '=', 'oft.fk_office_id')
        ->where('id' ,$id)
        ->select('f.*' ,'oft.*')
        ->get();

        $language = DB::table('language')->get();

        if($type_id == 1){
            $name = "sales_offices";
            $subname = 'continents_type1';
        }else if($type_id == 2){
            $name = "distributors";
            $subname = 'continents_type2';
        }

        return view('office.edit')
            ->with('name', 'contact_us')
            ->with('submenu', $subname)
            ->with('menu', $name)
            ->with('type_id', $type_id)
            ->with('conid', $conid)
            ->with('offices', $offices)
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
        $id = $request->f_id;
        $con_id = $request->con_id;
        $name = $request->name;
        $type_id = $request->type_id;
        $title = $request->title;
        $sub_title = $request->sub_title;
        $content = $request->content;
        $lat = $request->lat;
        $lon  = $request->lon;
        $oldfileCer = $request->oldfileCer;
        $subfile = '';
        if($oldfileCer != null && $request->hasFile("filecer") ){
            $File = $request->file("filecer");
            $subfile  = preg_replace('/\s+/', '', self::fileformat($File));
            $File->move(base_path('/../medias/distributor'), $subfile);
        }else if($oldfileCer == null  && $request->hasFile("filecer")){
            $File = $request->file("filecer");
            $subfile  = preg_replace('/\s+/', '', self::fileformat($File));
            $File->move(base_path('/../medias/distributor'), $subfile);
        }else if($oldfileCer != null ){
            $subfile =  $oldfileCer;
        }

        $validate = Validator::make($request->all(), [
            'title' => 'required',
        ]);
        // return dd($validate->fails());
        if ($validate->fails()) {
        
            return redirect()->back()->withErrors($validate->errors());
        } else {
           DB::table('office')->where('id',$id)->update(
                [
                    "status" => $request->status,
                    "lat" => $request->lat,
                    "lon" => $request->lon,
                    "status_cer"=> $request->status_cer,
                    "file_cer" => $subfile,
                    "updated_at" => \Carbon\Carbon::now(),
                ]
            );
                foreach($langs as $lang){
                    $data =  DB::table('office_translations')->where('local', $lang)->where('fk_office_id',$id)->get();
                    if(count($data) > 0){
                        DB::table('office_translations')->where('local', $lang)->where('fk_office_id',$id)->update(
                            [   
                                "title" => $title[$lang],
                                "sub_title" => $sub_title[$lang],
                                "content" => $content[$lang],
                            ]
                        );
                    }else{
                        DB::table('office_translations')->insert(
                            [   
                                "fk_office_id" => $id,
                                "title" => $title[$lang],
                                "sub_title" => $sub_title[$lang],
                                "content" => $content[$lang],
                                "local" => $lang,
                            ]
                        );
                    }
                   
                }
                return redirect()->route('getOffices',[$con_id,$type_id ])->with('flash_message', 'Update Data successfully');
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
        DB::table('office')->where('id',$id)->delete();
        DB::table('office_translations')->where('fk_office_id', '=', $id)->delete();
        return back()->with('flash_message', 'Delete Data successfully');
    }
    public function removefileCerDis($conid){
        DB::table('office')->where('id',$conid)->update(
            [
                "file_cer" => null,
                "status_cer"=> 0,
            ]
        );
        return back()->with('flash_message', 'Remove file Data successfully');
    }

}
