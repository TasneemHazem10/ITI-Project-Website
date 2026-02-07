@extends('home.layouts.app')

@section('content')



    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center min-vh-75">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <h1 class="hero-title">
                            Welcome to <span class="text-danger">ITI</span>
                        </h1>
                        <h2 class="hero-subtitle">Information Technology Institute</h2>
                        <p class="hero-description">
                            For more than 30 years, ITI has been updating its training portfolio to monitor global technology trends and sustain an 85% graduate employment rate.
                        </p>
                        <div class="hero-buttons">
                            @auth('web_student')
                        
                                @if(Auth::guard('web_student')->user()->isVerified())
                                    <a href="{{ route('student.dashboard') }}" class="btn btn-danger btn-lg me-3">
                                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                                    </a>
                                    <a href="{{ route('student.courses') }}" class="btn btn-outline-danger btn-lg">
                                        <i class="fas fa-graduation-cap me-2"></i>My Courses
                                    </a>
                                @elseif(Auth::guard('web_student')->user()->isUnderReview())
                                    <a href="{{ route('home.wait') }}" class="btn btn-danger btn-lg me-3">
                                        <i class="fas fa-clock me-2"></i>Check Status
                                    </a>
                                    <a href="{{ route('home.profile') }}" class="btn btn-outline-danger btn-lg">
                                        <i class="fas fa-user me-2"></i>Profile
                                    </a>
                                @else
                                    <a href="{{ route('home.upload') }}" class="btn btn-danger btn-lg me-3">
                                        <i class="fas fa-upload me-2"></i>Upload Photo
                                    </a>
                                    <a href="{{ route('home.profile') }}" class="btn btn-outline-danger btn-lg">
                                        <i class="fas fa-user me-2"></i>Profile
                                    </a>
                                @endif
                            @else
                                
                                <a href="{{ route('home.courses') }}" class="btn btn-danger btn-lg me-3">
                                    <i class="fas fa-graduation-cap me-2"></i>Explore Courses
                                </a>
                                <a href="{{ route('home.userReg') }}" class="btn btn-outline-danger btn-lg">
                                    <i class="fas fa-user-plus me-2"></i>Register Now
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image">
                        <img src="{{ asset('home/assets/images/iti_logo.svg') }}" alt="ITI Logo" class="img-fluid">

                        {{-- <img src="{{asset('home/assets/image.svgs/iti_logo')}}" alt="ITI Logo" class="img-fluid"> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Courses Section -->
    <section id="courses" class="courses-section py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold text-danger mb-3">
                    <i class="fas fa-graduation-cap me-2"></i>
                    Featured Courses
                </h2>
                <p class="lead text-muted">Discover our most popular courses</p>
            </div>

            <div class="row g-4">
            

             

            </div>

            @if(isset($featuredCourses) && $featuredCourses->count())
            <div class="row g-4 mt-4">
                @foreach($featuredCourses as $course)
                <div class="col-lg-4 col-md-6">
                    <div class="card course-card h-100 shadow-lg">
                        <div class="course-image-container">
                            <img src="{{ $course->image ? asset('storage/'.$course->image) : asset('home/assets/images/iti_logo.svg') }}" class="card-img-top course-image" alt="{{ $course->course_name }}">
                            <div class="course-overlay">
                                <div class="course-badge">Featured</div>
                                <div class="course-duration">
                                    <i class="fas fa-clock me-1"></i>{{ $course->duration }}
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h4 class="card-title text-danger mb-0">{{ $course->course_name }}</h4>
                            </div>
                            <p class="card-text text-muted mb-4">{{ \Illuminate\Support\Str::limit($course->course_description, 140) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="course-price">
                                    <span class="h4 text-danger mb-0">Free</span>
                                    <small class="text-muted d-block">For ITI Students</small>
                                </div>
                                <a href="{{ route('home.show', $course->id) }}" class="btn btn-danger btn-lg px-4">
                                    <i class="fas fa-eye me-2"></i>View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            <!-- View All Courses Button -->
            <div class="text-center mt-5">
  
                        <a href="{{ route('home.courses') }}" class="btn btn-outline-danger btn-lg">
                            <i class="fas fa-list me-2"></i>View All Courses
                        </a>
              
              
            </div>
        </div>


        @section('script')



          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('home/assets/js/main.js')}}"></script>
    <script src="{{asset('home/assets/js/footer.js')}}"></script>
    <script src="{{asset('home/assets/js/login-toggle.js')}}"></script>
    <script src="{{asset('home/assets/js/navbar-login.js')}}"></script>
        @endsection
    </section>





























@endsection