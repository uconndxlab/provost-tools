<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\InstitutionalPriority;
use App\Models\Tag;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('institutionalPriorities')->get();
        return view('decision_maker.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $priorities = InstitutionalPriority::all();
        $tags = Tag::all();
        return view('decision_maker.projects.create', compact('priorities', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'status' => 'required|in:planning,in_progress,completed',
        ]);

        // Create the project
        $project = Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date ?? null,
            'status' => $request->status,
            'user_id' => Auth::id(), // Assuming authentication is in place
        ]);

        // Attach selected priorities with scores
        if ($request->has('priorities')) {
            $priorities = [];
            foreach ($request->priorities as $priority_id) {
                $score = $request->priority_scores[$priority_id] ?? null;
                if ($score) {
                    $priorities[$priority_id] = ['score' => $score];
                }
            }
            $project->priorities()->attach($priorities);
        }

        return redirect()->route('decision_maker.projects.index')->with('success', 'Project created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
