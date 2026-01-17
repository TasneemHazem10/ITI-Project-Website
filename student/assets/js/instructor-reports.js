// Instructor Reports JavaScript

// Initialize reports page
document.addEventListener('DOMContentLoaded', function() {
    initializeReportsPage();
    setupEventListeners();
    loadReportsData();
});

// Initialize reports page
function initializeReportsPage() {
    // Update instructor name (use default if not logged in)
    const instructorName = localStorage.getItem('userName') || 'Dr. Ahmed Mohamed';
    document.getElementById('instructorName').textContent = instructorName;
}

// Setup event listeners
function setupEventListeners() {
    // Report buttons
    const reportButtons = document.querySelectorAll('.btn-instructor');
    reportButtons.forEach(button => {
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

// Load reports data
function loadReportsData() {
    // Simulate loading reports data
    const reportsData = {
        totalStudents: 119,
        averageAttendance: 92,
        totalAssignments: 25,
        activeCourses: 4,
        courseCompletion: 60,
        assignmentSubmission: 78,
        studentSatisfaction: 85
    };
    
    // Update quick stats
    updateQuickStats(reportsData);
}

// Update quick stats
function updateQuickStats(data) {
    // This function updates the quick stats section
    console.log('Updating quick stats:', data);
}

// Filter reports
function filterReports(filterType) {
    console.log('Filtering reports by:', filterType);
    
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

// Generate attendance report
function generateAttendanceReport() {
    const attendanceData = {
        course: 'All Courses',
        period: 'Current Semester',
        totalStudents: 119,
        averageAttendance: 92,
        attendanceBreakdown: {
            present: 85,
            absent: 8,
            late: 4,
            excused: 2
        },
        trends: {
            weekly: [94, 89, 96, 88, 92, 95, 90],
            monthly: [91, 93, 89, 95]
        }
    };
    
    showReportModal('Attendance Report', attendanceData);
}

// Generate grades report
function generateGradesReport() {
    const gradesData = {
        course: 'All Courses',
        period: 'Current Semester',
        totalStudents: 119,
        averageGrade: 'A',
        gradeDistribution: {
            'A+': 35,
            'A': 42,
            'B+': 28,
            'B': 12,
            'C': 2
        },
        trends: {
            improvement: '+5%',
            topPerformers: 15,
            needAttention: 8
        }
    };
    
    showReportModal('Grades Report', gradesData);
}

// Generate assignments report
function generateAssignmentsReport() {
    const assignmentsData = {
        course: 'All Courses',
        period: 'Current Semester',
        totalAssignments: 25,
        averageSubmission: 78,
        assignmentBreakdown: {
            completed: 18,
            pending: 5,
            overdue: 2
        },
        trends: {
            submissionRate: 78,
            averageScore: 85,
            lateSubmissions: 12
        }
    };
    
    showReportModal('Assignments Report', assignmentsData);
}

// Generate students report
function generateStudentsReport() {
    const studentsData = {
        course: 'All Courses',
        period: 'Current Semester',
        totalStudents: 119,
        activeStudents: 115,
        studentBreakdown: {
            excellent: 35,
            good: 42,
            average: 28,
            needsImprovement: 14
        },
        trends: {
            retention: 97,
            engagement: 89,
            satisfaction: 85
        }
    };
    
    showReportModal('Students Report', studentsData);
}

// Show report modal
function showReportModal(title, data) {
    // Create modal HTML
    const modalHTML = `
        <div class="modal fade" id="reportModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">${title}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Summary</h6>
                                <ul class="list-unstyled">
                                    ${Object.entries(data).filter(([key]) => !['breakdown', 'trends'].includes(key)).map(([key, value]) => 
                                        `<li><strong>${key.replace(/([A-Z])/g, ' $1').replace(/^./, str => str.toUpperCase())}:</strong> ${value}</li>`
                                    ).join('')}
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6>Details</h6>
                                <div class="text-muted">
                                    <p>This report shows comprehensive data for ${data.course || 'all courses'} during ${data.period || 'the current period'}.</p>
                                    <p>Generated on: ${new Date().toLocaleDateString()}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-instructor" onclick="exportReport('${title}', ${JSON.stringify(data)})">
                            <i class="fas fa-download me-1"></i>Export Report
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    // Remove existing modal if any
    const existingModal = document.getElementById('reportModal');
    if (existingModal) {
        existingModal.remove();
    }
    
    // Add modal to body
    document.body.insertAdjacentHTML('beforeend', modalHTML);
    
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('reportModal'));
    modal.show();
}

// Export report
function exportReport(title, data) {
    // Create CSV content
    let csvContent = `${title}\n\n`;
    csvContent += 'Summary\n';
    
    Object.entries(data).forEach(([key, value]) => {
        if (typeof value === 'object') {
            csvContent += `${key}\n`;
            Object.entries(value).forEach(([subKey, subValue]) => {
                csvContent += `  ${subKey},${subValue}\n`;
            });
        } else {
            csvContent += `${key},${value}\n`;
        }
    });
    
    csvContent += `\nGenerated on,${new Date().toLocaleDateString()}\n`;
    
    // Download CSV file
    const blob = new Blob([csvContent], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `${title.replace(/\s+/g, '_')}_${new Date().toISOString().split('T')[0]}.csv`;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);
    
    showSuccessMessage(`${title} exported successfully!`);
}

// Export all reports
function exportAllReports() {
    const allReports = {
        attendance: generateAttendanceReport(),
        grades: generateGradesReport(),
        assignments: generateAssignmentsReport(),
        students: generateStudentsReport()
    };
    
    // Create comprehensive CSV
    let csvContent = 'Comprehensive Reports Summary\n\n';
    csvContent += `Generated on,${new Date().toLocaleDateString()}\n`;
    csvContent += `Instructor,${document.getElementById('instructorName').textContent}\n\n`;
    
    csvContent += 'Overall Statistics\n';
    csvContent += 'Total Students,119\n';
    csvContent += 'Average Attendance,92%\n';
    csvContent += 'Total Assignments,25\n';
    csvContent += 'Active Courses,4\n';
    csvContent += 'Course Completion,60%\n';
    csvContent += 'Assignment Submission,78%\n';
    csvContent += 'Student Satisfaction,85%\n';
    
    // Download CSV file
    const blob = new Blob([csvContent], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `All_Reports_${new Date().toISOString().split('T')[0]}.csv`;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);
    
    showSuccessMessage('All reports exported successfully!');
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
        
        // Show success message
        alert('تم تسجيل الخروج بنجاح!');
        
        // Redirect to login page
        window.location.href = '../login.html';
    }
}

// Export functions for use in other files
window.instructorReports = {
    filterReports,
    generateAttendanceReport,
    generateGradesReport,
    generateAssignmentsReport,
    generateStudentsReport,
    exportAllReports,
    logout
};
