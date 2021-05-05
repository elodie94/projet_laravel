<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ResetMdpController extends Controller
{
    //modifier le mot de passe
    public function edit($id){
        $user=User::findOrFail($id);

        return view('user.editMdp',['user'=>$user]);
    }

    public function update(Request $request,$id){
        $user= User::findOrFail($id);

        $request->validate([
            'old_mdp' => 'required|string',
            'new_mdp' => 'required|string|min:4|max:15',
            'confirm_newmdp'=>'required|same:new_mdp',
        ]);

        if (Hash::check($request->old_mdp, Auth::user()->mdp)) {
            $user->mdp=$request->new_mdp;

            $user->save();
            $request->session()->flash('etat','Mot de passe modifié');

            return redirect()->route('home');
        }

        return back()->withErrors([
            'old_password' => 'Old password does not matched.',
        ]);

    }
}
