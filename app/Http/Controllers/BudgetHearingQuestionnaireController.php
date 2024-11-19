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
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BudgetHearingQuestionnaire $budgetHearingQuestionnaire)
    {
        //
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
