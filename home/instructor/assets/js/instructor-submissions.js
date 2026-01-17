// Instructor Submissions Management JavaScript

// Global variables
let currentAssignment = 'all';
let currentFilters = {
    search: '',
    status: 'all',
    grade: 'all',
    date: 'all'
};

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
    initializeSubmissionsPage();
    setupEventListeners();
});

// Initialize submissions page
function initializeSubmissionsPage() {
    console.log('Submissions page initialized');
    updateSummaryStats();
}

// Setup event listeners
function setupEventListeners() {
    // Search input
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            currentFilters.search = this.value;
            filterSubmissions();
        });
    }

    // Filter dropdowns
    const filters = ['statusFilter', 'gradeFilter', 'dateFilter'];
    filters.forEach(filterId => {
        const element = document.getElementById(filterId);
        if (element) {
            element.addEventListener('change', function() {
                const filterType = filterId.replace('Filter', '');
                currentFilters[filterType] = this.value;
                filterSubmissions();
            });
        }
    });
}

// Select assignment
function selectAssignment(assignmentId, assignmentName) {
    currentAssignment = assignmentId;
    document.getElementById('selectedAssignment').textContent = assignmentName;
    filterSubmissions();
}

// Filter submissions
function filterSubmissions() {
    const cards = document.querySelectorAll('#submissionsGrid .assignment-card');
    let visibleCount = 0;

    cards.forEach(card => {
        let showCard = true;

        // Assignment filter
        if (currentAssignment !== 'all') {
            const cardAssignment = card.querySelector('small').textContent.toLowerCase();
            const assignmentNames = {
                1: 'web development project',
                2: 'data analysis report',
                3: 'mobile app prototype',
                4: 'security assessment'
            };
            
            if (assignmentNames[currentAssignment] && !cardAssignment.includes(assignmentNames[currentAssignment])) {
                showCard = false;
            }
        }

        // Search filter
        if (currentFilters.search && showCard) {
            const studentName = card.querySelector('h6').textContent.toLowerCase();
            const assignmentName = card.querySelector('small').textContent.toLowerCase();
            const searchTerm = currentFilters.search.toLowerCase();
            
            if (!studentName.includes(searchTerm) && !assignmentName.includes(searchTerm)) {
                showCard = false;
            }
        }

        // Status filter
        if (currentFilters.status !== 'all' && showCard) {
            const statusBadge = card.querySelector('.assignment-status');
            if (statusBadge) {
                const status = statusBadge.textContent.toLowerCase();
                const statusMap = {
                    'submitted': 'graded',
                    'graded': 'graded',
                    'pending': 'pending',
                    'late': 'late'
                };
                
                if (statusMap[currentFilters.status] && !status.includes(statusMap[currentFilters.status])) {
                    showCard = false;
                }
            }
        }

        // Grade filter
        if (currentFilters.grade !== 'all' && showCard) {
            const gradeElement = card.querySelector('.text-success, .text-warning, .text-muted');
            if (gradeElement) {
                const grade = gradeElement.textContent.trim();
                if (grade !== currentFilters.grade && grade !== '-') {
                    showCard = false;
                }
            }
        }

        // Date filter
        if (currentFilters.date !== 'all' && showCard) {
            const submittedDate = card.querySelector('.d-flex.align-items-center.text-muted span');
            if (submittedDate) {
                const dateText = submittedDate.textContent;
                const submittedDateObj = new Date(dateText.replace('Submitted: ', ''));
                const now = new Date();
                
                switch(currentFilters.date) {
                    case 'today':
                        if (submittedDateObj.toDateString() !== now.toDateString()) {
                            showCard = false;
                        }
                        break;
                    case 'week':
                        const weekAgo = new Date(now.getTime() - 7 * 24 * 60 * 60 * 1000);
                        if (submittedDateObj < weekAgo) {
                            showCard = false;
                        }
                        break;
                    case 'month':
                        const monthAgo = new Date(now.getTime() - 30 * 24 * 60 * 60 * 1000);
                        if (submittedDateObj < monthAgo) {
                            showCard = false;
                        }
                        break;
                }
            }
        }

        // Show/hide card
        if (showCard) {
            card.closest('.col-lg-6').style.display = '';
            visibleCount++;
        } else {
            card.closest('.col-lg-6').style.display = 'none';
        }
    });

    console.log(`Showing ${visibleCount} submissions`);
}

