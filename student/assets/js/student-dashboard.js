// Student Dashboard JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Initialize dashboard
    initializeDashboard();
    
    // Load student data
    loadStudentData();
    
    // Setup event listeners
    setupEventListeners();
});

function initializeDashboard() {
    console.log('Student Dashboard initialized');
    
    // Set welcome name
    const welcomeName = document.getElementById('welcomeName');
    if (welcomeName) {
        welcomeName.textContent = 'Ahmed Mohamed';
    }
    
    // Update statistics
    updateStatistics();
}

function loadStudentData() {
    // Simulate loading student data
    const studentData = {
        name: 'Ahmed Mohamed',
        studentId: '2024003',
        course: 'Web Development',
        attendance: 94,
        averageGrade: 'A+',
        assignmentsCompleted: 6,
        totalAssignments: 8
    };
    
    // Update dashboard with student data
    updateDashboardData(studentData);
}

function updateDashboardData(data) {
    // Update statistics cards
    const statNumbers = document.querySelectorAll('.stat-number');
    if (statNumbers.length >= 4) {
        statNumbers[0].textContent = '1'; // Active Course
        statNumbers[1].textContent = data.assignmentsCompleted; // Assignments
        statNumbers[2].textContent = data.attendance + '%'; // Attendance
        statNumbers[3].textContent = data.averageGrade; // Average Grade
    }
}

function updateStatistics() {
    // Update statistics based on current data
    console.log('Statistics updated');
}

function setupEventListeners() {
    // Quick action buttons
    const quickActionButtons = document.querySelectorAll('.btn');
    quickActionButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (this.textContent.includes('Submit Assignment')) {
                window.location.href = 'assignments.html';
            } else if (this.textContent.includes('View Grades')) {
                window.location.href = 'grades.html';
            } else if (this.textContent.includes('Report Problem')) {
                window.location.href = 'problem-report.html';
            } else if (this.textContent.includes('View Ranking')) {
                window.location.href = 'ranking.html';
            }
        });
    });
}

// Navigation functions
function navigateToPage(page) {
    window.location.href = page + '.html';
}

// Utility functions
function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    notification.style.top = '20px';
    notification.style.right = '20px';
    notification.style.zIndex = '9999';
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(notification);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (notification.parentNode) {
            notification.parentNode.removeChild(notification);
        }
    }, 5000);
}

// Export functions for global access
window.navigateToPage = navigateToPage;
window.showNotification = showNotification;

