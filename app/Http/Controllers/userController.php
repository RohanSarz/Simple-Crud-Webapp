<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use TijsVerkoyen\CssToInlineStyles\Css\Rule\Rule;

class userController extends Controller
{


    public function login(Request $request){
        $incomingFeilds = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required',
        ]);
        if (auth()->attempt(['name' => $incomingFeilds['loginname'], 'password' => $incomingFeilds['loginpassword']])){
            $request->session()->regenerate();
        };

        return redirect('/');
    }
    public function logout(){
        auth()->logout();
        return redirect('/');
    }
    public function register(Request $request){
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:255' , Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:255']
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user =  User::create($incomingFields);;
        auth()->login($user);
        return redirect('/');
    }
}
