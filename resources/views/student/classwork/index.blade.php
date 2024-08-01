<x-student-app-layout>
    <x-user-route-page-name 
        :routeName="'teacher.classwork.index'"
        :courseDetails="[
            'course_name' => $manageCourse->course->course_name,
            'time' => date('g:i A', strtotime($manageCourse->class_start_time)) . ' - ' . date('g:i A', strtotime($manageCourse->class_end_time)),
            'days_of_the_week' => $manageCourse->days_of_the_week,
            'section' => $manageCourse->section,
        ]"
    />
    <x-student.section-div-style>
       
    </x-student.section-div-style>
</x-student-app-layout>

