<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EtatsPaiement extends Model
{
    //
    protected $table = "etats_paiement";
    protected $primaryKey = "id";
    public $timestamps = false;
}
