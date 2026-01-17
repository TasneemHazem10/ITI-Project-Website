// Instructor Attendance JavaScript

// Initialize attendance page
document.addEventListener('DOMContentLoaded', function() {
    initializeAttendancePage();
    setupEventListeners();
    loadAttendanceData();
});

// Initialize attendance page
function initializeAttendancePage() {
    // Update instructor name (use default if not logged in)
    const instructorName = localStorage.getItem('userName') || 'Dr. Ahmed Mohamed';
    document.getElementById('instructorName').textContent = instructorName;
    
    // Set default date to today
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('attendanceDate').value = today;
    
    // Load attendance for today
    loadAttendanceForDate();
}

// Setup event listeners
function setupEventListeners() {
    // Attendance status change listeners
    const attendanceSelects = document.querySelectorAll('.attendance-status');
    attendanceSelects.forEach(select => {
        select.addEventListener('change', function() {
            updateAttendanceSummary();
            updateTimeField(this);
        });
    });
    
    // Time input listeners
    const timeInputs = document.querySelectorAll('input[type="time"]');
    timeInputs.forEach(input => {
        input.addEventListener('change', function() {
            const studentId = this.getAttribute('data-student-id');
            const statusSelect = document.querySelector(`select[data-student-id="${studentId}"]`);
            
            if (this.value && statusSelect.value === 'absent') {
                statusSelect.value = 'present';
                updateAttendanceSummary();
            }
        });
    });
}

// Load attendance data
function loadAttendanceData() {
    // Simulate loading attendance data
    const attendanceData = {
        courseId: 1,
        courseName: 'Web Development',
        date: new Date().toISOString().split('T')[0],
        sessionType: 'lecture',
        students: [
            {
                id: '2024001',
                name: 'Sarah Ahmed',
                email: 'sarah.ahmed@student.iti.gov.eg',
                status: 'present',
                time: '09:00'
            },
            {
                id: '2024002',
                name: 'Mohamed Ali',
                email: 'mohamed.ali@student.iti.gov.eg',
                status: 'absent',
                time: null
            },
            {
                id: '2024003',
                name: 'Ahmed Abdelrahman',
                email: 'ahmed.abdelrahman@student.iti.gov.eg',
                status: 'late',
                time: '09:15'
            },
            {
                id: '2024004',
                name: 'Fatma Hassan',
                email: 'fatma.hassan@student.iti.gov.eg',
                status: 'present',
                time: '08:55'
            },
            {
                id: '2024005',
                name: 'Omar Mohamed',
                email: 'omar.mohamed@student.iti.gov.eg',
                status: 'excused',
                time: null
            }
        ]
    };
    
    // Store attendance data
    localStorage.setItem('currentAttendance', JSON.stringify(attendanceData));
}

// Select course
function selectCourse(courseId, courseName) {
    document.getElementById('selectedCourse').textContent = courseName;
    localStorage.setItem('selectedCourseId', courseId);
    
    // Reload attendance data for selected course
    loadAttendanceForDate();
}

// Load attendance for selected date
function loadAttendanceForDate() {
    const date = document.getElementById('attendanceDate').value;
    const sessionType = document.getElementById('sessionType').value;
    
    // Simulate loading attendance for specific date and session
    console.log(`Loading attendance for ${date} - ${sessionType}`);
    
    // Update attendance summary
    updateAttendanceSummary();
}

// Update attendance summary
function updateAttendanceSummary() {
    const attendanceSelects = document.querySelectorAll('.attendance-status');
    let presentCount = 0;
    let absentCount = 0;
    let lateCount = 0;
    let excusedCount = 0;
    
    attendanceSelects.forEach(select => {
        switch(select.value) {
            case 'present':
                presentCount++;
                break;
            case 'absent':
                absentCount++;
                break;
            case 'late':
                lateCount++;
                break;
            case 'excused':
                excusedCount++;
                break;
        }
    });
    
    // Update summary counts
    document.getElementById('presentCount').textContent = presentCount;
    document.getElementById('absentCount').textContent = absentCount;
    document.getElementById('lateCount').textContent = lateCount;
    document.getElementById('excusedCount').textContent = excusedCount;
}

