<?php

namespace App\Http\Controllers;


use App\Models\CourseAssignment;
use App\Models\Teacher;
use App\Models\StudentByCourse;
use App\Models\StudentClasswork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{

    public function index()
    {
        $user = Auth::id();


        $courseAssignments = CourseAssignment::with('course')
            ->with('teacher')
            ->get();

        $enrolledStudent = StudentByCourse::where('student_id', $user)
            ->get();

        $teachers = Teacher::all();

        $teacherAssigned = [];
        // foreach ($courseAssignments as $content) {
        //     $contentId = $content->id;
        //     foreach ($content->teacher as $teachers) {

        //        if ($teachers->id === $content->teacher_id) {
        //         $teacherAssigned[$contentId][] =[
        //             'teacher_id'=> $teachers->id,
        //             'teacher' => $teachers->name,
        //         ]; 
        //     }
        //     }
        // }
        // Prepare chart data
        $courseData = [
            'labels' => ['1ST', '2ND'], // School years
            'data' => [
                $courseAssignments->count(), // Example data
                0, // Placeholder for future data
                0, // Placeholder for future data
                0  // Placeholder for future data
            ]
        ];

        // Pass the data to the view
        // return view('student.dashboard', compact('user', 'courseAssignments', 'teachers', 'courseData'));
        return view('student.dashboard', [
            'user' => $user,
            'courseAssignments' => $courseAssignments,
            'teachers' => $teachers,
            'courseData' => $courseData,
            'coursesEnrolled' => $enrolledStudent
        ]);
    }

    public function joinClass(Request $request)
    {

        $user = Auth::id();

        $request->validate([
            'class_code' => 'required|string',
        ]);

        $classcode = $request->input('class_code');

        $course = CourseAssignment::where('class_code', $classcode)
            ->firstOrFail();

        StudentByCourse::create([
            'student_id' => $user,
            'course_id' => $course->course_id,
            'course_assignment_id' => $course->id
        ]);

        return redirect()->route('student.student.dashboard')->with('success', 'Enrolled successfully.');

    }

    public function unenroll(Request $request, $userID, $assignmentTableID, $courseID)
    {


        $student = StudentByCourse::where('course_assignment_id', $assignmentTableID)
            ->where('student_id', $userID);
        $student->delete();

        return redirect()->route('student.student.dashboard')->with('success', 'Unenrolled successfully.');

    }

    public function postClasswork(Request $request, $userID, $assignmentTableID, $courseID, $classwork_id,$subClassworkID)
    {
    //     $user = Auth::id();

    //     $request->validate([
    //         'files.*' => 'required|mimes:pdf,jpeg,png,jpg,gif,svg,doc,docx,xls,xlsx'
    //     ]);

    //     $fileData = [];
    //     if ($files = $request->file('files')) {
    //         foreach ($files as $file) {

    //             $fileNameWithExt = $file->getClientOriginalName();
    //             $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
    //             $extension = $file->getClientOriginalExtension();
    //             $fileNameToStore = $filename . '_' . time() . '.' . $extension;
    //             $path = $file->storeAs('public/classwork_files/student', $fileNameToStore);

    //             $fileData[] = [
    //                 'class_files' => $fileNameToStore,
    //                 'student_id' => $user,
    //                 'course_assignment_id' => $assignmentTableID,
    //                 'classwork_id' => $classwork_id,
    //                 'sub_classwork_id' => $subClassworkID
    //             ];
    //         }

    //     }

    //     StudentClasswork::insert($fileData);

    //     return redirect()->route('student.classwork.index', [
    //         'userID' => $userID,
    //         'assignmentTableID' => $assignmentTableID,
    //         'courseID' => $courseID,
    //         'classworkID'=> $classwork_id
    //     ])->with('success', 'Classwork submitted successfully.');
    
     if ($request->hasFile('files')) {
        $user = Auth::id();

        $request->validate([
            'files.*' => 'required|mimes:pdf,jpeg,png,jpg,gif,svg,doc,docx,xls,xlsx'
        ]);

        $fileData = [];
        if ($files = $request->file('files')) {
            foreach ($files as $file) {
                $fileNameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $path = $file->storeAs('public/classwork_files/student', $fileNameToStore);

                $fileData[] = [
                    'class_files' => $fileNameToStore,
                    'student_id' => $user,
                    'course_assignment_id' => $assignmentTableID,
                    'classwork_id' => $classwork_id,
                    'sub_classwork_id' => $subClassworkID
                ];
            }
        }

        StudentClasswork::insert($fileData);

        return redirect()->route('student.classwork.index', [
            'userID' => $userID,
            'assignmentTableID' => $assignmentTableID,
            'courseID' => $courseID,
            'classworkID'=> $classwork_id
        ])->with('success', 'Classwork submitted successfully.');
    } else {
        // Handle the case where no files were uploaded
        return redirect()->route('student.student.index', [
            'userID' => $userID,
            'assignmentTableID' => $assignmentTableID,
            'courseID' => $courseID,
            'classworkID'=> $classwork_id
        ])->with('info', 'Times Up!!!');
    }
    }
}
