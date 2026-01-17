/**
 * Admins Management JavaScript
 * Handles admin listing and management functionality
 */

document.addEventListener('DOMContentLoaded', function() {
    initializeAdminsPage();
});

function initializeAdminsPage() {
    // Add event listeners for search and filter
    const searchInput = document.querySelector('input[placeholder*="Search"]');
    if (searchInput) {
        searchInput.addEventListener('input', handleSearch);
    }

    const filterButtons = document.querySelectorAll('.form-select');
    filterButtons.forEach(button => {
        button.addEventListener('change', handleFilter);
    });
}

function handleSearch(e) {
    const searchTerm = e.target.value.toLowerCase();
    const tableRows = document.querySelectorAll('tbody tr');
    
    tableRows.forEach(row => {
        const text = row.textContent.toLowerCase();
        if (text.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

function normalize(v) {
    return (v || '').toString().trim().toLowerCase();
}

function handleFilter(e) {
    const rawFilter = e.target.value;
    const filterValue = normalize(rawFilter);

    const searchInput = document.querySelector('input[placeholder*="Search"]');
    const searchTerm = searchInput ? normalize(searchInput.value) : '';

    const tableRows = document.querySelectorAll('tbody tr');

    tableRows.forEach(row => {
        const rowType = normalize(row.dataset.type || row.dataset.role || '');
        const rowText = normalize(row.textContent || '');

        let passesFilter = true;
        if (filterValue && !filterValue.includes('all')) {
            passesFilter = (rowType && rowType.includes(filterValue)) || rowText.includes(filterValue);
        }

        let passesSearch = true;
        if (searchTerm) {
            passesSearch = rowText.includes(searchTerm);
        }

        const shouldShow = passesFilter && passesSearch;

        row.style.display = shouldShow ? '' : 'none';
    });
}


function deleteAdmin(adminId) {
    // Show confirmation dialog
    if (confirm('Are you sure you want to delete this admin? This action cannot be undone.')) {
        // Show loading state
        showDeleteLoading(adminId);
        
        // Simulate API call
        setTimeout(() => {
            // Remove the row from table
            removeAdminRow(adminId);
            showSuccessMessage('Admin deleted successfully!');
        }, 1500);
    }
}

function showDeleteLoading(adminId) {
    const deleteBtn = document.querySelector(`button[onclick="deleteAdmin(${adminId})"]`);
    if (deleteBtn) {
        deleteBtn.disabled = true;
        deleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    }
}

function removeAdminRow(adminId) {
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach(row => {
        const deleteBtn = row.querySelector(`button[onclick="deleteAdmin(${adminId})"]`);
        if (deleteBtn) {
            row.remove();
        }
    });
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

// Add CSS for avatar circles
const style = document.createElement('style');
style.textContent = `
    .avatar-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #dc3545;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }
`;
document.head.appendChild(style);
