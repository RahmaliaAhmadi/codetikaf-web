<?php

namespace App\Http\Controllers\Sprint2;

use App\Http\Controllers\Controller;
use App\Models\TblQuestionAnswers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FaqController extends Controller
{
    public function index()
    {
        $data = TblQuestionAnswers::paginate(10);
        $question = TblQuestionAnswers::where('question_id',null)->get();
        return view('sprint2.faq',compact('data','question'));
    }

    public function store(Request $request)
    {
        $type = $request->input('type');
        $question_id = $request->input('question_id');
        $contentQuestion = $request->input('contentQuestion');
        $contentAnswer = $request->input('contentAnswer');
        $data = new TblQuestionAnswers();
        if($type == 1){
            $data->question_id = null;
            $data->content =  $contentQuestion;
            
        }else{
            $data->question_id = $question_id;
            $data->content =  $contentAnswer;
        }
        if($data->content == null){
            Session::flash('message', 'dataEmpty');
            return back();

        }
        $data->save();
        Session::flash('message', 'insert');
        return redirect()->route('data-faq.index');
    }

    public function edit($id)
    {
        $data = TblQuestionAnswers::find($id);
        if($data->question_id != null){
            $data->questions = $data->question->content;
            $data->answer = $data->content;
        }else{
            $data->answer = "";
            $data->questions = $data->content;
        }
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $type = $request->input('type');
        $question_id = $request->input('question_id');
        $contentQuestion = $request->input('contentQuestion');
        $contentAnswer = $request->input('contentAnswer');
        $data = TblQuestionAnswers::find($id);
        $data->question_id = $question_id;
        if($type == 1){
            $data->question_id = null;
            $data->content =  $contentQuestion;
        }else{
            $data->question_id = $question_id;
            $data->content =  $contentAnswer;
        }
        $data->save();
        Session::flash('message', 'update');
        return redirect()->route('data-faq.index');
    }

    public function destroy(Request $request, $id)
    {
        $ids = $request->input('check');
        $alls = $request->input('select-all');
        if($alls == 0){
            foreach ($ids as $deletes) {
                $data = TblQuestionAnswers::where('id', $deletes)->first();
                $data->delete();
            }
        }
        else if($alls == 1){
            $datas = TblQuestionAnswers::all();
            foreach ($datas as $data){
                $data->delete();
            }
        }
        Session::flash('message', 'delete');
        return redirect()->route('data-faq.index');
    }

   
    
}
