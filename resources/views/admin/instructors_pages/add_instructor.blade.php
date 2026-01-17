@extends('admin.layouts.app')

@section('content')

    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-user-plus me-2"></i>
                                <span data-en="New Instructor Information" data-ar="بيانات المدرب الجديد">New Instructor
                                    Information</span>
                            </h5>
                        </div>
                        <div class="card-body">
                            <form id="addInstructorForm">
                                <div class="row">
                                    <!-- Personal Information -->
                                    <div class="col-lg-8">
                                        <h6 class="section-title" data-en="Personal Information"
                                            data-ar="المعلومات الشخصية">Personal Information</h6>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="instructorFirstName" class="form-label" data-en="First Name *"
                                                    data-ar="الاسم الأول *">First Name *</label>
                                                <input type="text" class="form-control" id="instructorFirstName"
                                                    required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="instructorLastName" class="form-label" data-en="Last Name *"
                                                    data-ar="الاسم الأخير *">Last Name *</label>
                                                <input type="text" class="form-control" id="instructorLastName" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="instructorEmail" class="form-label" data-en="Email Address *"
                                                    data-ar="البريد الإلكتروني *">Email Address *</label>
                                                <input type="email" class="form-control" id="instructorEmail" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="instructorPhone" class="form-label" data-en="Phone Number *"
                                                    data-ar="رقم الهاتف *">Phone Number *</label>
                                                <input type="tel" class="form-control" id="instructorPhone" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="instructorId" class="form-label" data-en="ID Number *"
                                                    data-ar="رقم الهوية *">ID Number *</label>
                                                <input maxlength="14" type="text" class="form-control" id="instructorId" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="instructorBirthDate" class="form-label" data-en="Birth Date"
                                                    data-ar="تاريخ الميلاد">Birth Date</label>
                                                <input type="date" class="form-control" id="instructorBirthDate">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="instructorAddress" class="form-label" data-en="Address"
                                                data-ar="العنوان">Address</label>
                                            <textarea class="form-control" id="instructorAddress" rows="2"></textarea>
                                        </div>

                                        <h6 class="section-title" data-en="Professional Information"
                                            data-ar="المعلومات المهنية">Professional Information</h6>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="instructorTitle" class="form-label" data-en="Job Title *"
                                                    data-ar="المسمى الوظيفي *">Job Title *</label>
                                                <input type="text" class="form-control" id="instructorTitle" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="instructorDepartment" class="form-label" data-en="Department *"
                                                    data-ar="القسم *">Department *</label>
                                                <select class="form-select" id="instructorDepartment" required>
                                                    <option value="" data-en="Select Department" data-ar="اختر القسم">
                                                        Select Department</option>
                                                    <option value="web" data-en="Web Development" data-ar="تطوير الويب">
                                                        Web Development</option>
                                                    <option value="mobile" data-en="Mobile Development"
                                                        data-ar="تطوير الموبايل">Mobile Development</option>
                                                    <option value="ai" data-en="Artificial Intelligence"
                                                        data-ar="الذكاء الاصطناعي">Artificial Intelligence</option>
                                                    <option value="cyber" data-en="Cybersecurity"
                                                        data-ar="الأمن السيبراني">Cybersecurity</option>
                                                    <option value="data" data-en="Data Science"
                                                        data-ar="علوم البيانات">Data Science</option>
                                                    <option value="cloud" data-en="Cloud Computing"
                                                        data-ar="الحوسبة السحابية">Cloud Computing</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="instructorExperience" class="form-label"
                                                    data-en="Years of Experience *" data-ar="سنوات الخبرة *">Years of
                                                    Experience *</label>
                                                <input type="number" class="form-control" id="instructorExperience"
                                                    min="0" max="50" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="instructorEducation" class="form-label"
                                                    data-en="Education Level" data-ar="المؤهل العلمي">Education
                                                    Level</label>
                                                <select class="form-select" id="instructorEducation">
                                                    <option value="" data-en="Select Education Level"
                                                        data-ar="اختر المؤهل">Select Education Level</option>
                                                    <option value="diploma" data-en="Diploma" data-ar="دبلوم">Diploma
                                                    </option>
                                                    <option value="bachelor" data-en="Bachelor's Degree"
                                                        data-ar="بكالوريوس">Bachelor's Degree</option>
                                                    <option value="master" data-en="Master's Degree" data-ar="ماجستير">
                                                        Master's Degree</option>
                                                    <option value="phd" data-en="PhD" data-ar="دكتوراه">PhD</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="instructorBio" class="form-label" data-en="Biography *"
                                                data-ar="نبذة شخصية *">Biography *</label>
                                            <textarea class="form-control" id="instructorBio" rows="4" required></textarea>
                                        </div>




                                    </div>

                                    <!-- Profile Image and Settings -->
                                    <div class="col-lg-4">
                                        <h6 class="section-title" data-en="Instructor Photo" data-ar="صورة المدرب">
                                            Instructor Photo</h6>

                                        <div class="instructor-image-upload mb-4">
                                            <div class="image-upload-area" id="instructorImageUploadArea">
                                                <i class="fas fa-user-circle fa-4x text-muted mb-3"></i>
                                                <p class="text-muted" data-en="Drag image here or click to upload"
                                                    data-ar="اسحب الصورة هنا أو اضغط للرفع">Drag image here or click to
                                                    upload</p>
                                                <input type="file" id="instructorImage" accept="image/*"
                                                    class="d-none">
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

                                        <h6 class="section-title" data-en="Instructor Settings" data-ar="إعدادات المدرب">
                                            Instructor Settings</h6>





                                        <div class="mb-3">
                                            <label for="instructorSalary" class="form-label" data-en="Monthly Salary"
                                                data-ar="الراتب الشهري">Monthly Salary</label>
                                            <input type="number" class="form-control" id="instructorSalary"
                                                min="0">
                                        </div>

                                        <div class="mb-3">
                                            <label for="instructorHireDate" class="form-label" data-en="Hire Date"
                                                data-ar="تاريخ التعيين">Hire Date</label>
                                            <input type="date" class="form-control" id="instructorHireDate">
                                        </div>

                                        <h6 class="section-title" data-en="Contact Information"
                                            data-ar="معلومات التواصل">Contact Information</h6>

                                        <div class="mb-3">
                                            <label for="instructorLinkedin" class="form-label">LinkedIn</label>
                                            <input type="url" class="form-control" id="instructorLinkedin"
                                                placeholder="https://linkedin.com/in/username">
                                        </div>

                                        <div class="mb-3">
                                            <label for="instructorGithub" class="form-label">GitHub</label>
                                            <input type="url" class="form-control" id="instructorGithub"
                                                placeholder="https://github.com/username">
                                        </div>

                                        <div class="mb-3">
                                            <label for="instructorWebsite" class="form-label" data-en="Personal Website"
                                                data-ar="الموقع الشخصي">Personal Website</label>
                                            <input type="url" class="form-control" id="instructorWebsite"
                                                placeholder="https://example.com">
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
                                                <span data-en="Add Instructor" data-ar="إضافة المدرب">Add
                                                    Instructor</span>
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
    <script src="assets/js/admin-layout.js"></script>
    <script src="assets/js/add-instructor.js"></script>
    <script src="assets/js/sitebar-appear.js"></script>
</body>

</html>

@endsection
