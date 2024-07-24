<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FormController extends Controller
{
    //
    public function index(Request $request)
    {
        $inp = $request->validate([
            'email' => 'required|string|email',
            'name' => 'required|string',
            'privacy' => 'required|string|in:public,private,PUBLIC, PRIVATE',
            'fileupload' => 'nullable|file|mimes:pdf,png,jpg',
        ]);

        $file = $request->file('fileupload');
        $filename = $file->getClientOriginalName();

        $r = Storage::disk(strtolower($inp['privacy']))->putFileAs('uploads', $file, $filename);

        if (strtolower($inp['privacy']) == 'private') {
            return makeJson(200, "Form submitted successfully", [$r]);
        } else {
            return makeJson(200, "Form submitted successfully", [Storage::url($r)]);
        }
    }
}
