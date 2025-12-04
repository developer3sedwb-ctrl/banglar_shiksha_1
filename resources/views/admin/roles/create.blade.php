@extends('layouts.app')

@section('title', 'Create Role')
@section('page-title', 'Create Role')
@section('page-subtitle', 'Add a new role with specific permissions')

@push('css')
<style>
    .permission-card {
        transition: all 0.2s ease;
        border: 1px solid #dee2e6;
    }

    .permission-card:hover {
        border-color: #0d6efd;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    .group-header {
        background-color: #f8f9fa;
        cursor: pointer;
        padding: 0.75rem 1rem;
    }

    .group-header:hover {
        background-color: #e9ecef;
    }

    .permission-item {
        padding: 0.375rem 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        font-size: 0.875rem;
    }

    .permission-item:last-child {
        border-bottom: none;
    }

    .permission-item:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }

    .form-check-input:checked {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .group-checkbox:checked {
        background-color: #198754;
        border-color: #198754;
    }

    .card-selected {
        border-color: #198754;
        box-shadow: 0 0 0 1px rgba(25, 135, 84, 0.25);
    }

    .card-partial {
        border-color: #ffc107;
        box-shadow: 0 0 0 1px rgba(255, 193, 7, 0.25);
    }

    .stats-badge {
        font-size: 0.7rem;
        padding: 0.2rem 0.4rem;
    }

    .breadcrumb-item.active {
        color: #6c757d;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <!-- Breadcrumb -->
    <div class="row mb-3">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 fs-6 fw-bold">
                            <i class='bx bx-plus me-2'></i>Create New Role
                        </h5>
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class='bx bx-arrow-back me-1'></i>Back
                        </a>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.roles.store') }}">
                    @csrf
                    <div class="card-body">
                        <!-- Role Information -->
                        <div class="row mb-4">
                            <div class="col-lg-8">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Role Name <span class="text-danger">*</span></label>
                                        <input type="text"
                                               class="form-control form-control-sm @error('name') is-invalid @enderror"
                                               id="name"
                                               name="name"
                                               value="{{ old('name') }}"
                                               placeholder="e.g., Content Manager"
                                               required>
                                        @error('name')
                                            <div class="invalid-feedback small">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Use a descriptive name for the role</small>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Stakeholder</label>
                                        <select class="form-select form-select-sm @error('stakeholder') is-invalid @enderror"
                                                name="stakeholder"
                                                id="stakeholder">
                                            <option value="">Select Stakeholder</option>
                                            @foreach($stakeholderTypes as $type)
                                                <option value="{{ $type }}" {{ old('stakeholder') == $type ? 'selected' : '' }}>
                                                    {{ $type }}
                                                </option>
                                            @endforeach
                                            <option value="custom" {{ old('stakeholder') == 'custom' ? 'selected' : '' }}>Custom...</option>
                                        </select>
                                        @error('stakeholder')
                                            <div class="invalid-feedback small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Custom Stakeholder Field (hidden by default) -->
                                    <div class="col-md-6" id="customStakeholderField" style="display: none;">
                                        <label class="form-label small fw-bold">Custom Stakeholder</label>
                                        <input type="text"
                                               class="form-control form-control-sm"
                                               name="custom_stakeholder"
                                               value="{{ old('custom_stakeholder') }}"
                                               placeholder="Enter custom stakeholder name">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="card bg-light h-100">
                                    <div class="card-body">
                                        <h6 class="card-title small fw-bold mb-3">
                                            <i class='bx bx-info-circle me-2'></i>Quick Tips
                                        </h6>
                                        <ul class="small text-muted mb-0 ps-3">
                                            <li class="mb-2">Use clear, descriptive role names</li>
                                            <li class="mb-2">Assign stakeholder for better organization</li>
                                            <li class="mb-2">Select only necessary permissions</li>
                                            <li>Review permissions before creating</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Permissions Section -->
                        <div class="row">
                            <div class="col-12">
                                <!-- Permissions Header -->
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1 fw-bold">
                                            <i class='bx bx-key me-2'></i>Permissions
                                        </h6>
                                        <p class="text-muted small mb-0">
                                            Select the permissions for this role. You can select individual permissions or entire groups.
                                        </p>
                                    </div>

                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button" class="btn btn-outline-success" id="selectAllBtn">
                                            <i class='bx bx-check-double me-1'></i>All
                                        </button>
                                        <button type="button" class="btn btn-outline-warning" id="selectCommonBtn">
                                            <i class='bx bx-check me-1'></i>Common
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary" id="deselectAllBtn">
                                            <i class='bx bx-x me-1'></i>None
                                        </button>
                                    </div>
                                </div>

                                @error('permissions')
                                    <div class="alert alert-danger small mb-3">{{ $message }}</div>
                                @enderror

                                <!-- Permissions Stats -->
                                <div class="alert alert-light border small mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class='bx bx-stats me-1'></i>
                                            <span id="permissionsCount">0</span> permissions selected
                                            <span class="mx-2">•</span>
                                            <span id="selectedGroups">0</span> groups selected
                                        </div>
                                        <div>
                                            <span class="badge bg-primary stats-badge" id="fullGroups">0</span>
                                            <span class="small text-muted">fully selected</span>
                                            <span class="mx-2">•</span>
                                            <span class="badge bg-warning stats-badge" id="partialGroups">0</span>
                                            <span class="small text-muted">partially selected</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Permissions Grid -->
                                <div class="row g-3">
                                    @foreach ($permissions as $group => $groupPermissions)
                                        <div class="col-md-4">
                                            <div class="card permission-card h-100">
                                                <div class="group-header d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h6 class="mb-0 small fw-bold text-capitalize">{{ $group }}</h6>
                                                        <small class="text-muted">
                                                            {{ count($groupPermissions) }} permissions
                                                        </small>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input group-checkbox"
                                                               type="checkbox"
                                                               data-group="{{ $group }}"
                                                               id="group_{{ $loop->index }}">
                                                        <label class="form-check-label small"
                                                               for="group_{{ $loop->index }}">
                                                            All
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="card-body p-3">
                                                    @foreach ($groupPermissions as $permission)
                                                        <div class="permission-item">
                                                            <div class="form-check mb-0">
                                                                <input class="form-check-input permission-checkbox"
                                                                       type="checkbox"
                                                                       name="permissions[]"
                                                                       value="{{ $permission->id }}"
                                                                       id="permission_{{ $permission->id }}"
                                                                       data-group="{{ $group }}">
                                                                <label class="form-check-label small"
                                                                       for="permission_{{ $permission->id }}"
                                                                       title="{{ $permission->name }}">
                                                                    {{ Str::limit($permission->name, 30) }}
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

                    <div class="card-footer bg-white py-3 border-top">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="small text-muted">
                                <span id="totalSelected">0</span> permissions will be assigned
                            </div>
                            <div class="btn-group">
                                <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary btn-sm">
                                    <i class='bx bx-x me-1'></i>Cancel
                                </a>
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class='bx bx-save me-1'></i>Create Role
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
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
        const selectCommonBtn = document.getElementById('selectCommonBtn');
        const permissionCheckboxes = document.querySelectorAll('.permission-checkbox');
        const groupCheckboxes = document.querySelectorAll('.group-checkbox');
        const permissionsCount = document.getElementById('permissionsCount');
        const selectedGroups = document.getElementById('selectedGroups');
        const fullGroups = document.getElementById('fullGroups');
        const partialGroups = document.getElementById('partialGroups');
        const totalSelected = document.getElementById('totalSelected');
        const stakeholderSelect = document.getElementById('stakeholder');
        const customStakeholderField = document.getElementById('customStakeholderField');

        // Common permissions (adjust as needed)
        const commonPermissions = [
            'view', 'list', 'read', 'show', 'profile', 'dashboard'
        ];

        // Stakeholder field toggle
        stakeholderSelect.addEventListener('change', function() {
            if (this.value === 'custom') {
                customStakeholderField.style.display = 'block';
            } else {
                customStakeholderField.style.display = 'none';
            }
        });

        // Initialize custom stakeholder field
        if (stakeholderSelect.value === 'custom') {
            customStakeholderField.style.display = 'block';
        }

        // Update statistics
        function updateStats() {
            const selectedPermissions = document.querySelectorAll('.permission-checkbox:checked').length;
            const totalPermissions = permissionCheckboxes.length;

            let fullGroupCount = 0;
            let partialGroupCount = 0;
            let selectedGroupCount = 0;

            groupCheckboxes.forEach(checkbox => {
                const group = checkbox.dataset.group;
                const groupCheckboxes = document.querySelectorAll(`.permission-checkbox[data-group="${group}"]`);
                const checkedCount = Array.from(groupCheckboxes).filter(cb => cb.checked).length;

                if (checkedCount === groupCheckboxes.length) {
                    fullGroupCount++;
                    selectedGroupCount++;
                } else if (checkedCount > 0) {
                    partialGroupCount++;
                    selectedGroupCount++;
                }
            });

            permissionsCount.textContent = `${selectedPermissions} of ${totalPermissions}`;
            selectedGroups.textContent = selectedGroupCount;
            fullGroups.textContent = fullGroupCount;
            partialGroups.textContent = partialGroupCount;
            totalSelected.textContent = selectedPermissions;
        }

        // Select All button
        selectAllBtn.addEventListener('click', function() {
            permissionCheckboxes.forEach(cb => cb.checked = true);
            groupCheckboxes.forEach(cb => {
                cb.checked = true;
                cb.indeterminate = false;
            });
            updateCardStates();
            updateStats();
        });

        // Select Common button
        selectCommonBtn.addEventListener('click', function() {
            permissionCheckboxes.forEach(cb => {
                const label = cb.nextElementSibling.textContent.toLowerCase();
                cb.checked = commonPermissions.some(perm => label.includes(perm));
            });
            updateGroupCheckboxes();
            updateCardStates();
            updateStats();
        });

        // Deselect All button
        deselectAllBtn.addEventListener('click', function() {
            permissionCheckboxes.forEach(cb => cb.checked = false);
            groupCheckboxes.forEach(cb => {
                cb.checked = false;
                cb.indeterminate = false;
            });
            updateCardStates();
            updateStats();
        });

        // Group checkbox functionality
        groupCheckboxes.forEach(groupCb => {
            groupCb.addEventListener('change', function() {
                const group = this.dataset.group;
                const groupPermissions = document.querySelectorAll(`.permission-checkbox[data-group="${group}"]`);

                groupPermissions.forEach(cb => {
                    cb.checked = this.checked;
                });

                this.indeterminate = false;
                updateCardState(group);
                updateStats();
            });
        });

        // Individual permission checkbox functionality
        permissionCheckboxes.forEach(permissionCb => {
            permissionCb.addEventListener('change', function() {
                const group = this.dataset.group;
                updateGroupCheckbox(group);
                updateCardState(group);
                updateStats();
            });
        });

        // Update group checkbox state
        function updateGroupCheckbox(group) {
            const groupPermissions = document.querySelectorAll(`.permission-checkbox[data-group="${group}"]`);
            const groupCheckbox = document.querySelector(`.group-checkbox[data-group="${group}"]`);
            const checkedCount = Array.from(groupPermissions).filter(cb => cb.checked).length;

            if (checkedCount === 0) {
                groupCheckbox.checked = false;
                groupCheckbox.indeterminate = false;
            } else if (checkedCount === groupPermissions.length) {
                groupCheckbox.checked = true;
                groupCheckbox.indeterminate = false;
            } else {
                groupCheckbox.checked = false;
                groupCheckbox.indeterminate = true;
            }
        }

        // Update all group checkboxes
        function updateGroupCheckboxes() {
            const groups = new Set(Array.from(permissionCheckboxes).map(cb => cb.dataset.group));
            groups.forEach(group => updateGroupCheckbox(group));
        }

        // Update card visual state
        function updateCardState(group) {
            const card = document.querySelector(`.group-checkbox[data-group="${group}"]`).closest('.card');
            const groupCheckbox = document.querySelector(`.group-checkbox[data-group="${group}"]`);

            card.classList.remove('card-selected', 'card-partial');

            if (groupCheckbox.checked) {
                card.classList.add('card-selected');
            } else if (groupCheckbox.indeterminate) {
                card.classList.add('card-partial');
            }
        }

        // Update all card states
        function updateCardStates() {
            const groups = new Set(Array.from(permissionCheckboxes).map(cb => cb.dataset.group));
            groups.forEach(group => updateCardState(group));
        }

        // Group header click
        document.querySelectorAll('.group-header').forEach(header => {
            header.addEventListener('click', function(e) {
                if (!e.target.matches('input[type="checkbox"]') && !e.target.matches('label')) {
                    const checkbox = this.querySelector('.group-checkbox');
                    checkbox.checked = !checkbox.checked;
                    checkbox.dispatchEvent(new Event('change'));
                }
            });
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey || e.metaKey) {
                switch(e.key.toLowerCase()) {
                    case 'a':
                        e.preventDefault();
                        selectAllBtn.click();
                        break;
                    case 'd':
                        e.preventDefault();
                        deselectAllBtn.click();
                        break;
                    case 'c':
                        e.preventDefault();
                        selectCommonBtn.click();
                        break;
                }
            }
        });

        // Form validation
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            const selectedCount = document.querySelectorAll('.permission-checkbox:checked').length;

            // Validate stakeholder if custom
            if (stakeholderSelect.value === 'custom') {
                const customValue = document.querySelector('input[name="custom_stakeholder"]').value.trim();
                if (!customValue) {
                    e.preventDefault();
                    alert('Please enter a custom stakeholder name');
                    return;
                }
            }

            // Warn if no permissions
            if (selectedCount === 0) {
                if (!confirm('No permissions selected. Create role without permissions?')) {
                    e.preventDefault();
                }
            }
        });

        // Initialize
        updateGroupCheckboxes();
        updateCardStates();
        updateStats();

        // Add tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endpush
