@extends('instructor.layouts.app')

@section('instructor')

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Navigation -->
        <nav class="top-navbar">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <button class="btn btn-outline-secondary me-3" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h4 class="mb-0">Course Details</h4>
                </div>
                <div class="d-flex align-items-center">
                    <!-- Course Selector -->
                    <div class="dropdown me-3">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-graduation-cap me-1"></i>
                            <span id="selectedCourse">Web Development</span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" onclick="selectCourse(1, 'Web Development')">Web
                                    Development</a></li>
                            <li><a class="dropdown-item" href="#" onclick="selectCourse(2, 'Data Science')">Data
                                    Science</a></li>
                            <li><a class="dropdown-item" href="#"
                                    onclick="selectCourse(3, 'Mobile Development')">Mobile Development</a></li>
                            <li><a class="dropdown-item" href="#"
                                    onclick="selectCourse(4, 'Cybersecurity')">Cybersecurity</a></li>
                        </ul>
                    </div>

                    <!-- User Menu -->
                    <div class="dropdown me-3">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i>
                            <span id="instructorName">Dr. Ahmed Mohamed</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#" onclick="logout()">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Content Area -->
        <div class="content-wrapper">
            <div class="container-fluid">
                <!-- Course Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="instructor-card">
                            <div class="instructor-card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h2 class="mb-3" id="courseTitle">Web Development</h2>
                                        <p class="text-muted mb-0" id="courseDescription">Comprehensive web development
                                            course covering HTML, CSS, JavaScript, and modern frameworks.</p>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-danger" onclick="markAttendance()">
                                                <i class="fas fa-user-check me-1"></i>Mark Attendance
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course Statistics -->
                <div class="row mb-4">
                    <div class="row mb-4">
                        <div class="col-6 mb-4">
                            <div class="stat-card">
                                <div class="stat-icon primary">
                                    <i class="fas fa-graduation-cap btn-primary"></i>
                                </div>
                                <h3 class="stat-number">4</h3>
                                <p class="stat-label">Total Students</p>
                            </div>
                        </div>

                        <div class="col-6 mb-4">
                            <div class="stat-card">
                                <div class="stat-icon success">
                                    <i class="fas fa-users btn-primary"></i>
                                </div>
                                <h3 class="stat-number">127</h3>
                                <p class="stat-label">Courses Progress</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course Information Tabs -->
                <div class="row">
                    <div class="col-12">
                        <div class="instructor-card">
                            <div class="instructor-card-header">
                                <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Course Information</h5>
                            </div>
                            <div class="instructor-card-body">
                                <ul class="nav nav-tabs" id="courseTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="overview-tab" data-bs-toggle="tab"
                                            data-bs-target="#overview" type="button" role="tab">
                                            <i class="fas fa-eye me-1"></i><span style="color: #8b0000;">Overview</span>
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="schedule-tab" data-bs-toggle="tab"
                                            data-bs-target="#schedule" type="button" role="tab">
                                            <i class="fas fa-calendar-alt me-1"></i><span
                                                style="color: #8b0000;">Schedule</span>
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="students-tab" data-bs-toggle="tab"
                                            data-bs-target="#students" type="button" role="tab">
                                            <i class="fas fa-users me-1"></i><span style="color: #8b0000;">Students</span>
                                        </button>
                                    </li>
                                </ul>

                                <div class="tab-content mt-4" id="courseTabContent">
                                    <!-- Overview Tab -->
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Course Description</h6>
                                                <p class="text-muted">This comprehensive web development course covers
                                                    modern web technologies including HTML5, CSS3, JavaScript ES6+, React,
                                                    Node.js, and database management. Students will learn to build
                                                    responsive, interactive web applications.</p>

                                                <h6 class="mt-4">Learning Objectives</h6>
                                                <ul class="text-muted">
                                                    <li>Master HTML5 semantic elements</li>
                                                    <li>Create responsive layouts with CSS3</li>
                                                    <li>Build interactive web applications with JavaScript</li>
                                                    <li>Develop single-page applications with React</li>
                                                    <li>Implement backend services with Node.js</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Course Details</h6>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <strong>Duration:</strong><br>
                                                        <span class="text-muted">12 weeks</span>
                                                    </div>
                                                    <div class="col-6">
                                                        <strong>Credits:</strong><br>
                                                        <span class="text-muted">3 credits</span>
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <div class="col-6">
                                                        <strong>Schedule:</strong><br>
                                                        <span class="text-muted">Mon, Wed, Fri</span>
                                                    </div>
                                                    <div class="col-6">
                                                        <strong>Time:</strong><br>
                                                        <span class="text-muted">9:00 AM - 12:00 PM</span>
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <div class="col-6">
                                                        <strong>Room:</strong><br>
                                                        <span class="text-muted">Lab 201</span>
                                                    </div>
                                                    <div class="col-6">
                                                        <strong>Instructor:</strong><br>
                                                        <span class="text-muted">Dr. Ahmed Mohamed</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Schedule Tab -->
                                    <div class="tab-pane fade" id="schedule" role="tabpanel">
                                        <div class="table-responsive">
                                            <table class="instructor-table table">
                                                <thead>
                                                    <tr>
                                                        <th>Week</th>
                                                        <th>Topic</th>
                                                        <th>Date</th>
                                                        <th>Type</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>HTML5 Fundamentals</td>
                                                        <td>Dec 2, 2024</td>
                                                        <td><span class="badge badge-instructor">Lecture</span></td>
                                                        <td><span class="badge badge-success">Completed</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>CSS3 Styling</td>
                                                        <td>Dec 9, 2024</td>
                                                        <td><span class="badge badge-instructor">Lecture</span></td>
                                                        <td><span class="badge badge-success">Completed</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>JavaScript Basics</td>
                                                        <td>Dec 16, 2024</td>
                                                        <td><span class="badge badge-instructor">Lecture</span></td>
                                                        <td><span class="badge badge-warning">Current</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>React Introduction</td>
                                                        <td>Dec 23, 2024</td>
                                                        <td><span class="badge badge-instructor">Lab</span></td>
                                                        <td><span class="badge badge-secondary">Upcoming</span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Students Tab -->
                                    <div class="tab-pane fade" id="students" role="tabpanel">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6>Enrolled Students</h6>
                                            <button class="btn btn-outline-danger btn-sm" onclick="viewAllStudents()">
                                                <i class="fas fa-eye me-1"></i>View All Students
                                            </button>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <div class="student-item">
                                                    <div class="d-flex align-items-center">
                                                        <div class="student-avatar me-3">SA</div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="mb-1">Sarah Ahmed</h6>
                                                            <small
                                                                class="text-muted">sarah.ahmed@student.iti.gov.eg</small>
                                                        </div>
                                                        <div class="text-end">
                                                            <div class="badge badge-success">Active</div>
                                                            <div class="small text-muted">94% Attendance</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="student-item">
                                                    <div class="d-flex align-items-center">
                                                        <div class="student-avatar me-3">MA</div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="mb-1">Mohamed Ali</h6>
                                                            <small
                                                                class="text-muted">mohamed.ali@student.iti.gov.eg</small>
                                                        </div>
                                                        <div class="text-end">
                                                            <div class="badge badge-success">Active</div>
                                                            <div class="small text-muted">89% Attendance</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Assignments Tab -->
                                    <div class="tab-pane fade" id="assignments" role="tabpanel">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6>Course Assignments</h6>
                                            <button class="btn btn-danger btn-sm" onclick="createAssignment()">
                                                <i class="fas fa-plus me-1"></i>Create Assignment
                                            </button>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <div class="assignment-card">
                                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                                        <h6 class="mb-1">Web Development Project</h6>
                                                        <span class="assignment-status submitted">Active</span>
                                                    </div>
                                                    <p class="text-muted small mb-2">Create a responsive website using
                                                        HTML, CSS, and JavaScript</p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <small class="text-muted">Due: Dec 20, 2024</small>
                                                        <small class="text-success">28/32 Submitted</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="assignment-card">
                                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                                        <h6 class="mb-1">JavaScript Quiz</h6>
                                                        <span class="assignment-status pending">Pending</span>
                                                    </div>
                                                    <p class="text-muted small mb-2">Quiz on JavaScript fundamentals and
                                                        ES6 features</p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <small class="text-muted">Due: Dec 25, 2024</small>
                                                        <small class="text-warning">15/32 Submitted</small>
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
    </div>
@section('script')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('instructor/assets/js/admin-layout.js') }}"></script>
    <script src="{{ asset('instructor/assets/js/instructor-course-details.js') }}"></script>
@endsection
@endsection
