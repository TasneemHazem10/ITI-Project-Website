@extends('student.layouts.app')
@section('student')

        <!-- Top Navigation -->
<div class="main-content" id="mainContent">

        <!-- Content Area -->
        <div class="content-wrapper">
            <div class="container-fluid">
                <!-- Page Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="instructor-card">
                            <div class="instructor-card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h2 class="mb-3">Web Development Course</h2>
                                        <p class="text-muted mb-0">Learn modern web development technologies and build responsive websites.</p>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-outline-danger" onclick="downloadSyllabus()">
                                                <i class="fas fa-download me-1"></i>Download Syllabus
                                            </button>
                                            <button class="btn btn-danger" onclick="contactInstructor()">
                                                <i class="fas fa-envelope me-1"></i>Contact Instructor
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course Information -->
                <div class="row mb-4">
                    <div class="col-lg-8 mb-4">
                        <div class="instructor-card">
                            <div class="instructor-card-header">
                                <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Course Information</h5>
                            </div>
                            <div class="instructor-card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Course Details</h6>
                                        <ul class="list-unstyled">
                                            <li><strong>Instructor:</strong> Dr. Ahmed Mohamed</li>
                                            <li><strong>Duration:</strong> 3 Months</li>
                                            <li><strong>Schedule:</strong> Mon, Wed, Fri</li>
                                            <li><strong>Time:</strong> 10:00 AM - 12:00 PM</li>
                                            <li><strong>Room:</strong> Lab 201</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Course Progress</h6>
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between">
                                                <span>Overall Progress</span>
                                                <span>75%</span>
                                            </div>
                                            <div class="progress-instructor mt-1">
                                                <div class="progress-bar-instructor" style="width: 75%"></div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between">
                                                <span>Assignments Completed</span>
                                                <span>6/8</span>
                                            </div>
                                            <div class="progress-instructor mt-1">
                                                <div class="progress-bar-instructor" style="width: 75%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-4">
                        <div class="instructor-card">
                            <div class="instructor-card-header">
                                <h5 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Course Statistics</h5>
                            </div>
                            <div class="instructor-card-body">
                                <div class="row text-center">
                                    <div class="col-6 mb-3">
                                        <h4 class="text-primary mb-1">94%</h4>
                                        <small class="text-muted">Attendance</small>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h4 class="text-success mb-1">A+</h4>
                                        <small class="text-muted">Average Grade</small>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h4 class="text-warning mb-1">6</h4>
                                        <small class="text-muted">Assignments</small>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h4 class="text-info mb-1">3</h4>
                                        <small class="text-muted">Projects</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course Modules -->
                <div class="row">
                    <div class="col-12">
                        <div class="instructor-card">
                            <div class="instructor-card-header">
                                <h5 class="mb-0"><i class="fas fa-list me-2"></i>Course Modules</h5>
                            </div>
                            <div class="instructor-card-body">
                                <div class="accordion" id="courseModules">
                                    <!-- Module 1 -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="module1">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">
                                                <i class="fas fa-check-circle text-success me-2"></i>
                                                Module 1: HTML Fundamentals
                                            </button>
                                        </h2>
                                        <div id="collapse1" class="accordion-collapse collapse show" data-bs-parent="#courseModules">
                                            <div class="accordion-body">
                                                <p>Learn the basics of HTML structure, tags, and semantic elements.</p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <small class="text-muted">Completed</small>
                                                    <span class="badge badge-success">100%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Module 2 -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="module2">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">
                                                <i class="fas fa-check-circle text-success me-2"></i>
                                                Module 2: CSS Styling
                                            </button>
                                        </h2>
                                        <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#courseModules">
                                            <div class="accordion-body">
                                                <p>Master CSS properties, selectors, and responsive design techniques.</p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <small class="text-muted">Completed</small>
                                                    <span class="badge badge-success">100%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Module 3 -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="module3">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">
                                                <i class="fas fa-clock text-warning me-2"></i>
                                                Module 3: JavaScript Basics
                                            </button>
                                        </h2>
                                        <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#courseModules">
                                            <div class="accordion-body">
                                                <p>Introduction to JavaScript programming and DOM manipulation.</p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <small class="text-muted">In Progress</small>
                                                    <span class="badge badge-warning">60%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Module 4 -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="module4">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4">
                                                <i class="fas fa-lock text-muted me-2"></i>
                                                Module 4: Advanced JavaScript
                                            </button>
                                        </h2>
                                        <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#courseModules">
                                            <div class="accordion-body">
                                                <p>Advanced JavaScript concepts, frameworks, and modern development practices.</p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <small class="text-muted">Not Started</small>
                                                    <span class="badge badge-secondary">0%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('script')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('student/assets/js/admin-layout.js')}}"></script>
    <script src="{{asset('student/assets/js/student-course.js')}}"></script>
    @endsection
    @endsection