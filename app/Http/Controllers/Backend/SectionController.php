<?php

namespace App\Http\Controllers\Backend;

use DB;
use Auth;
use Validator;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SectionController extends Controller
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
            $section = DB::table('sections')->orderBy('id', 'DESC')->get();

            return Datatables::of($section)
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
                <a href="'.route('section.destroy', [$row->id]).'" class="btn btn-xs btn-danger" id="delete_section"><i class="fa fa-trash"></i></a>
                ';
            })
            ->rawColumns(['action', 'stauts'])
            ->make(true);
        }
        return view('backend.section.index');

    }
    /**
     * User store into database
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'section_name'=>'required|string|unique:sections'
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $values = [
                'section_name'=>$request->section_name,
                'section_slug'=>Str::slug($request->section_name, '-'),
           ];
           $query = DB::table('sections')->insert($values);
            if($query){
                return response()->json('Section Created Successfully');
            }
        }
    }

    /**
     * Edit user
     */
    public function edit($id)
    {
        $data = DB::table('sections')->where('id', $id)->first();
        return view('backend.section.edit', compact('data'));
    }

    /**
     * Update User
     */

    public function update(Request $request)
    {
        $data = array();
        $data['section_name'] = $request->section_name;
        $data['section_slug'] = Str::slug($request->section_name);
        DB::table('sections')->where('id', $request->id)->update($data);
       return response()->json('Section Updated Successfully');
    }

    /**
     * Delete user
     */
    public function destroy($id){
        DB::table('sections')->where('id', $id)->delete();
        return response()->json('Section Deleted Successfully!');
    }
}
