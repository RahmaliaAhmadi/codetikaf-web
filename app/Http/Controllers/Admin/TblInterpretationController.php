<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TafsirExport;
use App\Http\Controllers\Controller;
use App\Imports\TafsirImport;
use App\Models\MasterInfoInterpretations;
use App\Models\MasterSections;
use App\Models\TblInterpretations;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class TblInterpretationController extends Controller
{
    public function index()
    {
        $data = TblInterpretations::orderBy('surah_index', 'ASC')->orderByRaw('CONVERT(verse_index, SIGNED) asc')->paginate(10);
        $interpretation = MasterInfoInterpretations::all();
        $section = MasterSections::all();
        return view('admin.tafsir', compact('data', 'interpretation', 'section'));
    }

    public function store(Request $request)
    {
        $surah_index = $request->input('surah_index');
        $verse_index = $request->input('verse_index');
        $info_interpretation_id = $request->input('info_interpretation_id');
        $content = $request->input('content');
        $data = new TblInterpretations();
        $data->surah_index =  $surah_index;
        $data->verse_index =  $verse_index;
        $data->info_interpretation_id =  $info_interpretation_id;
        $data->content =  $content;
        $data->save();
        Session::flash('message', 'insert');
        return redirect()->route('data-tafsir.index');
    }

    public function show(Request $request, $id)
    {
        //
    }

    public function edit($id)
    {
        $data = TblInterpretations::find($id);
        $data->info_name = $data->info->name;
        $data->surah_name = $data->surah->name;
        $data->verse_name = $data->verse->verse_index;
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $info_interpretation_id = $request->input('info_interpretation_id');
        $surah_index = $request->input('surah_index');
        $verse_index = $request->input('verse_index');
        $content = $request->input('content');
        $data = TblInterpretations::find($id);
        $data->info_interpretation_id =  $info_interpretation_id;
        $data->surah_index =  $surah_index;
        $data->verse_index =  $verse_index;
        $data->content =  $content;
        $data->save();
        Session::flash('message', 'update');
        return redirect()->route('data-tafsir.index');
    }

    public function destroy(Request $request, $id)
    {
        $ids = $request->input('check');
        $alls = $request->input('select-all');
        if ($alls == 0) {
            foreach ($ids as $deletes) {
                $data = TblInterpretations::where('id', $deletes)->first();
                $data->delete();
            }
        } else if ($alls == 1) {
            $datas = TblInterpretations::get();
            foreach ($datas as $data) {
                $data->delete();
            }
        }
        Session::flash('message', 'delete');
        return redirect()->route('data-tafsir.index');
    }

    public function import(Request $request)
    {
        $file = $request->file('file');

        Excel::import(new TafsirImport(), $file);
        return redirect()->route('data-tafsir.index');
    }

    public function templateExport(){
        return Excel::download(new TafsirExport(), 'Template Tafsir.ods');
    }
    
}
