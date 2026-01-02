<!-- ================= TAB 7 : ADDITIONAL DETAILS ================= -->

@php
    /* ================= SAFETY INITIALIZATION ================= */

    // main data
    $additional_info = $additional_info ?? ($data['student_additional_details'] ?? []);

    // dropdown safety
    $dropdowns = $dropdowns ?? [];

    $currentExamDropdown =
        $dropdowns['additional_current_class_academic_details'] ?? [];

    $distanceDropdown =
        $bs_student_residence_to_school_distance ?? [];
@endphp


<div class="tab-pane fade"
     id="additional_dtls_tab"
     role="tabpanel"
     aria-labelledby="additional_dtls">

<form id="additionalDetailsForm" method="POST">
@csrf

<h6 class="card-header bg-heading-primary text-white py-2">
    Additional Details
</h6>

<div class="row">
<div class="col-md-6">

    {{-- ================= RTE AMOUNT ================= --}}
    <div class="mb-3">
        <label class="form-label small">
            Amount Claimed from Government for RTE entitlement (₹)
            <span class="text-danger">*</span>
        </label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="bx bx-spreadsheet"></i>
            </span>
            <input name="rte_entitlement_claimed_amount"
                   type="text"
                   class="form-control"
                   placeholder="Amount"
                   value="{{ old('rte_entitlement_claimed_amount', $additional_info['rte_entitlement_claimed_amount'] ?? '') }}">
        </div>
    </div>

    {{-- ================= DISTANCE ================= --}}
    <div class="mb-3">
        <label class="form-label small">
            Approximate Distance of student’s residence to school (in KM)
            <span class="text-danger">*</span>
        </label>

        <div class="input-group">
            <span class="input-group-text">
                <i class="bx bx-map"></i>
            </span>

            <select name="stu_residance_sch_distance_code_fk"
                    id="stu_residance_sch_distance_code_fk"
                    class="form-select select2">

                <option value="">-Please Select-</option>

                @foreach($distanceDropdown as $val => $label)
                    <option value="{{ $val }}"
                        {{ ($additional_info['stu_residance_sch_distance_code_fk'] ?? '') == $val ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach

            </select>
        </div>
    </div>

    {{-- ================= CURRENT YEAR RESULT ================= --}}
    <div class="mb-3">
        <label class="form-label small">
            In the Class studied in CURRENT AY – Result of the examination
            <span class="text-danger">*</span>
        </label>

        <div class="input-group">
            <span class="input-group-text">
                <i class="bx bx-book"></i>
            </span>

            <select name="cur_class_appeared_exam"
                    class="form-select select2">

                <option value="">-Please Select-</option>

                @foreach($currentExamDropdown as $val => $label)
                    <option value="{{ $val }}"
                        {{ ($additional_info['cur_class_appeared_exam'] ?? '') == $val ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach

            </select>
        </div>
    </div>

    {{-- ================= ATTENDANCE ================= --}}
    <div class="mb-3">
        <label class="form-label small">
            No. of days child attended school (CURRENT AY)
            <span class="text-danger">*</span>
        </label>

        <div class="input-group">
            <span class="input-group-text">
                <i class="bx bx-calendar"></i>
            </span>

            <input name="attendention_cur_year"
                   type="text"
                   class="form-control"
                   placeholder="No. of Days"
                   value="{{ old('attendention_cur_year', $additional_info['attendention_cur_year'] ?? '') }}">
        </div>
    </div>

    {{-- ================= MARKS ================= --}}
    <div class="mb-3">
        <label class="form-label small">
            % of overall marks obtained in the examination
            <span class="text-danger">*</span>
        </label>

        <div class="input-group">
            <span class="input-group-text">
                <i class="bx bx-percent"></i>
            </span>

            <input name="cur_class_marks_percent"
                   type="text"
                   class="form-control"
                   placeholder="% of Overall marks"
                   value="{{ old('cur_class_marks_percent', $additional_info['cur_class_marks_percent'] ?? '') }}">
        </div>
    </div>

</div>
</div>

{{-- ================= BUTTON ================= --}}
<div class="form-actions text-end mt-3">
    <button type="button"
            id="saveAdditionalDetails"
            class="btn btn-success">
        Save Changes
    </button>
</div>

</form>
</div>

{{-- ================= AJAX ================= --}}
<script>
document.getElementById('saveAdditionalDetails')
    ?.addEventListener('click', function () {

        $.ajax({
            url: "{{ route('student.student_additional_details') }}",
            type: "POST",
            data: $('#additionalDetailsForm').serialize(),
            success: function (res) {
                alert(res.message ?? 'Saved successfully');
            },
            error: function () {
                alert('Something went wrong');
            }
        });

});
</script>
