<?php

namespace App\Http\Controllers;

use App\Models\BudgetHearingQuestionnaire;
use Illuminate\Http\Request;

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
        return view('budget_hearing_questionnaire.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'deficit_mitigation' => 'required',
            'faculty_hiring' => 'required',
            'student_enrollment' => 'required',
            'student_retention' => 'required',
            'foundation_engagement' => 'required',
        ]);

        BudgetHearingQuestionnaire::create($request->all());

        return redirect()->route('admin.budgetHearingQuestionnaire.index')
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
        //
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
