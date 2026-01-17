// Instructor Create Assignment JavaScript

// Initialize create assignment page
document.addEventListener('DOMContentLoaded', function() {
    initializeCreateAssignmentPage();
    setupEventListeners();
    setupFormValidation();
});

// Initialize create assignment page
function initializeCreateAssignmentPage() {
    // Update instructor name (use default if not logged in)
    const instructorName = localStorage.getItem('userName') || 'Dr. Ahmed Mohamed';
    document.getElementById('instructorName').textContent = instructorName;
    
    // Set default due date to next week
    const nextWeek = new Date();
    nextWeek.setDate(nextWeek.getDate() + 7);
    document.getElementById('dueDate').value = nextWeek.toISOString().split('T')[0];
    
    // Set default due time to 11:59 PM
    document.getElementById('dueTime').value = '23:59';
    
    // Set default points
    document.getElementById('assignmentPoints').value = '100';
}

// Setup event listeners
function setupEventListeners() {
    // Form input listeners for real-time preview
    const formInputs = document.querySelectorAll('#createAssignmentForm input, #createAssignmentForm select, #createAssignmentForm textarea');
    formInputs.forEach(input => {
        input.addEventListener('input', updatePreview);
        input.addEventListener('change', updatePreview);
    });
    
    // Form submission
    document.getElementById('createAssignmentForm').addEventListener('submit', handleFormSubmission);
}

// Setup form validation
function setupFormValidation() {
    const form = document.getElementById('createAssignmentForm');
    
    // Real-time validation
    const requiredFields = form.querySelectorAll('[required]');
    requiredFields.forEach(field => {
        field.addEventListener('blur', validateField);
        field.addEventListener('input', clearFieldError);
    });
}

// Validate individual field
function validateField(event) {
    const field = event.target;
    const value = field.value.trim();
    
    if (field.hasAttribute('required') && !value) {
        showFieldError(field, 'This field is required');
        return false;
    }
    
    // Specific validations
    if (field.id === 'assignmentPoints') {
        const points = parseInt(value);
        if (isNaN(points) || points < 1 || points > 1000) {
            showFieldError(field, 'Points must be between 1 and 1000');
            return false;
        }
    }
    
    if (field.id === 'dueDate') {
        const dueDate = new Date(value);
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        
        if (dueDate < today) {
            showFieldError(field, 'Due date cannot be in the past');
            return false;
        }
    }
    
    clearFieldError(event);
    return true;
}

// Show field error
function showFieldError(field, message) {
    clearFieldError({ target: field });
    
    field.classList.add('is-invalid');
    
    const errorDiv = document.createElement('div');
    errorDiv.className = 'invalid-feedback';
    errorDiv.textContent = message;
    
    field.parentNode.appendChild(errorDiv);
}

// Clear field error
function clearFieldError(event) {
    const field = event.target;
    field.classList.remove('is-invalid');
    
    const errorDiv = field.parentNode.querySelector('.invalid-feedback');
    if (errorDiv) {
        errorDiv.remove();
    }
}

