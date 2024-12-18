@extends('layout')

@section('content')
    <div>
        <div class="hero text-center text-white py-5">
            <div class="container">
                <h1>Welcome to POET</h1>
                <p class="lead mt-3">
                    Discover the <strong>Provost's Operational Efficiency Toolkit</strong>—a suite of tools designed to
                    streamline operations, foster collaboration, and empower decision-making for the Provost’s
                    Office and faculty.
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
                            <h3>Budget Hearing Questionnaire</h3>
                        </div>
                        <div class="card-body">
                            <p>In this year’s budget hearings, we will center our discussion around how your unit will meet
                                the budget guidance through a review of your FY25 – FY27 forecasts, along with the responses
                                to the questions contained in your submission.</p>
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

                            <p>As stated in the FY25 Provost Fund Guidance, faculty within the AAUP may request a salary adjustment for compression/inversion or special achievement by emailing their department head 
                                (copy dean or designee) between <strong>April 1 and June 1</strong>.
                                AAUP faculty can access this information using the link below.</p>

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
