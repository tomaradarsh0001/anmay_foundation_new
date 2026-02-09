@extends('admin.layouts.app')

@section('title', 'Admin - Causes')

@section('content')
<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h4>Edit Cause</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('causes.update', $cause->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Name (Badge)</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $cause->name) }}" required>
                    @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="mb-3">
                    <label for="heading" class="form-label">Heading</label>
                    <input type="text" name="heading" class="form-control" value="{{ old('heading', $cause->heading) }}" required>
                    @error('heading')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea name="content" class="form-control" rows="4" required>{{ old('content', $cause->content) }}</textarea>
                    @error('content')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="mb-3">
                    <label for="target_goal" class="form-label">Target Goal ($)</label>
                    <input type="number" name="target_goal" class="form-control" value="{{ old('target_goal', $cause->target_goal) }}" required>
                    @error('target_goal')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="mb-3">
                    <label for="raised" class="form-label">Raised Amount ($)</label>
                    <input type="number" name="raised" class="form-control" value="{{ old('raised', $cause->raised) }}">
                    @error('raised')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Picture</label>
                    <input type="file" name="image" class="form-control">
                    <small class="text-muted">Leave empty to keep current image</small>
                    <div class="mt-2">
                        <img src="{{ asset('storage/'.$cause->image) }}" alt="{{ $cause->heading }}" style="width:150px; border-radius:5px;">
                    </div>
                    @error('image')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <button type="submit" class="btn btn-warning">Update Cause</button>
            </form>
        </div>
    </div>
</div>
@endsection
