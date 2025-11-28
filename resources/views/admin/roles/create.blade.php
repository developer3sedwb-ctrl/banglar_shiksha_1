@extends('layouts.app')

@section('title', 'Create Role')
@section('page-title', 'Create New Role')
@section('page-subtitle', 'Add a new role with specific permissions')

@push('css')
<style>
.permission-group-card {
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.permission-group-card:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}

.group-checkbox {
    margin-left: 10px;
}

.form-check-label small {
    font-size: 0.75rem;
    color: #6b7280;
}

.permission-checkbox:checked {
    background-color: var(--bs-success);
    border-color: var(--bs-success);
}

.group-checkbox:checked {
    background-color: var(--bs-success);
    border-color: var(--bs-success);
}

/* Card states */
.card-header.bg-success {
    background-color: rgba(25, 135, 84, 0.15) !important;
    border-left: 4px solid var(--bs-success);
    color: var(--bs-success);
}

.card-header.bg-warning {
    background-color: rgba(255, 193, 7, 0.15) !important;
    border-left: 4px solid var(--bs-warning);
    color: var(--bs-warning);
}

.card-header.bg-light {
    border-left: 4px solid #e9ecef;
}

/* Card body states */
.card-body.bg-success {
    background-color: rgba(25, 135, 84, 0.05) !important;
}

.card-body.bg-warning {
    background-color: rgba(255, 193, 7, 0.05) !important;
}

/* Selected card styling */
.card-success {
    border-color: var(--bs-success) !important;
    box-shadow: 0 0 0 1px var(--bs-success);
}

.card-warning {
    border-color: var(--bs-warning) !important;
    box-shadow: 0 0 0 1px var(--bs-warning);
}

/* Checkbox labels */
.form-check-input:checked + .form-check-label {
    font-weight: 600;
}

/* Group header styling */
.group-header {
    cursor: pointer;
    transition: all 0.3s ease;
}

.group-header:hover {
    background-color: rgba(0, 0, 0, 0.02) !important;
}

/* Permission item styling */
.permission-item {
    padding: 0.5rem 0;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    transition: all 0.2s ease;
}

.permission-item:last-child {
    border-bottom: none;
}

.permission-item:hover {
    background-color: rgba(0, 0, 0, 0.02);
    border-radius: 4px;
    padding-left: 0.5rem;
    padding-right: 0.5rem;
}

/* Stats badge */
.group-stats {
    font-size: 0.75rem;
    font-weight: 500;
}

