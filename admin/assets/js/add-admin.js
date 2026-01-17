/**
 * Add Admin JavaScript
 * Handles admin creation functionality
 */

document.addEventListener('DOMContentLoaded', function() {
    const addAdminForm = document.getElementById('addAdminForm');
    
    if (addAdminForm) {
        addAdminForm.addEventListener('submit', function(e) {
            const formData = getAdminFormData();
            if (!validateAdminForm(formData)) {
                e.preventDefault();
            }
            // If valid, allow the native form submission to Laravel route
        });
    }
});

function getAdminFormData() {
    return {
        firstName: (document.getElementById('adminFirstName') || {}).value || '',
        lastName: (document.getElementById('adminLastName') || {}).value || '',
        email: (document.getElementById('adminEmail') || {}).value || '',
        phone: (document.getElementById('adminPhone') || {}).value || '',
        idNumber: (document.getElementById('adminIdNumber') || {}).value || '',
        password: (document.getElementById('adminPassword') || {}).value || '',
        joinedAt: (document.getElementById('adminJoinedAt') || {}).value || '',
        isSuper: (document.getElementById('adminIsSuper') || {}).value || '0'
    };
}

function validateAdminForm(data) {
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

    if (!data.idNumber.trim()) {
        errors.push('ID number is required');
    }

    if (!data.password.trim()) {
        errors.push('Password is required');
    } else if (data.password.length < 6) {
        errors.push('Password must be at least 6 characters long');
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
    const form = document.getElementById('addAdminForm');
    if (form) {
        form.reset();
    }
}

function showLoadingState() {
    const submitBtn = document.querySelector('#addAdminForm button[type="submit"]');
    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Adding Admin...';
    }
}

function hideLoadingState() {
    const submitBtn = document.querySelector('#addAdminForm button[type="submit"]');
    if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-user-plus me-1"></i><span data-en="Add Admin" data-ar="إضافة المسؤول">Add Admin</span>';
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

// Set default joined date to today
document.addEventListener('DOMContentLoaded', function() {
    const joinedAtInput = document.getElementById('adminJoinedAt');
    if (joinedAtInput && !joinedAtInput.value) {
        const today = new Date().toISOString().split('T')[0];
        joinedAtInput.value = today;
    }
});
