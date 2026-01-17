@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Welcome Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="welcome-card">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h2 class="welcome-title" data-en="Welcome to Admin Dashboard"
                                    data-ar="مرحباً بك في لوحة الإدارة">Welcome to Admin Dashboard</h2>
                                <p class="welcome-text"
                                    data-en="Comprehensive management of all institute aspects including courses, instructors, and students"
                                    data-ar="إدارة شاملة لجميع جوانب المعهد من الكورسات والمدربين والطلاب">Comprehensive
                                    management of all institute aspects including courses, instructors, and students</p>
                            </div>
                            <div class="col-md-4 text-end">
                                <i class="fas fa-tachometer-alt welcome-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="stat-card stat-card-primary">
                        <div class="stat-card-body">
                            <div class="stat-card-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div class="stat-card-content">
                                <h3 class="stat-number">{{ $totalCourses }}</h3>
                                <p class="stat-label" data-en="Total Courses" data-ar="إجمالي الكورسات">Total Courses</p>
                            </div>
                        </div>
                        <div class="stat-card-footer">
                            <a href="{{ route('admin.show.course') }}" class="stat-link">
                                <span data-en="View Details" data-ar="عرض التفاصيل">View Details</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="stat-card stat-card-success">
                        <div class="stat-card-body">
                            <div class="stat-card-icon">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                            <div class="stat-card-content">
                                <h3 class="stat-number">{{ $totalInstructors }}</h3>
                                <p class="stat-label" data-en="Instructors" data-ar="المدربين">Instructors</p>
                            </div>
                        </div>
                        <div class="stat-card-footer">
                            <a href="{{ route('admin.show.instructor') }}" class="stat-link">
                                <span data-en="View Details" data-ar="عرض التفاصيل">View Details</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="stat-card stat-card-warning">
                        <div class="stat-card-body">
                            <div class="stat-card-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-card-content">
                                <h3 class="stat-number">{{ $totalStudents }}</h3>
                                <p class="stat-label" data-en="Registered Students" data-ar="الطلاب المسجلين">Registered
                                    Students</p>
                            </div>
                        </div>
                        <div class="stat-card-footer">
                            <a href="{{ route('admin.show.student') }}" class="stat-link">
                                <span data-en="View Details" data-ar="عرض التفاصيل">View Details</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="stat-card stat-card-info">
                        <div class="stat-card-body">
                            <div class="stat-card-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="stat-card-content">
                                <h3 class="stat-number">{{ $verificationRequests }}</h3>
                                <p class="stat-label" data-en="Verification Requests" data-ar="طلبات التحقق">Verification
                                    Requests</p>
                            </div>
                        </div>
                        <div class="stat-card-footer">
                            <a href="{{ route('admin.verfi.student') }}" class="stat-link">
                                <span data-en="View Details" data-ar="عرض التفاصيل">View Details</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
          
        </div>
    </div>
@endsection

@section('script')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/admin-layout.js"></script>
    <script src="assets/js/sitebar-appear.js"></script>

    </body>

    </html>

@endsection
