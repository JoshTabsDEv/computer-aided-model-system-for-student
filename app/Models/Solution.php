<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CourseClassworkFiles;
use App\Models\courseAssignment;

class Solution extends Model
{
    use HasFactory;
    protected $table = 'solutions';

    protected $fillable = [
        'solution_id',
        'solution_file',
        'course_assignment_id',
        'classwork_id',
        'sub_classwork_id'
    ];

    public function courseFiles()
    {
        return $this->hasMany(CourseContentClasswork::class);
    }

    public function courseAssignment()
    {
        return $this->hasMany(courseAssignment::class);
    }
}
