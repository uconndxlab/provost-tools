<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\InstitutionalPriority;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use App\Models\SchoolCollege;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orderBy = $request->input('order_by', 'created_at');
        $orderDirection = $request->input('direction', 'asc');
    
        $projectsQuery = Project::select('projects.*')
            ->with('institutionalPriorities.tags');
    
        if (strpos($orderBy, 'tag_') === 0) {
            $tagId = substr($orderBy, 4);
    
            $projectsQuery->leftJoin('institutional_priority_project as ipp', 'projects.id', '=', 'ipp.project_id')
                ->leftJoin('institutional_priorities as ip', 'ipp.institutional_priority_id', '=', 'ip.id')
                ->leftJoin('institutional_priority_tag as ipt', 'ip.id', '=', 'ipt.institutional_priority_id')
                ->where('ipt.tag_id', $tagId) // Filter for the given tag
                ->groupBy('projects.id') // Group by project
                ->selectRaw('SUM(ipp.score * ip.weight) as weighted_tag_score') // Weighted sum
                ->orderByRaw('weighted_tag_score ' . $orderDirection);
        } else {
            $projectsQuery->orderBy($orderBy, $orderDirection);
        }
    
        $projects = $projectsQuery->get();
    
        $tags = Tag::all();
        $schoolcolleges = SchoolCollege::all();
    
        return view('decision_maker.projects.index', compact('projects', 'tags', 'schoolcolleges'));
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
        $tags = Tag::all();

        // get the scores for the project, grouped by priority's tag
        $scores = [];
        foreach ($tags as $tag) {
            $scores[$tag->id] = $project->getPrioritiesByTag($tag->id);
        }

        return view('decision_maker.projects.show', compact('project', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $tags = Tag::all();

        return view('decision_maker.projects.edit', compact('project', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'status' => 'required|in:planning,in_progress,completed',
        ]);

        // Update the project
        $project->update([
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date ?? null,
            'status' => $request->status,
            'budget' => $request->budget ?? 0,
            'current_spend' => $request->current_spend ?? 0,
            'timeline' => $request->timeline ?? " ",
        ]);

        // Attach Institutional Priorities with Scores
        if ($request->has('priority_rating')) {
            $priorities = [];
            foreach ($request->priority_rating as $priorityId => $score) {
                $priorities[$priorityId] = ['score' => $score];
            }
            $project->institutionalPriorities()->sync($priorities);
        }

        return redirect()->route('decision_maker.projects.index')->with('success', 'Project updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('decision_maker.projects.index')->with('success', 'Project deleted successfully!');
    }
}
