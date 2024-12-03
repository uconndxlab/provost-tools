<form action="{{ isset($questionnaire) ? route('budgetHearingQuestionnaire.update', ['user' => Auth::user()->id, 'questionnaire' => $questionnaire->id]) : route('budgetHearingQuestionnaire.store', ['user' => Auth::user()->id]) }}"
    method="POST"
    x-data="{
        type: 'campus'
    }">
    @csrf
    @if(isset($questionnaire))
        @method('PUT')
    @endif
    <div class="col mt-3">
        <h2>School/College or Campus</h2>
        <div class="mb-3">
            <label for="school_college" class="form-label d-none">School/College/Campus</label>
            <select name="school_college" id="school_college" class="form-select" x-on:change="type = $el.options[$el.selectedIndex].dataset.type">
                <option value="school-college">Select School/College/Campus</option>

                @foreach ($schools as $school)
                    <option value="{{ $school->id }}" @selected(isset($questionnaire) && $questionnaire->school_college == $school->id) data-type="{{ $school->type }}">{{ $school->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col mt-3">
        <h2>Deficit Mitigation</h2>
        <div class="mb-3">
            <p>Please explain how your unit will meet the FY25 – FY29 budget hearing guidance shared by
                the Provost and CFO, focusing on FY26 – FY27, including reducing positions, decreasing
                programming, or eliminating services. Additionally, include any plans for the one-time
                use of operating or Foundation fund balances.</p>

            <label for="deficit_mitigation" class="form-label d-none">Deficit Mitigation</label>
            <textarea name="deficit_mitigation" class="form-control d-none" id="deficit_mitigation" rows="3">{{ isset($questionnaire) ? $questionnaire->deficit_mitigation : '' }}</textarea>
            <trix-editor input="deficit_mitigation"></trix-editor>
            <span class="text-muted" class="character_counter" data-element="deficit_mitigation">
                <span class="count">{{ isset($questionnaire) ? strlen(strip_tags($questionnaire->deficit_mitigation)) : 0 }}</span>/2000 (max # of characters)
            </span>
        </div>
    </div>


    <div class="col mt-3" x-show="type === 'school'">
        
        <h2>Faculty Hiring</h2>
        <div class="mb-3">
            <p>Are you actively recruiting any endowed chairs/professorships or targeted hires with a
                robust research portfolio? If not, where might you consider doing so to build on
                existing or emerging strengths in your unit?</p>
            <label for="faculty_hiring" class="form-label d-none">Faculty Hiring</label>
            <textarea id="faculty_hiring" name="faculty_hiring" class="form-control d-none" id="faculty_hiring" rows="3">{{ isset($questionnaire) ? $questionnaire->faculty_hiring : '' }}</textarea>
            <trix-editor input="faculty_hiring"></trix-editor>

            <span class="text-muted" class="character_counter" data-element="faculty_hiring">
                <span class="count">{{ isset($questionnaire) ? strlen(strip_tags($questionnaire->faculty_hiring)) : 0 }}</span>/2000 (max # of characters)
            </span>
        </div>
    </div>

    <div class="col mt-3">
        <h2>Student Enrollment</h2>
        <div class="mb-3">
            <p>What programs have the demand to increase in net new enrollment based on your discussions
                with Student Life & Enrollment, what steps are being taken to attract new students, and
                what additional resources would be needed to support the increased enrollment?</p>
            <label for="student_enrollment" class="form-label d-none">Student Enrollment</label>
            <textarea id="student_enrollment" name="student_enrollment" class="form-control d-none" id="student_enrollment"
                rows="3">{{ isset($questionnaire) ? $questionnaire->student_enrollment : '' }}</textarea>
            <trix-editor input="student_enrollment"></trix-editor>
            <span class="text-muted character_counter" data-element="student_enrollment">
                <span class="count">{{ isset($questionnaire) ? strlen(strip_tags($questionnaire->student_enrollment)) : 0 }}</span>/2000 (max # of characters)
            </span>
        </div>
    </div>

    <div class="col mt-3">
        <h2>Student Retention, Graduation & Outcomes</h2>
        <div class="mb-3">
            <p>We are fundamentally here to serve our students, ensuring that they receive value in
                their education to achieve future success. What is your unit doing to improve student
                retention and graduation rates, and how do you track post-graduation outcomes?</p>
            <label for="student_retention" class="form-label d-none">Student Retention, Graduation &
                Outcomes</label>
            <textarea id="student_retention" name="student_retention" class="form-control d-none" id="student_retention"
                rows="3">{{ isset($questionnaire) ? $questionnaire->student_retention : '' }}</textarea>
            <trix-editor input="student_retention"></trix-editor>
            
            <span class="text-muted character_counter" data-element="student_retention">
                <span class="count">{{ isset($questionnaire) ? strlen(strip_tags($questionnaire->student_retention)) : 0 }}</span>/2000 (max # of characters)
            </span>


        </div>
    </div>

    <div class="col mt-3">
        <h2>Foundation Engagement</h2>
        <div class="mb-3">
            <p>To align with these budget plans and strategic investments in faculty, enrollment growth,
                and student success initiatives, what philanthropic contributions of $100,000 or more
                are currently in the pipeline?</p>
            <label for="foundation_engagement" class="form-label d-none">Foundation Engagement</label>
            <textarea id="foundation_engagement" name="foundation_engagement" class="form-control d-none" rows="3">{{ isset($questionnaire) ? $questionnaire->foundation_engagement : '' }}</textarea>
            <trix-editor input="foundation_engagement"></trix-editor>

            <span class="text-muted character_counter" data-element="foundation_engagement">
                <span class="count">{{ isset($questionnaire) ? strlen(strip_tags($questionnaire->foundation_engagement)) : 0 }}</span>/2000 (max # of characters)
            </span>

        </div>
    </div>

    {{-- card for save options --}}
    <div class="card mt-3">
        <div class="card-body">
            <div class="d-flex justify-content-center">

                <button type="submit" class="btn btn-primary btn-lg">Save Submission <i
                        class="bi bi-floppy"></i></button>
            </div>
        </div>
    </div>
</form>