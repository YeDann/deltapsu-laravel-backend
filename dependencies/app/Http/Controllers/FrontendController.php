<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DB;
use App;
use App\Language;
// use App\File;
use Auth;
use Session;
use GuzzleHttp\Client;
use App\Mail\Contact;
use App\Mail\DowloadGui;
use App\Mail\Forgetpass;
use App\Mail\SendPDF;
use App\Mail\SendPDFFromFeedBack;
use App\Mail\ThankFeedback;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use PDF;
use Excel;
use Mailchimp;
use LaravelLocalization;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\Debug\ExceptionHandler as SymfonyExceptionHandler;
use App\Mail\ExceptionOccured;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
class FrontendController extends Controller
{
 
    public function __construct() { 
        // session()->forget('lang_down');
    $lang = App::getLocale();
    session(['lang_down' =>  App::getLocale()]);
    view()->share('language', DB::table("language")->where('status',1)->orderBy('order_seq','asc')->get());
    view()->share('navcategories',  DB::table('categories_has_main_pro as chmp')
    ->join('sub_pro_categories as sc', 'chmp.cate_id', '=', 'sc.sub_pro_id')
    ->join('sub_pro_categories_translation as sct', 'sct.sub_pro_id', '=', 'sc.sub_pro_id')
    ->select('sc.*', 'sct.*' ,'chmp.*')
    ->where('sct.local',  $lang)
    ->orderBy('chmp.order_seq', 'asc')
    ->get());

    view()->share('navcategories1',  DB::table('categories_has_main_pro as chmp')
    ->join('sub_pro_categories as sc', 'chmp.cate_id', '=', 'sc.sub_pro_id')
    ->join('sub_pro_categories_translation as sct', 'sct.sub_pro_id', '=', 'sc.sub_pro_id')
    ->select('sc.*', 'sct.*' ,'chmp.*')
    ->where('sct.local',  $lang)
    ->where('chmp.main_cateid', 1)
    ->orderBy('chmp.order_seq', 'asc')
    ->get());
    
    view()->share('navcategories2',  DB::table('categories_has_main_pro as chmp')
    ->join('sub_pro_categories as sc', 'chmp.cate_id', '=', 'sc.sub_pro_id')
    ->join('sub_pro_categories_translation as sct', 'sct.sub_pro_id', '=', 'sc.sub_pro_id')
    ->select('sc.*', 'sct.*' ,'chmp.*')
    ->where('sct.local',  $lang)
    ->where('chmp.main_cateid', 2)
    ->orderBy('chmp.order_seq', 'asc')
    ->get());
    
    view()->share('navcategories3',  DB::table('categories_has_main_pro as chmp')
    ->join('sub_pro_categories as sc', 'chmp.cate_id', '=', 'sc.sub_pro_id')
    ->join('sub_pro_categories_translation as sct', 'sct.sub_pro_id', '=', 'sc.sub_pro_id')
    ->select('sc.*', 'sct.*' ,'chmp.*')
    ->where('chmp.main_cateid', 3)
    ->where('sct.local',  $lang)
    ->orderBy('chmp.order_seq', 'asc')
    ->get());
   
    view()->share('navapplication', DB::table('application as ap')
    ->join('application_translation as apt','ap.id','=','apt.app_id')
    ->where('apt.local','=',$lang)
    ->select('ap.*' ,'ap.id as applica_id' , 'apt.name' ,'apt.content' ,'apt.overview')
    ->orderBy('ap.order_seq' ,'asc')
    ->get());

    view()->share('navaboutus', DB::table('about_us as au')
    ->join('about_us_translations as aut', 'au.id', '=', 'aut.abt_id')
    ->where('aut.local', '=',$lang)
    ->select('au.*' ,'aut.*')
    ->get());

    view()->share('countryemails', DB::table('email_notification as et')
        ->select('et.*')
        ->where('et.type', 1)
        ->orderBy('et.country', 'asc')
        ->get());

        view()->share('mail_chimp_country', DB::table('mail_chimp_country as mc')
        ->select('mc.*')
        ->orderBy('mc.name', 'asc')
        ->get());


     $static_word = DB::table('static_keyword as w')
        ->join('static_keyword_translations as skt','skt.key_word','=','w.key_word')
        ->select('w.*','skt.*')
        ->where('skt.local',$lang)
        ->get();
    if(count($static_word) == 0){
        $static_word = DB::table('static_keyword as w')
        ->join('static_keyword_translations as skt','skt.key_word','=','w.key_word')
        ->select('w.*','skt.*')
        ->where('skt.local','en')
        ->get();
    }
       
     foreach($static_word as $word){
        $wordarry[$word->key_word] = $word->word;
     }
     
     view()->share('staticContent', $wordarry);
    //  return dd($wordarry);
    session(['product_comp' => []]);
    //    view()->share('pro_com_arr', session('product_comparearr'));
    }
    public function index($page ='home')
    {
        $lang = App::getLocale();
        session(['lang_down' =>  $lang]);
        if($page == 'home'){

           
            $banners = DB::table('banner_slide as bs')
            ->join('banner_slide_translations as bst','bs.id','=','bst.ban_id')
            ->where('bst.local','=', $lang)
            ->select('bs.*','bst.*')
            ->orderBy('bs.order_seq' ,'asc')
            ->get();
            if(!isset($banners)){
                $banners = DB::table('banner_slide as bs')
                ->join('banner_slide_translations as bst','bs.id','=','bst.ban_id')
                ->where('bst.local','=', 'en')
                ->select('bs.*','bst.*')
                ->orderBy('bs.order_seq' ,'asc')
                ->get();
              
            }
            $subCategories = DB::table('sub_pro_categories as sp')
            ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'sp.sub_pro_id')
            ->where('spt.local', '=', $lang)
            ->where('sp.status', '=', 1)
            ->select('sp.*', 'spt.*')
            ->orderBy('sp.order_seq', 'asc')
            ->get();

            $applications = DB::table('application as ap')
            ->join('application_translation as apt','ap.id','=','apt.app_id')
            ->where('apt.local','=',$lang)
            ->select('ap.*' ,'ap.id as applica_id','apt.*')
            ->orderBy('ap.order_seq' ,'asc')
            ->get();
            if(!isset($applications)){
                $applications = DB::table('application as ap')
                ->join('application_translation as apt','ap.id','=','apt.app_id')
                ->where('apt.local','=','en')
                ->select('ap.*' ,'ap.id as applica_id','apt.*')
                ->orderBy('ap.order_seq' ,'asc')
                ->get();
            }

            $static_content = DB::table('static_content as st')
            ->join('static_content_translations as sct','st.sta_id','=','sct.sta_fk_id')
            ->where('type_con_id',1)
            ->select('st.*','sct.*')
            ->where('sct.local','=',$lang)
            ->first();


            $faqbanner = DB::table('static_content as st')
            ->join('static_content_translations as sct','st.sta_id','=','sct.sta_fk_id')
            ->where('type_con_id',7)
            ->select('st.*','sct.*')
            ->first();

            $products = DB::table('products as p')
            ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
            ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
            ->join('sub_pro_categories as sp', 'sp.sub_pro_id', '=', 'phc.categories_id')
            ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'sp.sub_pro_id')
            ->where('pt.local' ,$lang)
            ->where('spt.local' ,$lang)
            ->where('p.feature_product' ,1)
            ->where('pt.showstatus' ,1)
            ->select('p.*', 'pt.*' ,'spt.sub_pro_id as cateid' ,'spt.name as catename' ,'sp.unit_dimension')
            ->orderBy('p.created_at', 'desc')
            ->get();
            $procheckarr = [];

            $data = [];
                 $i = 0;
                foreach($products as $item){
                 
                  $prolang = self::checkLang($lang,$item->pro_id);
                    $pro = DB::table('products as p')
                    ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
                    ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
                    ->join('sub_pro_categories as sp', 'sp.sub_pro_id', '=', 'phc.categories_id')
                    ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'sp.sub_pro_id')
                    ->where('pt.local' ,$prolang)
                    ->where('spt.local' ,$lang)
                    ->where('p.feature_product' ,1)
                    ->where('p.enable_pro' ,1)
                    ->where('p.pro_id' ,$item->pro_id)
                    ->select('p.*', 'pt.*' ,'spt.sub_pro_id as cateid' , 'spt.name as catename' ,'sp.unit_dimension')
                    ->orderBy('p.created_at', 'desc')
                    ->first();

