<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Excel as ExcelFormat;
use Maatwebsite\Excel\Concerns\WithMapping;
use File;
class EmailController extends Controller
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
    public function index($type)
    {
            // return dd($type);
       if($type == 1){
        $emails = DB::table('email_notification as et')
        ->where('et.type','=',$type)
        ->select('et.*')
        ->get();
       }else if($type == 2){
        $emails = DB::table('email_notification as et')
        ->where('et.type', '=',$type)
        ->select('et.*')
        ->get();
       }else if($type == 3){
        $emails = DB::table('email_notification as et')
        ->join('sub_pro_categories_translation as spct' ,'spct.sub_pro_id' ,'=','product_type')
        ->where('et.type', '=',$type)
        ->where('spct.local', '=','en')
        ->select('et.*','spct.name as catename')
        ->get();
       }

        return view('feedbackEmail.index')
        ->with('name','feedbackEmail')
        ->with('menu','')
        ->with('type',$type)
        ->with('emails',$emails);
    }

    public function create($type)
    {

        $subCategories = DB::table('sub_pro_categories as sp')
        ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'sp.sub_pro_id')
        ->where('spt.local', '=', 'en')
        ->select('sp.*', 'spt.*')
        ->orderBy('sp.created_at', 'desc')
        ->get();

        return view('feedbackEmail.create')
        ->with('name','feedbackEmail')
        ->with('menu','')
        ->with('subCategories',$subCategories)
        ->with('type',$type);
    }
    public function editEmail($type ,$id){

        $subCategories = DB::table('sub_pro_categories as sp')
        ->join('sub_pro_categories_translation as spt', 'spt.sub_pro_id', '=', 'sp.sub_pro_id')
        ->where('spt.local', '=', 'en')
        ->select('sp.*', 'spt.*')
        ->orderBy('sp.created_at', 'desc')
        ->get();

        $data = DB::table('email_notification as et')
        ->where('et.id', '=',$id)
        ->select('et.*')
        ->get();

        // return dd($data);

        return view('feedbackEmail.edit')
        ->with('name','feedbackEmail')
        ->with('menu','')
        ->with('subCategories',$subCategories)
        ->with('type',$type)
        ->with('data',$data);

    }

    public function storeEmail(Request $requst){
        $type = $requst->type;

        DB::table('email_notification')->insert(
            [
                "country" =>$requst->country,
                "type" => $requst->type,
                "email" => $requst->email,
                "email_gui" => $requst->email_gui,
                "product_type" => $requst->pro_categories,
                "subject" => $requst->subject,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]
        );
        return redirect()->route('emailnotification',$type)->with('flash_message', 'Create Data successfully');
    }
    public function UpdateEmail(Request $requst){
        $type = $requst->type;
        $old_id = $requst->old_id;
        DB::table('email_notification')->where('id',$old_id)->update(
            [
                "country" =>$requst->country,
                "type" => $requst->type,
                "email" => $requst->email,
                "email_gui" => $requst->email_gui,
                "product_type" => $requst->pro_categories,
                "subject" => $requst->subject,
                "updated_at" => \Carbon\Carbon::now(),
            ]
        );
        return redirect()->route('emailnotification',$type)->with('flash_message', 'Update Data successfully');
    }
    public function deleteEmailNotification(Request $requst){
        $itemId = $requst->itemId;
        $type = $requst->type;
        DB::table('email_notification')->where('id',$itemId)->delete();
        return redirect()->route('emailnotification',$type)->with('flash_message', 'Delete Data successfully');
    }

    public function getEmailNotificationList(){
        return view('feedbackEmail.importEmailNotifi')
        ->with('name','feedbackEmail')
        ->with('menu','');
    }

    public function importEmailNotification(Request $request){

        if ($request->hasFile('file')) {

          $extension = File::extension($request->file->getClientOriginalName());
          if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
              $path = $request->file->getRealPath();
              $data = Excel::load($path, function ($reader) {})->get();
          }
            //   return dd($data);
             if(!empty($data) && $data->count()) {
              foreach ($data as $key => $value) {

                DB::table('email_notification')->insert(
                    [
                        "country" =>$value->country,
                        "type" => 1,
                        "email" => $value->email_feedback_form,
                        "email_gui" => $value->email_gui_software_download,
                        "created_at" => \Carbon\Carbon::now(),
                        "updated_at" => \Carbon\Carbon::now(),
                    ]
                );

              }
          }
          return redirect()->route('emailnotification',1)->with('flash_message', 'create data Successfully');
        }
        return redirect()->route('emailnotification',1)->with('error_message', 'No file');

      }

      public function gui_dowload_index(Request $request){
        $data = DB::table('gui_downloads_email as gu')
        ->select('gu.*')
        ->get();
         return view('gui.gui')
         ->with('guis',$data)
         ->with('name','gui_dowload')
         ->with('menu','');
      }
      public function exportGui()
        {
            $data = DB::table('gui_downloads_email as gu')
                ->select('gu.*')
                ->get();

            // Check if we have data
            if ($data->isEmpty()) {
                return redirect()->route('gui_dowload_index')
                                ->with('flash_message', 'No Data');
            }

            // Create export data array
            $exportData = [];

            // Add headers
            $exportData[] = [
                'No',
                'Subject',
                'Name',
                'Email',
                'Country Name',
                'State',
                'Company',
                'Product Type',
                'Model',
                'Phone',
                'Accept Privacy Policy',
                'Created_at'
            ];

            // Add data rows
            $counter = 1;
            foreach ($data as $sub) {
                $accept = $sub->accept == 1 ? 'Accepted' : 'Not accept';

                $exportData[] = [
                    $counter++,
                    'GUI Software Download',
                    $sub->name,
                    $sub->email,
                    $sub->country,
                    '', // Empty state as in original
                    $sub->company,
                    $sub->type_name,
                    $sub->model,
                    $sub->tel,
                    $accept,
                    $sub->created_at
                ];
            }

            // Create a simple export from array
        return Excel::download(
        new class($exportData) implements FromCollection {
        private $data;

        public function __construct($data) {
            $this->data = collect($data);
        }

        public function collection() {
            return $this->data;
        }

            // ✅ Add CSV encoding configuration
            public function getCsvSettings(): array
                    {
                        return [
                            'use_bom' => true,
                             'encoding' => 'UTF-16LE',
                            'delimiter' => ',',
                        ];
                    }
                },
                'GUI_Downloads.csv',
                ExcelFormat::CSV,
                [
                    'use_bom' => true,  // Important for Excel
                     'encoding' => 'UTF-16LE',
                ]
            );
        }
      public function feedbackform($type){
        if($type == 'All'){
            $contactemail = DB::table('contacts as c')
            ->select('c.*')
            ->orderBy('c.created_at','desc')
            ->get();
        }else{
            $contactemail = DB::table('contacts as c')
            ->where('c.subject',$type)
            ->select('c.*')
            ->orderBy('c.created_at','desc')
            ->get();
        }
    //      $enml = [
    //          'claire@degitobangkok.com',
    //          'supnooka@1111111',
    //          'supanee.nk@gmail.com',
    //          'supnooka@deltaww.com',
    //          'chai@degitobangkok.com',
    //          'kpp-itim.almighty@hotmail.com',
    //          'kul@degitobangkok.com',
    //      ];
    //     $deData = DB::table('contacts as c')
    //     ->select('c.*')
    //     ->whereIn('c.email',$enml)
    //     ->orderBy('c.created_at','desc')
    //     ->get();
    //    foreach($deData as $data){
    //     DB::table('contacts')->where('id',$data->id)->delete();
    //    }

        return view('feedbackEmail.contactFeebackform')
        ->with('contactemail',$contactemail)
        ->with('selecValue',$type)
        ->with('name','feedbackform')
        ->with('menu','');


      }

      public function exportfeedbackFrom($type)
        {
            // Build the query
            $query = DB::table('contacts as c')->select('c.*');

            if ($type !== 'All') {
                $query->where('c.subject', $type);
            }

            $contactemail = $query->orderBy('c.created_at', 'desc')->get();

            // Check if we have data
            if ($contactemail->isEmpty()) {
                return redirect()->route('feedbackform', $type)
                                ->with('flash_message', 'No Data');
            }

            $url = config('app.url') . '/config_history/';

            // Create export data array
            $exportData = [];

            // Add headers
            $exportData[] = [
                'No',
                'Subject',
                'Ticket No',
                'Name',
                'Email',
                'Country',
                'Company',
                'State',
                'Product Type',
                'Model',
                'Tel',
                'Accept Signup News',
                'Message',
                'Config file',
                'Created_at'
            ];

            // Add data rows
            $counter = 1;
            foreach ($contactemail as $sub) {
                $accept = $sub->accept_signup_news == 1 ? 'Accepted' : 'Not accept';
                $configFile = isset($sub->file) ? $url . $sub->file : 'No file';

                $exportData[] = [
                    $counter++,
                    $sub->subject,
                    $sub->ticket_id,
                    $sub->name,
                    $sub->email,
                    $sub->country,
                    $sub->company,
                    $sub->state,
                    $sub->type_name,
                    $sub->model_name,
                    $sub->tel,
                    $accept,
                    $sub->message,
                    $configFile,
                    $sub->created_at
                ];
            }

            // Create a simple export from array
           return Excel::download(
              new class($exportData) implements FromCollection {
                private $data;

                public function __construct($data) {
                    $this->data = collect($data);
                }

                public function collection() {
                    return $this->data;
                }

               //Add CSV encoding configuration
                public function getCsvSettings(): array
                {
                    return [
                        'use_bom' => true,
                         'encoding' => 'UTF-16LE',
                        'delimiter' => ',',
                    ];
                }
                },
                'FeedBackForm.csv',
                ExcelFormat::CSV,
                [
                    'use_bom' => true,  // Important for Excel
                     'encoding' => 'UTF-16LE',
                ]
             );
        }

}
    ?>
