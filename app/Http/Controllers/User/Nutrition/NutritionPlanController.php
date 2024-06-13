<?php

namespace App\Http\Controllers\User\Nutrition;

use App\Models\Subscribe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NutritionPlanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('__invoke');
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $userHistorys = Subscribe::where('user_id', auth()->user()->id)->get();
        $currentTime = new \DateTime();

        foreach ($userHistorys as $userHistory) {
            // Calculate the end date of the current subscription
            $endDate = (clone $userHistory->created_at)->add(new \DateInterval('P' . $userHistory->program->duration . 'M'));

            // Check if the subscription is still active
            if ($endDate > $currentTime) {
                $interval = $currentTime->diff($endDate);
                $daysLeft = $interval->days;
$plan=json_decode($userHistory->nutrition->plan,true);

return view('front.nutrition.index',['plan'=>$plan]);
                // return view('front.subscribe.currentSubscribe', ['subscription' => $userHistory,'daysLeft' => $daysLeft,]);
            }
        }
    }
}
