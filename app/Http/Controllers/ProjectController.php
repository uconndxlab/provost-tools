<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\InstitutionalPriority;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('institutionalPriorities')->get();
        $tags = Tag::all();

        
        return view('decision_maker.projects.index', compact('projects', 'tags'));
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
            'budget' => $request->budget ?? 0,
            'current_spend' => $request->current_spend ?? 0,
            'timeline' => $request->timeline ?? " ",
            'user_id' => Auth::user()->id,
        ]);

        // Attach Institutional Priorities with Scores
        if ($request->has('priority_rating')) {
            $priorities = [];
            foreach ($request->priority_rating as $priorityId => $score) {
                $priorities[$priorityId] = ['score' => $score];
            }
            $project->institutionalPriorities()->sync($priorities);
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
