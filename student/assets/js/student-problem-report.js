// Student Problem Report JavaScript

document.addEventListener('DOMContentLoaded', function() {
    initializeProblemReport();
    setupEventListeners();
    loadRecentReports();
});

function initializeProblemReport() {
    console.log('Student Problem Report initialized');
    
    // Initialize form validation
    setupFormValidation();
}

function setupFormValidation() {
    const form = document.getElementById('problemReportForm');
    if (form) {
        form.addEventListener('submit', handleFormSubmission);
    }
}

function handleFormSubmission(e) {
    e.preventDefault();
    
    // Get form data
    const formData = {
        type: document.getElementById('problemType').value,
        priority: document.getElementById('priority').value,
        title: document.getElementById('problemTitle').value,
        description: document.getElementById('problemDescription').value,
        images: document.getElementById('problemImages').files,
        contactMethod: document.getElementById('contactMethod').value
    };
    
    // Validate form
    if (validateForm(formData)) {
        submitProblemReport(formData);
    }
}

function validateForm(data) {
    if (!data.type) {
        showNotification('Please select a problem type', 'warning');
        return false;
    }
    
    if (!data.title.trim()) {
        showNotification('Please enter a problem title', 'warning');
        return false;
    }
    
    if (!data.description.trim()) {
        showNotification('Please provide a detailed description', 'warning');
        return false;
    }
    
    if (data.description.trim().length < 20) {
        showNotification('Description must be at least 20 characters long', 'warning');
        return false;
    }
    
    return true;
}

function submitProblemReport(data) {
    // Show loading state
    const submitButton = document.querySelector('button[type="submit"]');
    const originalText = submitButton.innerHTML;
    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Submitting...';
    submitButton.disabled = true;
    
    // Simulate API call
    setTimeout(() => {
        // Reset button
        submitButton.innerHTML = originalText;
        submitButton.disabled = false;
        
        // Show success message
        showNotification('Problem report submitted successfully! Report ID: #PR-005', 'success');
        
        // Reset form
        resetForm();
        
        // Update recent reports
        loadRecentReports();
        
    }, 2000);
}

function resetForm() {
    const form = document.getElementById('problemReportForm');
    if (form) {
        form.reset();
    }
}

function loadRecentReports() {
    // Simulate loading recent reports
    const reports = [
        {
            id: 'PR-001',
            title: 'Assignment submission error',
            type: 'Technical',
            priority: 'Medium',
            status: 'Resolved',
            date: 'Dec 10, 2024'
        },
        {
            id: 'PR-002',
            title: 'Grade calculation concern',
            type: 'Grade',
            priority: 'High',
            status: 'In Progress',
            date: 'Dec 12, 2024'
        },
        {
            id: 'PR-003',
            title: 'Course material access issue',
            type: 'Course',
            priority: 'Low',
            status: 'Pending',
            date: 'Dec 14, 2024'
        }
    ];
    
    updateRecentReportsTable(reports);
}

function updateRecentReportsTable(reports) {
    const tbody = document.querySelector('.instructor-table tbody');
    if (tbody) {
        tbody.innerHTML = '';
        
        reports.forEach(report => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>#${report.id}</td>
                <td>${report.title}</td>
                <td><span class="badge badge-instructor">${report.type}</span></td>
                <td><span class="badge badge-${getPriorityClass(report.priority)}">${report.priority}</span></td>
                <td><span class="badge badge-${getStatusClass(report.status)}">${report.status}</span></td>
                <td>${report.date}</td>
                <td>
                    <button class="btn btn-sm btn-outline-primary" onclick="viewReport('${report.id}')">
                        <i class="fas fa-eye"></i>
                    </button>
                </td>
            `;
            tbody.appendChild(row);
        });
    }
}

function getPriorityClass(priority) {
    const priorityClasses = {
        'Low': 'info',
        'Medium': 'warning',
        'High': 'danger',
        'Urgent': 'danger'
    };
    return priorityClasses[priority] || 'secondary';
}

function getStatusClass(status) {
    const statusClasses = {
        'Pending': 'secondary',
        'In Progress': 'warning',
        'Resolved': 'success',
        'Rejected': 'danger'
    };
    return statusClasses[status] || 'secondary';
}

function setupEventListeners() {
    // File upload handling
    const fileInput = document.getElementById('problemImages');
    if (fileInput) {
        fileInput.addEventListener('change', handleFileUpload);
    }
    
    // Form reset button
    const resetButton = document.querySelector('button[onclick="resetForm()"]');
    if (resetButton) {
        resetButton.addEventListener('click', resetForm);
    }
}

function handleFileUpload(e) {
    const files = Array.from(e.target.files);
    
    // Validate file count
    if (files.length > 5) {
        showNotification('Maximum 5 files allowed', 'warning');
        e.target.value = '';
        return;
    }
    
    // Validate file sizes and types
    const validFiles = files.filter(file => {
        if (file.size > 10 * 1024 * 1024) { // 10MB limit
            showNotification(`File ${file.name} is too large (max 10MB)`, 'warning');
            return false;
        }
        
        if (!file.type.startsWith('image/')) {
            showNotification(`File ${file.name} is not an image`, 'warning');
            return false;
        }
        
        return true;
    });
    
    if (validFiles.length !== files.length) {
        e.target.value = '';
    }
    
    if (validFiles.length > 0) {
        showNotification(`${validFiles.length} file(s) selected for upload`, 'info');
    }
}

function viewReport(reportId) {
    // Show report details modal
    showNotification(`Viewing report ${reportId}`, 'info');
    
    // Simulate opening report details
    setTimeout(() => {
        showNotification('Report details loaded', 'success');
    }, 1000);
}

function viewMyReports() {
    showNotification('Loading your reports...', 'info');
    
    // Simulate navigation to reports page
    setTimeout(() => {
        showNotification('Reports page loaded', 'success');
    }, 1000);
}

function newReport() {
    // Scroll to form
    const form = document.getElementById('problemReportForm');
    if (form) {
        form.scrollIntoView({ behavior: 'smooth' });
    }
    
    // Focus on first input
    const firstInput = form.querySelector('input, select, textarea');
    if (firstInput) {
        firstInput.focus();
    }
}

// Export functions for global access
window.resetForm = resetForm;
window.viewReport = viewReport;
window.viewMyReports = viewMyReports;
window.newReport = newReport;

