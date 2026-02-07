<div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <img src="{{asset('student/assets/images/iti_logo.svg')}}" alt="ITI Logo" class="sidebar-logo" id="sidebarLogo">
            <h5 class="sidebar-title">Student Panel</h5>
        </div>
        
        <nav class="sidebar-nav">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }} " href="{{route('student.dashboard')}}">
                        <i class="fas fa-tachometer-alt me-2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <!-- My Course -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('student.courses') ? 'active' : '' }}" href="{{route('student.courses')}}">
                        <i class="fas fa-graduation-cap me-2"></i>
                        <span>My Course</span>
                    </a>
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