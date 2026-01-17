@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Success/Error Messages -->
            @if (session('msg'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('msg') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Page Header -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 data-en="All Courses" data-ar="جميع الكورسات">All Courses</h2>
                        <a href="{{ route('admin.add.course') }}" class="btn btn-danger">
                            <i class="fas fa-plus me-2"></i>
                            <span data-en="Add New Course" data-ar="إضافة كورس جديد">Add New Course</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Courses Grid -->
            <div class="row">
                @forelse($courses as $course)
                    <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                        <div class="card course-card h-100">
                            <div class="position-relative">
                                @if($course->image)
                                    <img src="{{ asset('storage/' . $course->image) }}" class="card-img-top course-image" alt="{{ $course->course_name }}">
                                @else
                                    <div class="course-image bg-light d-flex align-items-center justify-content-center">
                                        <i class="fas fa-graduation-cap fa-3x text-muted"></i>
                                    </div>
                                @endif
                                
                                <!-- Course Status -->
                                <span class="course-status status-{{ $course->status }}">
                                    {{ ucfirst($course->status) }}
                                </span>
                                
                                @if($course->featured)
                                    <span class="position-absolute top-0 start-0 m-2 featured-badge">
                                        <i class="fas fa-star"></i> Featured
                                    </span>
                                @endif
                            </div>
                            
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $course->course_name }}</h5>
                                <p class="card-text text-muted small flex-grow-1">{{ Str::limit($course->course_description, 100) }}</p>
                                
                                <div class="course-meta mb-3">
                                    <div class="row text-center">
                                        <div class="col-4">
                                            <i class="fas fa-clock"></i>
                                            <small>{{ $course->duration }}</small>
                                        </div>
                                        <div class="col-4">
                                            <i class="fas fa-users"></i>
                                            <small>{{ $course->max_students }}</small>
                                        </div>
                                        <div class="col-4">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <small>{{ Str::limit($course->location, 10) }}</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="course-price">{{ number_format($course->price) }} EGP</span>
                                    
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.edit.course') }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                    onclick="return confirm('Are you sure you want to delete this course?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                
                                <!-- Modules Count -->
                                @if($course->modules->count() > 0)
                                    <div class="mt-2">
                                        <small class="text-muted">
                                            <i class="fas fa-book"></i>
                                            {{ $course->modules->count() }} Module(s)
                                        </small>
                                    </div>
                                @endif
                                
                                <!-- Course Details -->
                                <div class="mt-2">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar"></i>
                                        Start: {{ $course->start_date->format('M d, Y') }}
                                    </small>
                                    @if($course->certificate)
                                        <br><small class="text-success">
                                            <i class="fas fa-certificate"></i>
                                            Certificate Provided
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="fas fa-graduation-cap fa-5x text-muted mb-3"></i>
                            <h4 class="text-muted">No Courses Found</h4>
                            <p class="text-muted">Start by adding your first course</p>
                            <a href="{{ route('admin.add.course') }}" class="btn btn-danger">
                                <i class="fas fa-plus me-2"></i>Add New Course
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@section('script')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('admin/assets/js/admin-layout.js') }}"></script>
    <script src="{{ asset('admin/assets/js/sitebar-appear.js') }}"></script>
    </body>
    </html>
@endsection