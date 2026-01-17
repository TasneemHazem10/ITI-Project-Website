// Student Assignments JavaScript

document.addEventListener('DOMContentLoaded', function() {
    initializeAssignments();
    loadAssignments();
    setupEventListeners();
});

function initializeAssignments() {
    console.log('Student Assignments initialized');
    
    // Update assignment statistics
    updateAssignmentStats();
}

function loadAssignments() {
    // Simulate loading assignments data
    const assignments = [
        {
            id: 1,
            title: 'Web Development Project',
            dueDate: 'Dec 20, 2024',
            submitted: 'Dec 18, 2024',
            grade: 'A+',
            points: '95/100',
            status: 'submitted'
        },
        {
            id: 2,
            title: 'Data Analysis Report',
            dueDate: 'Dec 25, 2024',
            submitted: null,
            grade: '-',
            points: '-',
            status: 'pending'
        },
        {
            id: 3,
            title: 'Mobile App Prototype',
            dueDate: 'Dec 15, 2024',
            submitted: null,
            grade: '-',
            points: '-',
            status: 'overdue'
        },
        {
            id: 4,
            title: 'Security Assessment',
            dueDate: 'Dec 10, 2024',
            submitted: 'Dec 8, 2024',
            grade: 'A+',
            points: '98/100',
            status: 'submitted'
        }
    ];
    
    updateAssignmentsDisplay(assignments);
}

function updateAssignmentsDisplay(assignments) {
    // Update assignment cards with data
    const assignmentCards = document.querySelectorAll('.assignment-card');
    
    assignmentCards.forEach((card, index) => {
        if (assignments[index]) {
            const assignment = assignments[index];
            
            // Update title and due date
            const titleElement = card.querySelector('h5');
            if (titleElement) {
                titleElement.textContent = assignment.title;
            }
            
            const dueDateElement = card.querySelector('small.text-muted');
            if (dueDateElement) {
                dueDateElement.textContent = `Due: ${assignment.dueDate}`;
            }
            
            // Update status
            const statusElement = card.querySelector('.assignment-status');
            if (statusElement) {
                statusElement.textContent = assignment.status.charAt(0).toUpperCase() + assignment.status.slice(1);
                statusElement.className = `assignment-status ${assignment.status}`;
            }
            
            // Update grades and points
            const gradeElements = card.querySelectorAll('.text-center h6');
            if (gradeElements.length >= 2) {
                gradeElements[0].textContent = assignment.grade;
                gradeElements[1].textContent = assignment.points;
            }
        }
    });
}

function updateAssignmentStats() {
    // Update assignment summary statistics
    const stats = {
        total: 4,
        submitted: 2,
        pending: 1,
        overdue: 1,
        averageGrade: 'A+',
        completionRate: '50%'
    };
    
    // Update statistics display
    const statElements = {
        totalAssignments: document.getElementById('totalAssignments'),
        submittedAssignments: document.getElementById('submittedAssignments'),
        pendingAssignments: document.getElementById('pendingAssignments'),
        overdueAssignments: document.getElementById('overdueAssignments'),
        averageGrade: document.getElementById('averageGrade'),
        completionRate: document.getElementById('completionRate')
    };
    
    Object.keys(statElements).forEach(key => {
        if (statElements[key] && stats[key]) {
            statElements[key].textContent = stats[key];
        }
    });
}

function setupEventListeners() {
    // Assignment action buttons
    const actionButtons = document.querySelectorAll('.btn');
    actionButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const action = this.textContent.trim();
            
            if (action.includes('Submit Assignment')) {
                handleSubmitAssignment(this);
            } else if (action.includes('View Details')) {
                handleViewAssignment(this);
            } else if (action.includes('Download')) {
                handleDownloadAssignment(this);
            }
        });
    });
}

function handleSubmitAssignment(button) {
    const assignmentId = button.closest('.assignment-card').dataset.assignmentId || '2';
    
    // Show submission modal or redirect to submission page
    showNotification('Redirecting to assignment submission...', 'info');
    
    // Simulate navigation to submission page
    setTimeout(() => {
        window.location.href = `assignment-submit.html?id=${assignmentId}`;
    }, 1000);
}

function handleViewAssignment(button) {
    const assignmentId = button.closest('.assignment-card').dataset.assignmentId || '1';
    
    // Show assignment details modal
    showAssignmentDetails(assignmentId);
}

function handleDownloadAssignment(button) {
    const assignmentId = button.closest('.assignment-card').dataset.assignmentId || '1';
    
    // Simulate download
    showNotification('Downloading assignment files...', 'success');
    
    // Simulate file download
    setTimeout(() => {
        showNotification('Assignment files downloaded successfully!', 'success');
    }, 2000);
}

function showAssignmentDetails(assignmentId) {
    // Create and show assignment details modal
    const modalHtml = `
        <div class="modal fade" id="assignmentDetailsModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Assignment Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <h6>Assignment Information</h6>
                        <p>Detailed assignment description and requirements will be displayed here.</p>
                        
                        <h6 class="mt-3">Submission Status</h6>
                        <p>Current submission status and feedback will be shown here.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger">Submit Assignment</button>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    // Remove existing modal if any
    const existingModal = document.getElementById('assignmentDetailsModal');
    if (existingModal) {
        existingModal.remove();
    }
    
    // Add modal to page
    document.body.insertAdjacentHTML('beforeend', modalHtml);
    
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('assignmentDetailsModal'));
    modal.show();
}

function filterAssignments(filter) {
    console.log(`Filtering assignments by: ${filter}`);
    
    // Update filter buttons
    const filterButtons = document.querySelectorAll('[onclick*="filterAssignments"]');
    filterButtons.forEach(button => {
        button.classList.remove('btn-danger');
        button.classList.add('btn-outline-danger');
    });
    
    // Highlight active filter
    const activeButton = document.querySelector(`[onclick="filterAssignments('${filter}')"]`);
    if (activeButton) {
        activeButton.classList.remove('btn-outline-danger');
        activeButton.classList.add('btn-danger');
    }
    
    // Filter assignment cards
    const assignmentCards = document.querySelectorAll('.assignment-card');
    assignmentCards.forEach(card => {
        const status = card.querySelector('.assignment-status').textContent.toLowerCase();
        
        if (filter === 'all' || status.includes(filter)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
    
    showNotification(`Showing ${filter} assignments`, 'info');
}

// Export functions for global access
window.filterAssignments = filterAssignments;
window.submitAssignment = handleSubmitAssignment;
window.viewAssignment = handleViewAssignment;
window.downloadAssignment = handleDownloadAssignment;

