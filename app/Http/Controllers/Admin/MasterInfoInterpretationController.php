<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterInfoInterpretations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MasterInfoInterpretationController extends Controller
{
    public function index()
    {
        $data = MasterInfoInterpretations::paginate(10);
        $filter_status = 0;
        return view('admin.info_tafsir',compact('data','filter_status'));
    }

    public function store(Request $request)
    {
        $name = $request->input('name');
        $data = new MasterInfoInterpretations();
        $data->name =  $name;
        $data->save();
        Session::flash('message', 'insert');
        return redirect()->route('data-info-tafsir.index');
    }

    public function edit($id)
    {
        $data = MasterInfoInterpretations::find($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $name = $request->input('name');
        $data = MasterInfoInterpretations::find($id);
        $data->name = $name;
        $data->save();
        Session::flash('message', 'update');
        return redirect()->route('data-info-tafsir.index');
    }

    public function destroy(Request $request, $id)
    {
        $ids = $request->input('check');
        $alls = $request->input('select-all');
        if($alls == 0){
            foreach ($ids as $deletes) {
                $data = MasterInfoInterpretations::where('id', $deletes)->first();
                $data->delete();
            }
        }
        else if($alls == 1){
            $datas = MasterInfoInterpretations::all();
            foreach ($datas as $data){
                $data->delete();
            }
        }
        Session::flash('message', 'delete');
        return redirect()->route('data-info-tafsir.index');
    }

   
    public function filter(Request $request)
    {
        $search = $request->input('search');
        $data = MasterInfoInterpretations::where('name', 'LIKE', '%'. $search .'%')->paginate(10);
      
        if ($search != null) {
            $data->appends(['search' => $search]);
        }
        $search = $search;
        $filter_status = 1;
        return view('admin.info_tafsir', compact('data', 'search','filter_status'));
    }
}
