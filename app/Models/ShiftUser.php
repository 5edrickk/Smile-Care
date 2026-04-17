<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Thiagoprz\CompositeKey\HasCompositeKey;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ShiftUser extends Pivot
{
    //
    use HasFactory;
    use HasCompositeKey;

    protected $table = 'shift_users';
    protected $primaryKey = ['id_shift', 'id_user'];
    public $incrementing = true;
    public $timestamps = false;
}
