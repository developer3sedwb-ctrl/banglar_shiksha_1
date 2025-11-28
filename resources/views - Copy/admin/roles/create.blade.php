@extends('layouts.app')

@section('title', 'Create Role')
@section('page-title', 'Create New Role')
@section('page-subtitle', 'Add a new role with specific permissions')

@push('css')
<style>
.permission-group-card {
    transition: all 0.3s ease;
}

.permission-group-card:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.group-checkbox {
    margin-left: 10px;
}

.form-check-label small {
    font-size: 0.75rem;
    color: #6b7280;
}

.permission-checkbox:checked {
    background-color: var(--wb-primary);
    border-color: var(--wb-primary);
}

.group-checkbox:checked {
    background-color: var(--wb-green);
    border-color: var(--wb-green);
}

.card-header.bg-selected {
    background-color: rgba(46, 125, 50, 0.1) !important;
    border-left: 3px solid var(--wb-green);
}

.card-header.bg-partial {
    background-color: rgba(239, 108, 0, 0.1) !important;
    border-left: 3px solid var(--wb-orange);
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
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0">Permissions</h5>
                                <div>
                                    <button type="button" class="btn btn-sm btn-outline-primary" id="selectAllBtn">
                                        <i class="ti ti-check"></i> Select All
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" id="deselectAllBtn">
                                        <i class="ti ti-x"></i> Deselect All
                                    </button>
                                </div>
                            </div>

                            @error('permissions')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="row">
                                @foreach($permissions as $group => $groupPermissions)
                                <div class="col-md-4 mb-4">
                                    <div class="card permission-group-card">
                                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                            <h6 class="card-title mb-0 text-capitalize">{{ $group }} Permissions</h6>
                                            <div class="form-check">
                                                <input class="form-check-input group-checkbox"
                                                    type="checkbox"
                                                    data-group="{{ $group }}"
                                                    id="group_{{ $group }}">
                                                <label class="form-check-label small" for="group_{{ $group }}">
                                                    Select All
                                                </label>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            @foreach($groupPermissions as $permission)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input permission-checkbox"
                                                    type="checkbox"
                                                    name="permissions[]"
                                                    value="{{ $permission->id }}"
                                                    id="permission_{{ $permission->id }}"
                                                    data-group="{{ $group }}">
                                                <label class="form-check-label" for="permission_{{ $permission->id }}">
                                                    {{ $permission->name }}
                                                </label>
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
    // Select All / Deselect All functionality
    const selectAllBtn = document.getElementById('selectAllBtn');
    const deselectAllBtn = document.getElementById('deselectAllBtn');
    const permissionCheckboxes = document.querySelectorAll('.permission-checkbox');
    const groupCheckboxes = document.querySelectorAll('.group-checkbox');

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
        });
    });

    // Individual permission checkbox functionality
    permissionCheckboxes.forEach(permissionCheckbox => {
        permissionCheckbox.addEventListener('change', function() {
            const group = this.getAttribute('data-group');
            updateGroupCheckboxState(group);
            updateCardVisualState(group);
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
        const groupCheckbox = document.querySelector(`.group-checkbox[data-group="${group}"]`);

        // Remove existing classes
        cardHeader.classList.remove('bg-selected', 'bg-partial');

        if (groupCheckbox.checked) {
            cardHeader.classList.add('bg-selected');
        } else if (groupCheckbox.indeterminate) {
            cardHeader.classList.add('bg-partial');
        }
    }

    // Function to update all card visual states
    function updateCardVisualStates() {
        const groups = Array.from(groupCheckboxes).map(cb => cb.getAttribute('data-group'));
        groups.forEach(group => updateCardVisualState(group));
    }

    // Initialize group checkbox states on page load
    updateGroupCheckboxStates();
    updateCardVisualStates();

    // Add keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl + A to select all (but prevent default text selection)
        if (e.ctrlKey && e.key === 'a') {
            e.preventDefault();
            selectAllBtn.click();
        }

        // Ctrl + D to deselect all
        if (e.ctrlKey && e.key === 'd') {
            e.preventDefault();
            deselectAllBtn.click();
        }
    });

    // Add visual feedback for group selection on hover
    permissionCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('mouseenter', function() {
            const group = this.getAttribute('data-group');
            const groupCard = document.querySelector(`.group-checkbox[data-group="${group}"]`).closest('.permission-group-card');
            groupCard.style.transform = 'translateY(-2px)';
        });

        checkbox.addEventListener('mouseleave', function() {
            const group = this.getAttribute('data-group');
            const groupCard = document.querySelector(`.group-checkbox[data-group="${group}"]`).closest('.permission-group-card');
            groupCard.style.transform = '';
        });
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
});
</script>
@endpush
