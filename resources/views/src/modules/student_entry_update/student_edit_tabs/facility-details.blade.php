{{-- ================= TAB 3 : FACILITY & OTHER DETAILS ================= --}}

@php
    /* ================= SAFETY INITIALIZATION ================= */

    $facility = $data['facility'] ?? [];

    $centralScholarships = $data['centralScholarships'] ?? [];
    $stateScholarships   = $data['stateScholarships'] ?? [];

    // yes / no mapping
    $YES = 1;
    $NO  = 2;
@endphp

<div class="tab-pane fade" id="facility_other_dtls_tab" role="tabpanel">

<form id="student_facility_other_dtls_form" method="POST">
@csrf

<h6 class="card-header bg-heading-primary text-white py-2">
    FACILITIES AND OTHER DETAILS OF THE STUDENT
</h6>

{{-- ================= FACILITIES ================= --}}
<div class="row mt-3">

@foreach([
    'free_transport_facility' => 'Free Transport Facility',
    'free_host_facility'      => 'Free Hostel Facility',
    'free_bicycle'            => 'Free Bicycle',
    'free_uniforms'           => 'Free Uniforms',
    'free_escort'             => 'Free Escort',
    'free_shoe'               => 'Free Shoe',
    'free_exercise_book'      => 'Free Exercise Book',
    'complete_free_books'     => 'Complete Set of Free Books'
] as $key => $label)
<div class="col-md-6 mb-3">
    <label class="form-label small fw-bold">{{ $label }} <span class="text-danger">*</span></label>
    <select name="{{ $key }}" class="form-select">
        <option value="">-Select-</option>
        <option value="1" {{ ($facility[$key] ?? '') == 1 ? 'selected' : '' }}>YES</option>
        <option value="2" {{ ($facility[$key] ?? '') == 2 ? 'selected' : '' }}>NO</option>
    </select>
</div>
@endforeach

</div>

{{-- ================= SCHOLARSHIP ================= --}}
<h6 class="card-header bg-heading-primary text-white py-2 mt-4">
    SCHOLARSHIP RECEIVED BY STUDENT
</h6>

<div class="row mt-3">

{{-- CENTRAL SCHOLARSHIP --}}
<div class="col-md-6 mb-3">
    <label class="form-label small fw-bold">Central Scholarship <span class="text-danger">*</span></label>
    <select id="central_scholarship" name="central_scholarship" class="form-select">
        <option value="">-Select-</option>
        <option value="1" {{ ($facility['central_scholarship'] ?? '') == 1 ? 'selected' : '' }}>YES</option>
        <option value="2" {{ ($facility['central_scholarship'] ?? '') == 2 ? 'selected' : '' }}>NO</option>
    </select>
</div>

<div class="col-md-6 mb-3 {{ ($facility['central_scholarship'] ?? '') == 1 ? '' : 'd-none' }}">
    <label class="form-label small fw-bold">Central Scholarship Name</label>
    <select name="central_scholarship_name" class="form-select">
        <option value="">--Select--</option>
        @foreach($centralScholarships as $sch)
            <option value="{{ $sch->id }}"
                {{ ($facility['central_scholarship_name'] ?? '') == $sch->id ? 'selected' : '' }}>
                {{ $sch->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="col-md-6 mb-3 {{ ($facility['central_scholarship'] ?? '') == 1 ? '' : 'd-none' }}">
    <label class="form-label small fw-bold">Central Scholarship Amount</label>
    <input type="number" name="central_scholarship_amount"
           class="form-control"
           value="{{ $facility['central_scholarship_amount'] ?? '' }}">
</div>

{{-- STATE SCHOLARSHIP --}}
<div class="col-md-6 mb-3">
    <label class="form-label small fw-bold">State Scholarship <span class="text-danger">*</span></label>
    <select id="state_scholarship" name="state_scholarship" class="form-select">
        <option value="">-Select-</option>
        <option value="1" {{ ($facility['state_scholarship'] ?? '') == 1 ? 'selected' : '' }}>YES</option>
        <option value="2" {{ ($facility['state_scholarship'] ?? '') == 2 ? 'selected' : '' }}>NO</option>
    </select>
</div>

<div class="col-md-6 mb-3 {{ ($facility['state_scholarship'] ?? '') == 1 ? '' : 'd-none' }}">
    <label class="form-label small fw-bold">State Scholarship Name</label>
    <select name="state_scholarship_name" class="form-select">
        <option value="">--Select--</option>
        @foreach($stateScholarships as $sch)
            <option value="{{ $sch->id }}"
                {{ ($facility['state_scholarship_name'] ?? '') == $sch->id ? 'selected' : '' }}>
                {{ $sch->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="col-md-6 mb-3 {{ ($facility['state_scholarship'] ?? '') == 1 ? '' : 'd-none' }}">
    <label class="form-label small fw-bold">State Scholarship Amount</label>
    <input type="number" name="state_scholarship_amount"
           class="form-control"
           value="{{ $facility['state_scholarship_amount'] ?? '' }}">
</div>

</div>

{{-- ================= OTHER DETAILS ================= --}}
<h6 class="card-header bg-heading-primary text-white py-2 mt-4">
    OTHER DETAILS
</h6>

<div class="row mt-3">

@foreach([
    'provided_mentors'       => 'Provided Mentors',
    'participated_competitions' => 'Participated in Competitions',
    'ncc_nss_guides'         => 'NCC / NSS / Guides',
    'rte_free_education'     => 'Free Education under RTE',
    'special_training'       => 'Special Training',
    'able_to_handle_devices' => 'Can Handle Digital Devices',
    'internet_access'        => 'Internet Access'
] as $key => $label)
<div class="col-md-6 mb-3">
    <label class="form-label small fw-bold">{{ $label }}</label>
    <select name="{{ $key }}" class="form-select">
        <option value="">-Select-</option>
        <option value="1" {{ ($facility[$key] ?? '') == 1 ? 'selected' : '' }}>YES</option>
        <option value="2" {{ ($facility[$key] ?? '') == 2 ? 'selected' : '' }}>NO</option>
    </select>
</div>
@endforeach

</div>

<div class="form-actions text-end mt-4">
    <button class="btn btn-secondary me-2"
            type="button"
            data-bs-toggle="tab"
            data-bs-target="#enrollment_details">
        Previous
    </button>

    <button type="submit" class="btn btn-success">
        Save & Next
    </button>
</div>

</form>
</div>
