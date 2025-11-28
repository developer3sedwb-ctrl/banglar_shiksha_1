@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Module</h2>

    {{-- Show success or error messages --}}
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

    {{-- Module creation form --}}
    <form action="{{ route('modules.store') }}" method="POST">
        @csrf

        <?php 
            $pid = null;
            if(!empty($module))
            {
                $pid = $module->id;
        ?>
        <div class="form-group mb-3">
            <label>Parent Module : {{$module->name}}</label>
        </div>        
        <?php
            }
        ?>



        <div class="mb-3">
            <label for="name" class="form-label">Module Name</label>
            <input type="hidden" name="parent_module_id" id="parent_module_id"  value="{{ $pid }}" />
            <input type="text" name="name" id="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}" placeholder="Enter module name" required>
            @error('name')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>
        @if(!empty($module))
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
            <button type="submit" class="btn btn-success">Save Module</button>
            <a href="{{ route('modules.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
@endsection
