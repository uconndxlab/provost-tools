<form
    action="{{ isset($questionnaire) ? route('budgetHearingQuestionnaire.update', ['questionnaire' => $questionnaire->id]) : route('budgetHearingQuestionnaire.store') }}"
    method="POST"
    x-data
>
    @csrf
    @if (isset($questionnaire))
        @method('PUT')
    @endif

    <!-- School/College -->
    <div class="card shadow-sm p-4 mt-4">
        <h2 class="h4 mb-3">School/College or Campus</h2>
        <div class="mb-3">
            <label for="school_college" class="form-label d-none">School/College/Campus</label>
            <select 
                name="school_college" 
                id="school_college" 
                class="form-select"
                x-ref="school_college"
            >
                @if ($schools->count() > 1)
                    <option value="" selected>Select a School/College</option>
                @endif

                @foreach ($schools as $school)
                    <option 
                        value="{{ $school->id }}" 
                        @selected($schools->count() === 1 || (isset($questionnaire) ? $questionnaire->school_college_id === $school->id : request()->query('school') == $school->id)) 
                        data-type="{{ $school->type }}"
                    >
                        {{ $school->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Section Card Template -->
    @php
        $sections = [
            'deficit_mitigation' => [
                'title' => 'Deficit Mitigation',
                'description' => 'Please explain how your unit will meet the FY25 – FY29 budget hearing guidance shared by
                    the Provost and CFO, focusing on FY26 – FY27, including reducing positions, decreasing programming, or eliminating services.'
            ],
            'faculty_hiring' => [
                'title' => 'Faculty Hiring',
                'description' => 'Are you actively recruiting any endowed chairs/professorships or targeted hires with a robust research portfolio?'
            ],
            'student_enrollment' => [
                'title' => 'Student Enrollment',
                'description' => 'What programs have the demand to increase in net new enrollment and what steps are being taken?'
            ],
            'student_retention' => [
                'title' => 'Student Retention, Graduation & Outcomes',
                'description' => 'What is your unit doing to improve student retention and graduation rates, and how do you track post-graduation outcomes?'
            ],
            'foundation_engagement' => [
                'title' => 'Philanthropy',
                'description' => 'What philanthropic contributions of $100,000 or more are currently in the pipeline?'
            ]
        ];
    @endphp

    @foreach ($sections as $field => $section)
        <div class="card shadow-sm p-4 mt-4">
            <h2 class="h4 mb-3">{{ $section['title'] }}</h2>
            <p>{{ $section['description'] }}</p>
            <label for="{{ $field }}" class="form-label d-none">{{ $section['title'] }}</label>
            <textarea 
                id="{{ $field }}" 
                name="{{ $field }}" 
                class="form-control d-none"
                rows="3"
            >{{ isset($questionnaire) ? $questionnaire->$field : '' }}</textarea>
            <trix-editor input="{{ $field }}"></trix-editor>
            <span class="text-muted character_counter">
                <span class="count">
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
            </div>
            <button type="submit" class="btn btn-primary btn-lg">
                Save Submission <i class="bi bi-floppy ms-1"></i>
            </button>
        </div>
    </div>
</form>


<script>
    document.getElementById('school_college').addEventListener('change', function() {
        if (this.value !== '') {
            window.location.href = window.location.pathname + '?school=' + this.value;
        }
    });
</script>
