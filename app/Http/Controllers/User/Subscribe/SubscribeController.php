<?php

namespace App\Http\Controllers\User\Subscribe;

use App\Models\Program;
use App\Models\Nutrition;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscribeController extends Controller
{
    // public function __construct(){
    //     $this->middleware('auth')->only('store');
    // }
    public function __invoke(Program $program)
    {
        if ($program['remain_place'] < 1) {
            return redirect()->back()->with('error', 'no free place to subscribe');
        }

        $userHistorys = Subscribe::where('user_id', auth()->user()->id)->get();
        $currentTime = new \DateTime();

        foreach ($userHistorys as $userHistory) {
            // Calculate the end date of the current subscription
            $endDate = (clone $userHistory->created_at)->add(new \DateInterval('P' . $userHistory->program->duration . 'M'));

            // Check if the subscription is still active
            if ($endDate > $currentTime) {
                return redirect()->back()->with('error', 'You are already subscribed to a program.');
            }
        }
        $nutrition=Nutrition::create(['user_id' => auth()->user()->id, 'program_id' => $program->id,'plan'=> json_encode([])]);
        Subscribe::create(['user_id' => auth()->user()->id,'nutrition_id'=>$nutrition->id, 'program_id' => $program->id,'to' => (new \DateTime())->modify('+' . $program->duration . ' months')]);
        $program->remain_place--;
        $program->save();
        return redirect()->back()->with('success', 'you subscribe successfully');
        // return redirect()->back()->with('success', 'test');
    }

}
