<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypesPaiements extends Model
{
    use HasFactory;

    protected $table      = 'types_paiements';
    protected $primaryKey = 'id';
    public $timestamps    = false;
}
