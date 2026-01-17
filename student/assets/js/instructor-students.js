// Instructor Students JavaScript

// Initialize students page
document.addEventListener('DOMContentLoaded', function() {
    initializeStudentsPage();
    setupEventListeners();
    loadStudentsData();
});

// Initialize students page
function initializeStudentsPage() {
    // Update instructor name (use default if not logged in)
    const instructorName = localStorage.getItem('userName') || 'Dr. Ahmed Mohamed';
    document.getElementById('instructorName').textContent = instructorName;
}

// Setup event listeners
function setupEventListeners() {
    // Action buttons
    const actionButtons = document.querySelectorAll('.btn-group button');
    actionButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            // Add loading state
            const originalHTML = this.innerHTML;
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            this.disabled = true;
            
            // Simulate loading
            setTimeout(() => {
                this.innerHTML = originalHTML;
                this.disabled = false;
            }, 1000);
        });
    });
}

// Load students data
function loadStudentsData() {
    // Simulate loading students data
    const studentsData = [
        {
            id: '2024001',
            name: 'Sarah Ahmed',
            email: 'sarah.ahmed@student.iti.gov.eg',
            course: 'Web Development',
            courseId: 1,
            status: 'active',
            year: '2024',
            attendance: 94,
            grade: 'A+'
        },
        {
            id: '2024002',
            name: 'Mohamed Ali',
            email: 'mohamed.ali@student.iti.gov.eg',
            course: 'Web Development',
            courseId: 1,
            status: 'active',
            year: '2024',
            attendance: 89,
            grade: 'A'
        },
        {
            id: '2024003',
            name: 'Ahmed Abdelrahman',
            email: 'ahmed.abdelrahman@student.iti.gov.eg',
            course: 'Data Science',
            courseId: 2,
            status: 'active',
            year: '2024',
            attendance: 92,
            grade: 'A+'
        },
        {
            id: '2024004',
            name: 'Fatma Hassan',
            email: 'fatma.hassan@student.iti.gov.eg',
            course: 'Web Development',
            courseId: 1,
            status: 'active',
            year: '2024',
            attendance: 96,
            grade: 'A+'
        },
        {
            id: '2024005',
            name: 'Omar Mohamed',
            email: 'omar.mohamed@student.iti.gov.eg',
            course: 'Cybersecurity',
            courseId: 4,
            status: 'active',
            year: '2024',
            attendance: 88,
            grade: 'A'
        }
    ];
    
    // Store students data
    localStorage.setItem('instructorStudents', JSON.stringify(studentsData));
}

// Select course filter
function selectCourse(courseId, courseName) {
    document.getElementById('selectedCourse').textContent = courseName;
    localStorage.setItem('selectedCourseId', courseId);
    
    // Filter students by course
    filterStudents();
}

// Filter students based on search and filters
function filterStudents() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const statusFilter = document.getElementById('statusFilter').value;
    const yearFilter = document.getElementById('yearFilter').value;
    const selectedCourseId = localStorage.getItem('selectedCourseId');
    
    const tableRows = document.querySelectorAll('#studentsTableBody tr');
    let visibleCount = 0;
    
    tableRows.forEach(row => {
        const studentName = row.querySelector('h6').textContent.toLowerCase();
        const studentEmail = row.cells[2].textContent.toLowerCase();
        const studentStatus = row.getAttribute('data-status');
        const studentYear = row.getAttribute('data-year');
        const studentCourse = row.getAttribute('data-course');
        
        let showRow = true;
        
        // Search filter
        if (searchTerm && !studentName.includes(searchTerm) && !studentEmail.includes(searchTerm)) {
            showRow = false;
        }
        
        // Status filter
        if (statusFilter !== 'all' && studentStatus !== statusFilter) {
            showRow = false;
        }
        
        // Year filter
        if (yearFilter !== 'all' && studentYear !== yearFilter) {
            showRow = false;
        }
        
        // Course filter
        if (selectedCourseId && selectedCourseId !== 'all' && studentCourse !== selectedCourseId) {
            showRow = false;
        }
        
        if (showRow) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });
    
    // Update summary counts
    updateSummaryCounts();
}

