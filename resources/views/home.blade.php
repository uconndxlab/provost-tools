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
                            <p>Supporting our 10-year strategic plan requires a reallocation of institutional resources. The
                                previously communicated permanent 2-ledger budget reductions for the coming years will
                                ensure our finances move towards long-term financial sustainability, and our institutional
                                priorities and goals are appropriately resourced.</p>
                            <p>In this year’s budget hearings, we will center our discussion around how your unit will meet
                                the budget guidance through a review of your FY25 – FY27 forecasts, along with the responses
                                to the questions in the submission linked [here]. As part of our assessment of current
                                resources we also ask you to submit a faculty teaching load report through this submission,
                                detailing the expected and actual teaching load of each faculty member within your unit.</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('budgetHearingQuestionnaire.create') }}" class="btn btn-primary">
                                Submit the Questionnaire
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
