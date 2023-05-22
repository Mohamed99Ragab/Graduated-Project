<?php

namespace App\Http\Controllers\Api\Growth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Growth\StoreGrowthRequest;
use App\Http\Traits\ChildTrait;
use App\Http\Traits\HttpResponseJson;
use App\Models\Growth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GrowthController extends Controller
{
    use ChildTrait , HttpResponseJson;
    private $weight_status;
    private $height_status;


    public function index()
    {
        $growth = Growth::where('user_id',Auth::guard('api')->id())->get();

        if(isset($growth) && $growth->count() > 0){

            return $this->responseJson($growth,null,true);
        }
        return $this->responseJson($growth,'لا يوجد سجل مرضي خاص بنمو الطفل حتى الان',true);
    }

    public function getGrowthById($id)
    {
        $growth = Growth::find($id);

        if(!empty($growth)){

            return $this->responseJson($growth,null,true);
        }
        return $this->responseJson($growth,'لا يوجد نمو بهذا المعرف',false);
    }



    public function calcRangeGrowchOfChild()
    {
        $user = User::find(Auth::guard('api')->id());

        $ages =  $this->calc_child_age($user->birth_date,date_format(Carbon::now(),'Y-m-d'));
        $user_age =  $ages['months'];
        $user_ageOfYear =  $ages['years'];


        if($user_age == 0){


            $growth_range = [
                'weight_start'=>2.5,
                'weight_end'=>4,
                'height_start'=>49.1,
                'height_end'=> 49.9,
            ];

            return $this->responseJson($growth_range,null,true);





        }
        elseif ($user_age == 1)
        {

            $growth_range = [
                'weight_start'=>4.2,
                'weight_end'=>4.5,
                'height_start'=>53.7,
                'height_end'=> 54.7,
            ];

            return $this->responseJson($growth_range,null,true);


        }
        elseif ($user_age == 2)
        {

            $growth_range = [
                'weight_start'=>5.1,
                'weight_end'=>5.6,
                'height_start'=>57.1,
                'height_end'=> 58.4,
            ];

            return $this->responseJson($growth_range,null,true);


        }
        elseif ($user_age == 3)
        {

            $growth_range = [
                'weight_start'=>5.8,
                'weight_end'=>6.4,
                'height_start'=>59.8,
                'height_end'=> 61.4,
            ];

            return $this->responseJson($growth_range,null,true);



        }
        elseif ($user_age == 4)
        {

            $growth_range = [
                'weight_start'=>6.4,
                'weight_end'=>7,
                'height_start'=>62.1,
                'height_end'=> 63.9,
            ];

            return $this->responseJson($growth_range,null,true);

        }
        elseif ($user_age == 5)
        {

            $growth_range = [
                'weight_start'=>6.9,
                'weight_end'=>7.5,
                'height_start'=>64,
                'height_end'=> 65.9,
            ];

            return $this->responseJson($growth_range,null,true);


        }
        elseif ($user_age == 6)
        {
            $growth_range = [
                'weight_start'=>7.3,
                'weight_end'=>7.9,
                'height_start'=>65.7,
                'height_end'=> 67.9,
            ];

            return $this->responseJson($growth_range,null,true);


        }
        elseif ($user_age == 7)
        {

            $growth_range = [
                'weight_start'=>7.6,
                'weight_end'=>8.3,
                'height_start'=>67.3,
                'height_end'=> 69.2,
            ];

            return $this->responseJson($growth_range,null,true);

        }
        elseif ($user_age == 8)
        {
            $growth_range = [
                'weight_start'=>7.9,
                'weight_end'=>8.6,
                'height_start'=>68.7,
                'height_end'=> 70.6,
            ];

            return $this->responseJson($growth_range,null,true);


        }
        elseif ($user_age == 9)
        {
            $growth_range = [
                'weight_start'=>8.2,
                'weight_end'=>8.9,
                'height_start'=>70.1,
                'height_end'=> 72,
            ];

            return $this->responseJson($growth_range,null,true);


        }
        elseif ($user_age == 10)
        {
            $growth_range = [
                'weight_start'=>8.5,
                'weight_end'=>9.2,
                'height_start'=>71.5,
                'height_end'=> 73.3,
            ];

            return $this->responseJson($growth_range,null,true);


        }
        elseif ($user_age == 11)
        {
            $growth_range = [
                'weight_start'=>8.7,
                'weight_end'=>9.4,
                'height_start'=>72.8,
                'height_end'=> 74.5,
            ];

            return $this->responseJson($growth_range,null,true);


        }
        elseif ($user_age == 12)
        {
            $growth_range = [
                'weight_start'=>8.9,
                'weight_end'=>9.6,
                'height_start'=>74,
                'height_end'=> 75.7,
            ];

            return $this->responseJson($growth_range,null,true);


        }
        elseif ($user_ageOfYear == 2)
        {
            $growth_range = [
                'weight_start'=>10,
                'weight_end'=>15.2,
                'height_start'=>86.2,
                'height_end'=> 87.7,
            ];

            return $this->responseJson($growth_range,null,true);


        }
        elseif ($user_ageOfYear == 3)
        {
            $growth_range = [
                'weight_start'=>11.6,
                'weight_end'=>18,
                'height_start'=>94.2,
                'height_end'=> 95.3,
            ];

            return $this->responseJson($growth_range,null,true);


        }
        elseif ($user_ageOfYear == 4)
        {
            $growth_range = [
                'weight_start'=>13,
                'weight_end'=>21,
                'height_start'=>101,
                'height_end'=> 102.5,
            ];

            return $this->responseJson($growth_range,null,true);


        }
        elseif ($user_ageOfYear == 5)
        {
            $growth_range = [
                'weight_start'=>14.3,
                'weight_end'=>23.8,
                'height_start'=>108,
                'height_end'=> 109.2,
            ];

            return $this->responseJson($growth_range,null,true);


        }
        else{
            return $this->responseJson('عمر طفلك يتجاوز خمسة سنوات لذالك لا يمكننا تحديد متوسط الطول و الوزن لديه ',null,false);

        }

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

    public function updateGrowth(StoreGrowthRequest $request , $growth_id)
    {

        $growth = Growth::find($growth_id);
        if(!empty($growth)){

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

                $growth->update([
                    'weight'=>$request->weight,
                    'height'=>$request->height,
                    'weight_status'=>$this->weight_status,
                    'height_status'=>$this->height_status,
                    'measure_date'=>$request->measure_date
                ]);

                return $this->responseJson($growth,'تم التعديل بنجاح',true);


            }

            return $this->responseJson(null,'يجب الا يتجاوز عمر طفلك من وقت قياس وزنه و طوله عمر 5 سنوات',false);



        }

        return $this->responseJson(null,'لا يوجد نمو بهذا المعرف',false);



    }




}
