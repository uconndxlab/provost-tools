<?php

namespace App\Http\Controllers;

use App\Models\SchoolCollege;
use Illuminate\Http\Request;
use App\Models\User;

class SchoolCollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SchoolCollege $schoolCollege)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SchoolCollege $schoolCollege)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SchoolCollege $schoolCollege)
    {
        //
    }

    public function addPermissionForUser(Request $request, $permission)
    {
        // Validate the input
        $validated = $request->validate([
            'school_id' => 'required|exists:school_colleges,id',
            'user_id' => 'required|string',
        ]);
    
        $schoolId = $validated['school_id'];
        $netId = $validated['user_id'];
    
        // Find the user by netid
        $user = User::where('netid', $netId)->first();
        if (!$user) {
            return redirect()->route('admin.home')->with('error', "User with netid $netId not found.");
        }
    
        $school = SchoolCollege::find($schoolId);
        if (!$school) {
            return redirect()->route('admin.home')->with('error', "School with id $schoolId not found.");
        }
    
        // Attach the permission
        $school->usersWithPermission($permission)->attach($user->id);
    
        // Redirect with success message
        return redirect()->route('admin.home')->with('message', "Permission $permission added for user {$user->id} ({$user->netid}) to school {$school->name}");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolCollege $schoolCollege)
    {
        //
    }
}
