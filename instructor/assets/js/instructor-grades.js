// Instructor Grades Management JavaScript

// Global variables
let currentCourse = 'all';
let currentFilters = {
    search: '',
    assignment: 'all',
    grade: 'all',
    status: 'all'
};

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
    initializeGradesPage();
    setupEventListeners();
});

// Initialize grades page
function initializeGradesPage() {
    console.log('Grades page initialized');
    updateSummaryStats();
}

// Setup event listeners
function setupEventListeners() {
    // Search input
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            currentFilters.search = this.value;
            filterGrades();
        });
    }

    // Filter dropdowns
    const filters = ['assignmentFilter', 'gradeFilter', 'statusFilter'];
    filters.forEach(filterId => {
        const element = document.getElementById(filterId);
        if (element) {
            element.addEventListener('change', function() {
                const filterType = filterId.replace('Filter', '');
                currentFilters[filterType] = this.value;
                filterGrades();
            });
        }
    });
}

// Select course
function selectCourse(courseId, courseName) {
    currentCourse = courseId;
    document.getElementById('selectedCourse').textContent = courseName;
    filterGrades();
}

// Filter grades
function filterGrades() {
    const rows = document.querySelectorAll('#gradesTableBody tr');
    let visibleCount = 0;

    rows.forEach(row => {
        let showRow = true;

        // Course filter
        if (currentCourse !== 'all') {
            const rowCourse = row.getAttribute('data-course');
            if (rowCourse !== currentCourse.toString()) {
                showRow = false;
            }
        }

        // Search filter
        if (currentFilters.search && showRow) {
            const studentName = row.querySelector('h6').textContent.toLowerCase();
            const studentId = row.querySelector('small').textContent.toLowerCase();
            const searchTerm = currentFilters.search.toLowerCase();
            
            if (!studentName.includes(searchTerm) && !studentId.includes(searchTerm)) {
                showRow = false;
            }
        }

        // Assignment filter
        if (currentFilters.assignment !== 'all' && showRow) {
            const rowAssignment = row.getAttribute('data-assignment');
            if (rowAssignment !== currentFilters.assignment) {
                showRow = false;
            }
        }

        // Grade filter
        if (currentFilters.grade !== 'all' && showRow) {
            const rowGrade = row.getAttribute('data-grade');
            if (rowGrade !== currentFilters.grade) {
                showRow = false;
            }
        }

        // Status filter
        if (currentFilters.status !== 'all' && showRow) {
            const rowStatus = row.getAttribute('data-status');
            if (rowStatus !== currentFilters.status) {
                showRow = false;
            }
        }

        // Show/hide row
        if (showRow) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });

    console.log(`Showing ${visibleCount} grades`);
}

// Clear all filters
function clearFilters() {
    currentFilters = {
        search: '',
        assignment: 'all',
        grade: 'all',
        status: 'all'
    };

    // Reset form elements
    document.getElementById('searchInput').value = '';
    document.getElementById('assignmentFilter').value = 'all';
    document.getElementById('gradeFilter').value = 'all';
    document.getElementById('statusFilter').value = 'all';

    filterGrades();
}

// View student profile
function viewStudentProfile(studentId) {
    console.log(`Viewing profile for student: ${studentId}`);
    // Redirect to student details page
    window.location.href = `student-details.html?id=${studentId}`;
}

// Send message to student
function sendMessageToStudent(studentId) {
    console.log(`Sending message to student: ${studentId}`);
    // Open message modal or redirect to messaging page
    alert(`Opening message composer for student ${studentId}`);
}

// View grades for student
function viewGrades(studentId) {
    console.log(`Viewing grades for student: ${studentId}`);
    // Filter grades table to show only this student
    currentCourse = 'all';
    document.getElementById('selectedCourse').textContent = 'All Courses';
    filterGrades();
}

// View submission
function viewSubmission(assignmentId, studentId) {
    console.log(`Viewing submission for assignment ${assignmentId}, student ${studentId}`);
    // Open submission viewer modal
    alert(`Opening submission viewer for assignment ${assignmentId}, student ${studentId}`);
}

// Edit grade
function editGrade(assignmentId, studentId) {
    console.log(`Editing grade for assignment ${assignmentId}, student ${studentId}`);
    // Open grade editor modal
    const newGrade = prompt('Enter new grade (A+, A, B+, B, C+, C, D, F):');
    if (newGrade) {
        updateGrade(assignmentId, studentId, newGrade);
    }
}

