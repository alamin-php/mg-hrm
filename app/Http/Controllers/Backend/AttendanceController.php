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
        $empid = DB::table('attendances')->select('empid')->groupBy('empid')->get();
        foreach($empid as $row){
            dd($row);
        }
        return view('backend.attendance.index', compact('data'));
    }

    public function attImport()
    {
        return view('backend.attendance.import');
    }

    public function importExcel(Request $request)
    {
        // $path = $request->file('file')->getRealPath();
        // dd($path);
        // // Excel::import(new AttendancesImport, $path);
        Excel::import(new AttendancesImport,
                      $request->file('file')->store('files'));
        return redirect()->back();
    }
}
