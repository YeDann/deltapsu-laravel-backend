<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;

class StaticWordController extends Controller
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
        // return dd($typeid);
        $static_word = DB::table('static_keyword as w')
        ->join('static_keyword_translations as skt','skt.key_word','=','w.key_word')
        ->select('w.*','skt.*')
        ->where('skt.local','en')
        ->get();

        return view('static_word.index')
        ->with('name', 'setting')
        ->with('menu','staticword')
        ->with('static_word',$static_word);
    }
    public function static_edit($key){
        $language = DB::table('language')->get();
        $static_word = DB::table('static_keyword as w')
        ->join('static_keyword_translations as skt','skt.key_word','=','w.key_word')
        ->select('w.*','skt.*')
        ->where('w.key_word',$key)
        ->get();

        return view('static_word.edit')
        ->with('language', $language)
        ->with('name', 'setting')
        ->with('static_word',$static_word)
        ->with('menu','staticword');
    }
    public function static_create(){
     
        return view('static_word.create')
        ->with('name', 'setting')
        ->with('menu','staticword');
    }
    public function store_staticword(Request $request){
        $language = DB::table('language')->get();
        $validate = Validator::make($request->all(), [
            'key_word' => ['required', 'unique:static_keyword'],
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        }else {
            DB::table('static_keyword')->insert([
                'key_word' => $request->key_word,
            ]);
         foreach($language as $lang){
            DB::table('static_keyword_translations')->insert([
                'key_word' => $request->key_word,
                'word' => $request->word,
                'local' => $lang->name,
            ]);
         }
         return redirect()->route('static_word')->with('flash_message', 'Insert Data successfully');
        }
        return redirect()->route('static_word')->with('error_message', 'Can not add Data?');
    }
    public function update_staticword(Request $request){
          $lang_loop = $request->lang_loop;
          $word = $request->word;
        //    return dd( $request->key_word);
          DB::table('static_keyword')->where('key_word',$request->key_word)->update([
            'key_word' => $request->key_word,
          ]);
            foreach($lang_loop as $lang){
              $data = DB::table('static_keyword_translations')->where('key_word',$request->key_word)->where('local',$lang)->get();
                if(count($data) == 0){
                    DB::table('static_keyword_translations')->insert([
                        'key_word' => $request->key_word,
                        'word' => $word[$lang],
                        'local' => $lang,
                    ]);
                }else{
                    
                    DB::table('static_keyword_translations')->where('key_word',$request->key_word)->where('local',$lang)->update([
                        'word' => $word[$lang],
                    ]);
                }
               
            }
            return redirect()->route('static_word')->with('flash_message', 'Update Data successfully');
    }
}


    ?>