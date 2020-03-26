<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Person;
use Excel;
use Illuminate\Support\Facades\DB;
use Auth;
use PDF;
use App\Http\Controllers\SidebarController;

class ReportPerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        date_default_timezone_set('asia/ho_chi_minh');
        $format = 'Y/m/d';
        $now = '';
        $to = date($format, strtotime("+30 days"));
        $constraints = [
            'id_num' => $now,

        ];

        $employees = $this->getHiredEmployees($constraints);
        return view('system-mgmt/reportper/index', ['employees' => $employees, 'searchingVals' => $constraints]);
    }

    public function exportExcel(Request $request) {
        $this->prepareExportingData($request)->export('xlsx');
        redirect()->intended('system-management/reportper');
    }

    public function exportPDF(Request $request) {
         $constraints = [
            'id_num' => $request['id_num'],

        ];
        $employees = $this->getExportingData($constraints);
        $pdf = PDF::loadView('system-mgmt/reportper/pdf', ['employees' => $employees, 'searchingVals' => $constraints]);
        return $pdf->download('report_from_'. $request['id_num'].'pdf');
        // return view('system-mgmt/report/pdf', ['employees' => $employees, 'searchingVals' => $constraints]);
    }

    private function prepareExportingData($request) {
        $author = Auth::user()->username;
        $employees = $this->getExportingData(['id_num'=> $request['id_num']]);
        return Excel::create('report_from_'. $request['id_num'], function($excel) use($employees, $request, $author) {

        // Set the title
        $excel->setTitle('List of hired employees from '. $request['id_num']);

        // Chain the setters
        $excel->setCreator($author)
            ->setCompany('Wealththai');

        // Call them separately
        $excel->setDescription('The list of hired employees');

        $excel->sheet('id_num', function($sheet) use($employees) {

        $sheet->fromArray($employees);
            });
        });
    }

    public function search(Request $request) {
        $constraints = [
            'id_num' => $request['id_num'],

        ];

        $employees = $this->getHiredEmployees($constraints);
        return view('system-mgmt/reportper/index', ['employees' => $employees, 'searchingVals' => $constraints]);
    }

    private function getHiredEmployees($constraints) {
        $employees = Person::where('id_num', '=', $constraints['id_num'])

                        ->get();
        return $employees;
    }

    private function getExportingData($constraints) {
        return DB::table('persons')

        ->select('persons.name', 'persons.lname','persons.id_num','persons.Eng_name', 'persons.Eng_lastname', 'persons.gender')
          ->where('id_num', 1100702449064)

        ->get()
        ->map(function ($item, $key) {
        return (array) $item;
        })
        ->all();
    }
}
