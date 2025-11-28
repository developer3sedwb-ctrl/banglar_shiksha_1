@extends('layouts.app')

@section('title', 'School Details')

@section('content')

<div class="container-fluid full-width-content">
    @php
        $school = $data ?? null;
        // Direct fields
        $id                    = $school->id                    ?? 'NA';
        $schcd                 = $school->schcd                 ?? 'NA';
        $school_name           = $school->school_name           ?? 'NA';
        $establishment_year    = $school->establishment_year    ?? 'NA';

        // Relationship fields
        $district_name         = optional($school->district)->name              ?? 'NA';
        $block_name            = optional($school->block)->name                 ?? 'NA';
        $ward_name             = optional($school->ward)->name                  ?? 'NA';
        $management_name       = optional($school->management)->name            ?? 'NA';
        $category_name         = optional($school->school_category)->name       ?? 'NA';
        $subdivision_name      = optional($school->subDivision)->name           ?? 'NA';
        $circle_name           = optional($school->circle)->name                ?? 'NA'; 
        $cluster_name          = optional($school->cluster)->name               ?? 'NA'; 
        // Medium List
        $mediums_list          = ($school->mediums->count() > 0)
                                  ? $school->mediums->pluck('name')->implode(', ')
                                  : 'NA';

        // Classwise Sections
        $classwise_sections = $school->classwiseSections->pluck('section_count', 'class_name')->toArray() ?? [];
    @endphp
    {{-- ===================== PAGE HEADER ===================== --}}
    <div class="heading-blue">School Details</div>


    {{-- ===================== SCHOOL LOCATION ===================== --}}
    <table class="table table-bordered table-border mt-3">
    <tr class="bg-primary text-white">
        <th colspan="6">School Location Details</th>
    </tr>

    <tr class="small-header text-center">
        <th colspan="3">Latitude</th>
        <th colspan="3">Longitude</th>
    </tr>

    <tr class="small-header text-center">
        <th>DEG</th><th>MIN</th><th>SEC</th>
        <th>DEG</th><th>MIN</th><th>SEC</th>
    </tr>

    <tr class="text-center">
        <td>{{ $school->latdeg ?? 'NA' }}</td>
        <td>{{ $school->latmin ?? 'NA' }}</td>
        <td>{{ $school->latsec ?? 'NA' }}</td>

        <td>{{ $school->londeg ?? 'NA' }}</td>
        <td>{{ $school->lonmin ?? 'NA' }}</td>
        <td>{{ $school->lonsec ?? 'NA' }}</td>
    </tr>
