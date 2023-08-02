<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    public function show()
    {
        return Inertia('auth/Register');
    }

    public function loginPage()
    {
        return Inertia('auth/Login');
    }
    public function create(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|unique:users',
            'password' => 'required|min:4',
        ]);

        $user = User::create($validated);

        if ($user) {
            return Inertia('auth/Register', ['msg' => 'Registration Successful']);
        } else {
            return Inertia('auth/Register', ['msg' => 'Registration Failed']);
        }
    }

    public function userLogin(Request $request)
    {

        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $email = $validated['email'];
        $password = $validated['password'];

        //check 
        $user = User::where('email', $email)->first();


        // $userPass = $user->password;

        if ($user && Hash::check($password, $user->password)) {

            $token =  JWTToken::createToken($user->id, $user->email);

            if ($token) {
                return redirect()->route('home')->with(['msg' => 'Login Successful'])->cookie('token', $token, 60 * 24 * 60);
            }
        } else {
            return Inertia('auth/Login', ['msg' => 'Invalid credential']);
        }
    }

    public function logout(Request $request)
    {
        return redirect()->route('home')->cookie('token', '', -1);
    }
}
