<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AssignCourseContent;
use App\Models\CourseClassworkFiles;
use App\Models\StudentScore;
use App\Models\Question;

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
    
     public function studentScores()
    {
        return $this->hasMany(StudentScore::class);
    }

    // Optionally, you can define the relationship to questions
    public function questions()
    {
        return $this->hasMany(Question::class);
    }   
}
