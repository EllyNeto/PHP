<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherModel extends Model
{
    use SoftDeletes;

    protected $table = 'teachers';
}