                    $arraysub = [];
                    $arraysub = DB::table('product_has_property as ph')
                    ->join('product_has_property_translation as pht','ph.per_id' ,'=','pht.per_fk_id')
                    ->join('product_field as pf','pf.id' ,'=','ph.type_id')
                    ->join('product_field_translation as pft','ph.type_id' ,'=','pft.product_field_id')
                    ->where('ph.product_id',$item->pro_id)
                    ->where('pht.local' ,'en')
                    ->where('pft.local' ,$lang)
                    ->whereIn('ph.type_id',[4,3,8,31])
                    ->orderBy('ph.type_id' ,'asc')
                    ->select('pht.value_text','ph.*','pft.field_name as fieldCate','pf.unit_name')
                    ->get();
                if(!in_array($pro->pro_id, $procheckarr)){
                    if(self::checkContentPro($pro->pro_id)){
                        array_push($procheckarr,$pro->pro_id);
                        $data[$i] = [
                            "pro_id"=>$pro->pro_id,
                            "pro_code"=>$pro->pro_code,
                            "cateid"=>$pro->cateid,
                            "catename"=>$pro->catename,
                            "picture"=>$pro->picture,
                            "unit_dimension"=>$pro->unit_dimension,
                            "status_product"=>$pro->status_product,
                            "content" =>$arraysub,
                            "dimensionL"=>$pro->dimensionL,
                            "dimensionW"=>$pro->dimensionW,
                            "dimensionD"=>$pro->dimensionD,
                        ];
                    }
                }
                
             
                    $i++;
                }
                $now = date('Y-m-d');
                $events_q = DB::table('contents as c')
                ->join('contents_translations as ct' ,'ct.content_id' ,'=','c.id')
                ->where('ct.local', $lang)
                ->where('c.content_type', '=', 'event')
                ->where('c.date_publish', '>=', $now)
                ->where('c.status',  1)
                ->select('c.*' ,'ct.*')
                ->orderBy('c.date_publish', 'asc')
                ->limit(2)
                ->get();

                if(isset($events) && count($events_q) > 0){
                    $events =  self::getDataNew($events_q ,'events');
                }else{
                    $events_q2 = DB::table('contents as c')
                    ->join('contents_translations as ct' ,'ct.content_id' ,'=','c.id')
                    ->where('ct.local', $lang)
                    ->where('c.content_type', '=', 'event')
                    ->where('c.status',  1)
                    ->select('c.*' ,'ct.*')
                    ->orderBy('c.date_publish', 'desc')
                    ->limit(2)
                    ->get();
                    $events =  self::getDataNew($events_q2,'events');
                 
                }
                // return dd($events);
               
                $news_q = DB::table('product_news_has_categories as pnc')
                ->join('contents as c' ,'c.id' ,'=','pnc.content_id')
                ->join('contents_translations as ct' ,'ct.content_id' ,'=','c.id')
                ->join('news_type as nt' ,'nt.id' ,'=','pnc.categories_id')
                ->join('news_type_translation as ntt' ,'ntt.fk_nt_id' ,'=','nt.id')
                ->where('ct.local',  $lang)
                ->where('ntt.local',  $lang)
                ->where('c.content_type', '=', 'news')
                ->where('c.status',  1)
                ->select('c.*' ,'ct.*','ntt.title as cateName','nt.color_type')
                ->orderBy('c.date_publish', 'desc')
                ->limit(2)
                ->get();
                $news =  self::getDataNew($news_q,'news');

                $teachni = DB::table('article_has_categories as anc')
                ->join('contents as c' ,'c.id' ,'=','anc.content_id')
                ->join('contents_translations as ct' ,'ct.content_id' ,'=','c.id')
                ->join('tech_type as ty' ,'ty.id' ,'=','anc.categories_id')
                ->join('tech_type_translation as tyt' ,'ty.id' ,'=','tyt.tech_id')
                ->where('ct.local',  $lang)
                ->where('tyt.local',  $lang)
                ->where('c.status',  1)
                ->where('c.content_type', '=', 'blog')
                ->select('c.*' ,'ct.*','tyt.name as cateName')
                ->orderBy('c.date_publish', 'desc')
                ->limit(2)
                ->get();
                if(count($teachni) == 0){
                    $teachni = DB::table('article_has_categories as anc')
                    ->join('contents as c' ,'c.id' ,'=','anc.content_id')
                    ->join('contents_translations as ct' ,'ct.content_id' ,'=','c.id')
                    ->join('tech_type as ty' ,'ty.id' ,'=','anc.categories_id')
                    ->join('tech_type_translation as tyt' ,'ty.id' ,'=','tyt.tech_id')
                    ->where('ct.local',  'en')
                    ->where('tyt.local', 'en')
                    ->where('c.status',  1)
                    ->where('c.content_type', '=', 'blog')
                    ->select('c.*' ,'ct.*','tyt.name as cateName')
                    ->orderBy('c.date_publish', 'desc')
                    ->limit(2)
                    ->get();
                }
                $metatag = DB::table('meta_tag_page as mtp')->where('id',1)->get();

                $series = DB::table('least_series_product as ls')
                ->join('series as s' ,'s.se_id' ,'=' ,'ls.series_id')
                ->join('series_translations as st' ,'st.series_id' ,'=' ,'s.se_id')
                ->join('sub_pro_categories as sp' ,'sp.sub_pro_id' ,'=' ,'ls.cate_id')
                ->join('sub_pro_categories_translation as spt' ,'spt.sub_pro_id' ,'=' ,'sp.sub_pro_id')
                ->where('st.local' , $lang)
                ->where('spt.local' , $lang)
                ->where('s.status' ,1)
                ->select('s.*' ,'ls.*','st.title','st.overview_content','sp.url_item','sp.sub_pro_id as cate_id','spt.name as cateName')
                ->orderBy('ls.order_seq' ,'asc')
                ->get();
                
                $series_has_application = DB::table('series_has_application as shp')
                ->join('application as app', 'app.id', '=', 'shp.app_id')
                ->join('application_translation as appt' ,'appt.app_id' ,'=' ,'app.id')
                ->where('appt.local' , $lang)
                ->select('shp.app_id','app.*' ,'appt.name','shp.se_id' )
                ->get();

            return  view('front-end.home')
            ->with('series_has_application',$series_has_application)
            ->with('series',$series)
            ->with('faqbanner',$faqbanner)
            ->with('metatag',$metatag)
            ->with('static_content',$static_content)
            ->with('applications',$applications)
            ->with('banners',$banners)
            ->with('featePros',$data)
            ->with('events',$events)
            ->with('news',$news)
            ->with('teachni',$teachni)
            ->with('subCategories',$subCategories);
        }

        if($page == 'news'){
            $lang = App::getLocale();
            $news_type = DB::table('news_type as nt')
            ->join('news_type_translation as ntt' ,'ntt.fk_nt_id' ,'=','nt.id')
            ->select('nt.*','ntt.title as typename')
            ->where('ntt.local',$lang)
            ->orderBy('nt.order_seq','asc')
            ->get();
         
            $news = DB::table('product_news_has_categories as pnc')
            ->join('contents as c' ,'c.id' ,'=','pnc.content_id')
            ->join('contents_translations as ct' ,'ct.content_id' ,'=','c.id')
            ->join('news_type as nt' ,'nt.id' ,'=','pnc.categories_id')
            ->join('news_type_translation as ntt' ,'ntt.fk_nt_id' ,'=','nt.id')
            ->where('ct.local', $lang)
            ->where('ntt.local', $lang)
            ->where('c.content_type', '=', 'news')
            ->where('c.status',  1)
            ->select('c.*' ,'ct.*','ntt.title as cateName','nt.color_type','pnc.categories_id as typeId')
            ->orderBy('c.date_publish', 'desc')
            ->distinct()
            ->get();
            
            $status = false;
            $currentdate = date('Y-m-d');
            if(count($news) > 0){
                if($news[0]->typeId == 12){
                    $date1 = $currentdate;
                    $date2 = $news[0]->date_publish;
    
                    $diff = abs(strtotime($date2) - strtotime($date1));
    
                    $years = floor($diff / (365*60*60*24));
                    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                    
                    if($days > 0 && $days <= 30){
                        $status = true;
                    }
                }
                
            }
            // return dd($status,$days,$news[0]);

            $metatag = DB::table('meta_tag_page as mtp')->where('id',6)->get();
            return  view('front-end.new')
            ->with('metatag' ,$metatag)
            ->with('news_type' ,$news_type)
            ->with('status_eol' ,$status)
            ->with('news' ,$news);
        }
        if($page == 'login'){
            $sectionId = session('partner_id');
            $metatag = DB::table('meta_tag_page as mtp')->where('id',26)->get();
            if($sectionId == null){
                return  view('front-end.login')->with('metatag' ,$metatag);
            }else{
                return redirect()->route('index','partners');
            }
          
        }
        // if($page == 'application'){
        //     $lang = App::getLocale();
        //     $applications = DB::table('application as ap')
        //     ->join('application_translation as apt','ap.id','=','apt.app_id')
        //     ->where('apt.local','=',$lang)
        //     ->select('ap.*' ,'ap.id as applica_id','apt.*')
        //     ->orderBy('ap.order_seq' ,'asc')
        //     ->get();
        //     // return dd( $applications);
        //     return  view('front-end.applicationview')->with('applications' ,$applications);
        // }
        if($page == 'events'){
            // return dd('de');
            $lang = App::getLocale();
             $events = DB::table('contents as c')
            ->join('contents_translations as ct' ,'ct.content_id' ,'=','c.id')
            ->where('ct.local', $lang)
            ->where('c.content_type', '=', 'event')
            ->where('c.status',  1)
            ->select('c.*' ,'ct.*')
            ->orderBy('c.date_publish', 'desc')
            ->get();

            $events2 = DB::table('contents as c')
            ->join('contents_translations as ct' ,'ct.content_id' ,'=','c.id')
            ->where('ct.local', $lang)
            ->where('c.content_type', '=', 'event')
            ->where('c.status',  1)
            ->select('c.*' ,'ct.*')
            ->orderBy('c.date_publish', 'asc')
            ->get();
            $metatag = DB::table('meta_tag_page as mtp')->where('id',7)->get();
            return  view('front-end.event')->with('events2' ,$events2)->with('events' ,$events)->with('metatag' ,$metatag);
        }
        if($page == 'technical-articles'){
            $lang = App::getLocale();
            $news_type = DB::table('tech_type as tc')
            ->join('tech_type_translation as tct','tc.id','=','tct.tech_id')
            ->where('tct.local',$lang)
            ->select('tc.id','tct.name')
            ->get();
         

            $news = DB::table('article_has_categories as anc')
            ->join('contents as c' ,'c.id' ,'=','anc.content_id')
            ->join('contents_translations as ct' ,'ct.content_id' ,'=','c.id')
            ->join('tech_type as ty' ,'ty.id' ,'=','anc.categories_id')
            ->join('tech_type_translation as tyt' ,'ty.id' ,'=','tyt.tech_id')
            ->where('ct.local',$lang)
            ->where('tyt.local',$lang)
            ->where('c.status',  1)
            ->where('c.content_type', '=', 'blog')
            ->select('c.*' ,'ct.*','tyt.name as cateName' ,'anc.categories_id as typeId')
            ->orderBy('c.date_publish', 'desc')
            ->get();
            return  view('front-end.technical')
            ->with('news_type' ,$news_type)
            ->with('news' ,$news);
        }
        if($page == 'product-notice'){
            return  view('front-end.product-notice');
        }


        if($page =='faqs'){
            $lang = App::getLocale();
            $faq_categories = DB::table('faq_categories as fc')
            ->join('faq_categories_translations as fct', 'fc.cate_id', '=', 'fct.f_cate_id')
            ->where('fct.local', '=',  $lang)
            ->select('fc.*' ,'fct.*')
            ->get();

             $faqs = DB::table('faq as f')
            ->join('faq_translations as ft', 'f.id', '=', 'ft.faq_id')
            ->where('ft.local', '=',  $lang)
            ->where('f.status', 1)
            ->select('f.*' ,'ft.*')
            ->orderBy('order_seq')
            ->get();
            $metatag = DB::table('meta_tag_page as mtp')->where('id',14)->get();
            
            return  view('front-end.faqs')
            ->with('metatag' ,$metatag)
            ->with('faqs' ,$faqs)
            ->with('faq_categories' ,$faq_categories);
        }
        
        if($page =='product-documents'){
            $lang = App::getLocale();
            $subCategories = DB::table('sub_pro_categories as sc')
            ->join('sub_pro_categories_translation as sct', 'sct.sub_pro_id', '=', 'sc.sub_pro_id')
            ->select('sc.*', 'sct.*')
            ->where('sc.status', 1)
            ->where('sct.local',  $lang)
            ->orderBy('sct.name', 'asc')
            ->get();
            
            $products = DB::table('products as p')
            ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
            ->join('series_translations as st', 'st.series_id', '=', 'p.series_id')
            ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
            ->join('sub_pro_categories as sp', 'sp.sub_pro_id', '=', 'phc.categories_id')
            ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'phc.categories_id')
            ->where('pt.local' ,$lang)
            ->where('st.local' ,$lang)
            ->where('spt.local' ,$lang)
            ->where('pt.showstatus' ,1)
            ->select('p.*', 'pt.*' ,'spt.name as catename','sp.url_item','st.title as seriesename')
            ->orderBy('p.pro_code', 'asc')
            ->get();


            $Protags  = DB::table('product_tags as ptag')
           ->join('products as p', 'p.pro_id', '=', 'ptag.product_id')
           ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
           ->join('sub_pro_categories as sp', 'sp.sub_pro_id', '=', 'phc.categories_id')
           ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'phc.categories_id')
           ->join('series_translations as st', 'st.series_id', '=', 'p.series_id')
           ->where('spt.local' ,$lang)
           ->where('st.local' ,$lang)
           ->where('p.enable_pro' ,1)
           ->select('p.*','spt.name as catename','phc.categories_id','sp.url_item' ,'st.title as seName','ptag.*')
           ->get();

            $series =  DB::table('series_has_pro_categories as sc')
                ->join('series as s' ,'sc.se_id' ,'=' ,'s.se_id')
                ->join('series_translations as st' ,'st.series_id' ,'=' ,'s.se_id')
                ->where('st.local' ,'en')
                ->where('s.status' ,1)
                ->select('s.*' ,'st.*' ,'sc.pro_categories_id')
                ->distinct()
                ->orderBy('st.title', 'asc')
                ->get();
              
                $documents = DB::table('product_has_documents as phd')
                ->join('products as p','p.pro_id','=','phd.product_id')
                ->join('product_ducuments as pd','phd.document_id','=','pd.doc_id')
                ->join('product_ducument_translations as pdt','pdt.doc_fk_id','=','pd.doc_id')
                ->join('products_documents_categories as pdc','pdc.id','=','pd.cate_id')
                ->join('pro_ducuments_cate_translations as pdct','pdct.doc_cate_id','=','pdc.id')
                ->where('pdt.local',$lang)
                ->where('pdct.local',$lang)
                ->where('pdt.file','!=','')
                ->where('pdt.file','!=',null)
                ->whereNotIn('pdc.id', [4])
                ->select('p.pro_code','pd.doc_id','phd.product_id','pdct.lable' ,'pdc.slug' ,'pdt.name','pdc.title as catename','pd.created_at' ,'pdc.main_cate_id','pdt.file' ,'pd.cate_id')
                ->orderBy('pdc.title','asc')
                ->get();
                $documents_cate = DB::table('products_documents_categories as pdc')
                ->join('pro_ducuments_cate_translations as pdct','pdct.doc_cate_id','=','pdc.id')
                ->where('pdct.local','=', $lang)
                ->whereNotIn('pdc.id', [4])
                ->select('pdc.*','pdct.lable')
                ->orderBy('pdc.title','asc')
                ->get();
                $metatag = DB::table('meta_tag_page as mtp')->where('id',9)->get();
            return  view('front-end.product-documents')
            ->with('Protags' ,$Protags)
            ->with('metatag' ,$metatag)
            ->with('subCategories' ,$subCategories)
            ->with('series' ,$series)
            ->with('documents' ,$documents)
            ->with('documents_cate' ,$documents_cate)
            ->with('products' ,$products);
        }
        if($page =='catalogs'){
            $lang = App::getLocale();
            $margetCate = DB::table('permission_marketcate as permar')
                ->join('marketing_resource_cate as mc', 'permar.market_cate_id', '=', 'mc.cate_id')
                ->join('marketing_resource_cate_translations as mct', 'mc.cate_id', '=', 'mct.mk_fk_id')
                ->where('mct.local', '=',  $lang)
                ->where('mc.status', '=', 1)
                ->where('permar.permission_id', '=', 3)
                ->select('mc.*' ,'mct.*')
                ->get();
    
             $margeting = DB::table('marketing_resource as mr')
                ->join('marketing_resource_translations as mrt', 'mr.id', '=', 'mrt.mr_id')
                ->where('mrt.local', '=', $lang)
                ->select('mr.*' ,'mrt.*')
                ->get();
            $metatag = DB::table('meta_tag_page as mtp')->where('id',8)->get();
            return view('front-end.catalog')
            ->with('metatag',$metatag)
            ->with('margetCate',$margetCate)
            ->with('margeting',$margeting);
        }
        if($page =='partners'){ 
            $sectionId = session('partner_id');
            if($sectionId == null){
                return redirect()->route('index','login');
            }else{
                $metatag = DB::table('meta_tag_page as mtp')->where('id',29)->get();
                return view('front-end.partners')->with('metatag',$metatag); 
            }
        
        }
        if($page == "sales-offices"){
            return redirect()->route('contactSalesOffices');         
        }
        if($page == 'distributors'){
            return redirect()->route('contactFindDistributor');      
        }
        if($page == 'products'){
            return redirect()->route('productFinder'); 
        }
        if($page == 'end-of-life-products'){
            return redirect()->route('index' ,'news'); 
        }
        if($page == 'documents'){
            return redirect()->route('index' ,'product-documents'); 
        }
        if($page == 'marketing-resources'){
            return redirect()->route('index' ,'catalogs'); 
        }
     
        if($page == 'manuals'){
            $lang = App::getLocale();
            $subCategories = DB::table('sub_pro_categories as sc')
            ->join('sub_pro_categories_translation as sct', 'sct.sub_pro_id', '=', 'sc.sub_pro_id')
            ->select('sc.*', 'sct.*')
            ->where('sct.local',  $lang)
            ->where('sc.status',1)
            ->orderBy('sct.name', 'asc')
            ->get();
            
            $products = DB::table('products as p')
            ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
            ->join('series_translations as st', 'st.series_id', '=', 'p.series_id')
            ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
            ->join('sub_pro_categories as sp', 'sp.sub_pro_id', '=', 'phc.categories_id')
            ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'phc.categories_id')
            ->where('pt.local',$lang)
            ->where('st.local',$lang)
            ->where('spt.local',$lang)
            ->where('p.manaul_page',1)
            ->select('p.*', 'pt.*' ,'spt.name as catename','sp.url_item','st.title as seriesename')
            ->orderBy('p.pro_code', 'asc')
            ->get();

            $series =  DB::table('series_has_pro_categories as sc')
                ->join('series as s' ,'sc.se_id' ,'=' ,'s.se_id')
                ->join('series_translations as st' ,'st.series_id' ,'=' ,'s.se_id')
                ->where('st.local' ,'en')
                ->where('s.status' ,1)
                ->select('s.*' ,'st.*' ,'sc.pro_categories_id')
                ->orderBy('st.title', 'asc')
                ->distinct()
                ->get();

                $language = DB::table('language as lang')->whereIn('lang.name',['en','cn','jp'])->get();
              
                //$othersL = DB::table('other_lang_document')->get();
                $showlang = [];
                $showlangOb = [];
                foreach($language as $langal){
                    $data = [
                        "langName"=>$langal->name,
                        "langFull"=>$langal->abbreviation
                    ];
                    array_push($showlang , $langal->name);
                    array_push($showlangOb ,$data);
                }
                // foreach($othersL as $lan){
                //     $data2 = [
                //         "langName"=>$lan->name,
                //         "langFull"=>$lan->full_name
                //     ];
                //     array_push($showlang , $lan->name);
                //     array_push($showlangOb ,$data2);
                // }
                // return dd($showlangOb);
              
                $documents = DB::table('product_has_documents as phd')
                ->join('products as p','p.pro_id','=','phd.product_id')
                ->join('product_ducuments as pd','phd.document_id','=','pd.doc_id')
                ->join('product_ducument_translations as pdt','pdt.doc_fk_id','=','pd.doc_id')
                ->join('products_documents_categories as pdc','pdc.id','=','pd.cate_id')
                ->whereNotIn('pdc.id', [6 ,7,4])
                ->where('pdt.file','!=','')
                ->where('pdt.file','!=',null)
                ->whereIn('pdt.local', $showlang)
                ->select('p.pro_code','pd.doc_id','pdc.slug' ,'phd.product_id','pdt.name','pdc.title as catename','pd.created_at' ,'pdc.main_cate_id','pdt.file' ,'pd.cate_id','pdt.local')
                ->get();
             
                // return dd($documents);
                
                $documents_cate = DB::table('products_documents_categories as pdc')
                ->join('pro_ducuments_cate_translations as pdct','pdct.doc_cate_id','=','pdc.id')
                ->where('pdct.local','=', $lang)
                ->whereNotIn('pdc.id', [6 ,7,4])
                ->select('pdc.*','pdct.lable')
                ->orderBy('pdc.title','asc')
                ->get();
                // return dd( $documents_cate);
                $metatag = DB::table('meta_tag_page as mtp')->where('id',22)->get();
            return view('front-end.manuals')
            ->with('showlangOb' ,$showlangOb)
            ->with('metatag' ,$metatag)
            ->with('subCategories' ,$subCategories)
            ->with('series' ,$series)
            ->with('documents' ,$documents)
            ->with('documents_cate' ,$documents_cate)
            ->with('products' ,$products);
        }
        if($page == 'subscribes'){
            $metatag = DB::table('meta_tag_page as mtp')->where('id',28)->get();
           return view('front-end.subscribe')->with('metatag' ,$metatag);
        }
        if($page == 'subscribe'){
            return redirect()->route('index','subscribes');
         }
        if($page == 'logoutfrontend'){
            session()->forget(['partner_id', 'partner_firstname' ,'partner_lastname' ,'partner_lastname' ,'partner_phone' ,'partner_role' ,'partner_email']);
            return redirect()->back()->with('logout', 'successfully');
        }
        if($page =='feedback'){
            $name = null;
            if(isset($_GET['for'])){
                $name = $this->validateInput($_GET['for'],'text',true);
            }
            if($name == 'Sale-Enquiries'){
                return redirect()->route('contactSupport')->with('contactlink','Sale-Enquiries');  
            }else if($name == 'Products-and-Service-Support'){
                return redirect()->route('contactSupport')->with('contactlink','Products-and-Service-Support');  
            }else{
                return redirect()->route('contactSupport');  
            }
            return redirect()->route('contactSupport'); 
        } 
     
        if($page == "checkPro3"){
            $arrcheck = [];
            $products = DB::table('products as p')
            ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
            ->where('pt.local' ,'en')
            ->select('p.*', 'pt.*' )
            ->orderBy('pt.showstatus' ,'desc')
            ->orderBy('p.created_at', 'desc')
            ->get();
            foreach($products  as $pro){
              $propertys = DB::table('product_has_property as ph')
               ->where('type_value','number')
               ->where('type_id',4)
               ->where('product_id',$pro->pro_id)
               ->get();
               if(count($propertys) >= 2){
                array_push($arrcheck , $pro->pro_id);
               }
            }
            return dd($arrcheck ,'ok');
        }
  
        abort(404);
         
    }
    private function getDataNew($query ,$type){
        $content = [];
    
        foreach($query as $item){
            $data_date = '';
            if($type == 'events'){
                $date = self::getDateformat(isset($item->date_publish) ?$item->date_publish :'00:00:00' );
                $endDate = self::getDateformat(isset($item->date_end) ?$item->date_end:'00:00:00' );
                $data_date = $date['m'].' '.$date['d'] .''.(isset($endDate['d'])?' - '.$endDate['d']:'').' '.$date['y'];
                $color_type =  '';
                $cateName =  '';
            }else if($type == 'news'){
                $datenew = self::getDateformat(isset($item->date_info)? $item->date_info:'00:00:00');
                $data_date =  $datenew['m'].' '.$datenew['d'].' '.$datenew['y'];
                $color_type =  $item->color_type;
                $cateName =  $item->cateName;

            }
                $content[] = array(
                    "id"=>$item->id, 
                    "slug"=>$item->slug, 
                    "title"=>$item->title, 
                    "content"=> $item->content, 
                    "location"=> $item->location, 
                    "thumb"=>$item->thumb, 
                    "date"=>$data_date,
                    "color_type"=>$color_type,
                    "cateName"=>$cateName,
                );
        }
        return $content;
    }

    private function getDateformat($date){
                                       
        $eng_month_arr = array(
            "0" => "",
            "1" => "Jan",
            "2" => "Feb",
            "3" => "Mar",
            "4" => "Apr",
            "5" => "May",
            "6" => "Jun",
            "7" => "Jul",
            "8" => "Aug",
            "9" => "Sep",
            "10" => "Oct",
            "11" => "Nov",
            "12" => "Dec"
        );
        $publicDate = date_create($date);
        $pDate = explode("-", $publicDate->format('Y-n-d'));
        $datearray = [
            'm' =>  $eng_month_arr[$pDate[1]],
            'd'=>  $pDate[2],
            'y' => $pDate[0]

        ];
        return  $datearray;
  }
    public function loginpartner(){
        $sectionId = session('partner_id');
        if($sectionId == null){
            return  view('front-end.login');
        }else{
            return redirect()->route('index','partners');
        }
    }
    // public  function redirectFeedback(){
     
    // }

    public function configurableProduct(){
    	$lang = App::getLocale();
    	$model = DB::table('cproducts')->select('product_code')->where('language',$lang)->where('status','1')->get();
        $model_alldata = DB::table('cproducts')->where('language',$lang)->where('status','1')->get();
        // return dd($model_alldata);
        $connectors_images = DB::table('connector_image as cm')
        ->select('cm.*')
        ->get();
    
        $metatag = DB::table('meta_tag_page as mtp')->where('id',5)->get();
        return  view('front-end.configurableproduct')
        ->with('metatag',$metatag)
        ->with('model',$model)
        ->with('connectors_images',$connectors_images)
        ->with('model_alldata',$model_alldata);
        
    }

    public function allproductsByType($cate_parname ,$cate_par_id = 0,$main_pId){
        $catename = $this->validateInput($cate_parname ,'text',true);
        $cateid = $this->validateInput($cate_par_id ,'number',true);
        $mainId = $this->validateInput($main_pId ,'number',true);

        $lang = App::getLocale();
      
        $status1_last = DB::table('least_products as lp')
        ->join('least_products_translation as lpt', 'lp.id', '=', 'lpt.last_id')
        ->Leftjoin('products as p', 'p.pro_id', '=', 'lp.product_id')
        ->Leftjoin('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
        ->Leftjoin('sub_pro_categories_translation as subt', 'phc.categories_id', '=', 'subt.sub_pro_id')
        ->select('lp.*', 'lpt.*' ,'p.pro_code' ,'p.picture' ,'subt.name as catename')
        ->where('lp.status', 1)
        ->where('lpt.local',  $lang)
        ->where('subt.local',  $lang)
        ->get();

        $status2_last = DB::table('least_products as lp')
        ->join('least_products_translation as lpt', 'lp.id', '=', 'lpt.last_id')
        ->select('lp.*', 'lpt.*'  )
        ->where('lp.status', 2)
        ->where('lpt.local',  $lang)
        ->get();


        $mainCategories = DB::table('main_pro_categories as mp')
        ->join('main_pro_categories_translations as mpt', 'mpt.main_pro_id', '=', 'mp.main_id')
        ->where('mpt.local', '=',$lang)
        ->select('mp.*', 'mpt.*')
        ->orderBy('mp.order_seq','asc')
        ->get();

        $subCategories = DB::table('categories_has_main_pro as chmp')
        ->join('sub_pro_categories as sc', 'chmp.cate_id', '=', 'sc.sub_pro_id')
        ->join('sub_pro_categories_translation as sct', 'sct.sub_pro_id', '=', 'sc.sub_pro_id')
        ->select('sc.*', 'sct.*' ,'chmp.*')
        ->where('sct.local',  $lang)
        ->orderBy('chmp.order_seq', 'asc')
        ->get();

        $series = DB::table('series_has_pro_categories as sc')
        ->join('series as s' ,'sc.se_id' ,'=' ,'s.se_id')
        ->join('series_translations as st' ,'st.series_id' ,'=' ,'s.se_id')
        ->where('st.local' ,$lang)
        ->where('s.status' ,1)
        ->select('s.*' ,'st.*' ,'sc.*')
        ->orderBy('order_seq' ,'asc')
        ->get();

        $series_has_application = DB::table('series_has_application as shp')
        ->join('application as app', 'app.id', '=', 'shp.app_id')
        ->join('application_translation as appt' ,'appt.app_id' ,'=' ,'app.id')
        ->where('appt.local' ,'en')
        ->select('shp.app_id','app.*' ,'appt.name','shp.se_id' )
        ->get();

        $modeSeries = DB::table('mode_series as ms')
        ->select('ms.*')
        ->get();
        $metatag = DB::table('meta_tag_page as mtp')->where('id',2)->get();
        return  view('front-end.allproducts')
        ->with('metatag',$metatag)
        ->with('modeSeries',$modeSeries)
        ->with('mainCategories',$mainCategories)
        ->with('subCategories',$subCategories)
        ->with('cateid',$cateid)
        ->with('mainId',$mainId)
        ->with('series',$series)
        ->with('series_has_application',$series_has_application)
        ->with('last_products',$status1_last)
        ->with('last_products_2',$status2_last);
    }
    public function productBySeries($se_par_name,$se_parid){
        // return dd('de');
        $se_name = $this->validateInput($se_par_name ,'text',true);
        $se_id = $this->validateInput($se_parid ,'number',true);
        $series = DB::table('series_has_pro_categories as shc')
        ->join('series as s' ,'shc.se_id' ,'=' ,'s.se_id')
        ->join('sub_pro_categories as sc', 'shc.pro_categories_id', '=', 'sc.sub_pro_id')
        ->where('shc.se_id',$se_id)
        ->select('sc.url_item as catename' ,'s.slug as se_name','s.se_id' ,'sc.sub_pro_id as cateid')
        ->first();

       if(isset($series)){
        return  redirect()->route('producsList',[$series->catename,$series->cateid,$series->se_name,$series->se_id]);
       }else{
           abort(404);
       }
       
    }
    public function producsList($cate_parname,$cate_par_id,$se_par_name = null,$se_par_id = null){
    $lang = App::getLocale();

    $catename = $this->validateInput($cate_parname ,'text',true);
    $cateid = $this->validateInput($cate_par_id ,'number',true);
    $se_name = $this->validateInput($se_par_name ,'text',true);
    $se_id = $this->validateInput($se_par_id ,'number',true);

    $subCategories = DB::table('sub_pro_categories as sc')
        ->join('sub_pro_categories_translation as sct', 'sct.sub_pro_id', '=', 'sc.sub_pro_id')
        ->select('sc.*', 'sct.*')
        ->where('sct.local',  $lang)
        ->where('sc.sub_pro_id',$cateid)
        ->orderBy('sc.created_at', 'desc')
        ->get();
  
    $arrproid = [];    
    
    $searchPro = DB::table('product_has_categories as phc')
    ->join('products as p', 'p.pro_id', '=', 'phc.product_id')
    ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
    ->where('pt.local' ,'en')
    ->where('phc.categories_id',$cateid)
    ->where('p.enable_pro' ,1)
    ->select('p.*', 'pt.*')
    ->orderBy('p.pro_code', 'asc')
    ->get();

    $products = [];
    foreach($searchPro as $pro){
        $product_has_prm = DB::table('product_has_property as ph')
        ->whereIn('ph.type_id',[4,3,8,31])
        ->where('ph.product_id',$pro->pro_id)
        ->orderBy('ph.type_id' ,'asc')
        ->select('ph.*')
        ->get();
        // return dd(count($product_has_prm));
        //Check Eror input content product
        if(count($product_has_prm) >= 4){
            array_push($arrproid, $pro->pro_id);
            $prolang =  self::checkLang($lang,$pro->pro_id);
            $datapro = DB::table('products as p')
            ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
            ->where('pt.local',$prolang)
            ->where('p.pro_id',$pro->pro_id)
            ->where('p.enable_pro' ,1)
            ->select('p.*', 'pt.*')
            ->orderBy('p.created_at', 'desc')
            ->first();
             array_push($products, $datapro);
             $optional_product = DB::table('product_optional_model as po')
                    ->join('products as p', 'p.pro_id', '=', 'po.product_id')
                    ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
                    ->where('pt.local',$prolang)
                    ->where('p.enable_pro' ,1)
                    ->where('po.product_id' ,$pro->pro_id)
                    ->select('p.*','pt.*','po.optional_model as pro_code' )
                    ->orderBy('p.created_at', 'desc')
                    ->get();
                    foreach($optional_product as $optional_model){
                        array_push($products,$optional_model);
                    }
        }
    
    }

//    return dd($products);
    // return dd(count($products));
        $series =  DB::table('series_has_pro_categories as sc')
        ->join('series as s' ,'sc.se_id' ,'=' ,'s.se_id')
        ->join('series_translations as st' ,'st.series_id' ,'=' ,'s.se_id')
        ->where('sc.pro_categories_id',$cateid)
        ->where('st.local',$lang)
        ->where('s.status',1)
        ->select('s.se_id' ,'st.title')
        ->distinct()
        ->orderBy('st.title','asc')
        ->get();
        // return dd($series);
        $pd_field = DB::table('product_field as pf')
        ->join('product_field_translation as pft', 'pf.id', '=', 'pft.product_field_id')
        ->join('section as st', 'pf.section_id', '=', 'st.id')
        ->join('section_translation as stt', 'st.id', '=', 'stt.section_id')
        ->where('pft.local', '=', $lang)
        ->where('stt.local', '=', $lang)
        ->select('pf.id as pd_field_id', 'pf.type', 'pf.created_at', 'pft.field_name', 'pft.local as pft_local', 'st.id as section_id', 'stt.name as section_name')
        ->orderBy('pf.created_at', 'desc')
        ->get();

        $filter_pro = DB::table('sub_pro_has_product_filter as shf')
        ->join('subpro_has_profilter_translation as shpt', 'shf.id', '=', 'shpt.fk_sub_pro_id')
        ->Leftjoin('product_field as pf', 'pf.id', '=', 'shf.field_id')
        ->where('shf.sub_pro_id' ,$cateid)
        ->where('shpt.local', '=', $lang)
        ->orderBy('shf.order_seq', 'asc')
        ->select('shf.sub_pro_id' ,'shf.field_id','shpt.title','pf.type' ,'pf.section_id' )
        ->get();

        // return dd($filter_pro);
        $section = DB::table('section as st')
        ->join('section_translation as stt','st.id','=','stt.section_id')
        ->where('stt.local','=', $lang)
        ->select('st.id','stt.name')
        ->get();

        $product_has_property = DB::table('product_has_property as ph')
           ->join('product_has_property_translation as pht','ph.per_id' ,'=','pht.per_fk_id')
           ->join('product_field as pf','pf.id' ,'=','ph.type_id')
           ->join('product_field_translation as pft','ph.type_id' ,'=','pft.product_field_id')
           ->where('pht.local' ,'en')
           ->where('pft.local' ,$lang)
           ->whereIn('ph.type_id',[4,3,8,31])
           ->whereIn('ph.product_id',$arrproid)
           ->orderBy('ph.type_id' ,'asc')
           ->select('pht.value_text','ph.*' ,'pft.field_name as fieldCate','pf.unit_name')
           ->get();

           $documents_cate = DB::table('products_documents_categories as pdc')
           ->join('pro_ducuments_cate_translations as pdct','pdct.doc_cate_id','=','pdc.id')
           ->where('pdct.local','=', $lang)
           ->whereNotIn('pdc.id', [6 ,7,4])
           ->where('pdc.main_cate_id',2)
           ->select('pdc.*','pdct.lable')
           ->orderBy('pdc.title','asc')
           ->get();
        //    $documents = DB::table('product_has_documents as phd')
        //    ->join('products as p','p.pro_id','=','phd.product_id')
        //    ->join('product_ducuments as pd','phd.document_id','=','pd.doc_id')
        //    ->join('product_ducument_translations as pdt','pdt.doc_fk_id','=','pd.doc_id')
        //    ->join('products_documents_categories as pdc','pdc.id','=','pd.cate_id')
        //    ->where('pdt.local',$lang)
        //    ->whereNotIn('pdc.id', [6 ,7,4])
        //    ->where('pdc.main_cate_id',2)
        //    ->select('phd.*','pd.cate_id as cate_id' )
        //    ->get();
           $defaultfilters = DB::table('default_filter as df')
           ->select('df.*')
           ->get();

           $certi_products = DB::table('certificate_product as cp')
           ->select('cp.*')
           ->get();

           $metatag = DB::table('meta_tag_page as mtp')->where('id',3)->get();
        //    return dd($products);

        return  view('front-end.product')
        ->with('metatag',$metatag)
        ->with('defaultfilters',$defaultfilters)
        ->with('certi_products',$certi_products)
        ->with('documents_cate',$documents_cate)
        ->with('section',$section)
        ->with('products',$products)
        ->with('filter_pro',$filter_pro)
        ->with('pd_field',$pd_field)
        ->with('product_has_property',$product_has_property)
        ->with('subCategories',$subCategories)
        ->with('catename',$catename)
        ->with('cateid',$cateid)
        ->with('se_name',$se_name)
        ->with('series',$series)
        ->with('se_id',$se_id);
    }
    public function loadPropoperty(Request $request)
    {
        // $data = $request->data;
        $data = $this->validateInput($request->data,'array',true);
        $proid = $this->validateInput($request->proid,'array',true);
        // $proid = $request->proid;
        $lang = App::getLocale();
            $product_property = DB::table('product_has_property as ph')
           ->join('product_has_property_translation as pht','ph.per_id' ,'=','pht.per_fk_id')
           ->join('product_field as pf','pf.id' ,'=','ph.type_id')
           ->join('product_field_translation as pft','ph.type_id' ,'=','pft.product_field_id')
           ->where('pht.local' ,'en')
           ->where('pft.local' ,$lang)
           ->whereIn('ph.type_id' ,$data)
           ->whereIn('ph.product_id',$proid)
           ->orderBy('ph.type_id' ,'asc')
           ->select('pht.value_text','ph.*' ,'pft.field_name as fieldCate','pf.unit_name')
           ->get();
           return response()->json([
            'data' => $product_property,
            'proid' => $proid,
        ],200);
       
    }
    public function loadProduct(Request $request){
        $lang = App::getLocale();
        // $cateid =  $request->data;
        $cateid = $this->validateInput($request->data,'number',true);
        $products = DB::table('products as p')
        ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
        ->where('phc.categories_id' ,$cateid)
        ->where('p.enable_pro' ,1)
        ->select('p.*')
        ->orderBy('p.created_at', 'desc')
        ->get();

        return response()->json([
            'data' => $products
        ],200);
    }
    public function oldlinkSeries($cate_par){
        $cate = $this->validateInput($cate_par,'text',true);
        $findoldCate = DB::table('sub_pro_categories as s')
        ->join('categories_has_main_pro as ch', 'ch.cate_id', '=', 's.sub_pro_id')
        ->where('s.url_item',$cate)
        ->first();
        // return dd($findoldCate);
        if($findoldCate){
            return  redirect()->route('allproductsByType',[$cate,$findoldCate->sub_pro_id,$findoldCate->main_cateid]);
        }else{
           abort(404);
        }
    }
  
      
   

    public function productsDetailsByType($catename,$procode = null){
        $pro_code = $this->validateInput($procode ,'text',true);
        $name = $this->validateInput($catename,'text',true);
        $slgSeries = null;
        $optional_model = null;
        if(isset($_GET['serie'])){
            if(is_array($_GET['serie'])){
                $slgSeries = $this->validateInput($_GET['serie'][0] ,'text',true);
            }else{
                $slgSeries = $this->validateInput($_GET['serie'] ,'text',true);
            }
        }
      
        if(isset($_GET['optional_model'])){
            $optional_model = $this->validateInput($_GET['optional_model'] ,'text',true);
                $optional_model_code  = str_replace("@", "/", $optional_model);
                $check_optional = DB::table('products as p')
                ->where('p.pro_code',$optional_model_code)
                ->where('p.enable_pro',1)
                ->first();
              if($check_optional){
                return redirect()->route('productsDetailsByType',[$catename,$optional_model_code] );
              }

        }
        // return dd($optional_model);
      
        $findoldCate = DB::table('sub_pro_categories as c')
        ->where('c.url_item',$name)
        ->first();

        if(isset($slgSeries) && isset($findoldCate)){
            $findoldSeries = DB::table('series as s')
            ->where('s.slug',$slgSeries)
            ->first();
            if($findoldSeries){
                return  redirect()->route('producsList',[$name,$findoldCate->sub_pro_id,$findoldSeries->slug,$findoldSeries->se_id]);
            }else{
                abort(404);
            }
        }else if(isset($findoldCate) && !isset($procode)){
            return  redirect()->route('producsList',[$name,$findoldCate->sub_pro_id]);
        }

        if($name == 'configurable-product-selection'){
            return redirect()->route('configurableproduct');
        }
        if($name == 'index'){
            return redirect()->route('productFinder');
        }
        $lang = App::getLocale();
        session(['lang_down' =>  $lang]);
        $proCode  = str_replace("@", "/", $pro_code);
        // return dd($proCode);
        $check = DB::table('products as p')
        ->where('p.pro_code',$proCode)
        ->where('p.enable_pro',1)
        ->first();

        $check_2 = DB::table('product_optional_model as po')
        ->join('products as p', 'p.pro_id', '=', 'po.product_id')
        ->where('po.optional_model',$proCode)
        ->select('p.pro_code','po.optional_model')
        ->first();

        if(isset($check->pro_id)){
            $prolang =  self::checkLang($lang ,$check->pro_id);
        
        }
        else if($check_2){
            return redirect()->route('productsDetailsByType',[$catename,$check_2->pro_code] );
        }
        else{
 
            abort(404);
        }
    
        $pro = DB::table('products as p')
        ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
        ->join('series_translations as st', 'st.series_id', '=', 'p.series_id')
        ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
        ->join('sub_pro_categories as sp', 'sp.sub_pro_id', '=', 'phc.categories_id')
        ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'sp.sub_pro_id')
        ->where('pt.local' ,$prolang)
        ->where('st.local' ,$lang)
        ->where('p.pro_id',$check->pro_id)
        ->select('p.*', 'pt.*' ,'st.title as serieName' ,'spt.name as catename','spt.sub_pro_id as pro_categories_id','sp.unit_dimension','sp.unit_dimension_1' )
        ->orderBy('p.created_at', 'desc')
        ->first();

        // $contenterorIfnot = DB::table('product_has_property as ph')
        // ->where('ph.product_id',$pro->pro_id)
        // ->whereIn('ph.type_id',[4,3,8])
        // ->orderBy('ph.type_id' ,'asc')
        // ->select('ph.*')
        // ->get();

        if(!self::checkContentPro($pro->pro_id)){
            abort(404); 
        }

        $external_link = DB::table('external_link as e')
         ->select('e.*')
         ->where('e.products',$pro->pro_id)
         ->get();  

        //   return dd($pro);

        $vieo_img = DB::table('product_image as pm')
        ->where('pm.pro_id' ,$pro->pro_id)
        ->select('pm.*')
        ->orderBy('pm.created_at' ,'asc')
        ->get();
        $tags_pro = DB::table('product_tags as pt')
        ->where('pt.product_id',$pro->pro_id)
        ->where('pt.tag','!=',' ')
        ->select('pt.*')
        ->get();

        $optional_pro = DB::table('product_optional_model as op')
        ->where('op.product_id',$pro->pro_id)
        ->select('op.*')
        ->get();
        $documents = DB::table('product_has_documents as phd')
        ->join('products as p','p.pro_id','=','phd.product_id')
        ->join('product_ducuments as pd','phd.document_id','=','pd.doc_id')
        ->join('product_ducument_translations as pdt','pdt.doc_fk_id','=','pd.doc_id')
        ->join('products_documents_categories as pdc','pdc.id','=','pd.cate_id')
        ->where('phd.product_id',$pro->pro_id)
        ->where('pdt.local',$lang)
        ->where('pdt.file','!=', null)
        ->where('pdt.file','!=', '')
        ->whereNotIn('pdc.id', [4])
        ->select('p.pro_code','pd.doc_id','p.pro_id as product_id','pdt.name','pdc.title as catename','pdc.slug','pd.created_at' ,'pdc.main_cate_id','pdt.file' ,'pd.cate_id')
        ->orderBy('pdc.title','asc')
        ->get();

        // return dd($documents);
   
        $product_has_property = DB::table('product_has_property as ph')
        ->join('product_has_property_translation as pht','ph.per_id' ,'=','pht.per_fk_id')
        ->join('product_field as pf','pf.id' ,'=','ph.type_id')
        ->join('product_field_translation as pft','ph.type_id' ,'=','pft.product_field_id')
        ->where('pht.local' ,'en')
        ->where('pft.local' ,$lang)
        ->where('ph.product_id',$pro->pro_id)
        ->where('ph.type_id','!=',115)
        ->orderBy('ph.type_id' ,'asc')
        ->select('pht.value_text','ph.*','pf.section_id' ,'pft.field_name as fieldCate','pf.unit_name')
        ->get();

        // return dd($product_has_property);

        $series_has_application = DB::table('series_has_application as shp')
        ->join('application as app', 'app.id', '=', 'shp.app_id')
        ->join('application_translation as appt' ,'appt.app_id' ,'=' ,'app.id')
        ->where('appt.local' ,'en')
        ->where('shp.se_id' ,$pro->series_id)
        ->select('shp.app_id','app.*' ,'appt.name' )
        ->get();


     

        $data = [];
                $arraysub = [];
                $arraysub = DB::table('product_has_property as ph')
                ->join('product_has_property_translation as pht','ph.per_id' ,'=','pht.per_fk_id')
                ->join('product_field as pf','pf.id' ,'=','ph.type_id')
                ->join('product_field_translation as pft','ph.type_id' ,'=','pft.product_field_id')
                ->where('ph.product_id',$pro->pro_id)
                ->where('pht.local' ,'en')
                ->where('pft.local' ,$lang)
                ->whereIn('ph.type_id',[4,3,8,31])
                ->orderBy('ph.type_id' ,'asc')
                ->select('pht.value_text','ph.*' ,'pft.field_name as fieldCate','pf.unit_name')
                ->get();
                $data[0] = [
                    "pro_id"=>$pro->pro_id,
                    "pro_code"=>$pro->pro_code,
                    "picture"=>$pro->picture,
                    "created_at"=>$pro->created_at,
                    "updated_at"=>$pro->updated_at,
                    "unit_weight"=>$pro->unit_weight,
                    "unit_dimension"=>$pro->unit_dimension,
                    "unit_dimension_1"=>$pro->unit_dimension_1,
                    "content_1"=>$pro->content_1,
                    "content_2"=>$pro->content_2,
                    "serie_id"=>$pro->series_id,
                    "serie_name"=>$pro->serieName,
                    "cate_name"=>$pro->catename,
                    "cate_id"=>$pro->pro_categories_id,
                    "content" =>$arraysub,
                    "dimensionL"=>$pro->dimensionL,
                    "dimensionW"=>$pro->dimensionW,
                    "dimensionD"=>$pro->dimensionD,
                ];
                //  return dd( $data);
          
                $product_related = DB::table('product_related as pr')
                ->join('products as p', 'p.pro_id', '=', 'pr.related_id')
                ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
                ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
                ->join('sub_pro_categories as sp', 'sp.sub_pro_id', '=', 'phc.categories_id')
                ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'sp.sub_pro_id')
                ->where('pt.local' ,$lang)
                ->where('spt.local' ,$lang)
                ->where('pr.product_id',$pro->pro_id)
                ->where('p.enable_pro' ,1)
                ->select('p.*', 'pt.*' ,'spt.name as catename' ,'spt.sub_pro_id as pro_categories_id' ,'sp.unit_dimension')
                ->get();

         
                $date = now();
                $datefor = date('Y-m-d H:i:s',strtotime($date) - ((24*3600*365)*2));
          if(count($product_related) == 0){
            $product_related = DB::table('products as p')
            ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
            ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
            ->join('sub_pro_categories as sp', 'sp.sub_pro_id', '=', 'phc.categories_id')
            ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'sp.sub_pro_id')
            ->where('pt.local' ,$lang)
            ->where('spt.local' ,$lang)
            ->where('p.pro_id','!=' ,$pro->pro_id)
            ->where('phc.categories_id',$pro->pro_categories_id)
            ->where('p.enable_pro',1)
            ->where('p.created_at','>',$datefor)
            ->select('p.*', 'pt.*' ,'spt.name as catename' ,'spt.sub_pro_id as pro_categories_id' ,'sp.unit_dimension')
            ->limit(4)
            ->inRandomOrder()
            ->get();
          }
        
          
            $data_other = [];
            $data_check_poOther = [];
                 $j = 0;
                foreach($product_related as $pro){
                    $arraysub = [];
                    $arraysub = DB::table('product_has_property as ph')
                    ->join('product_has_property_translation as pht','ph.per_id' ,'=','pht.per_fk_id')
                    ->join('product_field as pf','pf.id' ,'=','ph.type_id')
                    ->join('product_field_translation as pft','ph.type_id' ,'=','pft.product_field_id')
                    ->where('ph.product_id',$pro->pro_id)
                    ->where('pht.local' ,'en')
                    ->where('pft.local' ,$lang)
                    ->whereIn('ph.type_id',[3,4,8,31])
                    ->orderBy('ph.type_id' ,'asc')
                    ->select('pht.value_text','ph.*' ,'pft.field_name as fieldCate','pf.unit_name')
                    ->get();
                if(!in_array($pro->pro_id, $data_check_poOther) && self::checkContentPro($pro->pro_id)){
                    array_push($data_check_poOther,$pro->pro_id);
                    $data_other[$j] = [
                        "pro_id"=>$pro->pro_id,
                        "pro_code"=>$pro->pro_code,
                        "catename"=>$pro->catename,
                        "cate_id"=>$pro->pro_categories_id,
                        "picture"=>$pro->picture,
                        "unit_dimension"=>$pro->unit_dimension,
                        "status_product"=>$pro->status_product,
                        "content" =>$arraysub,
                        "dimensionL"=>$pro->dimensionL,
                        "dimensionW"=>$pro->dimensionW,
                        "dimensionD"=>$pro->dimensionD,
                    ];
                   }
                 
                    $j++;
                }
                // return dd($data_other);
                $section = DB::table('section as st')
                ->join('section_translation as stt','st.id','=','stt.section_id')
                ->where('stt.local',$lang)
                // ->where('st.status', 1)
                ->select('st.id', 'stt.sortname','stt.name')
                ->get(); 

         
         
        //  return dd($external_link ,'external_link');
              
        
        return  view('front-end.productdetails')
        ->with('optional_model' , $optional_model)
        ->with('tags_pro' , $tags_pro)
        ->with('optional_pro',$optional_pro)
        ->with('vieo_img' , $vieo_img)
        ->with('documents' , $documents)
        ->with('series_has_application' , $series_has_application)
        ->with('Otherpros' , $data_other)
        ->with('section' , $section)
        ->with('product_has_property' , $product_has_property)
        ->with('external_link' , $external_link)
        ->with('product' , $data);
    }
    public function resultSearch(){
        return  view('front-end.resultsearch');
    }
    public function productCoparison(){
        $lang = App::getLocale();
        $sess_arr = session('product_comp');
        $data  = DB::table('products as p')
        ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
        ->join('series_translations as st', 'st.series_id', '=', 'p.series_id')
        ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
        ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'phc.categories_id')
        ->where('pt.local' ,$lang)
        ->where('spt.local' ,$lang)
        ->where('st.local' ,$lang)
        ->where('pt.showstatus' ,1)
        ->whereIn('p.pro_id' ,$sess_arr)
        ->select('p.*', 'pt.*','spt.sub_pro_id as pro_categories_id','spt.name as catename','st.title as seName')
        ->orderBy('p.created_at', 'desc')
        ->get();
        $cateid  = null;
 
        if(isset($data) && count($data) > 0){
          $cateid = $data[0]->pro_categories_id;
        }
  
        $Categories = DB::table('sub_pro_categories as sp')
            ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'sp.sub_pro_id')
            ->where('spt.local', '=', $lang)
            ->where('sp.status', '=', 1)
            ->select('sp.*', 'spt.*')
            ->orderBy('spt.name', 'asc')
            ->get();
         $products = [];
         $seachpro = DB::table('products as p')
            ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
            ->join('product_has_categories as phc', 'p.pro_id', '=', 'phc.product_id')
            ->where('pt.local' ,$lang)
            ->where('pt.showstatus' ,1)
            ->where('phc.categories_id',$cateid)
            ->select('p.*', 'pt.*')
            ->orderBy('p.pro_code', 'asc')
            ->get();
            foreach($seachpro as $pro){
            if(self::checkContentPro($pro->pro_id)){
                array_push($products,$pro);
                $optional_product = DB::table('product_optional_model as po')
                    ->join('products as p', 'p.pro_id', '=', 'po.product_id')
                    ->join('product_has_categories as phc', 'p.pro_id', '=', 'phc.product_id')
                    ->where('p.enable_pro' ,1)
                    ->where('phc.categories_id' ,$cateid)
                    ->where('po.product_id' ,$pro->pro_id)
                    ->select('p.*','po.optional_model as pro_code')
                    ->orderBy('p.pro_code', 'asc')
                    ->get();
                    foreach($optional_product as $optional_model){
                        array_push($products,$optional_model);
                    }

        
            } 
        }
        $pd_field = DB::table('product_field as pf')
        ->join('product_field_translation as pft', 'pf.id', '=', 'pft.product_field_id')
        ->where('pft.local', '=', $lang)
        ->where('pf.id', '!=', 115)
        ->select('pf.*', 'pft.field_name')
        ->orderBy('pf.id', 'asc')
        ->get();
        $section = DB::table('section as st')
        ->join('section_translation as stt','st.id','=','stt.section_id')
        ->where('stt.local','=', $lang)
        ->select('st.id','stt.name')
        ->get();

        // $product_has_property = DB::table('product_has_property as ph')
        // ->join('product_has_property_translation as pht','ph.per_id' ,'=','pht.per_fk_id')
        // ->join('product_field as pf','pf.id' ,'=','ph.type_id')
        // ->join('product_field_translation as pft','ph.type_id' ,'=','pft.product_field_id')
        // ->where('pht.local' ,$lang)
        // ->where('pft.local' ,$lang)
        // ->whereIn('ph.product_id',$sess_arr)
        // ->orderBy('ph.type_id' ,'asc')
        // ->select('pht.value_text','ph.*' ,'pft.field_name as fieldCate','pf.unit_name')
        // ->get();
        //  return dd($product_has_property);

        $metatag = DB::table('meta_tag_page as mtp')->where('id',13)->get();
        return  view('front-end.productcoparison')
        ->with('metatag' ,$metatag)
        ->with('cateid' ,$cateid)
        ->with('sess_arr' ,$sess_arr)
        ->with('data_re' ,$data)
        ->with('section' ,$section)
        ->with('Categories' ,$Categories)
        ->with('pd_field' ,$pd_field)
        ->with('products' ,$products);
    }
    public function getProductByType(Request $request)
    {   $lang = App::getLocale();
        $cateid = $this->validateInput($request->typeId,'number',true);
        $products = [];

        $seachpro = DB::table('products as p')
            ->join('product_has_categories as phc', 'p.pro_id', '=', 'phc.product_id')
            ->where('p.enable_pro' ,1)
            ->where('phc.categories_id' ,$cateid)
            ->select('p.*')
            ->orderBy('p.pro_code', 'asc')
            ->get();

        foreach($seachpro as $pro){
            if(self::checkContentPro($pro->pro_id)){
                array_push($products,$pro);
                $optional_product = DB::table('product_optional_model as po')
                    ->join('products as p', 'p.pro_id', '=', 'po.product_id')
                    ->join('product_has_categories as phc', 'p.pro_id', '=', 'phc.product_id')
                    ->where('p.enable_pro' ,1)
                    ->where('phc.categories_id' ,$cateid)
                    ->where('po.product_id' ,$pro->pro_id)
                    ->select('p.*','po.optional_model as pro_code')
                    ->orderBy('p.pro_code', 'asc')
                    ->get();
                    foreach($optional_product as $optional_model){
                        array_push($products,$optional_model);
                    }

        
            } 
        }

        return response()->json([
            'data' => $products
        ],200);
    }
    public function clearproductsection(Request $request){
        session(['product_comp' =>  []]);
        return response()->json([
            'data' => 'success'
        ],200);
    }
    public function loadImageProByArr(Request $request)
    {
        // $arr_pro = $request->arr_pro;
        $arr_pro = $this->validateInput($request->arr_pro,'array',true);
        //$typeid = $request->typeid;
        $typeid = $this->validateInput($request->typeid,'number',true);
    
        $lang = App::getLocale();
        $products = DB::table('products as p')
        ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
        ->join('series_translations as st', 'st.series_id', '=', 'p.series_id')
        ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
        ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'phc.categories_id')
        ->where('pt.local' ,$lang)
        ->where('spt.local' ,$lang)
        ->where('st.local' ,$lang)
        ->where('pt.showstatus' ,1)
        ->whereIn('p.pro_id' ,$arr_pro)
        ->where('phc.categories_id',$typeid)
        ->select('p.*', 'pt.*','spt.name as catename','st.title as seName')
        ->orderBy('p.created_at', 'desc')
        ->get();

        return response()->json([
            'data' => $products,
            'type' =>$typeid,
        ],200);
    }
    public function checkProductSection(Request $request){
            $lang = App::getLocale();
            $data_id = $this->validateInput($request->data,'number',true);
            $cateid = $this->validateInput($request->cateid,'number',true);
            $sess_arr = session('product_comp');
            //  session(['product_comp' =>  []]);

            $Newsproduct = DB::table('products as p')
            ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
            ->join('series_translations as st', 'st.series_id', '=', 'p.series_id')
            ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
            ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'phc.categories_id')
            ->where('pt.local' ,$lang)
            ->where('spt.local' ,$lang)
            ->where('st.local' ,$lang)
            ->where('pt.showstatus' ,1)
            ->where('p.pro_id' ,$data_id)
            ->where('phc.categories_id' ,$cateid)
            ->select('p.*', 'pt.*','phc.categories_id as pro_categories_id')
            ->orderBy('p.created_at', 'desc')
            ->first();
            $data = [];

            $dataFirst  = DB::table('products as p')
            ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
            ->join('series_translations as st', 'st.series_id', '=', 'p.series_id')
            ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
            ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'phc.categories_id')
            ->where('pt.local' ,$lang)
            ->where('spt.local' ,$lang)
            ->where('st.local' ,$lang)
            ->where('pt.showstatus' ,1)
            ->where('p.pro_id' ,$data_id)
            ->where('phc.categories_id' ,$cateid)
            ->select('p.*', 'pt.*','spt.name as catename','st.title as seName')
            ->orderBy('p.created_at', 'desc')
            ->get();

        
       if(empty($sess_arr)){
           array_push($sess_arr,$data_id);
           session(['product_comp' =>  $sess_arr]);
           session(['section_Cateid' => $cateid]);
           return response()->json([
            'section' =>  $sess_arr,
            'data' =>  $dataFirst,
            'message' =>  'The selected model has been added to the Comparison list.',
        ],200);
       }else{
           $oldpro  = DB::table('products as p')
           ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
           ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
           ->where('pt.local' ,$lang)
           ->where('pt.showstatus' ,1)
           ->whereIn('p.pro_id' ,$sess_arr)
           ->where('phc.categories_id' ,$cateid)
           ->select('p.*', 'pt.*' ,'phc.categories_id as pro_categories_id')
           ->orderBy('p.created_at', 'desc')
           ->get();
                 if((!in_array($data_id, $sess_arr)) && isset($oldpro[0]->pro_categories_id)  && $Newsproduct->pro_categories_id == $oldpro[0]->pro_categories_id ){
                    if(count($sess_arr) < 3){
                        array_push($sess_arr,$data_id);
                        session(['product_comp' =>  $sess_arr]);
                        $data  = DB::table('products as p')
                        ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
                        ->join('series_translations as st', 'st.series_id', '=', 'p.series_id')
                        ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
                        ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'phc.categories_id')
                        ->where('pt.local' ,$lang)
                        ->where('spt.local' ,$lang)
                        ->where('st.local' ,$lang)
                        ->where('phc.categories_id' ,$cateid)
                        ->whereIn('p.pro_id' ,$sess_arr)
                        ->select('p.*', 'pt.*','spt.name as catename','st.title as seName')
                        ->orderBy('p.created_at', 'desc')
                        ->get();


                        return response()->json([
                            'section' =>  $sess_arr,
                            'data' =>  $data,
                            'cateid' =>  $cateid,
                            'message' =>  'The selected model has been added to the Comparison list.',
                        ],200);
                    }else{
                       
                        $data  = DB::table('products as p')
                        ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
                        ->join('series_translations as st', 'st.series_id', '=', 'p.series_id')
                        ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
                        ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'phc.categories_id')
                        ->where('pt.local' ,$lang)
                        ->where('spt.local' ,$lang)
                        ->where('st.local' ,$lang)
                        ->where('phc.categories_id' ,$cateid)
                        ->whereIn('p.pro_id' ,$sess_arr)
                        ->select('p.*', 'pt.*','spt.name as catename','st.title as seName')
                        ->orderBy('p.created_at', 'desc')
                        ->get();

                        return response()->json([
                            'section' =>  $sess_arr,
                            'data' =>  $data,
                            'cateid' =>  $cateid,
                            'message' =>  'Only 3 models can be added to the Comparison list.',
                        ],200);
                    }
                
                }elseif(in_array($data_id, $sess_arr)){
                   
                        $data  = DB::table('products as p')
                        ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
                        ->join('series_translations as st', 'st.series_id', '=', 'p.series_id')
                        ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
                        ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'phc.categories_id')
                        ->where('pt.local' ,$lang)
                        ->where('spt.local' ,$lang)
                        ->where('st.local' ,$lang)
                        ->where('phc.categories_id' ,$cateid)
                        ->whereIn('p.pro_id' ,$sess_arr)
                        ->select('p.*', 'pt.*','spt.name as catename','st.title as seName')
                        ->orderBy('p.created_at', 'desc')
                        ->get();

                    return response()->json([
                        'section' =>  $sess_arr,
                        'data' =>  $data,
                        'cateid' =>  $cateid,
                        'message' =>  'The selected model has been added to the Comparison list.',
                    ],200);
                 }else{
                    $catesection =  session('section_Cateid');
                    $data  = DB::table('products as p')
                    ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
                    ->join('series_translations as st', 'st.series_id', '=', 'p.series_id')
                    ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
                    ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'phc.categories_id')
                    ->where('pt.local' ,$lang)
                    ->where('spt.local' ,$lang)
                    ->where('st.local' ,$lang)
                    ->where('phc.categories_id' ,$catesection)
                    ->whereIn('p.pro_id' ,$sess_arr)
                    ->select('p.*', 'pt.*','spt.name as catename','st.title as seName')
                    ->orderBy('p.created_at', 'desc')
                    ->get();
                    return response()->json([
                        'section' =>  $sess_arr,
                        'data' =>  $data,
                        'cateid' =>  $catesection,
                        'message' =>  'Please select the model in the same category',
                     ],200);
                  }
                
         }
          

       
    }
    public function RemovedataInSection(Request $request)
    {
        $lang = App::getLocale();
        $input = $request->data;
        $sess_arr = session('product_comp');
        $cateid =  session('section_Cateid');
        $arr_new  = [];
        if (($key = array_search($input, $sess_arr)) !== false) {
         unset($sess_arr[$key]);
        }
        session(['product_comp' =>  $sess_arr]);
     
        $data  = DB::table('products as p')
        ->join('series_translations as st', 'st.series_id', '=', 'p.series_id')
        ->leftjoin('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
        ->leftjoin('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'phc.categories_id')
        ->where('spt.local' ,$lang)
        ->where('st.local' ,$lang)
        ->whereIn('p.pro_id' ,$sess_arr)
        ->where('phc.categories_id' ,$cateid)
        ->select('p.*','spt.name as catename','st.title as seName')
        ->orderBy('p.created_at', 'desc')
        ->get();

        return response()->json([
            'section' => $sess_arr,
            'data' =>  $data ,
            'message' =>  'The selected model has been removed to the Comparison list.',
        ],200);
    }
    public function productFinder(){
        $lang = App::getLocale();
        $subCategories = DB::table('sub_pro_categories as sp')
            ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'sp.sub_pro_id')
            ->where('spt.local', '=', $lang)
            ->where('sp.status', '=', 1)
            ->select('sp.*', 'spt.*')
            ->orderBy('sp.order_seq', 'asc')
            ->get();
        $metatag = DB::table('meta_tag_page as mtp')->where('id',4)->get();
        return  view('front-end.productfinder')
        ->with('subCategories',$subCategories)->with('metatag',$metatag);
    }
    public function applicationDetail($namePram){
        $name = $this->validateInput($namePram,'text',true);
        $lang = App::getLocale();
        $myArray = explode('-', $name);
        $id =  $myArray[0];
      
        $application = DB::table('application as ap')
        ->join('application_translation as apt','ap.id','=','apt.app_id')
        ->where('apt.local','=',$lang)
        ->where('ap.id' , $id)
        ->select('ap.*' ,'ap.id as applica_id' , 'apt.name' ,'apt.content' ,'apt.overview' ,'apt.overview_text')
        ->orderBy('ap.order_seq' ,'asc')
        ->first();

        $image = DB::table('more_image_app as mp')
        ->where('mp.app_id' ,$id)
        ->select('mp.*')
        ->get(); 

        $otherapp = DB::table('application as ap')
        ->join('application_translation as apt','ap.id','=','apt.app_id')
        ->where('apt.local','=',$lang)
        ->where('ap.id','!=' , $id)
        ->select('ap.*' ,'ap.id as applica_id' , 'apt.name' ,'apt.content' ,'apt.overview')
        ->orderBy('ap.order_seq' ,'asc')
        ->get();
        
        $relatedApp = DB::table('series_has_application as sp')
        ->join('series as s' ,'s.se_id' ,'=' ,'sp.se_id')
        ->join('series_translations as st' ,'st.series_id' ,'=' ,'sp.se_id')
        ->where('sp.app_id','=',$id)
        ->where('st.local' ,'en')
        ->where('s.status' ,1)
        ->select('s.image','sp.*','st.title' ,'st.overview_content')
        ->orderBy('sp.order_sq' ,'asc')
        ->get();

        return  view('front-end.applicationdetail')
        ->with('image' ,$image)
        ->with('otherapp' ,$otherapp)
        ->with('relatedApp' ,$relatedApp)
        ->with('application' ,$application);
    }

    public function aboutUs($pageparam){
        $page = $this->validateInput($pageparam,'text',true);
        $lang = App::getLocale();
        $aboutus =  DB::table('about_us as au')
        ->join('about_us_translations as aut', 'au.id', '=', 'aut.abt_id')
        ->where('aut.local', '=',$lang)
        ->where('au.stug', '=',$page)
        ->select('au.*' ,'aut.*')
        ->get();
        // return dd($aboutus);
        if($page == 'global-operations'){
            $aboutus =  DB::table('about_us as au')
            ->join('about_us_translations as aut', 'au.id', '=', 'aut.abt_id')
            ->where('aut.local', '=',$lang)
            ->where('au.stug', '=','global-operations')
            ->select('au.*' ,'aut.*')
            ->get();
            return  view('front-end.about-global')->with('aboutus' ,$aboutus);
        }else{

            return  view('front-end.about-us')->with('aboutus' ,$aboutus);
        }
       
    }

    public function updateNewsDetail($namePar){
     
        $lang = App::getLocale();
      
        $name = $this->validateInput($namePar ,'text',true);
        $contents = DB::table('product_news_has_categories as pnc')
        ->join('contents as c' ,'c.id' ,'=','pnc.content_id')
        ->join('contents_translations as ct' ,'ct.content_id' ,'=','c.id')
        ->join('news_type as nt' ,'nt.id' ,'=','pnc.categories_id')
        ->join('news_type_translation as ntt' ,'ntt.fk_nt_id' ,'=','nt.id')
        ->where('c.slug',$name)
        ->where('ct.local', '=', $lang)
        ->where('ntt.local', '=', $lang)
        ->where('c.content_type', '=', 'news')
        ->select('c.*' ,'ct.*' ,'pnc.categories_id','ntt.title as cateName','nt.color_type')
        ->orderBy('c.created_at', 'desc')
        ->get();
       
        if(count($contents) == 0){
            abort(404);
        }
        $otherNews = [];

        if(count($contents) != 0 ){
            $otherNews = DB::table('product_news_has_categories as pnc')
            ->join('contents as c' ,'c.id' ,'=','pnc.content_id')
            ->join('contents_translations as ct' ,'ct.content_id' ,'=','c.id')
            ->join('news_type as nt' ,'nt.id' ,'=','pnc.categories_id')
            ->join('news_type_translation as ntt' ,'ntt.fk_nt_id' ,'=','nt.id')
            ->where('ct.local', '=',$lang)
            ->where('ntt.local','=', $lang)
            ->where('c.id','!=',$contents[0]->id)
            ->where('pnc.categories_id' ,$contents[0]->categories_id)
            ->where('c.content_type', '=', 'news')
            ->select('c.*' ,'ct.*' ,'pnc.categories_id','ntt.title as cateName' ,'nt.color_type')
            ->where('c.status' ,1)
            ->limit(3)
            ->inRandomOrder()
            ->get();
        }
    

        //  return dd($contents);
        return  view('front-end.news-detail')
        ->with('otherNews' ,$otherNews)
        ->with('contents' ,$contents);
    }
    public function updateEventDetail($namePar){
        $lang = App::getLocale();
        
        $name = $this->validateInput($namePar ,'text',true);
        $contents = DB::table('contents as c')
        ->join('contents_translations as ct' ,'ct.content_id' ,'=','c.id')
        ->where('ct.local', $lang)
        ->where('c.content_type', '=', 'event')
        ->where('c.status', 1)
        ->where('c.slug' ,$name)
        ->select('c.*' ,'ct.*')
        ->orderBy('c.date_publish', 'desc')
        ->get();

        if(count($contents) == 0){
            abort(404);
        }

        // return dd($contents);
        $otherNews = [];
        $otherNews = DB::table('contents as c')
        ->join('contents_translations as ct' ,'ct.content_id' ,'=','c.id')
        ->where('ct.local', $lang)
        ->where('c.content_type', '=', 'event')
        ->where('c.status',  1)
        ->select('c.*' ,'ct.*')
        ->orderBy('c.date_publish', 'desc')
        ->limit(3)
        ->get();
        // if(count($contents) != 0 ){
        //     $otherNews = DB::table('contents as c')
        //     ->join('contents_translations as ct' ,'ct.content_id' ,'=','c.id')
        //     ->where('ct.local', $lang)
        //     ->where('c.content_type', '=', 'event')
        //     ->where('c.status',  1)
        //     ->where('c.id','!=',$contents[0]->id)
        //     ->select('c.*' ,'ct.*')
        //     ->limit(3)
        //     ->inRandomOrder()
        //     ->get();
        // }
        return  view('front-end.event-detail')
        ->with('otherNews' ,$otherNews)
        ->with('contents' ,$contents);
    }
    public function updateTechnicalDetail($namePar){
        $lang = App::getLocale();
        $name = $this->validateInput($namePar ,'text',true);
        $contents = DB::table('article_has_categories as anc')
        ->join('contents as c' ,'c.id' ,'=','anc.content_id')
        ->join('contents_translations as ct' ,'ct.content_id' ,'=','c.id')
        ->join('tech_type as ty' ,'ty.id' ,'=','anc.categories_id')
        ->join('tech_type_translation as tyt' ,'ty.id' ,'=','tyt.tech_id')
        ->where('ct.local',  $lang)
        ->where('tyt.local',  $lang)
        ->where('c.status',  1)
        ->where('c.slug',$name)
        ->where('c.content_type', '=', 'blog')
        ->select('c.*' ,'ct.*','tyt.name as cateName')
        ->orderBy('c.date_publish', 'desc')
        ->get();
        // return dd($contents);
        $otherNews = [];
        if(count($contents) != 0 ){
            $otherNews = DB::table('article_has_categories as anc')
            ->join('contents as c' ,'c.id' ,'=','anc.content_id')
            ->join('contents_translations as ct' ,'ct.content_id' ,'=','c.id')
            ->join('tech_type as ty' ,'ty.id' ,'=','anc.categories_id')
            ->join('tech_type_translation as tyt' ,'ty.id' ,'=','tyt.tech_id')
            ->where('ct.local',  $lang)
            ->where('tyt.local',  $lang)
            ->where('c.status',  1)
            ->where('c.id',  $contents[0]->id)
            ->where('c.content_type', '=', 'blog')
            ->select('c.*' ,'ct.*','tyt.name as cateName')
            ->orderBy('c.date_publish', 'desc')
            ->get();
        }
        return  view('front-end.technical-detail')
        ->with('otherNews' ,$otherNews)
        ->with('contents' ,$contents);;
    }
    public function updateProductNoticelDetail(){
        return  view('front-end.product-notice-detail');
    }
    public function contactSupport(){
        
        $lang = App::getLocale();
        $subCategories = DB::table('sub_pro_categories as sc')
        ->join('sub_pro_categories_translation as sct', 'sct.sub_pro_id', '=', 'sc.sub_pro_id')
        ->select('sc.*', 'sct.*')
        ->where('sct.local',  $lang)
        ->orderBy('sct.name', 'asc')
        ->get();
        
        $series =  DB::table('series_has_pro_categories as sc')
            ->join('series as s' ,'sc.se_id' ,'=' ,'s.se_id')
            ->join('series_translations as st' ,'st.series_id' ,'=' ,'s.se_id')
            ->where('st.local' ,'en')
            ->where('s.status' ,1)
            ->select('s.*' ,'st.*' ,'sc.pro_categories_id')
            ->distinct()
            ->orderBy('st.title','asc')
            ->get();
            // return dd(session('enquireModel'));
  
        $metatag = DB::table('meta_tag_page as mtp')->where('id',10)->get();
        $setType  =  DB::table('email_notification as et')
        ->select('et.*')
        ->where('et.type', 3)
        ->get();
        $arr_settype = [];
        foreach($setType as $type){
         array_push($arr_settype ,$type->product_type);
        }

        //  return dd($arr_settype);
        return  view('front-end.support')
            ->with('arr_settype' ,$arr_settype)
            ->with('metatag' ,$metatag)
            ->with('subCategories' ,$subCategories)
            ->with('series' ,$series);
    }
    public function contactSalesOffices(){
        $lang = App::getLocale();
        $continents = DB::table('continents as c')
        ->join('continents_translations as ct', 'c.id', '=', 'ct.cont_id')
        ->where('type_id' ,1)
        ->where('ct.local', '=', $lang)
        ->orderBy('c.order_seq','asc')
        ->select('c.*' ,'ct.*')
        ->get();

        $offices = DB::table('office as f')
        ->join('office_translations as oft', 'f.id', '=', 'oft.fk_office_id')
        ->where('f.type_id' ,1)
        ->where('oft.local', '=',  $lang)
        ->select('f.*' ,'oft.*')
        ->where('f.status',1)
        ->get();
        $metatag = DB::table('meta_tag_page as mtp')->where('id',11)->get();
    
        return  view('front-end.sales-offices')
        ->with('metatag',$metatag)
        ->with('offices',$offices)
        ->with('continents',$continents);
    }
    public function contactFindDistributor(){
        $lang = App::getLocale();
        $continents = DB::table('continents as c')
        ->join('continents_translations as ct', 'c.id', '=', 'ct.cont_id')
        ->where('type_id' ,2)
        ->where('ct.local', '=', $lang)
        ->select('c.*' ,'ct.*')
        ->get();

        $offices = DB::table('office as f')
        ->join('office_translations as oft', 'f.id', '=', 'oft.fk_office_id')
        ->where('f.type_id' ,2)
        ->where('oft.local', '=',  $lang)
        ->where('f.status',1)
        ->select('f.*' ,'oft.*')
        ->get();
        $metatag = DB::table('meta_tag_page as mtp')->where('id',12)->get();
        return  view('front-end.find-distributor')
        ->with('metatag',$metatag)
        ->with('offices',$offices)
        ->with('continents',$continents);
    }
    public function termsOfUse(){
        $lang = App::getLocale();
        $static_content = DB::table('static_content as st')
        ->join('static_content_translations as sct','st.sta_id','=','sct.sta_fk_id')
        ->where('type_con_id',6)
        ->where('sct.local',$lang)
        ->select('st.*','sct.*')
        ->first();
        $metatag = DB::table('meta_tag_page as mtp')->where('id',24)->get();
        return  view('front-end.terms-of-use')
        ->with('metatag',$metatag)
        ->with('static_content',$static_content);
    }
  
    public function privacyPolicy(){
        $lang = App::getLocale();
        $static_content = DB::table('static_content as st')
        ->join('static_content_translations as sct','st.sta_id','=','sct.sta_fk_id')
        ->where('type_con_id',5)
        ->where('sct.local',$lang)
        ->select('st.*','sct.*')
        ->first();
        $metatag = DB::table('meta_tag_page as mtp')->where('id',25)->get();
        return  view('front-end.privacy-policy')
        ->with('metatag',$metatag)
        ->with('static_content',$static_content);
    }
    public function configurableProductDetail(){
        $lang = App::getLocale();
        $subCategories = DB::table('sub_pro_categories as sc')
        ->join('sub_pro_categories_translation as sct', 'sct.sub_pro_id', '=', 'sc.sub_pro_id')
        ->where('sc.sub_pro_id', 7)
        ->select('sc.*', 'sct.*')
        ->orderBy('sc.created_at', 'desc')
        ->where('sct.local',$lang)
        ->get();
        // return dd($subCategories);
        return  view('front-end.Configure-detail')->with('subCategories' ,$subCategories);
    }
    public function productLaunchSchedule(){
        $sectionId = session('partner_id');
        if($sectionId == null){
            return redirect()->route('index','login');
        }
      
        $lang = App::getLocale();
        $relate_pro_launch_schedule = DB::table('relate_pro_launch_schedule as rpls')
        ->join('relate_pro_launch_schedule_translation as rplst' ,'rplst.fk_relate_pl' ,'=' ,'rpls.re_id')
        ->join('product_launch_schedule_month as plsm' ,'plsm.pl_m_id' ,'=' ,'rpls.fk_pl')
        ->join('product_launch_schedule as pls' ,'pls.pl_id' ,'=' ,'plsm.pl_fk_id')
        ->select('rpls.*' ,'rplst.*' ,'plsm.month as monthdate' ,'pls.title' ,'pls.date as years')
        ->where('rplst.local' ,$lang)
        ->get();

        $metatag = DB::table('meta_tag_page as mtp')->where('id',16)->get();

        return  view('front-end.product-launch-schedule')
        ->with('metatag' ,$metatag)
        ->with('relate_pro_launch_schedule' ,$relate_pro_launch_schedule);
    }
    public function marketingResources(){
        $lang = App::getLocale();
        $sectionId = session('partner_id');
        if($sectionId == null){
            return redirect()->route('index','login');
        }
        $static_content = DB::table('partner_page_info as pi')
        ->join('partner_page_info_translation as pit','pit.fk_p_id','=','pi.id')
        ->select('pi.*','pit.*')
        ->where('pit.local' ,$lang)
        ->get();
        $metatag = DB::table('meta_tag_page as mtp')->where('id',17)->get();
        return  view('front-end.marketing-resources')
        ->with('metatag' ,$metatag)
        ->with('static_content',$static_content);
    }
    public function marketingResourcesDownloads(){
        $lang = App::getLocale();
        $sectionId = session('partner_id');
        $roleId = session('partner_role');
        if($sectionId == null){
            return redirect()->route('index','login');
        }
        $margetCate = DB::table('permission_marketcate as permar')
            ->join('marketing_resource_cate as mc', 'permar.market_cate_id', '=', 'mc.cate_id')
            ->join('marketing_resource_cate_translations as mct', 'mc.cate_id', '=', 'mct.mk_fk_id')
            ->where('mct.local', '=',  $lang)
            ->where('mc.status', '=', 1)
            ->where('permar.permission_id', '=', $roleId)
            ->select('mc.*' ,'mct.*')
            ->get();

         $margeting = DB::table('marketing_resource as mr')
            ->join('marketing_resource_translations as mrt', 'mr.id', '=', 'mrt.mr_id')
            ->where('mrt.local', '=', $lang)
            ->select('mr.*' ,'mrt.*')
            ->get();
        $metatag = DB::table('meta_tag_page as mtp')->where('id',15)->get();
        return  view('front-end.marketing-resources-downloads')
        ->with('metatag',$metatag)
        ->with('margetCate',$margetCate)
        ->with('margeting',$margeting);
    }
    public function saleKit(){
        $lang = App::getLocale();
        $sectionId = session('partner_id');
        if($sectionId == null){
            return redirect()->route('index','login');
        }
        $product_docs = DB::table('partner_documents as s')
        ->join('partner_documents_translations as st', 's.id', '=', 'st.sk_fk_id')
        ->where('st.local' ,$lang)
        ->where('s.type_info' ,1)
        ->select('s.*', 'st.*')
        ->get();
        $metatag = DB::table('meta_tag_page as mtp')->where('id',19)->get();
        return  view('front-end.sale-kit')->with('metatag' ,$metatag)->with('product_docs' ,$product_docs);
    }
    public function productCrossReference(){
        $lang = App::getLocale();
        $sectionId = session('partner_id');
        if($sectionId == null){
            return redirect()->route('index','login');
        }
        $product_docs = DB::table('partner_documents as s')
        ->join('partner_documents_translations as st', 's.id', '=', 'st.sk_fk_id')
        ->where('st.local' ,$lang)
        ->where('s.type_info' ,2)
        ->select('s.*', 'st.*')
        ->get();
        $metatag = DB::table('meta_tag_page as mtp')->where('id',20)->get();
        return  view('front-end.product-cross-reference')->with('product_docs' ,$product_docs)->with('metatag', $metatag);
    }
    public function partnerinfo($id,$name){
        $lang = App::getLocale();
        $static_content = DB::table('partner_page_info as pi')
        ->join('partner_page_info_translation as pit','pit.fk_p_id','=','pi.id')
        ->where('pi.id',$id)
        ->select('pi.*','pit.*')
        ->where('pit.local' ,$lang)
        ->get();
        $sectionId = session('partner_id');
        if($sectionId == null){
            return redirect()->route('index','login');
        }
        return  view('front-end.video-guideline')->with('static_content' ,$static_content);
    }

    public function confighistory(Request $request){

        $params = $request->query->all();
        $lang = App::getLocale();

        $order = 'desc';

        if(array_key_exists('sort',$params)){

            if($params['sort'] == "asc" || $params['sort'] == 'desc'){
                $order = $params['sort'];
            }

        }

        if($order == "name_asc" || $order == "name_desc"){

            $con_his = DB::table('configuration_history as ch')
            ->select('ch.*')
            ->orderBy('ch.customer_model',$order == "name_asc" ? 'asc':'desc')
            ->get();
        }else{
            $con_his = DB::table('configuration_history as ch')
            ->select('ch.*')
            ->orderBy('ch.created_at',$order)
            ->get();
        }

        $sectionId = session('partner_id');

        if($sectionId == null){
            return redirect()->route('index','login');
        }

        $metatag = DB::table('meta_tag_page as mtp')->where('id',21)->get();

        return  view('front-end.config-history')->with('metatag' ,$metatag)->with('con_his' ,$con_his);
    }
    public function successStories(){
        $sectionId = session('partner_id');
        if($sectionId == null){
            return redirect()->route('index','login');
        }
        $AllsuccessStory =  DB::table('success_storys as s')
        ->select('s.*')
        ->orderBy('s.created_at', 'desc')
        ->get();
        $image_story =  DB::table('success_storys_image as ssi')
        ->select('ssi.*')
        ->get();
        $metatag = DB::table('meta_tag_page as mtp')->where('id',18)->get();
        return  view('front-end.success-stories')
        ->with('metatag' ,$metatag)
        ->with('sectionId' ,$sectionId)
        ->with('image_story' ,$image_story)
        ->with('AllsuccessStory' ,$AllsuccessStory);
    }
    public function addSuccessStories(){
        $lang = App::getLocale();
        $sectionId = session('partner_id');
        if($sectionId == null){
            return redirect()->route('index','login');
        }
        $products = DB::table('products as p')
        ->select('p.*')
        ->where('p.enable_pro', 1)
        ->orderBy('p.pro_code', 'asc')
        ->get();

        return  view('front-end.add-success-stories')
        ->with('products' ,$products);
    }
    public function editSuccessStories($idPar){
        $id = $this->validateInput($idPar ,'number',true);
        $lang = App::getLocale();
        $sectionId = session('partner_id');
        if($sectionId == null){
            return redirect()->route('index','login');
        }
        $products = DB::table('products as p')
        ->select('p.*')
        ->where('p.enable_pro', 1)
        ->orderBy('p.pro_code', 'asc')
        ->get();

        $AllsuccessStory =  DB::table('success_storys as s')
        ->select('s.*')
        ->where('s.id',$id)
        ->orderBy('s.created_at', 'desc')
        ->get();
       
        $models = $AllsuccessStory[0]->modelname;
        $arrModel = explode(",", $models);
        // return dd($arrModel);
   
        $image_story =  DB::table('success_storys_image as ssi')
        ->select('ssi.*')
        ->where('ssi.fk_story_id' ,$AllsuccessStory[0]->id)
        ->get();
        $countries = DB::table('countries')
        ->select('countries.*')
        ->get();

        return  view('front-end.edit-success-stories')
        ->with('products' ,$products)
        ->with('arrModel' ,$arrModel)
        ->with('image_story' ,$image_story)
        ->with('countries' ,$countries)
        ->with('AllsuccessStory' ,$AllsuccessStory);
    }
    public function productDocLogin(){
        $sectionId = session('partner_id');
        if($sectionId == null){
            return redirect()->route('index','login');
        }

        $lang = App::getLocale();
        session(['lang_down' =>  $lang]);
        $subCategories = DB::table('sub_pro_categories as sc')
        ->join('sub_pro_categories_translation as sct', 'sct.sub_pro_id', '=', 'sc.sub_pro_id')
        ->select('sc.*', 'sct.*')
        ->where('sct.local',  $lang)
        ->orderBy('sct.name', 'asc')
        ->get();
        
        $products = DB::table('products as p')
        ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
        ->join('series_translations as st', 'st.series_id', '=', 'p.series_id')
        ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
        ->join('sub_pro_categories as sp', 'sp.sub_pro_id', '=', 'phc.categories_id')
        ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'phc.categories_id')
        ->where('pt.local' ,$lang)
        ->where('st.local' ,$lang)
        ->where('spt.local' ,$lang)
        ->select('p.*', 'pt.*' ,'spt.name as catename','sp.url_item','st.title as seriesename')
        ->orderBy('p.pro_code', 'asc')
        ->get();

        $series =  DB::table('series_has_pro_categories as sc')
            ->join('series as s' ,'sc.se_id' ,'=' ,'s.se_id')
            ->join('series_translations as st' ,'st.series_id' ,'=' ,'s.se_id')
            ->where('st.local' ,'en')
            ->select('s.*' ,'st.*' ,'sc.pro_categories_id')
            ->where('s.status' ,1)
            ->distinct()
            ->orderBy('st.title', 'asc')
            ->get();
          
            $documents = DB::table('product_has_documents as phd')
            ->join('products as p','p.pro_id','=','phd.product_id')
            ->join('product_ducuments as pd','phd.document_id','=','pd.doc_id')
            ->join('product_ducument_translations as pdt','pdt.doc_fk_id','=','pd.doc_id')
            ->join('products_documents_categories as pdc','pdc.id','=','pd.cate_id')
            ->where('pdt.local',$lang)
            ->where('pdt.file','!=' ,'')
            ->where('pdt.file','!=' ,null)
            ->select('p.pro_code','pd.doc_id','phd.product_id','pdt.name','pdc.title as catename','pdc.slug','pd.created_at' ,'pdc.main_cate_id','pdt.file' ,'pd.cate_id')
            ->orderBy('pdc.title','asc')
            ->get();
            
            $documents_cate = DB::table('products_documents_categories as pdc')
            ->join('pro_ducuments_cate_translations as pdct','pdct.doc_cate_id','=','pdc.id')
            ->where('pdct.local','=', $lang)
            ->select('pdc.*','pdct.lable')
            ->orderBy('pdc.title','asc')
            ->get();

            $metatag = DB::table('meta_tag_page as mtp')->where('id',9)->get();
        return  view('front-end.login-pro-document')
        ->with('metatag' ,$metatag)
        ->with('subCategories' ,$subCategories)
        ->with('series' ,$series)
        ->with('documents' ,$documents)
        ->with('documents_cate' ,$documents_cate)
        ->with('products' ,$products);
    }
    
       public function loadPdffile(Request $request)
       {  
   
       $contentCompare = $request->datacon;
       $string = $this->validateInput($request->arr_con ,'text',true);
       $type_name = $this->validateInput($request->type_name ,'text',true);
        $myArray = explode(',', $string);
        $rsp =  self::GetCoparisonHeader($myArray ,$type_name);
     
            $rowall = $rsp['CSV'];

            Excel::create('comparison_product', function ($excel) use ($rowall) {
              $excel->sheet('comparison_product', function ($sheet) use ($rowall) {
                $sheet->fromArray($rowall, null, 'A1', false, false);
            
              });
          })->export('csv');
             
       }

       public function loadPdffilePDF(Request $request)
       {  
       
       $contentCompare = $request->datacon;
       $string = $this->validateInput($request->arr_con ,'text',true);
       $type_name = $this->validateInput($request->type_name ,'text',true);
        $myArray = explode(',', $string);
        // return dd($myArray);
        $lang = App::getLocale();
        $langpro1 =  self::checkLang($lang ,$myArray[0]);
        $pro1  = DB::table('products as p')
        ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
        ->join('series_translations as st', 'st.series_id', '=', 'p.series_id')
        ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
        ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'phc.categories_id')
        ->where('pt.local' ,$langpro1)
        ->where('spt.local' ,$lang)
        ->where('st.local' ,$lang)
        ->where('pt.showstatus' ,1)
        ->where('p.pro_id' ,$myArray[0])
        ->select('p.*', 'pt.*','spt.name as catename','st.title as seName')
        ->get();
        $langpro2 =  self::checkLang($lang ,$myArray[1]);
        $pro2  = DB::table('products as p')
        ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
        ->join('series_translations as st', 'st.series_id', '=', 'p.series_id')
        ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
        ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'phc.categories_id')
        ->where('pt.local' ,$langpro2)
        ->where('spt.local' ,$lang)
        ->where('st.local' ,$lang)
        ->where('pt.showstatus' ,1)
        ->where('p.pro_id' ,$myArray[1])
        ->select('p.*', 'pt.*','spt.name as catename','st.title as seName')
        ->get();
        $langpro3 =  self::checkLang($lang ,$myArray[2]);
        $pro3  = DB::table('products as p')
        ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
        ->join('series_translations as st', 'st.series_id', '=', 'p.series_id')
        ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
        ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'phc.categories_id')
        ->where('pt.local' ,$langpro3)
        ->where('spt.local' ,$lang)
        ->where('st.local' ,$lang)
        ->where('pt.showstatus' ,1)
        ->where('p.pro_id' ,$myArray[2])
        ->select('p.*', 'pt.*','spt.name as catename','st.title as seName')
        ->get();
       

            $data['tyepname']  = $type_name;
            $data['product1']  = $pro1;
            $data['product2']  = $pro2;
            $data['product3']  = $pro3;
            $data['contentCompare']  = $contentCompare;

            $pdf = PDF::loadView('front-end.pdf_com', $data);
          return $pdf->download('compareProduct.pdf');         
       }
       private function checkContentPro($proid){
        $contentEror_ifnothave = DB::table('product_has_property as ph')
        ->where('ph.product_id',$proid)
        ->whereIn('ph.type_id',[4,3,8])
        ->orderBy('ph.type_id' ,'asc')
        ->select('ph.*')
        ->get();
        // return dd($contentEror_ifnothave);
        if(count($contentEror_ifnothave) >= 3){
            return true;
        }else{
            return false;
        }

       }
       public function searchAll($keysearchParm)
       {
          $keysearch = $this->validateInput($keysearchParm,'text',true);
          $keypro  = str_replace("@", "/", $keysearch);
          //return dd($keypro);
          $checkSpece =  preg_match('/\s/',$keypro);
          $checkdash =  preg_match('/-/',$keypro);
    //    return dd($checkdesh);
    
           $lang = App::getLocale();
           $checkArr = [];
           $query = DB::table('products as p')
           ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
           ->join('sub_pro_categories as sp', 'sp.sub_pro_id', '=', 'phc.categories_id')
           ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'phc.categories_id')
           ->join('series_translations as st', 'st.series_id', '=', 'p.series_id')
           ->where('spt.local' ,$lang)
           ->where('st.local' ,$lang)
           ->where('p.enable_pro' ,1);

      
            if($checkSpece){
            $keyarr = explode(" ",$keypro);   
            if(isset($keyarr[0])){
            $query->where('p.pro_code', 'LIKE', '%'.$keyarr[0].'%');
            }
            if(isset($keyarr[1])){
             $query->where('p.pro_code', 'LIKE', '%'.$keyarr[1].'%');
            }
            }else if($checkdash){
            $keyarr2 = explode("-",$keypro);   
            if(isset($keyarr2[0])){
             $query->where('p.pro_code', 'LIKE', '%'.$keyarr2[0].'%');
            }
            if(isset($keyarr2[1])){
             $query->where('p.pro_code', 'LIKE', '%'.$keyarr2[1].'%');
             }  
             }else{
              $query->where('p.pro_code', 'LIKE', '%'.$keypro.'%');
             }
        


          //$query->Orwhere('st.title', 'LIKE', '%'.$keypro.'%')
           $query->select('p.*','spt.name as catename' ,'sp.url_item' ,'phc.categories_id' ,'st.title as seName');

           $products = $query->get();


           $data = [];
           $i = 0;
          foreach($products as $pro){
              $arraysub = [];
              $tags = [];
              $optional_models = [];
              $arraysub = DB::table('product_has_property as ph')
              ->join('product_has_property_translation as pht','ph.per_id' ,'=','pht.per_fk_id')
              ->join('product_field as pf','pf.id' ,'=','ph.type_id')
              ->join('product_field_translation as pft','ph.type_id' ,'=','pft.product_field_id')
              ->where('ph.product_id',$pro->pro_id)
              ->where('pht.local' ,'en')
              ->where('pft.local' ,$lang)
              ->whereIn('ph.type_id',[4,3,8,31])
              ->orderBy('ph.type_id' ,'asc')
              ->select('pht.value_text','ph.*' ,'pft.field_name as fieldCate','pf.unit_name')
              ->get();

          

              $tags = DB::table('product_tags as ptag')
              ->where('ptag.product_id' ,$pro->pro_id)
              ->where('ptag.tag','!=',' ')
              ->select('ptag.*')
              ->get();
              $optional_models = DB::table('product_optional_model as op')
              ->where('op.product_id' ,$pro->pro_id)
              ->select('op.*')
              ->get();
             if (!in_array($pro->pro_id, $checkArr) && self::checkContentPro($pro->pro_id)){
                  array_push($checkArr, $pro->pro_id);
                    $data[$i] = [
                        "pro_id"=>$pro->pro_id,
                        "tag_m"=>'',
                        "url_item"=>$pro->url_item,
                        "pro_code"=>$pro->pro_code,
                        "catename"=>$pro->catename,
                        "cateid"=>$pro->categories_id,
                        "picture"=>$pro->picture,
                        "status_product"=>$pro->status_product,
                        "content" =>$arraysub,
                        "tags" =>$tags,
                        "optional_models" => $optional_models,
                        "dimensionL"=>$pro->dimensionL,
                        "dimensionW"=>$pro->dimensionW,
                        "dimensionD"=>$pro->dimensionD,
                    ];
               
              }
              $i++;
          }

          $query2 = DB::table('products as p')
          ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
          ->join('sub_pro_categories as sp', 'sp.sub_pro_id', '=', 'phc.categories_id')
          ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'phc.categories_id')
          ->join('series_translations as st', 'st.series_id', '=', 'p.series_id')
          ->where('spt.local' ,$lang)
          ->where('st.local' ,$lang)
          ->where('p.enable_pro' ,1)
          ->where('st.title', 'LIKE', '%'.$keypro.'%');
          $query2->select('p.*','spt.name as catename' ,'sp.url_item' ,'phc.categories_id' ,'st.title as seName');

          $products_se = $query2->get();


          $data_series = [];
          $i = 0;
         foreach($products_se as $pro){
             $arraysub = [];
             $tags = [];
             $tags = [];
             $optional_models = [];
             $arraysub = DB::table('product_has_property as ph')
             ->join('product_has_property_translation as pht','ph.per_id' ,'=','pht.per_fk_id')
             ->join('product_field as pf','pf.id' ,'=','ph.type_id')
             ->join('product_field_translation as pft','ph.type_id' ,'=','pft.product_field_id')
             ->where('ph.product_id',$pro->pro_id)
             ->where('pht.local' ,'en')
             ->where('pft.local' ,$lang)
             ->whereIn('ph.type_id',[4,3,8,31])
             ->orderBy('ph.type_id' ,'asc')
             ->select('pht.value_text','ph.*' ,'pft.field_name as fieldCate','pf.unit_name')
             ->get();

             $tags = DB::table('product_tags as ptag')
             ->where('ptag.product_id' ,$pro->pro_id)
             ->where('ptag.tag','!=',' ')
             ->select('ptag.*')
             ->get();
             $optional_models = DB::table('product_optional_model as op')
              ->where('op.product_id' ,$pro->pro_id)
              ->select('op.*')
              ->get();
            if (!in_array($pro->pro_id, $checkArr) && self::checkContentPro($pro->pro_id)){
                 array_push($checkArr, $pro->pro_id);
                   $data_series[$i] = [
                       "pro_id"=>$pro->pro_id,
                       "tag_m"=>'',
                       "url_item"=>$pro->url_item,
                       "pro_code"=>$pro->pro_code,
                       "catename"=>$pro->catename,
                       "cateid"=>$pro->categories_id,
                       "picture"=>$pro->picture,
                       "status_product"=>$pro->status_product,
                       "content" =>$arraysub,
                       "tags" =>$tags,
                       "optional_models" => $optional_models,
                       "dimensionL"=>$pro->dimensionL,
                       "dimensionW"=>$pro->dimensionW,
                       "dimensionD"=>$pro->dimensionD,
                   ];
              
             }
             $i++;
         }

         $pro_collec = array_merge($data, $data_series);

          $Protags  = DB::table('product_tags as ptag')
           ->join('products as p', 'p.pro_id', '=', 'ptag.product_id')
           ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
           ->join('sub_pro_categories as sp', 'sp.sub_pro_id', '=', 'phc.categories_id')
           ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'phc.categories_id')
           ->join('series_translations as st', 'st.series_id', '=', 'p.series_id')
           ->where('spt.local' ,$lang)
           ->where('st.local' ,$lang)
           ->where('p.enable_pro' ,1)
           ->where('ptag.tag', 'LIKE', '%'.$keypro.'%')
           ->select('p.*','spt.name as catename','phc.categories_id','sp.url_item' ,'st.title as seName','ptag.*')
           ->get();
        //    return dd($products);

           $data1 = [];
           $i = 0;
          foreach($Protags as $pro2){
              $arraysub2 = [];
              $tags2 = [];
              $optional_models2 = [];
              $arraysub2 = DB::table('product_has_property as ph')
              ->join('product_has_property_translation as pht','ph.per_id' ,'=','pht.per_fk_id')
              ->join('product_field as pf','pf.id' ,'=','ph.type_id')
              ->join('product_field_translation as pft','ph.type_id' ,'=','pft.product_field_id')
              ->where('ph.product_id',$pro2->pro_id)
              ->where('pht.local' ,'en')
              ->where('pft.local' ,$lang)
              ->whereIn('ph.type_id',[4,3,8,31])
              ->orderBy('ph.type_id' ,'asc')
              ->select('pht.value_text','ph.*' ,'pft.field_name as fieldCate','pf.unit_name')
              ->get();
              $tags2 = DB::table('product_tags as ptag')
              ->where('ptag.product_id' ,$pro2->pro_id)
              ->where('ptag.tag','!=',' ')
              ->select('ptag.*')
              ->get();
              $optional_models2 = DB::table('product_optional_model as op')
              ->where('op.product_id' ,$pro2->pro_id)
              ->select('op.*')
              ->get();
            
              if (!in_array($pro2->pro_id, $checkArr) && self::checkContentPro($pro2->pro_id)){
                array_push($checkArr, $pro2->pro_id);

              $data1[$i] = [
                  "pro_id"=>$pro2->pro_id,
                  "tag_m"=>$pro2->tag,
                  "pro_code"=>$pro2->pro_code,
                  "url_item"=>$pro2->url_item,
                  "catename"=>$pro2->catename,
                  "cateid"=>$pro2->categories_id,
                  "picture"=>$pro2->picture,
                  "status_product"=>$pro2->status_product,
                  "content" =>$arraysub2,
                  "tags" =>$tags2,
                  "optional_models" =>$optional_models2,
                  "dimensionL"=>$pro2->dimensionL,
                  "dimensionW"=>$pro2->dimensionW,
                  "dimensionD"=>$pro2->dimensionD,
              ];
            }
              $i++;
          }
      
          $pro_collec_2 = array_merge($pro_collec, $data1); 


          $ProOptionalModel  = DB::table('product_optional_model as op')
           ->join('products as p', 'p.pro_id', '=', 'op.product_id')
           ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
           ->join('sub_pro_categories as sp', 'sp.sub_pro_id', '=', 'phc.categories_id')
           ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'phc.categories_id')
           ->join('series_translations as st', 'st.series_id', '=', 'p.series_id')
           ->where('spt.local' ,$lang)
           ->where('st.local' ,$lang)
           ->where('p.enable_pro' ,1)
           ->where('op.optional_model', 'LIKE', '%'.$keypro.'%')
           ->select('p.*','spt.name as catename','phc.categories_id','sp.url_item' ,'st.title as seName','op.*')
           ->get();
        //    return dd($products);

           $data1 = [];
           $i = 0;
          foreach($ProOptionalModel as $pro3){
              $arraysub3 = [];
              $tags3 = [];
              $optional_models3 = [];
              $arraysub3 = DB::table('product_has_property as ph')
              ->join('product_has_property_translation as pht','ph.per_id' ,'=','pht.per_fk_id')
              ->join('product_field as pf','pf.id' ,'=','ph.type_id')
              ->join('product_field_translation as pft','ph.type_id' ,'=','pft.product_field_id')
              ->where('ph.product_id',$pro3->pro_id)
              ->where('pht.local' ,'en')
              ->where('pft.local' ,$lang)
              ->whereIn('ph.type_id',[4,3,8,31])
              ->orderBy('ph.type_id' ,'asc')
              ->select('pht.value_text','ph.*' ,'pft.field_name as fieldCate','pf.unit_name')
              ->get();
              $tags3 = DB::table('product_tags as ptag')
              ->where('ptag.product_id' ,$pro3->pro_id)
              ->select('ptag.*')
              ->get();
              $optional_models3 = DB::table('product_optional_model as op')
              ->where('op.product_id' ,$pro3->pro_id)
              ->select('op.*')
              ->get();
            
              if (!in_array($pro3->pro_id, $checkArr) && self::checkContentPro($pro3->pro_id)){
                array_push($checkArr, $pro3->pro_id);

              $data1[$i] = [
                  "pro_id"=>$pro3->pro_id,
                  "tag_m"=>$pro3->optional_model,
                  "pro_code"=>$pro3->pro_code,
                  "url_item"=>$pro3->url_item,
                  "catename"=>$pro3->catename,
                  "cateid"=>$pro3->categories_id,
                  "picture"=>$pro3->picture,
                  "status_product"=>$pro3->status_product,
                  "content" =>$arraysub3,
                  "tags" =>$tags3,
                  "optional_models" =>$optional_models3,
                  "dimensionL"=>$pro3->dimensionL,
                  "dimensionW"=>$pro3->dimensionW,
                  "dimensionD"=>$pro3->dimensionD,
              ];
            }
              $i++;
          }
          $pro_results  = [];
          $pro_results = array_merge($pro_collec_2, $data1); 

          $news = DB::table('product_news_has_categories as pnc')
          ->join('contents as c' ,'c.id' ,'=','pnc.content_id')
          ->join('contents_translations as ct' ,'ct.content_id' ,'=','c.id')
          ->join('news_type as nt' ,'nt.id' ,'=','pnc.categories_id')
          ->where('ct.local',  $lang)
          ->where('c.content_type', '=', 'news')
          ->where('c.status',  1)
          ->where('ct.title', 'LIKE', '%'.$keysearch.'%')
          ->select('c.*' ,'ct.*','nt.name as cateName','pnc.categories_id as typeId')
          ->orderBy('c.date_publish', 'desc')
          ->distinct()
          ->get();
            $events = DB::table('contents as c')
            ->join('contents_translations as ct' ,'ct.content_id' ,'=','c.id')
            ->where('ct.local', $lang)
            ->where('c.content_type', '=', 'event')
            ->where('c.status',  1)
            ->where('ct.title', 'LIKE', '%'.$keysearch.'%')
            ->select('c.*' ,'ct.*')
            ->orderBy('c.date_publish', 'desc')
            ->distinct()
            ->get();

            $articles = DB::table('article_has_categories as anc')
            ->join('contents as c' ,'c.id' ,'=','anc.content_id')
            ->join('contents_translations as ct' ,'ct.content_id' ,'=','c.id')
            ->join('tech_type as ty' ,'ty.id' ,'=','anc.categories_id')
            ->join('tech_type_translation as tyt' ,'ty.id' ,'=','tyt.tech_id')
            ->where('ct.local',  $lang)
            ->where('tyt.local',  $lang)
            ->where('ct.title', 'LIKE', '%'.$keysearch.'%')
            ->where('c.status',  1)
            ->where('c.content_type', '=', 'blog')
            ->select('c.*' ,'ct.*','tyt.name as cateName' ,'anc.categories_id as typeId')
            ->orderBy('c.date_publish', 'desc')
            ->distinct()
            ->get();

            $faqs = DB::table('faq as f')
            ->join('faq_translations as ft', 'f.id', '=', 'ft.faq_id')
            ->where('ft.local', '=',  $lang)
            ->where('f.status', 1)
            ->where('ft.title', 'LIKE', '%'.$keysearch.'%')
            ->select('f.*' ,'ft.*')
            ->get();
            $offices = [];
            $officesChk = [];
            $officesSer = DB::table('office as f')
            ->join('office_translations as oft', 'f.id', '=', 'oft.fk_office_id')
            ->join('continents as c', 'c.id', '=', 'f.continent_id')
            ->join('continents_translations as ct', 'c.id', '=', 'ct.cont_id')
            ->where('oft.local', '=',  $lang)
            ->where('ct.local', '=',  $lang)
            ->where('oft.title', 'LIKE', '%'.$keysearch.'%')
            ->Orwhere('ct.name', 'LIKE', '%'.$keysearch.'%')
            ->where('f.type_id', '=',  1)
            ->select('f.*' ,'oft.*')
            ->distinct()
            ->get();

            foreach($officesSer as $offi){
                if(!in_array($offi->id,$officesChk)){
                    array_push($officesChk,$offi->id);
                    array_push($offices,$offi);
                }
              
            }

            $continents_office = DB::table('continents as c')
            ->join('continents_translations as ct', 'c.id', '=', 'ct.cont_id')
            ->where('type_id' ,1)
            ->where('ct.local', '=', $lang)
            ->select('c.*' ,'ct.*')
            ->get();

            $continents_dis = DB::table('continents as c')
            ->join('continents_translations as ct', 'c.id', '=', 'ct.cont_id')
            ->where('type_id' ,2)
            ->where('ct.local', '=', $lang)
            ->select('c.*' ,'ct.*')
            ->get();

            $distributor = [];
            $distriChk = [];

            $distrsech = DB::table('office as f')
            ->join('office_translations as oft', 'f.id', '=', 'oft.fk_office_id')
            ->join('continents as c', 'c.id', '=', 'f.continent_id')
            ->join('continents_translations as ct', 'c.id', '=', 'ct.cont_id')
            ->where('oft.local', '=',  $lang)
            ->where('ct.local', '=',  $lang)
            ->where('oft.title', 'LIKE', '%'.$keysearch.'%')
            ->Orwhere('ct.name', 'LIKE', '%'.$keysearch.'%')
            ->where('f.type_id', '=', 2)
            ->select('f.*' ,'oft.*')
            ->distinct()
            ->get();


            foreach($distrsech as $des){
                if(!in_array($des->id,$distriChk)){
                    array_push($distriChk,$des->id);
                    array_push($distributor,$des);
                }

            }

    

            $applications =  DB::table('application as ap')
            ->join('application_translation as apt','ap.id','=','apt.app_id')
            ->where('apt.local','=',$lang)
            ->select('ap.*' ,'ap.id as applica_id' , 'apt.name' ,'apt.content' ,'apt.overview')
            ->where('apt.name', 'LIKE', '%'.$keysearch.'%')
            ->orderBy('ap.order_seq' ,'asc')
            ->get();

            $margetCate = DB::table('permission_marketcate as permar')
            ->join('marketing_resource_cate as mc', 'permar.market_cate_id', '=', 'mc.cate_id')
            ->join('marketing_resource_cate_translations as mct', 'mc.cate_id', '=', 'mct.mk_fk_id')
            ->where('mct.local', '=',  $lang)
            ->where('permar.permission_id', '=', 3)
            ->select('mc.*' ,'mct.*')
            ->get();

             $margeting = DB::table('marketing_resource as mr')
            ->join('marketing_resource_translations as mrt', 'mr.id', '=', 'mrt.mr_id')
            ->where('mrt.local', '=', $lang)
            ->whereIn('mr.cate_id',[1,2])
            ->where('mrt.name', 'LIKE', '%'.$keysearch.'%')
            ->select('mr.*' ,'mrt.*')
            ->get();
               

          

      
           return  view('front-end.resultsearch')
           ->with('applications',$applications)
           ->with('margetCate',$margetCate)
           ->with('margeting',$margeting)
           ->with('pro_results',$pro_results)
           ->with('news',$news)
           ->with('events',$events)
           ->with('articles',$articles)
           ->with('offices',$offices)
           ->with('distributor',$distributor)
           ->with('continents_office',$continents_office)
           ->with('continents_dis',$continents_dis)
           ->with('faqs',$faqs)
           ->with('keysearch',$keysearch);
       }
       public function oldDoc($name){
        return redirect()->route('index','home');
       }
       public function downloadGuide($doc){
        return redirect()->route('index','home'); 
       }
       public function downloadoldLeaflets($doc){
        return redirect()->route('index','home'); 
       }
       public function checkOldfileUrl($doc){
        $path =  base_path('../upload/product_image/').$doc ; 
        if (file_exists($path)) {
            return response()->file($path);
        } else {
            return redirect()->route('index','home'); 
        }
       
       }


       public function searchByTag($keysearchParm)
       {
           $keysearch = $this->validateInput($keysearchParm,'text',true);
           $keypro  = str_replace("@", "/", $keysearch);
           $lang = App::getLocale();
           $products  = DB::table('product_tags as ptag')
           ->join('products as p', 'p.pro_id', '=', 'ptag.product_id')
           ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
           ->join('sub_pro_categories as sp', 'sp.sub_pro_id', '=', 'phc.categories_id')
           ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'phc.categories_id')
           ->join('series_translations as st', 'st.series_id', '=', 'p.series_id')
           ->where('spt.local' ,$lang)
           ->where('st.local' ,$lang)
           ->where('p.enable_pro' ,1)
           ->where('ptag.tag', 'LIKE', '%'.$keypro.'%')
           ->select('p.*','spt.name as catename','phc.categories_id' ,'sp.url_item' ,'st.title as seName','ptag.*')
           ->get();
        

           $data = [];
           $i = 0;
          foreach($products as $pro){
              $arraysub = [];
              $tags = [];
              $optional_models = [];
              $arraysub = DB::table('product_has_property as ph')
              ->join('product_has_property_translation as pht','ph.per_id' ,'=','pht.per_fk_id')
              ->join('product_field as pf','pf.id' ,'=','ph.type_id')
              ->join('product_field_translation as pft','ph.type_id' ,'=','pft.product_field_id')
              ->where('ph.product_id',$pro->pro_id)
              ->where('pht.local' ,'en')
              ->where('pft.local' ,$lang)
              ->whereIn('ph.type_id',[4,3,8,31])
              ->orderBy('ph.type_id' ,'asc')
              ->select('pht.value_text','ph.*' ,'pft.field_name as fieldCate','pf.unit_name')
              ->get();
              $tags = DB::table('product_tags as ptag')
              ->where('ptag.product_id' ,$pro->pro_id)
              ->select('ptag.*')
              ->get();
              $optional_models = DB::table('product_optional_model as op')
              ->where('op.product_id' ,$pro->pro_id)
              ->select('op.*')
              ->get();

              $data[$i] = [
                  "pro_id"=>$pro->pro_id,
                  "tag_m"=>$pro->tag,
                  "pro_code"=>$pro->pro_code,
                  "url_item"=>$pro->url_item,
                  "catename"=>$pro->catename,
                  "cateid"=>$pro->categories_id,
                  "picture"=>$pro->picture,
                  "status_product"=>$pro->status_product,
                  "content" =>$arraysub,
                  "tags" =>$tags,
                  "optional_models" =>$optional_models,
                  "dimensionL"=>$pro->dimensionL,
                  "dimensionW"=>$pro->dimensionW,
                  "dimensionD"=>$pro->dimensionD,
              ];
              $i++;
          }
        //  return dd($data);

          $news = DB::table('product_news_has_categories as pnc')
          ->join('contents as c' ,'c.id' ,'=','pnc.content_id')
          ->join('contents_translations as ct' ,'ct.content_id' ,'=','c.id')
          ->join('news_type as nt' ,'nt.id' ,'=','pnc.categories_id')
          ->where('ct.local',  $lang)
          ->where('c.content_type', '=', 'news')
          ->where('c.status',  1)
          ->where('ct.title', 'LIKE', '%'.$keysearch.'%')
          ->select('c.*' ,'ct.*','nt.name as cateName','pnc.categories_id as typeId')
          ->orderBy('c.date_publish', 'desc')
          ->distinct()
          ->get();
            $events = DB::table('contents as c')
            ->join('contents_translations as ct' ,'ct.content_id' ,'=','c.id')
            ->where('ct.local', $lang)
            ->where('c.content_type', '=', 'event')
            ->where('c.status',  1)
            ->where('ct.title', 'LIKE', '%'.$keysearch.'%')
            ->select('c.*' ,'ct.*')
            ->orderBy('c.date_publish', 'desc')
            ->distinct()
            ->get();

            $articles = DB::table('article_has_categories as anc')
            ->join('contents as c' ,'c.id' ,'=','anc.content_id')
            ->join('contents_translations as ct' ,'ct.content_id' ,'=','c.id')
            ->join('tech_type as ty' ,'ty.id' ,'=','anc.categories_id')
            ->join('tech_type_translation as tyt' ,'ty.id' ,'=','tyt.tech_id')
            ->where('ct.local',  $lang)
            ->where('tyt.local',  $lang)
            ->where('ct.title', 'LIKE', '%'.$keysearch.'%')
            ->where('c.status',  1)
            ->where('c.content_type', '=', 'blog')
            ->select('c.*' ,'ct.*','tyt.name as cateName' ,'anc.categories_id as typeId')
            ->orderBy('c.date_publish', 'desc')
            ->distinct()
            ->get();

            $faqs = DB::table('faq as f')
            ->join('faq_translations as ft', 'f.id', '=', 'ft.faq_id')
            ->where('ft.local', '=',  $lang)
            ->where('f.status', 1)
            ->where('ft.title', 'LIKE', '%'.$keysearch.'%')
            ->select('f.*' ,'ft.*')
            ->get();

            $offices = [];
            $officesChk = [];
            $officesSer = DB::table('office as f')
            ->join('office_translations as oft', 'f.id', '=', 'oft.fk_office_id')
            ->join('continents as c', 'c.id', '=', 'f.continent_id')
            ->join('continents_translations as ct', 'c.id', '=', 'ct.cont_id')
            ->where('oft.local', '=',  $lang)
            ->where('ct.local', '=',  $lang)
            ->where('oft.title', 'LIKE', '%'.$keysearch.'%')
            ->Orwhere('ct.name', 'LIKE', '%'.$keysearch.'%')
            ->where('f.type_id', '=',  1)
            ->select('f.*' ,'oft.*')
            ->distinct()
            ->get();

            foreach($officesSer as $offi){
                if(!in_array($offi->id,$officesChk)){
                    array_push($officesChk,$offi->id);
                    array_push($offices,$offi);
                }
              
            }

            $continents_office = DB::table('continents as c')
            ->join('continents_translations as ct', 'c.id', '=', 'ct.cont_id')
            ->where('type_id' ,1)
            ->where('ct.local', '=', $lang)
            ->select('c.*' ,'ct.*')
            ->get();

            $continents_dis = DB::table('continents as c')
            ->join('continents_translations as ct', 'c.id', '=', 'ct.cont_id')
            ->where('type_id' ,2)
            ->where('ct.local', '=', $lang)
            ->select('c.*' ,'ct.*')
            ->get();

            $distributor = [];
            $distriChk = [];

            $distrsech = DB::table('office as f')
            ->join('office_translations as oft', 'f.id', '=', 'oft.fk_office_id')
            ->join('continents as c', 'c.id', '=', 'f.continent_id')
            ->join('continents_translations as ct', 'c.id', '=', 'ct.cont_id')
            ->where('oft.local', '=',  $lang)
            ->where('ct.local', '=',  $lang)
            ->where('oft.title', 'LIKE', '%'.$keysearch.'%')
            ->Orwhere('ct.name', 'LIKE', '%'.$keysearch.'%')
            ->where('f.type_id', '=', 2)
            ->select('f.*' ,'oft.*')
            ->distinct()
            ->get();


            foreach($distrsech as $des){
                if(!in_array($des->id,$distriChk)){
                    array_push($distriChk,$des->id);
                    array_push($distributor,$des);
                }

            }

            $applications =  DB::table('application as ap')
            ->join('application_translation as apt','ap.id','=','apt.app_id')
            ->where('apt.local','=',$lang)
            ->select('ap.*' ,'ap.id as applica_id' , 'apt.name' ,'apt.content' ,'apt.overview')
            ->where('apt.name', 'LIKE', '%'.$keysearch.'%')
            ->orderBy('ap.order_seq' ,'asc')
            ->get();

            $margetCate = DB::table('permission_marketcate as permar')
            ->join('marketing_resource_cate as mc', 'permar.market_cate_id', '=', 'mc.cate_id')
            ->join('marketing_resource_cate_translations as mct', 'mc.cate_id', '=', 'mct.mk_fk_id')
            ->where('mct.local', '=',  $lang)
            ->where('permar.permission_id', '=', 3)
            ->select('mc.*' ,'mct.*')
            ->get();

             $margeting = DB::table('marketing_resource as mr')
            ->join('marketing_resource_translations as mrt', 'mr.id', '=', 'mrt.mr_id')
            ->where('mrt.local', '=', $lang)
            ->whereIn('mr.cate_id',[1,2])
            ->where('mrt.name', 'LIKE', '%'.$keysearch.'%')
            ->select('mr.*' ,'mrt.*')
            ->get();
          
           return  view('front-end.resultsearch')
           ->with('applications',$applications)
           ->with('margetCate',$margetCate)
           ->with('margeting',$margeting)
           ->with('pro_results',$data)
           ->with('news',$news)
           ->with('events',$events)
           ->with('articles',$articles)
           ->with('offices',$offices)
           ->with('distributor',$distributor)
           ->with('continents_office',$continents_office)
           ->with('continents_dis',$continents_dis)
           ->with('faqs',$faqs)
           ->with('keysearch',$keysearch);
       }

       public function searchByOptionalModel($keysearchParm)
       {
           $keysearch = $this->validateInput($keysearchParm,'text',true);
           $keypro  = str_replace("@", "/", $keysearch);
           $lang = App::getLocale();
           $products  = DB::table('product_optional_model as op')
           ->join('products as p', 'p.pro_id', '=', 'op.product_id')
           ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
           ->join('sub_pro_categories as sp', 'sp.sub_pro_id', '=', 'phc.categories_id')
           ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'phc.categories_id')
           ->join('series_translations as st', 'st.series_id', '=', 'p.series_id')
           ->where('spt.local' ,$lang)
           ->where('st.local' ,$lang)
           ->where('p.enable_pro' ,1)
           ->where('op.optional_model', 'LIKE', '%'.$keypro.'%')
           ->select('p.*','spt.name as catename','phc.categories_id' ,'sp.url_item' ,'st.title as seName','op.*')
           ->get();
        

           $data = [];
           $i = 0;
          foreach($products as $pro){
              $arraysub = [];
              $tags = [];
              $optional_models = [];
              $arraysub = DB::table('product_has_property as ph')
              ->join('product_has_property_translation as pht','ph.per_id' ,'=','pht.per_fk_id')
              ->join('product_field as pf','pf.id' ,'=','ph.type_id')
              ->join('product_field_translation as pft','ph.type_id' ,'=','pft.product_field_id')
              ->where('ph.product_id',$pro->pro_id)
              ->where('pht.local' ,'en')
              ->where('pft.local' ,$lang)
              ->whereIn('ph.type_id',[4,3,8,31])
              ->orderBy('ph.type_id' ,'asc')
              ->select('pht.value_text','ph.*' ,'pft.field_name as fieldCate','pf.unit_name')
              ->get();
              $tags = DB::table('product_tags as ptag')
              ->where('ptag.product_id' ,$pro->pro_id)
              ->select('ptag.*')
              ->get();
              $optional_models = DB::table('product_optional_model as op')
              ->where('op.product_id' ,$pro->pro_id)
              ->select('op.*')
              ->get();

              $data[$i] = [
                  "pro_id"=>$pro->pro_id,
                  "tag_m"=>$pro->optional_model,
                  "pro_code"=>$pro->pro_code,
                  "url_item"=>$pro->url_item,
                  "catename"=>$pro->catename,
                  "cateid"=>$pro->categories_id,
                  "picture"=>$pro->picture,
                  "status_product"=>$pro->status_product,
                  "content" =>$arraysub,
                  "tags" =>$tags,
                  "optional_models" =>$optional_models,
                  "dimensionL"=>$pro->dimensionL,
                  "dimensionW"=>$pro->dimensionW,
                  "dimensionD"=>$pro->dimensionD,
              ];
              $i++;
          }
        //  return dd($data);

          $news = DB::table('product_news_has_categories as pnc')
          ->join('contents as c' ,'c.id' ,'=','pnc.content_id')
          ->join('contents_translations as ct' ,'ct.content_id' ,'=','c.id')
          ->join('news_type as nt' ,'nt.id' ,'=','pnc.categories_id')
          ->where('ct.local',  $lang)
          ->where('c.content_type', '=', 'news')
          ->where('c.status',  1)
          ->where('ct.title', 'LIKE', '%'.$keysearch.'%')
          ->select('c.*' ,'ct.*','nt.name as cateName','pnc.categories_id as typeId')
          ->orderBy('c.date_publish', 'desc')
          ->distinct()
          ->get();
            $events = DB::table('contents as c')
            ->join('contents_translations as ct' ,'ct.content_id' ,'=','c.id')
            ->where('ct.local', $lang)
            ->where('c.content_type', '=', 'event')
            ->where('c.status',  1)
            ->where('ct.title', 'LIKE', '%'.$keysearch.'%')
            ->select('c.*' ,'ct.*')
            ->orderBy('c.date_publish', 'desc')
            ->distinct()
            ->get();

            $articles = DB::table('article_has_categories as anc')
            ->join('contents as c' ,'c.id' ,'=','anc.content_id')
            ->join('contents_translations as ct' ,'ct.content_id' ,'=','c.id')
            ->join('tech_type as ty' ,'ty.id' ,'=','anc.categories_id')
            ->join('tech_type_translation as tyt' ,'ty.id' ,'=','tyt.tech_id')
            ->where('ct.local',  $lang)
            ->where('tyt.local',  $lang)
            ->where('ct.title', 'LIKE', '%'.$keysearch.'%')
            ->where('c.status',  1)
            ->where('c.content_type', '=', 'blog')
            ->select('c.*' ,'ct.*','tyt.name as cateName' ,'anc.categories_id as typeId')
            ->orderBy('c.date_publish', 'desc')
            ->distinct()
            ->get();

            $faqs = DB::table('faq as f')
            ->join('faq_translations as ft', 'f.id', '=', 'ft.faq_id')
            ->where('ft.local', '=',  $lang)
            ->where('f.status', 1)
            ->where('ft.title', 'LIKE', '%'.$keysearch.'%')
            ->select('f.*' ,'ft.*')
            ->get();

            $offices = [];
            $officesChk = [];
            $officesSer = DB::table('office as f')
            ->join('office_translations as oft', 'f.id', '=', 'oft.fk_office_id')
            ->join('continents as c', 'c.id', '=', 'f.continent_id')
            ->join('continents_translations as ct', 'c.id', '=', 'ct.cont_id')
            ->where('oft.local', '=',  $lang)
            ->where('ct.local', '=',  $lang)
            ->where('oft.title', 'LIKE', '%'.$keysearch.'%')
            ->Orwhere('ct.name', 'LIKE', '%'.$keysearch.'%')
            ->where('f.type_id', '=',  1)
            ->select('f.*' ,'oft.*')
            ->distinct()
            ->get();

            foreach($officesSer as $offi){
                if(!in_array($offi->id,$officesChk)){
                    array_push($officesChk,$offi->id);
                    array_push($offices,$offi);
                }
              
            }

            $continents_office = DB::table('continents as c')
            ->join('continents_translations as ct', 'c.id', '=', 'ct.cont_id')
            ->where('type_id' ,1)
            ->where('ct.local', '=', $lang)
            ->select('c.*' ,'ct.*')
            ->get();

            $continents_dis = DB::table('continents as c')
            ->join('continents_translations as ct', 'c.id', '=', 'ct.cont_id')
            ->where('type_id' ,2)
            ->where('ct.local', '=', $lang)
            ->select('c.*' ,'ct.*')
            ->get();

            $distributor = [];
            $distriChk = [];

            $distrsech = DB::table('office as f')
            ->join('office_translations as oft', 'f.id', '=', 'oft.fk_office_id')
            ->join('continents as c', 'c.id', '=', 'f.continent_id')
            ->join('continents_translations as ct', 'c.id', '=', 'ct.cont_id')
            ->where('oft.local', '=',  $lang)
            ->where('ct.local', '=',  $lang)
            ->where('oft.title', 'LIKE', '%'.$keysearch.'%')
            ->Orwhere('ct.name', 'LIKE', '%'.$keysearch.'%')
            ->where('f.type_id', '=', 2)
            ->select('f.*' ,'oft.*')
            ->distinct()
            ->get();


            foreach($distrsech as $des){
                if(!in_array($des->id,$distriChk)){
                    array_push($distriChk,$des->id);
                    array_push($distributor,$des);
                }

            }

            $applications =  DB::table('application as ap')
            ->join('application_translation as apt','ap.id','=','apt.app_id')
            ->where('apt.local','=',$lang)
            ->select('ap.*' ,'ap.id as applica_id' , 'apt.name' ,'apt.content' ,'apt.overview')
            ->where('apt.name', 'LIKE', '%'.$keysearch.'%')
            ->orderBy('ap.order_seq' ,'asc')
            ->get();

            $margetCate = DB::table('permission_marketcate as permar')
            ->join('marketing_resource_cate as mc', 'permar.market_cate_id', '=', 'mc.cate_id')
            ->join('marketing_resource_cate_translations as mct', 'mc.cate_id', '=', 'mct.mk_fk_id')
            ->where('mct.local', '=',  $lang)
            ->where('permar.permission_id', '=', 3)
            ->select('mc.*' ,'mct.*')
            ->get();

             $margeting = DB::table('marketing_resource as mr')
            ->join('marketing_resource_translations as mrt', 'mr.id', '=', 'mrt.mr_id')
            ->where('mrt.local', '=', $lang)
            ->whereIn('mr.cate_id',[1,2])
            ->where('mrt.name', 'LIKE', '%'.$keysearch.'%')
            ->select('mr.*' ,'mrt.*')
            ->get();
          
           return  view('front-end.resultsearch')
           ->with('applications',$applications)
           ->with('margetCate',$margetCate)
           ->with('margeting',$margeting)
           ->with('pro_results',$data)
           ->with('news',$news)
           ->with('events',$events)
           ->with('articles',$articles)
           ->with('offices',$offices)
           ->with('distributor',$distributor)
           ->with('continents_office',$continents_office)
           ->with('continents_dis',$continents_dis)
           ->with('faqs',$faqs)
           ->with('keysearch',$keysearch);
       }



       public function savepdfConfig(Request $request){
        $model = $this->validateInput($request->modelcode,'text',true);
        $factory = $this->validateInput($request->factory,'text',true);
        $customer_model = $this->validateInput($request->customer_model,'text',true);
        $File = $request->file("pdf");
        $fileName =  $model.'_'.uniqid().'.pdf';
        $subfile  = preg_replace('/\s+/', '', $fileName);
        $File->move(base_path('/../config_history'),$subfile);

        $id = DB::table('configuration_history')->insertGetID(
            [
                "subject" => 'No Enquries',
                "type_his" => 0,
                "name" =>'visitor',
                "file" => $subfile,
                'model' =>$model,
                'product_type' =>'Configurable Power',
                "factory_model" =>$factory,
                "customer_model" =>$customer_model,
                "Message" => 'Users(visitors) of Configurable selection tool',
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]
        );
        session(['enquireModel' => $model]);
        session(['enquireModelType' => 7]);
        session(['enquireModelTypeName' => 'Configurable Power']);
        session(['enquireType' => 0]);
        session(['enquireStatus' => 0]);
        session(['enquireData' => $id]);

        return response()->json([
            'con_id' =>  $id,
            'message' =>  'Success !!',
        ],200);

       }
       public function subscribe(Request $request){
            $mailch = $this->validateInput($request->email,'text',true);
            $accept = $this->validateInput($request->accept,'number',true , 0);
 
            $strmlo = strtolower($mailch);
            // Get an array of all available lists:
            $mailchimdata =  Mailchimp::getLists();
            $checkmailC = Mailchimp::check($mailchimdata[0]['id'], trim($strmlo));
            $checkmailsta  =  Mailchimp::status($mailchimdata[0]['id'],trim($strmlo));
            $alreadysub =  DB::table('subscribes')->where('email',trim($strmlo))->get();
            // Afghanistan  Afganistan
            // return dd($request->country);
            $name = $this->validateInput($request->name,'text',true);
            $country = $this->validateInput($request->country,'text',true);
           

            
         if($checkmailC){
            return redirect()->back()->with('subscribes_already', 'already subscribes');
         }else{
            if(count($alreadysub) == 0){
                DB::table('subscribes')->insert(
                    [
                        "country_name" => $request->country,
                        "email" => trim($strmlo),
                        "name" => $name,
                        "accept" => $accept,
                        "created_at" => \Carbon\Carbon::now(),
                    ]
                );
            }
            Mailchimp::subscribe($mailchimdata[0]['id'], trim($strmlo),['NAME' => $name, 'COUNTRY' => $country] ,$confirm = true );
            return redirect()->back()->with('subscribes_new', 'successfully');
        }

         
        
       }
    
       private  function subCheckBox($request){
        $email = $request->email;
         //GUI download
 
        if($email == '' ||  $email == null ){
            $email = $request->email_gui;
        }
        try{
            if($email != null){
            $mailch = $this->validateInput($email,'text',true);
            $strmlo = strtolower($mailch);
            $mailchimdata =  Mailchimp::getLists();
    
            $checkmailC = Mailchimp::check($mailchimdata[0]['id'], trim($strmlo));
            $checkmailsta  =  Mailchimp::status($mailchimdata[0]['id'],trim($strmlo));
            $alreadysub =  DB::table('subscribes')->where('email',trim($strmlo))->get();
    
            if(!$checkmailC){
                if(count($alreadysub) == 0){
                    DB::table('subscribes')->insert(
                       [
                           "country_name" => $request->country,
                           "email" => $strmlo,
                           "name" => $request->name,
                           "accept" => 1,
                           "created_at" => \Carbon\Carbon::now(),
                       ]
                   );
                }
                Mailchimp::subscribe($mailchimdata[0]['id'], trim($strmlo),['NAME' => $request->name, 'COUNTRY' => $request->country] ,true);
            }
        }
        }catch (\Exception $e){
            Log::channel('mail_log')->info('[EROR] message :Mailchimp::subscribe '.$e);
        }
        



       }


       public function partnerLogin(Request $request){
            // $str = $request->email;
            $str = $this->validateInput($request->email,'text',true);
            $username =  strtolower($str);
            $partner = DB::table('partner')->where('email',$username)->where('status',1)->get();
        
            if(count($partner) != 0){
                $checkPas = false;
                $inputpassword = $this->validateInput($request->password,'password',true);
               if(isset($inputpassword) && $inputpassword != null ){
                   $checkPas = Hash::check($inputpassword,$partner[0]->password);
               }
                //return dd($checkPas);
                if($checkPas) {
                    $member_id = $partner[0]->id;
                    $member_firstname = $partner[0]->firstname;
                    $member_lastname = $partner[0]->firstname;
                    $member_phone = $partner[0]->phone;
                    $member_email = $partner[0]->email;
                    $member_role =  $partner[0]->role;
                    session(['partner_id' => $member_id]);
                    session(['partner_firstname' => $member_firstname]);
                    session(['partner_lastname' => $member_lastname]);
                    session(['partner_phone' => $member_phone]);
                    session(['partner_role' => $member_role]);
                    session(['partner_email' => $member_email]);
                
                    return redirect()->route('index','partners')->with('flash_message', 'Login is Success');
    
                }else{
                    return back()->with('flash_message_eror', 'Password Not Correct');
                }  
            }else{
                return back()->with('flash_message_eror', 'No user account found in the system.');
            }
            return back()->with('flash_message_eror', 'Eror');
          
       }
       public function uploadmulImagestory(Request $request){
               
        // $storyId = $request->story_id;
        $storyId = $this->validateInput($request->story_id,'number',true);
        if(session('partner_id') != null){
           if($storyId == null){
               $id = DB::table('success_storys')->insertGetID(
                  [
                      "user_id" => session('partner_id'),
                      "created_at" => \Carbon\Carbon::now(),
                      "updated_at" => \Carbon\Carbon::now(),
                  ]
              );
           }else{
              $id = $storyId;
           }

           if ($request->hasFile('file')) {
               $image = $request->file('file'); 
               $imgName = uniqid().".".$image->getClientOriginalExtension();
               $image->move(base_path('/../medias/partner/marketing_resources'),$imgName);
               DB::table('success_storys_image')->insert(
                   [
                       'fk_story_id' => $id,
                       'image' => $imgName,
                 ]);
   
                 return response()->json([
                   'status' => 'success',
                   'story_id' => $id
                ], 200);
           }else{
               return response()->json([
                   'status' => 'No file',
                   'story_id' => null
                ], 200);
           }
        }else{
           return response()->json([
               'status' => 'No Authenicate',
               'story_id' => null
            ], 200);
        }

        return response()->json([
            'status' => 'success',
         ], 200);
      
       
       }
       public function SaveSuccesStories(Request $request){
             $story_id_main = $this->validateInput($request->story_id_main,'number',true);
             $model = $this->validateInput($request->model,'array',true);

            // return dd($model);
             $model = $request->model;
             $modeltext =  implode(",",$model);
            //  return dd($modeltext);
             if($story_id_main != null){
                DB::table('success_storys')->where('id',$story_id_main)->update(
                    [
                        'modelname' =>  $modeltext,
                        'application' => $request->application,
                        'endCustomer' => $request->endCustomer,
                        'message' => $request->message,
                        'country' => $request->country,
                        'status' =>$request->status,
                        "updated_at" => \Carbon\Carbon::now(),
                    ]
                );
             }else{
                DB::table('success_storys')->insertGetID(
                    [
                        "user_id" => session('partner_id'),
                        'modelname' =>  $modeltext,
                        'application' => $request->application,
                        'endCustomer' => $request->endCustomer,
                        'message' => $request->message,
                        'country' => $request->country,
                        'status' =>$request->status,
                        "created_at" => \Carbon\Carbon::now(),
                        "updated_at" => \Carbon\Carbon::now(),
                    ]
                );
             }
        

            return redirect()->route('successStories')->with('flash_message', 'Insert Data successfully');
       }
       public function updateSuccessStories(Request $request){
        // $story_id_main  = $request->story_id_main;
        // $model = $request->model;

        $story_id_main = $this->validateInput($request->story_id_main,'number',true);
        $model = $this->validateInput($request->model,'array',true);


        $modeltext =  implode(",",$model);
        if($story_id_main != null){
           DB::table('success_storys')->where('id',$story_id_main)->update(
               [
                   'modelname' =>  $modeltext,
                   'application' => $request->application,
                   'endCustomer' => $request->endCustomer,
                   'message' => $request->message,
                   'country' => $request->country,
                   'status' =>$request->status,
                   "updated_at" => \Carbon\Carbon::now(),
               ]
           );
           return redirect()->route('successStories')->with('flash_message', 'Update Data successfully');
        }else{
            return redirect()->route('successStories')->with('flash_message', 'No Update');
        }

       }
       public function deleteImageSucess(Request $request){

        // $id = $request->img_id;
        $id = $this->validateInput($request->img_id,'number',true);
        $data = DB::table('success_storys_image')->where('id' ,$id)->get();
        $file_pointer = base_path('/../medias/partner/marketing_resources/').$data[0]->image;
        if (file_exists($file_pointer) && isset($data[0]->image) ) {
            unlink($file_pointer);
  
            return response()->json([
                'status' => 1,
             ], 200);
        }else{
            return response()->json([
                'status' => 0,
             ], 200);
        }
       }
       public function deleteSucessStory(Request $request){
        // $id = $request->story_id;
        $id = $this->validateInput($request->story_id,'number',true);
         $story = DB::table('success_storys')->where('id',$id)->get();
         $data_image = DB::table('success_storys_image')->where('fk_story_id' ,$id)->get();
          if(count($data_image) > 0){
            DB::table('success_storys_image')->where('id',$id)->delete();
            foreach($data_image as $item){
                $file_pointer = base_path('/../medias/partner/marketing_resources/').$item->image;
                if (file_exists($file_pointer) && isset($item->image) ) {
                    unlink($file_pointer);
                    DB::table('success_storys_image')->where('id' ,$item->id)->delete();
                }
            }
           }
           DB::table('success_storys')->where('id',$id)->delete();
           return response()->json([
            'status' => 1,
         ], 200);
      
       }
       public function SubmitContact(Request $request){

        $client = new Client();
        $response = $client->post(
            'https://www.recaptcha.net/recaptcha/api/siteverify',
            ['form_params'=>
                [
                    'secret'=> '6LeFKfYUAAAAABtTFzPon_8pinsPsevCSFyePD8k',
                    // 'secret'=> '6LdshPcUAAAAACaoDOvGo7ncKgVazbyKoDlPi43T',
                    'response'=>$request->keyrecap
                 ]
            ]
        );
    
        $body = json_decode((string)$response->getBody());

        $validate = Validator::make($request->all(), [
            'subject' => ['required'],
            'type_id' => ['required'],
            'model_name' => ['required'],
            'type_name' => ['required'],
            'name' => ['required'],
            'email' => ['required'],
            // 'company' => ['required'],
            'country' => ['required']
        ]);
        if ($validate->fails()) {
            // return redirect()->back()->withErrors($validate->errors());
            return \Redirect::back()->with("message_eror_notValid","Can not send");
        }
        $ticket_id = null;
        
        if($body->success){
    
           $subject = $this->validateInput($request->subject,'text',true);
           $name = $this->validateInput($request->name,'text',true);
           $tel = $this->validateInput($request->tel,'text',true);
           $email = $this->validateInput($request->email,'text',true);
           $company = $this->validateInput($request->company,'text',true);
           $country = $this->validateInput($request->country,'text',true);
           $state = $this->validateInput($request->state,'text',true);
           $type_name = $this->validateInput($request->type_name,'text',true);
           $type_id = $this->validateInput($request->type_id,'number',true);
           $model_name = $this->validateInput($request->model_name,'text',true);
           $message = $this->validateInput($request->message,'text',true);
           $checkData = $this->validateInput($request->checkData,'number',true);
           $agree_policy = $this->validateInput($request->prichk,'text',true);
        
           
           $accept_sigh = 0;
           if($checkData == 1){
            $accept_sigh = 1;
            self::subCheckBox($request);
           }
  
           if($subject == "0"){
            $subject = 'Sale Enquiries';
           }
        //    return dd($request->config_id, $request->enquireStatus);
      
          $path = null;
          $filepdf = null;

           //Enquiry Pdf
          if($request->config_id != null && $request->enquireStatus == 0){
       
              $data = DB::table('configuration_history')->where('id',$request->config_id)->get();
              if(isset($data) && count($data) > 0 ){
                DB::table('configuration_history')->where('id',$data[0]->id)->update(
                    [
                        "subject" => $subject,
                        "type_his" => 1,
                        "name" =>$name,
                        "Message" => $message,
                        "email" => $email,
                        "company" => $company,
                        "country" => $country,
                        "city" =>$state,
                        "updated_at" => \Carbon\Carbon::now(),
                    ]
                    );
                $path =  base_path('../config_history/').$data[0]->file; 
                $filepdf = $data[0]->file;
                Mail::to($email)->send(new SendPDFFromFeedBack($request->except('_token'),$path ,$data[0]->factory_model));
              } 
           //Send Pdf to me 
          }else if($request->config_id != null && $request->enquireStatus == 3){
            $data = DB::table('configuration_history')->where('id',$request->config_id)->get();
            if(isset($data) && count($data) > 0 ){
            DB::table('configuration_history')->where('id',$data[0]->id)->update(
                [
                    "subject" => $subject,
                    "type_his" => 3,
                    "name" =>$name,
                    "email" => $email,
                    "Message" => $message,
                    "company" => $company,
                    "country" => $country,
                    "city" =>$state,
                    "updated_at" => \Carbon\Carbon::now(),
                ]
                );
              $path =  base_path('../config_history/').$data[0]->file; 
              $filepdf = $data[0]->file;
        
              Mail::to($email)->send(new SendPDF($request->except('_token') ,$path,$data[0]->factory_model));
            }
          }

          if($request->config_id == null){
            Mail::to($email)->send(new ThankFeedback($request->except('_token')));
          }

          if($request->enquireStatus != 3){
         
             $lastdata = DB::table('contacts')->where('subject',$subject)->latest('id')->first();
            $last = DB::table('contacts')->latest('id')->first();
            $run_num  = 1;
            //  return dd($lastdata ,$last ,$subject);
            if($lastdata && $lastdata->run_num){
              $run_num = $lastdata->run_num + 1;
            }
            $d = date('d');
            $yy = date('Y');
            $m = date('m');
            $numdate = $yy.$m.$d;
            $ticket_id = $numdate.sprintf("%04d", $run_num);
         
           


            DB::table('contacts')->insert(
                [
                    'name' => $name,
                    'subject' =>$subject,
                    'tel' => $tel,
                    'email' => $email,
                    'company' =>$company,
                    'country' =>$country,
                    'state' =>$state,
                    'type_name' =>$type_name,
                    'model_name' =>$model_name,
                    'ticket_id' =>$ticket_id,
                    'run_num' =>$run_num,
                    'message' =>$message,
                    'agree_policy'=>$agree_policy,
                    'file' =>isset($filepdf)?$filepdf:null,
                    'accept_signup_news' =>$accept_sigh,
                    "created_at" => \Carbon\Carbon::now(),
                ]
              );
         }

          session()->forget('enquireModel');
          session()->forget('enquireModelType');
          session()->forget('enquireModelTypeName');
          session()->forget('enquireType');
          session()->forget('enquireData');
          session()->forget('enquireStatus');
          $emailsend = [];

         $emailSg1 =  DB::table('email_notification as et')
          ->select('et.*')
          ->where('et.country',$country)
          ->where('et.type', 1)
          ->orderBy('et.country', 'asc')
          ->first();
          if(isset($emailSg1)){
            $emailg1 = explode(",", $emailSg1->email);
             if(count($emailg1) > 0){
                 foreach($emailg1 as $em){
                    if (!in_array(trim($em), $emailsend)) {
                     array_push($emailsend ,trim($em));
                    }
                 }
             }
          }
       
          $emailSg2 =  DB::table('email_notification as et')
          ->select('et.*')
          ->where('et.subject',$subject)
          ->where('et.type', 2)
          ->orderBy('et.country', 'asc')
          ->first();
          if(isset($emailSg2)){
            $emailg2 = explode(",", $emailSg2->email);
             if(count($emailg2) > 0){
                 foreach($emailg2 as $em2){
                    if (!in_array(trim($em2), $emailsend)) {
                     array_push($emailsend ,trim($em2));
                    }
                 }
             }
          }
     
          $emailSg3 =  DB::table('email_notification as et')
          ->select('et.*')
          ->where('et.product_type',$type_id)
          ->where('et.type', 3)
          ->orderBy('et.country', 'asc')
          ->first();
          if(isset($emailSg3)){
            $emailg3 = explode(",", $emailSg3->email);
             if(count($emailg3) > 0){
                 foreach($emailg3 as $em3){
                    if (!in_array(trim($em3), $emailsend)) {
                     array_push($emailsend ,trim($em3));
                    }
                 }
             }
          }
         
           try {
           
            $emaillog = Mail::to($emailsend)->send(new Contact($request->except('_token'),$ticket_id));
            Log::channel('mail_log')->info('[Success] message : Send Mail to '.implode(",",$emailsend));
            return \Redirect::back()->with("message","Send Email Successfully");
           } catch (\Swift_RfcComplianceException  $ex) {
            Log::channel('mail_log')->info('[Error] '.\Carbon\Carbon::now().' message :'. $ex->getMessage());
             return \Redirect::back()->with("message_eror","Can not send");
           }

         }else{
            return \Redirect::back()->with("message_eror_notvertify","Can not send");
         }
        
       }
       public function  LinktoEnquiry($type ,$type_name ,$pro_code){

            $strmodel =  str_replace("@", "/", $pro_code);
            // return dd($strmodel);
            session(['enquireModel' => $strmodel]);
            session(['enquireModelType' => $type]);
            session(['enquireModelTypeName' => $type_name]);
            session(['enquireType' => 0]);
            session(['enquireStatus' => 1]);
            session(['enquireData' => null]);

            return redirect()->route('contactSupport');
       }
       public function loaddocumentPro(Request $request){
           $lang = App::getLocale();
           $arrsearch = $request->data;
           $documents = [];
           if(isset($arrsearch)){
            $documents = DB::table('product_has_documents as phd')
            ->join('products as p','p.pro_id','=','phd.product_id')
            ->join('product_ducuments as pd','phd.document_id','=','pd.doc_id')
            ->join('product_ducument_translations as pdt','pdt.doc_fk_id','=','pd.doc_id')
            ->join('products_documents_categories as pdc','pdc.id','=','pd.cate_id')
            ->where('pdt.local',$lang)
            ->where('pdt.file','!=' ,'')
            ->where('pdt.file','!=' ,null)
            ->whereNotIn('pdc.id', [6 ,7,4])
            ->whereIn('pdc.id', $arrsearch)
            ->where('pdc.main_cate_id',2)
            ->select('phd.*','pd.cate_id as cate_id' )
            ->get();
           }
        return response()->json([
            'data' => $documents,
            'arrsearch', $arrsearch
         ], 200);
       }
       public function downloadGui(Request $request){
        $lang = App::getLocale();
      
        $name = $this->validateInput($request->name_gui,'text',true);
        $company = $this->validateInput($request->company_gui,'text',true);
        $checkname  =  preg_match('/\\s[^a-zA-Zก-ฮ]/', $name);
        if(!$checkname){
          $client = new Client();
          $response = $client->post(
              'https://www.recaptcha.net/recaptcha/api/siteverify',
              ['form_params'=>
                  [
                    'secret'=> '6LeFKfYUAAAAABtTFzPon_8pinsPsevCSFyePD8k',
                    //   'secret'=> '6LdshPcUAAAAACaoDOvGo7ncKgVazbyKoDlPi43T',
                      'response'=>$request->keyresponseCap
                   ]
              ]
          );
      
          $body = json_decode((string)$response->getBody());
          if($body->success){  
         
        
            $email = $this->validateInput($request->email_gui,'text',true);
            $tel = $this->validateInput($request->tel,'text',true);
            $ac_data = 0;
            if(isset($request->data_conf)){
                $ac_data  = $request->data_conf;
            }
            $acept = $this->validateInput($ac_data,'number',true ,0);
            $filename = $this->validateInput($request->fileguidownload,'text',true);
            $country = $this->validateInput($request->country,'text',true);
            $modelname = $this->validateInput($request->procodeGui,'text',true);
            $typeName = $this->validateInput($request->procateGui,'text',true);


          

    

            $subCategories = DB::table('sub_pro_categories as sp')
            ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'sp.sub_pro_id')
            ->where('spt.local', '=', $lang)
            ->where('spt.name','=',$typeName)
            ->where('sp.status', '=', 1)
            ->select('sp.sub_pro_id')
            ->orderBy('sp.order_seq', 'asc')
            ->first();

       

          
            
            $path =  base_path('../upload/product_files/').$filename; 
            $emailsend = [];


            DB::table('gui_downloads_email')->insert(
                [
                    'name' => $name,
                    'tel' => $tel,
                    'email' => $email,
                    'company' =>$company,
                    'country' =>$country,
                    'filename' =>$filename,
                    'model'=>$modelname,
                    'type_name'=>$typeName,
                    'accept' =>$acept,
                    "created_at" => \Carbon\Carbon::now(),
                ]
            );
        
            if($acept == 1){
                self::subCheckBox($request);
            }

            $emailSg1 =  DB::table('email_notification as et')
            ->select('et.*')
            ->where('et.country',$country)
            ->where('et.type', 1)
            ->orderBy('et.country', 'asc')
            ->first();
            if(isset($emailSg1)){
                $emailg1 = explode(",", $emailSg1->email_gui);
                if(count($emailg1) > 0){
                    foreach($emailg1 as $em){
                        if (!in_array(trim($em), $emailsend)) {
                        array_push($emailsend ,trim($em));
                        }
                    }
                }
            }

            if($subCategories && $subCategories->sub_pro_id){
                $emailSg3 =  DB::table('email_notification as et')
                    ->select('et.*')
                    ->where('et.product_type',$subCategories->sub_pro_id)
                    ->where('et.type', 3)
                    ->orderBy('et.country', 'asc')
                    ->first();
                    if(isset($emailSg3)){
                        $emailg3 = explode(",", $emailSg3->email);
                        if(count($emailg3) > 0){
                            foreach($emailg3 as $em3){
                                if (!in_array(trim($em3), $emailsend)) {
                                array_push($emailsend ,trim($em3));
                                }
                            }
                        }
                    }
            }
      

             $email = Mail::to($emailsend)->send(new DowloadGui($request->except('_token')));
            if (Mail::failures()) {
                return \Redirect::back()->with("errorSendMail","ErorSendMail");
            }
            return \Redirect::back()->with("messageGUI",$filename);
         }else{
            return \Redirect::back()->with("vertifynotrobot_gui","ErorSendMail-vertifynotrobot");
         }

        }else{
            return \Redirect::back()->with("errorSendMail","ErorSendMail");
        }

       }
       public function checkLang($lang ,$id){
         $returnlang = 'en';
            $hidelangPro = DB::table('products_translation as pt')
            ->where('pt.product_id',$id)
            ->where('pt.local' ,$lang)
            ->where('pt.showstatus',1)
            ->first();

            if(isset($hidelangPro)){
                 return $lang;
            }else{
                return $returnlang;
            }
       }
       public function searhstate(Request $request){
        $countryname  = $request->countryname;
        $dataSearch = [];
        $country = DB::table('countries as c')
        ->where('c.name',$countryname)
        ->first();
        if(isset($country)){
            $state = DB::table('states as s')
            ->where('s.country_id',$country->id)
            ->get();
            $dataSearch = $state;
        }
     
        return response()->json([
            'results' =>$dataSearch,
         ], 200);

       }

       public function searhProductByType(Request $request){
        $type_id  = $request->type_id;
        $products = [];

        $seachpro  = DB::table('products as p')
        ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
        ->where('phc.categories_id' ,$type_id)
        ->where('p.enable_pro' ,1)
        ->select('p.*')
        ->orderBy('p.pro_code','asc')
        ->get();

        foreach($seachpro as $pro){
            if(self::checkContentPro($pro->pro_id)){
                array_push($products,$pro);
                $optional_product = DB::table('product_optional_model as po')
                    ->join('products as p', 'p.pro_id', '=', 'po.product_id')
                    ->where('po.product_id' ,$pro->pro_id)
                    ->select('p.*','po.optional_model as pro_code')
                    ->orderBy('p.pro_code', 'asc')
                    ->get();
                    foreach($optional_product as $optional_model){
                        array_push($products,$optional_model);
                    }

        
            } 
        }
     
        return response()->json([
            'results' =>$products,
         ], 200);

       }
       public function checkpartnerAccount(Request $request){
           $email = $request->email;
           $email  = strtolower($request->email);
        
           $members = DB::table('partner')->where('email',trim($email))->first();
        //    return dd( $members);
        if($members != ""){
            $check = 1;
            $pin =   rand(100000,999999);
            $user  = DB::table('partner')->where('id', "=", $members->id)->update(array(
              "pin" => $pin,
              ));
            session(['pin' => $pin]);
           $link = $members->id;
           $member_email = $members->email;
          Mail::to($member_email)->send(new Forgetpass($request->except('_token'), $pin ,$link));
          return \Redirect::back()->with("message_sendmail","Send Email Successfully");
        }else{
            $check = 0;
            return \Redirect::back()->with("messageerror","Email not found");
        }

       }
       public function changePassword($pin){
        //    return dd($pin);
          $metatag = DB::table('meta_tag_page as mtp')->where('id',27)->get();
           $sectionpin = session('pin');
           $user = DB::table('partner')->where('pin',$pin)->get();
           if(isset($user)){
                  return view('front-end.resetPassword')->with('metatag',$metatag);
           }else{
            abort(404);
           }
       }

    public function resetPassword(Request $request){
        $pin =  $request->pin;
        $pin = $this->validateInput($request->pin,'number',true);
        $findpin = DB::table('partner')->where('pin',trim($pin))->first();

        if(isset($findpin)){
            $finduser = DB::table('partner')->where('id',$findpin->id)->first();
                     DB::table('partner')->where('id',$findpin->id)->update(
                         [
                            'password' => Hash::make($request->password),
                            'pin' => '',
                            "updated_at" => \Carbon\Carbon::now(),
                         ]
                     );
            if($finduser){
                return response()->json([
                    'status' => 1,
                    'message' => 'Change password is Success!!!'
                        ], 200);
            }else{
                return response()->json([
                    'status' => 0,
                    'message' => 'Eror , Not found user in System'
                        ], 200);            
            }
        
        }else{
            return response()->json([
                'status' => 3,
                'message' => 'Pin not found'
                    ], 200);
        }

       
       }

       public function loadnewPerti(Request $request){
        $arrPro  = $request->arrpro;
        $lang = App::getLocale();
        $data = [];
        if(isset($arrPro)){
            $data = DB::table('product_has_property as ph')
            ->join('product_has_property_translation as pht','ph.per_id' ,'=','pht.per_fk_id')
            ->join('product_field as pf','pf.id' ,'=','ph.type_id')
            ->join('product_field_translation as pft','ph.type_id' ,'=','pft.product_field_id')
            ->where('pht.local' ,'en')
            ->where('pft.local' ,$lang)
            ->whereIn('ph.product_id',$arrPro)
            ->orderBy('ph.type_id' ,'asc')
            ->select('pht.value_text','ph.*' ,'pft.field_name as fieldCate','pf.unit_name')
            ->get();
        }
          return response()->json([
            'data' => $data
                ], 200);

       }
      private function getDoc($typefile,$strmodel){
         $lolang = App::getLocale();
        $lang_d = session()->get('lang_down');
        if($lang_d == null && $lolang == 'en'){
            $lang = 'en';
        }else if($lolang != 'en'){
            $lang =  $lolang;
        } else{
            $lang = $lang_d;
        }
        // return dd($lang);
        // return dd( $lang_d);
        $stringM =  str_replace("-", "", $strmodel);
        $queryString = preg_replace('/[^A-Za-z0-9\-]/','',$stringM);
        $query = DB::table('product_has_documents as phd')
        ->join('products as p','p.pro_id','=','phd.product_id')
        ->join('product_ducuments as pd','phd.document_id','=','pd.doc_id')
        ->join('product_ducument_translations as pdt','pdt.doc_fk_id','=','pd.doc_id')
        ->join('products_documents_categories as pdc','pdc.id','=','pd.cate_id')
        ->join('pro_ducuments_cate_translations as pdct','pdct.doc_cate_id','=','pdc.id')
        ->where('pdt.local',$lang)
        ->where('pdct.local',$lang)
        ->where('pdt.file','!=' ,'')
        ->where('pdt.file','!=' ,null)
        ->where('pdc.slug',$typefile)
        ->select('p.pro_code','pd.doc_id','phd.product_id','pdct.lable' ,'pdt.name','pdc.title as catename','pd.created_at' ,'pdc.main_cate_id','pdt.file' ,'pd.cate_id');
        $query->where(\DB::raw("REPLACE(REPLACE(REPLACE(p.pro_code, '-', ''), '/', ''),' ','')"), 'LIKE', '%' . $queryString . '%');
        $documents = $query->get();

        return $documents;
       }
       public function downloadFIle($typefilePar,$modelPar){

        $typefile = $this->validateInput($typefilePar,'text',true);
        $chmodel = $this->validateInput($modelPar,'text',true);
        $strmodel =  str_replace("@", "/", $chmodel);
  
        $documents = self::getDoc($typefile,$strmodel );
          $file = null;
          if(isset($documents[0]->file)){
            $file = $documents[0]->file;
          }
          $path =  base_path('../upload/product_files/').$file; 
          $publicfile = config('app.url').'/upload/product_files/'.$file;
    
            if (file_exists($path) && isset($file) && $file != null && $file != '') {
                 $mime = mime_content_type($path);
                 $pathinfo = pathinfo($path);
                 $filename = $typefilePar.'_'.$chmodel.'.'.$pathinfo['extension'];
                 $zip_file = $typefilePar.'_'.$chmodel.'.zip'; // Name of our archive to download
                // return dd($pathinfo['extension']);
            if($pathinfo['extension'] == 'stp' || $pathinfo['extension'] == 'dxf' ){
                // Initializing PHP class
                // return dd($pathinfo['extension']);
                $zip = new \ZipArchive();
                $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
                // Adding file: second parameter is what will the path inside of the archive
                // So it will create another folder called "storage/" inside ZIP, and put the file there.
                $zip->addFile($path, $filename);
                $zip->close();
                return response()->download($zip_file)->deleteFileAfterSend(true);
            }else{

                $arrContextOptions=array(
                    "ssl"=>array(
                        "verify_peer"=>false,
                        "verify_peer_name"=>false,
                    ),
                );  
                
                return response()->make(file_get_contents($publicfile ,false, stream_context_create($arrContextOptions) ), 200, [
                    'Content-Type' => $mime,
                    'Content-Disposition' => 'inline; filename="'.$filename.'"'
                ]);
            
            }

            }else{
                abort(404);
            }
       }
       public function downloadFIleManual($lang,$typefilePar,$modelPar){

        $typefile = $this->validateInput($typefilePar,'text',true);
        $chmodel = $this->validateInput($modelPar,'text',true);
        $strmodel =  str_replace("@", "/", $chmodel);
        $stringM =  str_replace("-", "", $chmodel);
        $queryString = preg_replace('/[^A-Za-z0-9\-]/','',$stringM);
        $query = DB::table('product_has_documents as phd')
        ->join('products as p','p.pro_id','=','phd.product_id')
        ->join('product_ducuments as pd','phd.document_id','=','pd.doc_id')
        ->join('product_ducument_translations as pdt','pdt.doc_fk_id','=','pd.doc_id')
        ->join('products_documents_categories as pdc','pdc.id','=','pd.cate_id')
        ->join('pro_ducuments_cate_translations as pdct','pdct.doc_cate_id','=','pdc.id')
        ->where('pdt.local',$lang)
        ->where('pdt.file','!=','')
        ->where('pdt.file','!=',null)
        ->where('pdct.local','en')
        ->where('pdc.slug',$typefile)
        ->select('p.pro_code','pd.doc_id','phd.product_id','pdct.lable' ,'pdt.name','pdc.title as catename','pd.created_at' ,'pdc.main_cate_id','pdt.file' ,'pd.cate_id');
        $query->where(\DB::raw("REPLACE(REPLACE(REPLACE(p.pro_code, '-', ''), '/', ''),' ','')"), 'LIKE', '%' . $queryString . '%');
        $documents = $query->get();
       
        $file = null;
        if(isset($documents[0]->file)){
          $file = $documents[0]->file;
        }
        $path =  base_path('../upload/product_files/').$file ; 
        $publicfile = config('app.url').'/upload/product_files/'.$file;
          if (file_exists($path) && isset($file)  && $file != null && $file != '') {
               $mime = mime_content_type($path);
               $pathinfo = pathinfo($path);
               $filename = $typefilePar.'_'.$chmodel.'.'.$pathinfo['extension'];
               $zip_file = $typefilePar.'_'.$chmodel.'.zip'; // Name of our archive to download
              // return dd($pathinfo['extension']);
          if($pathinfo['extension'] == 'stp' || $pathinfo['extension'] == 'dxf' ){
              // Initializing PHP class
              // return dd($pathinfo['extension']);
              $zip = new \ZipArchive();
              $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
              // Adding file: second parameter is what will the path inside of the archive
              // So it will create another folder called "storage/" inside ZIP, and put the file there.
              $zip->addFile($path, $filename);
              $zip->close();
              return response()->download($zip_file)->deleteFileAfterSend(true);
          }else{
            $arrContextOptions=array(
                "ssl"=>array(
                    "verify_peer"=>false,
                    "verify_peer_name"=>false,
                ),
            );  
            
              return response()->make(file_get_contents($publicfile ,false, stream_context_create($arrContextOptions) ), 200, [
                  'Content-Type' => $mime,
                  'Content-Disposition' => 'inline; filename="'.$filename.'"'
              ]);
          }
          }else{
              abort(404);
          }
       }

      public function setlocaltion(Request $request){
     
        $lang = $this->validateInput($request->lang,'text',true);
        session(['lang_down' =>  $lang]);
        return response()->json([
            'data' =>$lang 
                ], 200);
      }

      public function imagelink($image){
        $path =  base_path('../frontend-asset/image/').$image ; 
        return response()->file($path);
      }
      public function marketingLink($image){
        $path =  base_path('../medias/partner/marketing_resources/').$image; 
        if(file_exists($path)){
            return response()->file($path);
        }else{
            return abort(404);
        }
       
      }

      public function tag_product(Request $request){
        $pro_id =  $request->proid;
         $tags =  DB::table('product_tags')->where('product_id',$pro_id)->get();
        return response()->json([
          'data' =>$tags 
              ], 200);
    }
    public function faq_detail($name){
      $lang = App::getLocale();
      $name = $this->validateInput($name,'text',true);
      $faqs = DB::table('faq as f')
      ->join('faq_translations as ft', 'f.id', '=', 'ft.faq_id')
      ->join('faq_categories_translations as fct', 'fct.f_cate_id', '=', 'f.cate_id')
      ->where('f.url_name',$name)
      ->where('ft.local', '=', $lang)
      ->where('fct.local', '=', $lang)
      ->select('f.*' ,'ft.*' ,'fct.name as cateName')
      ->get();
      return view('front-end.faq-detail')->with('faqs',$faqs);
    }
    public function getProById(Request $request){
        $proid = $request->proId;
        $proid = $this->validateInput($proid,'number',true);
  
        $products = DB::table('products as p')
        ->where('p.pro_id' ,$proid)
        ->select('p.*')
        ->orderBy('p.created_at', 'desc')
        ->first();
        if(isset($products)){
            $dimemsion = '';
        if(isset($products->dimensionL) && is_numeric($products->dimensionL)  && is_numeric($products->dimensionD)  && is_numeric($products->dimensionW) && isset($products->dimensionW) && isset($products->dimensionD)){
            $dimemsion = $products->dimensionL.' x '.$products->dimensionW.' x '.$products->dimensionD.' mm'.'<br>'.number_format($products->dimensionL* 0.0393701 ,2).'” x '.number_format($products->dimensionW * 0.0393701 ,2).'” x '.number_format($products->dimensionD* 0.0393701 ,2).'”' ;
        }else{
            $dimemsion = $products->dimensionL;
        }

        $sum  = 0;
        $dataUnitw = '';
        if(isset($products->unit_weight)){
            $number = substr($products->unit_weight , 0, -2);
            $float = (float)$number;
            $sum = ($float*2.2046244202);       
            $dataUnitw  =  $products->unit_weight.' ('.number_format($sum,2).' lb)';
        }
        
            $data = [
                'unitwight' => $dataUnitw,
                'dimension' => $dimemsion,
                'status' => true,
            ];  
        }else{
            $data = [
                'unitwight' => '-',
                'dimension' => '-',
                'status' => false,
            ]; 
        }

        return response()->json([
            'data' =>$data 
                ], 200);
    }
  
    function loadparallercon(Request $request){
        $model_id = $request->model_id;
        $Parallels =  DB::table('parallel_connections as pc')
        ->where('pc.model_id','=',$model_id)
        ->select('pc.*')
        ->get();

        return response()->json([
            'data' =>$Parallels 
                ], 200);
    }

    function GetCoparisonHeader($arrInpro ,$type_name){
        $lang = App::getLocale();
        $pro1 = null;
        $pro2 = null;
        $pro3 = null;
        if($arrInpro[0] &&  $arrInpro[0] != 0){
        $langpro1 =  self::checkLang($lang ,$arrInpro[0]);
        $pro1  = DB::table('products as p')
        ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
        ->join('series_translations as st', 'st.series_id', '=', 'p.series_id')
        ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
        ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'phc.categories_id')
        ->where('pt.local' ,$langpro1)
        ->where('spt.local' ,$lang)
        ->where('st.local' ,$lang)
        ->where('pt.showstatus' ,1)
        ->where('p.pro_id' ,$arrInpro[0])
        ->select('p.*', 'pt.*','spt.name as catename','st.title as seName')
        ->first();
          

        }
        if($arrInpro[1] &&  $arrInpro[1] != 0){
            $langpro2 =  self::checkLang($lang ,$arrInpro[1]);
            $pro2  = DB::table('products as p')
            ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
            ->join('series_translations as st', 'st.series_id', '=', 'p.series_id')
            ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
            ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'phc.categories_id')
            ->where('pt.local' ,$langpro2)
            ->where('spt.local' ,$lang)
            ->where('st.local' ,$lang)
            ->where('pt.showstatus' ,1)
            ->where('p.pro_id' ,$arrInpro[1])
            ->select('p.*', 'pt.*','spt.name as catename','st.title as seName')
            ->first();
         
        }
        if($arrInpro[2] &&  $arrInpro[2] != 0){
            $langpro3 =  self::checkLang($lang ,$arrInpro[2]);
            $pro3  = DB::table('products as p')
            ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
            ->join('series_translations as st', 'st.series_id', '=', 'p.series_id')
            ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
            ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'phc.categories_id')
            ->where('pt.local' ,$langpro3)
            ->where('spt.local' ,$lang)
            ->where('st.local' ,$lang)
            ->where('pt.showstatus' ,1)
            ->where('p.pro_id' ,$arrInpro[2])
            ->select('p.*', 'pt.*','spt.name as catename','st.title as seName')
            ->first();
          
        } 

        
            $typearr = ['Product Type',self::Checkdata($type_name)];
            $ModelName = ['Model Name',$pro1? self::Checkdata($pro1->pro_code):'' ,$pro2?self::Checkdata($pro2->pro_code):'',$pro3?self::Checkdata($pro3->pro_code):'' ];
         
            $Collect1 = array(
                $typearr,
                $ModelName,
            );


        $pd_field = DB::table('product_field as pf')
        ->join('product_field_translation as pft', 'pf.id', '=', 'pft.product_field_id')
        ->where('pft.local', '=', $lang)
        ->where('pf.id', '!=', 115)
        ->select('pf.*','pft.field_name')
        ->orderBy('pf.id', 'asc')
        ->get();
        // return dd($pd_field);
             $propertys = DB::table('product_has_property as ph')
              ->join('product_has_property_translation as pht','ph.per_id' ,'=','pht.per_fk_id')
              ->join('product_field as pf','pf.id' ,'=','ph.type_id')
              ->join('product_field_translation as pft','ph.type_id' ,'=','pft.product_field_id')
              ->join('products as p', 'p.pro_id', '=', 'ph.product_id')
              ->where('pht.local' ,'en')
              ->where('pft.local' ,$lang)
              ->whereIn('ph.product_id',$arrInpro)
              ->orderBy('ph.type_id' ,'asc')
              ->select('p.*' ,'pht.value_text','ph.*' ,'pft.field_name as fieldCate','pf.unit_name')
              ->get();
              $section = DB::table('section as st')
                ->join('section_translation as stt','st.id','=','stt.section_id')
                ->where('stt.local','=', $lang)
                ->select('st.id','stt.name')
                ->get();
          
           foreach($section as $sec){
              $arrsec = [$sec->name];
              array_push($Collect1, $arrsec);
                 foreach ($pd_field as $item){
                if($sec->id == $item->section_id ){
                    if(
                    self::searchValue($item->id,$arrInpro[0],$item->type,$item->unit_name,$propertys) != '' ||
                    self::searchValue($item->id,$arrInpro[1],$item->type,$item->unit_name,$propertys) != '' ||
                    self::searchValue($item->id,$arrInpro[2],$item->type,$item->unit_name,$propertys) != '' 
                    ){
                    $text1 =  self::searchValue($item->id,$arrInpro[0],$item->type,$item->unit_name,$propertys);
                    $text2 =  self::searchValue($item->id,$arrInpro[1],$item->type,$item->unit_name,$propertys);
                    $text3 =  self::searchValue($item->id,$arrInpro[2],$item->type,$item->unit_name,$propertys);
                    $popertity = [$item->field_name ,$text1 ,$text2 ,$text3];
                    array_push($Collect1, $popertity);
                   }
                }
               }

                if($sec->id == 3){
                      $getDimansion = ['Dimension',self::getDimansion($pro1) ,self::getDimansion($pro2),self::getDimansion($pro3) ];
                      $getUnitWeight = ['Unit Weight',self::getUnitWeight($pro1) ,self::getUnitWeight($pro2),self::getUnitWeight($pro3) ];
                      array_push($Collect1, $getDimansion);
                      array_push($Collect1, $getUnitWeight);
                }
        }
      

            $data = [
                'CSV' => $Collect1,
            ];  
            // return dd($data);
        return $data;
    }

    function searchValue($fil_id ,$proid ,$type ,$unit, $propertys){
        $data_result = '';
        // return dd($propertys);
        if($proid){
            if($type == 'number'){
           foreach($propertys as $item){
               if($item->type_id == $fil_id && $item->product_id == $proid){
                $datarr = [
                    $item->data_1,
                    $item->data_2,
                    $item->data_3,
                    $item->data_4,
                    $item->data_5,
                    $item->data_6,
                    $item->data_7,
                    $item->data_8,
                    $item->data_9,
                    $item->data_10,
                    $item->data_11,
                    $item->data_12
                ];
                $data_result = self::checkNullData($datarr,$unit,$item->status_input);
              }
            }
         
        }else if($type == 'text') {
            foreach($propertys as $item){
             if($item->type_id == $fil_id && $item->product_id == $proid){
                if($item->value_text != null && $item->value_text  != 'null'  ){
                    $raw2 = str_replace('<br>',"\n", $item->value_text);
                    $data_result = str_replace('<br/>',"\n", $raw2);
                }
              }
            }
        }
        }
        
        return $data_result;
       
    }

    function checkNullData($dataarr,$unit,$status){
        $stringText = '-';
        $arrstri = [];
       if($status == 1 || $status == 2){
        foreach($dataarr as $item){
          if($item){
            array_push($arrstri, $item.$unit);
          }
   
        }
        $stringText = join(",",$arrstri);
       }else if($status == 3){
        if($dataarr[0] && $dataarr[1]){
            $stringText = $dataarr[0].'-'.$dataarr[1].$unit;
        }
       
       }
         return  $stringText;
    }

    function Checkdata($data){
        // return dd($product);
          $str = '';
        if(isset($data)&& $data){
          $str = $data;
        }
         return $str;
                            
    }

    function getDimansion($product){
        // return dd($product);
          $str = '';

        if($product){
        if(isset($product->dimensionL) 
         && is_numeric($product->dimensionL) 
         && is_numeric($product->dimensionD)  
         && is_numeric($product->dimensionW) 
         && isset($product->dimensionW) 
         && isset($product->dimensionD)
         ){
          $str =  $product->dimensionL.' X '.$product->dimensionW.' X '. $product->dimensionD.' mm'. "\n".' '.number_format($product->dimensionL* 0.0393701 ,2).'" X '.number_format($product->dimensionW* 0.0393701 ,2).'" X '.number_format($product->dimensionD* 0.0393701 ,2).'"';
         }else{
          $str = $product->dimensionL;
         }
        }
         return $str;
                            
    }
    function getUnitWeight($product){
               $sum  = 0;
               $String = '';
        if($product){
          if(isset($product->unit_weight)){
                $number = substr($product->unit_weight , 0, -2);
                $float = (float)$number;
                $sum = ($float*2.2046244202);                  
          }
          $String =  $product->unit_weight.' ('.number_format($sum,2).' lb)';
        }
         return $String;
    }

    public function loginDocPartner($doc){
       $metatag = DB::table('meta_tag_page as mtp')->where('id',26)->get();
        return  view('front-end.login-doc-partner')
        ->with('doc' ,$doc)
        ->with('metatag' ,$metatag);
    }
 

    public function checkpermission($doc){
        $path =  base_path('../medias/partner/marketing_resources/').$doc; 
        $lang = App::getLocale();
     
        $partner_id = session('partner_id');
        $partner = DB::table('partner')->where('id',$partner_id)->where('status',1)->first();

        $margeting = null;
        $sales_kits = DB::table('partner_documents as s')
            ->join('partner_documents_translations as st', 's.id', '=', 'st.sk_fk_id')
            ->where('st.local' ,$lang)
            ->where('st.file' ,$doc)
            ->select('st.*')
            ->first();
    
        if(isset($partner) && $partner->role == 2 || isset($partner) && $partner->role == 1 ){
         $margeting = DB::table('marketing_resource as mr')
                ->join('marketing_resource_translations as mrt', 'mr.id', '=', 'mrt.mr_id')
                ->join('marketing_resource_cate as mc', 'mc.cate_id', '=', 'mr.cate_id')
                ->join('permission_marketcate as permar', 'permar.market_cate_id', '=', 'mc.cate_id')
                ->where('mrt.local', '=', $lang)
                ->where('mrt.file', '=',$doc)
                ->whereIn('permar.permission_id', [1,2])
                ->select('mr.*' ,'mrt.*')
                ->first();
        }

         $margeting_public = DB::table('marketing_resource as mr')
                ->join('marketing_resource_translations as mrt', 'mr.id', '=', 'mrt.mr_id')
                ->join('marketing_resource_cate as mc', 'mc.cate_id', '=', 'mr.cate_id')
                ->join('permission_marketcate as permar', 'permar.market_cate_id', '=', 'mc.cate_id')
                ->where('mrt.local', '=', $lang)
                ->where('mrt.file', '=',$doc)
                ->whereIn('permar.permission_id', [3])
                ->select('mr.*' ,'mrt.*')
                ->first();
    
        if(isset($margeting_public)){
           return response()->download($path);
        }
        else if(isset($sales_kits)){
            return redirect()->route('loginDocPartner',$doc );                 
          
        }
        else if(isset($margeting)){
            return response()->download($path);
        }
        else{
            return abort(404);
        }

      }


      public function partnerLoginDoc(Request $request){
        $str = $this->validateInput($request->email,'text',true);
        $doc = $this->validateInput($request->doc,'text',true);
            $username =  strtolower($str);
            $partner = DB::table('partner')->where('email',$username)->where('status',1)->get();
        
            if(count($partner) != 0){
                $checkPas = false;
                $inputpassword = $this->validateInput($request->password,'password',true);
               if(isset($inputpassword) && $inputpassword != null ){
                   $checkPas = Hash::check($inputpassword,$partner[0]->password);
               }
                //return dd($checkPas);
                if($checkPas) {
                    $path =  base_path('../medias/partner/marketing_resources/').$doc; 
                    $lang = App::getLocale();
                    $sales_kits = null;
                    if($partner[0]->role == 2){
                        $sales_kits = DB::table('partner_documents as s')
                        ->join('partner_documents_translations as st', 's.id', '=', 'st.sk_fk_id')
                        ->where('st.local' ,$lang)
                        ->where('st.file' ,$doc)
                        ->select('st.*')
                        ->first();
                    }
               
                    $margeting = null;
                 if($partner[0]->role == 2 || $partner[0]->role == 1 ){
                    $margeting = DB::table('marketing_resource as mr')
                            ->join('marketing_resource_translations as mrt', 'mr.id', '=', 'mrt.mr_id')
                            ->join('marketing_resource_cate as mc', 'mc.cate_id', '=', 'mr.cate_id')
                            ->join('permission_marketcate as permar', 'permar.market_cate_id', '=', 'mc.cate_id')
                            ->where('mrt.local', '=', $lang)
                            ->where('mrt.file', '=',$doc)
                            ->whereIn('permar.permission_id', [1,2])
                            ->select('mr.*' ,'mrt.*')
                            ->first();
                    }

                            $margeting_public = DB::table('marketing_resource as mr')
                            ->join('marketing_resource_translations as mrt', 'mr.id', '=', 'mrt.mr_id')
                            ->join('marketing_resource_cate as mc', 'mc.cate_id', '=', 'mr.cate_id')
                            ->join('permission_marketcate as permar', 'permar.market_cate_id', '=', 'mc.cate_id')
                            ->where('mrt.local', '=', $lang)
                            ->where('mrt.file', '=',$doc)
                            ->whereIn('permar.permission_id', [3])
                            ->select('mr.*' ,'mrt.*')
                            ->first();
                          
                            if($sales_kits){
                                   if(file_exists($path)){
                                    return response()->file($path);
                                    }else{
                                        return abort(404);
                                    }
                            }else if($margeting){
                                if(file_exists($path)){
                                    return response()->file($path);
                                    }else{
                                        return abort(404);
                                }
                            
                            }else if($margeting_public){
                                if(file_exists($path)){
                                    return response()->file($path);
                                    }else{
                                        return abort(404);
                                }
                            }
                            else{
                                return back()->with('flash_message_eror', 'Permission Not Correct');
                            }
    
                }else{
                    return back()->with('flash_message_eror', 'Password Not Correct');
                }  
            }else{
                return back()->with('flash_message_eror', 'No user account found in the system.');
            }
            return back()->with('flash_message_eror', 'Eror');
        }
        public function partnerLoginDoc_success(Request $request ){
            $doc = $this->validateInput($request->doc,'text',true);
            $section_id = $request->section_id;
            if(isset($section_id)){
                $partner = DB::table('partner')->where('id',$section_id)->where('status',1)->get();

                $path =  base_path('../medias/partner/marketing_resources/').$doc; 
                    $lang = App::getLocale();
                    $sales_kits = null;
                    if($partner[0]->role == 2){
                        $sales_kits = DB::table('partner_documents as s')
                        ->join('partner_documents_translations as st', 's.id', '=', 'st.sk_fk_id')
                        ->where('st.local' ,$lang)
                        ->where('st.file' ,$doc)
                        ->select('st.*')
                        ->first();
                    }
               
                    $margeting = null;
                 if($partner[0]->role == 2 || $partner[0]->role == 1 ){
                    $margeting = DB::table('marketing_resource as mr')
                            ->join('marketing_resource_translations as mrt', 'mr.id', '=', 'mrt.mr_id')
                            ->join('marketing_resource_cate as mc', 'mc.cate_id', '=', 'mr.cate_id')
                            ->join('permission_marketcate as permar', 'permar.market_cate_id', '=', 'mc.cate_id')
                            ->where('mrt.local', '=', $lang)
                            ->where('mrt.file', '=',$doc)
                            ->whereIn('permar.permission_id', [1,2])
                            ->select('mr.*' ,'mrt.*')
                            ->first();
                    }

                    $margeting_public = DB::table('marketing_resource as mr')
                            ->join('marketing_resource_translations as mrt', 'mr.id', '=', 'mrt.mr_id')
                            ->join('marketing_resource_cate as mc', 'mc.cate_id', '=', 'mr.cate_id')
                            ->join('permission_marketcate as permar', 'permar.market_cate_id', '=', 'mc.cate_id')
                            ->where('mrt.local', '=', $lang)
                            ->where('mrt.file', '=',$doc)
                            ->whereIn('permar.permission_id', [3])
                            ->select('mr.*' ,'mrt.*')
                            ->first();
                          
                            if($sales_kits){
                                   if(file_exists($path)){
                                    return response()->file($path);
                                    }else{
                                        return abort(404);
                                    }
                            }else if($margeting){
                                if(file_exists($path)){
                                    return response()->file($path);
                                    }else{
                                        return abort(404);
                                }
                            
                            }else if($margeting_public){
                                if(file_exists($path)){
                                    return response()->file($path);
                                    }else{
                                        return abort(404);
                                }
                            }
                            else{
                                return abort(401);
                            }
            }else{
                return redirect()->route('loginDocPartner',$doc );
            }
     
        }
     
    
}