// Add Course JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('addCourseForm');
    const imageUploadArea = document.getElementById('imageUploadArea');
    const courseImage = document.getElementById('courseImage');
    const imagePreview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    const removeImageBtn = document.getElementById('removeImage');

    // Image upload functionality
    if (imageUploadArea && courseImage) {
        // Click to upload
        imageUploadArea.addEventListener('click', function() {
            courseImage.click();
        });

        // Drag and drop
        imageUploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('drag-over');
        });

        imageUploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('drag-over');
        });

        imageUploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('drag-over');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                handleImageSelect(files[0]);
            }
        });

        // File input change
        courseImage.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                handleImageSelect(e.target.files[0]);
            }
        });

        // Remove image
        if (removeImageBtn) {
            removeImageBtn.addEventListener('click', function() {
                removeImage();
            });
        }
    }

    // Handle image selection
    function handleImageSelect(file) {
        // Validate file type
        if (!file.type.startsWith('image/')) {
            showError('يرجى اختيار ملف صورة صحيح');
            return;
        }

        // Validate file size (5MB max)
        if (file.size > 5 * 1024 * 1024) {
            showError('حجم الملف يجب أن يكون أقل من 5 ميجابايت');
            return;
        }

        // Create preview
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            imageUploadArea.classList.add('d-none');
            imagePreview.classList.remove('d-none');
            hideError();
        };
        reader.readAsDataURL(file);
    }

    // Remove image
    function removeImage() {
        courseImage.value = '';
        imageUploadArea.classList.remove('d-none');
        imagePreview.classList.add('d-none');
    }

    // Form validation
    function validateForm() {
        let isValid = true;
        const requiredFields = form.querySelectorAll('[required]');
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                showFieldError(field, 'هذا الحقل مطلوب');
                isValid = false;
            } else {
                clearFieldError(field);
            }
        });

        // Email validation
        const emailField = form.querySelector('input[type="email"]');
        if (emailField && emailField.value) {
            const emailPattern = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
            if (!emailPattern.test(emailField.value)) {
                showFieldError(emailField, 'يرجى إدخال بريد إلكتروني صحيح');
                isValid = false;
            }
        }

        // Phone validation
        const phoneField = form.querySelector('input[type="tel"]');
        if (phoneField && phoneField.value) {
            const phonePattern = /^(010|011|012|015)\d{8}$/;
            if (!phonePattern.test(phoneField.value)) {
                showFieldError(phoneField, 'يرجى إدخال رقم هاتف صحيح');
                isValid = false;
            }
        }

        // Number validation
        const numberFields = form.querySelectorAll('input[type="number"]');
        numberFields.forEach(field => {
            if (field.value && field.min && parseFloat(field.value) < parseFloat(field.min)) {
                showFieldError(field, `القيمة يجب أن تكون ${field.min} أو أكثر`);
                isValid = false;
            }
            if (field.value && field.max && parseFloat(field.value) > parseFloat(field.max)) {
                showFieldError(field, `القيمة يجب أن تكون ${field.max} أو أقل`);
                isValid = false;
            }
        });

        return isValid;
    }

    // Show field error
    function showFieldError(field, message) {
        clearFieldError(field);
        
        field.classList.add('is-invalid');
        const errorDiv = document.createElement('div');
        errorDiv.className = 'invalid-feedback';
        errorDiv.textContent = message;
        field.parentNode.appendChild(errorDiv);
        
        // Add shake animation
        field.style.animation = 'shake 0.5s ease-in-out';
        setTimeout(() => {
            field.style.animation = '';
        }, 500);
    }

    // Clear field error
    function clearFieldError(field) {
        field.classList.remove('is-invalid');
        const errorDiv = field.parentNode.querySelector('.invalid-feedback');
        if (errorDiv) {
            errorDiv.remove();
        }
    }

    // Real-time validation
    const inputs = form.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.hasAttribute('required') && !this.value.trim()) {
                showFieldError(this, 'هذا الحقل مطلوب');
            } else {
                clearFieldError(this);
            }
        });
    });

    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!validateForm()) {
            showError('يرجى تصحيح الأخطاء قبل المتابعة');
            return;
        }
        
        // Show loading state
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>جاري الإضافة...';
        
        // Simulate form submission
        setTimeout(() => {
            // Reset button
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
            
            // Show success message
            showSuccess('تم إضافة الكورس بنجاح! جاري التوجيه...');
            
            // Redirect to courses page
            setTimeout(() => {
                window.location.href = 'courses.html';
            }, 1500);
        }, 2000);
    });

    // Curriculum management
    const addModuleBtn = document.querySelector("#addModuleBtn");
    const addLessonBtns = document.querySelectorAll(".add-lesson-btn");
    
    if (addModuleBtn) {
        addModuleBtn.addEventListener('click', function() {
            addNewModule();
        });
    }
    
    addLessonBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            addNewLesson(this);
        });
    });

    // Add new module
    function addNewModule() {
        const curriculumSections = document.querySelector('.curriculum-sections');
        const moduleCount = curriculumSections.querySelectorAll('.curriculum-section').length + 1;
        
        const moduleHTML = `
            <div class="curriculum-section mb-3">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="اسم الوحدة" value="الوحدة ${moduleCount}">
                            </div>
                            <div class="col-md-4">
                                <input type="number" class="form-control" placeholder="عدد الأسابيع" value="1">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-outline-danger btn-sm remove-module">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="lessons">
                            <button type="button" class="btn btn-outline-primary btn-sm add-lesson">
                                <i class="fas fa-plus me-1"></i>إضافة درس
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        curriculumSections.insertAdjacentHTML('beforeend', moduleHTML);
        
        // Add event listeners to new elements
        const newModule = curriculumSections.lastElementChild;
        const removeModuleBtn = newModule.querySelector('.remove-module');
        const addLessonBtn = newModule.querySelector('.add-lesson');
        
        removeModuleBtn.addEventListener('click', function() {
            newModule.remove();
        });
        
        addLessonBtn.addEventListener('click', function() {
            addNewLesson(this);
        });
    }

    // Add new lesson
    function addNewLesson(button) {
        const lessonsContainer = button.parentNode;
        const lessonHTML = `
            <div class="lesson-item mb-2">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <input type="text" class="form-control form-control-sm" placeholder="اسم الدرس">
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control form-control-sm" placeholder="المدة (ساعات)" value="1">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-outline-danger btn-sm remove-lesson">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
        
        button.insertAdjacentHTML('beforebegin', lessonHTML);
        
        // Add event listener to remove button
        const newLesson = button.previousElementSibling;
        const removeLessonBtn = newLesson.querySelector('.remove-lesson');
        
        removeLessonBtn.addEventListener('click', function() {
            newLesson.remove();
        });
    }

    // Show error message
    function showError(message) {
        const errorDiv = document.createElement('div');
        errorDiv.className = 'alert alert-danger alert-dismissible fade show position-fixed';
        errorDiv.style.cssText = 'top: 20px; left: 50%; transform: translateX(-50%); z-index: 9999; min-width: 300px;';
        errorDiv.innerHTML = `
            <i class="fas fa-exclamation-triangle me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        document.body.appendChild(errorDiv);
        
        setTimeout(() => {
            if (errorDiv.parentNode) {
                errorDiv.remove();
            }
        }, 5000);
    }

    // Show success message
    function showSuccess(message) {
        const successDiv = document.createElement('div');
        successDiv.className = 'alert alert-success alert-dismissible fade show position-fixed';
        successDiv.style.cssText = 'top: 20px; left: 50%; transform: translateX(-50%); z-index: 9999; min-width: 300px;';
        successDiv.innerHTML = `
            <i class="fas fa-check-circle me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        document.body.appendChild(successDiv);
        
        setTimeout(() => {
            if (successDiv.parentNode) {
                successDiv.remove();
            }
        }, 3000);
    }

    // Hide error message
    function hideError() {
        const errorAlert = document.querySelector('.alert-danger');
        if (errorAlert) {
            errorAlert.remove();
        }
    }

    // Add CSS for animations and styles
    const style = document.createElement('style');
    style.textContent = `
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        
        .is-invalid {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
        }
        
        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875rem;
            color: #dc3545;
        }
        
        .drag-over {
            border-color: var(--iti-red) !important;
            background-color: rgba(165, 42, 42, 0.1) !important;
            transform: scale(1.02);
        }
        
        .curriculum-section {
            transition: all 0.3s ease;
        }
        
        .lesson-item {
            transition: all 0.3s ease;
        }
        
        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
    `;
    document.head.appendChild(style);
});
