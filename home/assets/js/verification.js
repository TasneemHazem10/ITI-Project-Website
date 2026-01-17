// Verification Page JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const checkStatusBtn = document.getElementById('checkStatusBtn');
    
    // Check status button click
    checkStatusBtn.addEventListener('click', function() {
        checkVerificationStatus();
    });

    // Auto-check status every 30 seconds
    setInterval(checkVerificationStatus, 30000);

    // Check verification status
    function checkVerificationStatus() {
        // Show loading state
        const originalText = checkStatusBtn.innerHTML;
        checkStatusBtn.disabled = true;
        checkStatusBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Checking...';

        // Simulate API call (in real app, this would be an AJAX call)
        setTimeout(function() {
            // Simulate different status responses
            const status = Math.random(); // Random for demo purposes
            
            if (status < 0.1) { // 10% chance of approval
                showApprovalMessage();
            } else if (status < 0.15) { // 5% chance of rejection
                showRejectionMessage();
            } else {
                // Still pending
                showPendingMessage();
            }
            
            // Reset button
            checkStatusBtn.disabled = false;
            checkStatusBtn.innerHTML = originalText;
        }, 1500);
    }

    // Show approval message
    function showApprovalMessage() {
        const alertHtml = `
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h4 class="alert-heading text-white">
                    <i class="fas fa-check-circle me-2"></i>
                    Account Approved!
                </h4>
                <p class="text-white">Congratulations! Your account has been verified and approved by our admin team.</p>
                <hr style="border-color: rgba(255,255,255,0.3);">
                <p class="mb-0">
                    <a href="profile.html" class="btn btn-light">
                        <i class="fas fa-user me-2"></i>
                        Go to Profile
                    </a>
                </p>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        `;
        
        // Insert at the top of the card body
        const cardBody = document.querySelector('.card-body');
        cardBody.insertAdjacentHTML('afterbegin', alertHtml);
        
        // Update timeline
        updateTimelineStatus('approved');
    }

    // Show rejection message
    function showRejectionMessage() {
        const alertHtml = `
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Verification Failed
                </h4>
                <p>Unfortunately, your photo verification was not approved. Please try again with a clearer, more recent photo.</p>
                <hr>
                <p class="mb-0">
                    <a href="upload_photo.html" class="btn btn-danger">
                        <i class="fas fa-upload me-2"></i>
                        Upload New Photo
                    </a>
                </p>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        
        // Insert at the top of the card body
        const cardBody = document.querySelector('.card-body');
        cardBody.insertAdjacentHTML('afterbegin', alertHtml);
        
        // Update timeline
        updateTimelineStatus('rejected');
    }

    // Show pending message
    function showPendingMessage() {
        // Remove any existing alerts
        const existingAlerts = document.querySelectorAll('.alert');
        existingAlerts.forEach(alert => alert.remove());
        
        const alertHtml = `
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h4 class="alert-heading text-white">
                    <i class="fas fa-info-circle me-2"></i>
                    Still Under Review
                </h4>
                <p class="text-white">Your account is still being reviewed by our admin team. Please check back later.</p>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        `;
        
        // Insert at the top of the card body
        const cardBody = document.querySelector('.card-body');
        cardBody.insertAdjacentHTML('afterbegin', alertHtml);
    }

    // Update timeline status
    function updateTimelineStatus(status) {
        const timelineItems = document.querySelectorAll('.timeline-item');
        
        if (status === 'approved') {
            // Mark all items as completed
            timelineItems.forEach(item => {
                item.classList.remove('active');
                item.classList.add('completed');
                const marker = item.querySelector('.timeline-marker');
                marker.classList.remove('bg-warning');
                marker.classList.add('bg-success');
            });
        } else if (status === 'rejected') {
            // Mark review as failed
            const reviewItem = timelineItems[2]; // Admin Review item
            reviewItem.classList.remove('active');
            reviewItem.classList.add('failed');
            const marker = reviewItem.querySelector('.timeline-marker');
            marker.classList.remove('bg-warning');
            marker.classList.add('bg-danger');
        }
    }

    // Add CSS for additional styles
    const style = document.createElement('style');
    style.textContent = `
        .timeline-item.failed .timeline-marker {
            background-color: #dc3545 !important;
            box-shadow: 0 0 0 2px #dc3545 !important;
        }
        
        .alert {
            margin-bottom: 1rem;
        }
        
        .btn-close {
            background: none;
            border: none;
            font-size: 1.2rem;
            opacity: 0.5;
        }
        
        .btn-close:hover {
            opacity: 0.75;
        }
        
        .fade {
            transition: opacity 0.15s linear;
        }
        
        .fade:not(.show) {
            opacity: 0;
        }
        
        .show {
            opacity: 1;
        }
        
        .alert-dismissible .btn-close {
            position: absolute;
            top: 0;
            right: 0;
            z-index: 2;
            padding: 1.25rem 1rem;
        }
        
        .alert-heading {
            color: inherit;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }
        
        .alert hr {
            border-top-color: rgba(0,0,0,0.1);
            margin: 1rem 0;
        }
        
        .alert .btn {
            margin-top: 0.5rem;
        }
    `;
    document.head.appendChild(style);
});
