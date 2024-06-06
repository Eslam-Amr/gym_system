<?php

namespace App\Http\Controllers\Admin\Subscriber;

use Carbon\Carbon;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriberController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $currentDate = Carbon::now();
$subscribers=Subscribe::where('to','>',$currentDate)->paginate();
// dd($subscriber);
        return view('admin.subscriber.index',compact('subscribers'));
    }
}
