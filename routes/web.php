<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

use App\Http\Controllers\FacultySalaryTablesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PayrollIdController;
use App\Http\Controllers\BudgetHearingQuestionnaireController;
use App\Models\SchoolCollege;
use App\Http\Controllers\SchoolCollegeController;
use App\Http\Controllers\AnimationShowcaseSubmissionController;
use App\Http\Controllers\InstitutionalPriorityController;
use App\Http\Controllers\ProjectController;
use App\Models\InstitutionalPriority;



Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/animation-showcase-submission', [HomeController::class, 'animationShowcaseSubmission'])->name('animationShowcaseSubmission');
Route::post('/animation-showcase-submission', [AnimationShowcaseSubmissionController::class, 'store'])->name('animationShowcaseSubmission.store');

Route::get('/admin/institutional-priorities', [InstitutionalPriorityController::class, 'index'])->name('decision_maker.institutional_priorities.index');
Route::get('/admin/institutional-priorities/{institutionalPriority}', [InstitutionalPriorityController::class, 'show'])->name('decision_maker.institutional_priorities.show');
Route::get('/admin/institutional-priority/create', [InstitutionalPriorityController::class, 'create'])->name('decision_maker.institutional_priorities.create');
Route::get('/admin/institutional-priorities/{institutionalPriority}/edit', [InstitutionalPriorityController::class, 'edit'])->name('decision_maker.institutional_priorities.edit');
Route::put('/admin/institutional-priorities/{institutionalPriority}', [InstitutionalPriorityController::class, 'update'])->name('decision_maker.institutional_priorities.update');
Route::delete('/admin/institutional-priorities/{institutionalPriority}', [InstitutionalPriorityController::class, 'destroy'])->name('decision_maker.institutional_priorities.destroy');
Route::post('/admin/institutional-priorities', [InstitutionalPriorityController::class, 'store'])->name('decision_maker.institutional_priorities.store');

Route::get('/admin/projects', [ProjectController::class, 'index'])->name('decision_maker.projects.index');
Route::get('/admin/projects/{project}', [ProjectController::class, 'show'])->name('decision_maker.projects.show');
Route::get('/admin/project/create', [ProjectController::class, 'create'])->name('decision_maker.projects.create');
Route::get('/admin/project/{project}/edit', [ProjectController::class, 'edit'])->name('decision_maker.projects.edit');
Route::put('/admin/projects/{project}', [ProjectController::class, 'update'])->name('decision_maker.projects.update');
Route::delete('/admin/projects/{project}', [ProjectController::class, 'destroy'])->name('decision_maker.projects.destroy');
Route::post('/admin/projects', [ProjectController::class, 'store'])->name('decision_maker.projects.store');




Route::middleware(['cas.auth'])->group(function () {
    Route::get('tools', [HomeController::class, 'home'])->name('tools');
    Route::get('/faculty/salary', [FacultySalaryTablesController::class, 'index'])->name('faculty_salary_tables.index');
    Route::get('/budgetHearingQuestionnaire', [BudgetHearingQuestionnaireController::class, 'create'])->name('budgetHearingQuestionnaire.create');
    Route::post('/budgetHearingQuestionnaire', [BudgetHearingQuestionnaireController::class, 'store'])->name('budgetHearingQuestionnaire.store');
    Route::put('/budgetHearingQuestionnaire/{questionnaire}', [BudgetHearingQuestionnaireController::class, 'update'])->name('budgetHearingQuestionnaire.update');
    Route::get('/budgetHearingQuestionnaire/regional', [BudgetHearingQuestionnaireController::class, 'create'])->name('budgetHearingQuestionnaire.createForRegional');
    Route::get('/budgetHearingQuestionnaire/schoolCollege', [BudgetHearingQuestionnaireController::class, 'create'])->name('budgetHearingQuestionnaire.createForCollege');
    Route::get('/budgetHearingQuestionnaire/{budgetHearingQuestionnaire}', [BudgetHearingQuestionnaireController::class, 'show'])->name('budgetHearingQuestionnaire.show');


    Route::middleware(['admin'])->group(function () {
        Route::get('/admin', [HomeController::class, 'adminHome'])->name('admin.home');
        Route::get('/admin/users', [UserController::class, 'adminIndex'])->name('admin.users.index');
        Route::get('/admin/faculty/salary', [FacultySalaryTablesController::class, 'adminIndex'])->name('admin.faculty_salary_tables.index');
        Route::get('/admin/budgetHearingQuestionnaire', [BudgetHearingQuestionnaireController::class, 'adminIndex'])->name('admin.budgetHearingQuestionnaire.index');


        Route::post('/admin/addBudgetHearingPermission', [SchoolCollegeController::class, 'addPermissionForUser'])->name('admin.update_budget_questionnaire_permissions')->defaults('permission', 'create_budget_questionnaire');
        Route::post('/admin/removeBudgetHearingPermission', [SchoolCollegeController::class, 'removePermissionForUser'])->name('admin.remove_budget_questionnaire_permissions')->defaults('permission', 'create_budget_questionnaire');

        Route::get('/admin/animation-showcase-submissions', [AnimationShowcaseSubmissionController::class, 'index'])->name('admin.animationShowcaseSubmissions.index');
        Route::get('/admin/animation-showcase-submissions/{submission}', [AnimationShowcaseSubmissionController::class, 'show'])->name('admin.animationShowcaseSubmissions.show');

        Route::get('/admin/projects', [ProjectController::class, 'index'])->name('decision_maker.projects.index');
        Route::get('/admin/projects/{project}', [ProjectController::class, 'show'])->name('decision_maker.projects.show');
        Route::get('/admin/project/create', [ProjectController::class, 'create'])->name('decision_maker.projects.create');
        Route::get('/admin/project/{project}/edit', [ProjectController::class, 'edit'])->name('decision_maker.projects.edit');
        Route::put('/admin/projects/{project}', [ProjectController::class, 'update'])->name('decision_maker.projects.update');
        Route::delete('/admin/projects/{project}', [ProjectController::class, 'destroy'])->name('decision_maker.projects.destroy');
        Route::post('/admin/projects', [ProjectController::class, 'store'])->name('decision_maker.projects.store');
    });
});
