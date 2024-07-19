<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function index() {
        $auth = Auth::user();
        $data['user'] = User::where('id', $auth->id)->first();
        $data['memberships'] = Membership::all();
        return view('profile', $data);
    }
    
    public function update(Request $request) {
        $old = Auth::user();
        $data['memberships'] = Membership::all();
        $data['user'] = User::where('id', $old->id)->first();

        try {
            $user = [
                "name" => $request->name,
                "email" => $request->email,
                "membership_id" => $request->membership_id
            ];
            if($request->password) {
                $user["password"] = Hash::make($request->password);
            }

            $update = User::where('id', $old->id)->update($user);
            if($update) {
                Session::flash('message', 'Update profile successfully!'); 
                return view('profile', $data);
            }
        } catch (Exception $e) {
            // dd($e->getMessage());
            Session::flash('message', 'Update profile failed!'); 
            return view('profile', $data);
        }
    }
}
