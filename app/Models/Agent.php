<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;
    protected $fillable = ['nom','prenom','tel','sexe','date_naissance','lieu_naissance','id_service','id_fonction','adresse','email','username','mdp','admins'];
}
