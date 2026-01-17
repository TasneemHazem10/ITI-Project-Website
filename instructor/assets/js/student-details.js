// Student Details Page JavaScript

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
    initializeStudentDetails();
});

function initializeStudentDetails() {
    // Get student data from URL parameters or localStorage
    const urlParams = new URLSearchParams(window.location.search);
    const studentId = urlParams.get('id') || localStorage.getItem('selectedStudentId') || '2024001';
    
    // Load student data
    loadStudentData(studentId);
    
    // Set up event listeners
    setupEventListeners();
}

function loadStudentData(studentId) {
    // Simulated student data - in real app, this would come from API
    const studentData = getStudentData(studentId);
    
    if (studentData) {
        // Update student info
        document.getElementById('studentName').textContent = studentData.name;
        document.getElementById('studentEmail').textContent = studentData.email;
        document.getElementById('studentId').textContent = `ID: ${studentData.id}`;
        
        // Update stats
        document.getElementById('attendanceDays').textContent = `${studentData.attendance.present}/${studentData.attendance.total}`;
        document.getElementById('submittedTasks').textContent = `${studentData.assignments.submitted}/${studentData.assignments.total}`;
        document.getElementById('averageGrade').textContent = `${studentData.averageGrade}%`;
        document.getElementById('punctuality').textContent = `${studentData.punctuality}%`;
        
        // Update attendance history
        updateAttendanceHistory(studentData.attendanceHistory);
        
        // Update assignment submissions
        updateAssignmentSubmissions(studentData.assignmentSubmissions);
        
        // Update progress bars
        updateProgressBars(studentData);
    }
}

