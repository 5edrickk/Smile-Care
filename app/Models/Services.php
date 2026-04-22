<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Services extends Model
{
    //
    use HasFactory;
    protected $table = "services";
    protected $primaryKey = "id";
    public $timestamps = false;

    public function typeService(): BelongsTo
    {
        return $this->belongsTo(TypesServices::class, "id");
    }
}
