<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }
    public function store()
    {
        //validate
        $validatedAttributes = request()->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(6), 'confirmed'],
            // when confirmed is applied to a request field, laravel looks for another field of the same name but with _confirmation suffix. so password_confirmation, email_confirmation, etc.
        ]);

        // create the user
        $user = User::create($validatedAttributes);

        //log in
        Auth::login($user);

        // redirect
        return redirect('/jobs');

    }
}
