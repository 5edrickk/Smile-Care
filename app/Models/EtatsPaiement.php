<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtatsPaiement extends Model
{
    use HasFactory;

    protected $table      = 'etats_paiements';
    protected $primaryKey = 'id';
    public $timestamps    = false;
}
