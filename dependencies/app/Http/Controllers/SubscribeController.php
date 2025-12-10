<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use File;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Excel as ExcelFormat;

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
        ->paginate(15);

        return view('subscribes.index')
        ->with('name','subscribe')
        ->with('menu','')
        ->with('subscribes',$subscribes);
    }
    private function cleanData(){
        $subscribes = DB::table('subscribes as s')
        ->select('s.*')
        ->get();

        foreach ($subscribes as $sub) {

            if (!filter_var($sub->email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
                DB::table('subscribes')->where('id',$sub->id)->delete();
            }

        }


    }
   public function exportSubscribes()
    {
        $subscribes = DB::table('subscribes')
            ->select('*')
            ->get();

        if ($subscribes->isEmpty()) {
            return redirect()->route('subscribers_index')
                ->with('flash_message', 'No Data');
        }

        // Transform data for export
        $exportData = $subscribes->map(function ($subscribe, $index) {
            return [
                'no' => $index + 1,
                'email' => $subscribe->email,
                'country_name' => $subscribe->country_name,
                'name' => $subscribe->name,
                'accept_privacy' => $subscribe->accept == 1 ? 'Accepted' : 'Not accepted',
                'created_at' => $subscribe->created_at
            ];
        })->toArray();

        return Excel::download(
            new class($exportData) implements FromArray, WithHeadings {
                private $data;

                public function __construct(array $data)
                {
                    $this->data = $data;
                }

                public function array(): array
                {
                    return $this->data;
                }
                 public function getCsvSettings(): array
                {
                    return [
                        'use_bom' => true,
                         'encoding' => 'UTF-16LE',
                        'delimiter' => ',',
                    ];
                }

                public function headings(): array
                {
                    return [
                        'No',
                        'Email',
                        'Country Name',
                        'Name',
                        'Accept Privacy Policy',
                        'Created At'
                    ];
                }
            },
            'subscribes.csv',
             ExcelFormat::CSV,
            [
                'use_bom' => true,  // must have for Excel in Windows
                 'encoding' => 'UTF-16LE',
            ]
        );
    }

}

?>
