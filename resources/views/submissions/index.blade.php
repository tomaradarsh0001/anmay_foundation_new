@extends('admin.layouts.app')

@section('title', 'Admin - Submissions')

@section('content')
<div class="container my-5">
    <h3 class="mb-4">Submitted Forms</h3>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>CV</th>
                <th>Submitted At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($submissions as $submission)
                <tr>
                    <td>{{ $submission->id }}</td>
                    <td>{{ $submission->name }}</td>
                    <td>{{ $submission->email }}</td>
                    <td>{{ $submission->subject ?? '-' }}</td>
                    <td>
                        @if($submission->cv)
                            <a href="{{ asset('storage/'.$submission->cv) }}" target="_blank">Download</a>
                        @else
                            —
                        @endif
                    </td>
                    <td>{{ $submission->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('submissions.show', $submission->id) }}" class="btn btn-sm btn-primary">
                            View
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No submissions found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
