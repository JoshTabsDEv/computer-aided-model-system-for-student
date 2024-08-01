<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CourseAssignment;
use App\Models\AssignCourseContent;
use App\Models\AssignCourseAnnouncement;
use App\Models\CourseContentClasswork;
use App\Models\CourseClassworkFiles;
use App\Models\Solution;
use App\Models\Course;
use App\Models\StudentByCourse;
use App\Models\StudentClasswork;


class ManageClassworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($userID, $assignmentTableID, $courseID)
    {
        $teacherId = Auth::id();

        $manageCourse = CourseAssignment::where('teacher_id', $teacherId)
            ->where('id', $assignmentTableID)
            ->where('course_id', $courseID)
            ->with('course')
            ->firstOrFail();

        $courseContent = AssignCourseContent::where('course_assignments_id', $assignmentTableID)
            ->with(['courseAssignment', 'courseAnnouncements', 'courseClasswork'])
            ->orderBy('created_at', 'desc')
            ->get();

        $classwork_files = CourseClassworkFiles::all();

        $enrolledStudent = StudentByCourse::where('course_assignment_id',$assignmentTableID)
                            ->with('courseStudent')
                            ->get();
        
        $studentClasswork = StudentClasswork::where('course_assignment_id',$assignmentTableID)
                            ->with('courseStudent')
                            ->with('courseClasswork')
                            ->get();


        $classworkByAssignment = [];

        foreach ($courseContent as $content) {
            $contentId = $content->id;

            

            foreach ($content->courseClasswork as $classwork) {
                $classworkByAssignment[$contentId][] = [
                    'content_id' => $classwork->id,
                    'content' => $classwork->classwork,
                    'type' => 'Classwork',
                    'type_of_classwork' => $classwork->type,
                    'created_at' => $classwork->created_at,
                    'updated_at' => $classwork->updated_at,
                ];
            }
        }

        return view('teacher.classwork.index', [
            'manageCourse' => $manageCourse,
            'classworkByAssignment' => $classworkByAssignment,
            'enrolledStudent' => $enrolledStudent,
            'studentClasswork' => $studentClasswork,
            'file' => $classwork_files,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
