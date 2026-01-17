/**
 * Add Instructor JavaScript
 * Handles instructor creation functionality
 */

document.addEventListener('DOMContentLoaded', function() {
    const addInstructorForm = document.getElementById('addInstructorForm');
    
    if (addInstructorForm) {
        addInstructorForm.addEventListener('submit', function(e) {
            e.preventDefault();
            handleAddInstructor();
        });
    }

    // Initialize image upload functionality
    initializeImageUpload();
    
    // Set default hire date to today
    setDefaultHireDate();
});

function handleAddInstructor() {
    // Get form data
    const formData = {
        firstName: document.getElementById('instructorFirstName').value,
        lastName: document.getElementById('instructorLastName').value,
        email: document.getElementById('instructorEmail').value,
        phone: document.getElementById('instructorPhone').value,
        idNumber: document.getElementById('instructorId').value,
        birthDate: document.getElementById('instructorBirthDate').value,
        address: document.getElementById('instructorAddress').value,
        title: document.getElementById('instructorTitle').value,
        department: document.getElementById('instructorDepartment').value,
        experience: document.getElementById('instructorExperience').value,
        education: document.getElementById('instructorEducation').value,
        bio: document.getElementById('instructorBio').value,
        salary: document.getElementById('instructorSalary').value,
        hireDate: document.getElementById('instructorHireDate').value,
        linkedin: document.getElementById('instructorLinkedin').value,
        github: document.getElementById('instructorGithub').value,
        website: document.getElementById('instructorWebsite').value,
        image: document.getElementById('instructorImage').files[0]
    };

    // Validate form
    if (!validateInstructorForm(formData)) {
            return;
        }

    // Show loading state
    showLoadingState();

    // Simulate API call
    setTimeout(() => {
        // Simulate success
        showSuccessMessage('Instructor added successfully!');
        resetForm();
        hideLoadingState();
    }, 2000);
}

function validateInstructorForm(data) {
    const errors = [];

    if (!data.firstName.trim()) {
        errors.push('First name is required');
    }

    if (!data.lastName.trim()) {
        errors.push('Last name is required');
    }

    if (!data.email.trim()) {
        errors.push('Email is required');
    } else if (!isValidEmail(data.email)) {
        errors.push('Please enter a valid email address');
    }

    if (!data.phone.trim()) {
        errors.push('Phone number is required');
    }

    if (!data.idNumber.trim()) {
        errors.push('ID number is required');
    }

    if (!data.title.trim()) {
        errors.push('Job title is required');
    }

    if (!data.department) {
        errors.push('Department is required');
    }

    if (!data.experience || data.experience < 0) {
        errors.push('Years of experience must be a positive number');
    }

    if (!data.bio.trim()) {
        errors.push('Biography is required');
    }

    if (errors.length > 0) {
        showErrorMessage(errors.join('<br>'));
        return false;
    }

    return true;
}

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function resetForm() {
    const form = document.getElementById('addInstructorForm');
    if (form) {
        form.reset();
        // Reset image preview
        resetImagePreview();
        // Set default hire date
        setDefaultHireDate();
    }
}

function showLoadingState() {
    const submitBtn = document.querySelector('#addInstructorForm button[type="submit"]');
    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Adding Instructor...';
    }
}

function hideLoadingState() {
    const submitBtn = document.querySelector('#addInstructorForm button[type="submit"]');
    if (submitBtn) {
            submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-user-plus me-1"></i><span data-en="Add Instructor" data-ar="إضافة المدرب">Add Instructor</span>';
    }
}

function showSuccessMessage(message) {
    // Create success alert
    const alertDiv = document.createElement('div');
    alertDiv.className = 'alert alert-success alert-dismissible fade show position-fixed';
    alertDiv.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    alertDiv.innerHTML = `
        <i class="fas fa-check-circle me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
    
    document.body.appendChild(alertDiv);
        
    // Auto remove after 5 seconds
        setTimeout(() => {
        if (alertDiv.parentNode) {
            alertDiv.parentNode.removeChild(alertDiv);
            }
        }, 5000);
    }

function showErrorMessage(message) {
    // Create error alert
    const alertDiv = document.createElement('div');
    alertDiv.className = 'alert alert-danger alert-dismissible fade show position-fixed';
    alertDiv.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    alertDiv.innerHTML = `
        <i class="fas fa-exclamation-circle me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
    
    document.body.appendChild(alertDiv);
        
    // Auto remove after 7 seconds
        setTimeout(() => {
        if (alertDiv.parentNode) {
            alertDiv.parentNode.removeChild(alertDiv);
        }
    }, 7000);
}

function initializeImageUpload() {
    const uploadArea = document.getElementById('instructorImageUploadArea');
    const fileInput = document.getElementById('instructorImage');
    const preview = document.getElementById('instructorImagePreview');
    const previewImg = document.getElementById('instructorPreviewImg');
    const removeBtn = document.getElementById('removeInstructorImage');

    if (!uploadArea || !fileInput || !preview || !previewImg || !removeBtn) {
        return;
    }

    // Click to upload
    uploadArea.addEventListener('click', function() {
        fileInput.click();
    });

    // Drag and drop
    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        uploadArea.classList.add('drag-over');
    });

    uploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        uploadArea.classList.remove('drag-over');
    });

    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        uploadArea.classList.remove('drag-over');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            handleFileSelect(files[0]);
        }
    });

    // File input change
    fileInput.addEventListener('change', function(e) {
        if (e.target.files.length > 0) {
            handleFileSelect(e.target.files[0]);
        }
    });

    // Remove image
    removeBtn.addEventListener('click', function() {
        resetImagePreview();
    });

    function handleFileSelect(file) {
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                uploadArea.classList.add('d-none');
                preview.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        } else {
            showErrorMessage('Please select a valid image file');
        }
    }

    function resetImagePreview() {
        fileInput.value = '';
        previewImg.src = '';
        uploadArea.classList.remove('d-none');
        preview.classList.add('d-none');
    }
}

function setDefaultHireDate() {
    const hireDateInput = document.getElementById('instructorHireDate');
    if (hireDateInput && !hireDateInput.value) {
        const today = new Date().toISOString().split('T')[0];
        hireDateInput.value = today;
    }
}

// Add CSS for drag and drop
const style = document.createElement('style');
style.textContent = `
    .image-upload-area {
        border: 2px dashed #dee2e6;
        border-radius: 8px;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .image-upload-area:hover {
        border-color: #dc3545;
        background-color: #f8f9fa;
    }
    
    .image-upload-area.drag-over {
        border-color: #dc3545;
        background-color: #f8f9fa;
    }
    
    .image-preview img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        }
    `;
    document.head.appendChild(style);
