<?php

namespace App\Http\Controllers\Backend;

use DB;
use Auth;
use Validator;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class KpiController extends Controller
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

    /**
     *
     * View all user
     */

    public function index(Request $request)
    {
        if($request->ajax()){
            $section = DB::table('kpis')->orderBy('kpi_date', 'desc')->get();

            return Datatables::of($section)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                return '
                <a href="" class="btn btn-xs btn-primary edit" data-toggle="modal"
                                                data-id="'.$row->id.'" data-target="#editModal"><i
                                                    class="fa fa-edit"></i></a>
                <a href="'.route('section.destroy', [$row->id]).'" class="btn btn-xs btn-danger" id="delete_section"><i class="fa fa-trash"></i></a>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('backend.kpi.index');

    }
    public function create()
    {
        return view('backend.kpi.create');
    }
    /**
     * User store into database
     */
    public function store(Request $request)
    {
        $particular = $request->particular;
        $s_time = $request->s_time;
        $e_time = $request->e_time;
        $remarks = $request->remarks;
        $kpi_date = $request->kpi_date;
        for ($i=0; $i <count($particular) ; $i++) {
            $datasave = [
                'particular' => $particular[$i],
                's_time' => $s_time[$i],
                'e_time' => $e_time[$i],
                'remarks' => $remarks[$i],
                'user_id'   => Auth::user()->id,
                'kpi_date'   => $kpi_date[$i],
            ];

            DB::table('kpis')->insert($datasave);
        }
        return response()->json('KPI Added Successfully');
    }

    /**
     * Edit user
     */
    public function edit($id)
    {
        $unit = DB::table('units')->where('status', 1)->get();
        $section = DB::table('sections')->where('status', 1)->get();
        $desig = DB::table('designations')->where('status', 1)->get();
        $data = DB::table('employees')->where('id', $id)->first();
        return view('backend.employee.edit', compact('data', 'unit', 'section', 'desig'));
    }

    /**
     * Update User
     */

    public function update(Request $request)
    {
        $data = array();
        $data['unit_id'] = $request->unit_id;
        $data['section_id'] = $request->section_id;
        $data['desig_id'] = $request->desig_id;
        $data['name'] = $request->name;
        DB::table('employees')->where('id', $request->id)->update($data);
       return response()->json('Employee Updated Successfully');
    }
        // Active and Deactive Employee
        public function activeAndDeactive($id)
        {
            $check_status = DB::table('allotmants')->where('id', $id)->first();
            if($check_status->status == 1){
                DB::table('allotmants')->where('id', $id)->update(['status'=>0]);
                return response()->json('Allotmant Deactived');
            }elseif($check_status->status == 0){
                DB::table('allotmants')->where('id', $id)->update(['status'=>1]);
                return response()->json('Allotmant Actived');
            }
        }

    /**
     * Delete user
     */
    public function destroy($id){
        DB::table('employees')->where('id', $id)->delete();
        return response()->json('employee Deleted Successfully!');
    }
}
