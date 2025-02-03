<?php

namespace App\Http\Controllers;



use App\Models\InstitutionalPriority;
use App\Models\Tag;
use Illuminate\Http\Request;


class InstitutionalPriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        $priorities = InstitutionalPriority::with('tags')->get();
        return view('decision_maker.institutional_priorities.index', compact('priorities', 'tags'));
        
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();
        return view('decision_maker.institutional_priorities.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'weight' => 'required|integer|min:1|max:10',
        ]);
    
        InstitutionalPriority::create($request->all());

        // tags
        $priority = InstitutionalPriority::latest()->first();
        $priority->tags()->attach($request->tags);



        return redirect()->route('decision_maker.institutional_priorities.index')->with('success', 'Priority added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(InstitutionalPriority $institutionalPriority)
    {
        $priority = $institutionalPriority;
        return view('decision_maker.institutional_priorities.show', compact('priority'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InstitutionalPriority $institutionalPriority)
    {
        $priority = $institutionalPriority;
        $tags = Tag::all();
$priorityTags = $institutionalPriority->tags->pluck('id')->toArray();



        return view('decision_maker.institutional_priorities.edit', compact('institutionalPriority', 'priority', 'tags', 'priorityTags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InstitutionalPriority $institutionalPriority)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'weight' => 'required|integer|min:1|max:10',
        ]);
    
        $institutionalPriority->update($request->all());

        $institutionalPriority->tags()->sync($request->tags);

        return redirect()->route('decision_maker.institutional_priorities.index')->with('success', 'Priority updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InstitutionalPriority $institutionalPriority)
    {
        $institutionalPriority->delete();
        return redirect()->route('decision_maker.institutional_priorities.index')->with('success', 'Priority deleted!');
    }
}
