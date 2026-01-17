/**
 * Curriculum Management JavaScript
 * Handles module and lesson management functionality
 */

document.addEventListener('DOMContentLoaded', function() {
    // Module 3 toggle functionality
    const addModuleBtn = document.getElementById('addModuleBtn');
    const module3 = document.getElementById('module3');
    let module3Visible = false;

    if (addModuleBtn && module3) {
        addModuleBtn.addEventListener('click', function() {
            if (!module3Visible) {
                module3.style.display = 'block';
                module3Visible = true;
                addModuleBtn.innerHTML = '<i class="fas fa-minus me-1"></i><span data-en="Hide Module 3" data-ar="إخفاء الوحدة 3">Hide Module 3</span>';
            } else {
                module3.style.display = 'none';
                module3Visible = false;
                addModuleBtn.innerHTML = '<i class="fas fa-plus me-1"></i><span data-en="Add New Module" data-ar="إضافة وحدة جديدة">Add New Module</span>';
            }
        });
    }

    // Add lesson functionality for all modules
    const addLessonBtns = document.querySelectorAll('.add-lesson-btn');
    
    addLessonBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            const lessonsContainer = this.parentElement;
            const lessonCount = lessonsContainer.querySelectorAll('.lesson-item').length;
            
            // Check if maximum lessons reached (4 lessons max)
            if (lessonCount >= 4) {
                alert('Maximum 4 lessons allowed per module');
                return;
            }
            
            // Create new lesson HTML
            const newLessonHTML = `
                <div class="lesson-item mb-2">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <input type="text"
                                class="form-control form-control-sm"
                                placeholder="Lesson Name"
                                value="New Lesson ${lessonCount + 1}">
                        </div>
                        <div class="col-md-2">
                            <input type="number"
                                class="form-control form-control-sm"
                                placeholder="Duration (hours)"
                                value="1">
                        </div>
                        <div class="col-md-2">
                            <button type="button"
                                class="btn btn-outline-danger btn-sm remove-lesson-btn">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            // Insert new lesson before the add button
            this.insertAdjacentHTML('beforebegin', newLessonHTML);
            
            // Add event listener to the new remove button
            const newRemoveBtn = this.previousElementSibling.querySelector('.remove-lesson-btn');
            newRemoveBtn.addEventListener('click', function() {
                this.closest('.lesson-item').remove();
                
                // Show add button again if under maximum
                const lessonsContainer = this.closest('.lessons');
                const lessonCount = lessonsContainer.querySelectorAll('.lesson-item').length;
                const addBtn = lessonsContainer.querySelector('.add-lesson-btn');
                if (lessonCount < 4 && addBtn) {
                    addBtn.style.display = 'inline-block';
                }
            });
            
            // Hide add button if maximum lessons reached
            if (lessonCount + 1 >= 4) {
                this.style.display = 'none';
            }
        });
    });

    // Remove lesson functionality for existing lessons
    const removeLessonBtns = document.querySelectorAll('.lesson-item .btn-outline-danger');
    removeLessonBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            this.closest('.lesson-item').remove();
            
            // Show add button again if under maximum
            const lessonsContainer = this.closest('.lessons');
            const lessonCount = lessonsContainer.querySelectorAll('.lesson-item').length;
            const addBtn = lessonsContainer.querySelector('.add-lesson-btn');
            if (lessonCount < 4 && addBtn) {
                addBtn.style.display = 'inline-block';
            }
        });
    });
});
