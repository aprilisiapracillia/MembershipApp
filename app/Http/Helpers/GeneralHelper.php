<?php
namespace App\Http\Helpers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GeneralHelper
{
    public static function callbackSocial($social_id = null, $social_name = "") {
        try {
            $user = Socialite::driver($social_name)->user();
            $find_user = User::where("social_id", $user->id)->first();
            if(!$find_user) {
                $find_user = User::create([
                    "name" => $user->name,
                    "email" => $user->email,
                    "social_type" => $social_id,
                    "social_id" => $user->id,
                    "social_token" => $user->token,
                    "social_refersh_token" => $user->refreshToken,
                    "password" => Hash::make('membership'),
                    "membership_id" => 1,
                ]);
            }
            Auth::login($find_user);
            return redirect("/");
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}