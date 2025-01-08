<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\InstitutionalPriority;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('institutionalPriorities')->get();
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $priorities = InstitutionalPriority::all();
        return view('projects.create', compact('priorities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'budget' => 'required|numeric|min:0',
            'timeline' => 'required|string',
            'institutional_priorities' => 'nullable|array',
            'institutional_priorities.*.id' => 'exists:institutional_priorities,id',
            'institutional_priorities.*.score' => 'integer|min:1|max:10',
        ]);
    
        $project = Project::create($request->only(['name', 'budget', 'timeline', 'user_id']));
        if ($request->has('institutional_priorities')) {
            foreach ($request->institutional_priorities as $priority) {
                $project->institutionalPriorities()->attach($priority['id'], ['score' => $priority['score']]);
            }
        }
    
        return redirect()->route('projects.index')->with('success', 'Project created!');
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
