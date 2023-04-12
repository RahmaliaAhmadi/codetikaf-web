<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MasterRoleController extends Controller
{
    public function index()
    {
        $data = MasterRoles::paginate(10);
        return view('admin.role',compact('data'));
    }

    public function store(Request $request)
    {
        $name = $request->input('name');
        $data = new MasterRoles();
        $data->name =  $name;
        $data->save();
        Session::flash('message', 'insert');
        return redirect()->route('data-role.index');
    }

    public function edit($id)
    {
        $data = MasterRoles::find($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $name = $request->input('name');
        $data = MasterRoles::find($id);
        $data->name = $name;
        $data->save();
        Session::flash('message', 'update');
        return redirect()->route('data-role.index');
    }

    public function destroy(Request $request, $id)
    {
        $ids = $request->input('check');
        $alls = $request->input('select-all');
        if($alls == 0){
            foreach ($ids as $deletes) {
                $data = MasterRoles::where('id', $deletes)->first();
                $data->delete();
            }
        }
        else if($alls == 1){
            $datas = MasterRoles::all();
            foreach ($datas as $data){
                $data->delete();
            }
        }
        Session::flash('message', 'delete');
        return redirect()->route('data-role.index');
    }

    
}