<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubClasswork extends Model
{
    use HasFactory;
    protected $table = 'sub_classwork_content';

    protected $fillable = [
        'title',    
        'content',
        'classwork_id',
    ];

    

    public function courseClasswork()
    {
        return $this->hasMany(CourseContentClasswork::class, 'id', 'classwork_id');
    }


}