// Clear all filters
function clearFilters() {
    currentFilters = {
        search: '',
        status: 'all',
        grade: 'all',
        date: 'all'
    };

    // Reset form elements
    document.getElementById('searchInput').value = '';
    document.getElementById('statusFilter').value = 'all';
    document.getElementById('gradeFilter').value = 'all';
    document.getElementById('dateFilter').value = 'all';

    filterSubmissions();
}

// View submission
function viewSubmission(assignmentId, studentId) {
    console.log(`Viewing submission for assignment ${assignmentId}, student ${studentId}`);
    
    // Create modal for viewing submission
    const modal = createSubmissionModal(assignmentId, studentId);
    document.body.appendChild(modal);
    
    // Show modal
    const bsModal = new bootstrap.Modal(modal);
    bsModal.show();
    
    // Remove modal from DOM when hidden
    modal.addEventListener('hidden.bs.modal', function() {
        document.body.removeChild(modal);
    });
}

// Create submission modal
function createSubmissionModal(assignmentId, studentId) {
    const modal = document.createElement('div');
    modal.className = 'modal fade';
    modal.innerHTML = `
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Submission Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h6>Assignment: Web Development Project</h6>
                            <p class="text-muted">Student: Sarah Ahmed (2024001)</p>
                            
                            <div class="submission-files mt-3">
                                <h6>Submitted Files:</h6>
                                <div class="list-group">
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><i class="fas fa-file-code me-2"></i>index.html</span>
                                        <button class="btn btn-sm btn-outline-primary">Download</button>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><i class="fas fa-file-code me-2"></i>styles.css</span>
                                        <button class="btn btn-sm btn-outline-primary">Download</button>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><i class="fas fa-file-code me-2"></i>script.js</span>
                                        <button class="btn btn-sm btn-outline-primary">Download</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="submission-notes mt-3">
                                <h6>Student Notes:</h6>
                                <div class="alert alert-info">
                                    I've implemented a responsive website with modern design principles. 
                                    The project includes HTML structure, CSS styling, and JavaScript functionality.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0">Grading</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Grade</label>
                                        <select class="form-select" id="gradeSelect">
                                            <option value="A+">A+</option>
                                            <option value="A">A</option>
                                            <option value="B+">B+</option>
                                            <option value="B">B</option>
                                            <option value="C+">C+</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                            <option value="F">F</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Points</label>
                                        <input type="number" class="form-control" id="pointsInput" min="0" max="100" value="95">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Feedback</label>
                                        <textarea class="form-control" id="feedbackInput" rows="4" placeholder="Enter feedback..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveGrade(${assignmentId}, ${studentId})">Save Grade</button>
                </div>
            </div>
        </div>
    `;
    
    return modal;
}

// Edit grade
function editGrade(assignmentId, studentId) {
    console.log(`Editing grade for assignment ${assignmentId}, student ${studentId}`);
    viewSubmission(assignmentId, studentId);
}

// Save grade
function saveGrade(assignmentId, studentId) {
    const grade = document.getElementById('gradeSelect').value;
    const points = document.getElementById('pointsInput').value;
    const feedback = document.getElementById('feedbackInput').value;
    
    console.log(`Saving grade for assignment ${assignmentId}, student ${studentId}: ${grade} (${points} points)`);
    console.log(`Feedback: ${feedback}`);
    
    // Update the submission card
    updateSubmissionCard(assignmentId, studentId, grade, points);
    
    // Close modal
    const modal = document.querySelector('.modal');
    if (modal) {
        const bsModal = bootstrap.Modal.getInstance(modal);
        bsModal.hide();
    }
    
    updateSummaryStats();
}

