@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Back to Courses Button -->
            <div class="row mb-4">
                <div class="col-12">
                    <a href="{{ route('admin.show.course') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>
                        <span data-en="Back to Courses" data-ar="العودة للكورسات">Back to Courses</span>
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

            <!-- Course Selection -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0" data-en="Select Course to Edit" data-ar="اختر الكورس للتعديل">
                                Select Course to Edit</h5>
                        </div>
                        <div class="card-body">
            <div class="row">
                                <div class="col-md-6">
                                    <label for="courseSelect" class="form-label" data-en="Choose Course"
                                        data-ar="اختر الكورس">Choose Course</label>
                                    <select class="form-select" id="courseSelect">
                                        <option value="" data-en="Select a course..." data-ar="اختر كورس...">
                                            Select a course...</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" data-en="Quick Actions" data-ar="إجراءات سريعة">Quick
                                        Actions</label>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-danger" onclick="loadCourseData()"
                                            data-en="Load Course" data-ar="تحميل الكورس">Load Course</button>
                                        <button class="btn btn-outline-danger" onclick="deleteCourse()"
                                            data-en="Delete Course" data-ar="حذف الكورس">Delete Course</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Course Edit Form -->
            <div class="row" id="courseEditForm" style="display: none;">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0" data-en="Edit Course Information"
                                data-ar="تعديل معلومات الكورس">Edit Course Information</h5>
                        </div>
                        <div class="card-body">
                            <form id="editCourseFormSubmit" action="{{ route('admin.course.update', ':id') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <!-- Basic Information -->
                                    <div class="col-lg-8">
                                        <h6 class="section-title" data-en="Basic Information" data-ar="المعلومات الأساسية">
                                            Basic Information</h6>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="editCourseName" class="form-label" data-en="Course Name *" data-ar="اسم الكورس *">Course Name *</label>
                                                <input type="text" class="form-control" id="editCourseName" name="course_name" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="editDuration" class="form-label" data-en="Duration *" data-ar="المدة *">Duration *</label>
                                                <input type="text" class="form-control" id="editDuration" name="duration" 
                                                       placeholder="e.g., 3 months" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <label for="editCourseDescription" class="form-label" data-en="Course Description *" data-ar="وصف الكورس *">Course Description *</label>
                                                <textarea class="form-control" id="editCourseDescription" name="course_description" 
                                                          rows="4" required></textarea>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="editSkills" class="form-label" data-en="Skills Covered *" data-ar="المهارات المكتسبة *">Skills Covered *</label>
                                                <input type="text" class="form-control" id="editSkills" name="skills" 
                                                       placeholder="HTML, CSS, JavaScript, PHP" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="editMaxStudents" class="form-label" data-en="Max Students *" data-ar="الحد الأقصى للطلاب *">Max Students *</label>
                                                <input type="number" class="form-control" id="editMaxStudents" name="max_students" 
                                                       min="1" max="50" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="editStartDate" class="form-label" data-en="Start Date *" data-ar="تاريخ البداية *">Start Date *</label>
                                                <input type="date" class="form-control" id="editStartDate" name="start_date" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="editLocation" class="form-label" data-en="Location *" data-ar="المكان *">Location *</label>
                                                <input type="text" class="form-control" id="editLocation" name="location" 
                                                       placeholder="Smart Village, Cairo" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="editPrice" class="form-label" data-en="Price (EGP) *" data-ar="السعر (جنيه) *">Price (EGP) *</label>
                                                <input type="number" class="form-control" id="editPrice" name="price" 
                                                       min="0" step="0.01" required>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check mt-4">
                                                    <input type="hidden" name="certificate" value="0">
                                                    <input class="form-check-input" type="checkbox" id="editCertificate" name="certificate" value="1">
                                                    <label class="form-check-label" for="editCertificate" data-en="Provides Certificate" data-ar="يوفر شهادة">
                                                        Provides Certificate
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                    <input type="hidden" name="featured" value="0">
                                                    <input class="form-check-input" type="checkbox" id="editFeatured" name="featured" value="1">
                                                    <label class="form-check-label" for="editFeatured" data-en="Featured Course" data-ar="كورس مميز">
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
                                            <div class="current-image" id="currentImageContainer">
                                                <img id="editCourseImagePreview" src="{{ asset('admin/assets/images/iti_logo.svg') }}"
                                                     alt="Course Image" class="img-thumbnail me-3"
                                                     style="width: 100%; max-height: 200px; object-fit: cover;">
                                                                </div>
                                            <div class="mt-3">
                                                <input type="file" class="form-control" id="editCourseImage" name="image" accept="image/*">
                                                <small class="text-muted" data-en="Upload a new course image" data-ar="ارفع صورة كورس جديدة">
                                                    Upload a new course image
                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                    <!-- Form Actions -->
                                <div class="row">
                                        <div class="col-12">
                                        <div class="d-flex gap-2">
                                            <button type="submit" class="btn btn-danger" data-en="Update Course" data-ar="تحديث الكورس">
                                                Update Course
                                                </button>
                                            <a href="{{ route('admin.show.course') }}" class="btn btn-outline-secondary">Cancel</a>
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
    <script src="{{ asset('admin/assets/js/edit-course.js') }}"></script>
    <script src="{{ asset('admin/assets/js/sitebar-appear.js') }}"></script>
    </body>
    </html>
@endsection
