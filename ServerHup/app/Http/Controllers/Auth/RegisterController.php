<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Validation\Rules\Password;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show(){
        return view("auth.register");
    }

    public function store(Request $request){

        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required' , 'email' , 'unique:users,email' ],
            'password'=> ['required' , 'confirmed' , Password::min(5)->letters()->mixedCase()->numbers()->symbols()->uncompromised()]
        ]);

        $user = User::create($validated);

        Auth::login($user);

        return redirect('/');
    }
}
