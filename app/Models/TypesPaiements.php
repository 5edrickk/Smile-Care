<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypesPaiements extends Model
{
    //
    protected $table = "types_paiement";
    protected $primaryKey = "id";
    public $timestamps = false;
}
