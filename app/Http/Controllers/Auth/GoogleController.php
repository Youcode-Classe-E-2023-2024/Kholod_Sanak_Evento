<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class GoogleController extends Controller
{
    public function redirect(){
//        return Socialite::driver('google')->stateless()->redirect();
        return Socialite::driver('google')->redirect();

    }

    public function  callbackGoogle(){
        $google_user = Socialite::driver('google')->user();
        //check if this user is in our DB
        $user= User::where('google_id', $google_user->getId())->first();
        if(! $user){
            $new_user= User::create ([
                'name' => $google_user->getName(),
                'email' => $google_user->getEmail(),
                'google_id'=> $google_user->getId()
            ]);
            Auth::login($new_user);
            return redirect('/')->with('success', 'Login successful!');
        }
        else{
            Auth::login($user);
            return redirect('/')->with('success', 'Login successful!');
        }
    }
}
