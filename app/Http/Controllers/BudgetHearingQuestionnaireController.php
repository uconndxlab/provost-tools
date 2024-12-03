<?php

namespace App\Http\Controllers;

use App\Models\BudgetHearingQuestionnaire;
use App\Models\SchoolCollege;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class BudgetHearingQuestionnaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('budget_hearing_questionnaire.index');
    }

    public function adminIndex()
    {
        $submissions = BudgetHearingQuestionnaire::paginate(20);
        return view('budget_hearing_questionnaire.admin_index', compact('submissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $schools = Auth::user()->schoolsWithPermission('can_submit_budget_hearing_questionnaire')->get();
        return view('budget_hearing_questionnaire.create', compact('schools'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $school = SchoolCollege::find($request->school_college);
        $request->validate([
            'school_college' => 'required|exists:school_colleges,id',
            'deficit_mitigation' => 'required',
            'faculty_hiring' => Rule::requiredIf($school && $school->type === 'school'),
            'student_enrollment' => 'required',
            'student_retention' => 'required',
            'foundation_engagement' => 'required',
        ]);

        BudgetHearingQuestionnaire::create($request->all());

        return redirect()->route('home')
            ->with('success', 'Budget Hearing Questionnaire created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BudgetHearingQuestionnaire $budgetHearingQuestionnaire)
    {
        $submission = $budgetHearingQuestionnaire;
        return view('budget_hearing_questionnaire.show', compact('submission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BudgetHearingQuestionnaire $budgetHearingQuestionnaire)
    {
        $questionnaire = $budgetHearingQuestionnaire;
        return view('budget_hearing_questionnaire.create', compact('questionnaire'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BudgetHearingQuestionnaire $budgetHearingQuestionnaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BudgetHearingQuestionnaire $budgetHearingQuestionnaire)
    {
        //
    }
}
