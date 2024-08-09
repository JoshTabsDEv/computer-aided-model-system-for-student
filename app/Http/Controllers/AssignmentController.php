<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Choice;

class AssignmentController extends Controller
{
    /**
     * Store the assignment form data.
     */
    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'questions.*' => 'required|string',
            'choices.*.*' => 'required|string',
            'correct_choice.*' => 'required' // Validate that a correct choice is selected for each question
        ]);

        $totalScore = 0;

        // Loop through each question
        foreach ($request->input('questions') as $questionIndex => $questionText) {
            // Save the question to the database
            $question = new Question();
            $question->text = $questionText;
            $question->save();

            // Save each choice for the question
            if (isset($request->choices[$questionIndex])) {
                foreach ($request->choices[$questionIndex] as $choiceIndex => $choiceText) {
                    $choice = new Choice();
                    $choice->question_id = $question->id;
                    $choice->text = $choiceText;

                    // Set the correct choice
                    $choice->is_correct = $request->correct_choice[$questionIndex] == $choiceIndex;
                    $choice->save();

                    if ($choice->is_correct) {
                        $totalScore++;
                    }
                }
            }
        }

        // Save the total score if necessary or return it to the view

        // Redirect back with success message and total score
        return redirect()->back()->with('success', 'Assignment submitted successfully.')->with('score', $totalScore);
    }
}
