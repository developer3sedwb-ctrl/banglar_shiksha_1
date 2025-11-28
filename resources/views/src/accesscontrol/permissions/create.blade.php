@extends('layouts.app')

@section('title', 'Add Permission')

@section('content')
<div class="container">
    <h2>Add Permission</h2>
    <form action="{{ route('permissions.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label>Role</label>
            <select name="role_id" class="form-control" required>
                <option value="">-- Select Role --</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->userid }} : {{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Module</label>
            <select name="module_id" class="form-control" onchange="getSubModuleList()" required>
                <option value="">-- Select Module --</option>
                @foreach ($modules as $module)
                    <option value="{{ $module->id }}">{{ $module->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3">
            <label>Sub-Module</label>
            <select name="submodule_id" class="form-control" required>
            </select>
        </div>
        <div class="form-check mb-3">
            <input type="checkbox" name="can_view_module" class="form-check-input" id="can_view">
            <label for="can_view" class="form-check-label">Can View Module</label>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        //getSubModuleList(); // Load sub-modules on page load
    });

    function getSubModuleList() {
        const moduleSelect = document.querySelector('select[name="module_id"]');
        const submoduleSelect = document.querySelector('select[name="submodule_id"]');
        const selectedModuleId = moduleSelect.value;

        // Clear existing options
        submoduleSelect.innerHTML = '';

        if (selectedModuleId) {
            fetch(`/modules/${selectedModuleId}/submodules`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(submodule => {
                        const option = document.createElement('option');
                        option.value = submodule.id;
                        option.textContent = submodule.name;
                        if (submodule.id == 44) {
                            option.selected = true;
                        }
                        submoduleSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching sub-modules:', error);
                });
        }
    }  
</script>
@endpush 