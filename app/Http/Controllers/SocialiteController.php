<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function facebookLogin()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function redirectToFacebook()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            dd($user);
            $findUser = User::where('social_id', $user->id)->first();
            if ($findUser) {
                Auth::login($findUser);
                return response()->json($findUser);
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'social_id' => $user->id,
                    'social_type' => 'facebook',
                    'password' => Hash::make('facebook'),
                ]);
                Auth::login($newUser);
                return response()->json($newUser);
            }
        } catch (Exception $th) {

            dd($th->getMessage());
        }
    }
}
