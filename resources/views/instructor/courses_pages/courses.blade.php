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
                    <h4 class="mb-0">My Courses</h4>
                </div>
                <div class="d-flex align-items-center">
                    <!-- User Menu -->
                    <div class="dropdown me-3">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                            data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i>
                            <span id="instructorName">Instructor</span>
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
                <!-- Page Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="instructor-card">
                            <div class="instructor-card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h2 class="mb-3">My Courses</h2>
                                        <p class="text-muted mb-0">Manage your courses, track student progress, and
                                            create engaging learning experiences.</p>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-outline-instructor" onclick="filterCourses('all')">
                                                <i class="fas fa-list me-1"></i>All Courses
                                            </button>
                                            <button class="btn btn-outline-instructor" onclick="filterCourses('active')">
                                                <i class="fas fa-play me-1"></i>Active
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Courses Grid -->
                <div class="row" id="coursesGrid">
                    <!-- Course 1: Web Development -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="course-card">
                            <div class="course-card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Web Development</h5>
                                    <span class="badge badge-success">Active</span>
                                </div>
                            </div>
                            <div class="course-card-body">
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-users text-primary me-2"></i>
                                            <span>32 Students</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-calendar text-primary me-2"></i>
                                            <span>Mon, Wed, Fri</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <small class="text-muted">Course Progress</small>
                                    <div class="progress-instructor mt-1">
                                        <div class="progress-bar-instructor" style="width: 75%"></div>
                                    </div>
                                    <small class="text-muted">75% Complete</small>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="text-center">
                                            <h6 class="text-success mb-1">94%</h6>
                                            <small class="text-muted">Attendance</small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-center">
                                            <h6 class="text-warning mb-1">8</h6>
                                            <small class="text-muted">Assignments</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex gap-2">
                                    <button class="btn btn-danger flex-fill" onclick="viewCourseDetails(1)">
                                        <i class="fas fa-eye me-1"></i>View Details
                                    </button>
                                    <button class="btn btn-outline-danger" onclick="markAttendance(1)">
                                        <i class="fas fa-user-check"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Course 2: Data Science -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="course-card">
                            <div class="course-card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Data Science</h5>
                                    <span class="badge badge-success">Active</span>
                                </div>
                            </div>
                            <div class="course-card-body">
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-users text-primary me-2"></i>
                                            <span>28 Students</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-calendar text-primary me-2"></i>
                                            <span>Tue, Thu</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <small class="text-muted">Course Progress</small>
                                    <div class="progress-instructor mt-1">
                                        <div class="progress-bar-instructor" style="width: 60%"></div>
                                    </div>
                                    <small class="text-muted">60% Complete</small>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="text-center">
                                            <h6 class="text-success mb-1">89%</h6>
                                            <small class="text-muted">Attendance</small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-center">
                                            <h6 class="text-warning mb-1">5</h6>
                                            <small class="text-muted">Assignments</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex gap-2">
                                    <button class="btn btn-danger flex-fill" onclick="viewCourseDetails(2)">
                                        <i class="fas fa-eye me-1"></i>View Details
                                    </button>
                                    <button class="btn btn-outline-danger" onclick="markAttendance(2)">
                                        <i class="fas fa-user-check"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Course 3: Mobile Development -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="course-card">
                            <div class="course-card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Mobile Development</h5>
                                    <span class="badge badge-warning">Starting Soon</span>
                                </div>
                            </div>
                            <div class="course-card-body">
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-users text-primary me-2"></i>
                                            <span>24 Students</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-calendar text-primary me-2"></i>
                                            <span>Mon, Wed</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <small class="text-muted">Course Progress</small>
                                    <div class="progress-instructor mt-1">
                                        <div class="progress-bar-instructor" style="width: 15%"></div>
                                    </div>
                                    <small class="text-muted">15% Complete</small>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="text-center">
                                            <h6 class="text-info mb-1">0%</h6>
                                            <small class="text-muted">Attendance</small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-center">
                                            <h6 class="text-info mb-1">0</h6>
                                            <small class="text-muted">Assignments</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex gap-2">
                                    <button class="btn btn-danger flex-fill" onclick="viewCourseDetails(3)">
                                        <i class="fas fa-eye me-1"></i>View Details
                                    </button>
                                    <button class="btn btn-outline-danger" onclick="markAttendance(3)">
                                        <i class="fas fa-user-check"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Course 4: Cybersecurity -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="course-card">
                            <div class="course-card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Cybersecurity</h5>
                                    <span class="badge badge-success">Active</span>
                                </div>
                            </div>
                            <div class="course-card-body">
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-users text-primary me-2"></i>
                                            <span>35 Students</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-calendar text-primary me-2"></i>
                                            <span>Tue, Thu, Sat</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <small class="text-muted">Course Progress</small>
                                    <div class="progress-instructor mt-1">
                                        <div class="progress-bar-instructor" style="width: 90%"></div>
                                    </div>
                                    <small class="text-muted">90% Complete</small>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="text-center">
                                            <h6 class="text-success mb-1">96%</h6>
                                            <small class="text-muted">Attendance</small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-center">
                                            <h6 class="text-warning mb-1">12</h6>
                                            <small class="text-muted">Assignments</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex gap-2">
                                    <button class="btn btn-danger flex-fill" onclick="viewCourseDetails(4)">
                                        <i class="fas fa-eye me-1"></i>View Details
                                    </button>
                                    <button class="btn btn-outline-danger" onclick="markAttendance(4)">
                                        <i class="fas fa-user-check"></i>
                                    </button>
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
    <script src="{{ asset('instructor/assets/js/instructor-courses.js') }}"></script>
    @endsection
    @endsection
