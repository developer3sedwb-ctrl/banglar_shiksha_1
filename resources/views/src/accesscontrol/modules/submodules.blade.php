@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Module : {{$module->name}}</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif

    {{-- Add Button --}}
    <div class="mb-3">
        <a href="{{ route('submodules.create', $module->id) }}" class="btn btn-primary">
            + Add Sub-Module
        </a>
    </div>

    {{-- Modules Table --}}
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-light">
            <tr>
                <th width="5%">#</th>
                <th width="35%">Title</th>
                <th width="40%">URL</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($submodules as $index => $module)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $module->name }}</td>
                    <td>{{ $module->url }}</td>
                    <td>
                        <a href="{{ route('submodules.edit', $module->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No modules found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection
