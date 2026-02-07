    
    @extends('instructor.layouts.app')
    @section('instructor')
    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Navigation -->
        <nav class="top-navbar px-2 py-2">
        <div class="d-flex justify-content-between align-items-center flex-wrap w-100">
            <!-- Start -->
            <div class="d-flex align-items-center flex-shrink-1">
            <button class="btn btn-outline-secondary btn-sm me-2" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            <h6 class="mb-0 text-truncate" data-en="Courses Management" data-ar="إدارة الكورسات">
                Courses Management
            </h6>
            </div>

            <!-- Right side -->
            <div class="d-flex align-items-center flex-shrink-1">
            <!-- Language Toggle -->
  

   

            <!-- User Menu -->
            <div class="dropdown me-2">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user"></i>
                <span class="d-none d-sm-inline">Instructor</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                @if(Auth::guard('web_instructor')->check())
                    <li><a class="dropdown-item" href="{{ route('instructor.profile') }}">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('home.logout.instructor') }}" method="POST" style="display: inline; width: 100%;">
                            @csrf
                            <button type="submit" class="dropdown-item w-100 text-start" style="border: none; background: none; padding: 0.25rem 1rem;">Logout</button>
                        </form>
                    </li>
                @else
                    <li><a class="dropdown-item" href="{{ route('home.userLog') }}">Login as Instructor</a></li>
                @endif
                </ul>
            </div>
            </div>
        </div>
        </nav>


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
                                            <h2 class="mb-3">Welcome back, <span id="welcomeName">Dr. {{$instructor->fname}} {{$instructor->lname}}</span>!</h2>
                                            <p class="text-muted mb-0">Manage your courses, track student progress, and create engaging learning experiences.</p>
                                        </div>
                                        <div class="col-md-4 text-end">
                                            <i class="fas fa-chalkboard-teacher" style="font-size: 4rem; color: var(--instructor-primary); opacity: 0.3;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <!-- Statistics Cards -->
                  

            </div>
        </div>
    </div>
    @section('script')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('instructor/assets/js/admin-layout.js') }}"></script>
        <script src="{{ asset('instructor/assets/js/instructor-dashboard.js') }}"></script>
        <script src="{{ asset('instructor/assets/js/sitebar-appear.js') }}"></script>
    @endsection
    @endsection

    