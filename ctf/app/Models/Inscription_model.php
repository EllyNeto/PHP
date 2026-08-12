<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inscription_model extends Model
{
    use SoftDeletes;

    protected $table = "inscriptions";

    protected $fillable = [
        'name',
        'email',
        'phone',
        'course',
        'bi',
        'status',
        'pagamento_info',
    ];
}
