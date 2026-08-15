<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentModel extends Model
{
    use SoftDeletes;

    protected $table = 'students';

    protected $fillable = [
        'inscription_id',
        'classe_id',
    ];

    public function inscription()
    {
        return $this->belongsTo(Inscription_model::class, 'inscription_id');
    }

    public function classe()
    {
        return $this->belongsTo(ClasseModel::class, 'classe_id');
    }
}
