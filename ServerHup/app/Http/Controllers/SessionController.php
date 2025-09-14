<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function show(){
        return view("auth.login");
    }

    public function store(Request $request){

        $data_validated = $request->validate([
            'email' => ['email' , 'required'],
            'password' => ['required']
        ]);

        if(!Auth::attempt($data_validated)){
            throw ValidationException::withMessages(['email'=> __('messages.invempas')]);
        }


        $request->session()->regenerate();


        return redirect('/');
    }

    public function destroy(){
        Auth::logout();
        return redirect('/');
    }
}
