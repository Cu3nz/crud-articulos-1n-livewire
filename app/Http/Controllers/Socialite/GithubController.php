<?php

namespace App\Http\Controllers\Socialite;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GithubController extends Controller
{
    //


    public function redirect(){

        return Socialite::driver('github')->redirect();
        
    }



    public function callback(){

        $githubUser = Socialite::driver('github')->user();
 
        $user = User::updateOrCreate([
            'provider_id' => $githubUser->id, //? Nombre de la varaible cambiado
        ], [
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'provider_name' => 'github', //? Variable añadida
            'provider_token' => $githubUser->token, //? Nombre de la variable cambiado
            'provider_refresh_token' => $githubUser->refreshToken, //? Nombre de la variable cambiado
        ]);
     
        Auth::login($user);
     
        return redirect('/dashboard');

    }




}
