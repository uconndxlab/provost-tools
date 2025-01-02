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
                <div class="poet-line-container">
                    <div class="poet-line">
                        <div class="poet-dot">&#10003;</div>
                        <span>Streamline Operations</span>
                    </div>
                    <div class="poet-line">
                        <div class="poet-dot">&#10003;</div>
                        <span>Foster Collaboration</span>
                    </div>
                    <div class="poet-line">
                        <div class="poet-dot">&#10003;</div>
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
                                </p>
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


                                <h3>Faculty Salary Tables</h3>

                                <p>Salary data for faculty within the AAUP, in accordance with the annual Provost Fund
                                    Guidance.</p>

                            </div>
                            <div class="card-footer">
                                <span class="badge bg-info text-primary">Available April 1- Jun 1</span>

                            </div>
                        </div>
                    </div>

                    {{-- one for the academic space usage tool -- contains forecasting tools for academic space requirements --}}
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <i class="material-icons">apartment</i>
                                <h3>Academic Space Usage Dashboard</h3>
                                <p>Forecasting tools for teaching and research space requirements.</p>
                            </div>
                            <div class="card-footer">
                                <a href="#" class="tool-link">
                                    Coming soon
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- one for the strategic plan deicison-making tool, allows units to align their decisionmaking with institutional priorities --}}
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <i class="material-icons">trending_up</i>
                                <h3>Strategic Plan Decision-making Tool</h3>
                                <p>Align your unit's decision-making with institutional priorities.</p>
                            </div>
                            <div class="card-footer">
                                <a href="#" class="tool-link">
                                    Coming soon
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- one for the Provost's Office financial committment tracker --}}
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <i class="material-icons">account_balance</i>
                                <h3>Provost's Office Financial Commitment Tracker</h3>
                                <p>Track financial commitments made by the Provost's Office.</p>
                            </div>
                            <div class="card-footer">
                                <a href="#" class="tool-link">
                                    Coming soon
                                </a>
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