function getStudentData(studentId) {
    // Simulated data - in real app, this would be fetched from API
    const studentsData = {
        '2024001': {
            id: '2024001',
            name: 'Sarah Ahmed',
            email: 'sarah.ahmed@student.iti.gov.eg',
            attendance: {
                present: 18,
                total: 20,
                rate: 90
            },
            assignments: {
                submitted: 8,
                total: 10,
                rate: 80
            },
            averageGrade: 85,
            punctuality: 92,
            attendanceHistory: [
                { date: '2024-01-15', status: 'present', time: '09:00' },
                { date: '2024-01-14', status: 'late', time: '09:15' },
                { date: '2024-01-13', status: 'present', time: '08:55' },
                { date: '2024-01-12', status: 'absent', time: '--:--' },
                { date: '2024-01-11', status: 'present', time: '09:00' },
                { date: '2024-01-10', status: 'present', time: '09:00' },
                { date: '2024-01-09', status: 'late', time: '09:10' },
                { date: '2024-01-08', status: 'present', time: '08:50' },
                { date: '2024-01-07', status: 'present', time: '09:00' },
                { date: '2024-01-06', status: 'absent', time: '--:--' }
            ],
            assignmentSubmissions: [
                { name: 'HTML Project', status: 'submitted', grade: 90 },
                { name: 'CSS Styling', status: 'submitted', grade: 85 },
                { name: 'JavaScript Functions', status: 'pending', grade: null },
                { name: 'React Components', status: 'submitted', grade: 88 },
                { name: 'Final Project', status: 'not_submitted', grade: null },
                { name: 'Database Design', status: 'submitted', grade: 92 },
                { name: 'API Integration', status: 'submitted', grade: 87 },
                { name: 'Testing & Debugging', status: 'submitted', grade: 89 },
                { name: 'Documentation', status: 'pending', grade: null },
                { name: 'Presentation', status: 'not_submitted', grade: null }
            ]
        },
        '2024002': {
            id: '2024002',
            name: 'Mohamed Ali',
            email: 'mohamed.ali@student.iti.gov.eg',
            attendance: {
                present: 15,
                total: 20,
                rate: 75
            },
            assignments: {
                submitted: 6,
                total: 10,
                rate: 60
            },
            averageGrade: 78,
            punctuality: 85,
            attendanceHistory: [
                { date: '2024-01-15', status: 'absent', time: '--:--' },
                { date: '2024-01-14', status: 'present', time: '09:00' },
                { date: '2024-01-13', status: 'late', time: '09:20' },
                { date: '2024-01-12', status: 'present', time: '08:55' },
                { date: '2024-01-11', status: 'absent', time: '--:--' },
                { date: '2024-01-10', status: 'present', time: '09:00' },
                { date: '2024-01-09', status: 'late', time: '09:25' },
                { date: '2024-01-08', status: 'present', time: '08:50' },
                { date: '2024-01-07', status: 'absent', time: '--:--' },
                { date: '2024-01-06', status: 'present', time: '09:00' }
            ],
            assignmentSubmissions: [
                { name: 'HTML Project', status: 'submitted', grade: 75 },
                { name: 'CSS Styling', status: 'submitted', grade: 80 },
                { name: 'JavaScript Functions', status: 'not_submitted', grade: null },
                { name: 'React Components', status: 'submitted', grade: 82 },
                { name: 'Final Project', status: 'not_submitted', grade: null },
                { name: 'Database Design', status: 'submitted', grade: 78 },
                { name: 'API Integration', status: 'not_submitted', grade: null },
                { name: 'Testing & Debugging', status: 'submitted', grade: 85 },
                { name: 'Documentation', status: 'not_submitted', grade: null },
                { name: 'Presentation', status: 'not_submitted', grade: null }
            ]
        },
        '2024003': {
            id: '2024003',
            name: 'Ahmed Abdelrahman',
            email: 'ahmed.abdelrahman@student.iti.gov.eg',
            attendance: {
                present: 19,
                total: 20,
                rate: 95
            },
            assignments: {
                submitted: 9,
                total: 10,
                rate: 90
            },
            averageGrade: 92,
            punctuality: 88,
            attendanceHistory: [
                { date: '2024-01-15', status: 'late', time: '09:15' },
                { date: '2024-01-14', status: 'present', time: '09:00' },
                { date: '2024-01-13', status: 'present', time: '08:55' },
                { date: '2024-01-12', status: 'present', time: '09:00' },
                { date: '2024-01-11', status: 'present', time: '08:50' }
            ],
            assignmentSubmissions: [
                { name: 'HTML Project', status: 'submitted', grade: 95 },
                { name: 'CSS Styling', status: 'submitted', grade: 90 },
                { name: 'JavaScript Functions', status: 'submitted', grade: 88 },
                { name: 'React Components', status: 'submitted', grade: 92 },
                { name: 'Final Project', status: 'submitted', grade: 94 },
                { name: 'Database Design', status: 'submitted', grade: 89 },
                { name: 'API Integration', status: 'submitted', grade: 91 },
                { name: 'Testing & Debugging', status: 'submitted', grade: 93 },
                { name: 'Documentation', status: 'submitted', grade: 87 },
                { name: 'Presentation', status: 'pending', grade: null }
            ]
        },
        '2024004': {
            id: '2024004',
            name: 'Fatma Hassan',
            email: 'fatma.hassan@student.iti.gov.eg',
            attendance: {
                present: 20,
                total: 20,
                rate: 100
            },
            assignments: {
                submitted: 10,
                total: 10,
                rate: 100
            },
            averageGrade: 96,
            punctuality: 100,
            attendanceHistory: [
                { date: '2024-01-15', status: 'present', time: '08:55' },
                { date: '2024-01-14', status: 'present', time: '09:00' },
                { date: '2024-01-13', status: 'present', time: '08:50' },
                { date: '2024-01-12', status: 'present', time: '09:00' },
                { date: '2024-01-11', status: 'present', time: '08:55' }
            ],
            assignmentSubmissions: [
                { name: 'HTML Project', status: 'submitted', grade: 98 },
                { name: 'CSS Styling', status: 'submitted', grade: 95 },
                { name: 'JavaScript Functions', status: 'submitted', grade: 94 },
                { name: 'React Components', status: 'submitted', grade: 97 },
                { name: 'Final Project', status: 'submitted', grade: 96 },
                { name: 'Database Design', status: 'submitted', grade: 93 },
                { name: 'API Integration', status: 'submitted', grade: 95 },
                { name: 'Testing & Debugging', status: 'submitted', grade: 98 },
                { name: 'Documentation', status: 'submitted', grade: 92 },
                { name: 'Presentation', status: 'submitted', grade: 94 }
            ]
        },
        '2024005': {
            id: '2024005',
            name: 'Omar Mohamed',
            email: 'omar.mohamed@student.iti.gov.eg',
            attendance: {
                present: 12,
                total: 20,
                rate: 60
            },
            assignments: {
                submitted: 4,
                total: 10,
                rate: 40
            },
            averageGrade: 65,
            punctuality: 70,
            attendanceHistory: [
                { date: '2024-01-15', status: 'excused', time: '--:--' },
                { date: '2024-01-14', status: 'absent', time: '--:--' },
                { date: '2024-01-13', status: 'present', time: '09:00' },
                { date: '2024-01-12', status: 'absent', time: '--:--' },
                { date: '2024-01-11', status: 'present', time: '09:00' }
            ],
            assignmentSubmissions: [
                { name: 'HTML Project', status: 'submitted', grade: 70 },
                { name: 'CSS Styling', status: 'submitted', grade: 65 },
                { name: 'JavaScript Functions', status: 'not_submitted', grade: null },
                { name: 'React Components', status: 'not_submitted', grade: null },
                { name: 'Final Project', status: 'not_submitted', grade: null },
                { name: 'Database Design', status: 'submitted', grade: 68 },
                { name: 'API Integration', status: 'not_submitted', grade: null },
                { name: 'Testing & Debugging', status: 'not_submitted', grade: null },
                { name: 'Documentation', status: 'not_submitted', grade: null },
                { name: 'Presentation', status: 'not_submitted', grade: null }
            ]
        }
    };
    
    return studentsData[studentId] || studentsData['2024001'];
}

