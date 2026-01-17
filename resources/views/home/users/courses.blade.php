
@extends('home.layouts.app')

@section('content')

<div class="container my-5">
    <div class="text-center mb-5">
        <h2 class="display-5 fw-bold text-danger mb-3">
            <i class="fas fa-graduation-cap me-2"></i>
            All Courses
        </h2>
        <p class="lead text-muted">Explore our complete course catalog</p>
    </div>

    <div class="row g-4">
        @forelse($courses as $course)
        <div class="col-lg-4 col-md-6">
            <div class="card course-card h-100 shadow-lg">
                <div class="course-image-container">
                    <img src="{{ $course->image ? asset('storage/images/'.$course->image) : asset('home/assets/images/iti_logo.svg') }}" class="card-img-top course-image" alt="{{ $course->course_name }}">
                    <div class="course-overlay">
                        @if($course->featured)
                            <div class="course-badge">Featured</div>
                        @endif
                        <div class="course-duration">
                            <i class="fas fa-clock me-1"></i>{{ $course->duration }}
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h4 class="card-title text-danger mb-0">{{ $course->course_name }}</h4>
                    </div>
                    <p class="card-text text-muted mb-4">
                        {{ Str::limit($course->course_description, 140) }}
                    </p>
                    <div class="row mb-4">
                        <div class="col-6">
                            <div class="course-info">
                                <i class="fas fa-calendar text-danger me-2"></i>
                                <span>{{ $course->start_date?->format('M d, Y') }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="course-info">
                                <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                <span>{{ $course->location }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="course-price">
                            <span class="h5 text-danger mb-0">Free</span>
                            <small class="text-muted d-block">For ITI Students</small>
                        </div>
                        <a href="{{ route('home.show', $course->id) }}" class="btn btn-danger btn-lg px-4">
                            <i class="fas fa-eye me-2"></i>View Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">No courses found.</div>
            </div>
        @endforelse
    </div>
</div>


@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('home/assets/js/main.js')}}"></script>
    <script src="{{asset('home/assets/js/footer.js')}}"></script>
    <script src="{{asset('home/assets/js/login-toggle.js')}}"></script>
    <script src="{{asset('home/assets/js/navbar-login.js')}}"></script>
@endsection
@endsection


