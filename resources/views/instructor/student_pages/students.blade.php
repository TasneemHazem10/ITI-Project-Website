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
                    <h4 class="mb-0">Students Management</h4>
                </div>
                <div class="d-flex align-items-center">
                    <!-- Course Selector -->
                    <div class="dropdown me-3">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-graduation-cap me-1"></i>
                            <span id="selectedCourse">All Courses</span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" onclick="selectCourse('all', 'All Courses')">All
                                    Courses</a></li>
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
                <!-- Page Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="instructor-card">
                            <div class="instructor-card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h2 class="mb-3">Students Management</h2>
                                        <p class="text-muted mb-0">View and manage all students enrolled in your courses.
                                        </p>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-outline-danger" onclick="exportStudents()">
                                                <i class="fas fa-download me-1"></i>Export List
                                            </button>
                                            <button class="btn btn-danger" onclick="sendMessage()">
                                                <i class="fas fa-envelope me-1"></i>Send Message
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Search and Filter -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="instructor-card">
                            <div class="instructor-card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                                            <input type="text" class="form-control" placeholder="Search students..."
                                                id="searchInput" onkeyup="filterStudents()">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-select" id="statusFilter" onchange="filterStudents()">
                                            <option value="all">All Status</option>
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                            <option value="graduated">Graduated</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-select" id="yearFilter" onchange="filterStudents()">
                                            <option value="all">All Years</option>
                                            <option value="2024">2024</option>
                                            <option value="2023">2023</option>
                                            <option value="2022">2022</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-outline-danger w-100" onclick="clearFilters()">
                                            <i class="fas fa-times me-1"></i>Clear
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Students Table -->
                <div class="row">
                    <div class="col-12">
                        <div class="instructor-card">
                            <div class="instructor-card-header">
                                <h5 class="mb-0"><i class="fas fa-users me-2"></i>Students List</h5>
                            </div>
                            <div class="instructor-card-body">
                                <div class="table-responsive">
                                    <table class="instructor-table table">
                                        <thead>
                                            <tr>
                                                <th>Student ID</th>
                                                <th>Student Name</th>
                                                <th>Email</th>
                                                <th>Course</th>
                                                <th>Attendance</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="studentsTableBody">
                                            <!-- Student 1 -->
                                            <tr data-course="1" data-status="active" data-year="2024">
                                                <td>2024001</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="student-avatar me-3">SA</div>
                                                        <div>
                                                            <h6 class="mb-0">Sarah Ahmed</h6>
                                                            <small class="text-muted">Web Development</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>sarah.ahmed@student.iti.gov.eg</td>
                                                <td><span class="badge badge-instructor">Web Dev</span></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="progress-instructor me-2" style="width: 60px;">
                                                            <div class="progress-bar-instructor" style="width: 94%"></div>
                                                        </div>
                                                        <small>94%</small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <button class="btn btn-sm btn-outline-primary"
                                                            onclick="viewStudentProfile(2024001)">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-success"
                                                            onclick="sendMessageToStudent(2024001)">
                                                            <i class="fas fa-envelope"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-warning"
                                                            onclick="viewGrades(2024001)">
                                                            <i class="fas fa-star"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Student 2 -->
                                            <tr data-course="1" data-status="active" data-year="2024">
                                                <td>2024002</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="student-avatar me-3">MA</div>
                                                        <div>
                                                            <h6 class="mb-0">Mohamed Ali</h6>
                                                            <small class="text-muted">Web Development</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>mohamed.ali@student.iti.gov.eg</td>
                                                <td><span class="badge badge-instructor">Web Dev</span></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="progress-instructor me-2" style="width: 60px;">
                                                            <div class="progress-bar-instructor" style="width: 89%"></div>
                                                        </div>
                                                        <small>89%</small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <button class="btn btn-sm btn-outline-primary"
                                                            onclick="viewStudentProfile(2024002)">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-success"
                                                            onclick="sendMessageToStudent(2024002)">
                                                            <i class="fas fa-envelope"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-warning"
                                                            onclick="viewGrades(2024002)">
                                                            <i class="fas fa-star"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Student 3 -->
                                            <tr data-course="2" data-status="active" data-year="2024">
                                                <td>2024003</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="student-avatar me-3">AA</div>
                                                        <div>
                                                            <h6 class="mb-0">Ahmed Abdelrahman</h6>
                                                            <small class="text-muted">Data Science</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>ahmed.abdelrahman@student.iti.gov.eg</td>
                                                <td><span class="badge badge-instructor">Data Science</span></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="progress-instructor me-2" style="width: 60px;">
                                                            <div class="progress-bar-instructor" style="width: 92%"></div>
                                                        </div>
                                                        <small>92%</small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <button class="btn btn-sm btn-outline-primary"
                                                            onclick="viewStudentProfile(2024003)">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-success"
                                                            onclick="sendMessageToStudent(2024003)">
                                                            <i class="fas fa-envelope"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-warning"
                                                            onclick="viewGrades(2024003)">
                                                            <i class="fas fa-star"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Student 4 -->
                                            <tr data-course="1" data-status="active" data-year="2024">
                                                <td>2024004</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="student-avatar me-3">FH</div>
                                                        <div>
                                                            <h6 class="mb-0">Fatma Hassan</h6>
                                                            <small class="text-muted">Web Development</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>fatma.hassan@student.iti.gov.eg</td>
                                                <td><span class="badge badge-instructor">Web Dev</span></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="progress-instructor me-2" style="width: 60px;">
                                                            <div class="progress-bar-instructor" style="width: 96%"></div>
                                                        </div>
                                                        <small>96%</small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <button class="btn btn-sm btn-outline-primary"
                                                            onclick="viewStudentProfile(2024004)">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-success"
                                                            onclick="sendMessageToStudent(2024004)">
                                                            <i class="fas fa-envelope"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-warning"
                                                            onclick="viewGrades(2024004)">
                                                            <i class="fas fa-star"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Student 5 -->
                                            <tr data-course="4" data-status="active" data-year="2024">
                                                <td>2024005</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="student-avatar me-3">OM</div>
                                                        <div>
                                                            <h6 class="mb-0">Omar Mohamed</h6>
                                                            <small class="text-muted">Cybersecurity</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>omar.mohamed@student.iti.gov.eg</td>
                                                <td><span class="badge badge-instructor">Cybersecurity</span></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="progress-instructor me-2" style="width: 60px;">
                                                            <div class="progress-bar-instructor" style="width: 88%"></div>
                                                        </div>
                                                        <small>88%</small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <button class="btn btn-sm btn-outline-primary"
                                                            onclick="viewStudentProfile(2024005)">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-success"
                                                            onclick="sendMessageToStudent(2024005)">
                                                            <i class="fas fa-envelope"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-warning"
                                                            onclick="viewGrades(2024005)">
                                                            <i class="fas fa-star"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Students Summary -->
                                <div class="row mt-4">
                                    <div class="col-md-3 align-self-center">
                                        <div class="text-center">
                                            <h4 class="text-primary mb-1" id="totalStudents">5</h4>
                                            <small class="text-muted">Total Students</small>
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
    <script src="{{ asset('instructor/assets/js/instructor-students.js') }}"></script>
@endsection
@endsection
