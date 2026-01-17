// Edit Instructor JavaScript Functions

// Global variable to store instructors data
let instructorsData = [];

// Load instructors data when page loads
document.addEventListener('DOMContentLoaded', function() {
    // Store instructors data for JavaScript use
    const instructorSelect = document.getElementById('instructorSelect');
    instructorsData = Array.from(instructorSelect.options).slice(1).map(option => ({
        id: option.value,
        name: option.text
    }));
});

// Load instructor data into form
function loadInstructorData() {
    const instructorSelect = document.getElementById('instructorSelect');
    const selectedId = instructorSelect.value;
    
    if (!selectedId) {
        alert('Please select an instructor first');
        return;
    }
    
    // Show loading message
    const loadBtn = document.querySelector('[onclick="loadInstructorData()"]');
    const originalText = loadBtn.innerHTML;
    loadBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Loading...';
    loadBtn.disabled = true;
    
    // Fetch instructor data
    fetch(`/admin/instructors/${selectedId}/data`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Fill form with instructor data
                fillInstructorForm(data.data);
                
                // Update form action with selected instructor ID
                const form = document.getElementById('editInstructorForm');
                const currentAction = form.action;
                form.action = currentAction.replace(':id', selectedId);
                
                // Show the edit form
                document.getElementById('instructorEditForm').style.display = 'block';
                
                // Scroll to form
                document.getElementById('instructorEditForm').scrollIntoView({ 
                    behavior: 'smooth' 
                });
                
                // Focus on first input
                document.getElementById('editFirstName').focus();
            } else {
                alert('Error loading instructor data');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error loading instructor data');
        })
        .finally(() => {
            // Restore button
            loadBtn.innerHTML = originalText;
            loadBtn.disabled = false;
        });
}

// Fill form with instructor data
function fillInstructorForm(data) {
    // Fill text inputs
    document.getElementById('editFirstName').value = data.fname || '';
    document.getElementById('editLastName').value = data.lname || '';
    document.getElementById('editEmail').value = data.email || '';
    document.getElementById('editPhone').value = data.phone || '';
    document.getElementById('editNationalId').value = data.national_id || '';
    document.getElementById('editJobTitle').value = data.job_tittle || '';
    
    // Set national ID as readonly since it's the primary key
    document.getElementById('editNationalId').readOnly = true;
    
    // Update instructor photo if exists
    if (data.img_name) {
        document.getElementById('editInstructorPhotoPreview').src = data.img_name;
    } else {
        // Use default image
        const defaultImg = document.querySelector('meta[name="default-instructor-image"]');
        if (defaultImg) {
            document.getElementById('editInstructorPhotoPreview').src = defaultImg.content;
        }
    }
}

// Delete instructor function
function deleteInstructor() {
    const instructorSelect = document.getElementById('instructorSelect');
    const selectedId = instructorSelect.value;
    
    if (!selectedId) {
        alert('Please select an instructor first');
        return;
    }
    
    if (confirm('Are you sure you want to delete this instructor? This action cannot be undone.')) {
        // Create a form for deletion
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/instructors/${selectedId}`;
        
        // Add CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (csrfToken) {
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken.getAttribute('content');
            form.appendChild(csrfInput);
        }
        
        // Add method override for DELETE
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        form.appendChild(methodInput);
        
        // Submit form
        document.body.appendChild(form);
        form.submit();
    }
}

// Preview image function
function previewImage(input, previewId) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            document.getElementById(previewId).src = e.target.result;
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

// Validate form before submission
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('editInstructorForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            const requiredFields = this.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    isValid = false;
                } else {
                    field.classList.remove('is-invalid');
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                alert('Please fill in all required fields');
                return false;
            }
            
            // Show loading state
            const submitBtn = this.querySelector('[type="submit"]');
            if (submitBtn) {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Updating...';
                submitBtn.disabled = true;
            }
        });
    }
});