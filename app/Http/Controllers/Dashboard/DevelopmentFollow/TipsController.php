<?php

namespace App\Http\Controllers\Dashboard\DevelopmentFollow;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Subject;
use App\Models\Tips;
use Illuminate\Http\Request;

class TipsController extends Controller
{

    public function index()
    {

        $tips = Tips::all();


        return view('dashboard.development.tips.index',compact('tips'));
    }


    public function create()
    {

        $questions = Question::get();

        return view('dashboard.development.tips.create',compact('questions'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'question_ids'=>'required|array',
            'description'=>'required'

        ]);

        $question_ids = $request->question_ids;
        $description = $request->description;


        //store description of tips in table tips

       $tips =  Tips::create([
            'description'=>$description
        ]);

       // attach question ids to tips in table question_tips

        $tips->questions()->sync($question_ids);


        session()->flash('success','تم حفظ البيانات بنجاح');

        return redirect()->route('tips.index');



    }


    public function show($id)
    {
        $tip = Tips::find($id);

        $questions = $tip->questions;

        return view('dashboard.development.tips.show_questions_of_tip',compact('questions'));

    }


    public function edit($id)
    {


        $tip = Tips::find($id);

        $tips_questions = $tip->questions;
        $all_questions = Question::get();


        return view('dashboard.development.tips.edit',compact('tip','all_questions','tips_questions'));
    }


    public function update(Request $request, $id)
    {
        $tip = Tips::find($id);
        $question_ids = $request->question_ids;



        $tip->update([
            'description'=>$request->description,
        ]);

        $tip->questions()->sync($question_ids);


        session()->flash('success','تم تحديث البيانات بنجاح');

        return redirect()->route('tips.index');


    }


    public function destroy($id)
    {
        Tips::destroy($id);

        session()->flash('success','تم الحدف  بنجاح');
        return back();
    }
}
