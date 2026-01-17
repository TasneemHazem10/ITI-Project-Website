// Instructor Assignments JavaScript

// Initialize assignments page
document.addEventListener('DOMContentLoaded', function() {
    initializeAssignmentsPage();
    setupEventListeners();
    loadAssignmentsData();
});

// Initialize assignments page
function initializeAssignmentsPage() {
    // Update instructor name (use default if not logged in)
    const instructorName = localStorage.getItem('userName') || 'Dr. Ahmed Mohamed';
    document.getElementById('instructorName').textContent = instructorName;
}

// Setup event listeners
function setupEventListeners() {
    // Assignment action buttons
    const actionButtons = document.querySelectorAll('.assignment-card button');
    actionButtons.forEach(button => {
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

// Load assignments data
function loadAssignmentsData() {
    // Simulate loading assignments data
    const assignmentsData = [
        {
            id: 1,
            title: 'Web Development Project',
            course: 'Web Development',
            courseId: 1,
            description: 'Create a responsive website using HTML, CSS, and JavaScript with modern design principles.',
            dueDate: '2024-12-20',
            status: 'active',
            totalStudents: 32,
            submittedStudents: 28,
            progress: 87
        },
        {
            id: 2,
            title: 'Data Analysis Report',
            course: 'Data Science',
            courseId: 2,
            description: 'Analyze the provided dataset and create a comprehensive report with visualizations.',
            dueDate: '2024-12-25',
            status: 'pending',
            totalStudents: 28,
            submittedStudents: 15,
            progress: 54
        },
        {
            id: 3,
            title: 'Mobile App Prototype',
            course: 'Mobile Development',
            courseId: 3,
            description: 'Design and prototype a mobile application using React Native.',
            dueDate: '2024-12-15',
            status: 'overdue',
            totalStudents: 24,
            submittedStudents: 18,
            progress: 75
        },
        {
            id: 4,
            title: 'Security Assessment',
            course: 'Cybersecurity',
            courseId: 4,
            description: 'Perform a comprehensive security assessment of a given system.',
            dueDate: '2024-12-10',
            status: 'graded',
            totalStudents: 35,
            submittedStudents: 35,
            progress: 100
        }
    ];
    
    // Store assignments data
    localStorage.setItem('instructorAssignments', JSON.stringify(assignmentsData));
}

// Filter assignments by status
function filterAssignments(status) {
    const assignmentsGrid = document.getElementById('assignmentsGrid');
    const assignmentCards = assignmentsGrid.querySelectorAll('.assignment-card');
    
    assignmentCards.forEach(card => {
        const statusBadge = card.querySelector('.assignment-status');
        const cardStatus = statusBadge.textContent.toLowerCase();
        
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

// View assignment details
function viewAssignment(assignmentId) {
    // Store selected assignment ID
    localStorage.setItem('selectedAssignmentId', assignmentId);
    
    // Navigate to assignment details page
    window.location.href = `assignment-details.html?id=${assignmentId}`;
}

// Grade assignment
function gradeAssignment(assignmentId) {
    // Store selected assignment ID
    localStorage.setItem('selectedAssignmentId', assignmentId);
    
    // Navigate to grading page
    window.location.href = `grade-assignment.html?id=${assignmentId}`;
}

// Create new assignment
function createAssignment() {
    // Navigate to create assignment page
    window.location.href = 'create-assignment.html';
}

// Edit assignment
function editAssignment(assignmentId) {
    // Store selected assignment ID
    localStorage.setItem('selectedAssignmentId', assignmentId);
    
    // Navigate to edit assignment page
    window.location.href = `edit-assignment.html?id=${assignmentId}`;
}

// Delete assignment
function deleteAssignment(assignmentId) {
    if (confirm('Are you sure you want to delete this assignment? This action cannot be undone.')) {
        // Remove assignment from data
        const assignmentsData = JSON.parse(localStorage.getItem('instructorAssignments') || '[]');
        const updatedAssignments = assignmentsData.filter(assignment => assignment.id !== assignmentId);
        localStorage.setItem('instructorAssignments', JSON.stringify(updatedAssignments));
        
        // Remove assignment card from UI
        const assignmentCard = document.querySelector(`[onclick*="viewAssignment(${assignmentId})"]`).closest('.assignment-card').parentElement;
        if (assignmentCard) {
            assignmentCard.remove();
        }
        
        showSuccessMessage('Assignment deleted successfully!');
    }
}

// Get assignment by ID
function getAssignmentById(assignmentId) {
    const assignmentsData = JSON.parse(localStorage.getItem('instructorAssignments') || '[]');
    return assignmentsData.find(assignment => assignment.id === assignmentId);
}

// Update assignment progress
function updateAssignmentProgress(assignmentId, submittedCount) {
    const assignmentsData = JSON.parse(localStorage.getItem('instructorAssignments') || '[]');
    const assignmentIndex = assignmentsData.findIndex(assignment => assignment.id === assignmentId);
    
    if (assignmentIndex !== -1) {
        const assignment = assignmentsData[assignmentIndex];
        assignment.submittedStudents = submittedCount;
        assignment.progress = Math.round((submittedCount / assignment.totalStudents) * 100);
        
        localStorage.setItem('instructorAssignments', JSON.stringify(assignmentsData));
        
        // Update UI
        updateAssignmentProgressUI(assignmentId, submittedCount, assignment.progress);
    }
}

// Update assignment progress UI
function updateAssignmentProgressUI(assignmentId, submittedCount, progress) {
    const assignmentCard = document.querySelector(`[onclick*="viewAssignment(${assignmentId})"]`).closest('.assignment-card');
    if (assignmentCard) {
        // Update submitted count
        const submittedElement = assignmentCard.querySelector('.text-success');
        if (submittedElement) {
            submittedElement.textContent = submittedCount;
        }
        
        // Update progress bar
        const progressBar = assignmentCard.querySelector('.progress-bar-instructor');
        if (progressBar) {
            progressBar.style.width = `${progress}%`;
        }
        
        // Update progress text
        const progressText = assignmentCard.querySelector('.text-muted:last-child');
        if (progressText) {
            progressText.textContent = `${progress}% Complete`;
        }
    }
}

// Export assignments data
function exportAssignments() {
    const assignmentsData = JSON.parse(localStorage.getItem('instructorAssignments') || '[]');
    
    if (assignmentsData.length === 0) {
        alert('No assignments data to export.');
        return;
    }
    
    // Create CSV content
    let csvContent = 'Assignment ID,Title,Course,Due Date,Status,Total Students,Submitted,Progress\n';
    assignmentsData.forEach(assignment => {
        csvContent += `${assignment.id},${assignment.title},${assignment.course},${assignment.dueDate},${assignment.status},${assignment.totalStudents},${assignment.submittedStudents},${assignment.progress}%\n`;
    });
    
    // Download CSV file
    const blob = new Blob([csvContent], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `assignments_${new Date().toISOString().split('T')[0]}.csv`;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);
    
    showSuccessMessage('Assignments data exported successfully!');
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
        localStorage.removeItem('selectedAssignmentId');
        localStorage.removeItem('instructorAssignments');
        
        // Show success message
        alert('تم تسجيل الخروج بنجاح!');
        
        // Redirect to login page
        window.location.href = '../login.html';
    }
}

// Export functions for use in other files
window.instructorAssignments = {
    filterAssignments,
    viewAssignment,
    gradeAssignment,
    createAssignment,
    editAssignment,
    deleteAssignment,
    getAssignmentById,
    updateAssignmentProgress,
    exportAssignments,
    logout
};
