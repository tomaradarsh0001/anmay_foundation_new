@extends('admin.layouts.app')

@section('title', 'Admin - Testimonials')

@section('content')
<div class="container my-5">
    <h4>Add Testimonial</h4>

    <form method="POST" action="{{ route('testimonials.store') }}">
        @csrf

        <div class="mb-3">
            <label>Testimonial Text</label>
            <textarea name="text" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label>Name</label>
            <input name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Profession</label>
            <input name="profession" class="form-control" required>
        </div>

        <button class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
