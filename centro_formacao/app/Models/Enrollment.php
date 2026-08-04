<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $table = 'enrollments';

    protected $fillable = [
        'name', 'email', 'phone', 'bilhete_identidade', 'course',
        'status', 'payment_status', 'training_center', 'class_name', 'enrollment_date', 'class_id',
    ];

    protected $casts = [
        'enrollment_date' => 'date',
    ];
}
