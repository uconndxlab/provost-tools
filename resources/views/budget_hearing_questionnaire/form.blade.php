<form
    action="{{ isset($questionnaire) ? route('budgetHearingQuestionnaire.update', ['questionnaire' => $questionnaire->id]) : route('budgetHearingQuestionnaire.store') }}"
    method="POST" x-data>
    @csrf
    @if (isset($questionnaire))
    @method('PUT')
    @endif

    <!-- School/College -->
    <div class="card shadow-sm p-4 mt-4">
        <h2 class="h4 mb-3">School/College, Campus or Unit</h2>
        <div class="mb-3">
            <label for="school_college" class="form-label d-none">School/College/Campus</label>
            <select name="school_college" id="school_college" class="form-select" x-ref="school_college">

                <option value="" selected>Select a School/College, Campus or Unit</option>


                @foreach ($schools as $school)
                <option value="{{ $school->id }}" @selected($schools->count() === 1 || (isset($questionnaire) ?
                    $questionnaire->school_college_id === $school->id : request()->query('school') == $school->id))
                    data-type="{{ $school->type }}"
                    >
                    {{ $school->name }}
                </option>
                @endforeach
            </select>

            {{-- button for "show the form" --}}

            {{-- if request-> school is not set --}}

                <a href="{{ route('budgetHearingQuestionnaire.create') }}?school=" 
                onclick="this.href=this.href + document.getElementById('school_college').value" 
                class="btn btn-primary mt-3 @if(request()->query('school')) d-none @endif">
                    Continue &raquo;
                </a>

        </div>
    </div>

    <!-- Section Card Template -->
    @php
    $sections = [
    'deficit_mitigation' => [
    'school_types' => ['school', 'campus', 'library'],
    'title' => 'Deficit Mitigation',
    'description' => 'Please explain how your unit will meet the FY25 – FY29 budget hearing guidance shared by the Provost and CFO, focusing on FY26 – FY27, including reducing vacancies/positions, decreasing programming, or eliminating services.  Additionally, include any plans for the one-time use of operating or Foundation fund balances to bridge the gap until permanent reductions are achieved.'
    ],
    'faculty_hiring' => [
    'school_types' => ['school'],
    'title' => 'Research Goals and Targeted Faculty Hiring',
    'description' => 'Are you actively recruiting any endowed chairs/professorships or targeted hires with a robust research portfolio? If not, where might you consider doing so to build on existing or emerging strengths in your unit?'
    ],
    'student_enrollment' => [
    'school_types' => ['school','campus'],
    'title' => 'Instructional Needs and Student Enrollment',
    'description' => 'What academic programs have the demand to increase in net new enrollment based on your discussions with Student Life & Enrollment? What additional resources would be needed to support the increased enrollment and instructional needs?'
    ],
    'student_retention' => [
    'school_types' => ['school', 'campus'],
    'title' => 'Student Retention, Graduation & Post-Graduation Outcomes',
    'description' => 'We are fundamentally here to serve our students, ensuring that they receive value in their education to achieve future success. What is your unit doing to improve student retention and graduation rates, and how do you track post-graduation outcomes?'
    ],
    'foundation_engagement' => [
    'school_types' => ['school'],
    'title' => 'Philanthropy',
    'description' => 'To align with these budget plans and strategic investments in research, enrollment growth, and student success initiatives, what major gifts of $100,000 or more are currently in the pipeline?'
    ],

    'library_student_enrollment' => [
    'school_types' => ['library'],
    'title' => 'Student Enrollment',
    'description' => 'Are there any additional resources that would be needed to support increased enrollment in the
    student body?'
    ],

    'library_research_activity' => [
    'school_types' => ['library'],
    'title' => 'Research Activity',
    'description' => 'What resources do you need to ensure that the Library is able to support the University’s research
    goals?'
    ],
    ];
    @endphp

    @if (request()->query('school') && $schools->find(request()->query('school')))

    @foreach ($sections as $field => $section)
    @php
        $school = request()->query('school') ? $schools->find(request()->query('school')) : $schools->first();
    @endphp
    @if (!in_array($school->type, $section['school_types'])) @continue @endif
    <div class="card shadow-sm p-4 mt-4">
        <h2 class="h4 mb-3">{{ $section['title'] }}</h2>
        <p>{{ $section['description'] }}</p>
        <label for="{{ $field }}" class="form-label d-none">{{ $section['title'] }}</label>
        <textarea id="{{ $field }}" name="{{ $field }}" class="form-control d-none"
            rows="3">{{ isset($questionnaire) ? $questionnaire->$field : '' }}</textarea>
        <trix-editor input="{{ $field }}"></trix-editor>
        <span data-element="{{ $field }}" class="text-muted character_counter">
            <span class="count" >
                {{ isset($questionnaire) ? strlen(strip_tags($questionnaire->$field)) : 0 }}
            </span>/3000 (max # of characters)
        </span>
    </div>
    @endforeach

    <!-- Sticky Save Card -->
    <div class="card sticky-bottom shadow-sm mt-4" style="border: 1px solid #ddd;">
        <div class="card-body d-flex align-items-center justify-content-between">
            <div class="text-muted">
                <i class="bi bi-info-circle me-1"></i>
                You can save your progress at any point and return to this form later. 


                @if (isset($questionnaire))
                <a href="{{ route('budgetHearingQuestionnaire.show', $questionnaire->id) }}" class="ms-3">
                    <i class="bi bi-arrow-right"></i> View Submission (last saved on
                    {{ $questionnaire->updated_at->format('m/d/Y') }})</a> @endif

            </div>
            <button type="submit" class="btn btn-primary btn-lg">
                Save Submission <i class="bi bi-floppy ms-1"></i>
            </button>
        </div>
    </div>

    @endif
</form>


<script>
    document.getElementById('school_college').addEventListener('change', function() {
        if (this.value !== '') {
            window.location.href = window.location.pathname + '?school=' + this.value;
        }
    });
</script>