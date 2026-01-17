// Login Type Toggle JavaScript

// Login type toggle functionality
let currentLoginType = 'student';

function switchLoginType(type) {
    currentLoginType = type;
    
    // Update button states
    const studentBtn = document.getElementById('studentLoginBtn');
    const instructorBtn = document.getElementById('instructorLoginBtn');
    const loginTitle = document.getElementById('loginTitle');
    
    // Get forms
    const studentForm = document.getElementById('studentForm');
    const instructorForm = document.getElementById('instructorForm');
    
    if (type === 'student') {
        studentBtn.classList.add('active');
        instructorBtn.classList.remove('active');
        loginTitle.textContent = 'Student Login';
        
        // Show student form, hide instructor form
        studentForm.style.display = 'block';
        instructorForm.style.display = 'none';
    } else {
        studentBtn.classList.remove('active');
        instructorBtn.classList.add('active');
        loginTitle.textContent = 'Instructor Login';
        
        // Show instructor form, hide student form
        studentForm.style.display = 'none';
        instructorForm.style.display = 'block';
    }
}

// Instructor validation functions
function valid_instructor_email() {
    const email = document.getElementById('instructorEmail');
    const emailVal = email.value.trim();
    const emailPattern = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
    
    if (emailPattern.test(emailVal)) {
        const label = document.querySelector("label[for='instructorEmail']");
        label.innerText = "valid Email";
        email.style.borderColor = "#28a745";
    } else {
        const label = document.querySelector("label[for='instructorEmail']");
        label.innerText = "invalid Email";
        email.style.borderColor = "var(--main-color)";
    }
}

function valid_instructor_pass() {
    const password = document.getElementById('instructorPassword');
    const passVal = password.value.trim();
    
    if (passVal !== "") {
        const label = document.querySelector("label[for='instructorPassword']");
        label.innerText = "valid password";
        password.style.borderColor = "#28a745";
    } else {
        const label = document.querySelector("label[for='instructorPassword']");
        label.innerText = "invalid password";
        password.style.borderColor = "var(--main-color)";
    }
}

// Instructor login validation
function checkInstructor(event) {
    const email = document.getElementById('instructorEmail');
    const password = document.getElementById('instructorPassword');
    const emailVal = email.value.trim();
    const passVal = password.value.trim();
    
    // Email pattern validation
    const emailPattern = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
    
    if (!emailPattern.test(emailVal) || passVal == "") {
        event.preventDefault();
    }

    if (!emailPattern.test(emailVal)) {
        const label_email = document.querySelector("label[for='instructorEmail']");
        email.style.cssText = "animation: move .4s;border-color: var(--main-color);";
        label_email.innerText = "invalid Email";
    }

    if (passVal == "") {
        const label_pass = document.querySelector("label[for='instructorPassword']");
        password.style.cssText = "animation: move .4s;border-color: var(--main-color);";
        label_pass.innerText = "invalid password";
    }
    
    // If validation passes, redirect to admin panel
    if (emailPattern.test(emailVal) && passVal !== "") {
        window.location.href = 'admin/index.html';
    }
}
