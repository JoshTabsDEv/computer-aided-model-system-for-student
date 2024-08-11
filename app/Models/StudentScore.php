<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CourseContentClasswork;
use App\Models\User;

class StudentScore extends Model
{
    use HasFactory;

    protected $table ='student_grade';

     protected $fillable = [
        'classwork_id',
        'student_id',
        'total_score',
        'score',
    ];

      public function courseClasswork()
    {
        return $this->belongsTo(CourseContentClasswork::class);
    }

    // A student score belongs to a student (user)
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
