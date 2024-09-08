<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\CourseAssignment;
use App\Models\user;

class StudentByCourse extends Model
{
    use HasFactory;
    protected $table = 'students_by_courses';

    protected $fillable = [    
        'student_id',
        'course_id',
        'course_assignment_id',
    ];

    public function courseStudent()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id', 'id');
    }

     public function courseAssignment()
    {
        return $this->belongsTo(CourseAssignment::class);
    }

    public function assignCourseContent()
    {
        // Ensure courseAssignment exists before accessing assignCourseContent
        
            return $this->courseAssignment->assignCourseContent();
     
    }   

}
