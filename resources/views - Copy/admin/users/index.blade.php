@extends('layouts.app')

@section('title', 'User Management')
@section('page-title', 'User Management')
@section('page-subtitle', 'Manage system users and their roles')

@push('css')
<style>
.user-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: var(--wb-primary);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.875rem;
}

.status-badge {
    padding: 0.375rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 500;
}

.action-buttons {
    display: flex;
    gap: 0.25rem;
    flex-wrap: nowrap;
}

.action-btn {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
    transition: all 0.2s;
}

.action-btn:hover {
    transform: translateY(-1px);
}

.bulk-action-section {
    background: #f8fafc;
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 1rem;
    border: 1px solid #e5e7eb;
}

.impersonate-btn {
    background: #10b981;
    border-color: #10b981;
    color: white;
}

.impersonate-btn:hover {
    background: #059669;
    border-color: #059669;
    transform: translateY(-1px);
}

.stop-impersonate-btn {
    background: #ef4444;
    border-color: #ef4444;
    color: white;
}

.stop-impersonate-btn:hover {
    background: #dc2626;
    border-color: #dc2626;
}
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Users List</h3>
                <div class="card-actions">
                    <!-- Impersonation Notice -->
                    @if(session('impersonator'))
                    <div class="me-3">
                        <span class="badge bg-warning text-dark">
                            <i class="ti ti-user-switch me-1"></i>
                            Impersonating: {{ auth()->user()->name }}
                        </span>
                        <a href="{{ route('admin.users.stop-impersonate') }}" class="btn btn-danger btn-sm stop-impersonate-btn ms-2">
                            <i class="ti ti-user-off me-1"></i>Stop Impersonating
                        </a>
                    </div>
                    @endif

                    @can('create users')
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
                        <i class="ti ti-plus me-1"></i> Create New User
                    </a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <!-- Success/Error Messages -->
                @session('success')
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="ti ti-check me-2"></i>
                        {{ $value }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endsession

                @session('error')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="ti ti-alert-circle me-2"></i>
                        {{ $value }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endsession

                <!-- Bulk Actions Section -->
                @canany(['edit users', 'delete users', 'impersonate users'])
                <div class="bulk-action-section">
                    <form method="POST" action="{{ route('admin.users.bulk-action') }}" class="mb-0" id="bulkActionForm">
                        @csrf
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <label class="form-label small text-muted mb-1">Bulk Actions</label>
                                <select name="action" class="form-select" required>
                                    <option value="">Choose Action...</option>
                                    <option value="activate">Activate Selected</option>
                                    <option value="deactivate">Deactivate Selected</option>
                                    @can('impersonate users')
                                    <option value="impersonate">Impersonate Selected</option>
                                    @endcan
                                    @can('delete users')
                                    <option value="delete">Delete Selected</option>
                                    @endcan
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label small text-muted mb-1">&nbsp;</label>
                                <button type="submit" class="btn btn-secondary w-100" id="bulkActionBtn">
                                    Apply Action
                                </button>
                            </div>
                            <div class="col-md-7">
                                <label class="form-label small text-muted mb-1">Quick Stats</label>
                                <div class="d-flex gap-3 text-center">
                                    <div>
                                        <div class="h5 mb-0 text-primary">{{ $users->total() }}</div>
                                        <small class="text-muted">Total Users</small>
                                    </div>
                                    <div>
                                        <div class="h5 mb-0 text-success">{{ $activeUsersCount ?? 0 }}</div>
                                        <small class="text-muted">Active</small>
                                    </div>
                                    <div>
                                        <div class="h5 mb-0 text-danger">{{ $inactiveUsersCount ?? 0 }}</div>
                                        <small class="text-muted">Inactive</small>
                                    </div>
                                    <div>
                                        <div class="h5 mb-0 text-info">{{ $onlineUsersCount ?? 0 }}</div>
                                        <small class="text-muted">Online</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                @endcanany

                <!-- Users Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                @canany(['edit users', 'delete users', 'impersonate users'])
                                <th width="40px">
                                    <input type="checkbox" id="selectAll">
                                </th>
                                @endcanany
                                <th width="60px">ID</th>
                                <th>User Information</th>
                                <th>Role & Permissions</th>
                                <th>Department</th>
                                <th>Status</th>
                                <th>Last Login</th>
                                <th width="180px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr class="{{ $user->id == auth()->id() ? 'table-active' : '' }}">
                                @canany(['edit users', 'delete users', 'impersonate users'])
                                <td>
                                    <input type="checkbox" name="users[]" value="{{ $user->id }}" class="user-checkbox"
                                        {{ $user->id == auth()->id() || $user->hasRole('Super Admin') ? 'disabled' : '' }}>
                                </td>
                                @endcanany
                                <td>
                                    <span class="text-muted">#{{ $user->id }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-3">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ $user->name }}</div>
                                            <div class="text-muted small">{{ $user->email }}</div>
                                            @if($user->phone)
                                            <div class="text-muted small">
                                                <i class="ti ti-phone me-1"></i>{{ $user->phone }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach($user->roles as $role)
                                        <span class="badge bg-primary">{{ $role->name }}</span>
                                        @endforeach
                                    </div>
                                    <small class="text-muted">
                                        {{ $user->permissions_count ?? 0 }} permissions
                                    </small>
                                </td>
                                <td>
                                    <span class="fw-medium">{{ $user->department ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    <span class="status-badge {{ $user->status ? 'bg-success' : 'bg-danger' }}">
                                        <i class="ti ti-{{ $user->status ? 'check' : 'x' }} me-1"></i>
                                        {{ $user->status ? 'Active' : 'Inactive' }}
                                    </span>
                                    @if($user->is_online)
                                    <span class="badge bg-success ms-1">Online</span>
                                    @endif
                                </td>
                                <td>
                                    @if($user->last_login_at)
                                    <span class="text-muted small" title="{{ $user->last_login_at->format('M j, Y g:i A') }}">
                                        {{ $user->last_login_at->diffForHumans() }}
                                    </span>
                                    @else
                                    <span class="text-muted small">Never</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        @can('view users')
                                        <a href="{{ route('admin.users.show', $user->id) }}"
                                           class="btn btn-info btn-sm action-btn"
                                           title="View Details">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        @endcan

                                        @can('impersonate users')
                                            @if($user->id != auth()->id() && !$user->hasRole('Super Admin'))
                                                <a href="{{ route('admin.users.impersonate', $user->id) }}"
                                                class="btn btn-success btn-sm action-btn impersonate-btn"
                                                title="Impersonate User"
                                                onclick="return confirm('Impersonate {{ $user->name }}? You can return to your account using the banner at the top.')">
                                                    <i class="ti ti-user-share"></i>
                                                </a>
                                            @endif
                                        @endcan

                                        @can('edit users')
                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                           class="btn btn-primary btn-sm action-btn"
                                           title="Edit User"
                                           {{ $user->hasRole('Super Admin') && !auth()->user()->hasRole('Super Admin') ? 'disabled' : '' }}>
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        @endcan

                                        @can('delete users')
                                        @if($user->id != auth()->id() && !$user->hasRole('Super Admin'))
                                        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}"
                                              class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete {{ $user->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm action-btn" title="Delete User">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                        @endif
                                        @endcan
                                    </div>

                                    @if($user->isImpersonated())
                                        <small class="text-warning d-block mt-1">
                                            <i class="ti ti-user-switch"></i> Being impersonated
                                        </small>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="{{ auth()->user()->canAny(['edit users', 'delete users', 'impersonate users']) ? 8 : 7 }}" class="text-center py-4">
                                    <div class="empty-state">
                                        <i class="ti ti-users-off" style="font-size: 3rem; opacity: 0.5;"></i>
                                        <h4 class="mt-3">No Users Found</h4>
                                        <p class="text-muted">No users match your search criteria.</p>
                                        @can('create users')
                                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                                            <i class="ti ti-plus me-1"></i> Create First User
                                        </a>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($users->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="text-muted small">
                        Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries
                    </div>
                    <div>
                        {{ $users->links('pagination::bootstrap-5') }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select all checkbox functionality
    const selectAll = document.getElementById('selectAll');
    const userCheckboxes = document.querySelectorAll('.user-checkbox');
    const bulkActionForm = document.getElementById('bulkActionForm');
    const bulkActionBtn = document.getElementById('bulkActionBtn');

    // Select all checkboxes
    if (selectAll) {
        selectAll.addEventListener('change', function() {
            const isChecked = this.checked;
            userCheckboxes.forEach(checkbox => {
                if (!checkbox.disabled) {
                    checkbox.checked = isChecked;
                }
            });
            updateBulkActionButton();
        });
    }

    // Update individual checkbox states
    userCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateSelectAllCheckbox();
            updateBulkActionButton();
        });
    });

    // Update select all checkbox state
    function updateSelectAllCheckbox() {
        if (!selectAll) return;

        const enabledCheckboxes = Array.from(userCheckboxes).filter(cb => !cb.disabled);
        const checkedEnabled = enabledCheckboxes.filter(cb => cb.checked);

        selectAll.checked = checkedEnabled.length === enabledCheckboxes.length && enabledCheckboxes.length > 0;
        selectAll.indeterminate = checkedEnabled.length > 0 && checkedEnabled.length < enabledCheckboxes.length;
    }

    // Update bulk action button state
    function updateBulkActionButton() {
        if (!bulkActionBtn) return;

        const checkedCount = Array.from(userCheckboxes).filter(cb => cb.checked && !cb.disabled).length;
        if (checkedCount > 0) {
            bulkActionBtn.disabled = false;
            bulkActionBtn.textContent = `Apply to ${checkedCount} Selected`;
        } else {
            bulkActionBtn.disabled = true;
            bulkActionBtn.textContent = 'Apply Action';
        }
    }

    // Bulk action form validation
    if (bulkActionForm) {
        bulkActionForm.addEventListener('submit', function(e) {
            const checkedBoxes = Array.from(userCheckboxes).filter(cb => cb.checked && !cb.disabled);
            const action = this.querySelector('select[name="action"]').value;

            if (checkedBoxes.length === 0) {
                e.preventDefault();
                showAlert('Please select at least one user.', 'warning');
                return false;
            }

            if (!action) {
                e.preventDefault();
                showAlert('Please select an action to perform.', 'warning');
                return false;
            }

            if (action === 'delete') {
                if (!confirm(`Are you sure you want to delete ${checkedBoxes.length} user(s)? This action cannot be undone.`)) {
                    e.preventDefault();
                    return false;
                }
            }

            if (action === 'impersonate') {
                if (checkedBoxes.length > 1) {
                    e.preventDefault();
                    showAlert('You can only impersonate one user at a time.', 'warning');
                    return false;
                }
            }
        });
    }

    // Show toast notification
    function showAlert(message, type = 'info') {
        const alert = document.createElement('div');
        alert.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
        alert.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        alert.innerHTML = `
            <i class="ti ti-${type === 'warning' ? 'alert-triangle' : 'info-circle'} me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        document.body.appendChild(alert);

        setTimeout(() => {
            if (alert.parentNode) {
                alert.remove();
            }
        }, 5000);
    }

    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Initialize
    updateBulkActionButton();
    updateSelectAllCheckbox();
});
</script>
@endpush
