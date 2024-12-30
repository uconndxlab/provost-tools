<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Pagination\Paginator;
use App\Models\User;
use App\Models\SchoolCollege;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        \Livewire\Livewire::forceAssetInjection();

        Gate::define('faculty-salary-tables-view', function (User $user) {
            return $user->id === $post->user_id;
        });

        Gate::define('can_create_budget_questionnaire', function (User $user, SchoolCollege $schoolCollege) {
            return $user->can_admin ||  $schoolCollege->usersWithPermission('can_submit_budget_hearing_questionnaire')->pluck('users.id')->contains($user->id);
        });
        
    }
}