</table>



    {{-- ===================== BASIC DETAILS ===================== --}}
    <div class="bg-primary mt-4 text-white text-center">Basic Details</div>

    <table class="table table-bordered table-border">

        <tr>
            <th width="25%">School DISE :</th>
            <td width="25%">{{ $school->schcd ?? 'NA' }}</td>

            <th width="25%">School Name :</th>
            <td width="25%">{{ $school->school_name ?? 'NA' }}</td>
        </tr>

        <tr>
            <th>HOI Mobile No :</th>
            <td>{{ $school->hoi_mobile ?? 'NA' }}</td>

            <th>School Type :</th>
            <td>{{ $school->school_type_des ?? 'NA' }}</td>
        </tr>

        <tr>
            <th>Block Munc/Corp :</th>
            <td>{{ optional($school->block)->name ?? 'NA' }}</td>

            <th>Cluster :</th>
            <td>{{ $cluster_name ?? 'NA' }}</td>
        </tr>

        <tr>
            <th>Village :</th>
            <td>{{ $school->village_name ?? 'NA' }}</td>

            <th>City :</th>
            <td>{{ $school->city_name ?? 'NA' }}</td>
        </tr>

        <tr>
            <th>PIN Code :</th>
            <td>{{ $school->pin_code ?? 'NA' }}</td>

            <th>Year of Establishment :</th>
            <td>{{ $school->establishment_year ?? 'NA' }}</td>
        </tr>

        <tr>
            <th>School Management :</th>
            <td>{{ optional($school->management)->name ?? 'NA' }}</td>

            <th>School Category :</th>
            <td>{{ optional($school->school_category)->name ?? 'NA' }}</td>
        </tr>
        
        <tr>
            <th>School Location :</th>
            <td>{{ $school->sch_location_des ?? 'NA' }}</td>

            <th>High Class :</th>
            <td>{{ $school->high_class_des ?? 'NA' }}</td>
        </tr>

        <tr>
            <th>Low Class :</th>
            <td>{{ $school->low_class_des ?? 'NA' }}</td>

            <th>Medium 1 :</th>
            <td>{{ $school->medium_des1 ?? 'NA' }}</td>
        </tr>

        <tr>
            <th>Medium 2 :</th>
            <td>{{ $school->medium_des2 ?? 'NA' }}</td>

            <th>Medium 3 :</th>
            <td>{{ $school->medium_des3 ?? 'NA' }}</td>
        </tr>

        <tr>
            <th>Medium 4 :</th>
            <td>{{ $school->medium_des4 ?? 'NA' }}</td>

            <th>Status of School Building :</th>
            <td>{{ $school->building_status_des ?? 'NA' }}</td>
        </tr>

        <tr>
            <th>Total Rooms other than Classrooms :</th>
            <td>{{ $school->other_rooms ?? 'NA' }}</td>

            <th>Drinking Water Available :</th>
            <td>{{ $school->drinking_water_des ?? 'NA' }}</td>
        </tr>

        <tr>
            <th>Electricity Available :</th>
            <td>{{ $school->electricity_des ?? 'NA' }}</td>

            <th>Type of Boundary Wall :</th>
            <td>{{ $school->boundary_wall_des ?? 'NA' }}</td>
        </tr>

        <tr>
            <th>Sub-Division :</th>
            <td>{{ optional($school->subDivision)->name ?? 'NA' }}</td>

            <th>NOC Upload Status :</th>
            <td>{{ $school->noc_status ?? 'NA' }}</td>
        </tr>

        <tr>
            <th>Curriculum Followed :</th>
            <td>{{ $school->curriculum ?? 'NA' }}</td>

            <th></th>
            <td></td>
        </tr>
    </table>


    {{-- ===================== UNIFORM STATUS ===================== --}}
    <table class="table table-bordered table-border mt-4">
        <tr class="bg-primary">
            <th>Uniform Status</th>
            <th>{{ $school->uniform_status ? 'Eligible' : 'Not Eligible' }}</th>
        </tr>
    </table>


    {{-- ===================== TOILET DETAILS ===================== --}}
    <table class="table table-bordered table-border mt-4">

        <tr class="bg-primary">
            <th rowspan="3" class="text-center align-middle">Details of Toilet and Urinals</th>
            <th colspan="4" class="text-center">Boys</th>
            <th colspan="4" class="text-center">Girls</th>
        </tr>

        <tr class="small-header">
            <th colspan="2">Total</th>
            <th colspan="2">Functional</th>
            <th colspan="2">Total</th>
            <th colspan="2">Functional</th>
        </tr>

        <tr class="small-header">
            <th>Present</th><th>Corrected</th>
            <th>Present</th><th>Corrected</th>
            <th>Present</th><th>Corrected</th>
            <th>Present</th><th>Corrected</th>
        </tr>

        {{-- Example row --}}
        <tr>
            <td>Number of toilet seats excluding CWSN</td>
            <td class="text-center">2</td><td></td>
            <td class="text-center">2</td><td></td>
            <td class="text-center">2</td><td></td>
            <td class="text-center">2</td><td></td>
        </tr>

    </table>


    {{-- ===================== CLASSROOM DETAILS ===================== --}}
    <table class="table table-bordered table-border mt-4">
        <tr class="bg-primary">
            <th colspan="8" class="text-center">Total No. of Class Rooms (Primary / Upper Primary / Secondary / HS)</th>
        </tr>

        <tr class="small-header">
            <th colspan="2">Primary</th>
            <th colspan="2">Upper Primary</th>
            <th colspan="2">Secondary</th>
            <th colspan="2">HS</th>
        </tr>

        <tr class="small-header">
            <th>Present</th><th>Corrected</th>
            <th>Present</th><th>Corrected</th>
            <th>Present</th><th>Corrected</th>
            <th>Present</th><th>Corrected</th>
        </tr>

        <tr>
            <td class="text-center">{{ $school->primary_classroom_instructional ?? 0 }}</td>
            <td></td>

            <td class="text-center">{{ $school->upper_primary_classroom_instructional ?? 0 }}</td>
            <td></td>

            <td class="text-center">{{ $school->secondary_classroom_instructional ?? 0 }}</td>
            <td></td>

            <td class="text-center">{{ $school->hs_classroom_instructional ?? 0 }}</td>
            <td></td>
        </tr>
    </table>


    {{-- ===================== CLASSWISE SECTIONS ===================== --}}
    <table class="table table-bordered table-border mt-4">
        <tr class="bg-primary">
            <th colspan="3" class="text-center">Number of sections by class</th>
        </tr>

        <tr class="small-header">
            <th>Class</th>
            <th>Present</th>
            <th>Corrected</th>
        </tr>

        @foreach($classwise_sections as $class => $count)
            <tr>
                <td class="text-center">{{ $class }}</td>
                <td class="text-center">{{ $count }}</td>
                <td></td>
            </tr>
        @endforeach
    </table>


    <div class="mt-5">Generated on : {{ date('d-m-Y') }}</div>

    <div class="text-end mt-5 me-4">
        -------------------------<br>
        Signature of HOI
    </div>

</div>


@endsection
@push('styles')
<!-- Local DataTables CSS -->
<link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
@endpush
@push('scripts')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/datatables.min.js') }}"></script>
<!-- Buttons extension -->
<script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
<!-- dependencies for HTML5 export (must load BEFORE buttons.html5) -->
<script src="{{ asset('js/jszip.min.js') }}"></script>
<script src="{{ asset('js/pdfmake.min.js') }}"></script>
<script src="{{ asset('js/vfs_fonts.js') }}"></script>
<!-- Buttons HTML5 / Print -->
<script src="{{ asset('js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/buttons.print.min.js') }}"></script>
@endpush
