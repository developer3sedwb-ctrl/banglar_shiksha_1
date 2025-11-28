@extends('layouts.app')

@section('title', 'Permissions')

@section('content')
<div class="container">
    <h2>Permission List</h2>
    <a href="{{ route('permissions.create') }}" class="btn btn-primary mb-3">Add Permission</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Role</th>
                <th>Module</th>
                <th>Sub-Module</th>
                <th>Can View</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permissions as $permission)
                <tr>
                    <td>{{ $permission->role->userid }}</td>
                    <td>{{ $permission->role->shortcode }}</td>
                    <td>{{ $permission->module->name }}</td>
                    <td>{{ $permission->submodule->name }}</td>
                    <td>{{ $permission->can_view_module ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <!-- <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this permission?')">Delete</button>
                        </form> -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
