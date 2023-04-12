<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TemplatePageExport;
use App\Http\Controllers\Controller;
use App\Imports\PageImport;
use App\Models\TblPages;
use App\Models\TblSurahs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

class TblPageController extends Controller
{


    public function index()
    {
        $data = TblPages::orderBy('page', 'ASC')->orderBy('surah_start_index', 'ASC')->orderByRaw('CONVERT(verse_start_index, SIGNED) asc')->paginate(10);
        $filter_status = 0;
        return view('admin.page', compact('data','filter_status'));
    }

    public function store(Request $request)
    {
        $surah_start_index = $request->input('surah_start_index');
        $surah_end_index = $request->input('surah_end_index');
        $verse_start_index = $request->input('verse_start_index');
        $verse_end_index = $request->input('verse_end_index');
        $page = $request->input('page');
        if ($request->file('image')->isValid()) {
            $image_name = $request->file('image')->getClientOriginalName();
            $path = 'images/halaman';
            $request->file('image')->move($path, $image_name);
            $data = new TblPages();
            $data->surah_start_index =  $surah_start_index;
            $data->surah_end_index =  $surah_end_index;
            $data->verse_start_index =  $verse_start_index;
            $data->verse_end_index =  $verse_end_index;
            $data->page =  $page;
            $data->image =  $image_name;
        }
    
        $data->save();
        Session::flash('message', 'insert');
        return redirect()->route('data-halaman.index');
    }

    public function edit($id)
    {
        $data = TblPages::find($id);
        $surah_start = TblSurahs::where('surah_index',$data->surah_start_index)->first();
        $surah_end = TblSurahs::where('surah_index',$data->surah_end_index)->first();
        $data->surah_start = $surah_start->name;
        $data->surah_end = $surah_end->name;
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $surah_start_index = $request->input('surah_start_index');
        $surah_end_index = $request->input('surah_end_index');
        $verse_start_index = $request->input('verse_start_index');
        $verse_end_index = $request->input('verse_end_index');
        $page = $request->input('page');
        $data = TblPages::find($id);
        $data->surah_start_index =  $surah_start_index;
        $data->surah_end_index =  $surah_end_index;
        $data->verse_start_index =  $verse_start_index;
        $data->verse_end_index =  $verse_end_index;
        $data->page =  $page;
        $data->save();
        Session::flash('message', 'update');
        return redirect()->route('data-halaman.index');
    }

    public function destroy(Request $request, $id)
    {
        $ids = $request->input('check');
        $alls = $request->input('select-all');
        if ($alls == 0) {
            foreach ($ids as $deletes) {
                $data = TblPages::where('id', $deletes)->first();
                $data->delete();
            }
        } else if ($alls == 1) {
            $datas = TblPages::all();
            foreach ($datas as $data) {
                $data->delete();
            }
        }
        Session::flash('message', 'delete');
        return redirect()->route('data-halaman.index');
    }

    public function upload_image(Request $request){
        $id = $request->input('id');
        $data = TblPages::where('id',$id)->first();
        if($request->image == ''){        
            $path = public_path().'/images/halaman/';

            //upload new file
            $file = $request->image;
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);

            //for update in table
            $data->update(['image' => $filename]);
        }else{
            $usersImage = public_path("images/halaman/{$data->image}"); // get previous image from folder
                    if (File::exists($usersImage)) { // unlink or remove previous image from folder
                        unlink($usersImage);
                        
                    } 
                    $file = $request->image;
                        $name = $file->getClientOriginalName();
                        $file = $file->move(('images/halaman/'), $name);
                        $data->image= $name;
                        $data->save();
        }
           Session::flash('message', 'update');
           return redirect()->route('data-halaman.index');
       }    

    public function filter(Request $request)
    {
        $search = $request->input('search');
        $data = TblPages::where('page', 'LIKE', '%'. $search .'%')->orderBy('page', 'ASC')
                ->orderBy('surah_start_index', 'ASC')->orderByRaw('verse_start_index::int')->paginate(10);
      
        if ($search != null) {
            $data->appends(['search' => $search]);
        }
        $search = $search;
        $filter_status = 1;
        return view('admin.page', compact('data', 'search','filter_status'));
    }

    public function import(Request $request)
    {
        $file = $request->file('file');

        Excel::import(new PageImport(), $file);

        Session::flash('message', 'insert');
        return redirect()->route('data-halaman.index');
    }

    public function templateExport()
    {
        return Excel::download(new TemplatePageExport(), 'Template halaman.ods');
    }
}
