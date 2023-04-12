<?php

namespace App\Http\Controllers\Sprint2;

use App\Http\Controllers\Controller;
use App\Models\MasterGeneralInfos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class GeneralInfoController extends Controller
{
    public function index()
    {
        $data = MasterGeneralInfos::paginate(10);
        $table = MasterGeneralInfos::table();
        $toggle1 = 'is_show';
        $toggle2 = 'is_priority';
        return view('sprint2.campign',compact('data','table','toggle1','toggle2'));
    }

    public function store(Request $request)
    {
        $title = $request->input('title');
        $link = $request->input('link');
        $description = $request->input('description');
        $is_show = $request->input('is_show');
        $is_priority = $request->input('is_priority');
        if ($request->file('image')->isValid()) {
            $image_name = time() . "_" . $request->file('image')->getClientOriginalName();
            $path = 'images/campign';
            $request->file('image')->move($path, $image_name);
            $data = new MasterGeneralInfos();
            $data->title = $title;
            $data->link = $link;
            $data->description = $description;
            $data->image = $image_name;
            $data->is_show = $is_show;
            $data->is_priority = $is_priority;
        }
        $data->save();
        Session::flash('message', 'insert');
        return redirect()->route('data-campign.index');
    }

    public function edit($id)
    {
        $data = MasterGeneralInfos::find($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $title = $request->input('title');
        $link = $request->input('link');
        $description = $request->input('description');
        $data = MasterGeneralInfos::find($id);
        $data->title = $title;
        $data->link = $link;
        $data->description = $description;
        $data->save();
        Session::flash('message', 'update');
        return redirect()->route('data-campign.index');
    }

    public function destroy(Request $request, $id)
    {
        $ids = $request->input('check');
        $alls = $request->input('select-all');
        if($alls == 0){
            foreach ($ids as $deletes) {
                $data = MasterGeneralInfos::where('id', $deletes)->first();
                $data->delete();
            }
        }
        else if($alls == 1){
            $datas = MasterGeneralInfos::all();
            foreach ($datas as $data){
                $data->delete();
            }
        }
        Session::flash('message', 'delete');
        return redirect()->route('data-campign.index');
    }

    public function upload_image(Request $request){
        $id = $request->input('id');
        $data = MasterGeneralInfos::where('id',$id)->first();
        if($request->image == ''){        
            $path = public_path().'/images/campign/';

            //upload new file
            $file = $request->image;
            $filename = time()."_".$file->getClientOriginalName();
            $file->move($path, $filename);

            //for update in table
            $data->update(['image' => $filename]);
        }else{
            $usersImage = public_path("images/campign/{$data->image}"); // get previous image from folder
                    if (File::exists($usersImage)) { // unlink or remove previous image from folder
                        unlink($usersImage);
                        
                    } 
                    $file = $request->image;
                        $name = time() . '-' . $file->getClientOriginalName();
                        $file = $file->move(('images/campign/'), $name);
                        $data->image= $name;
                        $data->save();
        }
           Session::flash('message', 'update');
           return redirect()->route('data-campign.index');
       }    
    
}