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
        $submissions = BudgetHearingQuestionnaire::with(['history'])->paginate(20);
        return view('budget_hearing_questionnaire.admin_index', compact('submissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $schools = Auth::user()->schoolsWithPermission('can_submit_budget_hearing_questionnaire')->get();
        $school_selected = null;

        if ( $schools->count() === 1 ) {
            $school_selected = $schools->first();
        }

        if ( $request->has('school') ) {
            $school_selected = $schools->firstWhere('id', $request->school);
        }

        if ( $schools->count() === 0 ) {
            return redirect()->route('home')
                ->with('error', 'You do not have permission to submit a Budget Hearing Questionnaire for any school.');
        }

        if ( $school_selected && $school_selected->questionnaire()->exists() ) {
            return $this->edit($school_selected->questionnaire);
        }

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

        if ( BudgetHearingQuestionnaire::where('school_college_id', $request->school_college)->exists() ) {
            return redirect()->route('home')
                ->with('error', 'Budget Hearing Questionnaire already submitted for this school.');
        }

        $response_data = $request->only(
            'deficit_mitigation',
            'faculty_hiring',
            'student_enrollment',
            'student_retention',
            'foundation_engagement',
        );

        $questionnaire = new BudgetHearingQuestionnaire($response_data);
        $questionnaire->school()->associate($school);
        $questionnaire->save();

        $response_data['user_id'] = Auth::id();
        $response_data['budget_hearing_questionnaire_id'] = $questionnaire->id;

        $history = $questionnaire->history()->create($response_data);

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
        $schools = Auth::user()->schoolsWithPermission('can_submit_budget_hearing_questionnaire')->get();
        $questionnaire = $budgetHearingQuestionnaire;
        return view('budget_hearing_questionnaire.create', compact('questionnaire', 'schools'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BudgetHearingQuestionnaire $questionnaire)
    {
        $request->validate([
            'deficit_mitigation' => 'required',
            'faculty_hiring' => 'required',
            'student_enrollment' => 'required',
            'student_retention' => 'required',
            'foundation_engagement' => 'required',
        ]);

        $response_data = $request->only(
            'deficit_mitigation',
            'faculty_hiring',
            'student_enrollment',
            'student_retention',
            'foundation_engagement',
        );

        $questionnaire->update($response_data);

        $response_data['user_id'] = Auth::id();
        $response_data['budget_hearing_questionnaire_id'] = $questionnaire->id;

        $history = $questionnaire->history()->create($response_data);

        return redirect()->route('home')
            ->with('success', 'Budget Hearing Questionnaire updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BudgetHearingQuestionnaire $budgetHearingQuestionnaire)
    {
        //
    }
}
