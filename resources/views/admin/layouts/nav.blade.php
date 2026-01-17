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

            <!-- Notifications -->
          

            <!-- User Menu -->
            <div class="dropdown me-2">
                <button class="btn btn-danger btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user"></i>
                <span class="d-none d-sm-inline">Admin</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{route('admin.admin_profile')}}">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="{{route('admin.logout')}}" method="POST" style="display: inline; width: 100%;">
                        @csrf
                        <button type="submit" class="dropdown-item w-100 text-start" style="border: none; background: none; padding: 0.25rem 1rem;">Logout</button>
                    </form>
                </li>
                </ul>
            </div>

        <!-- عنصر فاضي عشان يوازن الـ flex -->
        <div class="order-1" style="width:36px;"></div>
    </nav>

    <!-- Sidebar (existing) ... (leave your sidebar markup as-is) -->

    <!-- backdrop for mobile sidebar -->
    <div id="sidebarBackdrop" class="sidebar-backdrop d-none"></div>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <img src="{{asset('admin/assets/images/iti_logo.svg')}}" alt="ITI Logo" class="sidebar-logo" id="sidebarLogo">
            <h5 class="sidebar-title" data-en="Admin Panel" data-ar="لوحة الإدارة" id="sidebarTitle">Admin Panel</h5>
        </div>
        
        <nav class="sidebar-nav">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt me-2"></i>
                        <span data-en="Dashboard" data-ar="الرئيسية">Dashboard</span>
                    </a>
                </li>
                
                <!-- Courses Section -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" aria-expanded="false">
                        <i class="fas fa-graduation-cap me-2"></i>
                        <span data-en="Courses Management" data-ar="إدارة الكورسات">Courses Management</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('admin.show.course') }}" data-en="View Courses" data-ar="عرض الكورسات">View Courses</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.add.course') }}" data-en="Add New Course" data-ar="إضافة كورس جديد">Add New Course</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.edit.course') }}" data-en="Edit Courses" data-ar="تعديل الكورسات">Edit Courses</a></li>
                    </ul>
                </li>
                
                <!-- Instructors Section -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" aria-expanded="false">
                        <i class="fas fa-chalkboard-teacher me-2"></i>
                        <span data-en="Instructors Management" data-ar="إدارة المدربين">Instructors Management</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('admin.show.instructor') }}" data-en="View Instructors" data-ar="عرض المدربين">View Instructors</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.add.instructor') }}" data-en="Add New Instructor" data-ar="إضافة مدرب جديد">Add New Instructor</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.edit.instructors') }}" data-en="Edit Instructors" data-ar="تعديل المدربين">Edit Instructors</a></li>
                    </ul>
                </li>
                
                <!-- Students Section -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" aria-expanded="false">
                        <i class="fas fa-users me-2"></i>
                        <span data-en="Students Management" data-ar="إدارة الطلاب">Students Management</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('admin.show.student') }}" data-en="View Students" data-ar="عرض الطلاب">View Students</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.verfi.student') }}" data-en="Verification Requests" data-ar="طلبات التحقق">Verification Requests</a></li>
                    </ul>
                </li>

                <!-- Admins Section -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" aria-expanded="false">
                        <i class="fas fa-user-shield me-2"></i>
                        <span data-en="Admins Management" data-ar="إدارة المسؤولين">Admins Management</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('admin.show.admin') }}" data-en="View Admins" data-ar="عرض المسؤولين">View Admins</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.add.admin') }}" data-en="Add New Admin" data-ar="إضافة مسؤول جديد">Add New Admin</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.edit.admin', Auth::guard('web_admin')->id()) }}" data-en="Edit Admins" data-ar="تعديل المسؤولين">Edit Admins</a></li>
                    </ul>
                </li>
                
            </ul>
        </nav>
        
        <div class="sidebar-footer">
            <a href="{{route('home')}}" class="btn btn-outline-light btn-sm">
                <i class="fas fa-home me-1"></i>
                <span data-en="Main Site" data-ar="الموقع الرئيسي">Main Site</span>
            </a>
        </div>
    </div>