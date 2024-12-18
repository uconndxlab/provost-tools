@extends('layout')

@section('content')
    <div class="py-5">
        <div class="container">
            <div class="mb-5">
                <div class="d-flex align-items-start">

                    <div>

                        {{-- current user var dump --}}
                        <div class="alert alert-info">
                            <h4 class="alert-heading">Welcome to the Budget Hearing Questionnaire</h4>
                            <p>To center our discussion around how your unit will meet the previously communicated budget guidance, we will focus on reviewing your responses to the questions below. Note that answers should be brief and are exclusively meant as a tool to guide our discussion (each text box has a 3000-character limit).</p>
                        </div>
                    </div>
                    {{-- @if (Auth::check() && Auth::user()->can_admin)
                        <a href="{{ route('admin.budgetHearingQuestionnaire.index') }}"
                            class="btn btn-danger ms-auto btn-sm">Review</a>
                    @endif --}}

                </div>

                @if ( $schools->isEmpty() )
                <div class="alert alert-warning">You do not currently have access to submit this form.  Please contact i3@uconn.edu if you believe this is incorrect.</div>
                @else

                    @include('budget_hearing_questionnaire.form')

                @endif
            </div>
        </div>

        <script>
            // Disables file attachments
            (function() {
                addEventListener("trix-initialize", function(e) {
                const file_tools = document.querySelector(".trix-button-group--file-tools");
                file_tools.remove();
                })
                addEventListener("trix-file-accept", function(e) {
                e.preventDefault();
                })
            })();
            // console log the trix editor content on change
            document.addEventListener('trix-change', function (event) {
                // strip the html tags from the trix editor content and log it
                // update the corresponding character counter that has the same data-element attribute as the curennt trix editor's input
                let strippedContent = event.target.innerText.replace(/(<([^>]+)>)/gi, "");
                let target = event.target.getAttribute('input');
                
                let characterCounter = document.querySelector(`[data-element="${target}"] .count`);

                

                characterCounter.innerText = strippedContent.length;

                // as it gets closer to the 2000 character limit, change the color of the character counter

                if (strippedContent.length > 2600) {
                    characterCounter.style.color = 'red';
                } else if (strippedContent.length > 2200) {
                    characterCounter.style.color = 'orange';
                } else if (strippedContent.length > 1800) {
                    characterCounter.style.color = 'orange';
                } else if (strippedContent.length > 1400) {
                    characterCounter.style.color = 'green';
                } else {
                    characterCounter.style.color = 'black';
                }


                // update the corresponding .count with the length of the stripped content

                // if strippedContent is > 3000 character limit, set it back to 3000
                if (strippedContent.length > 3000) {
                    event.target.editor.setSelectedRange([3000, strippedContent.length]);
                    event.target.editor.deleteInDirection('forward');
                }

            });
        </script>
    @endsection
