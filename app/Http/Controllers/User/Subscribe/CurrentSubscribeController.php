<?php

namespace App\Http\Controllers\User\Subscribe;

use App\Models\Subscribe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CurrentSubscribeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
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

                return view('front.subscribe.currentSubscribe', ['subscription' => $userHistory,'daysLeft' => $daysLeft,]);
            }
        }
        return view('front.subscribe.currentSubscribe');
    }
}
