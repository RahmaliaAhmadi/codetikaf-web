<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterRoles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function index()
    {
        $data = User::where('role_id',2)->paginate(10);
        $role = MasterRoles::all();
        return view('admin.admin',compact('data','role'));
    }

    public function store(Request $request)
    {
        $role_id = $request->input('role_id');
        $name = $request->input('name');
        $email = $request->input('email');
        $user = User::where('email',$email);
        if($user){
            Session::flash('message', 'duplicate');
            return back();
        }
        $password = $request->input('password');
        $phone = $request->input('phone');
        $data = new User();
        $data->role_id =  $role_id;
        $data->name =  $name;
        $data->email =  $email;
        $data->password = Hash::make($password);
        $data->phone =  $phone;
        $data->save();
        Session::flash('message', 'insert');
        return redirect()->route('data-admin.index');
    }

    public function edit($id)
    {
        $data = User::find($id);
        $data->role_name = $data->role->name;
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $role_id = $request->input('role_id');
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $phone = $request->input('phone');
        $data = User::find($id);
        $data->role_id =  $role_id;
        $data->name =  $name;
        $data->email =  $email;
        $data->phone =  $phone;
        $data->save();
        if ($request->input('checkpass') != null) {
            $data->password = Hash::make($password);
            $data->save();
        }
        Session::flash('message', 'update');
        return redirect()->route('data-admin.index');
    }

    public function destroy(Request $request, $id)
    {
        $ids = $request->input('check');
        $alls = $request->input('select-all');
        if($alls == 0){
            foreach ($ids as $deletes) {
                $data = User::where('id', $deletes)->first();
                $data->delete();
            }
        }
        else if($alls == 1){
            $datas = User::where('role_id',2)->get();
            foreach ($datas as $data){
                $data->delete();
            }
        }
        Session::flash('message', 'delete');
        return redirect()->route('data-admin.index');
    }

    
}
