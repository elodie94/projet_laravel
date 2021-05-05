<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Planning;
use App\Models\User;

use Carbon\Carbon;
use Illuminate\Http\Request;

class PlanningController extends Controller
{
    //affichage du planning -> etudiant

    //affichage intégrale
    public function indexIntegrale($id){
        $etudiant=User::findOrFail($id);
        $cours=$etudiant->courseleve()->get();

        return view('user.etudiant.planning.indexIntegrale',['cours'=>$cours]);
    }

    //affichage par cours
    public function indexCours($id){
        $etudiant=User::findOrFail($id);
        $cours=$etudiant->courseleve()->paginate(5);

        return view('user.etudiant.planning.IndexCours',['cours'=>$cours]);
    }

    public function showCours($id){
        $cours=Cours::findOrFail($id);
        $seances=$cours->planning()->paginate(5);

        return view('user.etudiant.planning.showCours',['seances'=>$seances]);
    }

    //affichage par semaine
    public function indexSemaine(){
        return view('user.etudiant.planning.indexSemaine');
    }

    public function showSemaine(Request $request,$id){
        $request->validate([
            'date'=>'required|bail|date_format:"Y-m-d"',
        ]);

        $date=Carbon::createFromFormat('Y-m-d H:i',$request->date.' 00:00');
        $start=$date->startOfWeek()->format('Y-m-d H:i');
        $end=$date->endOfWeek()->format('Y-m-d H:i');

        $etudiant=User::findOrFail($id);
        $cours=$etudiant->courseleve()->get();

        $seances=$cours->planning()
            ->whereBetween('date_debut',[$start,$end])
            ->paginate(5);

        return view('user.etudiant.planning.showSemaine',['seances'=>$seances]);
    }

    //gestion planning pour un enseignant
    //création d'une nouvelle séance de cours
    public function create($id){
        $e=User::findOrFail($id);
        $cours=$e->cours()->get();

        return view('user.enseignant.planning.create',['cours'=>$cours]);
    }

    public function store(Request $request,$id){
        $request->validate([
            'cid'=>'required',
            'date'=>'required|bail|date_format:"Y-m-d"',
            'heureDebut'=>'required|bail|date_format:"H:i"',
            'heureFin'=>'required|date_format:"H:i"|after:heureDebut',
        ]);

        $date_debut=Carbon::createFromFormat('Y-m-d H:i',$request->date.' '.$request->heureDebut);
        $date_fin=Carbon::createFromFormat('Y-m-d H:i',$request->date.' '.$request->heureFin);


        $e=User::findOrFail($id);
        $c=$e->cours()->get();

        //faire un test pour voir si le cours existe déjà
        foreach($c as $co) {
            $seances = $co->planning()->get();
            foreach ($seances as $seance) {
                if ($seance->date_debut >= $date_debut && $seance->date_fin <= $date_fin)
                    return back()->withErrors([
                        'date' => 'plage horaire pas possible',
                    ]);
            }
        }

        $cours=Cours::findOrFail($request->cid);
        $planning=new Planning();
        $planning->date_debut=$date_debut;
        $planning->date_fin=$date_fin;

        $cours->planning()->save($planning);

        $request->session()->flash('etat','Séance ajoutée');
        return redirect()->route('user.enseignant.gestionplanning_home');
    }

    //creation d'une séance par semaine
    public function createWeek(){
        return view();
    }

    public function storeWeek(Request $request,$id){

    }

    public function edit($id){
        $e=User::findOrFail($id);
        $cours=$e->cours()->get();

        return view();
    }

    public function update(Request $request,$id){

    }

    public function delete($id){

    }

    public function destroy(Request $request,$id){

    }


}