function updateAttendanceHistory(attendanceHistory) {
    const tbody = document.getElementById('attendanceHistory');
    tbody.innerHTML = '';
    
    attendanceHistory.forEach(record => {
        const row = document.createElement('tr');
        
        let statusBadge = '';
        switch(record.status) {
            case 'present':
                statusBadge = '<span class="badge bg-success">Present</span>';
                break;
            case 'late':
                statusBadge = '<span class="badge bg-warning">Late</span>';
                break;
            case 'absent':
                statusBadge = '<span class="badge bg-danger">Absent</span>';
                break;
            case 'excused':
                statusBadge = '<span class="badge bg-info">Excused</span>';
                break;
        }
        
        row.innerHTML = `
            <td>${record.date}</td>
            <td>${statusBadge}</td>
            <td>${record.time}</td>
        `;
        
        tbody.appendChild(row);
    });
}

function updateAssignmentSubmissions(assignmentSubmissions) {
    const tbody = document.getElementById('assignmentSubmissions');
    tbody.innerHTML = '';
    
    assignmentSubmissions.forEach(assignment => {
        const row = document.createElement('tr');
        
        let statusBadge = '';
        switch(assignment.status) {
            case 'submitted':
                statusBadge = '<span class="badge bg-success">Submitted</span>';
                break;
            case 'pending':
                statusBadge = '<span class="badge bg-warning">Pending</span>';
                break;
            case 'not_submitted':
                statusBadge = '<span class="badge bg-danger">Not Submitted</span>';
                break;
        }
        
        const grade = assignment.grade ? `${assignment.grade}%` : '--';
        
        row.innerHTML = `
            <td>${assignment.name}</td>
            <td>${statusBadge}</td>
            <td>${grade}</td>
        `;
        
        tbody.appendChild(row);
    });
}

function updateProgressBars(studentData) {
    // Update attendance rate progress bar
    const attendanceBar = document.querySelector('.progress-bar[aria-valuenow="90"]');
    if (attendanceBar) {
        attendanceBar.style.width = `${studentData.attendance.rate}%`;
        attendanceBar.setAttribute('aria-valuenow', studentData.attendance.rate);
        attendanceBar.textContent = `${studentData.attendance.rate}%`;
    }
    
    // Update assignment completion progress bar
    const assignmentBar = document.querySelector('.progress-bar[aria-valuenow="80"]');
    if (assignmentBar) {
        assignmentBar.style.width = `${studentData.assignments.rate}%`;
        assignmentBar.setAttribute('aria-valuenow', studentData.assignments.rate);
        assignmentBar.textContent = `${studentData.assignments.rate}%`;
    }
    
    // Update punctuality progress bar
    const punctualityBar = document.querySelector('.progress-bar[aria-valuenow="92"]');
    if (punctualityBar) {
        punctualityBar.style.width = `${studentData.punctuality}%`;
        punctualityBar.setAttribute('aria-valuenow', studentData.punctuality);
        punctualityBar.textContent = `${studentData.punctuality}%`;
    }
    
    // Update overall grade progress bar
    const gradeBar = document.querySelector('.progress-bar[aria-valuenow="85"]');
    if (gradeBar) {
        gradeBar.style.width = `${studentData.averageGrade}%`;
        gradeBar.setAttribute('aria-valuenow', studentData.averageGrade);
        gradeBar.textContent = `${studentData.averageGrade}%`;
    }
}

function setupEventListeners() {
    // Add any additional event listeners here
    console.log('Student details page initialized');
}

// Export functions for external use
window.loadStudentData = loadStudentData;
window.getStudentData = getStudentData;
