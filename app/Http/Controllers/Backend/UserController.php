<?php

namespace App\Http\Controllers\Backend;

use DB;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Stevebauman\Location\Facades\Location;
use Validator;

class UserController extends Controller
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
            $user = DB::table('users')->get();

            return Datatables::of($user)
            ->addIndexColumn()
            ->editColumn('role', function($row){
                if($row->role == 'admin'){
                    return 'Admin';
                }elseif($row->role == 'user'){
                    return 'User';
                }
            })
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
                <a href="'.route('user.destroy', [$row->id]).'" class="btn btn-xs btn-danger" id="delete_user"><i class="fa fa-trash"></i></a>
                ';
            })
            ->rawColumns(['action', 'stauts', 'role'])
            ->make(true);
        }
        return view('backend.users.index');

    }
    /**
     * User store into database
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5|max:12'
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $values = [
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password)
           ];
           $query = DB::table('users')->insert($values);
            if($query){
                return response()->json('User Created Successfully');
            }
        }
    }

    /**
     * Edit user
     */
    public function edit($id)
    {
        $data = DB::table('users')->where('id', $id)->first();
        return view('backend.users.edit', compact('data'));
    }

    /**
     * Update User
     */

    public function update(Request $request)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
       DB::table('users')->where('id', $request->id)->update($data);
       return response()->json('User Updated Successfully');
    }

    /**
     * Delete user
     */
    public function destroy($id){
        DB::table('users')->where('id', $id)->delete();
        return response()->json('User Deleted Successfully!');
    }

    /**
     * Role Controlle
     */

    public function role(Request $request)
    {
        if($request->ajax()){
            $user = DB::table('users')->get();

            return Datatables::of($user)
            ->addIndexColumn()
            ->editColumn('role', function($row){
                if($row->role == 'admin'){
                    return 'Admin';
                }elseif($row->role == 'user'){
                    return 'User';
                }
            })
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
                ';
            })
            ->rawColumns(['action', 'stauts', 'role'])
            ->make(true);
        }
        return view('backend.users.user_role');

    }

    public function userLocation()
    {
        // return view('backend.users.user_role');
        if ($position = Location::get()) {
            // Successfully retrieved position.
            dd($position);
        } else {
            // Failed retrieving position.
        }
    }
}
