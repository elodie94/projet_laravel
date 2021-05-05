<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    //liste de toutes les formations
    public function index(){
        $formations=Formation::paginate(10);

        return view('admin.formations.index',['formations'=>$formations]);
    }

    public function create(){
        return view('admin.formations.create');
    }

    public function store(Request $request){
        $request->validate([
            'intitule'=>'required|string|max:30',
        ]);

        $formation=new Formation();
        $formation->intitule=$request->intitule;

        $request->session()->flash('etat',"Ajout d'une nouvelle formation effectué");

        $formation->save();

        return redirect()->route('admin.formations.index');
    }


}
