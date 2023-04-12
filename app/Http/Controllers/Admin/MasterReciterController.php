<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterReciters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class MasterReciterController extends Controller
{
    public function index()
    {
        $data = MasterReciters::paginate(10);
        $filter_status = 0;
        return view('admin.qori',compact('data','filter_status'));
    }

    public function store(Request $request)
    {
        $name = $request->input('name');
        $data = new MasterReciters();
        if ($request->file('image')->isValid()) {
            $image_name = $request->file('image')->getClientOriginalName();
            $path = 'images/qori';
            $request->file('image')->move($path, $image_name);
            $data = new MasterReciters();
            $data->name =  $name;
            $data->image =  $image_name;
        }
        $data->save();
        Session::flash('message', 'insert');
        return redirect()->route('data-qori.index');
    }

    public function edit($id)
    {
        $data = MasterReciters::find($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $name = $request->input('name');
        $data = MasterReciters::find($id);
        $data->name = $name;
        $data->save();
        Session::flash('message', 'update');
        return redirect()->route('data-qori.index');
    }

    public function destroy(Request $request, $id)
    {
        $ids = $request->input('check');
        $alls = $request->input('select-all');
        if($alls == 0){
            foreach ($ids as $deletes) {
                $data = MasterReciters::where('id', $deletes)->first();
                $data->delete();
            }
        }
        else if($alls == 1){
            $datas = MasterReciters::all();
            foreach ($datas as $data){
                $data->delete();
            }
        }
        Session::flash('message', 'delete');
        return redirect()->route('data-qori.index');
    }

    public function filter(Request $request)
    {
        $search = $request->input('search');
        $data = MasterReciters::where('name', 'LIKE', '%'. $search .'%')->paginate(10);
      
        if ($search != null) {
            $data->appends(['search' => $search]);
        }
        $search = $search;
        $filter_status = 1;
        return view('admin.qori', compact('data', 'search','filter_status'));
    }

    public function upload_image(Request $request){
        $id = $request->input('id');
        $data = MasterReciters::where('id',$id)->first();
        if($request->image == ''){        
            $path = public_path().'/images/qori/';

            //upload new file
            $file = $request->image;
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);

            //for update in table
            $data->update(['image' => $filename]);
        }else{
            $usersImage = public_path("images/qori/{$data->image}"); // get previous image from folder
                    if (File::exists($usersImage)) { // unlink or remove previous image from folder
                        unlink($usersImage);
                        
                    } 
                    $file = $request->image;
                        $name = $file->getClientOriginalName();
                        $file = $file->move(('images/qori/'), $name);
                        $data->image= $name;
                        $data->save();
        }
           Session::flash('message', 'update');
           return redirect()->route('data-qori.index');
       }   
    
}
