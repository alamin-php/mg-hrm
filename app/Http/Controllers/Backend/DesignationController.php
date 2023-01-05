<?php

namespace App\Http\Controllers\Backend;

use DB;
use Auth;
use Validator;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DesignationController extends Controller
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
            $designation = DB::table('designations')->orderBy('id', 'DESC')->get();

            return Datatables::of($designation)
            ->addIndexColumn()
            ->editColumn('status', function($row){
                if($row->status == 1){
                    return 'Active';
                }else{
                    return 'Deactive';
                }
            })
            ->addColumn('action', function($row){
                return '
                <a href="" class="btn btn-xs btn-primary edit" data-toggle="modal"
                                                data-id="'.$row->id.'" data-target="#editModal"><i
                                                    class="fa fa-edit"></i></a>
                <a href="'.route('desig.destroy', [$row->id]).'" class="btn btn-xs btn-danger" id="delete_designation"><i class="fa fa-trash"></i></a>
                ';
            })
            ->rawColumns(['action', 'stauts'])
            ->make(true);
        }
        return view('backend.designation.index');

    }
    /**
     * User store into database
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'desig_name'=>'required|string|unique:designations'
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $values = [
                'desig_name'=>$request->desig_name,
           ];
           $query = DB::table('designations')->insert($values);
            if($query){
                return response()->json('Designation Created Successfully');
            }
        }
    }

    /**
     * Edit user
     */
    public function edit($id)
    {
        $data = DB::table('designations')->where('id', $id)->first();
        return view('backend.designation.edit', compact('data'));
    }

    /**
     * Update User
     */

    public function update(Request $request)
    {
        $data = array();
        $data['desig_name'] = $request->desig_name;
        DB::table('designations')->where('id', $request->id)->update($data);
       return response()->json('designation Updated Successfully');
    }

    /**
     * Delete user
     */
    public function destroy($id){
        DB::table('designations')->where('id', $id)->delete();
        return response()->json('Designation Deleted Successfully!');
    }
}
