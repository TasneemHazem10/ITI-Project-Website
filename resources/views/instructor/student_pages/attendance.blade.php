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
                    <h4 class="mb-0">Attendance Management</h4>
                </div>
                <div class="d-flex align-items-center">
                    <!-- Course Selector -->
                    <div class="dropdown me-3">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-graduation-cap me-1"></i>
                            <span id="selectedCourse">Select Course</span>
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
                                        <h2 class="mb-3">Attendance Management</h2>
                                        <p class="text-muted mb-0">Track student attendance, mark present/absent, and
                                            generate attendance reports.</p>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-danger" onclick="markAllPresent()">
                                                <i class="fas fa-check-circle me-1"></i>Mark All Present
                                            </button>
                                            <button class="btn btn-outline-danger" onclick="saveAttendance()">
                                                <i class="fas fa-save me-1"></i>Save Attendance
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Attendance Date Selector -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="instructor-card">
                            <div class="instructor-card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <label for="attendanceDate" class="form-label">Select Date</label>
                                        <input type="date" class="form-control" id="attendanceDate"
                                            onchange="loadAttendanceForDate()">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="sessionType" class="form-label">Session Type</label>
                                        <select class="form-select" id="sessionType" onchange="loadAttendanceForDate()">
                                            <option value="lecture">Lecture</option>
                                            <option value="lab">Lab Session</option>
                                            <option value="tutorial">Tutorial</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Students Attendance List -->
                <div class="row">
                    <div class="col-12">
                        <div class="instructor-card">
                            <div class="instructor-card-header">
                                <h5 class="mb-0"><i class="fas fa-users me-2"></i>Students Attendance</h5>
                            </div>
                            <div class="instructor-card-body">
                                <div class="table-responsive">
                                    <table class="instructor-table table">
                                        <thead>
                                            <tr>
                                                <th>Student ID</th>
                                                <th>Student Name</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Time</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="attendanceTableBody">
                                            <!-- Student 1 -->
                                            <tr>
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
                                                <td class="text-center">
                                                    <select class="form-select form-select-sm attendance-status text-center"
                                                        data-student-id="2024001" style="min-width: 70px;">
                                                        <option value="present" selected>Present</option>
                                                        <option value="absent">Absent</option>
                                                        <option value="late">Late</option>
                                                        <option value="excused">Excused</option>
                                                    </select>
                                                </td>
                                                <td class="text-center">
                                                    <input type="time" class="form-control form-control-sm text-center"
                                                        value="09:00" data-student-id="2024001"
                                                        style="min-width: 100px;">
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-outline-danger"
                                                        onclick="toggleAttendance(2024001)">
                                                        <i class="fas fa-sync-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Student 2 -->
                                            <tr>
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
                                                <td class="text-center">
                                                    <select
                                                        class="form-select form-select-sm attendance-status text-center"
                                                        data-student-id="2024002" style="min-width: 70px;">
                                                        <option value="present">Present</option>
                                                        <option value="absent" selected>Absent</option>
                                                        <option value="late">Late</option>
                                                        <option value="excused">Excused</option>
                                                    </select>
                                                </td>
                                                <td class="text-center">
                                                    <input type="time" class="form-control form-control-sm text-center"
                                                        value="--:--" data-student-id="2024002"
                                                        style="min-width: 100px;">
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-outline-danger"
                                                        onclick="toggleAttendance(2024002)">
                                                        <i class="fas fa-sync-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Student 3 -->
                                            <tr>
                                                <td>2024003</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="student-avatar me-3">AA</div>
                                                        <div>
                                                            <h6 class="mb-0">Ahmed Abdelrahman</h6>
                                                            <small class="text-muted">Web Development</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>ahmed.abdelrahman@student.iti.gov.eg</td>
                                                <td class="text-center">
                                                    <select
                                                        class="form-select form-select-sm attendance-status text-center"
                                                        data-student-id="2024003" style="min-width: 70px;">
                                                        <option value="present">Present</option>
                                                        <option value="absent">Absent</option>
                                                        <option value="late" selected>Late</option>
                                                        <option value="excused">Excused</option>
                                                    </select>
                                                </td>
                                                <td class="text-center">
                                                    <input type="time" class="form-control form-control-sm text-center"
                                                        value="09:15" data-student-id="2024003"
                                                        style="min-width: 100px;">
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-outline-danger"
                                                        onclick="toggleAttendance(2024003)">
                                                        <i class="fas fa-sync-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Student 4 -->
                                            <tr>
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
                                                <td class="text-center">
                                                    <select
                                                        class="form-select form-select-sm attendance-status text-center"
                                                        data-student-id="2024004" style="min-width: 70px;">
                                                        <option value="present" selected>Present</option>
                                                        <option value="absent">Absent</option>
                                                        <option value="late">Late</option>
                                                        <option value="excused">Excused</option>
                                                    </select>
                                                </td>
                                                <td class="text-center">
                                                    <input type="time" class="form-control form-control-sm text-center"
                                                        value="08:55" data-student-id="2024004"
                                                        style="min-width: 100px;">
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-outline-danger"
                                                        onclick="toggleAttendance(2024004)">
                                                        <i class="fas fa-sync-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Student 5 -->
                                            <tr>
                                                <td>2024005</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="student-avatar me-3">OM</div>
                                                        <div>
                                                            <h6 class="mb-0">Omar Mohamed</h6>
                                                            <small class="text-muted">Web Development</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>omar.mohamed@student.iti.gov.eg</td>
                                                <td class="text-center">
                                                    <select
                                                        class="form-select form-select-sm attendance-status text-center"
                                                        data-student-id="2024005" style="min-width: 70px;">
                                                        <option value="present">Present</option>
                                                        <option value="absent">Absent</option>
                                                        <option value="late">Late</option>
                                                        <option value="excused" selected>Excused</option>
                                                    </select>
                                                </td>
                                                <td class="text-center">
                                                    <input type="time" class="form-control form-control-sm text-center"
                                                        value="--:--" data-student-id="2024005"
                                                        style="min-width: 100px;">
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-outline-danger"
                                                        onclick="toggleAttendance(2024005)">
                                                        <i class="fas fa-sync-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Attendance Summary -->
                                <div class="row mt-4">
                                    <div class="col-md-3">
                                        <div class="text-center">
                                            <h4 class="text-success mb-1" id="presentCount">3</h4>
                                            <small class="text-muted">Present</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-center">
                                            <h4 class="text-danger mb-1" id="absentCount">1</h4>
                                            <small class="text-muted">Absent</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-center">
                                            <h4 class="text-warning mb-1" id="lateCount">1</h4>
                                            <small class="text-muted">Late</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-center">
                                            <h4 class="text-info mb-1" id="excusedCount">1</h4>
                                            <small class="text-muted">Excused</small>
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
    <script src="{{ asset('instructor/assets/js/instructor-attendance.js') }}"></script>
@endsection
@endsection
