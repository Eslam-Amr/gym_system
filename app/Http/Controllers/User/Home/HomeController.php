<?php

namespace App\Http\Controllers\User\Home;

use App\Models\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $programs=Program::get();
        return view('front.home.home',get_defined_vars());
    }
}
