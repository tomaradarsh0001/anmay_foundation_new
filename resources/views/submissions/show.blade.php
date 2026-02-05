@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            Submission Details
        </div>

        <div class="card-body">
            <p><strong>Name:</strong> {{ $submission->name }}</p>
            <p><strong>Email:</strong> {{ $submission->email }}</p>
            <p><strong>Subject:</strong> {{ $submission->subject ?? '—' }}</p>
            <p><strong>Comment:</strong><br>{{ $submission->comment ?? '—' }}</p>

            @if($submission->cv)
                <p>
                    <strong>CV:</strong>
                    <a href="{{ asset('storage/'.$submission->cv) }}" target="_blank">
                        Download CV
                    </a>
                </p>
            @endif

            <a href="{{ route('submissions.index') }}" class="btn btn-secondary mt-3">
                Back
            </a>
        </div>
    </div>
</div>
@endsection
