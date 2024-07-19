<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Helpers\GeneralHelper;
use App\Models\Membership;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function redirectToGoogle() {
        return Socialite::driver("google")->redirect();
    }

    public function handleGoogleCallback() {
        return GeneralHelper::callbackSocial(env("SOCIAL_GOOGLE"), "google");
    }

    public function redirectToFacebook() {
        return Socialite::driver("facebook")->redirect();
    }

    public function handleFacebookCallback() {
        return GeneralHelper::callbackSocial(env("SOCIAL_FACEBOOK"), "facebook");
    }

    public function showLoginForm() {
        return view("auth.login");
    }

    public function login(Request $request) {
        $email = $request->email;
        $password = $request->password;

        $user = User::where(["email" => $email, "social_id" => null])->first();
        if($user && Hash::check($password, $user->password)) {
            Auth::login($user);
            return redirect("/");
        } 
        Session::flash('message', 'Username or password invalid!'); 
        return view('auth.login');
    }

    public function showRegistrationForm() {
        $data['memberships'] = Membership::all();

        return view("auth.register", $data);
    }

    public function register(Request $request) {
        $data['memberships'] = Membership::all();

        $name = $request->name;
        $membership_id = $request->membership_id;
        $email = $request->email;
        $password = $request->password;

        $user = User::where(["email" => $email, "social_id" => null])->first();
        if(!$user) {
            $user = User::create([
                "name" => $name, 
                "membership_id" => $membership_id, 
                "email" => $email,
                "password" => Hash::make($password)
            ]);
            if($user) {
                Auth::login($user);
                return redirect("/");
            } 
        } else {
            Session::flash('message', 'Email has been registered!'); 
            return view('auth.register', $data);
        }

        Session::flash('message', 'Register failed!'); 
        return view('auth.register', $data);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
