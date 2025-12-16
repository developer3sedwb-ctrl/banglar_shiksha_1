@extends('layouts.app')

@section('title', 'Permissions')
@section('page-title', 'Permissions Management')
@section('page-subtitle', 'Manage system permissions')

@section('breadcrumb')
    <li class="breadcrumb-item active">Permissions</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Permissions List</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.permissions.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Create Permission
                    </a>
                </div>
            </div>
            <div class="card-body">
                <!-- Search and Filter Form -->
                <form method="GET" action="{{ route('admin.permissions.index') }}" class="mb-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text"
                                    name="search"
                                    class="form-control"
                                    placeholder="Search permissions..."
                                    value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select name="group" class="form-control" onchange="this.form.submit()">
                                <option value="">All Groups</option>
                                @foreach($groups as $group)
                                    <option value="{{ $group }}" {{ request('group') == $group ? 'selected' : '' }}>
                                        {{ $group }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @if(request('search') || request('group'))
                            <div class="col-md-2">
                                <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">
                                    Clear Filters
                                </a>
                            </div>
                        @endif
                    </div>
                </form>

                <!-- Permissions Table -->
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Permission Name</th>
                                <th>Group</th>
                                <th>Assigned to Roles</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td>
                                        <span class="font-weight-bold">{{ $permission->name }}</span>
                                    </td>
                                    <td>
                                        @if($permission->group_name)
                                            <span class="badge bg-info">
                                                {{ $permission->group_name }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">
                                            {{ $permission->roles_count }} roles
                                        </span>
                                    </td>
                                    <td>{{ $permission->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.permissions.show', $permission) }}"
                                               class="btn btn-sm btn-info"
                                               title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.permissions.edit', $permission) }}"
                                               class="btn btn-sm btn-primary"
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.permissions.destroy', $permission) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this permission?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-sm btn-danger"
                                                        title="Delete"
                                                        {{ $permission->roles_count > 0 ? 'disabled' : '' }}>
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <div class="alert alert-info">
                                            No permissions found.
                                            <a href="{{ route('admin.permissions.create') }}">Create one now</a>.
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $permissions->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Group Management Modal -->
<div class="modal fade" id="groupManagementModal" tabindex="-1" aria-labelledby="groupManagementModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="groupManagementModalLabel">Permission Groups</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>Common Groups:</h6>
                <div class="mb-3">
                    @foreach($commonGroups as $group)
                        <span class="badge bg-primary me-1 mb-1">{{ $group }}</span>
                    @endforeach
                </div>

                <h6>Existing Groups in System:</h6>
                @if($groups->count() > 0)
                    <div>
                        @foreach($groups as $group)
                            <span class="badge bg-secondary me-1 mb-1">{{ $group }}</span>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">No groups defined yet.</p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Optional: Add auto-suggest for group names
    document.addEventListener('DOMContentLoaded', function() {
        const groupInput = document.getElementById('group_name');
        if (groupInput) {
            groupInput.addEventListener('input', function(e) {
                // You can add custom logic here if needed
            });
        }
    });
</script>
@endsection

@push('styles')
<style>
    .badge {
        font-size: 0.85em;
        padding: 0.35em 0.65em;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0,0,0,.02);
    }

    .btn-group .btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
</style>
@endpush
