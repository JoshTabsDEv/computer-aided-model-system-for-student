<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AssignCourseContent;
use App\Models\CourseClassworkFiles;
use App\Models\StudentClasswork;

class CourseContentClasswork extends Model
{
    use HasFactory;

    protected $table = 'course_content_classwork';

    protected $fillable = [
        'id',
        'classwork',
        'type',
        'deadline',
    ];

    public function courseContent()
    {
        return $this->belongsTo(AssignCourseContent::class);
    }

    public function courseFiles()
    {
        return $this->belongsTo(CourseClassworkFiles::class);
    }

    public function courseStudentClasswork()
    {
        return $this->belongsTo(CourseClassworkFiles::class);
    }
    
}
