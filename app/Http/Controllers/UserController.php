<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function login(Request $request)
    {
        $fields = $request->validate([
            'loginname' => 'required ',
            'loginpassword' => 'required',

        ]);

        if (auth()->attempt(['name' => $fields['loginname'], 'password' => $fields['loginpassword']])) {
            $request->session()->regenerate();
        }

        return redirect('/');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }

    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'min:3', 'max:10', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'name')],
            'password' => ['required', 'min:8'],

        ]);

        $fields['password'] = bcrypt($fields['password']);

        $user = User::create($fields);

        auth()->login($user);

        return redirect('/');
    }
}
