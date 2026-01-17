// Instructor Dashboard JavaScript

// Initialize dashboard
document.addEventListener('DOMContentLoaded', function() {
    initializeDashboard();
    loadInstructorData();
    setupEventListeners();
});

// Initialize dashboard components
function initializeDashboard() {
    // Update instructor name (use default if not logged in)
    const instructorName = localStorage.getItem('userName') || 'Dr. Ahmed Mohamed';
    document.getElementById('instructorName').textContent = instructorName;
    document.getElementById('welcomeName').textContent = instructorName;
}

// Load instructor data
function loadInstructorData() {
    // Simulate loading instructor data
    const instructorData = {
        courses: 4,
        students: 127,
        pendingAssignments: 23,
        averageAttendance: 94
    };
    
    // Update statistics
    updateStatistics(instructorData);
    
    // Load recent activity
    loadRecentActivity();
    
    // Load upcoming events
    loadUpcomingEvents();
}

// Update statistics cards
function updateStatistics(data) {
    // This would typically fetch real data from an API
    console.log('Loading instructor statistics:', data);
}

// Load recent activity
function loadRecentActivity() {
    // This would typically fetch real activity data from an API
    console.log('Loading recent activity');
}

// Load upcoming events
function loadUpcomingEvents() {
    // This would typically fetch real events data from an API
    console.log('Loading upcoming events');
}

// Setup event listeners
function setupEventListeners() {
    // Quick action buttons
    const quickActionButtons = document.querySelectorAll('.btn-instructor, .btn-outline-instructor');
    quickActionButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            // Add loading state
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Loading...';
            this.disabled = true;
            
            // Simulate loading
            setTimeout(() => {
                this.innerHTML = originalText;
                this.disabled = false;
            }, 1000);
        });
    });
    
    // Notification dropdown
    const notificationDropdown = document.querySelector('.dropdown-toggle[data-bs-toggle="dropdown"]');
    if (notificationDropdown) {
        notificationDropdown.addEventListener('click', function() {
            // Mark notifications as read
            markNotificationsAsRead();
        });
    }
}

// Mark notifications as read
function markNotificationsAsRead() {
    const badge = document.querySelector('.badge.bg-danger');
    if (badge) {
        badge.textContent = '0';
        badge.style.display = 'none';
    }
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

// Language toggle function
function changeLanguage(lang) {
    const currentLang = document.getElementById('currentLang');
    if (currentLang) {
        currentLang.textContent = lang.toUpperCase();
    }
    
    // Store language preference
    localStorage.setItem('language', lang);
    
    // Apply language changes
    applyLanguageChanges(lang);
}

// Apply language changes
function applyLanguageChanges(lang) {
    // This would typically update all text elements based on language
    console.log('Changing language to:', lang);
}

// Course management functions
function viewCourseDetails(courseId) {
    window.location.href = `course-details.html?id=${courseId}`;
}

function addNewCourse() {
    window.location.href = 'add-course.html';
}

// Student management functions
function viewStudents(courseId) {
    window.location.href = `students.html?course=${courseId}`;
}

function markAttendance(courseId) {
    window.location.href = `attendance.html?course=${courseId}`;
}

function gradeAssignments(courseId) {
    window.location.href = `grades.html?course=${courseId}`;
}

// Assignment management functions
function createAssignment(courseId) {
    window.location.href = `create-assignment.html?course=${courseId}`;
}

function viewSubmissions(assignmentId) {
    window.location.href = `submissions.html?assignment=${assignmentId}`;
}

// Utility functions
function formatDate(date) {
    return new Date(date).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric'
    });
}

function formatTime(time) {
    return new Date(time).toLocaleTimeString('en-US', {
        hour: '2-digit',
        minute: '2-digit'
    });
}

// Export functions for use in other files
window.instructorDashboard = {
    logout,
    changeLanguage,
    viewCourseDetails,
    addNewCourse,
    viewStudents,
    markAttendance,
    gradeAssignments,
    createAssignment,
    viewSubmissions,
    formatDate,
    formatTime
};