// Update submission card
function updateSubmissionCard(assignmentId, studentId, grade, points) {
    const cards = document.querySelectorAll('#submissionsGrid .assignment-card');
    cards.forEach(card => {
        const studentName = card.querySelector('h6').textContent;
        const assignmentName = card.querySelector('small').textContent;
        
        // This is a simplified check - in real implementation, you'd use proper IDs
        if (studentName && assignmentName) {
            // Update grade display
            const gradeElement = card.querySelector('.text-success, .text-warning, .text-muted');
            if (gradeElement) {
                gradeElement.textContent = grade;
                gradeElement.className = getGradeTextClass(grade);
            }
            
            // Update points display
            const pointsElement = card.querySelector('.text-primary');
            if (pointsElement) {
                pointsElement.textContent = `${points}/100`;
            }
            
            // Update status
            const statusBadge = card.querySelector('.assignment-status');
            if (statusBadge) {
                statusBadge.textContent = 'Graded';
                statusBadge.className = 'assignment-status submitted';
            }
        }
    });
}

// Get grade text class
function getGradeTextClass(grade) {
    switch(grade) {
        case 'A+':
        case 'A':
            return 'text-success';
        case 'B+':
        case 'B':
            return 'text-warning';
        case 'C+':
        case 'C':
        case 'D':
        case 'F':
            return 'text-danger';
        default:
            return 'text-muted';
    }
}

// Download all submissions
function downloadAllSubmissions() {
    console.log('Downloading all submissions...');
    alert('Preparing download of all submissions...');
}

// Bulk grade
function bulkGrade() {
    console.log('Opening bulk grading...');
    alert('Opening bulk grading interface...');
}

// Update summary statistics
function updateSummaryStats() {
    const cards = document.querySelectorAll('#submissionsGrid .assignment-card');
    let totalSubmissions = 0;
    let gradedSubmissions = 0;
    let pendingSubmissions = 0;
    let lateSubmissions = 0;
    let totalPoints = 0;
    let gradedCount = 0;

    cards.forEach(card => {
        const parentDiv = card.closest('.col-lg-6');
        if (parentDiv.style.display !== 'none') {
            totalSubmissions++;
            
            const statusBadge = card.querySelector('.assignment-status');
            if (statusBadge) {
                const status = statusBadge.textContent.toLowerCase();
                
                if (status.includes('graded')) {
                    gradedSubmissions++;
                    
                    // Calculate average points
                    const pointsElement = card.querySelector('.text-primary');
                    if (pointsElement) {
                        const pointsText = pointsElement.textContent;
                        const points = parseInt(pointsText.split('/')[0]);
                        if (!isNaN(points)) {
                            totalPoints += points;
                            gradedCount++;
                        }
                    }
                } else if (status.includes('pending')) {
                    pendingSubmissions++;
                } else if (status.includes('late')) {
                    lateSubmissions++;
                }
            }
        }
    });

    // Update summary display
    document.getElementById('totalSubmissions').textContent = totalSubmissions;
    document.getElementById('gradedSubmissions').textContent = gradedSubmissions;
    document.getElementById('pendingSubmissions').textContent = pendingSubmissions;
    document.getElementById('lateSubmissions').textContent = lateSubmissions;
    
    if (gradedCount > 0) {
        const averagePoints = Math.round(totalPoints / gradedCount);
        document.getElementById('averageGrade').textContent = getGradeFromPoints(averagePoints);
    }
    
    const completionRate = totalSubmissions > 0 ? Math.round((gradedSubmissions / totalSubmissions) * 100) : 0;
    document.getElementById('completionRate').textContent = completionRate + '%';
}

// Get grade from points
function getGradeFromPoints(points) {
    if (points >= 97) return 'A+';
    if (points >= 93) return 'A';
    if (points >= 90) return 'A-';
    if (points >= 87) return 'B+';
    if (points >= 83) return 'B';
    if (points >= 80) return 'B-';
    if (points >= 77) return 'C+';
    if (points >= 73) return 'C';
    if (points >= 70) return 'C-';
    if (points >= 67) return 'D+';
    if (points >= 65) return 'D';
    return 'F';
}

// Logout function
function logout() {
    if (confirm('Are you sure you want to logout?')) {
        console.log('Logging out...');
        window.location.href = '../index.html';
    }
}
