<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Excel as ExcelFormat;

class SaleskitRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $records = DB::table('landing_saleskit_requests')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('saleskit-requests.index')
            ->with('name', 'saleskit-requests')
            ->with('menu', '')
            ->with('records', $records);
    }

    public function export()
    {
        $records = DB::table('landing_saleskit_requests')
            ->orderBy('created_at', 'desc')
            ->get();

        if ($records->isEmpty()) {
            return redirect()->route('saleskit_requests_index')->with('flash_message', 'No Data');
        }

        $exportData = $records->map(function ($row, $index) {
            return [
                'no'          => $index + 1,
                'name'        => $row->name,
                'email'       => $row->email,
                'company'     => $row->company,
                'phone'       => $row->phone ?? '',
                'locale'      => $row->locale,
                'application' => $row->application,
                'created_at'  => $row->created_at,
            ];
        })->toArray();

        return Excel::download(
            new class($exportData) implements FromArray, WithHeadings {
                private $data;
                public function __construct(array $data) { $this->data = $data; }
                public function array(): array { return $this->data; }
                public function headings(): array {
                    return ['No', 'Name', 'Email', 'Company', 'Phone', 'Locale', 'Application', 'Created At'];
                }
            },
            'saleskit-requests.csv',
            ExcelFormat::CSV,
            ['use_bom' => true, 'encoding' => 'UTF-16LE']
        );
    }
}
