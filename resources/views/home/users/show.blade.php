@extends('home.layouts.app')

@section('content')

<div class="container mt-5">
        <!-- Breadcrumb -->
        {{-- <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="profile.html" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="courses.html" class="text-decoration-none">Courses</a></li>
                <li class="breadcrumb-item active" aria-current="page">Course Details</li>
            </ol>
        </nav> --}}

        <div class="row">
            <!-- Course Main Info -->
            <div class="col-lg-8">
                <div class="card shadow-lg mb-4">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">
                            <i class="fas fa-graduation-cap me-2"></i>
                            {{ $course->course_name }}
                        </h2>
                    </div>
                    <div class="card-body">
                        <!-- Course Image -->
                        <div class="text-center mb-4">
                           <img src="{{ $course->image ? asset('storage/images/'.$course->image) : asset('home/assets/images/iti_logo.svg') }}" alt="Course Image" class="img-fluid rounded" style="max-height: 300px;">
                        </div>

                        <!-- Course Description -->
                        <div class="mb-4">
                            <h4 class="text-danger mb-3">
                                <i class="fas fa-info-circle me-2"></i>
                                Course Description
                            </h4>
                            <p class="lead">
                                {{ $course->course_description }}
                            </p>
                        </div>

                        <!-- What You'll Learn -->
                        <div class="mb-4">
                            <h4 class="text-danger mb-3">
                                <i class="fas fa-check-circle me-2"></i>
                                Skills / Topics
                            </h4>
                            <div class="mb-2">
                                @php($skills = array_filter(array_map('trim', explode(',', (string) $course->skills))))
                                @forelse($skills as $skill)
                                    <span class="badge bg-light text-dark me-2 mb-2">{{ $skill }}</span>
                                @empty
                                    <span class="text-muted">No skills listed.</span>
                                @endforelse
                            </div>
                        </div>

                        <!-- Course Curriculum -->
                        <div class="mb-4">
                            <h4 class="text-danger mb-3">
                                <i class="fas fa-list-alt me-2"></i>
                                Course Curriculum
                            </h4>
                            <div class="accordion" id="curriculumAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                            <strong>Module 1: Frontend Fundamentals (4 weeks)</strong>
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#curriculumAccordion">
                                        <div class="accordion-body">
                                            <ul>
                                                <li>HTML5 Semantic Elements</li>
                                                <li>CSS3 Flexbox & Grid</li>
                                                <li>Responsive Web Design</li>
                                                <li>JavaScript Basics</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                            <strong>Module 2: Advanced Frontend (6 weeks)</strong>
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#curriculumAccordion">
                                        <div class="accordion-body">
                                            <ul>
                                                <li>React.js Components</li>
                                                <li>State Management</li>
                                                <li>API Integration</li>
                                                <li>Testing with Jest</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                            <strong>Module 3: Backend Development (8 weeks)</strong>
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#curriculumAccordion">
                                        <div class="accordion-body">
                                            <ul>
                                                <li>Node.js & Express.js</li>
                                                <li>MongoDB & Mongoose</li>
                                                <li>Authentication & Security</li>
                                                <li>RESTful API Design</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Course Sidebar -->
            <div class="col-lg-4">
                <!-- Course Info Card -->
                <div class="card shadow-lg mb-4">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            Course Information
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong><i class="fas fa-clock me-2 text-danger"></i>Duration:</strong>
                            <span class="ms-2">{{ $course->duration }}</span>
                        </div>
                        <div class="mb-3">
                            <strong><i class="fas fa-users me-2 text-danger"></i>Students:</strong>
                            <span class="ms-2">25 students</span>
                        </div>
                        <div class="mb-3">
                            <strong><i class="fas fa-calendar me-2 text-danger"></i>Start Date:</strong>
                            <span class="ms-2">{{ $course->start_date?->format('M d, Y') }}</span>
                        </div>
                        <div class="mb-3">
                            <strong><i class="fas fa-map-marker-alt me-2 text-danger"></i>Location:</strong>
                            <span class="ms-2">{{ $course->location }}</span>
                        </div>
                        <div class="mb-3">
                            <strong><i class="fas fa-certificate me-2 text-danger"></i>Certificate:</strong>
                            <span class="ms-2">{{ $course->certificate ? 'Yes' : 'No' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Instructor Card -->
                <div class="card shadow-lg mb-4">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-user-tie me-2"></i>
                            Instructor
                        </h5>
                    </div>
                    <div class="card-body text-center">
                        <img src="https://bootdey.com/img/Content/user_1.jpg" alt="Instructor" class="rounded-circle mb-3" width="100" height="100">
                        <h5>Naser Khairy</h5>
                        <p class="text-muted">Senior Full Stack Developer</p>
                        <p class="small">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <span class="ms-2">4.9 (127 reviews)</span>
                        </p>
                        <button class="btn btn-outline-danger btn-sm">
                            <i class="fas fa-envelope me-1"></i>
                            Contact Instructor
                        </button>
                    </div>
                </div>

                <!-- Enrollment Card -->
                <div class="card shadow-lg">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-graduation-cap me-2"></i>
                            Enrollment
                        </h5>
                    </div>
                    <div class="card-body text-center">
                        <h3 class="text-danger mb-3">Free</h3>
                        <p class="text-muted mb-4">This course is completely free for ITI students</p>
                        @auth('web_student')
                            @if($hasApproved)
                                <button class="btn btn-secondary btn-lg w-100 mb-3" disabled>
                                    <i class="fas fa-check me-2"></i>
                                    Already Enrolled
                                </button>
                            @else
                                <form action="{{ route('home.enroll') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                    <button class="btn btn-danger btn-lg w-100 mb-3" type="submit">
                                        <i class="fas fa-user-plus me-2"></i>
                                        Enroll Now
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('home.userLog') }}" class="btn btn-danger btn-lg w-100 mb-3">
                                <i class="fas fa-user-plus me-2"></i>
                                Enroll Now
                            </a>
                        @endauth
                        <small class="text-muted">
                            <i class="fas fa-shield-alt me-1"></i>
                            Secure enrollment process
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Courses -->
       
    </div>

    <!-- Enrollment Success Modal -->
    <div class="modal fade" id="enrollmentModal" tabindex="-1" aria-labelledby="enrollmentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content enrollment-modal-content">
                <div class="modal-body text-center p-5">
                    <div class="enrollment-icon mb-4">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3 class="modal-title text-danger mb-3" id="enrollmentModalLabel">
                        تم الانضمام بنجاح!
                    </h3>
                    <p class="text-muted mb-4">
                        تم تسجيلك في الكورس بنجاح. ستتلقى رسالة تأكيد على بريدك الإلكتروني قريباً.
                    </p>
                    <div class="enrollment-details mb-4">
                        <div class="row">
                            <div class="col-6">
                                <div class="detail-item">
                                    <i class="fas fa-calendar-alt text-danger me-2"></i>
                                    <span>يبدأ: 15 مارس</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="detail-item">
                                    <i class="fas fa-clock text-danger me-2"></i>
                                    <span>المدة: 18 أسبوع</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger btn-lg px-5" data-bs-dismiss="modal" onclick="redirectToCourses()">
                        <i class="fas fa-arrow-left me-2"></i>
                        العودة للكورسات
                    </button>
                </div>
            </div>
        </div>
    </div>







     @section('script')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('home/assets/js/footer.js')}}"></script>
    <script src="{{asset('home/assets/js/course-details.js')}}"></script>


 @endsection
 @endsection