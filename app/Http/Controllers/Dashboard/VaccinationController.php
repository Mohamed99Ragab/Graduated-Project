<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Traits\FilesManagement;
use App\Models\Vaccination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VaccinationController extends Controller
{

    use FilesManagement;

    public function index()
    {

        $vaccinations = Vaccination::all();

        return view('dashboard.vaccinations.index',compact('vaccinations'));
    }


    public function create()
    {

        return view('dashboard.vaccinations.create');

    }


    public function store(Request $request)
    {


        $request->validate([
            'name'=>'required|string',
            'number_syringe'=>'required|numeric',
            'vaccine_age'=>'required|numeric',
            'important'=>'required|in:0,1',
            'about'=>'required|string',
            'disease_prevention'=>'required|string',
            'side_effects'=>'required|string',

        ]);

        Vaccination::create([
            'name'=>trim($request->name),
            'number_syringe'=>$request->number_syringe,
            'vaccine_age'=>$request->vaccine_age,
            'important'=>$request->important,
            'about'=>trim($request->about),
            'disease_prevention'=>trim($request->disease_prevention),
            'side_effects'=>trim($request->side_effects),
            'image'=>$request->file('image') ? $request->file('image')->hashName() :null

        ]);

        //upload vaccine image on server if found
        $this->uploadImage($request->file('image'),'vaccinations','images');


        session()->flash('success','تم اضافة التطعيم بنجاح');


        return back();





    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {

        $vaccine = Vaccination::findOrfail($id);


        return view('dashboard.vaccinations.edit',compact('vaccine'));
    }


    public function update(Request $request,$id)
    {
        $request->validate([
            'name'=>'required|string',
            'number_syringe'=>'required|numeric',
            'vaccine_age'=>'required|numeric',
            'important'=>'required|in:0,1',
            'about'=>'required|string',
            'disease_prevention'=>'required|string',
            'side_effects'=>'required|string',

        ]);


        $vaccine = Vaccination::find($id);

        if($request->file('image')){
            Storage::disk('images')->delete('vaccinations/'.$vaccine->image);
        }


        $vaccine->update([
            'name'=>trim($request->name),
            'number_syringe'=>$request->number_syringe,
            'vaccine_age'=>$request->vaccine_age,
            'important'=>$request->important,
            'about'=>trim($request->about),
            'disease_prevention'=>trim($request->disease_prevention),
            'side_effects'=>trim($request->side_effects),
            'image'=>$request->file('image') ? $request->file('image')->hashName() :$vaccine->image

        ]);

        //upload vaccine image on server if found
        $this->uploadImage($request->file('image'),'vaccinations','images');


        session()->flash('success','تم تحديث البيانات بنجاح');


        return redirect()->route('vaccinations.index');
    }


    public function destroy($id)
    {
        Vaccination::destroy($id);

        session()->flash('success','تم حذف التطعيم بنجاح');

        return back();
    }
}
