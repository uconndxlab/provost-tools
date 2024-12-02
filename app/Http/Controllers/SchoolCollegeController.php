<?php

namespace App\Http\Controllers;

use App\Models\SchoolCollege;
use Illuminate\Http\Request;

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

    public function addPermissionForUser(Request $request, $permission) {
        $schoolId = $request->schoolId;
        $userId = $request->userId;
        $permission = $permission;
        $school = SchoolCollege::find($schoolId);
        $school->users()->attach($userId);
        // back to admin.home with message
        return redirect()->route('admin.home')->with('message', 'Permission $permission added for user $userId to school $school->name');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolCollege $schoolCollege)
    {
        //
    }
}
