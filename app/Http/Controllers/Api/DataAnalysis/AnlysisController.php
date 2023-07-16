<?php

namespace App\Http\Controllers\Api\DataAnalysis;

use App\Http\Controllers\Controller;
use App\Models\AiDisease;
use App\Models\Growth;
use App\Models\MedicalDetail;
use App\Models\medicalTest;
use App\Models\Prescription;
use App\Models\Teeth;
use App\Models\TeethDevelopment;
use App\Models\User;
use App\Models\UserVaccination;
use App\Models\Vaccination;
use function Symfony\Component\Translation\t;

class AnlysisController extends Controller
{

    public function users(){

        $users = User::all();

        foreach ($users as $user){
            $user->photo = asset('images/users/'.$user->photo);
        }

        return response()->json($users);

    }


    public function vaccinations(){

        $vaccines = Vaccination::all();

        return response()->json($vaccines);

    }



    public function user_vaccinations(){

        $vaccines = UserVaccination::all();

        return response()->json($vaccines);

    }

    public function medical_datails(){

        $medical_details = MedicalDetail::all();

        return response()->json($medical_details);

    }

    public function growth(){

        $growth = Growth::all();

        return response()->json($growth);

    }


    public function ai_diseases(){

        $predictions = AiDisease::all();


            foreach ($predictions as $prediction){

                if($prediction->prediction ==1){
                    $prediction->prediction = 'مصاب';
                }else{
                    $prediction->prediction = 'غير مصاب';
                }

                $prediction->disease_photo = asset('images/diseases/'.$prediction->disease_photo);

            }

        return response()->json($predictions);

    }



    public function teeth(){

        $teeth = Teeth::all();

        return response()->json($teeth);
    }


    public function user_teeth(){

        $teethDev = TeethDevelopment::all();

        return response()->json($teethDev);
    }


    public function prescription(){

        $pres = Prescription::all();

        foreach ($pres as $pre){

            $pre->file = asset('images/prescriptions/'.$pre->file);
        }
        return response()->json($pres);
    }



    public function medical_tests(){

        $tests = medicalTest::all();

        foreach ($tests as $test){

            $test->lab_file = asset('images/tests/'.$test->lab_file);
        }


        return response()->json($tests);
    }

}
