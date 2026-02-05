<!-- resources/views/website_details/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Website Details</h2>

    <form action="{{ route('website-details.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-3">

            <div class="col-md-6">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $detail->phone) }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $detail->email) }}">
            </div>

            <div class="col-12">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control">{{ old('address', $detail->address) }}</textarea>
            </div>

            <div class="col-md-6">
                <label class="form-label">Instagram URL</label>
                <input type="url" name="instagram" class="form-control" value="{{ old('instagram', $detail->instagram) }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">Twitter URL</label>
                <input type="url" name="twitter" class="form-control" value="{{ old('twitter', $detail->twitter) }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">Facebook URL</label>
                <input type="url" name="facebook" class="form-control" value="{{ old('facebook', $detail->facebook) }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">LinkedIn URL</label>
                <input type="url" name="linkedin" class="form-control" value="{{ old('linkedin', $detail->linkedin) }}">
            </div>

            <div class="col-12">
                <label class="form-label">YouTube URL</label>
                <input type="url" name="youtube" class="form-control" value="{{ old('youtube', $detail->youtube) }}">
            </div>

            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-success">Update Details</button>
                <a href="{{ route('website-details.index') }}" class="btn btn-secondary">Back</a>
            </div>

        </div>
    </form>
</div>
@endsection
