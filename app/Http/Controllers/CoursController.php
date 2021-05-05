<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Formation;
use App\Models\User;
use Illuminate\Http\Request;

class CoursController extends Controller
{
    //liste des cours pour l'admin
    public function index(){
        $c=Cours::paginate(10);

        return view('admin.cours.index',['c'=>$c]);
    }

    //création de cours par l'admin
    public function create(){
        $formations=Formation::all();
        $enseignants=User::where('type','enseignant')->get();

        return view('admin.cours.create',['formations'=>$formations],['enseignants'=>$enseignants]);
    }


    public function store(Request $request){

        $request->validate([
            'id'=>'required',
            'intitule'=>'required|string|max:30',
            'formation_id'=>'required',
        ]);

        $user=User::findOrFail($request->id);
        $c=new Cours();
        $c->intitule=$request->intitule;

        if($request->formation_id !=null){
            $f=Formation::findOrFail($request->formation_id);
            $c->formation()->associate($f);
        }

        $user->cours()->save($c);

        $request->session()->flash('etat',"Ajout d'un nouveau cours effectué");

        return redirect()->route('admin.cours.index');
    }

    //recherche d'un cours
    public function rechercheCours(){

        return view('admin.cours.rechercheCours');
    }

    public function resultRecherche(Request $request){
        $request->validate([
            'cours'=>'required',
        ]);

        $cours=Cours::where('intitule',$request->cours)->get();


        if($cours == null) {
            $request->session()->flash('etat',"Aucun cours trouvé");
            return redirect()->route('admin.cours.rechercheCours');
        }

        return view('admin.cours.showCours',['cours'=>$cours]);
    }

    //modifier un cours
    public function edit($id){
        $cours=Cours::findOrFail($id);
        $formations=Formation::all();
        $e=User::where('type','enseignant')->get();

        return view('admin.cours.edit',['cours'=>$cours],['formations'=>$formations],['e'=>$e]);
    }

    public function update(Request $request,$id){
        $request->validate([
            'id'=>'',
            'intitule'=>'required|string|max:30',
            'formation_id'=>'required',
        ]);

        $cours=Cours::findOrFail($id);
        $formation=Formation::findOrFail($request->formation_id);
        $enseignant=User::findOrdFail($request->id);
        $cours->intitule=$request->intitule;
        $cours->user()->associate($enseignant);
        $cours->formation()->associate($formation);
        $cours->save();

    }

    //supprimer un cours
    public function delete($id){

    }

    public function destroy(Request $request,$id){

    }
}
