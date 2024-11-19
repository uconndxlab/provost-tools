@extends('layout')

@section('content')
<div class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3>Faculty Salary Tables</h3>
                        <p>As stated in the FY25 Provost Fund Guidance, faculty within the AAUP may request a salary adjustment for compression/inversion or special achievement by emailing their department head (copy dean or designee) between April 1, 2024 and June 1, 2024. This request should include any relevant supporting documentation (i.e. evidence of compression/inversion or major prize/award). AAUP faculty can access the salaries in their department using this tool.</p>
                        <a href="{{ route('faculty_salary_tables.index') }}" class="btn btn-primary">View Salaries for your Department</a>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-6">
                <div class="card text-bg-secondary">
                    <div class="card-body">
                        <h3>Commitment Tracker</h3>
                        <p></p>
                        <a class="btn btn-primary disabled">Coming Soon</a>
                    </div>
                </div>
            </div> --}}

            <!-- budget hearing questionnaire -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3>Budget Hearing Questionnaire</h3>
                        <p>Supporting our 10-year strategic plan requires a reallocation of institutional resources. The previously communicated permanent 2-ledger budget reductions for the coming years will ensure our finances move towards long-term financial sustainability, and our institutional priorities and goals are appropriately resourced.</p>
                        <p>In this year’s budget hearings, we will center our discussion around how your unit will meet the budget guidance through a review of your FY25 – FY27 forecasts, along with the responses to the questions in the submission linked [here]. As part of our assessment of current resources we also ask you to submit a faculty teaching load report through this submission, detailing the expected and actual teaching load of each faculty member within your unit.</p>
                        <a 
                            href="{{ route('budgetHearingQuestionnaire.create') }}"
                        class="btn btn-primary">
                            Submit the Questionnaire
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection