<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CourseAssignment;
use App\Models\AssignCourseContent;
use App\Models\AssignCourseAnnouncement;
use App\Models\CourseContentClasswork;
use App\Models\StudentByCourse;
use App\Models\StudentClasswork;
use App\Models\Solution;
use App\Models\CourseClassworkFiles;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\Course;
use Imagick;


class StudentCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($userID, $assignmentTableID, $courseID)
    {
        $user = Auth::id();

        

        $course_code = Course::where('id',$courseID)->firstOrFail();

        $manageCourse = CourseAssignment::where('id', $assignmentTableID)
                            ->with('course')
                            ->with('teacher')
                            ->firstOrFail();

        $enrolledStudent = StudentByCourse::where('course_assignment_id',$assignmentTableID)
                            ->with('courseStudent')
                            ->get();

            

        $courseContent = AssignCourseContent::where('course_assignments_id', $assignmentTableID)
                            ->with('courseAssignment')
                            ->with('courseAnnouncements')
                            ->orderBy('created_at', 'desc')
                            ->get();
                            
        $classwork_files = CourseClassworkFiles::all();
        $solution_files = Solution::all();
       $student_classwork = StudentClasswork::where('course_assignment_id', $assignmentTableID)
                            ->get();
                          
        
                    
        $announcementsByAssignment = [];
        $classworkByAssignment = [];
        
  
    
        foreach ($courseContent as $content) {
            $contentId = $content->id;
            

            foreach ($content->courseAnnouncements as $announcement) {

                $announcementsByAssignment[$contentId][] = [
                    'content_id' => $announcement->id,
                    'content' => $announcement->announcement,
                    'type' => 'Announcement',
                    'created_at' => $announcement->created_at,
                    'updated_at' => $announcement->updated_at,
                ];
            }
            
            foreach ($content->courseClasswork as $classwork) {
                $deadlineFormatted = Carbon::parse($classwork->deadline)->format('M d, Y : h:i A');
                $classworkByAssignment[$contentId][] = [
                    'content_id' => $classwork->id,
                    'content' => $classwork->classwork,
                    'type' => 'Classwork',
                    'type_of_classwork' => $classwork->type,
                    'deadline'=> $deadlineFormatted,
                    'deadline_timestamp' => $classwork->deadline,
                    'created_at' => $classwork->created_at,
                    'updated_at' => $classwork->updated_at,
                ];
            }
        }

        $currentTime = Carbon::now();
   
        return view('student.courses.manage-course.index', [
            'class_code' => $course_code,
            'manageCourse' => $manageCourse, 
            'announcementsByAssignment' => $announcementsByAssignment,
            'classworkByAssignment' => $classworkByAssignment,
            'enrolledStudent' => $enrolledStudent,
            'student_file' => $student_classwork,
            'file' => $classwork_files,
            'solution' => $solution_files,
            'current_time' => $currentTime
        ]);
    }

    public function postAnnouncement(Request $request, $userID, $assignmentTableID, $courseID)
    {
        $request->validate([
            'content' => 'required|string', 
        ]);

        // Check if there's an existing record with null announcement_id
        // $content = AssignCourseContent::where('course_assignments_id', $assignmentTableID)
        //     ->whereNull('announcement_id')
        //     ->first();

        // if ($content) {
        //     // Update existing record with the new announcement
        //     $announcement = AssignCourseAnnouncement::create([
        //         'announcement' => $request->input('content'),
        //     ]);

        //     $content->announcement_id = $announcement->id;
        //     $content->save();
        // } else {
            // Create a new record
            $announcement = AssignCourseAnnouncement::create([
                'announcement' => $request->input('content'),
            ]);

            AssignCourseContent::create([
                'course_assignments_id' => $assignmentTableID,
                'announcement_id' => $announcement->id,
            ]);
        // }

        return redirect()->route('teacher.teacher.index', [
            'userID' => $userID,
            'assignmentTableID' => $assignmentTableID,
            'courseID' => $courseID,
        ])->with('success', 'Announcement added successfully.');
    }

    public function postClasswork(Request $request, $userID, $assignmentTableID, $courseID,$classwork_id)
    {
        $user = Auth::id();

        $request->validate([
            'files.*' => 'required|mimes:pdf,jpeg,png,jpg,gif,svg,doc,docx,xls,xlsx'
        ]);

            $fileData = [];
            if($files=$request->file('files')){
                foreach ($files as $file) {

                    $fileNameWithExt = $file->getClientOriginalName();
                    $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    $path = $file->storeAs('public/classwork_files/student', $fileNameToStore);
                   
                    $fileData[] = [
                        'class_files' => $fileNameToStore,
                        'student_id' => $user,
                        'course_assignment_id'=> $assignmentTableID,  
                        'classwork_id' => $classwork_id       
                    ];
                }
                
            }
            
            StudentClasswork::insert($fileData);

        return redirect()->route('student.student.index', [
            'userID' => $userID,
            'assignmentTableID' => $assignmentTableID,
            'courseID' => $courseID,
        ])->with('success', 'Classwork submitted successfully.');
    }

