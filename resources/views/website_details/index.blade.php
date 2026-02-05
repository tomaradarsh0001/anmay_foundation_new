<!-- resources/views/website_details/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Website Details</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <ul class="list-group mb-3">
        <li class="list-group-item"><strong>Phone:</strong> {{ $detail->phone ?? '-' }}</li>
        <li class="list-group-item"><strong>Email:</strong> {{ $detail->email ?? '-' }}</li>
        <li class="list-group-item"><strong>Address:</strong> {{ $detail->address ?? '-' }}</li>
        <li class="list-group-item"><strong>Instagram:</strong> <a href="{{ $detail->instagram }}" target="_blank">{{ $detail->instagram ?? '-' }}</a></li>
        <li class="list-group-item"><strong>Twitter:</strong> <a href="{{ $detail->twitter }}" target="_blank">{{ $detail->twitter ?? '-' }}</a></li>
        <li class="list-group-item"><strong>Facebook:</strong> <a href="{{ $detail->facebook }}" target="_blank">{{ $detail->facebook ?? '-' }}</a></li>
        <li class="list-group-item"><strong>LinkedIn:</strong> <a href="{{ $detail->linkedin }}" target="_blank">{{ $detail->linkedin ?? '-' }}</a></li>
        <li class="list-group-item"><strong>YouTube:</strong> <a href="{{ $detail->youtube }}" target="_blank">{{ $detail->youtube ?? '-' }}</a></li>
    </ul>

    <a href="{{ route('website-details.edit') }}" class="btn btn-primary">Edit Details</a>
</div>
@endsection
