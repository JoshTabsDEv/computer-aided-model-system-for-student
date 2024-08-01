<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\user;
use App\Models\CourseContentClasswork;
use App\Models\courseAssignment;

class StudentClasswork extends Model
{
    use HasFactory;
    protected $table = 'student_classwork';

    protected $fillable = [
        'class_files',    
        'student_id',
        'course_assignment_id',
        'classwork_id',
    ];

    public function courseStudent()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function courseClasswork()
    {
        return $this->hasMany(CourseContentClasswork::class, 'id', 'classwork_id');
    }


    public function courseAssignment()
    {
        return $this->belongsTo(courseAssignment::class, 'course_assignment_id', 'id');
        // return $this->belongsTo(Course::class);
    }
}
