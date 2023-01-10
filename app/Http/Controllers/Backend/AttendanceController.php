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
        $data = DB::table('attendances')
        ->leftJoin('employees', 'attendances.empid', 'employees.empid')
        ->select('employees.*', 'attendances.*')
        ->get();
        return view('backend.attendance.index', compact('data'));
    }

    public function attImport()
    {
        return view('backend.attendance.import');
    }

    public function importExcel(Request $request)
    {
        $select_date = $request->select_date;
        $date = DB::table('attendances')->where('date', $select_date)->delete();


        if($date){
            $path = $request->file('file')->getRealPath();
            Excel::import(new AttendancesImport, $path);
        }else{
            $path = $request->file('file')->getRealPath();
            Excel::import(new AttendancesImport, $path);
        }
        // $path = $request->file('file')->getRealPath();
        //     Excel::import(new AttendancesImport, $path);
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
        // dd($request->all());
        $employee = DB::table('attendances')
        ->leftJoin('employees', 'attendances.empid', 'employees.empid')
        ->leftJoin('units', 'employees.unit_id', 'units.id')
        ->leftJoin('designations', 'employees.desig_id', 'designations.id')
        ->leftJoin('sections', 'employees.section_id', 'sections.id')
        ->select('employees.*', 'employees.name as emp_name', 'units.unit_name', 'designations.desig_name','sections.section_name', 'attendances.*')
        ->where('employees.empid', $empid)->first();
        $search = DB::table('attendances')
        ->leftJoin('employees', 'attendances.empid', 'employees.empid')
        ->leftJoin('manualattn', 'employees.empid', 'manualattn.empid')
        ->select('employees.*', 'attendances.*', 'manualattn.intime as mintime', 'manualattn.intime as mouttime')
        ->where('employees.empid', $empid)
        // ->where('attendances.date', '>=', $frm_date)
        // ->where('attendances.date', '<=', $to_date)
        ->whereBetween('attendances.date', [$frm_date, $to_date])
        ->orderBy('date', 'ASC')
        ->get()->unique('date');
        // dd($search);
        return view('backend.employee.getjobcard', compact('search', 'employee'));
    }
    public function todayPresent()
    {
        $today = date('Y-m-d');
        $todayPresent = DB::table('attendances')->leftJoin('employees', 'attendances.empid', 'employees.empid')
        ->leftJoin('designations', 'employees.desig_id', 'designations.id')
        ->leftJoin('sections', 'employees.section_id', 'sections.id')
        ->select('employees.name as emp_name','designations.desig_name','sections.section_name', 'attendances.*')
        ->where('attendances.date', $today)
        ->whereNotNull('attendances.intime')
        ->orderBy('date', 'ASC')
        ->get();
        return view('backend.attendance.today_present', compact('todayPresent'));
    }

    // Manual Attendance
    public function manualAttendance()
    {
        return view('backend.attendance.manual_attendance');
    }
    public function manualAttenStore(Request $request)
    {
       date_default_timezone_set('Asia/Dhaka');
       $data = array();
       $data['date'] = $request->date;
       $data['empid'] = $request->empid;
       $data['intime'] = $request->intime;
       $data['outtime'] = $request->outtime;
       $data['created_at'] = date('Y-m-d');
       $query = DB::table('manualattn')->insert($data);
       if($query){
        return redirect()->back();
       }
    }
}
