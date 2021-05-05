<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Formation;
use App\Models\User;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    //liste des cours d'une formation
    public function indexCours(Request $request,$id){
        $etudiant=User::findOrFail($id);
        $f=Formation::findOrFail($etudiant->formation_id);

        $coursFormation=Cours::where('formation_id',$f->id)->paginate(5);

        return view('user.etudiant.cours.index',['f'=>$f],['coursFormation'=>$coursFormation]);
    }

    //fonction pour que l'élève s'inscrive à un cours de sa formation
    public function inscrCours($id){
        $e=User::findOrFail($id);
        $f=Formation::findOrFail($e->formation_id);

        $cours=Cours::where('formation_id',$f->id)->get();

        return view('user.etudiant.cours.inscrCours',['cours'=>$cours]);
    }


    public function storeInscrCours(Request $request,$id){

        $request->validate([
            'cours_id'=>'required',
        ]);

        $e=User::findOrFail($id);
        $cid=$request->cours_id;
        $c=Cours::findOrFail($cid);

        $cours=$e->courseleve()->get();
        foreach($cours as $co){
            if($co->id==$c->id) {
                $request->session()->flash('etat', 'Vous êtes déjà inscrit dans ce cours!');
                return redirect()->route('user.etudiant.gestioninscr_home');
            }
        }

        $e->courseleve()->attach($c);

        $request->session()->flash('etat','Inscription au cours effectué!');
        return redirect()->route('user.etudiant.gestioninscr_home');
    }

    //désinscription d''un cours
    public function desinscrCours(Request $request,$id){
        $e=User::findOrFail($id);
        $coursInscr=$e->courseleve()->get();

        if($coursInscr==null){
            $request->session()->flash('etat',"Vous êtes inscrit dans aucun cours!");

            return redirect()->route('user.etudiant.gestioninscr_home');
        }

        return view('user.etudiant.cours.desinscrCours',['coursInscr'=>$coursInscr]);
    }

    public function destroyCoursInscr(Request $request,$id){
        $request->validate([
            'cid'=>'required',
        ]);

        $e=User::findOrFail($id);
        $c=Cours::findOrFail($request->cid);
        $e->courseleve()->detach($c);

        $request->session()->flash('etat','Désinscription du cours effectué!');
        return redirect()->route('user.etudiant.gestioninscr_home');
    }

    //liste des cours où l'étudiant est inscrit
    public function indexCoursInscr($id){
        $e=User::findOrFail($id);
        $coursInscr=$e->courseleve()->paginate(5);

        return view('user.etudiant.cours.indexCoursInscr',['coursInscr'=>$coursInscr]);
    }

    //recherche d'un cours dans la formation de l'élève
    public function rechercheCours(){

        return view('user.etudiant.cours.rechercheCours');
    }

    public function resultRecherche(Request $request,$id){
        $request->validate([
            'cours'=>'required',
        ]);

        $e=User::findOrFail($id);
        $f=$e->formation()->first();

        $cours=$f->cours()->where('intitule','LIKE',$request->cours)->first();


        if($cours == null) {
            $request->session()->flash('etat',"Aucun cours trouvé");
            return redirect()->route('user.etudiant.cours.rechercheCours',['id'=>$id]);
        }

        return view('user.etudiant.cours.showCours',['cours'=>$cours]);
    }

}
