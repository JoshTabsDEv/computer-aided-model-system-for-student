<?php

namespace App\Livewire;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use App\Models\CourseContentClasswork;
use App\Models\CourseClassworkFiles;
use App\Models\Solution;
use App\Models\AssignCourseContent;
use Imagick;

class ClassworkForm extends Component

{
    use WithFileUploads;
    public $content1;
    public $selectedOption;
    public $deadline;
    public $files;
    public $solution_files;
    public $assignmentTableID;
    public $courseID;
    public $userID;

    protected function rules()
    {
        $rules = [
            'selectedOption' => 'string',

            // 'files.*' => 'file|mimes:pdf,docx,doc,jpeg,png',
        ];

        // Apply conditional rules
        if ($this->selectedOption === 'Practice Problems') {
             $rules = [
            // 'deadline' => 'date_format:Y-m-d\TH:i',
            'content1' => 'string',
            'files.*' => 'file|mimes:pdf,docx,doc,jpeg,png',
            'solution_files.*' => 'file|mimes:pdf,docx,doc,jpeg,png'  // Adjust as needed
        ];
            
        }else if ($this->selectedOption === 'Assignment') {
            $rules = [
           'deadline' => 'date_format:Y-m-d\TH:i',
           'files.*' => 'file|mimes:pdf,docx,doc,jpeg,png',
           //  'solution_files.*' => 'file|mimes:pdf,docx,doc,jpeg,png'  // Adjust as needed
       ];
        }else if ($this->selectedOption === 'Module') {
            $rules = [
            'deadline' => 'date_format:Y-m-d\TH:i',
            'files.*' => 'file|mimes:pdf,docx,doc,jpeg,png',
        //  'solution_files.*' => 'file|mimes:pdf,docx,doc,jpeg,png'  // Adjust as needed
    ];
           
       }

        return $rules;
    }

   

    public function submit()
{
   
    $this->validate();

    
    $classwork = CourseContentClasswork::create([
        'classwork' => $this->content1,
        'type' => $this->selectedOption,
        'deadline' => $this->deadline,
    ]);

    // Handle file uploads
    $fileData = [];
    if ($this->files) {
        foreach ($this->files as $file) {
            $fileNameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            if ($extension == 'pdf') {
                // Ensure directory exists
                $thumbnailDir = 'public/classwork_files/thumbnails/';
                if (!Storage::exists($thumbnailDir)) {
                    Storage::makeDirectory($thumbnailDir);
                }

                // Generate thumbnail
                $pdf = new Imagick($file->getPathname() . '[0]');
                $pdf->setImageFormat('jpeg');
                $pdf->thumbnailImage(150, 150, true, true);
                Storage::put($thumbnailDir . $fileNameToStore . '.jpg', $pdf);
            }

            // Store file
            $path = $file->storeAs('public/classwork_files', $fileNameToStore);

            $fileData[] = [
                'classwork_file' => $fileNameToStore,
                'classwork_id' => $classwork->id,
            ];
        }
    }
    // $solutionFileData = [];
    //         if($files=$request->file('solution_files')){
    //             foreach ($files as $file) {

    //                 $fileNameWithExt = $file->getClientOriginalName();
    //                 $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
    //                 $extension = $file->getClientOriginalExtension();
    //                 $fileNameToStore = $filename.'_'.time().'.'.$extension;
    //                 $path = $file->storeAs('public/classwork_files/solution', $fileNameToStore);
                   
    //                 $solutionFileData[] = [
    //                     'solution_file' => $fileNameToStore,
    //                     'course_assignment_id' => $assignmentTableID,
    //                     'classwork_id' => $classwork->id      
    //                 ];
    //             }
                
    //         }

    // Handle solution files similarly...

    // Insert file data into the database
    CourseClassworkFiles::insert($fileData);
    // Solution::insert($solutionFileData);


    AssignCourseContent::create([
        'course_assignments_id' => $this->assignmentTableID,
        'classwork_id' => $classwork->id,
    ]);

    return redirect()->route('teacher.teacher.index', [
        'userID' => $this->userID,
        'assignmentTableID' => $this->assignmentTableID,
        'courseID' => $this->courseID,
    ])->with('success', 'Classwork added successfully.');
}



        
    

    public function render()
    {
        return view('livewire.classwork-form');
    }

    public function addInputField()
    {
        $this->dynamicFields[] = '';
    }
}