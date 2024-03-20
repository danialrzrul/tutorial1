<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function register(Request $request) {
        //ni untuk validate data inserted by user
        $insertedData = $request->validate([
            'name' => ['required', 'min:3', 'max:10', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:200']
        ]);

        $insertedData['password'] = bcrypt($insertedData['password']); //untuk hash/hide password user dalam database
        //User::create($insertedData); //Untuk insert data dalam table database
        $user = User::create($insertedData);
        auth()->login($user);
        return redirect('/');
    }

    public function login(Request $request) {
        $insertedData = $request->validate([
            'login_email' => 'required',
            'login_password' => 'required'
        ]);
        //untuk login guna auth()
        if(auth()->attempt(['email' => $insertedData['login_email'], 'password' => $insertedData['login_password']])) {
            $request->session()->regenerate();
        }

        return redirect('/');
    }

    public function logout() {
        auth()->logout();
        return redirect('/');
    }
}
