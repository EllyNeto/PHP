<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $table = 'enrollments';

    protected $fillable = [
        'name', 'email', 'phone', 'bilhete_identidade', 'course',
        'status', 'enrollment_date', 'class_id',
    ];

    protected $casts = [
        'status' => 'boolean',
        'enrollment_date' => 'date',
    ];
}
