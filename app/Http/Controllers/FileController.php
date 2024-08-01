<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\Models\CourseClassworkFiles;
use App\Models\StudentClasswork;

class FileController extends Controller
{
    public function showThumbnail($filename)
    {
        $path = 'public/classwork_files/thumbnails/' . $filename;
        
        if (Storage::exists($path)) {
            $file = Storage::get($path);
            $type = Storage::mimeType($path);

            return response($file, 200)->header("Content-Type", $type);
        }

        return response('File not found', 404);
    }

    public function showFile($id)
    {
        // Fetch the file record from the database
        $file = CourseClassworkFiles::findOrFail($id);

        // Get the path to the file
        $filePath = storage_path('app/public/classwork_files/' . $file->classwork_file);

        // Check if file exists
        if (!file_exists($filePath)) {
            abort(404);
        }

        // Return the file as a response
        return response()->file($filePath);
    }

    
}