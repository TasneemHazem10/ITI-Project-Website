@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
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

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-plus-circle me-2"></i>
                                <span data-en="Add New Course" data-ar="إضافة كورس جديد">Add New Course</span>
                            </h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.store.course') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <!-- Basic Information -->
                                    <div class="col-lg-8">
                                        <h6 class="section-title" data-en="Basic Information" data-ar="المعلومات الأساسية">
                                            Basic Information</h6>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="course_name" class="form-label" data-en="Course Name *" data-ar="اسم الكورس *">Course Name *</label>
                                                <input type="text" class="form-control" id="course_name" name="course_name" 
                                                       value="{{ old('course_name') }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="duration" class="form-label" data-en="Duration *" data-ar="المدة *">Duration *</label>
                                                <input type="text" class="form-control" id="duration" name="duration" 
                                                       placeholder="e.g., 3 months" value="{{ old('duration') }}" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <label for="course_description" class="form-label" data-en="Course Description *" data-ar="وصف الكورس *">Course Description *</label>
                                                <textarea class="form-control" id="course_description" name="course_description" 
                                                          rows="4" required>{{ old('course_description') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="skills" class="form-label" data-en="Skills Covered *" data-ar="المهارات المكتسبة *">Skills Covered *</label>
                                                <input type="text" class="form-control" id="skills" name="skills" 
                                                       placeholder="HTML, CSS, JavaScript, PHP" value="{{ old('skills') }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="max_students" class="form-label" data-en="Max Students *" data-ar="الحد الأقصى للطلاب *">Max Students *</label>
                                                <input type="number" class="form-control" id="max_students" name="max_students" 
                                                       min="1" max="50" value="{{ old('max_students', 20) }}" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="start_date" class="form-label" data-en="Start Date *" data-ar="تاريخ البداية *">Start Date *</label>
                                                <input type="date" class="form-control" id="start_date" name="start_date" 
                                                       value="{{ old('start_date') }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="location" class="form-label" data-en="Location *" data-ar="المكان *">Location *</label>
                                                <input type="text" class="form-control" id="location" name="location" 
                                                       placeholder="Smart Village, Cairo" value="{{ old('location') }}" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="price" class="form-label" data-en="Price (EGP) *" data-ar="السعر (جنيه) *">Price (EGP) *</label>
                                                <input type="number" class="form-control" id="price" name="price" 
                                                       min="0" step="0.01" value="{{ old('price', 0) }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check mt-4">
                                                    <input type="hidden" name="certificate" value="0">
                                                    <input class="form-check-input" type="checkbox" id="certificate" name="certificate" value="1"
                                                           {{ old('certificate') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="certificate" data-en="Provides Certificate" data-ar="يوفر شهادة">
                                                        Provides Certificate
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="hidden" name="featured" value="0">
                                                    <input class="form-check-input" type="checkbox" id="featured" name="featured" value="1"
                                                           {{ old('featured') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="featured" data-en="Featured Course" data-ar="كورس مميز">
                                                        Featured Course
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Course Image -->
                                    <div class="col-lg-4">
                                        <h6 class="section-title" data-en="Course Image" data-ar="صورة الكورس">Course Image</h6>
                                        
                                        <div class="course-image-upload mb-4">
                                            <div class="image-upload-area" id="courseImageUploadArea">
                                                <i class="fas fa-image fa-4x text-muted mb-3"></i>
                                                <p class="text-muted" data-en="Drag image here or click to upload" data-ar="اسحب الصورة هنا أو اضغط للرفع">
                                                    Drag image here or click to upload
                                                </p>
                                                <input type="file" id="courseImage" accept="image/*" class="d-none" name="image">
                                            </div>
                                            <div class="image-preview d-none" id="courseImagePreview">
                                                <img id="coursePreviewImg" class="img-fluid rounded" alt="Course Preview">
                                                <button type="button" class="btn btn-sm btn-outline-danger mt-2" id="removeCourseImage">
                                                    <i class="fas fa-trash me-1"></i><span data-en="Remove Image" data-ar="حذف الصورة">Remove Image</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Form Actions -->
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('admin.show.course') }}" class="btn btn-outline-secondary">
                                                <i class="fas fa-times me-1"></i>
                                                <span data-en="Cancel" data-ar="إلغاء">Cancel</span>
                                            </a>
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-save me-1"></i>
                                                <span data-en="Save Course" data-ar="حفظ الكورس">Save Course</span>
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
    <script src="{{ asset('admin/assets/js/sitebar-appear.js') }}"></script>
    
    <script>
        // Image upload handling
        document.getElementById('courseImageUploadArea').addEventListener('click', function() {
            document.getElementById('courseImage').click();
        });

        document.getElementById('courseImage').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('coursePreviewImg').src = e.target.result;
                    document.getElementById('courseImageUploadArea').classList.add('d-none');
                    document.getElementById('courseImagePreview').classList.remove('d-none');
                };
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('removeCourseImage').addEventListener('click', function() {
            document.getElementById('courseImage').value = '';
            document.getElementById('courseImageUploadArea').classList.remove('d-none');
            document.getElementById('courseImagePreview').classList.add('d-none');
        });
    </script>
    </body>
    </html>
@endsection