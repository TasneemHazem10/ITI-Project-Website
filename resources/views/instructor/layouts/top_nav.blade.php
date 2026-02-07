    <nav class="mobile-topbar d-md-none d-flex align-items-center justify-content-between px-3 py-2">
    
        <!-- زرار القائمة على اليمين -->
        <button id="mobileSidebarToggle" class="btn btn-danger order-3 ms-2" aria-label="Toggle menu">
            <i class="fas fa-bars"></i>
        </button>

        <!-- العنوان في النص -->
        <div class="dropdown me-2">
                <button class="btn btn-danger btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-language"></i>
                <span id="currentLang" class="d-none d-sm-inline">EN</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#" onclick="changeLanguage('en')">English</a></li>
                <li><a class="dropdown-item" href="#" onclick="changeLanguage('ar')">العربية</a></li>
                </ul>
            </div>

       

            <!-- User Menu -->
            <div class="dropdown me-2">
                <button class="btn btn-danger btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user"></i>
                <span class="d-none d-sm-inline">Instructor</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                @if(Auth::guard('web_instructor')->check())
                    <li><a class="dropdown-item" href="{{route('instructor.profile')}}">Profile</a></li>
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

        <!-- عنصر فاضي عشان يوازن الـ flex -->
        <div class="order-1" style="width:36px;"></div>
    </nav>

    <!-- Sidebar (existing) ... (leave your sidebar markup as-is) -->

    <!-- backdrop for mobile sidebar -->
    <div id="sidebarBackdrop" class="sidebar-backdrop d-none"></div>