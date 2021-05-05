<?php

namespace App\Http\Controllers;

use App\Models\Cours;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function assoProfCoursForm(){
        $enseignants=User::where('type','enseignant')->get();
        $c=Cours::all();

        return view('admin.teacher.assoCourstoProf',['enseignants'=>$enseignants],['c'=>$c]);
    }

    public function assoProfCours(Request $request){

        $request->validate([
                   'login' => 'required',
                   'intitule' => 'required',
        ]);

        $c=Cours::findOrFail($request->intitule);
        $e=User::findOrFail($request->login);
        $e->cours()->save($c);

        $request->session()->flash('etat','Opération validé');

        return redirect()->route('admin.home');
    }
}
