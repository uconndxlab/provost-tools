@extends('layout')

@section('content')
    <div>
        <div class="hero text-center text-white py-5">
            <div class="container">
                <h1>Welcome to 

              <abbr title="Provost's Operational Efficiency Toolkit">POET</abbr>
                </h1>
                <h4>The Provost's Operational Efficiency Toolkit</h4>
                <div class="poet-line-container">
                    <div class="poet-line">
                        <div class="poet-dot"></div>
                        <span>Streamline Operations</span>
                    </div>
                    <div class="poet-line">
                        <div class="poet-dot"></div>
                        <span>Foster Collaboration</span>
                    </div>
                    <div class="poet-line">
                        <div class="poet-dot"></div>
                        <span>Empower Decision-making</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-wrap">


            <div class="container">

                <div id="tools" class="row mt-5">
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <i class="material-icons">content_paste</i>
                                <h3>Annual Budget Discussion – Unit Submission</h3>

                                <p>Streamlined submission tool that creates an outline for annual budget hearing meetings.
                                    Discussions will center around how units will meet the budget guidance, while striving
                                    towards strategic plan goals.</p>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('budgetHearingQuestionnaire.create') }}" class="tool-link">
                                    Submit the Questionnaire
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card">

                            <div class="card-body">
                                <i class="material-icons">paid</i> <br>

                                <span class="badge bg-info text-primary">Available April 1- Jun 1</span>

                                <h3>Faculty Salary Tables</h3>

                                <p>Salary data for faculty within the AAUP, in accordance with the annual Provost Fund
                                    Guidance.</p>

                            </div>
                            <div class="card-footer">
                                <small>Available April 1 - June 1</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
