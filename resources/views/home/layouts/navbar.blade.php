
<!-- Top Contact Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-12 text-end">
                    <a href="tel:7002" class="contact-info">
                        <i class="fas fa-phone"></i> 7002
                    </a>
                    <a href="mailto:ITinfo@iti.gov.eg" class="contact-info">
                        <i class="fas fa-envelope"></i> ITinfo@iti.gov.eg
                    </a>
                    
                    @auth('web_student')
                        <span class="contact-info">
                            <i class="fas fa-user-circle me-1"></i>
                            Welcome, {{ Auth::guard('web_student')->user()->full_name }}
                        </span>
                    @else
                        <a href="{{ route('home.userLog') }}" class="contact-info">
                            <i class="fas fa-sign-in-alt me-1"></i>Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="navbar navbar-expand-lg main-navbar">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="iti-logo" href="index.html">
                <img src="{{asset('home/assets/images/iti_logo.svg')}}" alt="ITI Logo" class="logo-img">
            </a>

            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation Menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.courses') }}">Courses</a>
                    </li>
                    
                    @auth('web_student')
                        <li class="nav-item">
                            <div class="dropdown me-2">
                                <button class="btn btn-sm dropdown-toggle nav-link" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user"></i>
                                    <span class="d-none d-sm-inline">{{ Auth::guard('web_student')->user()->full_name }}</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" style="border: none;">
                                    <li><a class="dropdown-item" href="{{ route('home.profile') }}">
                                        <i class="fas fa-user me-2"></i>Profile
                                    </a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('home.logout') }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home.userLog') }}">Login</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
