<?php

namespace App\Http\Controllers\Backend;

use DB;
use Auth;
use Validator;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
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
            $employee = DB::table('employees')->orderBy('id', 'DESC')
            ->leftJoin('units', 'employees.unit_id', 'units.id')
            ->leftJoin('sections', 'employees.section_id', 'sections.id')
            ->leftJoin('designations', 'employees.desig_id', 'designations.id')
            ->select('employees.*', 'units.unit_name', 'sections.section_name', 'designations.desig_name')->get();

            return Datatables::of($employee)
            ->addIndexColumn()
            ->editColumn('status', function($row){
                if($row->status == 1){
                    return '<a href="#" data-id="'.$row->id.'" class="btn btn-success btn-xs btn-flat update_status">Active</a>';
                }else{
                    return '<a href="#" data-id="'.$row->id.'" class="btn btn-danger btn-xs btn-flat update_status">Deactive</a>';
                }
            })
            ->addColumn('action', function($row){
                return '
                <a href="" class="btn btn-xs btn-primary edit" data-toggle="modal"
                                                data-id="'.$row->id.'" data-target="#editModal"><i
                                                    class="fa fa-edit"></i></a>
                <a href="'.route('employee.destroy', [$row->id]).'" class="btn btn-xs btn-danger" id="delete_employee"><i class="fa fa-trash"></i></a>
                ';
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
        }
        $unit = DB::table('units')->where('status', 1)->get();
        $section = DB::table('sections')->where('status', 1)->get();
        $desig = DB::table('designations')->where('status', 1)->get();
        return view('backend.employee.index', compact('unit', 'section', 'desig'));

    }
    /**
     * User store into database
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'empid'=>'required|unique:employees',
            'name'=>'required|string'
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $values = [
                'empid'=>$request->empid,
                'unit_id'=>$request->unit_id,
                'section_id'=>$request->section_id,
                'desig_id'=>$request->desig_id,
                'name'=>$request->name,
           ];
           $query = DB::table('employees')->insert($values);
            if($query){
                return response()->json('Employee Created Successfully');
            }
        }
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
            $check_status = DB::table('employees')->where('id', $id)->first();
            if($check_status->status == 1){
                DB::table('employees')->where('id', $id)->update(['status'=>0]);
                return response()->json('Employee Deactived');
            }elseif($check_status->status == 0){
                DB::table('employees')->where('id', $id)->update(['status'=>1]);
                return response()->json('Employee Actived');
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
