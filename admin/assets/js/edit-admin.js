/**
 * Edit Admin JavaScript
 * Handles admin editing functionality
 */

document.addEventListener('DOMContentLoaded', function() {
    const editAdminForm = document.getElementById('editAdminForm');
    
    if (editAdminForm) {
        editAdminForm.addEventListener('submit', function(e) {
            // e.preventDefault();
            handleUpdateAdmin();
        });
    }

    // Load admin data (simulate getting data from URL parameter)
    loadAdminData();
});

function loadAdminData() {
    // Simulate loading admin data based on ID from URL

    // Populate form fields
    document.getElementById('adminFirstName').value = adminData.firstName;
    document.getElementById('adminLastName').value = adminData.lastName;
    document.getElementById('adminEmail').value = adminData.email;
    document.getElementById('adminPhone').value = adminData.phone;
    document.getElementById('adminIdNumber').value = adminData.idNumber;
    document.getElementById('adminJoinedAt').value = adminData.joinedAt;
    document.getElementById('adminIsSuper').value = adminData.isSuper;
    document.getElementById('adminActive').checked = adminData.active;
    document.getElementById('adminCanManageUsers').checked = adminData.canManageUsers;
    document.getElementById('adminCanManageCourses').checked = adminData.canManageCourses;
    document.getElementById('adminCanManageAdmins').checked = adminData.canManageAdmins;

    // Disable password field for editing (optional)
    const passwordField = document.getElementById('adminPassword');
    if (passwordField) {
        passwordField.placeholder = 'Leave empty to keep current password';
        passwordField.required = false;
    }
}

function handleUpdateAdmin() {
    // Get form data
    const formData = {
        firstName: document.getElementById('adminFirstName').value,
        lastName: document.getElementById('adminLastName').value,
        email: document.getElementById('adminEmail').value,
        phone: document.getElementById('adminPhone').value,
        idNumber: document.getElementById('adminIdNumber').value,
        password: document.getElementById('adminPassword').value,
        joinedAt: document.getElementById('adminJoinedAt').value,
        isSuper: document.getElementById('adminIsSuper').value === 'true',
        active: document.getElementById('adminActive').checked,
        canManageUsers: document.getElementById('adminCanManageUsers').checked,
        canManageCourses: document.getElementById('adminCanManageCourses').checked,
        canManageAdmins: document.getElementById('adminCanManageAdmins').checked
    };

    // Validate form
    if (!validateAdminForm(formData)) {
        return;
    }

    // Show loading state
    showLoadingState();

    // Simulate API call
    setTimeout(() => {
        // Simulate success
        showSuccessMessage('Admin updated successfully!');
        hideLoadingState();
    }, 2000);
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

    // Password is optional for editing
    if (data.password.trim() && data.password.length < 6) {
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
    // Reset to original loaded data
    loadAdminData();
}

function showLoadingState() {
    const submitBtn = document.querySelector('#editAdminForm button[type="submit"]');
    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Updating Admin...';
    }
}

function hideLoadingState() {
    const submitBtn = document.querySelector('#editAdminForm button[type="submit"]');
    if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-save me-1"></i><span data-en="Update Admin" data-ar="تحديث المسؤول">Update Admin</span>';
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
