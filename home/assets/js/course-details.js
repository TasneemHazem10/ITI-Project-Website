// Course Details JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const enrollBtn = document.getElementById('enrollBtn');
    
    // Enroll button click event
    enrollBtn.addEventListener('click', function() {
        enrollInCourse();
    });

    // Enroll in course function
    function enrollInCourse() {
        // Show loading state
        const originalText = enrollBtn.innerHTML;
        enrollBtn.disabled = true;
        enrollBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Enrolling...';

        // Simulate enrollment process
        setTimeout(function() {
            // Show enrollment modal
            const enrollmentModal = new bootstrap.Modal(document.getElementById('enrollmentModal'));
            enrollmentModal.show();
            
            // Reset button
            enrollBtn.disabled = false;
            enrollBtn.innerHTML = originalText;
        }, 2000);
    }

    // Add smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add animation to course cards
    const courseCards = document.querySelectorAll('.card');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1
    });

    courseCards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });

    // Add hover effects to related course cards
    const relatedCourseCards = document.querySelectorAll('.col-md-4 .card');
    relatedCourseCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '0 10px 25px rgba(0,0,0,0.15)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '0 0.5px 5px 0 var(--iti-red), 0 1px 2px 0 var(--iti-red)';
        });
    });

    // Add progress tracking for curriculum
    const accordionButtons = document.querySelectorAll('.accordion-button');
    accordionButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Add a small delay to show the content is loading
            const target = document.querySelector(this.getAttribute('data-bs-target'));
            if (target) {
                target.style.opacity = '0';
                setTimeout(() => {
                    target.style.opacity = '1';
                }, 100);
            }
        });
    });

    // Add click tracking for course interactions
    const trackableElements = document.querySelectorAll('.btn, .card, .accordion-button');
    trackableElements.forEach(element => {
        element.addEventListener('click', function() {
            // In a real application, you would send analytics data here
            console.log('Course interaction:', this.textContent.trim());
        });
    });
});

// Function to redirect to courses page
function redirectToCourses() {
    window.location.href = 'courses.html';
}
