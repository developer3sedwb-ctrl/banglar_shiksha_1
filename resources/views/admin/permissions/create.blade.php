@extends('layouts.app')

@section('title', 'Create Permission')
@section('page-title', 'Create New Permission')
@section('page-subtitle', 'Add a new system permission')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Permission Information</h3>
            </div>
            <form method="POST" action="{{ route('admin.permissions.store') }}">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Permission Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}"
                                    placeholder="e.g., view users, create reports" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    Use lowercase with underscores (e.g., view_users, create_reports) or spaces (e.g., view users)
                                </small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="group_name" class="form-label">Group Name</label>
                                <input type="text"
                                    class="form-control @error('group_name') is-invalid @enderror"
                                    id="group_name"
                                    name="group_name"
                                    value="{{ old('group_name') }}"
                                    list="groupSuggestions"
                                    placeholder="e.g., User Management, Settings">
                                @error('group_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <!-- Datalist for common groups -->
                                <datalist id="groupSuggestions">
                                    @foreach($commonGroups as $group)
                                        <option value="{{ $group }}">
                                    @endforeach
                                    @foreach($groups as $group)
                                        @if(!in_array($group, $commonGroups))
                                            <option value="{{ $group }}">
                                        @endif
                                    @endforeach
                                </datalist>

                                <small class="form-text text-muted">
                                    Optional: Group permissions for better organization (e.g., User Management, Reports)
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Create Permission</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
