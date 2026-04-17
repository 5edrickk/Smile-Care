<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medicament extends Model
{
    //
    use HasFactory;
    protected $table = 'medicaments';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
