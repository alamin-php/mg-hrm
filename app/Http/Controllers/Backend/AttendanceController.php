<?php

namespace App\Http\Controllers\Backend;

use DB;
use Excel;
use Illuminate\Http\Request;
use App\Imports\AttendancesImport;
use App\Http\Controllers\Controller;

class AttendanceController extends Controller
{
    public function index()
    {
        // $data = DB::table('attendances')->select('date')->groupBy('date')->get();
        $data = DB::table('attendances')->where('empid', '1')->get();
        return view('backend.attendance.index', compact('data'));
    }

    public function attImport()
    {
        return view('backend.attendance.import');
    }

    public function importExcel(Request $request)
    {
        $path = $request->file('file')->getRealPath();
        Excel::import(new AttendancesImport, $path);
        // Excel::import(new AttendancesImport,
        //               $request->file('file')->store('files'));
        return redirect()->back();
    }

    public function searchJobcard()
    {
        return view('backend.employee.jobcard');
    }
    public function getJobcard(Request $request)
    {
        $empid = $request->empid;
        $frm_date = $request->frm_date;
        $to_date = $request->to_date;
        $employee = DB::table('attendances')->where('empid', $empid)->first();
        $search = DB::table('attendances')->select()
        ->where('empid', $empid)
        ->where('date', '>=', $frm_date)
        ->where('date', '<=', $to_date)
        ->get();
        return view('backend.employee.getjobcard', compact('search', 'employee'));
    }
}
