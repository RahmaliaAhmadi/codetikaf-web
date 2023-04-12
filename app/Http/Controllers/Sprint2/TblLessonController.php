<?php

namespace App\Http\Controllers\Sprint2;

use App\Http\Controllers\Controller;
use App\Models\MasterLessonCategories;
use App\Models\TblLessons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class TblLessonController extends Controller
{
    public function index()
    {
        $data = TblLessons::paginate(10);
        $package = MasterLessonCategories::all();
        $table = TblLessons::table();
        $toggle1 = 'is_recommended';
        $filter_status = 0;
        $filter = 'filter';
        return view('sprint2.lesson', compact('data', 'package','table','toggle1','filter_status','filter'));
    }

    public function store(Request $request)
    {
        $category_id = $request->input('category_id');
        $title = $request->input('title');
        $speaker = $request->input('speaker');
        $url_youtube = $request->input('url_youtube');
        $description = $request->input('description');
        if($description == null){
            Session::flash('message', 'dataEmpty');
            return back();

        }
        $is_recommended = $request->input('is_recommended');
        if ($request->file('poster_horizontal')->isValid() && $request->file('poster_vertical')->isValid()) {
            $image_name_vertical = time() . "_" . $request->file('poster_vertical')->getClientOriginalName();
            $image_name_horizontal = time() . "_" . $request->file('poster_horizontal')->getClientOriginalName();
            $path = 'images/kajian';
            $request->file('poster_horizontal')->move($path, $image_name_vertical);
            $request->file('poster_vertical')->move($path, $image_name_horizontal);
            $data = new TblLessons();
            $data->category_id = $category_id;
            $data->title = $title;
            $data->speaker = $speaker;
            $data->url_youtube = $url_youtube;
            $data->poster_horizontal = $image_name_horizontal;
            $data->poster_vertical = $image_name_vertical;
            $data->description = $description;
            $data->is_recommended = $is_recommended;
        }
        $data->save();
        Session::flash('message', 'insert');
        return redirect()->route('data-kajian.index');
    }

    public function edit($id)
    {
        $data = TblLessons::find($id);
        $data->category_name = $data->category->name;
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $category_id = $request->input('category_id');
        $title = $request->input('title');
        $speaker = $request->input('speaker');
        $url_youtube = $request->input('url_youtube');
        $description = $request->input('description');
        if($description == null){
            Session::flash('message', 'dataEmpty');
            return back();

        }
        $data = TblLessons::find($id);
        $data->category_id = $category_id;
        $data->title = $title;
        $data->speaker = $speaker;
        $data->url_youtube = $url_youtube;
        $data->description = $description;
        $data->save();
        Session::flash('message', 'update');
        return redirect()->route('data-kajian.index');
    }

    public function destroy(Request $request, $id)
    {
        $ids = $request->input('check');
        $alls = $request->input('select-all');
        if ($alls == 0) {
            foreach ($ids as $deletes) {
                $data = TblLessons::where('id', $deletes)->first();
                $usersImage_horizontal = public_path("images/kajian/{$data->poster_horizontal}");
                unlink($usersImage_horizontal);
                $usersImage_vertical = public_path("images/kajian/{$data->poster_vertical}");
                unlink($usersImage_vertical);
                $data->delete();
            }
        } else if ($alls == 1) {
            $datas = TblLessons::all();
            foreach ($datas as $data) {
                $usersImage_horizontal = public_path("images/kajian/{$data->poster_horizontal}");
                unlink($usersImage_horizontal);
                $usersImage_vertical = public_path("images/kajian/{$data->poster_vertical}");
                unlink($usersImage_vertical);
                $data->delete();
            }
        }
        Session::flash('message', 'delete');
        return redirect()->route('data-kajian.index');
    }

    public function upload_image(Request $request){
        $id = $request->input('id');
        $data = TblLessons::where('id',$id)->first();
        if($request->poster_horizontal == ''){        
            $path = public_path().'/images/kajian/';

            //upload new file
            $file = $request->poster_horizontal;
            $filename = time()."_".$file->getClientOriginalName();
            $file->move($path, $filename);

            //for update in table
            $data->update(['poster_horizontal' => $filename]);
        }else{
            $usersImage = public_path("images/kajian/{$data->poster_horizontal}"); // get previous image from folder
                    if (File::exists($usersImage)) { // unlink or remove previous image from folder
                        unlink($usersImage);
                        
                    } 
                    $file = $request->poster_horizontal;
                        $name = time() . '-' . $file->getClientOriginalName();
                        $file = $file->move(('images/kajian/'), $name);
                        $data->poster_horizontal= $name;
                        $data->save();
        }
           Session::flash('message', 'update');
           return redirect()->route('data-kajian.index');
       }  
       
       public function upload_image_vertical(Request $request){
        $id = $request->input('id');
        $data = TblLessons::where('id',$id)->first();
        if($request->poster_vertical == ''){        
            $path = public_path().'/images/kajian/';

            //upload new file
            $file = $request->poster_vertical;
            $filename = time()."_".$file->getClientOriginalName();
            $file->move($path, $filename);

            //for update in table
            $data->update(['poster_vertical' => $filename]);
        }else{
            $usersImage = public_path("images/kajian/{$data->poster_vertical}"); // get previous image from folder
                    if (File::exists($usersImage)) { // unlink or remove previous image from folder
                        unlink($usersImage);
                        
                    } 
                    $file = $request->poster_vertical;
                        $name = time() . '-' . $file->getClientOriginalName();
                        $file = $file->move(('images/kajian/'), $name);
                        $data->poster_vertical= $name;
                        $data->save();
        }
           Session::flash('message', 'update');
           return redirect()->route('data-kajian.index');
       }    

    public function filter(Request $request)
    {
        $table = TblLessons::table();
        $sortinput = $request->input('sortinput');
        $selectinput = $request->input('selectinput');
        $datas = TblLessons::query();
        if ($request->input('tipe') == 'filter') {
            if ($selectinput != null) {
                $datas->where('category_id', $selectinput);
            }
            if ($sortinput != null) {
                $datas->where('is_recommended', $sortinput);
            }
        } 
        $data = $datas->paginate(10);
      
        if ($selectinput != null) {
            $data->appends(['selectinput' => $selectinput]);
        }
        if ($sortinput != null) {
            $data->appends(['sortinput' => $sortinput]);
        }
        if ($request->input('tipe') == 'filter') {
            $data->appends(['tipe' => 'filter']);
        }
        $package = MasterLessonCategories::all();
        $filters = array();
        $filters[0] = $selectinput;
        $filters[1] = $sortinput;
        $toggle1 = 'is_recommended';
        $filter = 'filter';
        $filter_status = 1;
        return view('sprint2.lesson', compact('data', 'package','table','toggle1','filter_status','filter','filters'));
    }
}