// Clear all filters
function clearFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('statusFilter').value = 'all';
    document.getElementById('yearFilter').value = 'all';
    document.getElementById('selectedCourse').textContent = 'All Courses';
    localStorage.removeItem('selectedCourseId');
    
    // Show all rows
    const tableRows = document.querySelectorAll('#studentsTableBody tr');
    tableRows.forEach(row => {
        row.style.display = '';
    });
    
    updateSummaryCounts();
}

// Update summary counts
function updateSummaryCounts() {
    const visibleRows = document.querySelectorAll('#studentsTableBody tr:not([style*="display: none"])');
    const totalStudents = visibleRows.length;
    
    let activeStudents = 0;
    let totalAttendance = 0;
    let gradeCount = 0;
    
    visibleRows.forEach(row => {
        const status = row.getAttribute('data-status');
        if (status === 'active') {
            activeStudents++;
        }
        
        // Calculate average attendance
        const attendanceText = row.querySelector('.progress-instructor + small').textContent;
        const attendance = parseInt(attendanceText.replace('%', ''));
        if (!isNaN(attendance)) {
            totalAttendance += attendance;
            gradeCount++;
        }
    });
    
    const averageAttendance = gradeCount > 0 ? Math.round(totalAttendance / gradeCount) : 0;
    
    // Update summary display
    document.getElementById('totalStudents').textContent = totalStudents;
    document.getElementById('activeStudents').textContent = activeStudents;
    document.getElementById('averageAttendance').textContent = averageAttendance + '%';
    document.getElementById('averageGrade').textContent = 'A+'; // Default average grade
}

// View student profile
function viewStudentProfile(studentId) {
    // Store selected student ID
    localStorage.setItem('selectedStudentId', studentId);
    
    // Navigate to student details page
    window.location.href = `student-details.html?id=${studentId}`;
}

// Send message to student
function sendMessageToStudent(studentId) {
    const studentName = getStudentName(studentId);
    const message = prompt(`Send message to ${studentName}:`);
    
    if (message) {
        // Simulate sending message
        showSuccessMessage(`Message sent to ${studentName} successfully!`);
        console.log(`Message to ${studentId}: ${message}`);
    }
}

// Send message to all students
function sendMessage() {
    const message = prompt('Send message to all students:');
    
    if (message) {
        // Simulate sending message to all students
        showSuccessMessage('Message sent to all students successfully!');
        console.log(`Broadcast message: ${message}`);
    }
}

// View student grades
function viewGrades(studentId) {
    // Store selected student ID
    localStorage.setItem('selectedStudentId', studentId);
    
    // Navigate to grades page
    window.location.href = `grades.html?student=${studentId}`;
}

// Export students list
function exportStudents() {
    const studentsData = JSON.parse(localStorage.getItem('instructorStudents') || '[]');
    
    if (studentsData.length === 0) {
        alert('No students data to export.');
        return;
    }
    
    // Create CSV content
    let csvContent = 'Student ID,Student Name,Email,Course,Status,Attendance,Grade\n';
    studentsData.forEach(student => {
        csvContent += `${student.id},${student.name},${student.email},${student.course},${student.status},${student.attendance}%,${student.grade}\n`;
    });
    
    // Download CSV file
    const blob = new Blob([csvContent], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `students_list_${new Date().toISOString().split('T')[0]}.csv`;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);
    
    showSuccessMessage('Students list exported successfully!');
}

// Get student name by ID
function getStudentName(studentId) {
    const studentsData = JSON.parse(localStorage.getItem('instructorStudents') || '[]');
    const student = studentsData.find(s => s.id === studentId.toString());
    return student ? student.name : 'Unknown Student';
}

// Show success message
function showSuccessMessage(message) {
    // Create success alert
    const alertDiv = document.createElement('div');
    alertDiv.className = 'alert alert-success alert-dismissible fade show position-fixed';
    alertDiv.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    alertDiv.innerHTML = `
        <i class="fas fa-check-circle me-2"></i>${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(alertDiv);
    
    // Auto remove after 3 seconds
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
        localStorage.removeItem('selectedStudentId');
        localStorage.removeItem('instructorStudents');
        
        // Show success message
        alert('تم تسجيل الخروج بنجاح!');
        
        // Redirect to login page
        window.location.href = '../login.html';
    }
}

// Export functions for use in other files
window.instructorStudents = {
    selectCourse,
    filterStudents,
    clearFilters,
    viewStudentProfile,
    sendMessageToStudent,
    sendMessage,
    viewGrades,
    exportStudents,
    logout
};