// Add feedback
function addFeedback(assignmentId, studentId) {
    console.log(`Adding feedback for assignment ${assignmentId}, student ${studentId}`);
    // Open feedback modal
    const feedback = prompt('Enter feedback:');
    if (feedback) {
        console.log(`Feedback added: ${feedback}`);
    }
}

// Update grade
function updateGrade(assignmentId, studentId, grade) {
    console.log(`Updating grade for assignment ${assignmentId}, student ${studentId} to ${grade}`);
    
    // Find the row and update the grade
    const rows = document.querySelectorAll('#gradesTableBody tr');
    rows.forEach(row => {
        const rowAssignment = row.getAttribute('data-assignment');
        const studentIdElement = row.querySelector('small');
        if (studentIdElement) {
            const rowStudentId = studentIdElement.textContent;
            if (rowAssignment === assignmentId.toString() && rowStudentId === studentId.toString()) {
                // Update grade badge
                const gradeBadge = row.querySelector('.badge-success, .badge-warning');
                if (gradeBadge) {
                    gradeBadge.textContent = grade;
                    gradeBadge.className = getGradeBadgeClass(grade);
                }
                
                // Update data attribute
                row.setAttribute('data-grade', grade);
                
                // Update status to graded
                row.setAttribute('data-status', 'graded');
                const statusBadge = row.querySelector('td:nth-child(6) .badge');
                if (statusBadge) {
                    statusBadge.textContent = 'Graded';
                    statusBadge.className = 'badge badge-success';
                }
                
                // Update graded date
                const gradedDateCell = row.querySelector('td:nth-child(8)');
                if (gradedDateCell) {
                    gradedDateCell.textContent = new Date().toLocaleDateString();
                }
            }
        }
    });
    
    updateSummaryStats();
}

// Get grade badge class
function getGradeBadgeClass(grade) {
    switch(grade) {
        case 'A+':
        case 'A':
            return 'badge badge-success';
        case 'B+':
        case 'B':
            return 'badge badge-warning';
        case 'C+':
        case 'C':
        case 'D':
        case 'F':
            return 'badge badge-danger';
        default:
            return 'badge badge-secondary';
    }
}

// Export grades
function exportGrades() {
    console.log('Exporting grades...');
    // Implement grade export functionality
    alert('Exporting grades to CSV...');
}

// Bulk update grades
function bulkUpdateGrades() {
    console.log('Opening bulk grade update...');
    // Open bulk update modal
    alert('Opening bulk grade update modal...');
}

// Update summary statistics
function updateSummaryStats() {
    const rows = document.querySelectorAll('#gradesTableBody tr');
    let totalSubmissions = 0;
    let gradedSubmissions = 0;
    let pendingSubmissions = 0;
    let totalPoints = 0;
    let gradedCount = 0;

    rows.forEach(row => {
        if (row.style.display !== 'none') {
            totalSubmissions++;
            
            const status = row.getAttribute('data-status');
            if (status === 'graded') {
                gradedSubmissions++;
                
                // Calculate average points
                const pointsText = row.querySelector('td:nth-child(5)').textContent;
                const points = parseInt(pointsText.split('/')[0]);
                if (!isNaN(points)) {
                    totalPoints += points;
                    gradedCount++;
                }
            } else {
                pendingSubmissions++;
            }
        }
    });

    // Update summary display
    document.getElementById('totalSubmissions').textContent = totalSubmissions;
    document.getElementById('gradedSubmissions').textContent = gradedSubmissions;
    document.getElementById('pendingSubmissions').textContent = pendingSubmissions;
    
    if (gradedCount > 0) {
        const averagePoints = Math.round(totalPoints / gradedCount);
        document.getElementById('averagePoints').textContent = averagePoints;
    }
    
    const completionRate = totalSubmissions > 0 ? Math.round((gradedSubmissions / totalSubmissions) * 100) : 0;
    document.getElementById('completionRate').textContent = completionRate + '%';
}

// Logout function
function logout() {
    if (confirm('Are you sure you want to logout?')) {
        console.log('Logging out...');
        window.location.href = '../index.html';
    }
}