// Update assignment preview
function updatePreview() {
    const title = document.getElementById('assignmentTitle').value;
    const course = document.getElementById('assignmentCourse').value;
    const description = document.getElementById('assignmentDescription').value;
    const dueDate = document.getElementById('dueDate').value;
    const dueTime = document.getElementById('dueTime').value;
    const type = document.getElementById('assignmentType').value;
    const points = document.getElementById('assignmentPoints').value;
    const instructions = document.getElementById('assignmentInstructions').value;
    
    const preview = document.getElementById('assignmentPreview');
    
    if (!title && !course && !description) {
        preview.innerHTML = `
            <div class="text-center text-muted py-4">
                <i class="fas fa-file-alt" style="font-size: 3rem; opacity: 0.3;"></i>
                <p class="mt-3">Assignment preview will appear here</p>
            </div>
        `;
        return;
    }
    
    const courseName = getCourseName(course);
    const dueDateTime = dueDate && dueTime ? `${formatDate(dueDate)} at ${dueTime}` : 'Not set';
    
    preview.innerHTML = `
        <div class="assignment-preview">
            <h6 class="mb-2">${title || 'Assignment Title'}</h6>
            <small class="text-muted d-block mb-2">${courseName || 'Course'}</small>
            
            ${description ? `<p class="text-muted small mb-2">${description.substring(0, 100)}${description.length > 100 ? '...' : ''}</p>` : ''}
            
            <div class="row small text-muted">
                <div class="col-6">
                    <strong>Type:</strong><br>
                    ${type || 'Not specified'}
                </div>
                <div class="col-6">
                    <strong>Points:</strong><br>
                    ${points || 'Not set'}
                </div>
            </div>
            
            <hr class="my-3">
            
            <div class="small text-muted">
                <strong>Due:</strong> ${dueDateTime}
            </div>
            
            ${instructions ? `
                <div class="small text-muted mt-2">
                    <strong>Instructions:</strong><br>
                    ${instructions.substring(0, 80)}${instructions.length > 80 ? '...' : ''}
                </div>
            ` : ''}
        </div>
    `;
}

// Get course name by ID
function getCourseName(courseId) {
    const courses = {
        '1': 'Web Development',
        '2': 'Data Science',
        '3': 'Mobile Development',
        '4': 'Cybersecurity'
    };
    return courses[courseId] || '';
}

// Format date
function formatDate(dateString) {
    if (!dateString) return '';
    
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric'
    });
}

// Handle form submission
function handleFormSubmission(event) {
    event.preventDefault();
    
    // Validate all fields
    const isValid = validateForm();
    if (!isValid) {
        showErrorMessage('Please fix all errors before submitting');
        return;
    }
    
    // Collect form data
    const assignmentData = {
        id: generateAssignmentId(),
        title: document.getElementById('assignmentTitle').value.trim(),
        course: document.getElementById('assignmentCourse').value,
        courseName: getCourseName(document.getElementById('assignmentCourse').value),
        description: document.getElementById('assignmentDescription').value.trim(),
        dueDate: document.getElementById('dueDate').value,
        dueTime: document.getElementById('dueTime').value,
        type: document.getElementById('assignmentType').value,
        points: parseInt(document.getElementById('assignmentPoints').value),
        instructions: document.getElementById('assignmentInstructions').value.trim(),
        submissionRequirements: document.getElementById('submissionRequirements').value.trim(),
        status: 'active',
        createdAt: new Date().toISOString(),
        totalStudents: getCourseStudentCount(document.getElementById('assignmentCourse').value),
        submittedStudents: 0,
        progress: 0
    };
    
    // Save assignment
    saveAssignment(assignmentData);
    
    // Show success message
    showSuccessMessage('Assignment created successfully!');
    
    // Redirect to assignments page
    setTimeout(() => {
        window.location.href = 'assignments.html';
    }, 1500);
}

// Validate entire form
function validateForm() {
    const requiredFields = document.querySelectorAll('#createAssignmentForm [required]');
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (!validateField({ target: field })) {
            isValid = false;
        }
    });
    
    return isValid;
}

// Generate unique assignment ID
function generateAssignmentId() {
    const assignments = JSON.parse(localStorage.getItem('instructorAssignments') || '[]');
    return assignments.length > 0 ? Math.max(...assignments.map(a => a.id)) + 1 : 1;
}

// Get course student count
function getCourseStudentCount(courseId) {
    const courseStudentCounts = {
        '1': 32, // Web Development
        '2': 28, // Data Science
        '3': 24, // Mobile Development
        '4': 35  // Cybersecurity
    };
    return courseStudentCounts[courseId] || 0;
}

// Save assignment
function saveAssignment(assignmentData) {
    const assignments = JSON.parse(localStorage.getItem('instructorAssignments') || '[]');
    assignments.push(assignmentData);
    localStorage.setItem('instructorAssignments', JSON.stringify(assignments));
    
    console.log('Assignment saved:', assignmentData);
}

