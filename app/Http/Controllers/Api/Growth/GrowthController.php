<?php

namespace App\Http\Controllers\Api\Growth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Growth\StoreGrowthRequest;
use App\Http\Traits\ChildTrait;
use App\Http\Traits\HttpResponseJson;
use App\Models\Growth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GrowthController extends Controller
{
    use ChildTrait , HttpResponseJson;
    public $weight_status;
    public $height_status;

    public function index()
    {
        $growth = Growth::where('user_id',Auth::guard('api')->id())->get();

        if(isset($growth) && $growth->count() > 0){

            return $this->responseJson($growth,null,true);
        }
        return $this->responseJson($growth,'لا يوجد سجل مرضي خاص بنمو الطفل حتى الان',true);
    }



    public function calcGrowth(StoreGrowthRequest $request)
    {


        $user = User::find(Auth::guard('api')->id());

       $ages =  $this->calc_child_age($user->birth_date,$request->measure_date);
       $user_age =  $ages['months'];

        $user_ageOfYear =  $ages['years'];

        if ($user_age >= 0 && $user_age<= 60){

            if($user_age == 0){

                if($request->weight >= 2.5 && $request->weight <= 4){
                    $this->weight_status = 'وزن الطفل طبيعي';

                }elseif ($request->weight < 2.5)
                {
                    $this->weight_status = 'نقص في وزن الطفل';
                } else{
                    $this->weight_status = 'زيادة في وزن الطفل';

                }


                if($request->height >= 49.1 && $request->height <= 49.9){
                    $this->height_status = 'قامة الطفل طبيعي';

                }elseif ($request->height < 49.1){
                    $this->height_status = 'قامة الطفل قصيرة';
                }

                else{
                    $this->height_status = 'قامة الطفل طويلة';
                }

            }
            elseif ($user_age == 1)
            {
                if($request->weight >= 4.2 && $request->weight <= 4.5){
                    $this->weight_status = 'وزن الطفل طبيعي';

                }elseif ($request->weight < 4.2)
                {
                    $this->weight_status = 'نقص في وزن الطفل';
                }
                else{
                    $this->weight_status = 'ذيادة في وزن الطفل';

                }


                if($request->height >= 53.7 && $request->height <= 54.7){
                    $this->height_status = 'قامة الطفل طبيعي';

                }
                elseif($request->height < 53.7)
                {
                    $this->height_status = 'قامة الطفل قصيرة';

                }
                else{
                    $this->height_status = 'قامة الطفل طويلة';

                }
            }
            elseif ($user_age == 2)
            {
                if($request->weight >= 5.1 && $request->weight <= 5.6){
                    $this->weight_status = 'وزن الطفل طبيعي';

                }
                elseif ($request->weight < 5.1){
                    $this->weight_status = 'نقص في وزن الطفل';
                }
                else{
                    $this->weight_status = 'زيادة في وزن الطفل';

                }


                if($request->height >= 57.1 && $request->height <= 58.4){
                    $this->height_status = 'قامة الطفل طبيعي';

                }
                elseif ($request->height < 57.1){
                    $this->height_status = 'قامة الطفل قصيرة';
                }
                else{
                    $this->height_status = 'قامة الطفل طويلة';
                }
            }
            elseif ($user_age == 3)
            {
                if($request->weight >= 5.8 && $request->weight <= 6.4){
                    $this->weight_status = 'وزن الطفل طبيعي';

                }elseif ($request->weight < 5.8){
                    $this->weight_status = 'نقص في وزن الطفل';
                }

                else{
                    $this->weight_status = 'زيادة في وزن الطفل';

                }


                if($request->height >= 59.8 && $request->height <= 61.4){
                    $this->height_status = 'قامة الطفل طبيعي';

                }
                elseif ($request->height < 59.8)
                {
                    $this->height_status = 'قامة الطفل قصيرة';
                }
                else{
                    $this->height_status = 'قامة الطفل طويلة';

                }
            }
            elseif ($user_age == 4)
            {
                if($request->weight >= 6.4 && $request->weight <= 7){
                    $this->weight_status = 'وزن الطفل طبيعي';

                }
                elseif ($request->weight < 6.4){
                    $this->weight_status = 'نقص في وزن الطفل';

                }
                else{
                    $this->weight_status = 'زيادة في وزن الطفل';

                }


                if($request->height >= 62.1 && $request->height <= 63.9){
                    $this->height_status = 'قامة الطفل طبيعي';

                }
                elseif ($request->height < 62.1)
                {
                    $this->height_status = 'قامة الطفل قصيرة';

                }
                else{
                    $this->height_status = 'قامة الطفل طويلة';
                }
            }
            elseif ($user_age == 5)
            {
                if($request->weight >= 6.9 && $request->weight <= 7.5){
                    $this->weight_status = 'وزن الطفل طبيعي';

                }
                elseif ($request->weight < 6.9){
                    $this->weight_status = 'نقص في وزن الطفل';

                }
                else{
                    $this->weight_status = 'زيادة في وزن الطفل';

                }


                if($request->height >= 64 && $request->height <= 65.9){
                    $this->height_status = 'قامة الطفل طبيعي';

                }
                elseif ($request->height < 64)
                {
                    $this->height_status = 'قامة الطفل قصيرة';

                }
                else{
                    $this->height_status = 'قامة الطفل طويلة';

                }
            }
            elseif ($user_age == 6)
            {
                if($request->weight >= 7.3 && $request->weight <= 7.9){
                    $this->weight_status = 'وزن الطفل طبيعي';

                }
                elseif ($request->weight < 7.3)
                {
                    $this->weight_status = 'نقص في وزن الطفل';
                }
                else{
                    $this->weight_status = 'زيادة في وزن الطفل';

                }


                if($request->height >= 65.7 && $request->height <= 67.9){
                    $this->height_status = 'قامة الطفل طبيعي';

                }
                elseif ($request->height < 65.7)
                {
                    $this->height_status = 'قامة الطفل قصيرة';

                }
                else{
                    $this->height_status = 'قامة الطفل طويلة';

                }
            }
            elseif ($user_age == 7)
            {
                if($request->weight >= 7.6 && $request->weight <= 8.3){
                    $this->weight_status = 'وزن الطفل طبيعي';

                }
                elseif($request->weight < 7.6)
                {
                    $this->weight_status = 'نقص في وزن الطفل';
                }
                else{
                    $this->weight_status = 'زيادة في وزن الطفل';
                }


                if($request->height >= 67.3 && $request->height <= 69.2){
                    $this->height_status = 'قامة الطفل طبيعي';

                }
                elseif ($request->height < 67.3)
                {
                    $this->height_status = 'قامة الطفل قصيرة';
                }
                else
                {
                    $this->height_status = 'قامة الطفل طويلة';
                }
            }
            elseif ($user_age == 8)
            {
                if($request->weight >= 7.9 && $request->weight <= 8.6){
                    $this->weight_status = 'وزن الطفل طبيعي';

                }
                elseif($request->weight < 7.9)
                {
                    $this->weight_status = 'نقص في وزن الطفل';
                }
                else{
                    $this->weight_status = 'زيادة في وزن الطفل';
                }


                if($request->height >= 68.7 && $request->height <= 70.6){
                    $this->height_status = 'قامة الطفل طبيعي';

                }
                elseif ($request->height < 68.7)
                {
                    $this->height_status = 'قامة الطفل قصيرة';
                }
                else
                {
                    $this->height_status = 'قامة الطفل طويلة';
                }
            }
            elseif ($user_age == 9)
            {
                if($request->weight >= 8.2 && $request->weight <= 8.9){
                    $this->weight_status = 'وزن الطفل طبيعي';

                }
                elseif ($request->weight < 8.2)
                {
                    $this->weight_status = 'نقص في وزن الطفل';
                }
                else
                {
                    $this->weight_status = 'زيادة في وزن الطفل';
                }


                if($request->height >= 70.1 && $request->height <= 72){
                    $this->height_status = 'قامة الطفل طبيعي';

                }
                elseif ($request->height < 70.1)
                {
                    $this->height_status = 'قامة الطفل قصيرة';
                }
                else
                {
                    $this->height_status = 'قامة الطفل طويلة';
                }
            }
            elseif ($user_age == 10)
            {
                if($request->weight >= 8.5 && $request->weight <= 9.2){
                    $this->weight_status = 'وزن الطفل طبيعي';

                }
                elseif ($request->weight < 8.5)
                {
                    $this->weight_status = 'نقص في وزن الطفل';
                }
                else
                {
                    $this->weight_status = 'زيادة في وزن الطفل';
                }


                if($request->height >= 71.5 && $request->height <= 73.3){
                    $this->height_status = 'قامة الطفل طبيعي';

                }
                elseif ($request->height < 71.5)
                {
                    $this->height_status = 'قامة الطفل قصيرة';
                }
                else
                {
                    $this->height_status = 'قامة الطفل طويلة';
                }
            }
            elseif ($user_age == 11)
            {
                if($request->weight >= 8.7 && $request->weight <= 9.4){
                    $this->weight_status = 'وزن الطفل طبيعي';

                }
                elseif ($request->weight < 8.7)
                {
                    $this->weight_status = 'نقص في وزن الطفل';
                }
                else
                {
                    $this->weight_status = 'زيادة في وزن الطفل';
                }


                if($request->height >= 72.8 && $request->height <= 74.5){
                    $this->height_status = 'قامة الطفل طبيعي';

                }
                elseif ($request->height < 72.8)
                {
                    $this->height_status = 'قامة الطفل قصيرة';
                }
                else
                {
                    $this->height_status = 'قامة الطفل طويلة';
                }
            }
            elseif ($user_age == 12)
            {
                if($request->weight >= 8.9 && $request->weight <= 9.6){
                    $this->weight_status = 'وزن الطفل طبيعي';

                }
                elseif ($request->weight < 8.9)
                {
                    $this->weight_status = 'نقص في وزن الطفل';
                }
                else
                {
                    $this->weight_status = 'زيادة في وزن الطفل';
                }


                if($request->height >= 74 && $request->height <= 75.7){
                    $this->height_status = 'قامة الطفل طبيعي';

                }
                elseif ($request->height < 74)
                {
                    $this->height_status = 'قامة الطفل قصيرة';
                }
                else
                {
                    $this->height_status = 'قامة الطفل طويلة';
                }
            }
            elseif ($user_ageOfYear == 2)
            {
                if($request->weight >= 10 && $request->weight <= 15.2){
                    $this->weight_status = 'وزن الطفل طبيعي';

                }
                elseif ($request->weight < 10)
                {
                    $this->weight_status = 'نقص في وزن الطفل';
                }
                else
                {
                    $this->weight_status = 'زيادة في وزن الطفل';
                }


                if($request->height >= 86.2 && $request->height <= 87.7){
                    $this->height_status = 'قامة الطفل طبيعي';

                }
                elseif ($request->height < 86.2)
                {
                    $this->height_status = 'قامة الطفل قصيرة';
                }
                else
                {
                    $this->height_status = 'قامة الطفل طويلة';
                }
            }
            elseif ($user_ageOfYear == 3)
            {
                if($request->weight >= 11.6 && $request->weight <= 18){
                    $this->weight_status = 'وزن الطفل طبيعي';

                }
                elseif ($request->weight < 11.6)
                {
                    $this->weight_status = 'نقص في وزن الطفل';
                }
                else
                {
                    $this->weight_status = 'زيادة في وزن الطفل';
                }


                if($request->height >= 94.2 && $request->height <= 95.3){
                    $this->height_status = 'قامة الطفل طبيعي';

                }
                elseif ($request->height < 94.2)
                {
                    $this->height_status = 'قامة الطفل قصيرة';
                }
                else
                {
                    $this->height_status = 'قامة الطفل طويلة';
                }
            }
            elseif ($user_ageOfYear == 4)
            {
                if($request->weight >= 13 && $request->weight <= 21){
                    $this->weight_status = 'وزن الطفل طبيعي';

                }
                elseif ($request->weight < 13)
                {
                    $this->weight_status = 'نقص في وزن الطفل';
                }
                else
                {
                    $this->weight_status = 'زيادة في وزن الطفل';
                }


                if($request->height >= 101 && $request->height <= 102.5){
                    $this->height_status = 'قامة الطفل طبيعي';

                }
                elseif ($request->height < 101)
                {
                    $this->height_status = 'قامة الطفل قصيرة';
                }
                else
                {
                    $this->height_status = 'قامة الطفل طويلة';
                }
            }
            elseif ($user_ageOfYear == 5)
            {
                if($request->weight >= 14.3 && $request->weight <= 23.8){
                    $this->weight_status = 'وزن الطفل طبيعي';

                }
                elseif ($request->weight < 14.3)
                {
                    $this->weight_status = 'نقص في وزن الطفل';
                }
                else
                {
                    $this->weight_status = 'زيادة في وزن الطفل';
                }


                if($request->height >= 108 && $request->height <= 109.2){
                    $this->height_status = 'قامة الطفل طبيعي';

                }
                elseif ($request->height < 108)
                {
                    $this->height_status = 'قامة الطفل قصيرة';
                }
                else
                {
                    $this->height_status = 'قامة الطفل طويلة';
                }
            }

           $growth =  Growth::create([
                'weight'=>$request->weight,
                'height'=>$request->height,
                'user_id'=>Auth::guard('api')->id(),
                'weight_status'=>$this->weight_status,
                'height_status'=>$this->height_status,
                'measure_date'=>$request->measure_date
            ]);

            return $this->responseJson($growth,'تم حفظ البيانات بنجاح',true);


        }

       return $this->responseJson(null,'يجب الا يتجاوز عمر طفلك من وقت قياس وزنه و طوله عمر 5 سنوات',false);



    }




}
