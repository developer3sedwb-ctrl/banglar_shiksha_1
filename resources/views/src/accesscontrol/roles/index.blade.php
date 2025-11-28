@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Role List</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif

    {{-- Add Button --}}
    <div class="mb-3">
        <a href="{{ route('roles.create') }}" class="btn btn-primary">+ Add New Role</a>
    </div>

    {{-- Roles Table --}}
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-light">
            <tr>
                <th width="5%">#</th>
                <th width="20%">User ID</th>
                <th width="20%">Short Code</th>
                <th width="35%">Role Name</th>
                <th width="20%">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($roles as $index => $role)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $role->userid }}</td>
                    <td>{{ $role->shortcode }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No roles found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection
