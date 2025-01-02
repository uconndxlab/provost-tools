@extends('layout')
@section('title', 'Home')
@section('content')
    <div>
        <div class="hero text-center text-white py-5">
            <div class="container">
                <h1>Welcome to 

              <abbr title="Provost's Operational Efficiency Toolkit">POET</abbr>
                </h1>
                <h4>The Provost's Operational Efficiency Toolkit</h4>
            </div>
        </div>

        <div class="content-wrap">
            <div class="container">

                <div id="tools" class="row mt-5">
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <span class="badge bg-success">Available Now</span>
                            </div>
                            <div class="card-body">
                                <i class="material-icons">content_paste</i>

                                <h3><a href="{{ route('budgetHearingQuestionnaire.create') }}">Annual Budget Hearing Questionnaire</a></h3>

                                <p>Streamlined submission tool that creates an outline for annual budget hearing meetings.
                                </p>

                                <a href="{{ route('budgetHearingQuestionnaire.create') }}" class="tool-link">
                                    Submit Questionnaire
                                </a>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <span class="badge bg-info text-primary">Available April 1- Jun 1</span>

                            </div>
                            <div class="card-body">
                                <i class="material-icons">paid</i> <br>


                                <h3>Faculty Salary Tables</h3>

                                <p>Salary data for faculty within the AAUP, in accordance with the annual Provost Fund
                                    Guidance.</p>

                            </div>

                        </div>
                    </div>

                    {{-- one for the academic space usage tool -- contains forecasting tools for academic space requirements --}}
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <span class="badge bg-testing">In Testing</span>
                            </div>
                            <div class="card-body">
                                <i class="material-icons">apartment</i>
                                <h3>Academic Space Needs Dashboard</h3>
                                <p>Forecasting tools for teaching and research space requirements.</p>
                            </div>

                        </div>
                    </div>

                    {{-- one for the strategic plan deicison-making tool, allows units to align their decisionmaking with institutional priorities --}}
                    <div class="col-md-3 mb-4">

                        <div class="card">
                            <div class="card-header">
                                <span class="badge bg-inprogress">In Development</span>
                            </div>
                            <div class="card-body">
                                <i class="material-icons">trending_up</i>
                                <h3>Strategic Plan Decision-making Tool</h3>
                                <p>Tool to assist units in prioritizing their projects in alignment with institutional priorites.</p>
                            </div>

                        </div>
                    </div>

                    {{-- one for the Provost's Office financial committment tracker --}}
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <span class="badge bg-inprogress">In Development</span>
                            </div>
                            <div class="card-body">
                                <i class="material-icons">account_balance</i>
                                <h3>Financial Commitment Tracker</h3>
                                <p>A tool to help units keep track of their financial commitments.</p>
                            </div>

                        </div>
                    </div>


                    {{-- Department Simulation Tool
a tool for modeling departmental operational needs, based on student plans of study and progress toward degree. --}}

                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <span class="badge bg-inprogress">In Development</span>
                            </div>
                            <div class="card-body">
                                <i class="material-icons">engineering</i>
                                <h3>Department Simulation Tool</h3>
                                <p>Modeling departmental operational needs based on student plans of study and progress toward degree.</p>
                            </div>

                        </div>
                    </div>

                    {{-- one for the academic program review tool --}}
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <span class="badge bg-ideation">In Ideation</span>
                            </div>
                            <div class="card-body">
                                <i class="material-icons">school</i>
                                <h3>Minimum Class Size Dashboard</h3>
                                <p>Tool to support units in decisions around low enrollment course offerings and exemption requests.                </p>
                            </div>

                        </div>
                    </div>

                    {{-- one for the faculty hiring tool --}}
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <span class="badge bg-ideation">In Ideation</span>
                            </div>
                            <div class="card-body">
                                <i class="material-icons">people</i>
                                <h3>Faculty Hiring Request Form</h3>
                                <p>Streamlined submission tool for annual faculty hiring requests.     </p>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <script>
        // equalize card heights in #tools
        document.addEventListener('DOMContentLoaded', function() {
            function equalizeCardHeights() {
            var cards = document.querySelectorAll('.card');
            var maxHeight = 0;

            cards.forEach(function(card) {
                card.style.height = 'auto'; // Reset height
                if (card.offsetHeight > maxHeight) {
                maxHeight = card.offsetHeight;
                }
            });

            cards.forEach(function(card) {
                card.style.height = maxHeight + 'px';
            });
            }

            equalizeCardHeights();
            window.addEventListener('resize', equalizeCardHeights);
        });
        
    </script>

@endsection
