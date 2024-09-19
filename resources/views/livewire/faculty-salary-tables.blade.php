<div>
    <div class="row mb-4">
        <div class="col mb-3 mb-lg-0">
            <input type="text" class="form-control" name="search" placeholder="Search" wire:model.live="search">
        </div>
        <div class="col-lg-6 d-flex align-items-center justify-content-end">
            <div class="dropdown mx-2">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="schoolDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ $school ? $school : 'Filter by School/College' }}
                </button>
                <ul class="dropdown-menu" aria-labelledby="schoolDropdown">
                    <li><a class="dropdown-item" x-on:click="$wire.set('school', '')">All Schools/Colleges</a></li>
                    @foreach($schools as $school)
                    <li>
                        <a x-on:click="$wire.set('school', '{{ $school }}')" class="dropdown-item">{{ $school }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
            {{-- <noscript><button type="submit">Filter</button></noscript> --}}
            @if ( $departments->count() > 0 )
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="departmentDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ $department ? $department : 'Filter by Department' }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="departmentDropdown">
                        <li><a class="dropdown-item" x-on:click="$wire.set('department', '')">All Departments</a></li>
                        @foreach($departments as $department)
                        <li>
                            <a x-on:click="$wire.set('department', '{{ $department }}')" class="dropdown-item">{{ $department }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <p>No departments found for {{ $school }}</p>
            @endif
        </div>
    </div>

    {{ $faculty_salary_tables->links() }}

    <div class="table-scroller d-flex justify-content-between align-items-center mb-3">
        <button onclick="document.getElementById('fstTableContain').scrollLeft -= document.getElementById('fstTableContain').getBoundingClientRect().width / 2;" class="btn btn-primary btn-xl btn-block">
            Scroll Left
        </button>
        <button onclick="document.getElementById('fstTableContain').scrollLeft += document.getElementById('fstTableContain').getBoundingClientRect().width / 2;" class="btn btn-primary btn-xl btn-block">
            Scroll Right
        </button>
    </div>


    <div class="overflow-x-auto font-monospace" id="fstTableContain">
        <table class="table table-striped table-sm table-hover overflow-x-scroll w-100 mx-auto position-relative table-bordered" style="table-layout:fixed; font-size: 12px;" >
            <colgroup>
                <col width="230"> <!-- Name/Union -->
                <col width="200"> <!-- Academic School/College -->
                <col width="300"> <!-- Role/Rank/Career -->
                <col width="100"> <!-- Base -->
                <col width="100"> <!-- Addt'l 1 Mon -->
                <col width="100"> <!-- Addt'l 2 Mon -->
                <col width="130"> <!-- Full Time Annual Salary -->
                <col width="100"> <!-- FTE % -->
                <col width="100"> <!-- Faculty Base Appointment Term -->
                <col width="100"> <!-- Appointment Term -->
                <col width="100"> <!-- 9 Mo Equivalent Annual Salary -->
                <col width="100"> <!-- 9 Mo Equivalent Base Salary -->
                <col width="100"> <!-- Emplid -->
                <col width="100"> <!-- Netid -->
                <col width="100"> <!-- Gender -->
                <col width="100"> <!-- Years of Service -->
                <col width="100"> <!-- Assistant Professor Year -->
                <col width="100"> <!-- Associate Professor Year -->
                <col width="100"> <!-- Professor Year -->
                <col width="100"> <!-- Years in Rank -->
            </colgroup>
            <thead>
                <tr>
                    <th class="position-sticky" style="left: 0;">
                        <a href="#" class="me-2" wire:click.prevent="sortBy('full_name')">
                            Name
                            @if ( $sort === 'full_name' )
                            <i @class(['bi-arrow-up' => $sortDirection === 'asc', 'bi-arrow-down' => $sortDirection === 'desc'])></i>
                            @endif
                        </a>
                        /
                        <a href="#" class="ms-2" wire:click.prevent="sortBy('union_name')">
                            Union
                            @if ( $sort === 'union_name' )
                            <i @class(['bi-arrow-up' => $sortDirection === 'asc', 'bi-arrow-down' => $sortDirection === 'desc'])></i>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" class="me-2" wire:click.prevent="sortBy('academic_school_college')">
                            School
                            @if ( $sort === 'academic_school_college' )
                            <i @class(['bi-arrow-up' => $sortDirection === 'asc', 'bi-arrow-down' => $sortDirection === 'desc'])></i>
                            @endif
                        </a>
                        /
                        <a href="#" class="ms-2" wire:click.prevent="sortBy('academic_department')">
                            Department
                            @if ( $sort === 'academic_department' )
                            <i @class(['bi-arrow-up' => $sortDirection === 'asc', 'bi-arrow-down' => $sortDirection === 'desc'])></i>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" class="me-2" wire:click.prevent="sortBy('faculty_role')">
                            Role
                            @if ( $sort === 'faculty_role' )
                            <i @class(['bi-arrow-up' => $sortDirection === 'asc', 'bi-arrow-down' => $sortDirection === 'desc'])></i>
                            @endif
                        </a>
                        /
                        <a href="#" class="mx-2" wire:click.prevent="sortBy('rank_description')">
                            Rank
                            @if ( $sort === 'rank_description' )
                            <i @class(['bi-arrow-up' => $sortDirection === 'asc', 'bi-arrow-down' => $sortDirection === 'desc'])></i>
                            @endif
                        </a>
                        /
                        <a href="#" class="ms-2" wire:click.prevent="sortBy('tt_ntt')">
                            (Career)
                            @if ( $sort === 'tt_ntt' )
                            <i @class(['bi-arrow-up' => $sortDirection === 'asc', 'bi-arrow-down' => $sortDirection === 'desc'])></i>
                            @endif
                        </a>
                    </th>
                    <th class="text-end">
                        <a href="#" class="me-2" wire:click.prevent="sortBy('faculty_base_ucannl')">
                            Base
                            @if ( $sort === 'faculty_base_ucannl' )
                            <i @class(['bi-arrow-up' => $sortDirection === 'asc', 'bi-arrow-down' => $sortDirection === 'desc'])></i>
                            @endif
                        </a>
                    </th>
                    <th class="text-end">
                        <a href="#" class="me-2" wire:click.prevent="sortBy('additional_1_month_uc1mth')">
                            Addt'l 1 Mon
                            @if ( $sort === 'additional_1_month_uc1mth' )
                            <i @class(['bi-arrow-up' => $sortDirection === 'asc', 'bi-arrow-down' => $sortDirection === 'desc'])></i>
                            @endif
                        </a>
                    </th>
                    <th class="text-end">
                        <a href="#" class="me-2" wire:click.prevent="sortBy('additional_2_month_uc2mth')">
                            Addt'l 2 Mon
                            @if ( $sort === 'additional_2_month_uc2mth' )
                            <i @class(['bi-arrow-up' => $sortDirection === 'asc', 'bi-arrow-down' => $sortDirection === 'desc'])></i>
                            @endif
                        </a>
                    </th>
                    <th class="text-end">
                        <a href="#" class="me-2" wire:click.prevent="sortBy('full_time_annual_salary')">
                            Full Time Annual Salary
                            @if ( $sort === 'full_time_annual_salary' )
                            <i @class(['bi-arrow-up' => $sortDirection === 'asc', 'bi-arrow-down' => $sortDirection === 'desc'])></i>
                            @endif
                        </a>
                    </th>
                    <th class="text-end">
                        <a href="#" class="me-2" wire:click.prevent="sortBy('payroll_fte')">
                            FTE %
                            @if ( $sort === 'payroll_fte' )
                            <i @class(['bi-arrow-up' => $sortDirection === 'asc', 'bi-arrow-down' => $sortDirection === 'desc'])></i>
                            @endif
                        </a>
                    </th>
                    <th class="text-end">
                        <a href="#" class="me-2" wire:click.prevent="sortBy('faculty_base_appointment_term')">
                            Faculty Base Appointment Term
                            @if ( $sort === 'faculty_base_appointment_term' )
                            <i @class(['bi-arrow-up' => $sortDirection === 'asc', 'bi-arrow-down' => $sortDirection === 'desc'])></i>
                            @endif
                        </a>
                    </th>
                    <th class="text-end">
                        <a href="#" class="me-2" wire:click.prevent="sortBy('appointment_term')">
                            Appointment Term
                            @if ( $sort === 'appointment_term' )
                            <i @class(['bi-arrow-up' => $sortDirection === 'asc', 'bi-arrow-down' => $sortDirection === 'desc'])></i>
                            @endif
                        </a>
                    </th>
                    <th class="text-end">
                        <a href="#" class="me-2" wire:click.prevent="sortBy('nine_mo_equivalent_of_annual_salary')">
                            9 Mo Equivalent Annual Salary
                            @if ( $sort === 'nine_mo_equivalent_of_annual_salary' )
                            <i @class(['bi-arrow-up' => $sortDirection === 'asc', 'bi-arrow-down' => $sortDirection === 'desc'])></i>
                            @endif
                        </a>
                    </th>
                    <th class="text-end">
                        <a href="#" class="me-2" wire:click.prevent="sortBy('nine_mo_equivalent_of_base_salary')">
                            9 Mo Equivalent Base Salary
                            @if ( $sort === 'nine_mo_equivalent_of_base_salary' )
                            <i @class(['bi-arrow-up' => $sortDirection === 'asc', 'bi-arrow-down' => $sortDirection === 'desc'])></i>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" class="me-2" wire:click.prevent="sortBy('emplid')">
                            Emplid
                            @if ( $sort === 'emplid' )
                            <i @class(['bi-arrow-up' => $sortDirection === 'asc', 'bi-arrow-down' => $sortDirection === 'desc'])></i>
                            @endif
                        </a>
                    </th>
                    <th>
                        NetID
                    </th>
                    <th>
                        <a href="#" class="me-2" wire:click.prevent="sortBy('gender')">
                            Gender
                            @if ( $sort === 'gender' )
                            <i @class(['bi-arrow-up' => $sortDirection === 'asc', 'bi-arrow-down' => $sortDirection === 'desc'])></i>
                            @endif
                        </a>
                    </th>
                    <th class="text-end">
                        <a href="#" class="me-2" wire:click.prevent="sortBy('years_of_service')">
                            Years of Service
                            @if ( $sort === 'years_of_service' )
                            <i @class(['bi-arrow-up' => $sortDirection === 'asc', 'bi-arrow-down' => $sortDirection === 'desc'])></i>
                            @endif
                        </a>
                    </th>
                    <th class="text-end">
                        <a href="#" class="me-2" wire:click.prevent="sortBy('assistant_professor_year')">
                            Assistant Professor Year
                            @if ( $sort === 'assistant_professor_year' )
                            <i @class(['bi-arrow-up' => $sortDirection === 'asc', 'bi-arrow-down' => $sortDirection === 'desc'])></i>
                            @endif
                        </a>
                    </th>
                    <th class="text-end">
                        <a href="#" class="me-2" wire:click.prevent="sortBy('associate_professor_year')">
                            Associate Professor Year
                            @if ( $sort === 'associate_professor_year' )
                            <i @class(['bi-arrow-up' => $sortDirection === 'asc', 'bi-arrow-down' => $sortDirection === 'desc'])></i>
                            @endif
                        </a>
                    </th>
                    <th class="text-end">
                        <a href="#" class="me-2" wire:click.prevent="sortBy('professor_year')">
                            Professor Year
                            @if ( $sort === 'professor_year' )
                            <i @class(['bi-arrow-up' => $sortDirection === 'asc', 'bi-arrow-down' => $sortDirection === 'desc'])></i>
                            @endif
                        </a>
                    </th>
                    <th class="text-end">
                        <a href="#" class="me-2" wire:click.prevent="sortBy('years_in_rank')">
                            Years in Rank
                            @if ( $sort === 'years_in_rank' )
                            <i @class(['bi-arrow-up' => $sortDirection === 'asc', 'bi-arrow-down' => $sortDirection === 'desc'])></i>
                            @endif
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($faculty_salary_tables as $facultySalaryTable)
                <tr>
                    <td class="position-sticky border-left" style="left: 0;">
                        <span class="badge text-bg-dark">{{ $facultySalaryTable->union_name }}</span>
                        <span class="mt-2 d-block">{{ $facultySalaryTable->full_name }}</span>
                    </td>
                    <td >
                        <span class="badge text-bg-dark">{{ $facultySalaryTable->academic_school_college }}</span>
                        <span class="d-block mt-2">
                            {{ $facultySalaryTable->academic_department }}
                            @if ( $facultySalaryTable->affiliated_department_name_administrative_roles )
                                ({{ $facultySalaryTable->affiliated_department_name_administrative_roles }})
                            @endif
                        </span>
                    </td>
                    <td>
                        <small class="d-block">{{ $facultySalaryTable->faculty_role }}</small> -- 
                        <strong>{{ $facultySalaryTable->rank_description }}</strong>
                        ({{ $facultySalaryTable->tt_ntt }})
                    </td>
                    <td class="text-end bg-hover-green">
                        ${{ Number::format($facultySalaryTable->faculty_base_ucannl) }}
                    </td>
                    <td class="text-end bg-hover-green">
                        {{ Number::format($facultySalaryTable->additional_1_month_uc1mth) }}
                    </td>
                    <td class="text-end bg-hover-green">
                        {{ Number::format($facultySalaryTable->additional_2_month_uc2mth) }}
                    </td>
                    <td class="text-end bg-hover-green">
                        ${{ Number::format($facultySalaryTable->full_time_annual_salary) }}
                    </td>
                    <td class="text-end">
                        {{ $facultySalaryTable->payroll_fte * 100 }}
                    </td>
                    <td class="text-end">
                        {{ $facultySalaryTable->faculty_base_appointment_term }}
                    </td>
                    <td class="text-end">
                        {{ $facultySalaryTable->appointment_term }}
                    </td>
                    <td class="text-end">
                        ${{ Number::format($facultySalaryTable->nine_mo_equivalent_of_annual_salary) }}
                    </td>
                    <td class="text-end">
                        ${{ Number::format($facultySalaryTable->nine_mo_equivalent_of_base_salary) }}
                    </td>
                    <td>
                        {{ $facultySalaryTable->emplid }}
                    </td>
                    <td>
                        {{ $facultySalaryTable->user->netid ?? '' }}
                    </td>
                    <td>
                        {{ $facultySalaryTable->gender }}
                    </td>
                    <td class="text-end">
                        {{ $facultySalaryTable->years_of_service }}
                    </td>
                    <td class="text-end">
                        {{ $facultySalaryTable->assistant_professor_year }}
                    </td>
                    <td class="text-end">
                        {{ $facultySalaryTable->associate_professor_year }}
                    </td>
                    <td class="text-end">
                        {{ $facultySalaryTable->professor_year }}
                    </td>
                    <td class="text-end">
                        {{ $facultySalaryTable->years_in_rank }}    
                    </td>
                </tr>
                @endforeach

                @if ( $faculty_salary_tables->count() == 0 )
                <tr>
                    <td colspan="20">No faculty found. Either adjust your query, or you might not have access to view those tables.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    {{ $faculty_salary_tables->links() }}
</div>
