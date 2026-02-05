@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>All Causes</h3>
        <a href="{{ route('causes.create') }}" class="btn btn-primary">Add New Cause</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name (Badge)</th>
                    <th>Heading</th>
                    <th>Target Goal ($)</th>
                    <th>Raised ($)</th>
                    <th>Progress</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($causes as $cause)
                <tr>
                    <td>{{ $cause->id }}</td>
                    <td>{{ $cause->name }}</td>
                    <td>{{ $cause->heading }}</td>
                    <td>${{ number_format($cause->target_goal) }}</td>
                    <td>${{ number_format($cause->raised) }}</td>
                    <td>
                        @php
                            $percent = ($cause->raised / $cause->target_goal) * 100;
                        @endphp
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $percent }}%">
                                {{ round($percent) }}%
                            </div>
                        </div>
                    </td>
                    <td>
                        <img src="{{ asset('storage/'.$cause->image) }}" alt="{{ $cause->heading }}" style="width:80px; border-radius:5px;">
                    </td>
                    <td>
                        <a href="{{ route('causes.edit', $cause->id) }}" class="btn btn-sm btn-warning mb-1">Edit</a>
                        <form action="{{ route('causes.destroy', $cause->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this cause?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No causes found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