// Save as draft
function saveAsDraft() {
    const assignmentData = {
        id: generateAssignmentId(),
        title: document.getElementById('assignmentTitle').value.trim() || 'Draft Assignment',
        course: document.getElementById('assignmentCourse').value || '',
        courseName: getCourseName(document.getElementById('assignmentCourse').value),
        description: document.getElementById('assignmentDescription').value.trim(),
        dueDate: document.getElementById('dueDate').value,
        dueTime: document.getElementById('dueTime').value,
        type: document.getElementById('assignmentType').value,
        points: parseInt(document.getElementById('assignmentPoints').value) || 100,
        instructions: document.getElementById('assignmentInstructions').value.trim(),
        submissionRequirements: document.getElementById('submissionRequirements').value.trim(),
        status: 'draft',
        createdAt: new Date().toISOString(),
        totalStudents: getCourseStudentCount(document.getElementById('assignmentCourse').value),
        submittedStudents: 0,
        progress: 0
    };
    
    // Save draft
    const drafts = JSON.parse(localStorage.getItem('assignmentDrafts') || '[]');
    drafts.push(assignmentData);
    localStorage.setItem('assignmentDrafts', JSON.stringify(drafts));
    
    showSuccessMessage('Assignment saved as draft!');
    console.log('Draft saved:', assignmentData);
}

// Reset form
function resetForm() {
    if (confirm('Are you sure you want to reset the form? All data will be lost.')) {
        document.getElementById('createAssignmentForm').reset();
        
        // Reset to defaults
        const nextWeek = new Date();
        nextWeek.setDate(nextWeek.getDate() + 7);
        document.getElementById('dueDate').value = nextWeek.toISOString().split('T')[0];
        document.getElementById('dueTime').value = '23:59';
        document.getElementById('assignmentPoints').value = '100';
        
        // Clear all errors
        document.querySelectorAll('.is-invalid').forEach(field => {
            field.classList.remove('is-invalid');
        });
        document.querySelectorAll('.invalid-feedback').forEach(error => {
            error.remove();
        });
        
        // Reset preview
        updatePreview();
        
        showSuccessMessage('Form reset successfully!');
    }
}

// Show success message
function showSuccessMessage(message) {
    const alertDiv = document.createElement('div');
    alertDiv.className = 'alert alert-success alert-dismissible fade show position-fixed';
    alertDiv.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    alertDiv.innerHTML = `
        <i class="fas fa-check-circle me-2"></i>${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(alertDiv);
    
    setTimeout(() => {
        if (alertDiv.parentNode) {
            alertDiv.parentNode.removeChild(alertDiv);
        }
    }, 3000);
}

// Show error message
function showErrorMessage(message) {
    const alertDiv = document.createElement('div');
    alertDiv.className = 'alert alert-danger alert-dismissible fade show position-fixed';
    alertDiv.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    alertDiv.innerHTML = `
        <i class="fas fa-exclamation-circle me-2"></i>${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(alertDiv);
    
    setTimeout(() => {
        if (alertDiv.parentNode) {
            alertDiv.parentNode.removeChild(alertDiv);
        }
    }, 3000);
}

// Logout function
function logout() {
    if (confirm('Are you sure you want to logout?')) {
        // Clear all stored data
        localStorage.removeItem('isLoggedIn');
        localStorage.removeItem('userName');
        localStorage.removeItem('userType');
        localStorage.removeItem('userEmail');
        localStorage.removeItem('userId');
        
        // Show success message
        alert('تم تسجيل الخروج بنجاح!');
        
        // Redirect to login page
        window.location.href = '../login.html';
    }
}

// Export functions for use in other files
window.instructorCreateAssignment = {
    updatePreview,
    validateForm,
    saveAsDraft,
    resetForm,
    logout
};
