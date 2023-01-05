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

class UnitController extends Controller
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
            $unit = DB::table('units')->orderBy('id', 'DESC')->get();

            return Datatables::of($unit)
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
                <a href="'.route('unit.destroy', [$row->id]).'" class="btn btn-xs btn-danger" id="delete_unit"><i class="fa fa-trash"></i></a>
                ';
            })
            ->rawColumns(['action', 'stauts'])
            ->make(true);
        }
        return view('backend.unit.index');

    }
    /**
     * User store into database
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'unit_name'=>'required|string|unique:units'
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $values = [
                'unit_name'=>$request->unit_name,
                'unit_slug'=>Str::slug($request->unit_name, '-'),
           ];
           $query = DB::table('units')->insert($values);
            if($query){
                return response()->json('Unit Created Successfully');
            }
        }
    }

    /**
     * Edit user
     */
    public function edit($id)
    {
        $data = DB::table('units')->where('id', $id)->first();
        return view('backend.unit.edit', compact('data'));
    }

    /**
     * Update User
     */

    public function update(Request $request)
    {
        $data = array();
        $data['unit_name'] = $request->unit_name;
        $data['unit_slug'] = Str::slug($request->unit_name);
        DB::table('units')->where('id', $request->id)->update($data);
       return response()->json('Unit Updated Successfully');
    }

    /**
     * Delete user
     */
    public function destroy($id){
        DB::table('units')->where('id', $id)->delete();
        return response()->json('Unit Deleted Successfully!');
    }
}
