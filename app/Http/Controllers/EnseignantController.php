<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Planning;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EnseignantController extends Controller
{

    /*public function index(){
        $enseignants=User::where('type','enseignant')->get();

        return view('teacher.index',['enseignants'=>$enseignants]);
    }*/

    //afficher les cours dont l'enseignant est responsable
    public function indexCours($id){
        $enseignant=User::findOrFail($id);

        $cours=$enseignant->cours()->paginate(5);

        return view('user.enseignant.cours.index',['cours'=>$cours]);
    }

    //affichage du planning -> enseignant

    //affichage intégrale
    public function indexIntegrale($id){
        $e=User::findOrFail($id);
        $cours=$e->cours()->get();

        return view('user.etudiant.planning.indexIntegrale',['cours'=>$cours]);
    }

    //affichage par cours
    public function indexPC($id){
        $e=User::findOrFail($id);
        $cours=$e->cours()->paginate(5);

        return view('user.etudiant.planning.IndexPC',['cours'=>$cours]);
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

        $e=User::findOrFail($id);
        $cours=$e->cours()->get();

        $seances=$cours->planning()
            ->whereBetween('date_debut',[$start,$end])
            ->paginate(5);

        return view('user.etudiant.planning.showSemaine',['seances'=>$seances]);
    }
}
