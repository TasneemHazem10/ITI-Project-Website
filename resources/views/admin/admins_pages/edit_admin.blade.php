@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-user-edit me-2"></i>
                                <span data-en="Edit Admin Information" data-ar="تعديل بيانات المسؤول">Edit Admin
                                    Information</span>
                            </h5>
                        </div>
                        <div >
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </div>
                            @endif

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
                        </div>
                        <div class="card-body">
                            <form id="editAdminForm" action="{{ route('admin.put_admin', $admin->id) }}" method="post"
                                enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="row">
                                    <!-- Basic Information -->
                                    <div class="col-lg-8">
                                        <h6 class="section-title" data-en="Basic Information" data-ar="المعلومات الأساسية">
                                            Basic Information</h6>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="adminFirstName" class="form-label" data-en="First Name *"
                                                    data-ar="الاسم الأول *">First Name *</label>
                                                <input value="{{ $admin->fname }}" type="text" class="form-control"
                                                    id="adminFirstName" name="fname" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="adminLastName" class="form-label" data-en="Last Name *"
                                                    data-ar="الاسم الأخير *">Last Name *</label>
                                                <input value="{{ $admin->lname }}" type="text" class="form-control"
                                                    id="adminLastName" name="lname" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="adminEmail" class="form-label" data-en="Email Address *"
                                                    data-ar="البريد الإلكتروني *">Email Address *</label>
                                                <input value="{{ $admin->email }}" type="email" class="form-control"
                                                    id="adminEmail" name="email" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="adminPhone" class="form-label" data-en="Phone Number"
                                                    data-ar="رقم الهاتف">Phone Number</label>
                                                <input value="{{ $admin->phone }}" type="tel" class="form-control"
                                                    id="adminPhone" name="phone">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="adminIdNumber" class="form-label" data-en="ID Number *"
                                                    data-ar="رقم الهوية *">ID Number *</label>
                                                <input maxlength="14" value="{{ old('id', $admin->id) }}" type="text"
                                                    class="form-control" name="id" id="adminIdNumber" required readonly>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-lg-4">
                                        <h6 class="section-title" data-en="Admin Photo" data-ar="صورة المدرب">
                                            Admin Photo</h6>

                                        <div class="instructor-image-upload mb-4">
                                            <div class="image-upload-area" id="instructorImageUploadArea">
                                                <i class="fas fa-user-circle fa-4x text-muted mb-3"></i>
                                                <p class="text-muted" data-en="Drag image here or click to upload"
                                                    data-ar="اسحب الصورة هنا أو اضغط للرفع">Drag image here or click to
                                                    upload</p>
                                                <img src="{{ asset('storage/' . $admin->img_admin) }}"
                                                    alt="Current Image" width="120" class="mb-2">

                                                <input type="file" id="instructorImage" accept="image/*"
                                                    class="d-none" name="img_admin">

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
                                        <!-- Admin Settings -->

                                    </div>

                                    <!-- Admin Settings -->

                                </div>

                                <!-- Form Actions -->
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-end gap-2">
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-save me-1"></i>
                                                <span data-en="Update Admin" data-ar="تحديث المسؤول">Update Admin</span>
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
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('admin/assets/js/admin-layout.js') }}"></script>
    <script src="{{ asset('admin/assets/js/edit-admin.js') }}"></script>
    <script src="{{ asset('admin/assets/js/sitebar-appear.js') }}"></script>
    <script src="{{ asset('admin/assets/js/add-instructor.js') }}"></script>
    </body>

    </html>
@endsection
