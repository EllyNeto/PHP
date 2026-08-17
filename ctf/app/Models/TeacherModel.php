<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherModel extends Model
{
    use SoftDeletes;

    protected $table = 'teachers';

    protected $fillable = [
        'name',
        'email',
        'bi',
        'phone_number',
    ];

    public function classes()
    {
        return $this->hasMany(ClasseModel::class, 'teacher_id');
    }
}
