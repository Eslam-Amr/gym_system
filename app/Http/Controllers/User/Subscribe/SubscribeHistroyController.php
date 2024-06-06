<?php

namespace App\Http\Controllers\User\Subscribe;

use App\Models\Subscribe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscribeHistroyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $userHistorys = Subscribe::where('user_id', auth()->user()->id)->get();
    return view('front.subscribe.history',get_defined_vars());
    }
}
