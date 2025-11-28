@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div @class(['container-fluid', 'px-4' ])> <!-- full-width container -->
    <div @class(['row'])>
        <div @class(['col-lg-8', 'mb-5' ])>
            <div @class(['card'])>
                <div @class(['d-flex', 'align-items-center' , 'row' ])>
                    <div @class(['col-sm-7'])>
                        <div @class(['card-body', 'pb-5' , 'institution-details' ])>
                            <p @class(['text-secondary', 'mb-2' , 'd-block' ])>{{$data['user_role']}}</p>
                            <h4 @class(['text-primary', 'mb-2' ])><strong>{{$data['user_circle']}}</strong></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div @class(['row', 'g-4'])>
        {{-- Total School --}}
        @include('components.dashboard-box', [
            'title' => 'Total School',
            'count' => $totalSchool ?? 0,
            'icon' => 'bx-school',
            'color' => 'success',
            'link' => 'total-school'
        ])
        {{-- Total Students --}}
        @include('components.dashboard-box', [
            'title' => 'Total Students',
            'count' => $totalStudents ?? 0,
            'icon' => 'bx-user',
            'color' => 'primary',
            'link' => 'total-students'
        ])
        {{-- Total Teachers --}}
        @include('components.dashboard-box', [
            'title' => 'Total Teachers',
            'count' => $totalTeachers ?? 0,
            'icon' => 'bx-user-voice',
            'color' => 'warning',
            'link' => 'total-teacher'
        ])
        {{-- Total SSK & MSK School --}}
        @include('components.dashboard-box', [
            'title' => 'Total SSK & MSK School',
            'count' => $totalSskMsk ?? 0,
            'icon' => 'bx-home-smile',
            'color' => 'info',
            'link' => 'total-ssk-and-msk-school'
        ])
        {{-- Madrasah Recognized --}}
        @include('components.dashboard-box', [
            'title' => 'More Information — Madrasah Recognized',
            'count' => $madrasahRecognized ?? 0,
            'icon' => 'bx-info-circle',
            'color' => 'secondary',
            'link' => 'total-madrasah-school-recognized'
        ])
        {{-- Madrasah Shiksha Kendra --}}
        @include('components.dashboard-box', [
            'title' => 'More Information — Madrasah Shiksha Kendra',
            'count' => $madrasahShikshaKendra ?? 0,
            'icon' => 'bx-book',
            'color' => 'dark',
            'link' => 'total-madrasah-shiksha-kendra'
        ])
    </div>
</div>
@endsection