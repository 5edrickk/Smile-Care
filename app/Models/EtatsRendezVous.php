<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EtatsRendezVous extends Model
{
    //
    use HasFactory;
    protected $table = 'etats_rendez_vous';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
