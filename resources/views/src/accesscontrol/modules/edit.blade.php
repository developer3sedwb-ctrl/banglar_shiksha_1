@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Module</h2>

    {{-- Success message --}}
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

    {{-- Edit Form --}}
    <form action="{{ route('modules.update', $module->id) }}" method="POST">
        @csrf
        @method('PUT')

        @if($module->parent_module_id)
        <div class="form-group mb-3">
            <label>Parent Module : {{$parentModule->name}}</label>
        </div>
        @endif
        <div class="mb-3">
            <label for="name" class="form-label">
                @if($module->parent_module_id)
                    Sub-Module Name
                @else
                    Module Name
                @endif
            </label>
            <input type="text" name="name" id="name"
                   value="{{ old('name', $module->name) }}"
                   class="form-control @error('name') is-invalid @enderror"
                   required>
            @error('name')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>
        @if($module->parent_module_id)
        <div class="mb-3">
            <label for="name" class="form-label">URL</label>
            <input type="text" name="url" id="url" value="{{ old('url', $module->url) }}"
                    placeholder="/student-entry-form"
                   class="form-control @error('url') is-invalid @enderror" required>
            @error('url')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>
        @endif
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Update Module</button>
            <a href="{{ route('modules.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
@endsection
