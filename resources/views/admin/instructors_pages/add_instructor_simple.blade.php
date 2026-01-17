@extends('admin.layouts.app')

@section('title')
    <h6 class="mb-0 text-truncate" data-en="Add Instructor" data-ar="إضافة مدرب">
        Add Instructor
    </h6>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-user-plus me-2"></i>
                                <span data-en="New Instructor Information" data-ar="بيانات المدرب الجديد">New Instructor Information</span>
                            </h5>
                        </div>
                        <div class="card-body">
                            @if(session('msg'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle me-2"></i>
                                    {{ session('msg') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            @if($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <strong>Please fix the following errors:</strong>
                                    <ul class="mb-0 mt-2">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form id="addInstructorForm" method="post" action="{{route('admin.store.instructor')}}" enctype="multipart/form-data">
                            @csrf
                                <div class="row">
                                    <div class="col-lg-8">
                                        <h6 class="section-title" data-en="Basic Information" data-ar="المعلومات الأساسية">
                                            Basic Information</h6>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="instructorFirstName" class="form-label" data-en="First Name *"
                                                    data-ar="الاسم الأول *">First Name *</label>
                                                <input type="text" class="form-control" id="instructorFirstName" name="fname" value="{{ old('fname') }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="instructorLastName" class="form-label" data-en="Last Name *"
                                                    data-ar="الاسم الأخير *">Last Name *</label>
                                                <input type="text" class="form-control" id="instructorLastName" name="lname" value="{{ old('lname') }}" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="instructorEmail" class="form-label" data-en="Email Address *"
                                                    data-ar="البريد الإلكتروني *">Email Address *</label>
                                                <input type="email" class="form-control" id="instructorEmail" name="email" value="{{ old('email') }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="instructorPhone" class="form-label" data-en="Phone Number *"
                                                    data-ar="رقم الهاتف *">Phone Number *</label>
                                                <input type="tel" class="form-control" id="instructorPhone" name="phone" value="{{ old('phone') }}" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="instructorId" class="form-label" data-en="ID Number *"
                                                    data-ar="رقم الهوية *">ID Number *</label>
                                                <input maxlength="14" type="text" class="form-control" id="instructorId" name="national_id" value="{{ old('national_id') }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="instructorPassword" class="form-label" data-en="Password *"
                                                    data-ar="كلمة المرور *">Password *</label>
                                                <input type="password" class="form-control" id="instructorPassword" name="password" required>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="instructorTitle" class="form-label" data-en="Job Title *"
                                                data-ar="المسمى الوظيفي *">Job Title *</label>
                                            <input type="text" class="form-control" id="instructorTitle" name="job_tittle" value="{{ old('job_tittle') }}" required>
                                        </div>
                                    </div>

                                    <!-- Image Upload -->
                                    <div class="col-lg-4">
                                        <h6 class="section-title" data-en="Instructor Photo" data-ar="صورة المدرب">
                                            Instructor Photo</h6>

                                        <div class="instructor-image-upload mb-4">
                                            <div class="image-upload-area" id="instructorImageUploadArea">
                                                <i class="fas fa-user-circle fa-4x text-muted mb-3"></i>
                                                <p class="text-muted" data-en="Drag image here or click to upload"
                                                    data-ar="اسحب الصورة هنا أو اضغط للرفع">Drag image here or click to upload</p>
                                                <input type="file" id="instructorImage" accept="image/*"
                                                    class="d-none" name="img_name">
                                            </div>
                                            <div class="image-preview d-none" id="instructorImagePreview">
                                                <img id="instructorPreviewImg" class="img-fluid rounded-circle"
                                                    alt="Instructor Preview">
                                                <button type="button" class="btn btn-sm btn-outline-danger mt-2"
                                                    id="removeInstructorImage">
                                                    <i class="fas fa-trash me-1"></i><span data-en="Remove Image"
                                                        data-ar="حذف الصورة">Remove Image</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-end gap-2">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    onclick="resetForm()">
                                                    <i class="fas fa-undo me-1"></i>
                                                    <span data-en="Reset" data-ar="إعادة تعيين">Reset</span>
                                                </button>
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-user-plus me-1"></i>
                                                    <span data-en="Add Instructor" data-ar="إضافة المدرب">Add Instructor</span>
                                                </button>
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
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('admin/assets/js/admin-layout.js') }}"></script>
    <script src="{{ asset('admin/assets/js/add-instructor.js') }}"></script>
    <script src="{{ asset('admin/assets/js/sitebar-appear.js') }}"></script>
@endsection
