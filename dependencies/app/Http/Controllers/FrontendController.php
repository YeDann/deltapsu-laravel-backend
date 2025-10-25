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
use Maatwebsite\Excel\Excel as ExcelFormat;
use Mailchimp;
use LaravelLocalization;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\Debug\ExceptionHandler as SymfonyExceptionHandler;
use App\Mail\ExceptionOccured;
use Hamcrest\Type\IsNumeric;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Cache;
class FrontendController extends Controller
{

    public function __construct() {
    $lang = App::getLocale();
    session(['lang_down' =>  App::getLocale()]);
    session(['product_comp' => []]);
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

            // $products = DB::table('products as p')
            // ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
            // ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
            // ->join('sub_pro_categories as sp', 'sp.sub_pro_id', '=', 'phc.categories_id')
            // ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'sp.sub_pro_id')
            // ->where('pt.local' ,$lang)
            // ->where('spt.local' ,$lang)
            // ->where('p.feature_product' ,1)
            // ->where('pt.showstatus' ,1)
            // ->select('p.*', 'pt.*' ,'spt.sub_pro_id as cateid' ,'spt.name as catename' ,'sp.unit_dimension')
            // ->orderBy('p.created_at', 'desc')
            // ->get();
            // $procheckarr = [];

            // $data = [];
            //      $i = 0;
            //     foreach($products as $item){

            //       $prolang = self::checkLang($lang,$item->pro_id);
            //         $pro = DB::table('products as p')
            //         ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
            //         ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
            //         ->join('sub_pro_categories as sp', 'sp.sub_pro_id', '=', 'phc.categories_id')
            //         ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'sp.sub_pro_id')
            //         ->where('pt.local' ,$prolang)
            //         ->where('spt.local' ,$lang)
            //         ->where('p.feature_product' ,1)
            //         ->where('p.enable_pro' ,1)
            //         ->where('p.pro_id' ,$item->pro_id)
            //         ->select('p.*', 'pt.*' ,'spt.sub_pro_id as cateid' , 'spt.name as catename' ,'sp.unit_dimension')
            //         ->orderBy('p.created_at', 'desc')
            //         ->first();

            //         $arraysub = [];
            //         $arraysub = DB::table('product_has_property as ph')
            //         ->join('product_has_property_translation as pht','ph.per_id' ,'=','pht.per_fk_id')
            //         ->join('product_field as pf','pf.id' ,'=','ph.type_id')
            //         ->join('product_field_translation as pft','ph.type_id' ,'=','pft.product_field_id')
            //         ->where('ph.product_id',$item->pro_id)
            //         ->where('pht.local' ,'en')
            //         ->where('pft.local' ,$lang)
            //         ->whereIn('ph.type_id',[4,3,8,31])
            //         ->orderBy('ph.type_id' ,'asc')
            //         ->select('pht.value_text','ph.*','pft.field_name as fieldCate','pf.unit_name')
            //         ->get();
            //         if(isset($pro)){
            //                 if(!in_array($pro->pro_id, $procheckarr)){
            //                 if(self::checkContentPro($pro->pro_id)){
            //                     array_push($procheckarr,$pro->pro_id);
            //                     $data[$i] = [
            //                         "pro_id"=>$pro->pro_id,
            //                         "pro_code"=>$pro->pro_code,
            //                         "cateid"=>$pro->cateid,
            //                         "catename"=>$pro->catename,
            //                         "picture"=>$pro->picture,
            //                         "unit_dimension"=>$pro->unit_dimension,
            //                         "status_product"=>$pro->status_product,
            //                         "content" =>$arraysub,
            //                         "dimensionL"=>$pro->dimensionL,
            //                         "dimensionW"=>$pro->dimensionW,
            //                         "dimensionD"=>$pro->dimensionD,
            //                     ];
            //                 }
            //             }
            //             $i++;
            //         }

            //     }
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

                $metatag = DB::table('meta_tag_page as mtp')
                ->join('meta_tag_page_translations as mtpt', 'mtp.id', '=', 'mtpt.meta_id')
                ->where('mtp.id',1)
                ->where('mtpt.local',  $lang)
                ->select('mtp.*' ,'mtpt.*')
                ->get();

                //return dd($metatag);

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

            return  view('front-end-minify.home')
            ->with('series_has_application',$series_has_application)
            ->with('series',$series)
            ->with('faqbanner',$faqbanner)
            ->with('metatag',$metatag)
            ->with('static_content',$static_content)
            ->with('applications',$applications)
            ->with('banners',$banners)
            // ->with('featePros',$data)
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
            $type_id = 0;
            if(isset($_GET['type-id']) && $_GET['type-id'] != 0 ){
                $type_id = $this->validateInput($_GET['type-id'],'number',true);
                $news = DB::table('product_news_has_categories as pnc')
                ->join('contents as c' ,'c.id' ,'=','pnc.content_id')
                ->join('contents_translations as ct' ,'ct.content_id' ,'=','c.id')
                ->join('news_type as nt' ,'nt.id' ,'=','pnc.categories_id')
                ->join('news_type_translation as ntt' ,'ntt.fk_nt_id' ,'=','nt.id')
                ->where('ct.local', $lang)
                ->where('ntt.local', $lang)
                ->where('c.content_type', '=', 'news')
                ->where('nt.id', $type_id)
                ->where('c.status',  1)
                ->select('c.*' ,'ct.*','ntt.title as cateName','nt.color_type','pnc.categories_id as typeId')
                ->orderBy('c.date_publish', 'desc')
                ->distinct()
                ->paginate(15);
            }else{

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
                ->paginate(15);

            }



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
            // return dd(count($news));

            $metatag = DB::table('meta_tag_page as mtp')
                ->join('meta_tag_page_translations as mtpt', 'mtp.id', '=', 'mtpt.meta_id')
                ->where('mtp.id',6)
                ->where('mtpt.local',  $lang)
                ->select('mtp.*' ,'mtpt.*')
                ->get();

            return  view('front-end.new')
            ->with('metatag' ,$metatag)
            ->with('news_type' ,$news_type)
            ->with('status_eol' ,$status)
            ->with('type_id' ,$type_id)
            ->with('news' ,$news);
        }
        if($page == 'login'){
            $sectionId = session('partner_id');
            $metatag = DB::table('meta_tag_page as mtp')
                ->join('meta_tag_page_translations as mtpt', 'mtp.id', '=', 'mtpt.meta_id')
                ->where('mtp.id',26)
                ->where('mtpt.local',  $lang)
                ->select('mtp.*' ,'mtpt.*')
                ->get();
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
            $metatag = DB::table('meta_tag_page as mtp')
                ->join('meta_tag_page_translations as mtpt', 'mtp.id', '=', 'mtpt.meta_id')
                ->where('mtp.id',7)
                ->where('mtpt.local',  $lang)
                ->select('mtp.*' ,'mtpt.*')
                ->get();
            return  view('front-end.event')->with('events2' ,$events2)->with('events' ,$events)->with('metatag' ,$metatag);
        }
        if($page == 'technical-articles'){
            return redirect()->route('index','home');
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
            $metatag = DB::table('meta_tag_page as mtp')
                ->join('meta_tag_page_translations as mtpt', 'mtp.id', '=', 'mtpt.meta_id')
                ->where('mtp.id',14)
                ->where('mtpt.local',  $lang)
                ->select('mtp.*' ,'mtpt.*')
                ->get();

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
            $getLastPro = DB::table('products as p')
            ->orderBy('p.pro_code', 'asc')
            ->select('p.*')
            ->first();

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
           ->where('p.pro_id' ,$getLastPro->pro_id)
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
                $metatag = DB::table('meta_tag_page as mtp')
                ->join('meta_tag_page_translations as mtpt', 'mtp.id', '=', 'mtpt.meta_id')
                ->where('mtp.id',9)
                ->where('mtpt.local',  $lang)
                ->select('mtp.*' ,'mtpt.*')
                ->get();
            return  view('front-end.product-documents')
            ->with('Protags' ,$Protags)
            ->with('metatag' ,$metatag)
            ->with('subCategories' ,$subCategories)
            ->with('series' ,$series)
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
            $metatag = DB::table('meta_tag_page as mtp')
                ->join('meta_tag_page_translations as mtpt', 'mtp.id', '=', 'mtpt.meta_id')
                ->where('mtp.id',8)
                ->where('mtpt.local',  $lang)
                ->select('mtp.*' ,'mtpt.*')
                ->get();
            return view('front-end.catalog')
            ->with('metatag',$metatag)
            ->with('margetCate',$margetCate)
            ->with('margeting',$margeting);
        }
        if($page =='partners'){
            $sectionId = session('partner_id');
            self::checkExpiryLogin();
            if($sectionId == null){
                return redirect()->route('index','login');
            }else{
                $metatag = DB::table('meta_tag_page as mtp')
                ->join('meta_tag_page_translations as mtpt', 'mtp.id', '=', 'mtpt.meta_id')
                ->where('mtp.id',29)
                ->where('mtpt.local',  $lang)
                ->select('mtp.*' ,'mtpt.*')
                ->get();
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

            $getLastPro = DB::table('products as p')
            ->orderBy('p.pro_code', 'asc')
            ->select('p.*')
            ->first();

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

                $documents_cate = DB::table('products_documents_categories as pdc')
                ->join('pro_ducuments_cate_translations as pdct','pdct.doc_cate_id','=','pdc.id')
                ->where('pdct.local','=', $lang)
                ->whereNotIn('pdc.id', [6 ,7,4])
                ->select('pdc.*','pdct.lable')
                ->orderBy('pdc.title','asc')
                ->get();
                // return dd( $documents_cate);
                $metatag = DB::table('meta_tag_page as mtp')
                ->join('meta_tag_page_translations as mtpt', 'mtp.id', '=', 'mtpt.meta_id')
                ->where('mtp.id',22)
                ->where('mtpt.local',  $lang)
                ->select('mtp.*' ,'mtpt.*')
                ->get();
            return view('front-end.manuals')
            ->with('showlangOb' ,$showlangOb)
            ->with('metatag' ,$metatag)
            ->with('subCategories' ,$subCategories)
            ->with('series' ,$series)
            ->with('products' ,$products);
        }
        if($page == 'subscribes'){
            $metatag = DB::table('meta_tag_page as mtp')
                ->join('meta_tag_page_translations as mtpt', 'mtp.id', '=', 'mtpt.meta_id')
                ->where('mtp.id',28)
                ->where('mtpt.local',  $lang)
                ->select('mtp.*' ,'mtpt.*')
                ->get();
           return view('front-end.subscribe')->with('metatag' ,$metatag);
        }
        if($page == 'subscribe'){
            return redirect()->route('index','subscribes');
         }
        if($page == 'logoutfrontend'){
            session()->forget(['partner_id', 'partner_firstname' ,'partner_lastname' ,'partner_lastname' ,'partner_phone' ,'partner_role' ,'partner_email','expiry_partner']);
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
        // return dd('ddd');
         //return redirect()->route('index','home');
          return response()->view('errors.404', [], 404);

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
        self::checkExpiryLogin();
        if($sectionId == null){
            return  view('front-end.login');
        }else{
            return redirect()->route('index','partners');
        }
    }
    // public  function redirectFeedback(){

    // }


    private function checkExpiryLogin(){
           $expiry = session('expiry_partner');
            $now = now();
            if(isset($expiry)){
                if($now >= $expiry){
                    session()->forget(['partner_id', 'partner_firstname' ,'partner_lastname' ,'partner_lastname' ,'partner_phone' ,'partner_role' ,'partner_email','expiry_partner']);
                    return redirect()->route('index','login');
                }
            }else{
                session()->forget(['partner_id', 'partner_firstname' ,'partner_lastname' ,'partner_lastname' ,'partner_phone' ,'partner_role' ,'partner_email','expiry_partner']);
                return redirect()->route('index','login');
            }
      }

    public function configurableProduct(){
    	$lang = App::getLocale();
    	$model = DB::table('cproducts')->select('product_code')->where('language',$lang)->where('status','1')->get();
        $model_alldata = DB::table('cproducts')->where('language',$lang)->where('status','1')->get();
        // return dd($model_alldata);
        $connectors_images = DB::table('connector_image as cm')
        ->select('cm.*')
        ->get();

        $metatag = DB::table('meta_tag_page as mtp')
                ->join('meta_tag_page_translations as mtpt', 'mtp.id', '=', 'mtpt.meta_id')
                ->where('mtp.id',5)
                ->where('mtpt.local',  $lang)
                ->select('mtp.*' ,'mtpt.*')
                ->get();
        return  view('front-end.configurableproduct')
        ->with('metatag',$metatag)
        ->with('model',$model)
        ->with('connectors_images',$connectors_images)
        ->with('model_alldata',$model_alldata);

    }

    public function allproductsByType($cate_parname ,$cate_par_id = 0,$main_pId){

        $cate = DB::table('sub_pro_categories as sc')
        ->select('sc.url_item')
        ->where('sc.sub_pro_id', $cate_par_id)
        ->first();

        if ($cate && $cate->url_item !== $cate_parname && $main_pId != 3){
            return redirect()->route('allproductsByType', [$cate->url_item, $cate_par_id, $main_pId]);
        }


        $catename = $this->validateInput($cate_parname ,'text',true);
        $cateid = $this->validateInput($cate_par_id ,'number',true);
        $mainId = $this->validateInput($main_pId ,'number',true);

        $lang = App::getLocale();

        $status1_last = DB::table('least_products as lp')
        ->join('least_products_translation as lpt', 'lp.id', '=', 'lpt.last_id')
        ->Leftjoin('products as p', 'p.pro_id', '=', 'lp.product_id')
        ->Leftjoin('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
        ->Leftjoin('sub_pro_categories as sc', 'phc.categories_id', '=', 'sc.sub_pro_id')
        ->Leftjoin('sub_pro_categories_translation as subt', 'phc.categories_id', '=', 'subt.sub_pro_id')
        ->select('lp.*', 'lpt.*' ,'p.pro_code','sc.url_item' ,'p.picture' ,'subt.name as catename')
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
        ->where('mp.active',1)
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
        $metatag = DB::table('meta_tag_page as mtp')
                ->join('meta_tag_page_translations as mtpt', 'mtp.id', '=', 'mtpt.meta_id')
                ->where('mtp.id',2)
                ->where('mtpt.local',  $lang)
                ->select('mtp.*' ,'mtpt.*')
                ->get();
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

    public function allproduct(){

        $lang = App::getLocale();

        $status1_last = DB::table('least_products as lp')
        ->join('least_products_translation as lpt', 'lp.id', '=', 'lpt.last_id')
        ->Leftjoin('products as p', 'p.pro_id', '=', 'lp.product_id')
        ->Leftjoin('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
        ->Leftjoin('sub_pro_categories_translation as subt', 'phc.categories_id', '=', 'subt.sub_pro_id')
        ->join('sub_pro_categories as sp', 'sp.sub_pro_id', '=', 'phc.categories_id')
        ->select('lp.*', 'lpt.*' ,'p.pro_code' , 'sp.url_item','p.picture' ,'subt.name as catename')
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
        $metatag = DB::table('meta_tag_page as mtp')
                ->join('meta_tag_page_translations as mtpt', 'mtp.id', '=', 'mtpt.meta_id')
                ->where('mtp.id',2)
                ->where('mtpt.local',  $lang)
                ->select('mtp.*' ,'mtpt.*')
                ->get();
        return  view('front-end.allproducts')
        ->with('metatag',$metatag)
        ->with('modeSeries',$modeSeries)
        ->with('mainCategories',$mainCategories)
        ->with('subCategories',$subCategories)
        ->with('cateid',0)
        ->with('mainId',0)
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
        return  redirect()->route('productList',[$series->catename,$series->cateid,$series->se_name,$series->se_id]);
       }else{
        return redirect()->route('index','home');
       }

    }
    public function productList($cate_parname,$cate_par_id,$se_par_name = null,$se_par_id = null){

    $lang = App::getLocale();
    if(!is_numeric($cate_par_id)) {
        return response()->view('errors.404', [], 404);
    }

    $cate = DB::table('sub_pro_categories as sc')
    ->select('sc.url_item')
    ->where('sc.sub_pro_id', $cate_par_id)
    ->first();

    if ($cate && $cate->url_item !== $cate_parname){
        return redirect()->route('productList', [$cate->url_item, $cate_par_id, $se_par_id]);
    }

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
    $productCodeArr = [];
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
             array_push($productCodeArr,trim($datapro->pro_code));
             $optional_product = DB::table('product_optional_model as po')
                    ->join('products as p', 'p.pro_id', '=', 'po.product_id')
                    ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
                    ->where('pt.local',$prolang)
                    ->where('p.enable_pro' ,1)
                    ->where('po.product_id' ,$pro->pro_id)
                    ->select('p.*','pt.*','po.optional_model','po.optional_model as pro_code' )
                    ->orderBy('p.created_at', 'desc')
                    ->get();


                    foreach($optional_product as $optional){
                        if (!in_array(trim($optional->optional_model), $productCodeArr)) {
                          array_push($products,$optional);
                        }
                    }
        }

    }
    $pro_new = self::removeDuplicates($products ,'pro_code');

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

           $metatag = DB::table('meta_tag_page as mtp')
                ->join('meta_tag_page_translations as mtpt', 'mtp.id', '=', 'mtpt.meta_id')
                ->where('mtp.id',3)
                ->where('mtpt.local',  $lang)
                ->select('mtp.*' ,'mtpt.*')
                ->get();

        if(!empty($products)){
            return  view('front-end.product')
            ->with('metatag',$metatag)
            ->with('defaultfilters',$defaultfilters)
            ->with('certi_products',$certi_products)
            ->with('documents_cate',$documents_cate)
            ->with('section',$section)
            ->with('products',$pro_new)
            ->with('filter_pro',$filter_pro)
            ->with('pd_field',$pd_field)
            ->with('product_has_property',$product_has_property)
            ->with('subCategories',$subCategories)
            ->with('catename',$catename)
            ->with('cateid',$cateid)
            ->with('se_name',$se_name)
            ->with('series',$series)
            ->with('se_id',$se_id);
        } else {
            return response()->view('errors.404', [], 404);
        }


    }

    function removeDuplicates($array, $propertyName) {
    $uniqueValues = array();
    $resultArray = array();

    foreach ($array as $item) {
        $propertyValue = $item->$propertyName;

        if (!in_array($propertyValue, $uniqueValues)) {
            $uniqueValues[] = $propertyValue;
            $resultArray[] = $item;
        }
    }
    return $resultArray;
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
            return  redirect()->route('allproductsByType',[$cate,$findoldCate->sub_pro_id,$findoldCate->main_cateid], 301);
        }else{
            // return redirect()->route('productFinder');
            // return redirect()->route('productFinder', [], 301);
            return response()->view('errors.404', [], 404);
        }
    }




