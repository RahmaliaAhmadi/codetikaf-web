<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterSections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MasterSectionController extends Controller
{
    public function index()
    {
        $data = MasterSections::orderByRaw('CONVERT(section_index, SIGNED) asc')->paginate(10);
        $search = 'search';
        $filter_status = 0;
        return view('admin.juz', compact('data','search','filter_status'));
    }

    public function store(Request $request)
    {
        $section_index = $request->input('section_index');
        $juz = MasterSections::where('section_index', $section_index)->first();
        if($juz){
            Session::flash('message', 'duplicate');
            return back();
        }
        $data = new MasterSections();
        $data->section_index =  $section_index;
        $data->save();
        Session::flash('message', 'insert');
        return redirect()->route('data-juz.index');
    }

    public function edit($id)
    {
        $data = MasterSections::find($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $section_index = $request->input('section_index');
        $data = MasterSections::find($id);
        $data->section_index = $section_index;
        $data->save();
        Session::flash('message', 'update');
        return redirect()->route('data-juz.index');
    }

    public function destroy(Request $request, $id)
    {
        $ids = $request->input('check');
        $alls = $request->input('select-all');
        if ($alls == 0) {
            foreach ($ids as $deletes) {
                $data = MasterSections::where('id', $deletes)->first();
                $data->delete();
            }
        } else if ($alls == 1) {
            $datas = MasterSections::all();
            foreach ($datas as $data) {
                $data->delete();
            }
        }
        Session::flash('message', 'delete');
        return redirect()->route('data-juz.index');
    }

    public function filter(Request $request)
    {
        $search = $request->input('search');
        $data = MasterSections::where('section_index', 'LIKE', '%'. $search .'%')->paginate(10);
      
        if ($search != null) {
            $data->appends(['search' => $search]);
        }
        $search = $search;
        $filter_status = 1;
        return view('admin.juz', compact('data', 'search','filter_status'));
    }
}
