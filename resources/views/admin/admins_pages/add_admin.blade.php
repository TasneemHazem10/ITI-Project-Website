@extends('admin.layouts.app')

@section('title')
    <h6 class="mb-0 text-truncate" data-en="Add Admin" data-ar="إضافة مسؤول">
        Add Admin
    </h6>
@endsection

@section('content')
    <div class="content-wrapper">

        <div class="container-fluid">
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
            @endif

            @if (Session::has('msg'))
                <div class="alert alert-success">
                    <li>{{ Session::get('msg') }}</li>
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-user-plus me-2"></i>
                                <span data-en="New Admin Information" data-ar="بيانات المسؤول الجديد">New Admin
                                    Information</span>
                            </h5>
                        </div>
                        <div class="card-body">
                            <form novalidate id="addAdminForm" action="{{ route('admin.store.admin') }}" method = "post"
                                enctype="multipart/form-data">
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
                                                <input name="fname" type="text" class="form-control"
                                                    id="adminFirstName" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="adminLastName" class="form-label" data-en="Last Name *"
                                                    data-ar="الاسم الأخير *">Last Name *</label>
                                                <input name="lname" type="text" class="form-control" id="adminLastName"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="adminEmail" class="form-label" data-en="Email Address *"
                                                    data-ar="البريد الإلكتروني *">Email Address *</label>
                                                <input name="email" type="email" class="form-control" id="adminEmail"
                                                    required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="adminPhone" class="form-label" data-en="Phone Number"
                                                    data-ar="رقم الهاتف">Phone Number</label>
                                                <input name="phone" type="tel" class="form-control" id="adminPhone">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="adminIdNumber" class="form-label" data-en="ID Number *"
                                                    data-ar="رقم الهوية *">ID Number *</label>
                                                <input maxlength="14" name="id" type="text" class="form-control"
                                                    id="adminIdNumber" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="adminPassword" class="form-label" data-en="Password *"
                                                    data-ar="كلمة المرور *">Password *</label>
                                                <input name="password" type="password" class="form-control"
                                                    id="adminPassword" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="adminJoinedAt" class="form-label" data-en="Joined Date"
                                                    data-ar="تاريخ الانضمام">Joined Date</label>
                                                <input name="joined_at" type="date" class="form-control"
                                                    id="adminJoinedAt">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="adminIsSuper" class="form-label" data-en="Admin Type"
                                                    data-ar="نوع المسؤول">Admin Type</label>
                                                <select class="form-select" id="adminIsSuper" name="is_supper">
                                                    <option value="0" data-en="Regular Admin" data-ar="مسؤول عادي">
                                                        Regular Admin</option>
                                                    <option value="1" data-en="Super Admin" data-ar="مسؤول رئيسي">
                                                        Super
                                                        Admin</option>
                                                </select>
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
                                                    <span data-en="Add Admin" data-ar="إضافة المسؤول">Add Admin</span>
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
    <script src="assets/js/admin-layout.js"></script>
    <script src="assets/js/add-admin.js"></script>
    <script src="assets/js/sitebar-appear.js"></script>
    <script src="assets/js/add-instructor.js"></script>
@endsection
