<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Excel;
use File;
class SubscribeController extends Controller
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
        $subscribes = DB::table('subscribes as s')
        ->select('s.*')
        ->orderBy('s.created_at','desc')
        ->get();
        return view('subscribes.index')
        ->with('name','subscribe')
        ->with('menu','')
        ->with('subscribes',$subscribes);
    }
    public function exportSubscribes(){

        $subscribes = DB::table('subscribes as s')
        ->select('s.*')
        ->get();

        if(isset($subscribes)){
            Excel::create('Subscribes', function ($excel) use ($subscribes) {
              $excel->sheet('Subscribes', function ($sheet) use ($subscribes) {
                  $sheet->row(1,[
                      'No',
                      'Email',
                      'CountryName',
                      'Name',
                      'Accept Privacy Policy',
                      'Created_at'
                  ]);
                  $i = 2;
                  $j = 1;
                  foreach ($subscribes as $sub) {
                    
                         if($sub->accept == 1){
                            $accept = 'Accepted';
                         }else{
                            $accept = 'Not accept';
                         }
                          $sheet->row($i, [
                              $j,
                              $sub->email,
                              $sub->country_name,
                              $sub->name,
                              $accept,
                              $sub->created_at
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