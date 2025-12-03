@extends('layouts.app')

@section('title', 'Edit Role')
@section('page-title', 'Edit Role')
@section('page-subtitle', 'Update role information and permissions')

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
        border-bottom: 1px solid #dee2e6;
    }

    .group-header:hover {
        background-color: #e9ecef;
    }

    .permission-item {
        padding: 0.375rem 0.75rem;
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

    /* Green background when all checkboxes are selected */
    .card-all-selected {
        border-color: #198754 !important;
        background-color: rgba(25, 135, 84, 0.02) !important;
    }

    .card-all-selected .group-header {
        background-color: rgba(25, 135, 84, 0.1) !important;
        border-left: 4px solid #198754;
        color: #198754;
    }

    .card-all-selected .group-header h6 {
        color: #198754;
        font-weight: 600;
    }

    .card-all-selected .permission-item {
        border-color: rgba(25, 135, 84, 0.1);
    }

    /* Partial selection style */
    .card-partial-selected {
        border-color: #ffc107 !important;
        background-color: rgba(255, 193, 7, 0.02) !important;
    }

    .card-partial-selected .group-header {
        background-color: rgba(255, 193, 7, 0.1) !important;
        border-left: 4px solid #ffc107;
        color: #ffc107;
    }

    .card-partial-selected .group-header h6 {
        color: #ffc107;
        font-weight: 600;
    }

    .breadcrumb-item a {
        text-decoration: none;
    }

    .breadcrumb-item.active {
        color: #6c757d;
    }

    .stats-badge {
        font-size: 0.7rem;
        padding: 0.2rem 0.4rem;
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
                    <li class="breadcrumb-item active" aria-current="page">Edit {{ $role->name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Error Display Component -->
    <x-error-display />

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 fs-6 fw-bold">
                            <i class='bx bx-edit me-2'></i>Edit Role: {{ $role->name }}
                        </h5>
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class='bx bx-arrow-back me-1'></i>Back
                        </a>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.roles.update', $role->id) }}">
                    @csrf
                    @method('PUT')
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
                                               value="{{ old('name', $role->name) }}"
                                               placeholder="e.g., Content Manager"
                                               required
                                               {{ in_array($role->name, ['Super Admin', 'State Admin']) && !auth()->user()->hasRole('Super Admin') ? 'disabled' : '' }}>
                                        @error('name')
                                            <div class="invalid-feedback small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Stakeholder</label>
                                        <select class="form-select form-select-sm @error('stakeholder') is-invalid @enderror"
                                                name="stakeholder"
                                                id="stakeholder">
                                            <option value="">Select Stakeholder</option>
                                            @foreach($stakeholderTypes as $type)
                                                <option value="{{ $type }}" {{ old('stakeholder', $role->stakeholder) == $type ? 'selected' : '' }}>
                                                    {{ $type }}
                                                </option>
                                            @endforeach
                                            <option value="custom" {{ old('stakeholder', $role->stakeholder) == 'custom' || (!in_array($role->stakeholder, $stakeholderTypes) && $role->stakeholder) ? 'selected' : '' }}>Custom...</option>
                                        </select>
                                        @error('stakeholder')
                                            <div class="invalid-feedback small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label small fw-bold">Description</label>
                                        <textarea class="form-control form-control-sm"
                                                  id="description"
                                                  name="description"
                                                  rows="2"
                                                  placeholder="Brief description of the role's purpose">{{ old('description', $role->description) }}</textarea>
                                    </div>

                                    <!-- Custom Stakeholder Field -->
                                    <div class="col-md-6" id="customStakeholderField" style="display: {{ old('stakeholder', $role->stakeholder) == 'custom' || (!in_array($role->stakeholder, $stakeholderTypes) && $role->stakeholder) ? 'block' : 'none' }};">
                                        <label class="form-label small fw-bold">Custom Stakeholder</label>
                                        <input type="text"
                                               class="form-control form-control-sm"
                                               name="custom_stakeholder"
                                               value="{{ old('custom_stakeholder', (!in_array($role->stakeholder, $stakeholderTypes) && $role->stakeholder) ? $role->stakeholder : '') }}"
                                               placeholder="Enter custom stakeholder name">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="card bg-light h-100">
                                    <div class="card-body">
                                        <h6 class="card-title small fw-bold mb-3">
                                            <i class='bx bx-info-circle me-2'></i>Role Information
                                        </h6>
                                        <ul class="small text-muted mb-0 ps-3">
                                            <li class="mb-2"><strong>ID:</strong> #{{ $role->id }}</li>
                                            <li class="mb-2"><strong>Guard:</strong> {{ $role->guard_name }}</li>
                                            <li class="mb-2"><strong>Users:</strong> {{ $role->users_count ?? $role->users->count() }}</li>
                                            <li class="mb-2"><strong>Permissions:</strong> {{ count($rolePermissions) }}</li>
                                            <li class="mb-2"><strong>Created:</strong> {{ $role->created_at->format('M d, Y') }}</li>
                                            <li><strong>Updated:</strong> {{ $role->updated_at->format('M d, Y') }}</li>
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
                                            Update permissions for this role. Current: <span id="currentSelected">{{ count($rolePermissions) }}</span> permissions
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

                                <!-- Permissions Stats -->
                                <div class="alert alert-light border small mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class='bx bx-stats me-1'></i>
                                            <span id="permissionsCount">{{ count($rolePermissions) }}</span> of <span id="totalPermissions">0</span> permissions selected
                                            <span class="mx-2">•</span>
                                            <span id="selectedGroups">0</span> of {{ count($permissions) }} groups selected
                                        </div>
                                        <div>
                                            <span class="badge bg-success stats-badge" id="fullGroups">0</span>
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
                                        @php
                                            $groupPermissionsCount = count($groupPermissions);
                                            $selectedInGroup = 0;
                                            foreach ($groupPermissions as $permission) {
                                                if (in_array($permission->id, $rolePermissions)) {
                                                    $selectedInGroup++;
                                                }
                                            }
                                        @endphp
                                        <div class="col-md-4">
                                            <div class="card permission-card h-100 {{ $selectedInGroup === $groupPermissionsCount ? 'card-all-selected' : ($selectedInGroup > 0 ? 'card-partial-selected' : '') }}">
                                                <div class="group-header d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h6 class="mb-0 small fw-bold text-capitalize">{{ $group }}</h6>
                                                        <small class="text-muted">
                                                            <span class="selected-count">{{ $selectedInGroup }}</span>/{{ $groupPermissionsCount }} selected
                                                        </small>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input group-checkbox"
                                                               type="checkbox"
                                                               data-group="{{ $group }}"
                                                               id="group_{{ $loop->index }}"
                                                               {{ $selectedInGroup === $groupPermissionsCount ? 'checked' : '' }}
                                                               {{ $selectedInGroup > 0 && $selectedInGroup < $groupPermissionsCount ? 'data-indeterminate="true"' : '' }}>
                                                        <label class="form-check-label small"
                                                               for="group_{{ $loop->index }}">
                                                            All
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="card-body p-0">
                                                    @foreach ($groupPermissions as $permission)
                                                        <div class="permission-item">
                                                            <div class="form-check mb-0">
                                                                <input class="form-check-input permission-checkbox"
                                                                       type="checkbox"
                                                                       name="permissions[]"
                                                                       value="{{ $permission->id }}"
                                                                       id="permission_{{ $permission->id }}"
                                                                       data-group="{{ $group }}"
                                                                       {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
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
                                <span id="totalSelected">{{ count($rolePermissions) }}</span> permissions will be assigned
                            </div>
                            <div class="btn-group">
                                <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary btn-sm">
                                    <i class='bx bx-x me-1'></i>Cancel
                                </a>
                                <button type="submit" class="btn btn-primary btn-sm" id="submitBtn">
                                    <i class='bx bx-save me-1'></i>Update Role
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
        const totalPermissions = document.getElementById('totalPermissions');
        const selectedGroups = document.getElementById('selectedGroups');
        const fullGroups = document.getElementById('fullGroups');
        const partialGroups = document.getElementById('partialGroups');
        const totalSelected = document.getElementById('totalSelected');
        const currentSelected = document.getElementById('currentSelected');
        const stakeholderSelect = document.getElementById('stakeholder');
        const customStakeholderField = document.getElementById('customStakeholderField');
        const submitBtn = document.getElementById('submitBtn');

        // Set total permissions count
        totalPermissions.textContent = permissionCheckboxes.length;

        // Common permissions (adjust as needed)
        const commonPermissions = [
            'view', 'list', 'read', 'show', 'profile', 'dashboard', 'index'
        ];

        // Stakeholder field toggle
        stakeholderSelect.addEventListener('change', function() {
            if (this.value === 'custom') {
                customStakeholderField.style.display = 'block';
            } else {
                customStakeholderField.style.display = 'none';
            }
        });

        // Set indeterminate state for group checkboxes on page load
        groupCheckboxes.forEach(groupCb => {
            if (groupCb.dataset.indeterminate === 'true') {
                groupCb.indeterminate = true;
            }
        });

        // Update statistics
        function updateStats() {
            const selectedPermissions = document.querySelectorAll('.permission-checkbox:checked').length;
            const totalPerms = permissionCheckboxes.length;

            let fullGroupCount = 0;
            let partialGroupCount = 0;
            let selectedGroupCount = 0;

            groupCheckboxes.forEach(checkbox => {
                const group = checkbox.dataset.group;
                const groupCheckboxes = document.querySelectorAll(`.permission-checkbox[data-group="${group}"]`);
                const groupCards = document.querySelectorAll(`.permission-card`);

                const checkedCount = Array.from(groupCheckboxes).filter(cb => cb.checked).length;
                const groupTotal = groupCheckboxes.length;

                // Update group card styling
                const card = checkbox.closest('.permission-card');
                const selectedCountSpan = card.querySelector('.selected-count');

                if (selectedCountSpan) {
                    selectedCountSpan.textContent = checkedCount;
                }

                // Update card classes
                card.classList.remove('card-all-selected', 'card-partial-selected');

                if (checkedCount === groupTotal && groupTotal > 0) {
                    card.classList.add('card-all-selected');
                    fullGroupCount++;
                    selectedGroupCount++;
                } else if (checkedCount > 0) {
                    card.classList.add('card-partial-selected');
                    partialGroupCount++;
                    selectedGroupCount++;
                }

                // Update group checkbox state
                if (checkedCount === 0) {
                    checkbox.checked = false;
                    checkbox.indeterminate = false;
                } else if (checkedCount === groupTotal) {
                    checkbox.checked = true;
                    checkbox.indeterminate = false;
                } else {
                    checkbox.checked = false;
                    checkbox.indeterminate = true;
                }
            });

            permissionsCount.textContent = selectedPermissions;
            selectedGroups.textContent = selectedGroupCount;
            fullGroups.textContent = fullGroupCount;
            partialGroups.textContent = partialGroupCount;
            totalSelected.textContent = selectedPermissions;
            currentSelected.textContent = selectedPermissions;
        }

        // Select All button
        selectAllBtn.addEventListener('click', function() {
            permissionCheckboxes.forEach(cb => cb.checked = true);
            groupCheckboxes.forEach(cb => {
                cb.checked = true;
                cb.indeterminate = false;
            });
            updateStats();
        });

        // Select Common button
        selectCommonBtn.addEventListener('click', function() {
            permissionCheckboxes.forEach(cb => {
                const label = cb.nextElementSibling.textContent.toLowerCase();
                cb.checked = commonPermissions.some(perm => label.includes(perm));
            });
            updateStats();
        });

        // Deselect All button
        deselectAllBtn.addEventListener('click', function() {
            permissionCheckboxes.forEach(cb => cb.checked = false);
            groupCheckboxes.forEach(cb => {
                cb.checked = false;
                cb.indeterminate = false;
            });
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
                updateStats();
            });
        });

        // Individual permission checkbox functionality
        permissionCheckboxes.forEach(permissionCb => {
            permissionCb.addEventListener('change', function() {
                updateStats();
            });
        });

        // Group header click
        document.querySelectorAll('.group-header').forEach(header => {
            header.addEventListener('click', function(e) {
                if (!e.target.matches('input[type="checkbox"]') && !e.target.matches('label')) {
                    const checkbox = this.querySelector('.group-checkbox');
                    checkbox.checked = !checkbox.checked;
                    checkbox.indeterminate = false;
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
            const roleName = document.getElementById('name').value;

            // Disable submit button to prevent double submission
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="bx bx-loader-alt bx-spin me-1"></i>Updating...';
            }

            // Validate stakeholder if custom
            if (stakeholderSelect.value === 'custom') {
                const customValue = document.querySelector('input[name="custom_stakeholder"]').value.trim();
                if (!customValue) {
                    e.preventDefault();
                    alert('Please enter a custom stakeholder name');
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = '<i class="bx bx-save me-1"></i>Update Role';
                    }
                    return;
                }
            }

            // Check if role name is being changed for protected roles
            if (['Super Admin', 'State Admin'].includes(roleName)) {
                if (!confirm('You are editing a protected role. Continue?')) {
                    e.preventDefault();
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = '<i class="bx bx-save me-1"></i>Update Role';
                    }
                    return;
                }
            }

            // Warn if no permissions selected
            if (selectedCount === 0) {
                if (!confirm('No permissions selected. Update role without any permissions?')) {
                    e.preventDefault();
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = '<i class="bx bx-save me-1"></i>Update Role';
                    }
                }
            }
        });

        // Initialize stats on page load
        updateStats();

        // Add tooltips for permission names
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endpush
