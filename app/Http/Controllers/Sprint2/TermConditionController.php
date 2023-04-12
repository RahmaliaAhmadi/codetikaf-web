<?php

namespace App\Http\Controllers\Sprint2;

use App\Http\Controllers\Controller;
use App\Models\TblTermConditions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TermConditionController extends Controller
{
    public function index()
    {
        $data = TblTermConditions::paginate(10);
        return view('sprint2.term',compact('data'));
    }

    public function store(Request $request)
    {
        $description = $request->input('description');
        if($description == null){
            Session::flash('message', 'dataEmpty');
            return back();

        }
        $data = new TblTermConditions();
        $data->description =  $description;
        $data->save();
        Session::flash('message', 'insert');
        return redirect()->route('data-syarat-ketentuan.index');
    }

    public function edit($id)
    {
        $data = TblTermConditions::find($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $description = $request->input('description');
        if($description == null){
            Session::flash('message', 'dataEmpty');
            return back();

        }
        $data = TblTermConditions::find($id);
        $data->description = $description;
        $data->save();
        Session::flash('message', 'update');
        return redirect()->route('data-syarat-ketentuan.index');
    }

    public function destroy(Request $request, $id)
    {
        $ids = $request->input('check');
        $alls = $request->input('select-all');
        if($alls == 0){
            foreach ($ids as $deletes) {
                $data = TblTermConditions::where('id', $deletes)->first();
                $data->delete();
            }
        }
        else if($alls == 1){
            $datas = TblTermConditions::all();
            foreach ($datas as $data){
                $data->delete();
            }
        }
        Session::flash('message', 'delete');
        return redirect()->route('data-syarat-ketentuan.index');
    }

   
    
}
