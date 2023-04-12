<?php

namespace App\Http\Controllers\Sprint2;

use App\Http\Controllers\Controller;
use App\Models\TblContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class ContactusController extends Controller
{
    public function index()
    {
        $data = TblContactUs::paginate(10);
        return view('sprint2.contact', compact('data'));
    }

    public function store(Request $request)
    {
        $content = $request->input('content');
        if ($request->file('image')->isValid()) {
            $image_name = time() . "_" . $request->file('image')->getClientOriginalName();
            $path = 'images/kontak';
            $request->file('image')->move($path, $image_name);
            $data = new TblContactUs();
            $data->image = $image_name;
            $data->content = $content;
        }
        $data->save();
        Session::flash('message', 'insert');
        return redirect()->route('data-kontak.index');
    }

    public function edit($id)
    {
        $data = TblContactUs::find($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $content = $request->input('content');
        $data = TblContactUs::find($id);
        $data->content = $content;
        $data->save();
        Session::flash('message', 'update');
        return redirect()->route('data-kontak.index');
    }

    public function destroy(Request $request, $id)
    {
        $ids = $request->input('check');
        $alls = $request->input('select-all');
        if ($alls == 0) {
            foreach ($ids as $deletes) {
                $data = TblContactUs::where('id', $deletes)->first();
                $usersImage = public_path("images/kontak/{$data->image}");
                unlink($usersImage);
                $data->delete();
            }
        } else if ($alls == 1) {
            $datas = TblContactUs::all();
            foreach ($datas as $data) {
                $usersImage = public_path("images/kontak/{$data->image}");
                unlink($usersImage);
                $data->delete();
            }
        }
        Session::flash('message', 'delete');
        return redirect()->route('data-kontak.index');
    }

    public function upload_image(Request $request){
        $id = $request->input('id');
        $data = TblContactUs::where('id',$id)->first();
        if($request->image == ''){        
            $path = public_path().'/images/kontak/';

            //upload new file
            $file = $request->image;
            $filename = time()."_".$file->getClientOriginalName();
            $file->move($path, $filename);

            //for update in table
            $data->update(['image' => $filename]);
        }else{
            $usersImage = public_path("images/kontak/{$data->image}"); // get previous image from folder
                    if (File::exists($usersImage)) { // unlink or remove previous image from folder
                        unlink($usersImage);
                        
                    } 
                    $file = $request->image;
                        $name = time() . '-' . $file->getClientOriginalName();
                        $file = $file->move(('images/kontak/'), $name);
                        $data->image= $name;
                        $data->save();
        }
           Session::flash('message', 'update');
           return redirect()->route('data-kontak.index');
       }    

}
