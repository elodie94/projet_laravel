<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps=false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom',
        'prenom',
        'login',
        'mdp',
        'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'mdp',
    ];

    protected $attributes=['type'=>'null'];

    public function getAuthPassword()
    {
        return $this->mdp;
    }

    public function isAdmin(){
        return $this->type == 'admin';
    }

    public function isEtudiant(){
        return $this->type == 'etudiant';
    }

    public function isEnseignant(){
        return $this->type == 'enseignant';
    }

    public function validateUser(){
        return $this->type != 'null';
    }


    function cours(){
       return $this->hasMany(Cours::class,'user_id');
   }

   function courseleve(){
       return $this->belongsToMany(Cours::class,'cours_users','user_id','cours_id');
   }

   function formation(){
       return $this->belongsTo(Formation::class,'formation_id');
   }
}