    public function productsDetailsByType($catename,$procode = null){
        $name = $this->validateInput($catename,'text',true);

        $pro_code = $this->validateInput($procode ,'text',true);

        // return dd($name);
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
                $catename_new  = str_replace("@", "/", $catename);
                $check_optional = self::checkHaveModel($optional_model_code);
              if($check_optional){
                return redirect()->route('productsDetailsByType',[$catename_new,$optional_model_code] );
              }

        }

        $findoldCate_temp = DB::table('sub_pro_categories as c')
        ->get();
        // return dd ($findoldCate_temp);
        $maxSimilarity = 0;
        $findoldCateFirst = null;
        foreach ($findoldCate_temp as $item) {
            $urlItem = $item->url_item;
            $similarity = self::similarity($catename, $urlItem);

            // แสดงข้อมูลสำหรับดีบัก
            // dd($item, $similarity, $catename, $urlItem);

            // ถ้าความคล้ายคลึงสูงสุดใหม่ ให้เก็บข้อมูลนี้ไว้
            if ($similarity > 0) {
                if ($similarity > $maxSimilarity) {
                    $maxSimilarity = $similarity;
                    $findoldCateFirst = $item;
                }
            }
        }

        // ตรวจสอบผลลัพธ์
        // return dd ($findoldCateFirst, $maxSimilarity);


