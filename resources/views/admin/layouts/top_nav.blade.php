    <div class="main-content" id="mainContent">
        <!-- Top Navigation -->
        <nav class="top-navbar px-2 py-2">
        <div class="d-flex justify-content-between align-items-center flex-wrap w-100">
            <!-- Start -->
            <div class="d-flex align-items-center flex-shrink-1">
            <button class="btn btn-outline-secondary btn-sm me-2" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
           @yield('title')
            </div>

            <!-- Right side -->
            <div class="d-flex align-items-center flex-shrink-1">
            <!-- Language Toggle -->
            <div class="dropdown me-2">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-language"></i>
                <span id="currentLang" class="d-none d-sm-inline">EN</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#" onclick="changeLanguage('en')">English</a></li>
                <li><a class="dropdown-item" href="#" onclick="changeLanguage('ar')">العربية</a></li>
                </ul>
            </div>

            <!-- Notifications -->
        

            <!-- User Menu -->
            <div class="dropdown me-2">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user"></i>
                <span class="d-none d-sm-inline">Admin</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('admin.admin_profile') }}">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="{{route('admin.logout')}}" method="POST" style="display: inline; width: 100%;">
                        @csrf
                        <button type="submit" class="dropdown-item w-100 text-start" style="border: none; background: none; padding: 0.25rem 1rem;">Logout</button>
                    </form>
                </li>
                </ul>
            </div>
            </div>
        </div>
        </nav>
