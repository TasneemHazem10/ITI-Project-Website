    @extends('instructor.layouts.app')
    
    @section('instructor')
    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Navigation -->
    

        <!-- Content Area -->
        <div class="content-wrapper">
            <div class="container-fluid">
                <!-- Page Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h2 data-en="Instructor Profile" data-ar="ملف الإدارة">Instructor Profile</h2>
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
                                @php($img = Auth::guard('web_instructor')->user()->img_name)
                                @php($imgUrl = $img ? (strpos($img, '/') !== false ? asset('storage/'.$img) : asset('storage/images/'.$img)) : 'https://bootdey.com/img/Content/avatar/avatar7.png') )
                                <img src="{{ $imgUrl }}" alt="Instructor" class="rounded-circle mb-3" width="150" height="150">
                                <h4>{{ Auth::guard('web_instructor')->user()->fname }} {{ Auth::guard('web_instructor')->user()->lname }}</h4>
                                <p class="text-muted mb-3" data-en="System Administrator" data-ar="مدير النظام">System
                                    Administrator</p>

                                
                                <hr>

                                <div class="text-start">
                                    <h6 data-en="Contact Information" data-ar="معلومات الاتصال">Contact Information</h6>
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <i class="fas fa-envelope text-danger me-2"></i>
                                            {{ Auth::guard('web_instructor')->user()->email }}
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-phone text-danger me-2"></i>
                                            {{ Auth::guard('web_instructor')->user()->phone }}
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                            <span data-en="" data-ar="">&nbsp;</span>
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-calendar text-danger me-2"></i>
                                            <span data-en="Joined: Jan 2020" data-ar="انضم: يناير 2020">Joined: Jan
                                                2020</span>
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
                                  
                                    
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="profileTabContent">
                                    <!-- Personal Information -->
                                    <div class="tab-pane fade show active" id="personal" role="tabpanel">
                                        <form>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="firstName" class="form-label" data-en="First Name"
                                                            data-ar="الاسم الأول">First Name</label>
                                                        <input type="text" class="form-control" id="firstName"
                                                            value="{{ Auth::guard('web_instructor')->user()->fname }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="lastName" class="form-label" data-en="Last Name"
                                                            data-ar="اسم العائلة">Last Name</label>
                                                        <input type="text" class="form-control" id="lastName"
                                                            value="{{ Auth::guard('web_instructor')->user()->lname }}" disabled>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label" data-en="Email Address"
                                                            data-ar="البريد الإلكتروني">Email Address</label>
                                                        <input type="email" class="form-control" id="email"
                                                            value="{{ Auth::guard('web_instructor')->user()->email }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="phone" class="form-label" data-en="Phone Number"
                                                            data-ar="رقم الهاتف">Phone Number</label>
                                                        <input type="tel" class="form-control" id="phone"
                                                            value="{{ Auth::guard('web_instructor')->user()->phone }}" disabled>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="position" class="form-label" data-en="Position"
                                                            data-ar="المنصب">Position</label>
                                                        <input type="text" class="form-control" id="position"
                                                            value="{{ Auth::guard('web_instructor')->user()->job_tittle }}" disabled>
                                                    </div>
                                                </div>
                                            </div>



                                           
                                        </form>
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
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('instructor/assets/js/admin-layout.js')}}"></script>
    <script src="{{asset('instructor/assets/js/sitebar-appear.js')}}"></script>
    @endsection
    @endsection