        $findoldCate = $findoldCateFirst;
        // return dd($name, $findoldCate_temp, $findoldCate);
        // return dd($findoldCate);
        if ($findoldCate == null) {
            return redirect()->route('productsDetailsByType',[$name, $procode] );

            // return response()->view('errors.404', [], 404);
        }
        if(isset($slgSeries) && isset($findoldCate)){
            $findoldSeries = DB::table('series as s')
            ->where('s.slug',$slgSeries)
            ->first();
            if($findoldSeries){
                return  redirect()->route('productList',[$findoldCate->url_item,$findoldCate->sub_pro_id,$findoldSeries->slug,$findoldSeries->se_id]);
            }else{
                return redirect()->route('productFinder');
            }
        }else if(isset($findoldCate) && !isset($procode)){
            // return dd('hello');
            return  redirect()->route('productList',[$findoldCate->url_item,$findoldCate->sub_pro_id]);
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
        $check = self::checkHaveModel($proCode);
        $check_2 = self::checkHaveModelOptional($proCode);
        // return dd($check_2, $check);

        if(isset($check->pro_id)){
            $prolang =  self::checkLang($lang ,$check->pro_id);

        }
        else if($check_2){
            $pro_code_n  = str_replace("/", "@",$check_2->pro_code);
            $optional_model_n  = str_replace("/", "@",trim($proCode));
            if(isset($check->pro_code) || isset($check_2->pro_code)){
                return redirect()->route('productsDetailsByType',[$name,$pro_code_n ,"optional_model" => $optional_model_n]);
            }else {
                return response()->view('errors.404', [], 404);
            }
        }
        else{
            // return dd($findoldCate->url_item,$findoldCate->sub_pro_id);
            return  redirect()->route('productList',[$findoldCate->url_item,$findoldCate->sub_pro_id]);
            // return response()->view('errors.404', [], 404);

        }

        $pro = DB::table('products as p')
        ->join('products_translation as pt', 'p.pro_id', '=', 'pt.product_id')
        ->join('series_translations as st', 'st.series_id', '=', 'p.series_id')
        ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
        ->join('sub_pro_categories as sp', 'sp.sub_pro_id', '=', 'phc.categories_id')
        ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'sp.sub_pro_id')
        ->where('pt.local' ,$prolang)
        // ->where('st.local' ,$lang)
        ->where('spt.local' ,$lang)
        ->where('p.pro_id',$check->pro_id)
        ->select('p.*', 'pt.*' ,'st.title as serieName' ,'spt.name as catename','sp.url_item as url_item','spt.sub_pro_id as pro_categories_id','sp.unit_dimension','sp.unit_dimension_1' )
        ->orderBy('p.created_at', 'desc')
        ->first();

        // return dd( $pro);

        if(!self::checkContentPro($pro->pro_id)){
            return redirect()->route('productFinder');
        }

        $external_link = DB::table('external_link as e')
         ->select('e.*')
         ->where('e.products',$pro->pro_id)
         ->get();

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

