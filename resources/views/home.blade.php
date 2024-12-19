@extends('layout')

@section('content')
    <div>
        <div class="hero text-center text-white py-5">
            <div class="container">
                <h1>Welcome to POET</h1>
                <p class="lead mt-3">
                    Welcome to the <strong>Provost's Operational Efficiency Toolkit</strong>—a suite of tools designed to
                    streamline operations, foster collaboration, and empower decision-making for the Provost’s
                    Office and other academic administrators.
                </p>
                <a href="#tools" class="btn btn-lg btn-light mt-4 shadow">
                    Explore the Tools <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
        

        <div class="container">

            <div id="tools" class="row mt-5">
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3>Annual Budget Discussion – Unit Submission</h3>
                        </div>
                        <div class="card-body">
                            <p>Streamlined submission tool that creates an outline for annual budget hearing meetings. Discussions will center around how units will meet the budget guidance, while striving towards strategic plan goals.</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('budgetHearingQuestionnaire.create') }}" class="btn btn-primary">
                                Submit the Questionnaire
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card" style="opacity: 0.5;">
                        <div class="card-header bg-primary text-white">
                            <h3>Faculty Salary Tables</h3>
                            <span class="badge bg-danger">Available April 1- Jun 1</span>
                        </div>
                        <div class="card-body">

                            <p>Salary data for faculty within the AAUP, in accordance with the annual Provost Fund Guidance.</p>

                        </div>
                        <div class="card-footer">
                            <a href="{{ route('faculty_salary_tables.index') }}" class="btn btn-primary disabled">
                                View your Department's Salary Information
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
