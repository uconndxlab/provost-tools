@extends('layout')

@section('content')
    <div class="py-5">
        <div class="container">
            <div class="mb-5">
                <div class="d-flex align-items-start">

                    <div>
                        <h1>Budget Hearing Questionnaire</h1>
                        {{-- current user var dump --}}
                        <p>Supporting our 10-year strategic plan requires a reallocation of institutional resources. The
                            previously communicated permanent 2-ledger budget reductions for the coming years will ensure
                            our finances move towards long-term financial sustainability, and our institutional priorities
                            and goals are appropriately resourced.</p>

                        <p>In this year's budget hearings, we will center our discussion around how your unit will meet the
                            budget guidance through a review of your FY25 - FY27 forecasts, along with the responses to the
                            questions in the submission linked [here]. As part of our assessment of current resources we
                            also ask you to submit a faculty teaching load report through this submission, detailing the
                            expected and actual teaching load of each faculty member within your unit.</p>
                    </div>
                    @if (Auth::check() && Auth::user()->can_admin)
                        <a href="{{ route('admin.budgetHearingQuestionnaire.index') }}"
                            class="btn btn-danger ms-auto btn-sm">Review</a>
                    @endif
                </div>

                <div class="row">
                    @include('budget_hearing_questionnaire.form_schoolCollege')
                </div>
            </div>
        </div>

        <script>
            // console log the trix editor content on change
            document.addEventListener('trix-change', function (event) {
                // strip the html tags from the trix editor content and log it
                // update the corresponding character counter that has the same data-element attribute as the curennt trix editor's input
                let strippedContent = event.target.innerText.replace(/(<([^>]+)>)/gi, "");
                let target = event.target.getAttribute('input');
                
                let characterCounter = document.querySelector(`[data-element="${target}"] .count`);

                

                characterCounter.innerText = strippedContent.length;

                // as it gets closer to the 2000 character limit, change the color of the character counter

                if (strippedContent.length > 1800) {
                    characterCounter.style.color = 'red';
                } else if (strippedContent.length > 1600) {
                    characterCounter.style.color = 'orange';
                } else if (strippedContent.length > 1400) {
                    characterCounter.style.color = 'orange';
                } else if (strippedContent.length > 1200) {
                    characterCounter.style.color = 'green';
                } else {
                    characterCounter.style.color = 'black';
                }


                // update the corresponding .count with the length of the stripped content


            });
        </script>
    @endsection
