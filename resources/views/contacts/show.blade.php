@extends('admin.layouts.app')

@section('title', 'Admin - Contact Forms')

@section('content')

<div class="container">
    <h2 class="mb-4">📬 Contact Message Details</h2>

    <div class="card shadow">
        <div class="card-body">
            <p class="mb-4" ><strong>Name:</strong> {{ $contact->first_name }} {{ $contact->last_name }}</p>
            <p class="mb-4" ><strong>Email:</strong> {{ $contact->email }}</p>
            <p class="mb-4" ><strong>Phone:</strong> {{ $contact->phone ?? '-' }}</p>
            <p class="mb-4" ><strong>Message:</strong></p>
            <p class="border p-3 bg-light class="mb-4" ">{{ $contact->message }}</p>
            <p class="mb-4" ><strong>Date:</strong> {{ $contact->created_at->format('d M Y, H:i') }}</p>

            <a href="{{ route('admin.contacts') }}" class="btn btn-secondary mt-3">Back to Messages</a>
        </div>
    </div>
</div>
@endsection