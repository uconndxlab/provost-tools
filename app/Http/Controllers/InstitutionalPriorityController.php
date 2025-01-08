<?php

namespace App\Http\Controllers;

use App\Models\InstitutionalPriority;
use Illuminate\Http\Request;

class InstitutionalPriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $priorities = InstitutionalPriority::all();
        return view('decision_maker.institutional_priorities.index', compact('priorities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('decision_maker.institutional_priorities.create');
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
        return redirect()->route('institutional_priorities.index')->with('success', 'Priority added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(InstitutionalPriority $institutionalPriority)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InstitutionalPriority $institutionalPriority)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InstitutionalPriority $institutionalPriority)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InstitutionalPriority $institutionalPriority)
    {
        //
    }
}
