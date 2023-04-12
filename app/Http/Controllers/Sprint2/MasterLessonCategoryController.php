<?php

namespace App\Http\Controllers\Sprint2;

use App\Http\Controllers\Controller;
use App\Models\MasterLessonCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MasterLessonCategoryController extends Controller
{
    public function index()
    {
        $data = MasterLessonCategories::paginate(10);
        return view('sprint2.category',compact('data'));
    }

    public function store(Request $request)
    {
        $name = $request->input('name');
        $data = new MasterLessonCategories();
        $data->name =  $name;
        $data->save();
        Session::flash('message', 'insert');
        return redirect()->route('data-tema.index');
    }

    public function edit($id)
    {
        $data = MasterLessonCategories::find($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $name = $request->input('name');
        $data = MasterLessonCategories::find($id);
        $data->name = $name;
        $data->save();
        Session::flash('message', 'update');
        return redirect()->route('data-tema.index');
    }

    public function destroy(Request $request, $id)
    {
        $ids = $request->input('check');
        $alls = $request->input('select-all');
        if($alls == 0){
            foreach ($ids as $deletes) {
                $data = MasterLessonCategories::where('id', $deletes)->first();
                $data->delete();
            }
        }
        else if($alls == 1){
            $datas = MasterLessonCategories::all();
            foreach ($datas as $data){
                $data->delete();
            }
        }
        Session::flash('message', 'delete');
        return redirect()->route('data-tema.index');
    }

   
    
}
