<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnimationShowcaseSubmission;

class AnimationShowcaseSubmissionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'submittor_name' => 'required|string|max:255',
            'submittor_email' => 'required|email',
            'institution' => 'required|string|max:255',
            'program' => 'required|string|max:255',
            'program_description' => 'nullable|string',
            'title' => 'required|string|max:255',
            'video_link' => 'required|url',
            'synopsis' => 'required|string|max:1000',
            'accessibility' => 'required'
        ]);


        $studentNames = request('student_name'); // Array of names
$studentMajors = request('student_major'); // Array of majors
$studentYears = request('student_year'); // Array of years
$studentBios = request('student_bio'); // Array of bios

// Comma-separated list of student names
$studentNamesFormatted = implode(', ', $studentNames);

// Generate formatted student bios
$formattedBios = [];
foreach ($studentNames as $index => $name) {
    $major = $studentMajors[$index] ?? 'Unknown Major';
    $year = $studentYears[$index] ?? 'Unknown Year';
    $bio = $studentBios[$index] ?? '';

    $formattedBios[] = "{$name} ({$major} {$year})\n{$bio}";
}

// Join all bios into one string
$studentBiosFormatted = implode("\n\n", $formattedBios);

        AnimationShowcaseSubmission::create([
            'submittor_name' => $request->submittor_name,
            'submittor_email' => $request->submittor_email,
            'institution' => $request->institution,
            'program' => $request->program,
            'program_description' => $request->program_description,
            'student_names' => $studentNamesFormatted,
            'student_bios' => $studentBiosFormatted,
            'title' => $request->title,
            'video_link' => $request->video_link,
            'synopsis' => $request->synopsis,
            'description' => $request->description ?? '',
            'accessibility_compliant' => true
        ]);

        // return a view that says the submission was received
        return view('animation-showcase-portal.submission-received');
    }

    public function index()
    {
        $submissions = AnimationShowcaseSubmission::paginate(20);
        return view('animation-showcase-portal.admin_index')->with('submissions', $submissions);
    }

    public function show(AnimationShowcaseSubmission $submission)
    {
        return view('animation-showcase-portal.admin_show')->with('submission', $submission);
    }
}