/* Animation for state changes */
.permission-group-card {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Role Information</h3>
            </div>
            <form method="POST" action="{{ route('admin.roles.store') }}">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Role Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}"
                                    placeholder="Enter role name" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description"
                                    placeholder="Enter role description" rows="1">{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <h5 class="mb-1">Permissions</h5>
                                    <p class="text-muted mb-0">Select the permissions for this role</p>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-sm" id="selectAllBtn">
                                        <i class="fas fa-check-double me-1"></i> Select All
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sm" id="selectPartialBtn">
                                        <i class="fas fa-minus me-1"></i> Select Common
                                    </button>
                                    <button type="button" class="btn btn-secondary btn-sm" id="deselectAllBtn">
                                        <i class="fas fa-times me-1"></i> Deselect All
                                    </button>
                                </div>
                            </div>

                            @error('permissions')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <!-- Permissions Summary -->
                            <div class="alert alert-info d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <i class="fas fa-info-circle me-2"></i>
                                    <span id="permissionsCount">0</span> permissions selected
                                </div>
                                <div class="small">
                                    <span id="groupsFullySelected">0</span> groups fully selected •
                                    <span id="groupsPartiallySelected">0</span> groups partially selected
                                </div>
                            </div>

                            <div class="row">
                                @foreach($permissions as $group => $groupPermissions)
                                <div class="col-md-4 mb-4">
                                    <div class="card permission-group-card h-100">
                                        <div class="card-header group-header bg-light d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="card-title mb-0 text-capitalize">{{ $group }}</h6>
                                                <small class="text-muted group-stats">
                                                    {{ count($groupPermissions) }} permissions
                                                </small>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input group-checkbox"
                                                    type="checkbox"
                                                    data-group="{{ $group }}"
                                                    id="group_{{ $group }}">
                                                <label class="form-check-label small" for="group_{{ $group }}">
                                                    All
                                                </label>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            @foreach($groupPermissions as $permission)
                                            <div class="permission-item">
                                                <div class="form-check mb-0">
                                                    <input class="form-check-input permission-checkbox"
                                                        type="checkbox"
                                                        name="permissions[]"
                                                        value="{{ $permission->id }}"
                                                        id="permission_{{ $permission->id }}"
                                                        data-group="{{ $group }}">
                                                    <label class="form-check-label small" for="permission_{{ $permission->id }}">
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Create Role</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const selectAllBtn = document.getElementById('selectAllBtn');
    const deselectAllBtn = document.getElementById('deselectAllBtn');
    const selectPartialBtn = document.getElementById('selectPartialBtn');
    const permissionCheckboxes = document.querySelectorAll('.permission-checkbox');
    const groupCheckboxes = document.querySelectorAll('.group-checkbox');
    const permissionsCount = document.getElementById('permissionsCount');
    const groupsFullySelected = document.getElementById('groupsFullySelected');
    const groupsPartiallySelected = document.getElementById('groupsPartiallySelected');

    // Common permissions (you can customize this list)
    const commonPermissions = [
        'view users', 'view roles', 'view permissions',
        'edit profile', 'update profile'
    ];

    // Update statistics
    function updateStatistics() {
        const totalPermissions = permissionCheckboxes.length;
        const selectedPermissions = document.querySelectorAll('.permission-checkbox:checked').length;

        let fullGroups = 0;
        let partialGroups = 0;

        groupCheckboxes.forEach(checkbox => {
            const group = checkbox.getAttribute('data-group');
            const groupPermissions = document.querySelectorAll(`.permission-checkbox[data-group="${group}"]`);
            const checkedCount = Array.from(groupPermissions).filter(cb => cb.checked).length;

            if (checkedCount === groupPermissions.length) {
                fullGroups++;
            } else if (checkedCount > 0) {
                partialGroups++;
            }
        });

        permissionsCount.textContent = `${selectedPermissions} / ${totalPermissions}`;
        groupsFullySelected.textContent = fullGroups;
        groupsPartiallySelected.textContent = partialGroups;
    }

    // Select All button
    selectAllBtn.addEventListener('click', function() {
        permissionCheckboxes.forEach(checkbox => {
            checkbox.checked = true;
        });
        groupCheckboxes.forEach(checkbox => {
            checkbox.checked = true;
            checkbox.indeterminate = false;
        });
        updateGroupCheckboxStates();
        updateCardVisualStates();
        updateStatistics();
    });

    // Select Common Permissions button
    selectPartialBtn.addEventListener('click', function() {
        permissionCheckboxes.forEach(checkbox => {
            const label = checkbox.nextElementSibling.textContent.toLowerCase();
            checkbox.checked = commonPermissions.some(perm => label.includes(perm.toLowerCase()));
        });
        updateGroupCheckboxStates();
        updateCardVisualStates();
        updateStatistics();
    });

    // Deselect All button
    deselectAllBtn.addEventListener('click', function() {
        permissionCheckboxes.forEach(checkbox => {
            checkbox.checked = false;
        });
        groupCheckboxes.forEach(checkbox => {
            checkbox.checked = false;
            checkbox.indeterminate = false;
        });
        updateGroupCheckboxStates();
        updateCardVisualStates();
        updateStatistics();
    });

    // Group checkbox functionality
    groupCheckboxes.forEach(groupCheckbox => {
        groupCheckbox.addEventListener('change', function() {
            const group = this.getAttribute('data-group');
            const groupPermissions = document.querySelectorAll(`.permission-checkbox[data-group="${group}"]`);

            groupPermissions.forEach(permissionCheckbox => {
                permissionCheckbox.checked = this.checked;
            });

            this.indeterminate = false;
            updateCardVisualState(group);
            updateStatistics();
        });
    });

    // Individual permission checkbox functionality
    permissionCheckboxes.forEach(permissionCheckbox => {
        permissionCheckbox.addEventListener('change', function() {
            const group = this.getAttribute('data-group');
            updateGroupCheckboxState(group);
            updateCardVisualState(group);
            updateStatistics();
        });
    });

    // Function to update group checkbox state based on individual permissions
    function updateGroupCheckboxState(group) {
        const groupPermissions = document.querySelectorAll(`.permission-checkbox[data-group="${group}"]`);
        const groupCheckbox = document.querySelector(`.group-checkbox[data-group="${group}"]`);

        const checkedCount = Array.from(groupPermissions).filter(cb => cb.checked).length;
        const totalCount = groupPermissions.length;

        if (checkedCount === 0) {
            groupCheckbox.checked = false;
            groupCheckbox.indeterminate = false;
        } else if (checkedCount === totalCount) {
            groupCheckbox.checked = true;
            groupCheckbox.indeterminate = false;
        } else {
            groupCheckbox.checked = false;
            groupCheckbox.indeterminate = true;
        }
    }

    // Function to update all group checkbox states
    function updateGroupCheckboxStates() {
        const groups = Array.from(groupCheckboxes).map(cb => cb.getAttribute('data-group'));
        groups.forEach(group => updateGroupCheckboxState(group));
    }

    // Function to update card visual state
    function updateCardVisualState(group) {
        const groupCard = document.querySelector(`.group-checkbox[data-group="${group}"]`).closest('.permission-group-card');
        const cardHeader = groupCard.querySelector('.card-header');
        const cardBody = groupCard.querySelector('.card-body');
        const groupCheckbox = document.querySelector(`.group-checkbox[data-group="${group}"]`);

        // Remove existing classes
        cardHeader.classList.remove('bg-success', 'bg-warning', 'bg-light');
        cardBody.classList.remove('bg-success', 'bg-warning');
        groupCard.classList.remove('card-success', 'card-warning');

        if (groupCheckbox.checked) {
            // Fully selected - Success state
            cardHeader.classList.add('bg-success');
            cardBody.classList.add('bg-success');
            groupCard.classList.add('card-success');
        } else if (groupCheckbox.indeterminate) {
            // Partially selected - Warning state
            cardHeader.classList.add('bg-warning');
            cardBody.classList.add('bg-warning');
            groupCard.classList.add('card-warning');
        } else {
            // Not selected - Default state
            cardHeader.classList.add('bg-light');
        }
    }

    // Function to update all card visual states
    function updateCardVisualStates() {
        const groups = Array.from(groupCheckboxes).map(cb => cb.getAttribute('data-group'));
        groups.forEach(group => updateCardVisualState(group));
    }

    // Group header click to select/deselect all
    document.querySelectorAll('.group-header').forEach(header => {
        header.addEventListener('click', function(e) {
            // Don't trigger if checkbox was clicked
            if (!e.target.matches('input[type="checkbox"]')) {
                const groupCheckbox = this.querySelector('.group-checkbox');
                groupCheckbox.checked = !groupCheckbox.checked;
                groupCheckbox.dispatchEvent(new Event('change'));
            }
        });
    });

    // Add keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl + A to select all
        if (e.ctrlKey && e.key === 'a') {
            e.preventDefault();
            selectAllBtn.click();
        }

        // Ctrl + D to deselect all
        if (e.ctrlKey && e.key === 'd') {
            e.preventDefault();
            deselectAllBtn.click();
        }

        // Ctrl + C to select common
        if (e.ctrlKey && e.key === 'c') {
            e.preventDefault();
            selectPartialBtn.click();
        }
    });

    // Form submission validation
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const checkedPermissions = document.querySelectorAll('.permission-checkbox:checked');
        if (checkedPermissions.length === 0) {
            if (!confirm('No permissions selected. Are you sure you want to create a role without any permissions?')) {
                e.preventDefault();
            }
        }
    });

    // Initialize on page load
    updateGroupCheckboxStates();
    updateCardVisualStates();
    updateStatistics();
});
</script>
@endpush
