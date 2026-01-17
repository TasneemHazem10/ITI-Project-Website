@extends('home.layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center mb-5 mt-5">
    <div class="card p-4 shadow-lg" style="width: 600px">
        <h3 class="text-center mb-4 text_color">Edit Profile</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('home.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="text-center mb-4">
                @php($img = $student->profile_image)
                @php($imgUrl = $img ? (strpos($img,'/') !== false ? asset('storage/'.$img) : asset('storage/images/'.$img)) : 'https://bootdey.com/img/Content/avatar/avatar7.png') 
                <img src="{{ $imgUrl }}" class="img-thumbnail rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
            </div>

            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $student->full_name) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" value="{{ $student->email }}" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="tel" name="phone" class="form-control" value="{{ old('phone', $student->phone) }}" placeholder="01012345678">
            </div>

            <div class="mb-3">
                <label class="form-label">University</label>
                <input type="text" name="university" class="form-control" value="{{ old('university', $student->university) }}">
            </div>

            <div class="mb-4">
                <label class="form-label">Profile Image</label>
                <input type="file" name="profile_image" accept="image/*" class="form-control">
                <small class="text-muted">JPG, PNG, GIF. Max 5MB</small>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('home.profile') }}" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn btn-danger">Save Changes</button>
            </div>
        </form>
    </div>
</div>
@endsection
