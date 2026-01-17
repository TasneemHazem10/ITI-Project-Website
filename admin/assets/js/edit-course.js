// Get CSRF token from meta tag
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const defaultCourseImage = document.querySelector('meta[name="default-course-image"]').getAttribute('content');

// Load course data when course is selected
function loadCourseData() {
    const courseSelect = document.getElementById('courseSelect');
    const courseId = courseSelect.value;
    
    if (!courseId) {
        alert('يرجى اختيار كورس أولاً');
        return;
    }
    
    // Show loading state
    const loadButton = document.querySelector('[onclick="loadCourseData()"]');
    const originalText = loadButton.textContent;
    loadButton.textContent = 'جاري التحميل...';
    loadButton.disabled = true;
    
    // Fetch course data
    fetch(`/admin/courses/${courseId}/data`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            fillCourseForm(data.data);
            document.getElementById('courseEditForm').style.display = 'block';
            
            // Scroll to form
            document.getElementById('courseEditForm').scrollIntoView({ 
                behavior: 'smooth', 
                block: 'start' 
            });
        } else {
            alert('حدث خطأ في تحميل بيانات الكورس');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('حدث خطأ في الاتصال بالخادم');
    })
    .finally(() => {
        // Reset button state
        loadButton.textContent = originalText;
        loadButton.disabled = false;
    });
}

// Fill form with course data
function fillCourseForm(course) {
    // Update form action with course ID
    const form = document.getElementById('editCourseFormSubmit');
    const actionUrl = form.action.replace(':id', course.id);
    form.action = actionUrl;
    
    // Fill basic information
    document.getElementById('editCourseName').value = course.course_name || '';
    document.getElementById('editDuration').value = course.duration || '';
    document.getElementById('editCourseDescription').value = course.course_description || '';
    document.getElementById('editSkills').value = course.skills || '';
    document.getElementById('editMaxStudents').value = course.max_students || '';
    document.getElementById('editStartDate').value = course.start_date || '';
    document.getElementById('editLocation').value = course.location || '';
    document.getElementById('editPrice').value = course.price || '';
    
    // Fill checkboxes
    document.getElementById('editCertificate').checked = course.certificate == 1;
    document.getElementById('editFeatured').checked = course.featured == 1;
    
    // Handle course image
    const imagePreview = document.getElementById('editCourseImagePreview');
    if (course.image) {
        imagePreview.src = `/storage/${course.image}`;
    } else {
        imagePreview.src = defaultCourseImage;
    }
    
    console.log('Course data loaded successfully:', course);
}

// Delete course function
function deleteCourse() {
    const courseSelect = document.getElementById('courseSelect');
    const courseId = courseSelect.value;
    
    if (!courseId) {
        alert('يرجى اختيار كورس أولاً');
        return;
    }
    
    const courseName = courseSelect.options[courseSelect.selectedIndex].text;
    
    if (confirm(`هل أنت متأكد من حذف الكورس: ${courseName}؟`)) {
        // Create a form to submit DELETE request
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/courses/${courseId}`;
        
        // Add CSRF token
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = csrfToken;
        form.appendChild(csrfInput);
        
        // Add DELETE method
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        form.appendChild(methodInput);
        
        document.body.appendChild(form);
        form.submit();
    }
}

// Preview image when file is selected
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('editCourseImage');
    const imagePreview = document.getElementById('editCourseImagePreview');
    
    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }
});