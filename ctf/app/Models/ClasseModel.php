<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClasseModel extends Model
{
    use SoftDeletes;

    protected $table = 'classes';

    protected $fillable = [
        'code',
        'name',
        'course_name',
        'course_id',
        'teacher_name',
        'teacher_id',
        'schedule',
        'enrolled',
        'capacity',
        'status',
    ];

    protected $appends = ['enrolled_count'];

    public function course()
    {
        return $this->belongsTo(CourseModel::class, 'course_id');
    }

    public function teacher()
    {
        return $this->belongsTo(TeacherModel::class, 'teacher_id');
    }

    public function students()
    {
        return $this->hasMany(StudentModel::class, 'classe_id');
    }

    public function getEnrolledCountAttribute()
    {
        if (\Illuminate\Support\Facades\Schema::hasTable('students')) {
            $studentCount = $this->students()->count();
            if ($studentCount > 0) {
                return $studentCount;
            }
        }

        $courseName = $this->course_name ?? ($this->course ? $this->course->name : null);
        if ($courseName && \Illuminate\Support\Facades\Schema::hasTable('inscriptions')) {
            $inscriptionsCount = Inscription_model::where('course', $courseName)->count();
            if ($inscriptionsCount > 0) {
                return $inscriptionsCount;
            }
        }

        return $this->attributes['enrolled'] ?? 0;
    }
}
