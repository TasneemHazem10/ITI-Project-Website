@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Back to Instructors Button -->
            <div class="row mb-4">
                <div class="col-12">
                    <a href="{{ route('admin.show.instructor') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>
                        <span data-en="Back to Instructors" data-ar="العودة للمدربين">Back to Instructors</span>
                    </a>
                </div>
            </div>

            <!-- Success/Error Messages -->
            @if (session('msg'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('msg') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

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

            <!-- Instructor Selection -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0" data-en="Select Instructor to Edit" data-ar="اختر المدرب للتعديل">
                                Select Instructor to Edit</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="instructorSelect" class="form-label" data-en="Choose Instructor"
                                        data-ar="اختر المدرب">Choose Instructor</label>
                                    <select class="form-select" id="instructorSelect">
                                        <option value="" data-en="Select an instructor..." data-ar="اختر مدرب...">
                                            Select an instructor...</option>
                                        @foreach ($instructors as $instructor)
                                            <option value="{{ $instructor->national_id }}">{{ $instructor->fname }} {{ $instructor->lname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" data-en="Quick Actions" data-ar="إجراءات سريعة">Quick
                                        Actions</label>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-danger" onclick="loadInstructorData()"
                                            data-en="Load Instructor" data-ar="تحميل المدرب">Load Instructor</button>
                                        <button class="btn btn-outline-danger" onclick="deleteInstructor()"
                                            data-en="Delete Instructor" data-ar="حذف المدرب">Delete Instructor</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Instructor Edit Form -->
            <div class="row" id="instructorEditForm" style="display: none;">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0" data-en="Edit Instructor Information"
                                data-ar="تعديل معلومات المدرب">Edit Instructor Information</h5>
                        </div>
                        <div class="card-body">
                            <form id="editInstructorForm" action="{{ route('admin.instructor.update', ':id') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <!-- Personal Information -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <h6 class="text-primary mb-3" data-en="Personal Information"
                                            data-ar="المعلومات الشخصية">Personal Information</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="editFirstName" class="form-label" data-en="First Name"
                                            data-ar="الاسم الأول">First Name</label>
                                        <input type="text" class="form-control" id="editFirstName" name="fname"
                                            placeholder="Enter first name" data-en="Enter first name"
                                            data-ar="أدخل الاسم الأول" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="editLastName" class="form-label" data-en="Last Name"
                                            data-ar="الاسم الأخير">Last Name</label>
                                        <input type="text" class="form-control" id="editLastName" name="lname"
                                            placeholder="Enter last name" data-en="Enter last name"
                                            data-ar="أدخل الاسم الأخير" required>
                                    </div>
                                </div>

                                <!-- Contact Information -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="editEmail" class="form-label" data-en="Email Address"
                                            data-ar="البريد الإلكتروني">Email Address</label>
                                        <input type="email" class="form-control" id="editEmail" name="email"
                                            placeholder="instructor@iti.gov.eg" data-en="Enter email address"
                                            data-ar="أدخل البريد الإلكتروني" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="editPhone" class="form-label" data-en="Phone Number"
                                            data-ar="رقم الهاتف">Phone Number</label>
                                        <input type="tel" class="form-control" id="editPhone" name="phone"
                                            placeholder="+20 123 456 7890" data-en="Enter phone number"
                                            data-ar="أدخل رقم الهاتف" required>
                                    </div>
                                </div>

                                <!-- ID and Job Title -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="editNationalId" class="form-label" data-en="National ID"
                                            data-ar="الرقم القومي">National ID</label>
                                        <input type="text" class="form-control" id="editNationalId" name="national_id"
                                            placeholder="12345678901234" maxlength="14" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="editJobTitle" class="form-label" data-en="Job Title"
                                            data-ar="المسمى الوظيفي">Job Title</label>
                                        <input type="text" class="form-control" id="editJobTitle" name="job_tittle"
                                            placeholder="Senior Developer" required>
                                    </div>
                                </div>

                                <!-- Professional Information -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="editPassword" class="form-label" data-en="Password (Optional)"
                                            data-ar="كلمة المرور (اختيارية)">Password (Optional)</label>
                                        <input type="password" class="form-control" id="editPassword" name="password"
                                            placeholder="Leave blank to keep current password" minlength="6">
                                    </div>
                                
                                </div>


                                <!-- Profile Photo -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <label class="form-label" data-en="Profile Photo"
                                            data-ar="الصورة الشخصية">Profile Photo</label>
                                        <div class="d-flex align-items-center">
                                            <img id="editInstructorPhotoPreview" src="{{ asset('admin/assets/images/iti_logo.svg') }}"
                                                alt="Instructor Photo" class="img-thumbnail me-3"
                                                style="width: 100px; height: 100px; object-fit: cover;">
                                            <div>
                                                <input type="file" class="form-control" id="editInstructorPhoto" name="img_name"
                                                    accept="image/*"
                                                    onchange="previewImage(this, 'editInstructorPhotoPreview')">
                                                <small class="text-muted" data-en="Upload a new profile photo"
                                                    data-ar="ارفع صورة شخصية جديدة">Upload a new profile photo</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Form Actions -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex gap-2">
                                            <button type="submit" class="btn btn-danger" data-en="Update Instructor"
                                                data-ar="تحديث المدرب">Update Instructor</button>
                                            <a href="{{ route('admin.show.instructor') }}" class="btn btn-outline-secondary">Cancel</a>
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
@endsection

@section('script')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('admin/assets/js/admin-layout.js') }}"></script>
    <script src="{{ asset('admin/assets/js/edit-instructor.js') }}"></script>
    <script src="{{ asset('admin/assets/js/sitebar-appear.js') }}"></script>
    </body>

    </html>
@endsection
