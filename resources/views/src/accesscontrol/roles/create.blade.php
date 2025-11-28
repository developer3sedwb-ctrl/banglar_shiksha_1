@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Add New Role</h2>

    {{-- Show success or error messages --}}
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

    {{-- Role creation form --}}
    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="userid" class="form-label">User ID</label>
            <select name="userid" id="userid" class="form-control @error('userid') is-invalid @enderror" required>
                <option value="">-- Select User ID --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->user_id }}" {{ old('userid') == $user->user_id ? 'selected' : '' }}>
                        {{ $user->user_id }} : {{ $user->name }}
                    </option>
                @endforeach
            </select>
            @error('userid')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="shortcode" class="form-label">Short Code</label>
            <input type="text" name="shortcode" id="shortcode"
                class="form-control @error('shortcode') is-invalid @enderror"
                value="{{ old('shortcode') }}" placeholder="Enter short code" required>
            @error('shortcode')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Role Name</label>
            <input type="text" name="name" id="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}" placeholder="Enter role name" required>
            @error('name')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-success">Save Role</button>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
@endsection
