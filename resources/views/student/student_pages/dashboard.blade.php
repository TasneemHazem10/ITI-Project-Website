@extends('student.layouts.app')

@section('student')

<div class="main-content" id="mainContent">
        <!-- Top Navigation -->
    
        <!-- Dashboard Content -->
        <div class="content-wrapper">
            <div class="container-fluid">
                <!-- Welcome Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="instructor-card">
                            <div class="instructor-card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h2 class="mb-3">Welcome back, <span id="welcomeName"></span>!</h2>
                                        <p class="text-muted mb-0">Track your progress, submit assignments, and stay updated with your course activities.</p>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <i class="fas fa-user-graduate" style="font-size: 4rem; color: var(--instructor-primary); opacity: 0.3;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="row mb-4">

                    <div class="col-xl-5 col-md-6 mb-4">
                        <div class="stat-card">
                            <div class="stat-icon success">
                                <i class="fas fa-tasks"></i>
                            </div>
                            <h3 class="stat-number">8</h3>
                            <p class="stat-label">Assignments</p>
                        </div>
                    </div>

                    <div class="col-xl-5 col-md-6 mb-4">
                        <div class="stat-card">
                            <div class="stat-icon warning">
                                <i class="fas fa-user-check"></i>
                            </div>
                            <h3 class="stat-number">94%</h3>
                            <p class="stat-label">Attendance</p>
                        </div>
                    </div>

                </div>

                <!-- Recent Activity & Upcoming Events -->
                <div class="row">
                    <div class="col-lg-12 mb-4">
                        <div class="instructor-card">
                            <div class="instructor-card-header">
                                <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Upcoming Events</h5>
                            </div>
                            <div class="instructor-card-body">
                                <div class="event-list">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3 text-center">
                                            <div class="badge badge-instructor">15</div>
                                            <small class="text-muted d-block">Dec</small>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Web Development Class</h6>
                                            <small class="text-muted">10:00 AM - 12:00 PM</small>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3 text-center">
                                            <div class="badge badge-instructor">20</div>
                                            <small class="text-muted d-block">Dec</small>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Assignment Deadline</h6>
                                            <small class="text-muted">JavaScript Project</small>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3 text-center">
                                            <div class="badge badge-instructor">25</div>
                                            <small class="text-muted d-block">Dec</small>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Final Exam</h6>
                                            <small class="text-muted">9:00 AM - 11:00 AM</small>
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
    <script src="{{asset('student/assets/js/student-dashboard.js')}}"></script>
    <script src="{{asset('student/assets/js/sitebar-appear.js')}}"></script>

    @endsection
    @endsection