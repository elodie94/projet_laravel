<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterUserController extends Controller
{
    //création compte
    public function create(){
        $formations=Formation::all();

        return view('auth.register',['formations'=>$formations]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|min:4|max:20',
            'prenom' => 'required|string|min:4|max:20',
            'login' => 'required|string|min:4|max:15|unique:users',
            'mdp' => 'required|string|min:4|max:15|confirmed',
            'formation_id'=> '',
        ]);



        $user = new User();
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->login = $request->login;
        $user->mdp = Hash::make($request->mdp);
        if($request->formation_id!=null){
            $f=Formation::findOrFail($request->formation_id);
            $f->user()->save($user);
        }
        $user->save();


        session()->flash('etat', 'User add');

        Auth::login($user);
        return redirect()->route('home');
    }


}
