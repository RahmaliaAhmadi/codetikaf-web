<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TemplateSurahExport;
use App\Http\Controllers\Controller;
use App\Imports\SurahImport;
use App\Models\MasterSections;
use App\Models\TblSurahs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class TblSurahController extends Controller
{
    public function index()
    {
        $data = TblSurahs::orderByRaw('CONVERT(surah_index, SIGNED) asc')->paginate(10);
        $section = MasterSections::orderByRaw('CONVERT(section_index, SIGNED) asc')->get();
        $search = 'search';
        $filter_status = 0;
        return view('admin.surah',compact('data','section','search','filter_status'));
    }

    public function store(Request $request)
    {
        $section_id = $request->input('section_id');
        $index = $request->input('index');
        $surah = TblSurahs::where('index', $index)->first();
        if($surah){
            Session::flash('message', 'duplicate');
            return back();
        }
        $name = $request->input('name');
        $count_serve = $request->input('count_serve');
        $type = $request->input('type');
        $lafadz = $request->input('lafadz');
        $translate_name = $request->input('translate_name');
        $use_bismillah = $request->input('use_bismillah');
        $data = new TblSurahs();
        $data->section_id =  $section_id;
        $data->surah_index =  $index;
        $data->name =  $name;
        $data->count_serve =  $count_serve;
        $data->type =  $type;
        $data->lafadz =  $lafadz;
        $data->use_bismillah =  $use_bismillah;
        $data->translate_name =  $translate_name;
        $data->save();
        Session::flash('message', 'insert');
        return redirect()->route('data-surah.index');
    }

    public function show(Request $request, $id)
    {
       //
    }

    public function edit($id)
    {
        $data = TblSurahs::find($id);
        if($data->section_id != null){
            $data->section_name = $data->section->section_index;
        }
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $section_id = $request->input('section_id');
        $index = $request->input('index');
        $name = $request->input('name');
        $count_serve = $request->input('count_serve');
        $type = $request->input('type');
        $lafadz = $request->input('lafadz');
        $translate_name = $request->input('translate_name');
        $use_bismillah = $request->input('use_bismillah');
        $data = TblSurahs::find($id);
        $data->section_id =  $section_id;
        $data->surah_index =  $index;
        $data->name =  $name;
        $data->count_serve =  $count_serve;
        $data->type =  $type;
        $data->lafadz =  $lafadz;
        $data->translate_name =  $translate_name;
        $data->use_bismillah =  $use_bismillah;
        $data->save();
        Session::flash('message', 'update');
        return redirect()->route('data-surah.index');
    }

    public function destroy(Request $request, $id)
    {
        $ids = $request->input('check');
        $alls = $request->input('select-all');
        if($alls == 0){
            foreach ($ids as $deletes) {
                $data = TblSurahs::where('id', $deletes)->first();
                $data->delete();
            }
        }
        else if($alls == 1){
            $datas = TblSurahs::where('section_id', $id)->get();
            foreach ($datas as $data){
                $data->delete();
            }
        }
        Session::flash('message', 'delete');
        return redirect()->route('data-surah.index');
    }

    public function json(Request $request){
        $value = $request->input('value');
        $values =  TblSurahs::where('section_id',$value)->orderByRaw('CONVERT(surah_index, SIGNED) asc')->get();
        //Buat variabel untuk menampung tag - tag optionnya
        $lists = "<option value=''>Pilih Surah</option>";
        foreach($values as $data){
            $lists .= "<option value='".$data->surah_index."'>".$data->name."</option>"; //menambahkan tag option ke variabel lists
        }

        //memasukkan variabel lists tadi ke dalam array dengan nama indexnya list_matpel
        $callback = array('list_data' => $lists);

        echo json_encode($callback); //konversi variabel $callback menjadi JSON
    }

    public function json2(Request $request){
        $value = $request->input('value');
        $values =  TblSurahs::where('name','LIKE','%'.$value.'%')->get();
        //Buat variabel untuk menampung tag - tag optionnya
        $lists = "<option value=''>Pilih Surah</option>";
        foreach($values as $data){
            $lists .= "<option value='".$data->surah_index."'>".$data->name."</option>"; //menambahkan tag option ke variabel lists
        }

        //memasukkan variabel lists tadi ke dalam array dengan nama indexnya list_matpel
        $callback = array('list_data' => $lists);

        echo json_encode($callback); //konversi variabel $callback menjadi JSON
    }

    public function import(Request $request)
    {
        $file = $request->file('file');

        Excel::import(new SurahImport(), $file);
        Session::flash('message', 'insert');

        // alihkan halaman kembali
        return redirect()->route('data-surah.index');
    }
    
    public function templateExport(){
        return Excel::download(new TemplateSurahExport(), 'Template Surah.ods');
    }

    public function filter(Request $request)
    {
        $search = $request->input('search');
        $data = TblSurahs::where('name', 'LIKE', '%'. $search .'%')->paginate(10);
        if ($search != null) {
            $data->appends(['search' => $search]);
        }
        $search = $search;
        $section = MasterSections::orderByRaw('CONVERT(section_index, SIGNED) asc')->get();
        $filter_status = 1;
        return view('admin.surah', compact('data', 'section','search','filter_status'));
    }

}