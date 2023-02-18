<?php

namespace App\Http\Controllers\Dashboard\DevelopmentFollow;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SubjectController extends Controller
{

    public function index()
    {

            $subjects = Subject::all();

        return view('dashboard.development.subjects.index',compact('subjects'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|unique:subjects,name'
        ]);

        Subject::create([
            'name'=>$request->name
        ]);



        session()->flash('success','تم اضافة الموضوع بنجاح');
        return back();


    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {



    }


    public function update(Request $request, $id)
    {

        $request->validate([
            'name'=>'required|string|unique:subjects,name,'.$id
        ]);

        $subject = Subject::find($id);

        $subject->update([
            'name'=>$request->name
        ]);



        session()->flash('success','تم تحديث البيانات بنجاح');
        return back();
    }


    public function destroy($id)
    {
        Subject::destroy($id);

        session()->flash('success','تم حدف الموضوع بنجاح');
        return back();
    }
}
