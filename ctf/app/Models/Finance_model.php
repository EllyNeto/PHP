<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Finance_model extends Model
{
    use SoftDeletes;

    protected $table = "finance";

    protected $fillable = [
        'inscription_id',
        'student_name',
        'course',
        'amount',
        'method',
        'payment_date',
        'status',
        'description',
    ];

    public function inscription()
    {
        return $this->belongsTo(Inscription_model::class, 'inscription_id');
    }
}
