// Instructor Courses JavaScript

// Initialize courses page
document.addEventListener('DOMContentLoaded', function() {
    initializeCoursesPage();
    loadCoursesData();
    setupEventListeners();
});

// Initialize courses page
function initializeCoursesPage() {
    // Update instructor name (use default if not logged in)
    const instructorName = localStorage.getItem('userName') || 'Dr. Ahmed Mohamed';
    document.getElementById('instructorName').textContent = instructorName;
}

// Load courses data
function loadCoursesData() {
    // Simulate loading courses data
    const coursesData = [
        {
            id: 1,
            name: 'Web Development',
            students: 32,
            schedule: 'Mon, Wed, Fri',
            progress: 75,
            attendance: 94,
            assignments: 8,
            status: 'active'
        },
        {
            id: 2,
            name: 'Data Science',
            students: 28,
            schedule: 'Tue, Thu',
            progress: 60,
            attendance: 89,
            assignments: 5,
            status: 'active'
        },
        {
            id: 3,
            name: 'Mobile Development',
            students: 24,
            schedule: 'Mon, Wed',
            progress: 15,
            attendance: 0,
            assignments: 0,
            status: 'starting'
        },
        {
            id: 4,
            name: 'Cybersecurity',
            students: 35,
            schedule: 'Tue, Thu, Sat',
            progress: 90,
            attendance: 96,
            assignments: 12,
            status: 'active'
        }
    ];
    
    // Store courses data
    localStorage.setItem('instructorCourses', JSON.stringify(coursesData));
}

// Setup event listeners
function setupEventListeners() {
    // Course action buttons
    const courseButtons = document.querySelectorAll('.course-card button');
    courseButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            // Add loading state
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Loading...';
            this.disabled = true;
            
            // Simulate loading
            setTimeout(() => {
                this.innerHTML = originalText;
                this.disabled = false;
            }, 1000);
        });
    });
}

// Filter courses by status
function filterCourses(status) {
    const coursesGrid = document.getElementById('coursesGrid');
    const courseCards = coursesGrid.querySelectorAll('.course-card');
    
    courseCards.forEach(card => {
        const badge = card.querySelector('.badge');
        const cardStatus = badge.textContent.toLowerCase();
        
        if (status === 'all' || cardStatus.includes(status)) {
            card.parentElement.style.display = 'block';
        } else {
            card.parentElement.style.display = 'none';
        }
    });
    
    // Update filter buttons
    const filterButtons = document.querySelectorAll('.btn-outline-instructor');
    filterButtons.forEach(button => {
        button.classList.remove('btn-instructor');
        button.classList.add('btn-outline-instructor');
    });
    
    // Highlight active filter
    event.target.classList.remove('btn-outline-instructor');
    event.target.classList.add('btn-instructor');
}

// View course details
function viewCourseDetails(courseId) {
    // Store selected course ID
    localStorage.setItem('selectedCourseId', courseId);
    
    // Navigate to course details page
    window.location.href = `course-details.html?id=${courseId}`;
}

// Mark attendance for a course
function markAttendance(courseId) {
    // Store selected course ID
    localStorage.setItem('selectedCourseId', courseId);
    
    // Navigate to attendance page
    window.location.href = `attendance.html?course=${courseId}`;
}

// Grade assignments for a course
function gradeAssignments(courseId) {
    // Store selected course ID
    localStorage.setItem('selectedCourseId', courseId);
    
    // Navigate to grades page
    window.location.href = `grades.html?course=${courseId}`;
}

// Create assignment for a course
function createAssignment(courseId) {
    // Store selected course ID
    localStorage.setItem('selectedCourseId', courseId);
    
    // Navigate to create assignment page
    window.location.href = `create-assignment.html?course=${courseId}`;
}

// View students for a course
function viewStudents(courseId) {
    // Store selected course ID
    localStorage.setItem('selectedCourseId', courseId);
    
    // Navigate to students page
    window.location.href = `students.html?course=${courseId}`;
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
        localStorage.removeItem('instructorCourses');
        localStorage.removeItem('selectedCourseId');
        
        // Show success message
        alert('تم تسجيل الخروج بنجاح!');
        
        // Redirect to login page
        window.location.href = '../login.html';
    }
}

// Get course data by ID
function getCourseById(courseId) {
    const coursesData = JSON.parse(localStorage.getItem('instructorCourses') || '[]');
    return coursesData.find(course => course.id === courseId);
}

// Update course progress
function updateCourseProgress(courseId, progress) {
    const coursesData = JSON.parse(localStorage.getItem('instructorCourses') || '[]');
    const courseIndex = coursesData.findIndex(course => course.id === courseId);
    
    if (courseIndex !== -1) {
        coursesData[courseIndex].progress = progress;
        localStorage.setItem('instructorCourses', JSON.stringify(coursesData));
        
        // Update UI
        updateCourseProgressUI(courseId, progress);
    }
}

// Update course progress UI
function updateCourseProgressUI(courseId, progress) {
    const courseCard = document.querySelector(`[onclick*="viewCourseDetails(${courseId})"]`).closest('.course-card');
    if (courseCard) {
        const progressBar = courseCard.querySelector('.progress-bar-instructor');
        const progressText = courseCard.querySelector('.text-muted');
        
        if (progressBar) {
            progressBar.style.width = `${progress}%`;
        }
        
        if (progressText) {
            progressText.textContent = `${progress}% Complete`;
        }
    }
}

// Export functions for use in other files
window.instructorCourses = {
    filterCourses,
    viewCourseDetails,
    markAttendance,
    gradeAssignments,
    createAssignment,
    viewStudents,
    logout,
    getCourseById,
    updateCourseProgress
};
