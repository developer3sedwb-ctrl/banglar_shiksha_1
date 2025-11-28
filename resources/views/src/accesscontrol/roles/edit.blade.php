@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Role</h2>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>There were some problems with your input.</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Edit Form --}}
    <form action="{{ route('roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="userid" class="form-label">User ID</label>
            <input type="text" name="userid" id="userid"
                   value="{{ old('userid', $role->userid) }}"
                   class="form-control @error('userid') is-invalid @enderror"
                   required>
            @error('userid')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="shortcode" class="form-label">Short Code</label>
            <input type="text" name="shortcode" id="shortcode"
                   value="{{ old('shortcode', $role->shortcode) }}"
                   class="form-control @error('shortcode') is-invalid @enderror"
                   required>
            @error('shortcode')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Role Name</label>
            <input type="text" name="name" id="name"
                   value="{{ old('name', $role->name) }}"
                   class="form-control @error('name') is-invalid @enderror"
                   required>
            @error('name')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Update Role</button>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
@endsection
