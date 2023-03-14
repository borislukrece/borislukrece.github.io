<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sous_direction extends Model
{
    use HasFactory;
    protected $fillable = ['nom','libelle','id_direction'];
}