        //  return dd($product_has_property);

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
                    "meta_description"=>$pro->meta_description,
                    "serie_id"=>$pro->series_id,
                    "serie_name"=>$pro->serieName,
                    "cate_name"=>$pro->catename,
                    "url_item"=>$pro->url_item,
                    "cate_id"=>$pro->pro_categories_id,
                    "alt_img" =>$pro->alt_img,
                    "content" =>$arraysub,
                    "dimensionL"=>$pro->dimensionL,
                    "dimensionW"=>$pro->dimensionW,
                    "dimensionD"=>$pro->dimensionD,
                ];

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
                ->select('p.*', 'pt.*' ,'spt.name as catename','sp.url_item as url_item' ,'spt.sub_pro_id as pro_categories_id' ,'sp.unit_dimension','sp.unit_dimension_1')
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
            ->select('p.*', 'pt.*' ,'spt.name as catename' ,'sp.url_item as url_item','spt.sub_pro_id as pro_categories_id' ,'sp.unit_dimension','sp.unit_dimension_1')
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
                        "unit_dimension_1"=>$pro->unit_dimension_1,
                        "unit_dimension"=>$pro->unit_dimension,
                        "status_product"=>$pro->status_product,
                        "content" =>$arraysub,
                        "alt_img" =>$pro->alt_img,
                        "url_item"=>$pro->url_item,
                        "dimensionL"=>$pro->dimensionL,
                        "dimensionW"=>$pro->dimensionW,
                        "dimensionD"=>$pro->dimensionD,
                    ];
                   }

                    $j++;
                }

                $section = DB::table('section as st')
                ->join('section_translation as stt','st.id','=','stt.section_id')
                ->where('stt.local',$lang)
                // ->where('st.status', 1)
                ->select('st.id', 'stt.sortname','stt.name')
                ->get();
        // return dd($data_other);
        if($findoldCate->url_item != $name ){
                    // return dd($pro_code, $findoldCate->url_item);
            return redirect()->to('/products/' . $findoldCate->url_item . '/' . $procode, 301);
        }else {
            // return dd('eslse', $data);
            return view('front-end.productdetails')
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
        $pro_new = self::removeDuplicates($products ,'pro_code');
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

        $metatag = DB::table('meta_tag_page as mtp')
                ->join('meta_tag_page_translations as mtpt', 'mtp.id', '=', 'mtpt.meta_id')
                ->where('mtp.id',13)
                ->where('mtpt.local',  $lang)
                ->select('mtp.*' ,'mtpt.*')
                ->get();
        return  view('front-end.productcoparison')
        ->with('metatag' ,$metatag)
        ->with('cateid' ,$cateid)
        ->with('sess_arr' ,$sess_arr)
        ->with('data_re' ,$data)
        ->with('section' ,$section)
        ->with('Categories' ,$Categories)
        ->with('pd_field' ,$pd_field)
        ->with('products' ,$pro_new);
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

        $pro_new = self::removeDuplicates($products ,'pro_code');
        return response()->json([
            'data' => $pro_new
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
        $metatag = DB::table('meta_tag_page as mtp')
                ->join('meta_tag_page_translations as mtpt', 'mtp.id', '=', 'mtpt.meta_id')
                ->where('mtp.id',4)
                ->where('mtpt.local',  $lang)
                ->select('mtp.*' ,'mtpt.*')
                ->get();
                //return dd ($metatag)
         return  view('front-end.productfinder')
        ->with('subCategories',$subCategories)->with('metatag',$metatag);
    }
    public function applicationDetail($namePram){
        $name = $this->validateInput($namePram,'text',true);
        $lang = App::getLocale();
        $myArray = explode('-', $name);
        $id =  $myArray[0] ? $myArray[0] : null;
        $str1 =  isset($myArray[1]) ? $myArray[1] : null ;
        $str2 =  isset($myArray[2]) ? $myArray[2] : null ;
        $str3 =  isset($myArray[3]) ? $myArray[3] : null ;
        $string_name = $str1 ? $str1 : null  ;
        if($str1 && $str2){
            $string_name = $str1.'-'.$str2;
        }
        if($str1 && $str2 && $str3 ){
            $string_name =  $str1.'-'.$str2.'-'.$str3;
        }
        if(isset($string_name) && isset($id) ){
            return redirect()->route('appDetail',[ 'name' => preg_replace('/\s+/', '-',strtolower($string_name)) , 'id' => $id]);
        }else{
            return redirect()->route('index','home');
        }
    }

    public function appDetailById($app_name, $app_id){
        $name = $this->validateInput($app_name,'text',true);
        $id = $this->validateInput($app_id ,'number',true);

        $lang = App::getLocale();
        $application = DB::table('application as ap')
        ->join('application_translation as apt','ap.id','=','apt.app_id')
        ->where('apt.local','=',$lang)
        ->where('ap.id' , $id)
        ->select('ap.*' ,'ap.id as applica_id' , 'apt.name' ,
        'apt.content','apt.content_2' ,'apt.overview' ,'apt.overview_text' ,'apt.meta_title', 'apt.meta_description' ,'h1')
        ->orderBy('ap.order_seq' ,'asc')
        ->first();

        if($application->slug_app != $name){
            return redirect()->route('appDetail',[ 'name' => $application->slug_app , 'id' => $id]);
        }

        $image = DB::table('more_image_app as mp')
        ->where('mp.app_id' ,$id)
        ->select('mp.*')
        ->get();

        $otherapp = DB::table('application as ap')
        ->join('application_translation as apt','ap.id','=','apt.app_id')
        ->where('apt.local','=',$lang)
        ->where('ap.id','!=' , $id)
        ->select('ap.*' ,'ap.id as applica_id' , 'apt.name' ,'apt.content' ,'apt.content_2' ,'apt.overview')
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
        similar_text($application->slug_app, $name, $percent);
        if($application != null && $percent > 80){
            return  view('front-end.applicationdetail')
            ->with('image' ,$image)
            ->with('otherapp' ,$otherapp)
            ->with('relatedApp' ,$relatedApp)
            ->with('application' ,$application);
        } else {
            return response()->view('errors.404', [], 404);
            // return redirect()->route('index','home');
        }
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
        // Get the current URL
        $currentUrl = url()->current();
        $lowercaseUrl = strtolower($currentUrl);

        // If the URL is not in lowercase, redirect to the lowercase version
        if ($currentUrl !== $lowercaseUrl) {
            return redirect()->to($lowercaseUrl, 301);
        }

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
            return response()->view('errors.404', [], 404);
            // return redirect()->route('index','news');
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


          //return dd($contents);
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
            return response()->view('errors.404', [], 404);
            // return redirect()->route('index','home');
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
        return redirect()->route('index','home');
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

        $static_content = DB::table('static_content as st')
            ->join('static_content_translations as sct','st.sta_id','=','sct.sta_fk_id')
            ->where('type_con_id',8)
            ->select('st.*','sct.*')
            ->where('sct.local','=',$lang)
            ->first();


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
        $metatag = DB::table('meta_tag_page as mtp')
                ->join('meta_tag_page_translations as mtpt', 'mtp.id', '=', 'mtpt.meta_id')
                ->where('mtp.id',10)
                ->where('mtpt.local',  $lang)
                ->select('mtp.*' ,'mtpt.*')
                ->get();
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
            ->with('static_content' ,$static_content)
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

        $metatag = DB::table('meta_tag_page as mtp')
                ->join('meta_tag_page_translations as mtpt', 'mtp.id', '=', 'mtpt.meta_id')
                ->where('mtp.id',11)
                ->where('mtpt.local',  $lang)
                ->select('mtp.*' ,'mtpt.*')
                ->get();

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
        $metatag = DB::table('meta_tag_page as mtp')
                ->join('meta_tag_page_translations as mtpt', 'mtp.id', '=', 'mtpt.meta_id')
                ->where('mtp.id',12)
                ->where('mtpt.local',  $lang)
                ->select('mtp.*' ,'mtpt.*')
                ->get();
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
        $metatag = DB::table('meta_tag_page as mtp')
                ->join('meta_tag_page_translations as mtpt', 'mtp.id', '=', 'mtpt.meta_id')
                ->where('mtp.id',24)
                ->where('mtpt.local',  $lang)
                ->select('mtp.*' ,'mtpt.*')
                ->get();
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
        $metatag = DB::table('meta_tag_page as mtp')
                ->join('meta_tag_page_translations as mtpt', 'mtp.id', '=', 'mtpt.meta_id')
                ->where('mtp.id',25)
                ->where('mtpt.local',  $lang)
                ->select('mtp.*' ,'mtpt.*')
                ->get();
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
        self::checkExpiryLogin();
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

        $metatag = DB::table('meta_tag_page as mtp')
                ->join('meta_tag_page_translations as mtpt', 'mtp.id', '=', 'mtpt.meta_id')
                ->where('mtp.id',16)
                ->where('mtpt.local',  $lang)
                ->select('mtp.*' ,'mtpt.*')
                ->get();

        return  view('front-end.product-launch-schedule')
        ->with('metatag' ,$metatag)
        ->with('relate_pro_launch_schedule' ,$relate_pro_launch_schedule);
    }
    public function marketingResources(){
        $lang = App::getLocale();
        $sectionId = session('partner_id');
        self::checkExpiryLogin();
        if($sectionId == null){
            return redirect()->route('index','login');
        }
        $static_content = DB::table('partner_page_info as pi')
        ->join('partner_page_info_translation as pit','pit.fk_p_id','=','pi.id')
        ->select('pi.*','pit.*')
        ->where('pit.local' ,$lang)
        ->get();
        $metatag = DB::table('meta_tag_page as mtp')
                ->join('meta_tag_page_translations as mtpt', 'mtp.id', '=', 'mtpt.meta_id')
                ->where('mtp.id',17)
                ->where('mtpt.local',  $lang)
                ->select('mtp.*' ,'mtpt.*')
                ->get();
        return  view('front-end.marketing-resources')
        ->with('metatag' ,$metatag)
        ->with('static_content',$static_content);
    }
    public function marketingResourcesDownloads(){
        $lang = App::getLocale();
        $sectionId = session('partner_id');
        $roleId = session('partner_role');
        self::checkExpiryLogin();
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
        $metatag = DB::table('meta_tag_page as mtp')
                ->join('meta_tag_page_translations as mtpt', 'mtp.id', '=', 'mtpt.meta_id')
                ->where('mtp.id',15)
                ->where('mtpt.local',  $lang)
                ->select('mtp.*' ,'mtpt.*')
                ->get();
        return  view('front-end.marketing-resources-downloads')
        ->with('metatag',$metatag)
        ->with('margetCate',$margetCate)
        ->with('margeting',$margeting);
    }
    public function saleKit(){
        $lang = App::getLocale();
        $sectionId = session('partner_id');
        self::checkExpiryLogin();
        if($sectionId == null){
            return redirect()->route('index','login');
        }
        $product_docs = DB::table('partner_documents as s')
        ->join('partner_documents_translations as st', 's.id', '=', 'st.sk_fk_id')
        ->where('st.local' ,$lang)
        ->where('s.type_info' ,1)
        ->select('s.*', 'st.*')
        ->get();
        $metatag = DB::table('meta_tag_page as mtp')
                ->join('meta_tag_page_translations as mtpt', 'mtp.id', '=', 'mtpt.meta_id')
                ->where('mtp.id',19)
                ->where('mtpt.local',  $lang)
                ->select('mtp.*' ,'mtpt.*')
                ->get();
        return  view('front-end.sale-kit')->with('metatag' ,$metatag)->with('product_docs' ,$product_docs);
    }
    public function productCrossReference(){
        $lang = App::getLocale();
        $sectionId = session('partner_id');
        self::checkExpiryLogin();
        if($sectionId == null){
            return redirect()->route('index','login');
        }
        $product_docs = DB::table('partner_documents as s')
        ->join('partner_documents_translations as st', 's.id', '=', 'st.sk_fk_id')
        ->where('st.local' ,$lang)
        ->where('s.type_info' ,2)
        ->select('s.*', 'st.*')
        ->get();
        $metatag = DB::table('meta_tag_page as mtp')
                ->join('meta_tag_page_translations as mtpt', 'mtp.id', '=', 'mtpt.meta_id')
                ->where('mtp.id',20)
                ->where('mtpt.local',  $lang)
                ->select('mtp.*' ,'mtpt.*')
                ->get();
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
        self::checkExpiryLogin();
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
        self::checkExpiryLogin();
        if($sectionId == null){
            return redirect()->route('index','login');
        }

        $metatag = DB::table('meta_tag_page as mtp')
                ->join('meta_tag_page_translations as mtpt', 'mtp.id', '=', 'mtpt.meta_id')
                ->where('mtp.id',21)
                ->where('mtpt.local',  $lang)
                ->select('mtp.*' ,'mtpt.*')
                ->get();

        return  view('front-end.config-history')->with('metatag' ,$metatag)->with('con_his' ,$con_his);
    }
    public function successStories(){
        $sectionId = session('partner_id');
        $lang = App::getLocale();
        self::checkExpiryLogin();
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
        $metatag = DB::table('meta_tag_page as mtp')
                ->join('meta_tag_page_translations as mtpt', 'mtp.id', '=', 'mtpt.meta_id')
                ->where('mtp.id',18)
                ->where('mtpt.local',  $lang)
                ->select('mtp.*' ,'mtpt.*')
                ->get();
        return  view('front-end.success-stories')
        ->with('metatag' ,$metatag)
        ->with('sectionId' ,$sectionId)
        ->with('image_story' ,$image_story)
        ->with('AllsuccessStory' ,$AllsuccessStory);
    }
    public function addSuccessStories(){
        $lang = App::getLocale();
        $sectionId = session('partner_id');
        self::checkExpiryLogin();
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
        self::checkExpiryLogin();
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
        self::checkExpiryLogin();
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
            $metatag = DB::table('meta_tag_page as mtp')
                ->join('meta_tag_page_translations as mtpt', 'mtp.id', '=', 'mtpt.meta_id')
                ->where('mtp.id',9)
                ->where('mtpt.local',  $lang)
                ->select('mtp.*' ,'mtpt.*')
                ->get();
        return  view('front-end.login-pro-document')
        ->with('metatag' ,$metatag)
        ->with('subCategories' ,$subCategories)
        ->with('series' ,$series)
        ->with('products' ,$products);
    }

   public function loadPdffile(Request $request)
    {
        $contentCompare = $request->datacon;
        $string = $this->validateInput($request->arr_con, 'text', true);
        $type_name = $this->validateInput($request->type_name, 'text', true);
        $myArray = explode(',', $string);
        $rsp = self::GetCoparisonHeader($myArray, $type_name);

        $rowall = $rsp['CSV'];

        // Laravel Excel 3.x syntax
       return Excel::download(
    new class($rowall) implements \Maatwebsite\Excel\Concerns\FromArray {
        private $data;

        public function __construct($data) {
            $this->data = $data;
        }

        public function array(): array {
            return $this->data;
        }

        // ✅ BOM + UTF-8 settings for Windows Excel
        public function getCsvSettings(): array
            {
                return [
                    'use_bom' => true,
                     'encoding' => 'UTF-16LE',
                    'delimiter' => ',',
                ];
            }
            },
            'comparison_product.csv',
            ExcelFormat::CSV,
            [
                'use_bom' => true,
                 'encoding' => 'UTF-16LE',
            ]
        );
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
       private function searchProductOnly($keypro, $keyParts, $lang, $limit)
        {
            // Base product query with relationships
            $query = DB::table('products as p')
                ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
                ->join('sub_pro_categories as sp', 'sp.sub_pro_id', '=', 'phc.categories_id')
                ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'phc.categories_id')
                ->join('series_translations as st', 'st.series_id', '=', 'p.series_id')
                ->leftJoin('product_tags as ptag', 'ptag.product_id', '=', 'p.pro_id')
                ->leftJoin('product_optional_model as op', 'op.product_id', '=', 'p.pro_id')
                ->where('spt.local', $lang)
                ->where('st.local', $lang)
                ->where('p.enable_pro', 1)
                ->where(function ($q) use ($keypro, $keyParts) {
                    $q->orWhere('p.pro_code', '=', $keypro)
                    ->orWhere('op.optional_model',"=",$keypro)
                    ->orWhere('ptag.tag',"=",$keypro)
                    ->orWhere('st.name',"=",$keypro);
                    // Search by parts with priority on matches at start of the string
                    foreach ($keyParts as $part) {
                        $q->orWhere('p.pro_code', 'LIKE', $part . '%')
                        ->orWhere('p.pro_code', 'LIKE', '%' . $part . '%')
                        ->orWhere('st.name', 'LIKE', '%' . $part . '%');
                    }
                })
                ->orderByRaw("
                    CASE
                        WHEN p.pro_code = ? THEN 1
                        WHEN p.pro_code LIKE ? THEN 2
                        ELSE 5
                    END", [$keypro, $keyParts[0] . '%']) // Ensure proper parameter binding
                ->select(
                    'p.pro_id',
                    'p.pro_code',
                    'p.picture',
                    'p.status_product',
                    'p.dimensionL',
                    'p.dimensionW',
                    'p.dimensionD',
                    'sp.url_item',
                    'spt.name as catename',
                    'phc.categories_id',
                    'st.title as seName',
                    'ptag.tag',
                    'op.optional_model'
                )
                ->distinct();

            // Paginate results (e.g., 50 per page)
            $products = $query->paginate($limit);

            return $products;
        }

        public function searchAll($keySearchQuery) {
            $keysearch = $this->validateInput($keySearchQuery, 'text', true);
            $keypro = str_replace("@", "/", $keysearch);
            $lang = App::getLocale();
            $limit_product = 100;
            $limit_other = 50;

            // Split search term into parts (handles both spaces and dashes)
            $keyParts = preg_split('/[\s-]+/', $keypro);
            $checkArr = [];
            $key2 = isset($keyParts[1]) ? $keyParts[1] : '';
            $cleanQueryString = str_replace(['-', '/', ' '], '', $keypro);


            $query = DB::table('products as p')
                    ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
                    ->join('sub_pro_categories as sp', 'sp.sub_pro_id', '=', 'phc.categories_id')
                    ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'phc.categories_id')
                    ->join('series_translations as st', 'st.series_id', '=', 'p.series_id')
                    ->leftJoin('product_tags as ptag', 'ptag.product_id', '=', 'p.pro_id')
                    ->leftJoin('product_optional_model as op', 'op.product_id', '=', 'p.pro_id')
                    ->where('spt.local', $lang)
                    ->where('st.local', $lang)
                    ->where('p.enable_pro', 1)
                    ->where(function ($q) use ($keypro, $keyParts ,$key2 ,$cleanQueryString) {
                        $q->orWhere(DB::raw("REPLACE(REPLACE(REPLACE(p.pro_code, '-', ''), '/', ''),' ','')"), 'LIKE', '%' . $cleanQueryString . '%')
                        ->orWhere(DB::raw("REPLACE(REPLACE(REPLACE(st.title, '-', ''), '/', ''),' ','')"), 'LIKE', '%' . $cleanQueryString . '%')
                        ->orWhere(DB::raw("REPLACE(REPLACE(REPLACE(ptag.tag, '-', ''), '/', ''),' ','')"), 'LIKE', '%' . $cleanQueryString . '%')
                        ->orWhere(DB::raw("REPLACE(REPLACE(REPLACE(op.optional_model, '-', ''), '/', ''),' ','')"), 'LIKE', '%' . $cleanQueryString . '%');
                        // ->orWhere('ptag.tag', 'LIKE', '%' . $keypro . '%')
                        // ->orWhere('op.optional_model', 'LIKE', '%' . $keypro . '%');
                        // foreach ($keyParts as $part) {
                        //     $q->orWhere('p.pro_code', 'LIKE', $part . '%')
                        //     ->orWhere('p.pro_code', 'LIKE', '%' . $part . '%')
                        //     ->orWhere('st.title', 'LIKE', $part . '%')
                        //     ->orWhere('ptag.tag', 'LIKE', $part . '%')
                        //     ->orWhere('op.optional_model', 'LIKE', $part . '%');
                        // }
                    })
                    ->select(
                        'p.pro_id',
                        'p.pro_code',
                        'p.picture',
                        'p.status_product',
                        'p.dimensionL',
                        'p.dimensionW',
                        'p.dimensionD',
                        DB::raw('MAX(sp.url_item) as url_item'),
                        DB::raw('MAX(spt.name) as catename'),
                        DB::raw('MAX(phc.categories_id) as categories_id'),
                        DB::raw('MAX(st.title) as seName'),
                        DB::raw('GROUP_CONCAT(DISTINCT ptag.tag) as tags'),
                        DB::raw('GROUP_CONCAT(DISTINCT op.optional_model) as optional_models')
                    )
                    ->groupBy(
                        'p.pro_id',
                        'p.pro_code',
                        'p.picture',
                        'p.status_product',
                        'p.dimensionL',
                        'p.dimensionW',
                        'p.dimensionD'
                    )
                    ->orderByRaw("
                        CASE
                            WHEN REPLACE(REPLACE(REPLACE(p.pro_code, '-', ''), '/', ''),' ','') LIKE ? THEN 1
                            ELSE 2
                        END",
                        ['%'.$cleanQueryString.'%']
                    )
                    ->limit($limit_product);

            $products =  $query->get();
           // Fetch additional product properties in bulk
            $productIds = $products->pluck('pro_id')->toArray();
            $properties = DB::table('product_has_property as ph')
                ->join('product_has_property_translation as pht', 'ph.per_id', '=', 'pht.per_fk_id')
                ->join('product_field as pf', 'pf.id', '=', 'ph.type_id')
                ->join('product_field_translation as pft', 'ph.type_id', '=', 'pft.product_field_id')
                ->whereIn('ph.product_id', $productIds)
                ->where('pht.local', 'en')
                ->where('pft.local', $lang)
                ->whereIn('ph.type_id', [4, 3, 8, 31])
                ->orderBy('ph.type_id', 'asc')
                ->select('pht.value_text', 'ph.*', 'pft.field_name as fieldCate', 'pf.unit_name')
                ->get()
                ->groupBy('product_id');

            $tags = DB::table('product_tags as ptag')
                ->whereIn('ptag.product_id', $productIds)
                ->where('ptag.tag', '!=', ' ')
                ->select('ptag.*')
                ->get()
                ->groupBy('product_id');

            $optionalModels = DB::table('product_optional_model as op')
                ->whereIn('op.product_id', $productIds)
                ->select('op.*')
                ->get()
                ->groupBy('product_id');

            // Build the result set

            $pro_results = $products->map(function ($pro) use ($properties, $tags, $optionalModels) {
                if (!self::checkContentPro($pro->pro_id)) {
                    return null;
                }

                return [
                    'pro_id' => $pro->pro_id,
                    'tag_m' => $pro->tag ?? $pro->optional_model ?? '',
                    'url_item' => $pro->url_item,
                    'pro_code' => $pro->pro_code,
                    'catename' => $pro->catename,
                    'cateid' => $pro->categories_id,
                    'picture' => $pro->picture,
                    'status_product' => $pro->status_product,
                    'content' => $properties[$pro->pro_id] ?? collect([]),
                    'tags' => $tags[$pro->pro_id] ?? collect([]),
                    'optional_models' => $optionalModels[$pro->pro_id] ?? collect([]),
                    'dimensionL' => $pro->dimensionL,
                    'dimensionW' => $pro->dimensionW,
                    'dimensionD' => $pro->dimensionD,
                ];
            })->filter()->values();

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
            ->limit($limit_other)
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
                ->limit($limit_other)
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
                ->limit($limit_other)
                ->get();

                $faqs = DB::table('faq as f')
                ->join('faq_translations as ft', 'f.id', '=', 'ft.faq_id')
                ->where('ft.local', '=',  $lang)
                ->where('f.status', 1)
                ->where('ft.title', 'LIKE', '%'.$keysearch.'%')
                ->select('f.*' ,'ft.*')
                ->limit($limit_other)
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
                ->limit($limit_other)
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
                ->limit($limit_other)
                ->get();

                $continents_dis = DB::table('continents as c')
                ->join('continents_translations as ct', 'c.id', '=', 'ct.cont_id')
                ->where('type_id' ,2)
                ->where('ct.local', '=', $lang)
                ->select('c.*' ,'ct.*')
                ->limit($limit_other)
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
                ->limit($limit_other)
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
                ->limit($limit_other)
                ->get();

                $margetCate = DB::table('permission_marketcate as permar')
                ->join('marketing_resource_cate as mc', 'permar.market_cate_id', '=', 'mc.cate_id')
                ->join('marketing_resource_cate_translations as mct', 'mc.cate_id', '=', 'mct.mk_fk_id')
                ->where('mct.local', '=',  $lang)
                ->where('permar.permission_id', '=', 3)
                ->select('mc.*' ,'mct.*')
                ->limit($limit_other)
                ->get();

                $margeting = DB::table('marketing_resource as mr')
                ->join('marketing_resource_translations as mrt', 'mr.id', '=', 'mrt.mr_id')
                ->where('mrt.local', '=', $lang)
                ->whereIn('mr.cate_id',[1,2])
                ->where('mrt.name', 'LIKE', '%'.$keysearch.'%')
                ->select('mr.*' ,'mrt.*')
                ->limit($limit_other)
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
       public function downloadoldCatalogs($doc){
        return redirect()->route('index','catalogs');
       }
       public function checkOldfileUrl($doc){
        $path =  base_path('../upload/product_image/').$doc ;
        if (file_exists($path)) {
            return response()->file($path);
        } else {
            return redirect()->route('index','home');
        }

       }


       public function searchByTag($keySearchQuery)
       {
             $keysearch = $this->validateInput($keySearchQuery, 'text', true);
            $keypro = str_replace("@", "/", $keysearch);
            $lang = App::getLocale();
            $limit_product = 100;
            $limit_other = 50;

            // Split search term into parts (handles both spaces and dashes)
            $keyParts = preg_split('/[\s-]+/', $keypro);
            $checkArr = [];
            $cleanQueryString = str_replace(['-', '/', ' '], '', $keypro);

            $query = DB::table('products as p')
                    ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
                    ->join('sub_pro_categories as sp', 'sp.sub_pro_id', '=', 'phc.categories_id')
                    ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'phc.categories_id')
                    ->join('series_translations as st', 'st.series_id', '=', 'p.series_id')
                    ->leftJoin('product_tags as ptag', 'ptag.product_id', '=', 'p.pro_id')
                    ->leftJoin('product_optional_model as op', 'op.product_id', '=', 'p.pro_id')
                    ->where('spt.local', $lang)
                    ->where('st.local', $lang)
                    ->where('p.enable_pro', 1)
                    ->where(function ($q) use ($keypro, $keyParts,$cleanQueryString) {
                        $q->orWhere(DB::raw("REPLACE(REPLACE(REPLACE(p.pro_code, '-', ''), '/', ''),' ','')"), 'LIKE', '%' . $cleanQueryString . '%')
                        ->orWhere(DB::raw("REPLACE(REPLACE(REPLACE(st.title, '-', ''), '/', ''),' ','')"), 'LIKE', '%' . $cleanQueryString . '%')
                        ->orWhere(DB::raw("REPLACE(REPLACE(REPLACE(ptag.tag, '-', ''), '/', ''),' ','')"), 'LIKE', '%' . $cleanQueryString . '%')
                        ->orWhere(DB::raw("REPLACE(REPLACE(REPLACE(op.optional_model, '-', ''), '/', ''),' ','')"), 'LIKE', '%' . $cleanQueryString . '%');
                        // ->orWhere('ptag.tag', 'LIKE', '%' . $keypro . '%')
                        // ->orWhere('op.optional_model', 'LIKE', '%' . $keypro . '%');
                        // foreach ($keyParts as $part) {
                        //     $q->orWhere('p.pro_code', 'LIKE', $part . '%')
                        //     ->orWhere('p.pro_code', 'LIKE', '%' . $part . '%')
                        //     ->orWhere('st.title', 'LIKE', $part . '%')
                        //     ->orWhere('ptag.tag', 'LIKE', $part . '%')
                        //     ->orWhere('op.optional_model', 'LIKE', $part . '%');
                        // }
                    })
                    ->select(
                        'p.pro_id',
                        'p.pro_code',
                        'p.picture',
                        'p.status_product',
                        'p.dimensionL',
                        'p.dimensionW',
                        'p.dimensionD',
                        DB::raw('MAX(sp.url_item) as url_item'),
                        DB::raw('MAX(spt.name) as catename'),
                        DB::raw('MAX(phc.categories_id) as categories_id'),
                        DB::raw('MAX(st.title) as seName'),
                        DB::raw('GROUP_CONCAT(DISTINCT ptag.tag) as tag'),
                        DB::raw('GROUP_CONCAT(DISTINCT op.optional_model) as optional_model')
                    )
                    ->groupBy(
                        'p.pro_id',
                        'p.pro_code',
                        'p.picture',
                        'p.status_product',
                        'p.dimensionL',
                        'p.dimensionW',
                        'p.dimensionD'
                    )
                    ->orderByRaw("
                        CASE
                            WHEN REPLACE(REPLACE(REPLACE(GROUP_CONCAT(DISTINCT ptag.tag), '-', ''), '/', ''),' ','') LIKE ? THEN 1
                            ELSE 2
                        END",
                        ['%'.$cleanQueryString.'%']
                    )
                    ->limit($limit_product);

            $products =  $query->get();
           // Fetch additional product properties in bulk
            $productIds = $products->pluck('pro_id')->toArray();
            $properties = DB::table('product_has_property as ph')
                ->join('product_has_property_translation as pht', 'ph.per_id', '=', 'pht.per_fk_id')
                ->join('product_field as pf', 'pf.id', '=', 'ph.type_id')
                ->join('product_field_translation as pft', 'ph.type_id', '=', 'pft.product_field_id')
                ->whereIn('ph.product_id', $productIds)
                ->where('pht.local', 'en')
                ->where('pft.local', $lang)
                ->whereIn('ph.type_id', [4, 3, 8, 31])
                ->orderBy('ph.type_id', 'asc')
                ->select('pht.value_text', 'ph.*', 'pft.field_name as fieldCate', 'pf.unit_name')
                ->get()
                ->groupBy('product_id');

            $tags = DB::table('product_tags as ptag')
                ->whereIn('ptag.product_id', $productIds)
                ->where('ptag.tag', '!=', ' ')
                ->select('ptag.*')
                ->get()
                ->groupBy('product_id');

            $optionalModels = DB::table('product_optional_model as op')
                ->whereIn('op.product_id', $productIds)
                ->select('op.*')
                ->get()
                ->groupBy('product_id');

            // Build the result set

            $pro_results = $products->map(function ($pro) use ($properties, $tags, $optionalModels) {
                if (!self::checkContentPro($pro->pro_id)) {
                    return null;
                }

                return [
                    'pro_id' => $pro->pro_id,
                    'tag_m' => $pro->tag ?? $pro->optional_model ?? '',
                    'url_item' => $pro->url_item,
                    'pro_code' => $pro->pro_code,
                    'catename' => $pro->catename,
                    'cateid' => $pro->categories_id,
                    'picture' => $pro->picture,
                    'status_product' => $pro->status_product,
                    'content' => $properties[$pro->pro_id] ?? collect([]),
                    'tags' => $tags[$pro->pro_id] ?? collect([]),
                    'optional_models' => $optionalModels[$pro->pro_id] ?? collect([]),
                    'dimensionL' => $pro->dimensionL,
                    'dimensionW' => $pro->dimensionW,
                    'dimensionD' => $pro->dimensionD,
                ];
            })->filter()->values();

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
            ->limit($limit_other)
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
                ->limit($limit_other)
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
                ->limit($limit_other)
                ->get();

                $faqs = DB::table('faq as f')
                ->join('faq_translations as ft', 'f.id', '=', 'ft.faq_id')
                ->where('ft.local', '=',  $lang)
                ->where('f.status', 1)
                ->where('ft.title', 'LIKE', '%'.$keysearch.'%')
                ->select('f.*' ,'ft.*')
                ->limit($limit_other)
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
                ->limit($limit_other)
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
                ->limit($limit_other)
                ->get();

                $continents_dis = DB::table('continents as c')
                ->join('continents_translations as ct', 'c.id', '=', 'ct.cont_id')
                ->where('type_id' ,2)
                ->where('ct.local', '=', $lang)
                ->select('c.*' ,'ct.*')
                ->limit($limit_other)
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
                ->limit($limit_other)
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
                ->limit($limit_other)
                ->get();

                $margetCate = DB::table('permission_marketcate as permar')
                ->join('marketing_resource_cate as mc', 'permar.market_cate_id', '=', 'mc.cate_id')
                ->join('marketing_resource_cate_translations as mct', 'mc.cate_id', '=', 'mct.mk_fk_id')
                ->where('mct.local', '=',  $lang)
                ->where('permar.permission_id', '=', 3)
                ->select('mc.*' ,'mct.*')
                ->limit($limit_other)
                ->get();

                $margeting = DB::table('marketing_resource as mr')
                ->join('marketing_resource_translations as mrt', 'mr.id', '=', 'mrt.mr_id')
                ->where('mrt.local', '=', $lang)
                ->whereIn('mr.cate_id',[1,2])
                ->where('mrt.name', 'LIKE', '%'.$keysearch.'%')
                ->select('mr.*' ,'mrt.*')
                ->limit($limit_other)
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
            $name = $this->validateInput($request->name,'text',true);
            $country = $this->validateInput($request->country,'text',true);
            $client = new Client();
            $response = $client->post(
                'https://www.recaptcha.net/recaptcha/api/siteverify',
                ['form_params'=>
                    [
                        'secret'=> config('app.recapcha_secret_key'),
                        'response'=>$request->keyrecap
                    ]
                ]
            );

            $body = json_decode((string)$response->getBody());
            // return dd($body);
            if($body->success){
                $mailchimdata =  Mailchimp::getLists();
                $checkmailC = Mailchimp::check($mailchimdata[0]['id'], trim($strmlo));
                $checkmailsta  =  Mailchimp::status($mailchimdata[0]['id'],trim($strmlo));
                $alreadysub =  DB::table('subscribes')->where('email',trim($strmlo))->get();
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

            }else{
                return redirect()->back()->with('subscribes_already', 'Please Verify I"m not a robot');
            }






       }
      private function normalizeCountry($country) {
    $validCountries = [
        "Aaland Islands", "Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra",
        "Angola", "Anguilla", "Antarctica", "Antigua And Barbuda", "Argentina", "Armenia", "Aruba",
        "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados",
        "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bonaire, Saint Eustatius and Saba",
        "Bosnia and Herzegovina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory",
        "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada",
        "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island",
        "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Cook Islands", "Costa Rica", "Cote D'Ivoire",
        "Croatia", "Cuba", "Curacao", "Cyprus", "Czech Republic", "Democratic Republic of the Congo", "Denmark",
        "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea",
        "Eritrea", "Estonia", "Ethiopia", "Falkland Islands", "Faroe Islands", "Fiji", "Finland", "France",
        "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany",
        "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guernsey",
        "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Honduras", "Hong Kong",
        "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Isle of Man", "Israel", "Italy",
        "Jamaica", "Japan", "Jersey (Channel Islands)", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Kuwait",
        "Kyrgyzstan", "Lao People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya",
        "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia", "Madagascar", "Malawi", "Malaysia", "Maldives",
        "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia",
        "Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montenegro", "Montserrat", "Morocco",
        "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia",
        "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "North Korea", "Northern Mariana Islands",
        "Norway", "Oman", "Pakistan", "Palau", "Palestine", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines",
        "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Republic of Kosovo", "Reunion", "Romania", "Russia",
        "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Martin", "Saint Vincent and the Grenadines",
        "Samoa (Independent)", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles",
        "Sierra Leone", "Singapore", "Sint Maarten", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa",
        "South Georgia and the South Sandwich Islands", "South Korea", "South Sudan", "Spain", "Sri Lanka", "St. Helena",
        "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland",
        "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Timor-Leste", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago",
        "Tunisia", "Turkey", "Turkmenistan", "Turks & Caicos Islands", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine",
        "United Arab Emirates", "United Kingdom", "United States of America", "Uruguay", "USA Minor Outlying Islands", "Uzbekistan",
        "Vanuatu", "Vatican City State (Holy See)", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)",
        "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Zambia", "Zimbabwe"
    ];

    // Convert input to a standardized format (trim, lowercase)
    $country = trim(strtolower($country));

    // Pre-process valid countries list to lowercase for faster matching
    $validCountries = array_map('strtolower', $validCountries);

    // Check if the country exists in the list
    $index = array_search($country, $validCountries);

    // Return the matched country with correct casing if found
    if ($index !== false) {
        return $validCountries[$index]; // The country with correct formatting
    }

    return 'Other'; // Or 'Other' if needed
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
            $country = $this->normalizeCountry($request->country);
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
                Mailchimp::subscribe($mailchimdata[0]['id'], trim($strmlo),['NAME' => $request->name, 'COUNTRY' => $country] ,true);
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
                    $expiry = now()->addMinutes(120);
                    session(['partner_id' => $member_id]);
                    session(['partner_firstname' => $member_firstname]);
                    session(['partner_lastname' => $member_lastname]);
                    session(['partner_phone' => $member_phone]);
                    session(['partner_role' => $member_role]);
                    session(['partner_email' => $member_email]);
                    session(['expiry_partner' => $expiry]);

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
               $image->move(base_path('/../uploads_delta/partner/marketing_resources'),$imgName);
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
        $file_pointer = base_path('/../uploads_delta/partner/marketing_resources/').$data[0]->image;
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
                $file_pointer = base_path('/../uploads_delta/partner/marketing_resources/').$item->image;
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
                     'secret'=> config('app.recapcha_secret_key'),
                    'response'=>$request->keyrecap
                 ]
            ]
        );

        $body = json_decode((string)$response->getBody());

        $validate = Validator::make($request->all(), [
            'subject' => ['required'],
            'type_id' => ['required'],
            // 'model_name' => ['required'],
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
            $subject = 'Sales Inquiry';
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
             //$emaillog = Mail::to('chai@degitobangkok.com')->send(new Contact($request->except('_token'),$ticket_id));
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
       public function LinktoEnquiryRedirect($type ,$type_name ,$pro_code){
            return redirect()->route('LinktoEnquiry',[ 'type_id'=> $type ,'type_name' => $type_name ,'pro_code'=>$pro_code ] );
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
                    // 'secret'=> '6LdshPcUAAAAACaoDOvGo7ncKgVazbyKoDlPi43T',
                    // 'secret'=> '6LeFKfYUAAAAABtTFzPon_8pinsPsevCSFyePD8k',
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



          try {
            $email = Mail::to($emailsend)->send(new DowloadGui($request->except('_token')));
             return \Redirect::back()->with("messageGUI", $filename);
           } catch (\Exception $e) {
             return \Redirect::back()->with("errorSendMail", "ErorSendMail");
           }
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
        $pro_new = self::removeDuplicates($products ,'pro_code');
        return response()->json([
            'results' =>$pro_new,
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
        $lang = App::getLocale();
          $metatag = DB::table('meta_tag_page as mtp')
                ->join('meta_tag_page_translations as mtpt', 'mtp.id', '=', 'mtpt.meta_id')
                ->where('mtp.id',27)
                ->where('mtpt.local',  $lang)
                ->select('mtp.*' ,'mtpt.*')
                ->get();
           $sectionpin = session('pin');
           $user = DB::table('partner')->where('pin',$pin)->get();
           if(isset($user)){
                  return view('front-end.resetPassword')->with('metatag',$metatag);
           }else{
            return redirect()->route('index','login');
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
        $query->where(\DB::raw("REPLACE(REPLACE(REPLACE(p.pro_code, '-', ''), '/', ''),' ','')"), '=', $queryString);
        $documents = $query->get();

        return $documents;
       }
       public function downloadFIle($typefilePar,$modelPar){

        $typefile = $this->validateInput($typefilePar,'text',true);
        $chmodel = $this->validateInput($modelPar,'text',true);

        $strmodel =  str_replace("@", "/", trim($chmodel));
        $partnerId = session('partner_id');
        if($typefile == 'Test_Report' && !isset($partnerId)){
            return redirect()->route('index', 'login');
        }

        $check_2 = self::checkHaveModelOptional($strmodel);
        if(isset($check_2)){
            $strmodel = $check_2->pro_code;
        }

        $_model =  self::checkHaveModel($strmodel);
        $documents = self::getDoc($typefile,$strmodel);



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
            }else if($pathinfo['extension'] == 'zip'){
                  return response()->download($path);
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

                if(isset($_model)){
                    return redirect()->route('productsDetailsByType',['cateid' => $_model->url_item , 'pro_code'=>  str_replace("/", "@", trim($_model->pro_code))] );
                }else{
                    return redirect()->route('index','home');
                }
                // return redirect()->route('index','home');
            }
       }
       private function checkHaveModel($strmodel){

            $stringModel =  str_replace("-", "", $strmodel);
            $queryStringModel = preg_replace('/[^A-Za-z0-9\-]/','',$stringModel);
            $queryModel = DB::table('products as p')
            ->join('product_has_categories as phc', 'phc.product_id', '=', 'p.pro_id')
            ->join('sub_pro_categories as sp', 'sp.sub_pro_id', '=', 'phc.categories_id')
            ->select('p.*','phc.categories_id' ,'sp.url_item')
            ->where('p.enable_pro',1);
            // $queryModel->where(\DB::raw("REPLACE(REPLACE(REPLACE(p.pro_code, '-', ''), '/', ''),' ','')"), 'LIKE', '%' . $queryStringModel . '%');
            $queryModel->where(\DB::raw("REPLACE(REPLACE(REPLACE(p.pro_code, '-', ''), '/', ''),' ','')"), '=', $queryStringModel);
            $_model = $queryModel->first();
            // return dd($strmodel, "hello world", $_model);
          return $_model;
       }
       private function checkHaveModelOptional($strmodel){
            $stringModel =  str_replace("-", "", $strmodel);
            $queryStringModel = preg_replace('/[^A-Za-z0-9\-]/','',$stringModel);
            $queryModelOP = DB::table('product_optional_model as po')
            ->join('products as p', 'p.pro_id', '=', 'po.product_id')
            ->select('p.pro_code','po.optional_model');
            // $queryModelOP->where(\DB::raw("REPLACE(REPLACE(REPLACE(po.optional_model, '-', ''), '/', ''),' ','')"), 'LIKE', '%' . $queryStringModel . '%');
            $queryModelOP->where(\DB::raw("REPLACE(REPLACE(REPLACE(po.optional_model, '-', ''), '/', ''),' ','')"), '=', $queryStringModel);
            $_modelOptional = $queryModelOP->first();

          return $_modelOptional;
       }
       public function downloadFIleManual($lang,$typefilePar,$modelPar){

        $typefile = $this->validateInput($typefilePar,'text',true);
        $chmodel = $this->validateInput($modelPar,'text',true);
        $strmodel =  str_replace("@", "/", trim($chmodel));
        $stringM =  str_replace("-", "", $strmodel);
        $check_2 = self::checkHaveModelOptional($stringM);
        if(isset($check_2)){
            $stringM = $check_2->pro_code;
        }
        $_model =  self::checkHaveModel($stringM);
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
        $query->where(\DB::raw("REPLACE(REPLACE(REPLACE(p.pro_code, '-', ''), '/', ''),' ','')"),'=', $queryString);
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
          }else if($pathinfo['extension'] == 'zip'){
            return response()->download($path);
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
               if(isset($_model)){
                    return redirect()->route('productsDetailsByType',['cateid' => $_model->categories_id , 'pro_code'=>  str_replace("/", "@", trim($_model->pro_code))] );
                }else{
                    return redirect()->route('index','home');
                }
            //   return redirect()->route('index','home');

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

    function similarity($str1, $str2){
        similar_text($str1, $str2, $percent);
        return $percent;
    }

    public function loginDocPartner($doc){
       $metatag = DB::table('meta_tag_page as mtp')
                ->join('meta_tag_page_translations as mtpt', 'mtp.id', '=', 'mtpt.meta_id')
                ->where('mtp.id',26)
                ->where('mtpt.local',  $lang)
                ->select('mtp.*' ,'mtpt.*')
                ->get();
        return  view('front-end.login-doc-partner')
        ->with('doc' ,$doc)
        ->with('metatag' ,$metatag);
    }


      public function checkPermission($doc)
      {
        $partnerId = session('partner_id');
        $lang = App::getLocale();
        $endUserDoc = null;
        $path = base_path('../uploads_delta/partner/marketing_resources/') . $doc;
        $query = DB::table('marketing_resource as mr')
            ->join('marketing_resource_translations as mrt', 'mr.id', '=', 'mrt.mr_id')
            ->join('marketing_resource_cate as mc', 'mc.cate_id', '=', 'mr.cate_id')
            ->join('permission_marketcate as permar', 'permar.market_cate_id', '=', 'mc.cate_id')
            ->where('mrt.local', $lang)
            ->where('mrt.file', $doc);
        $endUserDoc = (clone $query)->where('permar.permission_id', 3)->select('mr.*')->first();

        if (isset($endUserDoc)) {
            return response()->file($path);
        }else if(!isset($partnerId)){
            return redirect()->route('index', 'login');
        }


        $partner = DB::table('partner')->where('id', $partnerId)->where('status', 1)->first();

        if (!$partner) {
            return redirect()->route('marketingResourcesDownloads');
        }

        $salesKit = null;
        $fpsDoc = null;
        $distributorDoc = null;


        if ($partner->role == 2) {
            $salesKit = DB::table('partner_documents as s')
                ->join('partner_documents_translations as st', 's.id', '=', 'st.sk_fk_id')
                ->where('st.local', $lang)
                ->where('st.file', $doc)
                ->select('st.*')
                ->first();
        }



        if ($partner->role == 2) {
            $fpsDoc = (clone $query)->whereIn('permar.permission_id', [2])->select('mr.*', 'mrt.*')->first();
            $distributorDoc = (clone $query)->whereIn('permar.permission_id', [2])->select('mr.*', 'mrt.*')->first();
        }else if($partner->role == 1){
            $fpsDoc = (clone $query)->whereIn('permar.permission_id', [1])->select('mr.*', 'mrt.*')->first();
            $distributorDoc = (clone $query)->whereIn('permar.permission_id', [1])->select('mr.*', 'mrt.*')->first();
        }


        if ($fpsDoc || $distributorDoc || $endUserDoc) {
            return response()->file($path);
        }

        if ($salesKit && file_exists($path)) {
            ob_end_clean();
            return response()->file($path);
        }

        return redirect()->route($salesKit ? 'saleKit' : 'marketingResourcesDownloads');
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
                    $path =  base_path('../uploads_delta/partner/marketing_resources/').$doc;
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
                                    return response()->download($path);
                                    }else{
                                        return redirect()->route('index','partners');
                                    }
                            }else if($margeting){
                                if(file_exists($path)){
                                    return response()->download($path);
                                    }else{
                                        return redirect()->route('index','partners');
                                }

                            }else if($margeting_public){
                                if(file_exists($path)){
                                    return response()->download($path);
                                    }else{
                                        return redirect()->route('index','partners');
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
        public function partnerLoginDocSuccess(Request $request)
         {
            $doc = $this->validateInput($request->doc, 'text', true);
            $sectionId = $request->section_id;
            $lang = App::getLocale();

            if (!$sectionId) {
                return redirect()->route('index', 'login');
            }

            $path = base_path('../uploads_delta/partner/marketing_resources/') . $doc;
            $partner = DB::table('partner')->where('id', $sectionId)->where('status', 1)->first();

            if (!$partner) {
                return redirect()->route('marketingResourcesDownloads');
            }

            $salesKit = null;
            $fpsDoc = null;
            $distributorDoc = null;
            $endUserDoc = null;

            if ($partner->role == 2) {
                $salesKit = DB::table('partner_documents as s')
                    ->join('partner_documents_translations as st', 's.id', '=', 'st.sk_fk_id')
                    ->where('st.local', $lang)
                    ->where('st.file', $doc)
                    ->select('st.*')
                    ->first();
            }

            $query = DB::table('marketing_resource as mr')
                ->join('marketing_resource_translations as mrt', 'mr.id', '=', 'mrt.mr_id')
                ->join('marketing_resource_cate as mc', 'mc.cate_id', '=', 'mr.cate_id')
                ->join('permission_marketcate as permar', 'permar.market_cate_id', '=', 'mc.cate_id')
                ->where('mrt.local', $lang)
                ->where('mrt.file', $doc);

            if ($partner->role == 2) {
                $fpsDoc = (clone $query)->whereIn('permar.permission_id', [2])->select('mr.*', 'mrt.*')->first();
                $distributorDoc = (clone $query)->whereIn('permar.permission_id', [2])->select('mr.*', 'mrt.*')->first();
            }else if($partner->role == 1){
                $fpsDoc = (clone $query)->whereIn('permar.permission_id', [1])->select('mr.*', 'mrt.*')->first();
                $distributorDoc = (clone $query)->whereIn('permar.permission_id', [1])->select('mr.*', 'mrt.*')->first();
            }

            $endUserDoc = (clone $query)->where('permar.permission_id', 3)->select('mr.*')->first();

            if (($fpsDoc || $distributorDoc || $endUserDoc || $salesKit) && file_exists($path)) {
                ob_end_clean();
                return response()->file($path);
            }

            return redirect()->route($salesKit ? 'index' : 'marketingResourcesDownloads', $salesKit ? 'partners' : '');
         }

        public function productCate($cate){
            return redirect()->route('productFinder' );
        }




        public function searchDocByModelId(Request $request){
        $model_id = $request->model_id;
        $lang = App::getLocale();
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
                ->where('p.pro_id' ,$model_id)
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

                return response()->json([
                    'doc' =>$documents,
                    'cate_doc' =>$documents_cate
                ], 200);

       }

       public function searchDocManualByModelId(Request $request){

        $model_id = $request->model_id;
        $lang = App::getLocale();
        $language = DB::table('language as lang')->whereIn('lang.name',['en','cn','jp'])->get();
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


                $documents = DB::table('product_has_documents as phd')
                ->join('products as p','p.pro_id','=','phd.product_id')
                ->join('product_ducuments as pd','phd.document_id','=','pd.doc_id')
                ->join('product_ducument_translations as pdt','pdt.doc_fk_id','=','pd.doc_id')
                ->join('products_documents_categories as pdc','pdc.id','=','pd.cate_id')
                ->whereNotIn('pdc.id', [6 ,7,4])
                ->where('pdt.file','!=','')
                ->where('pdt.file','!=',null)
                ->whereIn('pdt.local', $showlang)
                ->where('p.pro_id' ,$model_id)
                ->select('p.pro_code','pd.doc_id','pdc.slug' ,'phd.product_id','pdt.name','pdc.title as catename','pd.created_at' ,'pdc.main_cate_id','pdt.file' ,'pd.cate_id','pdt.local')
                ->get();

                $documents_cate = DB::table('products_documents_categories as pdc')
                ->join('pro_ducuments_cate_translations as pdct','pdct.doc_cate_id','=','pdc.id')
                ->where('pdct.local','=', $lang)
                ->whereNotIn('pdc.id', [6 ,7,4])
                ->select('pdc.*','pdct.lable')
                ->orderBy('pdc.title','asc')
                ->get();

                return response()->json([
                    'doc' =>$documents,
                    'cate_doc' =>$documents_cate
                ], 200);

       }

       public function searchLoginDocByModelId(Request $request){
        $model_id = $request->model_id;
        $lang = App::getLocale();
        $documents = DB::table('product_has_documents as phd')
            ->join('products as p','p.pro_id','=','phd.product_id')
            ->join('product_ducuments as pd','phd.document_id','=','pd.doc_id')
            ->join('product_ducument_translations as pdt','pdt.doc_fk_id','=','pd.doc_id')
            ->join('products_documents_categories as pdc','pdc.id','=','pd.cate_id')
            ->where('pdt.local',$lang)
            ->where('pdt.file','!=' ,'')
            ->where('pdt.file','!=' ,null)
            ->where('p.pro_id',$model_id)
            ->select('p.pro_code','pd.doc_id','phd.product_id','pdt.name','pdc.title as catename','pdc.slug','pd.created_at' ,'pdc.main_cate_id','pdt.file' ,'pd.cate_id')
            ->orderBy('pdc.title','asc')
            ->get();

            $documents_cate = DB::table('products_documents_categories as pdc')
            ->join('pro_ducuments_cate_translations as pdct','pdct.doc_cate_id','=','pdc.id')
            ->where('pdct.local','=', $lang)
            ->select('pdc.*','pdct.lable')
            ->orderBy('pdc.title','asc')
            ->get();

                return response()->json([
                    'doc' =>$documents,
                    'cate_doc' =>$documents_cate
                ], 200);

       }

}
