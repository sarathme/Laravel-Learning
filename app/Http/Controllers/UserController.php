<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //Show User Create Form
    public function create()
    {
        return view('users.register');
    }

    // Create User
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        //Hash Password

        $formFields['password'] = bcrypt($formFields['password']);

        //Create User

        $user = User::create($formFields);

        //Login Created User

        auth()->login($user);

        return redirect('/')->with('User Created and You are logged in');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('You have been logged out');
    }
}
