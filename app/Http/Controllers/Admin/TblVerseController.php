<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TemplateAyatExport;
use App\Http\Controllers\Controller;
use App\Imports\AyatImport;
use App\Models\MasterSections;
use App\Models\TblSurahs;
use App\Models\TblVerses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class TblVerseController extends Controller
{
    public function index()
    {
        $data = TblVerses::orderBy('surah_id', 'ASC')->orderByRaw('CONVERT(verse_index, SIGNED) asc')->paginate(10);
        $package = MasterSections::orderByRaw('CONVERT(section_index, SIGNED) asc')->get();
        $search = 'search';
        $filter_status = 0;
        return view('admin.ayat', compact('data', 'package', 'search', 'filter_status'));
    }

    public function store(Request $request)
    {
        $index_section = $request->input('index_section');
        $surah_id = $request->input('surah_id');
        $index = $request->input('index');
        $content_indopak = $request->input('content_indopak');
        $content_utsmani = $request->input('content_utsmani');
        $latin = $request->input('latin');
        $translation = $request->input('translation');
        $data = new TblVerses();
        $data->index_section =  $index_section;
        $data->surah_id =  $surah_id;
        $data->verse_index =  $index;
        $data->content_indopak =  $content_indopak;
        $data->content_utsmani =  $content_utsmani;
        $data->latin =  $latin;
        $data->translation =  $translation;
        $data->save();
        Session::flash('message', 'insert');
        return redirect()->route('data-ayat.index');
    }

    public function show(Request $request, $id)
    {
        //
    }

    public function edit($id)
    {
        $data = TblVerses::find($id);
        $data->surah_name = $data->surah->name;
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $index_section = $request->input('index_section');
        $surah_id = $request->input('surah_id');
        $index = $request->input('index');
        $content_indopak = $request->input('content_indopak');
        $content_utsmani = $request->input('content_utsmani');
        $latin = $request->input('latin');
        $translation = $request->input('translation');
        $data = TblVerses::find($id);
        $data->index_section =  $index_section;
        $data->surah_id =  $surah_id;
        $data->verse_index =  $index;
        $data->content_indopak =  $content_indopak;
        $data->content_utsmani =  $content_utsmani;
        $data->latin =  $latin;
        $data->translation =  $translation;
        $data->save();
        Session::flash('message', 'update');
        return redirect()->route('data-ayat.index');
    }

    public function destroy(Request $request)
    {
        $ids = $request->input('check');
        $alls = $request->input('select-all');
        if ($alls == 0) {
            foreach ($ids as $deletes) {
                $data = TblVerses::where('id', $deletes)->first();
                $data->delete();
            }
        } else if ($alls == 1) {
            $datas = TblVerses::get();
            foreach ($datas as $data) {
                $data->delete();
            }
        }
        Session::flash('message', 'delete');
        return redirect()->route('data-ayat.index');
    }

    public function json(Request $request)
    {
        $value = $request->input('value');
        $values =  TblVerses::where('surah_id', $value)->get();
        //Buat variabel untuk menampung tag - tag optionnya
        $lists = "<option value=''>Pilih Ayat</option>";
        foreach ($values as $data) {
            $lists .= "<option value='" . $data->id . "'>" . $data->verse_index . "</option>"; //menambahkan tag option ke variabel lists
        }

        //memasukkan variabel lists tadi ke dalam array dengan nama indexnya list_matpel
        $callback = array('list_data' => $lists);

        echo json_encode($callback); //konversi variabel $callback menjadi JSON
    }

    public function json2(Request $request)
    {
        $value = $request->input('value');
        $values =  TblVerses::where('surah_id', $value)->get();
        //Buat variabel untuk menampung tag - tag optionnya
        $lists = "<option value=''>Pilih Ayat</option>";
        foreach ($values as $data) {
            $lists .= "<option value='" . $data->verse_index . "'>" . $data->verse_index . "</option>"; //menambahkan tag option ke variabel lists
        }

        //memasukkan variabel lists tadi ke dalam array dengan nama indexnya list_matpel
        $callback = array('list_data' => $lists);

        echo json_encode($callback); //konversi variabel $callback menjadi JSON
    }

    public function import(Request $request)
    {
        $file = $request->file('file');

        Excel::import(new AyatImport(), $file);

        Session::flash('message', 'insert');
        return redirect()->route('data-ayat.index');
    }

    public function templateExport()
    {
        return Excel::download(new TemplateAyatExport(), 'Template Ayat.ods');
    }

    public function filter(Request $request)
    {
        $surah = $request->input('surah');
        $ayat = $request->input('ayat');
        $datas =    DB::table('tbl_verses')
            ->join('tbl_surahs', 'tbl_surahs.index', '=', 'tbl_verses.surah_id')
            ->select('tbl_verses.*','tbl_surahs.name');
        if ($request->input('tipe') == 'filter') {
            if ($surah != null) {
                $datas->where('tbl_surahs.name', $surah);
            }
            if ($ayat != null) {
                $datas->where('tbl_verses.index', $ayat);
            }
        }
        $data = $datas->paginate(10);

        if ($ayat != null) {
            $data->appends(['ayat' => $ayat]);
        }
        if ($surah != null) {
            $data->appends(['surah' => $surah]);
        }
        if ($request->input('tipe') == 'search') {
            $data->appends(['tipe' => 'search']);
        }
        $searchs = array();
        $searchs[0] = $surah;
        $searchs[1] = $ayat;
        $package = MasterSections::orderByRaw('CONVERT(section_index, SIGNED) asc')->get();
        $search = 'search';
        $filter_status = 1;
        return view('admin.ayat', compact('data', 'package','filter_status', 'search', 'searchs'));
    }
}