//    public function removeAnnouncement($userID, $assignmentTableID, $courseID, $contentID, $announcementID)
//     {

        

//         $content = AssignCourseContent::findOrFail($contentID);
//         // Update the announcement_id to null
//         $content->announcement_id = null;
//         $content->save();

//         $announcement = AssignCourseAnnouncement::findOrFail($announcementID);
//         $announcement->delete();

//         return redirect()->route('teacher.teacher.index', [
//             'userID' => $userID,
//             'assignmentTableID' => $assignmentTableID,
//             'courseID' => $courseID,
//         ])->with('success', 'Announcement removed successfully.');
//     }

public function removeAnnouncement($userID, $type, $assignmentTableID, $courseID, $contentID, $announcementID)
{
    // Determine which model to use based on $contentType ('announcement' or 'classwork')
    if ($type == 'Announcement') {
        // Delete announcement
         $announcement = AssignCourseAnnouncement::findOrFail($announcementID);
         $announcement->delete();
        
          return redirect()->route('teacher.teacher.index', [
            'userID' => $userID,
            'assignmentTableID' => $assignmentTableID,
            'courseID' => $courseID,
        ])->with('success', 'Announcement removed successfully.');
    } elseif ($type === 'Classwork'){
        $classwork = CourseContentClasswork::findOrFail($announcementID);
        $classwork->delete();
        return redirect()->route('teacher.teacher.index', [
            'userID' => $userID,
            'assignmentTableID' => $assignmentTableID,
            'courseID' => $courseID,
        ])->with('success', 'Announcement removed successfully.');
    }
}

    // public function updateAnnouncement(Request $request, $userID, $assignmentTableID, $courseID, $contentID, $announcementID)
    // {
    //     // Validate request data


    //     if ($request->input('content')) {
    //         $announcement = AssignCourseAnnouncement::findOrFail($announcementID);

    //         // Update the announcement content from the request
    //         $announcement->announcement = $request->input('content');

    //         // Save the updated announcement
    //         $announcement->save();

    //         // Redirect back with success message
    //         return redirect()->route('teacher.teacher.index', [
    //             'userID' => $userID,
    //             'assignmentTableID' => $assignmentTableID,
    //             'courseID' => $courseID,
    //         ])->with('success', 'Announcement updated successfully.');
    //     } else {
    //         return redirect()->route('teacher.teacher.index', [
    //             'userID' => $userID,
    //             'assignmentTableID' => $assignmentTableID,
    //             'courseID' => $courseID,
    //         ])->with('error', 'Unable to update.');
    //     }
    // }

    public function updateAnnouncement(Request $request, $userID, $type, $assignmentTableID, $courseID, $contentID, $announcementID)
    {
        // Validate the request
        $request->validate([
            'content' => 'required|string', // Adjust validation rules as per your needs
        ]);

        // Determine which model to use based on $contentType ('announcement' or 'classwork')
        if ($type === 'Announcement') {
            // Update announcement
            $announcement = AssignCourseAnnouncement::findOrFail($announcementID);
            $announcement->announcement = $request->input('content');
            $announcement->save();
            return redirect()->back()->with('success', 'Content updated successfully.');
        } elseif ($type === 'Classwork') {
            // Update classwork
            $classwork = CourseContentClasswork::findOrFail($announcementID);
            $classwork->classwork = $request->input('content');
            $classwork->save();
            return redirect()->back()->with('success', 'Content updated successfully.');
        }

        // Redirect back or return a response as needed
        return redirect()->back()->with('success', 'Content updated successfully.');
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
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $file = CourseClassworkFiles::findOrFail($id);

        $path = storage_path("app/public/classwork_files/{$file->classwork_file}");

        if (!file_exists($path)) {
            abort(404);
        }

        $fileContent = file_get_contents($path);
        $mimeType = mime_content_type($path);

        return response($fileContent, 200)
            ->header('Content-Type', $mimeType)
            ->header('Content-Disposition', 'inline; filename="' . basename($path) . '"');
    }

    public function showSolution($id)
    {
        $solution = Solution::findOrFail($id);
        $path = storage_path("app/public/classwork_files/solution/{$solution->solution_file}");

        return response()->file($path);
    } 

    public function showClasswork($id)
    {
        // Fetch the file record from the database
        $file = StudentClasswork::findOrFail($id);

        // Get the path to the file
        $filePath = storage_path("app/public/classwork_files/student/{$file->class_files}");

        // Check if file exists
        if (!file_exists($filePath)) {
            abort(404);
        }

        // Return the file as a response
        return response()->file($filePath);
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
