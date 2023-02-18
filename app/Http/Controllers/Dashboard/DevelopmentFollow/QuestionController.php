<?php

namespace App\Http\Controllers\Dashboard\DevelopmentFollow;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    public function index()
    {

        $questions = Question::all();

        $subjects = Subject::all();

        return view('dashboard.development.questions.index',compact('questions','subjects'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {

        $request->validate([
            'questions.*.question'=>'required|string|unique:questions,question',
            'questions.*.subject'=>'required',
            'questions.*.age_stage'=>'required|numeric',
        ]);

        $questions =  $request->get('questions');


        try {

            $Question = new Question();
            foreach($request->questions as $question){

//                return $question['age_stage'];

                $Question->create([
                    'question'=>$question['question'],
                    'subject_id'=>$question['subject'],
                    'age_stage'=>$question['age_stage']
                ]);


            }

            session()->flash('success','تم حفظ البيانات بنجاح');
            return back();
        }

        catch (\Exception $e){
            session()->flash('error','حدث خطاء ما');
            return back();
        }


    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {

//        return $request;
        $request->validate([
            'question'=>'required|string|unique:questions,question,'.$id,
            'subject'=>'required',
            'age_stage'=>'required|numeric',
        ]);


        $question = Question::find($id);

        $question->update([
            'question'=>$request->question,
            'subject_id'=>$request->subject,
            'age_stage'=>$request->age_stage,
        ]);

        session()->flash('success','تم تحديث البيانات بنجاح');

        return back();
    }


    public function destroy($id)
    {
        Question::destroy($id);

        session()->flash('success','تم حذف السؤال بنجاح');
        return back();
    }
}
