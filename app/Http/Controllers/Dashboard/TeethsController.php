<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Teeth;
use Illuminate\Http\Request;

class TeethsController extends Controller
{

    public function index()
    {
        $teeths = Teeth::get();

        return view('dashboard.teeth.index',compact('teeths'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|unique:teeths,name',
            'start'=>'required|numeric',
            'end'=>'required|numeric|gt:start',

        ]);

        Teeth::create([
            'name'=>$request->name,
            'month_start'=>$request->start,
            'month_end'=>$request->end,
        ]);



        session()->flash('success','تم اضافة السينة الطبية بنجاح');
        return back();
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

        $request->validate([
            'name'=>'required|string|unique:teeths,name,'.$id,
            'start'=>'required|numeric',
            'end'=>'required|numeric|gt:start',

        ]);

        $teeth = Teeth::find($id);

        $teeth->update([
            'name'=>$request->name,
            'month_start'=>$request->start,
            'month_end'=>$request->end,
        ]);



        session()->flash('success','تم تحديث البيانات بنجاح');
        return back();
    }


    public function destroy($id)
    {
        Teeth::destroy($id);

        session()->flash('success','تم الحذف  بنجاح');
        return back();
    }
}
