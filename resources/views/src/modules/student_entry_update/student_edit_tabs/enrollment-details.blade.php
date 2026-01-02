<!-- ======== TAB 2: ENROLMENT DETAILS ======== -->

@php
    /* ================= SAFETY GUARDS ================= */
    $dropdowns        = $dropdowns ?? [];
    $basic            = $basic ?? [];
    $enrollment_info  = $enrollment_info ?? [];

    $previous_schooling_type_master = $previous_schooling_type_master ?? [];
    $stu_appeared_master            = $stu_appeared_master ?? [];
    $class_master                   = $class_master ?? [];
    $class_section_master           = $class_section_master ?? [];
    $stream_master                  = $stream_master ?? [];
    $school_medium                  = $school_medium ?? [];
    $admission_type_master          = $admission_type_master ?? [];
@endphp


<div class="tab-pane fade" id="enrollment_details" role="tabpanel">

<form id="student_enrollment_details"
      method="POST"
      action="{{ route('student.store_enrollment_details') }}"
      novalidate>

@csrf

<h6 class="card-header bg-heading-primary text-white py-2">
    ENROLLMENT DETAILS OF STUDENT IN PRESENT SCHOOL FOR CURRENT YEAR
</h6>

<div class="row">

<!-- ================= LEFT COLUMN ================= -->
<div class="col-md-6">

    <!-- Admission Number -->
    <div class="mb-3">
        <label class="form-label small">Admission Number in School</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bx bx-hash"></i></span>
            <input type="text"
                   name="admission_number"
                   class="form-control"
                   maxlength="10"
                   inputmode="numeric"
                   value="{{ old('admission_no', $enrollment_info['admission_no'] ?? '') }}">
        </div>
    </div>

    <!-- Status in Previous Academic Year -->
    <div class="mb-3">
        <label class="form-label small">
            Status of student in Previous Academic Year
        </label>
        <div class="input-group">
            <span class="input-group-text"><i class="bx bx-history"></i></span>
            <select name="admission_status_prev"
                    id="admission_status_prev"
                    class="form-select">
                <option value="">-Please Select-</option>
                @foreach($previous_schooling_type_master as $val => $label)
                    <option value="{{ $val }}"
                        {{ ($enrollment_info['status_pre_year'] ?? '') == $val ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Appeared Exam -->
    <div class="mb-3" id="prev_class_studied_appeared_exam" style="display:none;">
        <label class="form-label small">
            Whether appeared for examination
        </label>
        <div class="input-group">
            <span class="input-group-text"><i class="bx bx-history"></i></span>
            <select name="prev_class_appeared_exam"
                    id="prev_class_appeared_exam"
                    class="form-select">
                <option value="">-Please Select-</option>
                @foreach(($dropdowns['prev_class_appeared_exam'] ?? []) as $val => $label)
                    <option value="{{ $val }}"
                        {{ ($enrollment_info['prev_class_appeared_exam'] ?? '') == $val ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Result -->
    <div class="mb-3" id="previous_class_studied_result_examination" style="display:none;">
        <label class="form-label small">Result of examination</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bx bx-history"></i></span>
            <select name="previous_class_result_examination"
                    id="previous_class_result_examination"
                    class="form-select">
                <option value="">-Please Select-</option>
                @foreach($stu_appeared_master as $val => $label)
                    <option value="{{ $val }}"
                        {{ ($enrollment_info['prev_class_exam_result'] ?? '') == $val ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Percentage -->
    <div class="mb-3" id="percentage_of_overall_marks_section" style="display:none;">
        <label class="form-label small">% of marks obtained</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bx bx-history"></i></span>
            <input type="text"
                   name="percentage_of_overall_marks"
                   class="form-control"
                   maxlength="3"
                   inputmode="numeric"
                   value="{{ old('prev_class_marks_percent', $enrollment_info['prev_class_marks_percent'] ?? '') }}">
        </div>
    </div>

    <!-- Days Attended -->
    <div class="mb-3" id="no_of_days_attended_section" style="display:none;">
        <label class="form-label small">No of days attended</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bx bx-history"></i></span>
            <input type="text"
                   name="no_of_days_attended"
                   class="form-control"
                   maxlength="3"
                   inputmode="numeric"
                   value="{{ old('attendention_pre_year', $enrollment_info['attendention_pre_year'] ?? '') }}">
        </div>
    </div>

    <!-- Previous Class -->
    <div class="mb-3" id="previous_class_studied" style="display:none;">
        <label class="form-label small">Previous Class</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bx bx-history"></i></span>
            <select name="previous_class" class="form-select">
                <option value="">-Please Select-</option>
                @foreach($class_master as $val => $label)
                    <option value="{{ $val }}"
                        {{ ($enrollment_info['pre_class_code_fk'] ?? '') == $val ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Present Class -->
    <div class="mb-3">
        <label class="form-label small">Present Class</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bx bx-book"></i></span>
            <select name="present_class" id="present_class" class="form-select">
                <option value="">-Please Select-</option>
                @foreach($class_master as $val => $label)
                    <option value="{{ $val }}"
                        {{ ($enrollment_info['cur_class_code_fk'] ?? '') == $val ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Academic Year -->
    <div class="mb-3">
        <label class="form-label small">Academic Year</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bx bx-calendar"></i></span>
            <select name="accademic_year" class="form-select">
                <option value="">-Please Select-</option>
                @foreach(($dropdowns['accademic_year'] ?? []) as $val => $label)
                    <option value="{{ $val }}"
                        {{ ($enrollment_info['academic_year'] ?? '') == $val ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

</div>

<!-- ================= RIGHT COLUMN ================= -->
<div class="col-md-6">

    <div class="mb-3">
        <label class="form-label small">Admission Date</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bx bx-calendar"></i></span>
            <input type="date"
                   name="admission_date_present"
                   class="form-control"
                   value="{{ old('admission_date', $enrollment_info['admission_date'] ?? '') }}">
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label small">Present Roll No</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bx bx-list-ol"></i></span>
            <input type="number"
                   name="present_roll_no"
                   class="form-control"
                   value="{{ old('cur_roll_number', $enrollment_info['cur_roll_number'] ?? '') }}">
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label small">Admission Type</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bx bx-transfer-alt"></i></span>
            <select name="admission_type" class="form-select">
                <option value="">-Please Select-</option>
                @foreach($admission_type_master as $val => $label)
                    <option value="{{ $val }}"
                        {{ ($enrollment_info['admission_type_code_fk'] ?? '') == $val ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

</div>
</div>

<div class="text-end mt-3">
    <button type="button" class="btn btn-success">Save & Next</button>
</div>

</form>
</div>
