<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //fonction pour modifier le nom et prénom
    public function edit(Request $request,$id){
        $user=User::findOrFail($id);

        return view('user.editnom',['user'=>$user]);
    }

    public function update(Request $request,$id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'new_nom' => 'required|string|min:4|max:15',
            'new_prenom' => 'required|string|min:4|max:15',
        ]);

        $user->nom = $request->new_nom;
        $user->prenom=$request->new_prenom;

        $user->save();
        $request->session()->flash('etat', 'Nom et pénom modifiés');

        return redirect()->route('home');

    }

    //liste de tous utilisateurs
    public function index(){
        $users=User::paginate(5);

        return view('user.index',['users'=>$users]);
    }

    //liste des utilisateurs en attente de confirmation de compte de l'admin
    public function indexvu(){
        $users=User::where('type','null')->paginate(5);

        return view('admin.users.indexvu',['users'=>$users]);
    }

    //choix du type lors de l'acceptation de compte
    public function editType($id){
        $user=User::findOrFail($id);

        if($user->formation_id != null) {
            $f= Formation::findOrFail($user->formation_id);
            $formation=$f->intitule;
        }else{
            $formation='pas de formation';
        }

        return view('admin.editType',['user'=>$user],['formation'=> $formation]);
    }

    public function updateType(Request $request,$id)
    {
        $user = User::findOrFail($id);

        if ($user->formation_id == null) $user->type = 'enseignant';
        else $user->type = 'etudiant';

        $user->save();
        $request->session()->flash('etat', 'Utilisateur validé');

        return redirect()->route('admin.users.indexvu');

    }

    //refus de création de compte par l'admin
    public function delete($id){
        $user = User::findOrFail($id);
        if($user->formation_id != null) {
            $formation = Formation::where('id', $user->formation_id)->intitule->get();
        }else{
            $formation='pas de formation';
        }

        return view('admin.delete',['user'=>$user],['formation'=>$formation]);
    }

    //supprimer un utilisateur qui a créé un compte
    public function destroy(Request $request,$id){
        $user=User::findOrFail($id);
        $user->formation()->dissociate();

        $user->delete();

        $request->session()->flash('etat','Utilisateur refusé -> suppresion réalisée');
        return redirect()->route('admin.home');

    }




}
