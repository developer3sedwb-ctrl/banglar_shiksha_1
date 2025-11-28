@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Module List</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif

    {{-- Add Button --}}
    <div class="mb-3">
        <a href="{{ route('modules.create') }}" class="btn btn-primary">+ Add Parent Module</a>
    </div>

    {{-- Modules Table --}}
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-light">
            <tr>
                <th width="5%">#</th>
                <th width="20%">Short Code</th>
                <th width="35%">Title</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($modules as $index => $module)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $module->name }}</td>
                    <td>
                        <a href="{{ route('modules.edit', $module->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('submodules', $module->id) }}" class="btn btn-sm btn-warning">Sub-Menu ({{$module->submodules_count}})</a>
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
