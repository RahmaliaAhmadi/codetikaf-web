<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TemplateAudioExport;
use App\Http\Controllers\Controller;
use App\Imports\AudioImport;
use App\Models\MasterReciters;
use App\Models\TblVerseAudios;
use App\Models\TblVerses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class TblVerseAudioController extends Controller
{
    public function index()
    {
           $data = TblVerseAudios::orderBy('surah_index', 'ASC')->orderByRaw('CONVERT(verse_index, SIGNED) asc')->paginate(10);
        $verse = TblVerses::all();
        $reciter = MasterReciters::all();
        return view('admin.audio', compact('data','verse', 'reciter'));
    }

    public function store(Request $request)
    {
        $verse_index = $request->input('verse_index');
        $surah_index = $request->input('surah_index');
        $reciter_id = $request->input('reciter_id');
        $link = $request->input('link');
        $data = new TblVerseAudios();
        $data->surah_index =  $surah_index;
        $data->verse_index =  $verse_index;
        $data->reciter_id =  $reciter_id;
        $data->link =  $link;
        $data->save();
        Session::flash('message', 'insert');
        return redirect()->route('data-audio.index');
    }

    public function show(Request $request, $id)
    {
        //
    }

    public function edit($id)
    {
        $data = TblVerseAudios::find($id);
        $data->reciter_name = $data->reciter->name;
        $data->surah_name = $data->surah->name;
        $data->verse_name = $data->verse->verse_index;
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $surah_index = $request->input('surah_index');
        $verse_index = $request->input('verse_index');
        $reciter_id = $request->input('reciter_id');
        $link = $request->input('link');
        $data = TblVerseAudios::find($id);
        $data->verse_index =  $verse_index;
        $data->surah_index =  $surah_index;
        $data->reciter_id =  $reciter_id;
        $data->link =  $link;
        $data->save();
        Session::flash('message', 'update');
        return redirect()->route('data-audio.index');
    }

    public function destroy(Request $request, $id)
    {
        $ids = $request->input('check');
        $alls = $request->input('select-all');
        if ($alls == 0) {
            foreach ($ids as $deletes) {
                $data = TblVerseAudios::where('id', $deletes)->first();
                $data->delete();
            }
        } else if ($alls == 1) {
            $datas = TblVerseAudios::where('section_id', $id)->get();
            foreach ($datas as $data) {
                $data->delete();
            }
        }
        Session::flash('message', 'delete');
        return redirect()->route('data-audio.index');
    }

    public function import(Request $request)
    {
        $file = $request->file('file');

        Excel::import(new AudioImport(), $file);
        // notifikasi dengan session
        Session::flash('message', 'insert');

        // alihkan halaman kembali
        return redirect()->route('data-audio.index');
    }

    public function templateExport(){
        return Excel::download(new TemplateAudioExport(), 'Template Audio Ayat.ods');
    }
}
