// Instructor Course Details JavaScript

// Initialize course details page
document.addEventListener('DOMContentLoaded', function() {
    initializeCourseDetailsPage();
    setupEventListeners();
    loadCourseData();
});

// Initialize course details page
function initializeCourseDetailsPage() {
    // Update instructor name (use default if not logged in)
    const instructorName = localStorage.getItem('userName') || 'Dr. Ahmed Mohamed';
    document.getElementById('instructorName').textContent = instructorName;
    
    // Get course ID from URL or use default
    const urlParams = new URLSearchParams(window.location.search);
    const courseId = urlParams.get('id') || '1';
    localStorage.setItem('selectedCourseId', courseId);
}

// Setup event listeners
function setupEventListeners() {
    // Tab switching
    const tabButtons = document.querySelectorAll('[data-bs-toggle="tab"]');
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-bs-target');
            updateTabContent(targetTab);
        });
    });
}

// Load course data
function loadCourseData() {
    const courseId = localStorage.getItem('selectedCourseId') || '1';
    const courseData = getCourseData(courseId);
    
    // Update course information
    updateCourseInfo(courseData);
    updateCourseStatistics(courseData);
}

// Get course data by ID
function getCourseData(courseId) {
    const coursesData = {
        '1': {
            id: 1,
            title: 'Web Development',
            description: 'Comprehensive web development course covering HTML, CSS, JavaScript, and modern frameworks.',
            totalStudents: 32,
            averageAttendance: 94,
            totalAssignments: 8,
            courseProgress: 75,
            schedule: 'Mon, Wed, Fri',
            time: '9:00 AM - 12:00 PM',
            room: 'Lab 201',
            duration: '12 weeks',
            credits: '3 credits'
        },
        '2': {
            id: 2,
            title: 'Data Science',
            description: 'Advanced data science course covering statistics, machine learning, and data visualization.',
            totalStudents: 28,
            averageAttendance: 89,
            totalAssignments: 5,
            courseProgress: 60,
            schedule: 'Tue, Thu',
            time: '2:00 PM - 5:00 PM',
            room: 'Lab 202',
            duration: '10 weeks',
            credits: '3 credits'
        },
        '3': {
            id: 3,
            title: 'Mobile Development',
            description: 'Mobile app development using React Native and modern mobile technologies.',
            totalStudents: 24,
            averageAttendance: 0,
            totalAssignments: 0,
            courseProgress: 15,
            schedule: 'Mon, Wed',
            time: '10:00 AM - 1:00 PM',
            room: 'Lab 203',
            duration: '8 weeks',
            credits: '2 credits'
        },
        '4': {
            id: 4,
            title: 'Cybersecurity',
            description: 'Comprehensive cybersecurity course covering network security, ethical hacking, and security protocols.',
            totalStudents: 35,
            averageAttendance: 96,
            totalAssignments: 12,
            courseProgress: 90,
            schedule: 'Tue, Thu, Sat',
            time: '6:00 PM - 9:00 PM',
            room: 'Lab 204',
            duration: '14 weeks',
            credits: '4 credits'
        }
    };
    
    return coursesData[courseId] || coursesData['1'];
}

// Update course information
function updateCourseInfo(courseData) {
    document.getElementById('courseTitle').textContent = courseData.title;
    document.getElementById('courseDescription').textContent = courseData.description;
    document.getElementById('selectedCourse').textContent = courseData.title;
}

// Update course statistics
function updateCourseStatistics(courseData) {
    document.getElementById('totalStudents').textContent = courseData.totalStudents;
    document.getElementById('averageAttendance').textContent = courseData.averageAttendance + '%';
    document.getElementById('totalAssignments').textContent = courseData.totalAssignments;
    document.getElementById('courseProgress').textContent = courseData.courseProgress + '%';
}

// Select course
function selectCourse(courseId, courseName) {
    document.getElementById('selectedCourse').textContent = courseName;
    localStorage.setItem('selectedCourseId', courseId);
    
    // Reload course data
    loadCourseData();
}

// Update tab content
function updateTabContent(targetTab) {
    // This function can be used to load specific content for each tab
    console.log('Switching to tab:', targetTab);
    
    switch(targetTab) {
        case '#overview':
            // Overview content is already loaded
            break;
        case '#schedule':
            loadScheduleData();
            break;
        case '#students':
            loadStudentsData();
            break;
        case '#assignments':
            loadAssignmentsData();
            break;
    }
}

// Load schedule data
function loadScheduleData() {
    // Simulate loading schedule data
    console.log('Loading schedule data...');
}

// Load students data
function loadStudentsData() {
    // Simulate loading students data
    console.log('Loading students data...');
}

// Load assignments data
function loadAssignmentsData() {
    // Simulate loading assignments data
    console.log('Loading assignments data...');
}

// Mark attendance
function markAttendance() {
    const courseId = localStorage.getItem('selectedCourseId');
    window.location.href = `attendance.html?course=${courseId}`;
}

// Create assignment
function createAssignment() {
    const courseId = localStorage.getItem('selectedCourseId');
    window.location.href = `create-assignment.html?course=${courseId}`;
}

// View all students
function viewAllStudents() {
    const courseId = localStorage.getItem('selectedCourseId');
    window.location.href = `students.html?course=${courseId}`;
}

// Export course data
function exportCourseData() {
    const courseId = localStorage.getItem('selectedCourseId');
    const courseData = getCourseData(courseId);
    
    // Create CSV content
    let csvContent = 'Course Information\n';
    csvContent += `Title,${courseData.title}\n`;
    csvContent += `Description,${courseData.description}\n`;
    csvContent += `Total Students,${courseData.totalStudents}\n`;
    csvContent += `Average Attendance,${courseData.averageAttendance}%\n`;
    csvContent += `Total Assignments,${courseData.totalAssignments}\n`;
    csvContent += `Course Progress,${courseData.courseProgress}%\n`;
    csvContent += `Schedule,${courseData.schedule}\n`;
    csvContent += `Time,${courseData.time}\n`;
    csvContent += `Room,${courseData.room}\n`;
    csvContent += `Duration,${courseData.duration}\n`;
    csvContent += `Credits,${courseData.credits}\n`;
    
    // Download CSV file
    const blob = new Blob([csvContent], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `${courseData.title.replace(/\s+/g, '_')}_details.csv`;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);
    
    showSuccessMessage('Course data exported successfully!');
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

// Logout function
function logout() {
    if (confirm('Are you sure you want to logout?')) {
        // Clear all stored data
        localStorage.removeItem('isLoggedIn');
        localStorage.removeItem('userName');
        localStorage.removeItem('userType');
        localStorage.removeItem('userEmail');
        localStorage.removeItem('userId');
        localStorage.removeItem('selectedCourseId');
        
        // Show success message
        alert('تم تسجيل الخروج بنجاح!');
        
        // Redirect to login page
        window.location.href = '../login.html';
    }
}

// Export functions for use in other files
window.instructorCourseDetails = {
    selectCourse,
    markAttendance,
    createAssignment,
    viewAllStudents,
    exportCourseData,
    logout
};
