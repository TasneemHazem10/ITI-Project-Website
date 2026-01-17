document.addEventListener('DOMContentLoaded', function() {
    const photoUploadArea = document.getElementById('photoUploadArea');
    const photoInput = document.getElementById('photoInput');
    const photoPreview = document.getElementById('photoPreview');
    const previewImage = document.getElementById('previewImage');
    const removePhotoBtn = document.getElementById('removePhoto');
    const agreeTermsCheckbox = document.getElementById('agreeTerms');
    const submitBtn = document.getElementById('submitBtn');
    const uploadForm = document.getElementById('uploadForm');
    const errorAlert = document.getElementById('errorAlert');
    const successAlert = document.getElementById('successAlert');

    // Photo upload area click handler
    photoUploadArea.addEventListener('click', function() {
        photoInput.click();
    });

    // Drag and drop handlers
    photoUploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        photoUploadArea.classList.add('drag-over');
    });

    photoUploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        photoUploadArea.classList.remove('drag-over');
    });

    photoUploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        photoUploadArea.classList.remove('drag-over');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            handleFileSelect(files[0]);
        }
    });

    // File input change handler
    photoInput.addEventListener('change', function(e) {
        if (e.target.files.length > 0) {
            handleFileSelect(e.target.files[0]);
        }
    });

    // Remove photo handler
    removePhotoBtn.addEventListener('click', function() {
        removePhoto();
    });

    // Terms agreement handler
    agreeTermsCheckbox.addEventListener('change', function() {
        updateSubmitButton();
    });

    function handleFileSelect(file) {
        // Validate file type
        if (!file.type.startsWith('image/')) {
            showError('يرجى اختيار ملف صورة صالح');
            return;
        }

        // Validate file size (5MB)
        if (file.size > 5 * 1024 * 1024) {
            showError('حجم الملف يجب أن يكون أقل من 5 ميجابايت');
            return;
        }

        // Hide error if any
        hideError();

        // Attach file to the real input so it is submitted with the form
        try {
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            photoInput.files = dataTransfer.files;
        } catch (e) {
            // Fallback: some environments may not support programmatic assignment
        }

        // Create preview
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            photoUploadArea.style.display = 'none';
            photoPreview.classList.remove('d-none');

            // File is already in the real input (name="photo")
            updateSubmitButton();
        };
        reader.readAsDataURL(file);
    }

    function removePhoto() {
        photoInput.value = '';
        previewImage.src = '';
        photoPreview.classList.add('d-none');
        photoUploadArea.style.display = 'block';
        
        // Clear form inputs
        // photoInput is the real input; value cleared above
        updateSubmitButton();
    }

    function updateSubmitButton() {
        const hasPhoto = photoInput.files.length > 0;
        const hasAgreed = agreeTermsCheckbox.checked;
        
        submitBtn.disabled = !(hasPhoto && hasAgreed);
        
        if (hasPhoto && hasAgreed) {
            submitBtn.classList.remove('btn-secondary');
            submitBtn.classList.add('btn-primary');
        } else {
            submitBtn.classList.remove('btn-primary');
            submitBtn.classList.add('btn-secondary');
        }
    }

    function showError(message) {
        errorAlert.classList.remove('d-none');
        document.getElementById('errorMessage').textContent = message;
        successAlert.classList.add('d-none');
    }

    function hideError() {
        errorAlert.classList.add('d-none');
    }

    function showSuccess(message) {
        successAlert.classList.remove('d-none');
        document.getElementById('successMessage').textContent = message;
        errorAlert.classList.add('d-none');
    }

    // Form submission handler
    uploadForm.addEventListener('submit', function(e) {
        const hasPhoto = photoInput.files.length > 0;
        const hasAgreed = agreeTermsCheckbox.checked;
        
        if (!hasPhoto) {
            e.preventDefault();
            showError('يرجى اختيار صورة أولاً');
            return;
        }
        
        if (!hasAgreed) {
            e.preventDefault();
            showError('يرجى الموافقة على الشروط والأحكام');
            return;
        }
        // No need to create hidden inputs; we submit existing inputs
        
        // Show loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>جاري الرفع...';
    });
});