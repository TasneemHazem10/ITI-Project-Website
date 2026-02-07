    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <img src="{{asset('instructor/assets/images/iti_logo.svg')}}" alt="ITI Logo" class="sidebar-logo" id="sidebarLogo">
            <h5 class="sidebar-title">Instructor Panel</h5>
        </div>
        
        <nav class="sidebar-nav">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active  " href="{{ route('instructor.dashboard', Auth::guard('web_instructor')->user()->national_id ?? Auth::guard('web_instructor')->id()) }}">
                        <i class="fas fa-tachometer-alt me-2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <!-- My Courses Section -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle  " href="#" role="button" aria-expanded="false">
                        <i class="fas fa-graduation-cap me-2"></i>
                        <span>My Courses</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('instructor.courses')}}">View Courses</a></li>
                        <li><a class="dropdown-item" href="{{route('instructor.courses_details')}}">Course Details</a></li>
                    </ul>
                </li>
                
                <!-- Students Management -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" aria-expanded="false">
                        <i class="fas fa-users me-2"></i>
                        <span>Students</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('instructor.students')}}">View Students</a></li>
                        <li><a class="dropdown-item" href="{{route('instructor.attendance')}}">Attendance</a></li>
                    </ul>
                </li>
                
            </ul>
        </nav>
        
        <div class="sidebar-footer">
            <a href="{{route('home')}}" class="btn btn-outline-light btn-sm">
                <i class="fas fa-home me-1"></i>
                <span>Main Site</span>
            </a>
        </div>
    </div>
