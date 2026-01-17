// Pending Verification JavaScript

function approveRequest(id) {
    if (confirm('Are you sure you want to approve this request?')) {
        // Add approval logic here
        alert('Request approved successfully!');
        // Remove the card or update its status
    }
}

function rejectRequest(id) {
    if (confirm('Are you sure you want to reject this request?')) {
        // Add rejection logic here
        alert('Request rejected successfully!');
        // Remove the card or update its status
    }
}

function approveAll() {
    if (confirm('Are you sure you want to approve all pending requests?')) {
        // Add approve all logic here
        alert('All requests approved successfully!');
    }
}

function rejectAll() {
    if (confirm('Are you sure you want to reject all pending requests?')) {
        // Add reject all logic here
        alert('All requests rejected successfully!');
    }
}

// Function to view document
function viewDocument(type, studentId) {
    // Add logic to open document viewer
    alert(`Viewing ${type} for student ${studentId}`);
}

// Function to view profile photo
function viewProfilePhoto(studentId) {
    // Add logic to open photo viewer
    alert(`Viewing profile photo for student ${studentId}`);
}
