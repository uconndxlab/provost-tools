<?php

namespace App\Http\Controllers;

use App\Models\SchoolCollege;
use Illuminate\Http\Request;
use App\Models\User;
use App\Ldap\LdapUser;

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
        $remove = $request->has('remove');
        $created = false;
    
        // Find the user by netid
        $user = User::where('netid', $netId)->first();
        if (!$user) {
            $ldapUser = LdapUser::where('uid', $netId)->first();
            if ( !$ldapUser ) {
                return redirect()->route('admin.home')->with('error', "User with netid $netId not found in Active Directory.");
            }
            $user = User::create([
                'netid' => $netId,
                'name' => $ldapUser->cn[0],
                'email' => $ldapUser->mail[0],
            ]);
            $created = true;
        }
    
        $school = SchoolCollege::find($schoolId);
        if (!$school) {
            return redirect()->route('admin.home')->with('error', "School with id $schoolId not found.");
        }
    
        if ( $remove ) {
            $school->users()->detach($user->id);
            return redirect()->route('admin.home')->with('message', "Permission $permission removed for user {$user->id} ({$user->netid}) to school {$school->name}");
        } else {
            // Attach the permission, unless a pivot already exists, in which update it
            $school->users()->syncWithoutDetaching([$user->id => ['can_submit_budget_hearing_questionnaire' => true]]);
        }
        
    
        // Redirect with success message
        $message = $created ? "User $netId created and permission $permission added for school {$school->name}" : "Permission $permission added for user {$user->id} ({$user->netid}) to school {$school->name}";
        return redirect()->route('admin.home')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolCollege $schoolCollege)
    {
        //
    }
}
