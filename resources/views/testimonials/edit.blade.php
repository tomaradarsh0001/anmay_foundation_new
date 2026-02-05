@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h4>Edit Testimonial</h4>

    <form method="POST" action="{{ route('testimonials.update', $testimonial->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Testimonial Text</label>
            <textarea name="text" class="form-control" rows="4" required>{{ $testimonial->text }}</textarea>
        </div>

        <div class="mb-3">
            <label>Name</label>
            <input name="name" class="form-control" value="{{ $testimonial->name }}" required>
        </div>

        <div class="mb-3">
            <label>Profession</label>
            <input name="profession" class="form-control" value="{{ $testimonial->profession }}" required>
        </div>

        <button class="btn btn-warning">Update</button>
    </form>
</div>
@endsection
