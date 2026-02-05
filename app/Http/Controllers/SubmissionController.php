<?php

namespace App\Http\Controllers;
use App\Models\Submission;

use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function index()
{
    $submissions = Submission::latest()->get();
    return view('submissions.index', compact('submissions'));
}

public function show(Submission $submission)
{
    return view('submissions.show', compact('submission'));
}

     public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'subject' => 'nullable|string|max:255',
                'comment' => 'nullable|string',
                'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            ]);

            if ($request->hasFile('cv')) {
                $data['cv'] = $request->file('cv')->store('cvs', 'public');
            }

            Submission::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Form submitted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again.'
            ], 500);
        }
    }

}
