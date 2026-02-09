@extends('admin.layouts.app')

@section('title', 'Admin - Contact Forms')

@section('content')
<div class="container">
    <h2 class="mb-4">📩 Contact Messages</h2>

    <div class="card shadow">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $contact)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->phone ?? '-' }}</td>
                            <td>{{ Str::limit($contact->message, 50) }}</td>
                            <td>{{ $contact->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('admin.contacts.show', $contact->id) }}" class="btn btn-sm btn-primary">
                                    Show
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No messages found.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

            {{ $contacts->links() }}
        </div>
    </div>
</div>
@endsection
