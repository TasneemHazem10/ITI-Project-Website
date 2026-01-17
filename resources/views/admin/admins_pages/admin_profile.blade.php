@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="row mb-4">
                <div class="col-12">
                    <h2 data-en="Admin Profile" data-ar="ملف الإدارة">Admin Profile</h2>
                    <p class="text-muted" data-en="Manage your personal information and account settings"
                        data-ar="إدارة معلوماتك الشخصية وإعدادات الحساب">Manage your personal information and
                        account settings</p>
                </div>
            </div>

            <div class="row">
                <!-- Profile Picture and Basic Info -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="{{ $admin->img_admin ? asset('storage/' . $admin->img_admin) : 'https://bootdey.com/img/Content/avatar/avatar7.png' }}" alt="Admin"
                                class="rounded-circle mb-3" width="150" height="150">
                            <h4>{{ $admin->fname }} {{ $admin->lname }}</h4>
                            <p class="text-muted mb-3" data-en="System Administrator" data-ar="مدير النظام">System
                                Administrator</p>



                            <hr>

                            <div class="text-start">
                                <h6 data-en="Contact Information" data-ar="معلومات الاتصال">Contact Information</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <i class="fas fa-envelope text-danger me-2"></i>
                                        {{ $admin->email }}
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-phone text-danger me-2"></i>
                                        {{ $admin->phone ?? 'غير محدد' }}
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                        <span data-en="Cairo, Egypt" data-ar="القاهرة، مصر">Cairo, Egypt</span>
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-calendar text-danger me-2"></i>
                                        <span data-en="Joined: {{ $admin->joined_at ? $admin->joined_at->format('M Y') : 'N/A' }}" data-ar="انضم: {{ $admin->joined_at ? $admin->joined_at->format('M Y') : 'غير محدد' }}">Joined: {{ $admin->joined_at ? $admin->joined_at->format('M Y') : 'N/A' }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Settings -->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" id="profileTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="personal-tab" data-bs-toggle="tab"
                                        data-bs-target="#personal" type="button" role="tab">
                                        <i class="fas fa-user me-2"></i>
                                        <span data-en="Personal Info" data-ar="المعلومات الشخصية">Personal
                                            Info</span>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="security-tab" data-bs-toggle="tab"
                                        data-bs-target="#security" type="button" role="tab">
                                        <i class="fas fa-lock me-2"></i>
                                        <span data-en="Security" data-ar="الأمان">Security</span>
                                    </button>
                                </li>

                            </ul>
                        </div>
                        <div class="card-body">
                            <!-- Success Message -->
                            @if (session('msg'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle me-2"></i>
                                    {{ session('msg') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <!-- Error Message -->
                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <!-- Validation Errors -->
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <strong>Please fix the following errors:</strong>
                                    <ul class="mb-0 mt-2">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <div class="tab-content" id="profileTabContent">
                                <!-- Personal Information -->
                                <div class="tab-pane fade show active" id="personal" role="tabpanel">
                                    <div class="profile-info">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="firstName" class="form-label" data-en="First Name"
                                                        data-ar="الاسم الأول">First Name</label>
                                                    <input type="text" class="form-control" id="firstName" 
                                                        value="{{ $admin->fname }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="lastName" class="form-label" data-en="Last Name"
                                                        data-ar="اسم العائلة">Last Name</label>
                                                    <input type="text" class="form-control" id="lastName" 
                                                        value="{{ $admin->lname }}" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label" data-en="Email Address"
                                                        data-ar="البريد الإلكتروني">Email Address</label>
                                                    <input type="email" class="form-control" id="email" 
                                                        value="{{ $admin->email }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="phone" class="form-label" data-en="Phone Number"
                                                        data-ar="رقم الهاتف">Phone Number</label>
                                                    <input type="tel" class="form-control" id="phone" 
                                                        value="{{ $admin->phone ?? 'غير محدد' }}" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="adminId" class="form-label" data-en="ID Number"
                                                        data-ar="رقم الهوية">ID Number</label>
                                                    <input type="text" class="form-control" id="adminId" 
                                                        value="{{ $admin->id }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="position" class="form-label" data-en="Position"
                                                        data-ar="المنصب">Position</label>
                                                    <input type="text" class="form-control" id="position" name="position"
                                                        value="System Administrator" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        



                                        <a href="{{ route('admin.edit.admin', $admin->getKey()) }}" class="btn btn-danger">
                                            <i class="fas fa-edit me-2"></i>
                                            <span data-en="Edit Profile" data-ar="تعديل الملف الشخصي">Edit
                                                Profile</span>
                                        </a>
                                    </div>
                                </div>

                                <!-- Security Settings -->
                                <div class="tab-pane fade" id="security" role="tabpanel">
                                    <form action="{{ route('admin.change_password') }}" method="POST">
                                        @csrf
                                        <div class="mb-4">
                                            <h5 data-en="Change Password" data-ar="تغيير كلمة المرور">Change
                                                Password</h5>
                                            <div class="mb-3">
                                                <label for="currentPassword" class="form-label"
                                                    data-en="Current Password" data-ar="كلمة المرور الحالية">Current
                                                    Password</label>
                                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                                       id="currentPassword" name="current_password" required>
                                                @error('current_password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="newPassword" class="form-label" data-en="New Password"
                                                    data-ar="كلمة المرور الجديدة">New Password</label>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                                       id="newPassword" name="password" required minlength="6">
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="confirmPassword" class="form-label"
                                                    data-en="Confirm New Password"
                                                    data-ar="تأكيد كلمة المرور الجديدة">Confirm New Password</label>
                                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                                                       id="confirmPassword" name="password_confirmation" required minlength="6">
                                                @error('password_confirmation')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-key me-2"></i>
                                                <span data-en="Change Password" data-ar="تغيير كلمة المرور">Change
                                                    Password</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <!-- Preferences -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
