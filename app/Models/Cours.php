<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;

    function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    function usereleve(){
        return $this->belongsToMany(User::class,'cours_users','cours_id','user_id');
    }

    function formation(){
        return $this->belongsTo(Formation::class,'formation_id');
    }

    function planning(){
        return $this->hasMany(Planning::class,'cours_id');
    }
}
