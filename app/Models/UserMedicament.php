<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Thiagoprz\CompositeKey\HasCompositeKey;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserMedicament extends Pivot
{
    //
    use HasFactory;
    use HasCompositeKey;

    protected $table = 'user_medicament';
    protected $primaryKey = ['id_user', 'id_medicament'];
    public $incrementing = true;
    public $timestamps = false;
}
