<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin/dashboard');
    }

    public function uploadLatex(Request $request)
    {
        if ($request->hasFile('upload')) {
            $images = $request->file('upload');
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = 'ckeditor_' . time() . '.' . $extension;
            $url_image = 'images/ckeditor';

            $request->file('upload')->move($url_image, $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = 'images/ckeditor/' . $fileName;
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }

    public function switchShow(Request $request)
    {
        $show =  $request->input('shows');
        $table = $request->input('table');
        $toggle = $request->input('toggle');
        DB::table($table)->where('id', $show)
            ->update([$toggle => 1]);
        Session::flash('message', 'update');
        return back();
    }

    public function switchHide(Request $request)
    {
        $hide =  $request->input('hides');
        $table = $request->input('table');
        $toggle = $request->input('toggle');
            DB::table($table)->where('id', $hide)
                ->update([$toggle => 0]);
        Session::flash('message', 'update');
        return back();
    }
}