// Update time field based on attendance status
function updateTimeField(selectElement) {
    const studentId = selectElement.getAttribute('data-student-id');
    const timeInput = document.querySelector(`input[data-student-id="${studentId}"]`);
    
    if (selectElement.value === 'absent' || selectElement.value === 'excused') {
        timeInput.value = '';
        timeInput.disabled = true;
    } else {
        timeInput.disabled = false;
        if (!timeInput.value) {
            // Set current time if not set
            const now = new Date();
            const timeString = now.toTimeString().slice(0, 5);
            timeInput.value = timeString;
        }
    }
}

// Toggle attendance status
function toggleAttendance(studentId) {
    const selectElement = document.querySelector(`select[data-student-id="${studentId}"]`);
    const timeInput = document.querySelector(`input[data-student-id="${studentId}"]`);
    
    // Cycle through statuses
    const statuses = ['present', 'absent', 'late', 'excused'];
    const currentIndex = statuses.indexOf(selectElement.value);
    const nextIndex = (currentIndex + 1) % statuses.length;
    
    selectElement.value = statuses[nextIndex];
    updateTimeField(selectElement);
    updateAttendanceSummary();
}

// Mark all students as present
function markAllPresent() {
    const attendanceSelects = document.querySelectorAll('.attendance-status');
    const timeInputs = document.querySelectorAll('input[type="time"]');
    
    attendanceSelects.forEach(select => {
        select.value = 'present';
    });
    
    timeInputs.forEach(input => {
        if (!input.value) {
            const now = new Date();
            const timeString = now.toTimeString().slice(0, 5);
            input.value = timeString;
        }
        input.disabled = false;
    });
    
    updateAttendanceSummary();
}

// Save attendance
function saveAttendance() {
    const attendanceData = {
        courseId: localStorage.getItem('selectedCourseId') || 1,
        date: document.getElementById('attendanceDate').value,
        sessionType: document.getElementById('sessionType').value,
        students: []
    };
    
    // Collect attendance data
    const attendanceSelects = document.querySelectorAll('.attendance-status');
    const timeInputs = document.querySelectorAll('input[type="time"]');
    
    attendanceSelects.forEach(select => {
        const studentId = select.getAttribute('data-student-id');
        const timeInput = document.querySelector(`input[data-student-id="${studentId}"]`);
        const studentRow = select.closest('tr');
        const studentName = studentRow.querySelector('h6').textContent;
        const studentEmail = studentRow.cells[2].textContent;
        
        attendanceData.students.push({
            id: studentId,
            name: studentName,
            email: studentEmail,
            status: select.value,
            time: timeInput.value || null
        });
    });
    
    // Save to localStorage (in real app, this would be sent to server)
    localStorage.setItem('savedAttendance', JSON.stringify(attendanceData));
    
    // Show success message
    showSuccessMessage('Attendance saved successfully!');
    
    // Log attendance data
    console.log('Saved attendance:', attendanceData);
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

// Export attendance data
function exportAttendance() {
    const attendanceData = JSON.parse(localStorage.getItem('savedAttendance') || '{}');
    
    if (!attendanceData.students || attendanceData.students.length === 0) {
        alert('No attendance data to export. Please save attendance first.');
        return;
    }
    
    // Create CSV content
    let csvContent = 'Student ID,Student Name,Email,Status,Time\n';
    attendanceData.students.forEach(student => {
        csvContent += `${student.id},${student.name},${student.email},${student.status},${student.time || 'N/A'}\n`;
    });
    
    // Download CSV file
    const blob = new Blob([csvContent], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `attendance_${attendanceData.date}_${attendanceData.sessionType}.csv`;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);
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
        localStorage.removeItem('currentAttendance');
        localStorage.removeItem('savedAttendance');
        
        // Show success message
        alert('تم تسجيل الخروج بنجاح!');
        
        // Redirect to login page
        window.location.href = '../login.html';
    }
}

// Export functions for use in other files
window.instructorAttendance = {
    selectCourse,
    loadAttendanceForDate,
    updateAttendanceSummary,
    toggleAttendance,
    markAllPresent,
    saveAttendance,
    exportAttendance,
    logout
};
