@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between mb-3">
        <h4>Testimonials</h4>
        <a href="{{ route('testimonials.create') }}" class="btn btn-primary">Add New</a>
    </div>

    @foreach($testimonials as $testimonial)
        <div class="card mb-3">
            <div class="card-body">
                <p>{{ $testimonial->text }}</p>
                <strong>{{ $testimonial->name }}</strong> —
                <em>{{ $testimonial->profession }}</em>

                <div class="mt-2">
                    <a href="{{ route('testimonials.edit', $testimonial->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form method="POST" action="{{ route('testimonials.destroy', $testimonial->id) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
