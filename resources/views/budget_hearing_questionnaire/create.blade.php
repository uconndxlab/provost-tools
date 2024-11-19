@extends('layout')

@section('content')
<div class="py-5">
    <div class="container">
        <div class="mb-5">
            <div class="d-flex align-items-start">

                <div>
                    <h1>Budget Hearing Questionnaire</h1>

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
                @if ( Auth::check() && Auth::user()->can_admin )
                <a href="{{ route('admin.faculty_salary_tables.index') }}"
                    class="btn btn-danger ms-auto btn-sm">Review</a>
                @endif
            </div>

            <div class="row">
                <form>
                    <div class="col mt-3">
                        <h2>Deficit Mitigation</h2>
                        <div class="mb-3">
                            <p>Please explain how your unit will meet the FY25 – FY29 budget hearing guidance shared by the Provost and CFO, focusing on FY26 – FY27, including reducing positions, decreasing programming, or eliminating services. Additionally, include any plans for the one-time use of operating or Foundation fund balances.</p>
                            <label for="deficit_mitigation" class="form-label d-none">Deficit Mitigation</label>
                            <textarea name="deficit_mitigation" class="form-control d-none" id="deficit_mitigation" rows="3"></textarea>
                            <trix-editor input="deficit_mitigation"></trix-editor>
                        </div>
                    </div>
                    <div class="col mt-3">
                        <h2>Faculty Hiring</h2>
                        <div class="mb-3">
                            <p>Are you actively recruiting any endowed chairs/professorships or targeted hires with a robust research portfolio? If not, where might you consider doing so to build on existing or emerging strengths in your unit?</p>
                            <label for="faculty_hiring" class="form-label d-none">Faculty Hiring</label>
                            <textarea
                            id="faculty_hiring" 
                            name="faculty_hiring"
                            class="form-control d-none" id="faculty_hiring" rows="3"></textarea>
                            <trix-editor input="faculty_hiring"></trix-editor>
                        </div>
                    </div>              
                    
                    <div class="col mt-3">
                        <h2>Student Enrollment</h2>
                        <div class="mb-3">
                            <p>What programs have the demand to increase in net new enrollment based on your discussions with Student Life & Enrollment, what steps are being taken to attract new students, and what additional resources would be needed to support the increased enrollment?</p>
                            <label for="student_enrollment" class="form-label d-none">Student Enrollment</label>
                            <textarea 
                            id="student_enrollment"
                            name="student_enrollment"
                            class="form-control d-none" id="student_enrollment" rows="3"></textarea>
                            <trix-editor input="student_enrollment"></trix-editor>
                        </div>
                    </div>

                    <div class="col mt-3">
                        <h2>Student Retention, Graduation & Outcomes</h2>
                        <div class="mb-3">
                            <p>We are fundamentally here to serve our students, ensuring that they receive value in their education to achieve future success. What is your unit doing to improve student retention and graduation rates, and how do you track post-graduation outcomes?</p>
                            <label for="student_retention" class="form-label d-none">Student Retention, Graduation & Outcomes</label>
                            <textarea 
                            id="student_retention"
                            name="student_retention"
                            class="form-control d-none" id="student_retention" rows="3"></textarea>
                            <trix-editor input="student_retention"></trix-editor>
                        </div>
                    </div>

                    <div class="col mt-3">
                        <h2>Foundation Engagement</h2>
                        <div class="mb-3">
                            <p>To align with these budget plans and strategic investments in faculty, enrollment growth, and student success initiatives, what philanthropic contributions of $100,000 or more are currently in the pipeline?</p>
                            <label for="foundation_engagement" class="form-label d-none">Foundation Engagement</label>
                            <textarea 
                            id="foundation_engagement"
                            name="foundation_engagement"
                            class="form-control d-none"  rows="3"></textarea>
                            <trix-editor input="foundation_engagement"></trix-editor>
                        </div>
                    </div>

                    {{-- card for save options --}}
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                
                                <button type="submit" class="btn btn-primary btn-lg">Save Submission <i class="bi bi-floppy"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @endsection